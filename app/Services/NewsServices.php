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

    public function allNews($newest) {
        $url = $this->baseUrl.'/berita/pengguna?' . http_build_query(['newest' => $newest]);
      
        return $this->fetchWithETag('etag_news' , $url);
    }


    public function selectedNews($newest) {
        $url = $this->baseUrl.'/berita/pengguna?' . http_build_query(['selectedTopics' => 'true','newest' => $newest]);
        //dd($url);
        return $this->fetchWithETag('etag_news' , $url);
    }

    
    public function detailNews($kategori , $slugBerita){
        $response = Http::withHeaders(['Accept' => 'application/json'])
        ->get($this->baseUrl.'/berita/'.$kategori.'/' .$slugBerita);
       
           return $response->successful() ? $response->json('data') : $response->json('errors');
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

    $results = [];

    foreach ($responses as $key => $response) {
        $cacheKey = match($key) {
            'allNews' => 'etag_news',
            'popularNews' => 'etag_popular',
            'selectedTopics' => 'etag_topics',
        };

        if ($response['state'] === 'fulfilled') {
            $res = $response['value'];
            $etag = $res->getHeaderLine('ETag');
            $data = json_decode($res->getBody(), true)['data'] ?? [];

            cache([
                $cacheKey => $etag,
                $cacheKey . '_data' => $data,
            ]);

            $results[$key] = $data;
        } else {
            $results[$key] = cache($cacheKey . '_data');
        }
    }

    return $results;

    }
}