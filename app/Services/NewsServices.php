<?php
namespace App\Services;

use Log;
use GuzzleHttp\Client;
use GuzzleHttp\Promise\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsServices 
{

    protected $baseUrl;
    protected $url;
    protected $token;


    public function __construct(){
        $this->baseUrl = config('services.api_base_url');
        $this->url = config('services.api_url');
        $this->token = session('Authorization');
    }

    protected  function fetchWithETag(string $cacheKey, string $url, string $keySuffix = null) {
        $buildCache = $keySuffix ? $cacheKey. '_' . $keySuffix : $cacheKey; 
    
        $etag = cache($buildCache);
        $response = $etag 
        ? Http::withHeaders(['If-None-Match' => $etag])->get($url)
        : Http::get($url);
        if ($response->status() === 200 ) {
            // Ambil nilai ETag dari header response
            $etagHeader = $response->header('ETag');
            $newsData = $response->json('data');
          
                cache()->forget($buildCache);
                cache()->forget($buildCache .'_data');

                cache([
                    $buildCache => $etagHeader,
                    $buildCache.'_data' => $newsData
            ]);
            cache([$buildCache => $etagHeader]);
            cache([$buildCache.'_data'=> $newsData]);
           
            return[
                'data' => $newsData,
                'url' => $this->url,
                'etag_test' => $etagHeader
            ];   
        }
        // dd($response->status());
        if($response->status() === 304) {
            $cacheData = cache($buildCache.'_data');
            if($cacheData) {
                return [
                    'data' => $cacheData, 
                    'url' => $this->url,
                    'from_cache'=> true
                ];
            }
        }
    return $response->json('errors');
 }

    public function allNews($kategori) {
        $url = $this->baseUrl.'/berita/pengguna?' . http_build_query(['kategori' => $kategori]);
        return $this->fetchWithETag('etag_kategori' , $url);
    }


    public function selectedNews($newest) {
        $url = $this->baseUrl.'/berita/pengguna?' . http_build_query(['selectedTopics' => 'true','newest' => $newest]);
        //dd($url);
        return $this->fetchWithETag('etag_news' , $url);
    }

    
    public function detailNews($kategori , $slugBerita){
        // $response = Http::withHeaders(['Accept' => 'application/json'])
        // ->get($this->baseUrl.'/berita/'.$kategori.'/' .$slugBerita);
        $client = new \GuzzleHttp\Client();
        $response = $client->get($this->baseUrl.'/berita/'.$kategori.'/' .$slugBerita, [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            ],
        ]);
        if ($response->getStatusCode() >= 200 && $response->getStatusCode() < 300) {
            return json_decode($response->getBody(), true)['data'] ?? null;
        } else {
            return json_decode($response->getBody(), true)['errors'] ?? null;
        }
    }

    public function popularNews() {
          $url = $this->baseUrl.'/berita/populer';
          
          $d =$this->fetchWithETag('etag_popular' , $url);
          return($d);
    }
    
    public function relatedNews($kategori) {

        $url = $this->baseUrl.'/news/related/'.$kategori;
        return $this->fetchWithETag('etag_related_' , $url,$kategori);

    }

    public function selectedTopics() {
        $url = $this->baseUrl.'/berita/pengguna?' . http_build_query(['selectedTopics' => 'true']);
       return $this->fetchWithETag('etag_topics ', $url);
    }

    public function allNewsPopularAndTopics($newest) {
        $client = new Client();
        $urlAll = $this->baseUrl.'/berita/pengguna?' . http_build_query(['newest' => $newest]);
        $urlPopular = $this->baseUrl.'/berita/populer';
        $urlSelected = $this->baseUrl.'/berita/pengguna?' . http_build_query(['selectedTopics' => 'true']);
    
        // Ambil ETag dari cache
        $etagAll = cache('etag_news');
        $etagPopular = cache('etag_popular');
        $etagTopics = cache('etag_topics');
    
        // Debug cache sebelum request
        $cachedDataBefore = [
            'etag_news' => $etagAll,
            'etag_news_data' => cache('etag_news_data'),
            'etag_popular' => $etagPopular,
            'etag_popular_data' => cache('etag_popular_data'),
            'etag_topics' => $etagTopics,
            'etag_topics_data' => cache('etag_topics_data'),
        ];
    
        $promises = [
            'allNews' => $client->getAsync($urlAll, [
                'headers' => $etagAll ? ['If-None-Match' => $etagAll] : []
            ]),
            'popularNews' => $client->getAsync($urlPopular, [
                'headers' => $etagPopular ? ['If-None-Match' => $etagPopular] : []
            ]),
            'selectedTopics' => $client->getAsync($urlSelected, [
                'headers' => $etagTopics ? ['If-None-Match' => $etagTopics] : []
            ]),
        ];
    
        $responses = Utils::settle($promises)->wait();
        
        $debugInfo = [];
        foreach ($responses as $key => $response) {
            $cacheKey = match($key) {
                'allNews' => 'etag_news',
                'popularNews' => 'etag_popular',
                'selectedTopics' => 'etag_topics',
            };
            
            if ($response['state'] === 'fulfilled') {
                $res = $response['value'];
                $statusCode = $res->getStatusCode();
                $etag = $res->getHeaderLine('ETag');
                
                // Debug info
                $debugInfo[$key] = [
                    'statusCode' => $statusCode,
                    'etag' => $etag,
                    'is304' => $statusCode === 304,
                    'cachedEtag' => $cacheKey ? cache($cacheKey) : null,
                    'hasCachedData' => !empty(cache($cacheKey . '_data')),
                    'cachedDataSampleCount' => is_array(cache($cacheKey . '_data')) ? count(cache($cacheKey . '_data')) : 'not array',
                ];
                
                // Proses data berdasarkan status code
                if ($statusCode !== 304) {
                    $data = json_decode($res->getBody(), true)['data'] ?? [];
                    // Simpan di cache dengan expiry lebih panjang (misal 1 jam)
                    cache([$cacheKey => $etag], now()->addHour());
                    cache([$cacheKey . '_data' => $data], now()->addHour());
                }
            } else {
                // Debug info untuk failed request
                $debugInfo[$key] = [
                    'state' => $response['state'],
                    'reason' => $response['reason'] ? $response['reason']->getMessage() : 'Unknown',
                    'cachedEtag' => $cacheKey ? cache($cacheKey) : null,
                    'hasCachedData' => !empty(cache($cacheKey . '_data')),
                    'cachedDataSampleCount' => is_array(cache($cacheKey . '_data')) ? count(cache($cacheKey . '_data')) : 'not array',
                ];
            }
        }
    
        $results = [];
        foreach ($responses as $key => $response) {
            $cacheKey = match($key) {
                'allNews' => 'etag_news',
                'popularNews' => 'etag_popular',
                'selectedTopics' => 'etag_topics',
            };
    
            if ($response['state'] === 'fulfilled') {
                $res = $response['value'];
                $statusCode = $res->getStatusCode();
                $etag = $res->getHeaderLine('ETag');
                
                if ($statusCode !== 304) {
                    $data = json_decode($res->getBody(), true)['data'] ?? [];
                    cache([
                        $cacheKey => $etag,
                        $cacheKey . '_data' => $data,
                    ], now()->addHour());
                    $results[$key] = $data;
                } else {
                    $results[$key] = cache($cacheKey . '_data') ?? [];
                }
            } else {
                $results[$key] = cache($cacheKey . '_data') ?? [];
            }
        }
        
        return $results;
    }
    
}