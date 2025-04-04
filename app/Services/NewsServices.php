<?php
namespace App\Services;

use Log;
use GuzzleHttp\Client;
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

    public function allNews($newest) {
        // Mengambil nilai ETag dari cache
        $etag = cache('etag_news');
        // Memeriksa apakah ada ETag yang tersimpan dalam cache
      //dd($etag);
        $response = $etag 
            ? Http::withHeaders(['If-None-Match' => $etag])->get($this->baseUrl.'/berita/pengguna?' . http_build_query(['newest' => $newest]))
            : Http::get($this->baseUrl.'/berita/pengguna?' . http_build_query(['newest' => $newest]));

         //   $response = Http::get($this->baseUrl.'/berita/pengguna?' . http_build_query(['newest' => $newest]));
      
        // Memeriksa apakah response berhasil
      
        if ($response->status() === 200 ) {
            $response->json('data');
          //  dd( $response->json('data'));
            // Ambil nilai ETag dari header response
            $etagHeader = $response->header('ETag');
            $newsData = $response->json('data');

            cache()->forget('etag_news');
            cache()->forget('news_data');

            // Simpan nilai ETag dalam cache
            cache(['etag_news' => $etagHeader]);
            cache(['news_data' => $newsData]);
            return [
                'data' => $newsData, 
                'url' => $this->url,
            ];
        }
      

        if($response->status() === 304) {
            $cacheNews = cache('news_data');
            if($cacheNews) {
                return [
                    'data' => $cacheNews,
                    'url' => $this->url,
                    'from_cache' => true
                ];
            }

        }
        dd($response->status());
        return $response->json('errors');
        // Mengembalikan data jika response berhasil, atau errors jika gagal
        // return $response->successful() ? [
        //     'data' => $response->json('data'), 
        //     'url' => $this->url,
        // ] : $response->json('errors');
    }
    

}