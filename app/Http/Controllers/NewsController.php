<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsServices;
use Jorenvh\Share\ShareFacade;
use App\Services\PenggunaServices;

class NewsController extends Controller
{
 
    public function __construct(PenggunaServices $penggunaService, NewsServices $newsService) {
        $this->penggunaService = $penggunaService;
        $this->newsService = $newsService;
       
        $this->authUser = $this->penggunaService->currentUser();
        $newest=date('Y-m-d');
    
        $this->newsResult = $this->newsService->allNewsPopularAndTopics($newest);
     
        //  $this->popularNews2 = $this->newsResult['popularNews'];
        
        $this->news2 = [
            'data' => $this->newsResult['allNews']
        ];
       
        $this->selectedTopics2 = collect($this->newsResult['selectedTopics']['data'])
        ->filter(function ($item) {
            return isset($item['kategori_berita']) && trim($item['kategori_berita']) !== '';
        })
        ->groupBy('kategori_berita')
        ->toArray();    
    }

    public function header($kategori){
        $hasilLink =  $this->newsService->allNews($kategori)['data'];

        return view('Pengguna.Main.kategori', [
            'kategori' => $hasilLink,
            'relatedNews' => collect($this->newsService->relatedNews($kategori)['data'])->take(8),
             'url' => config('services.api_url'),
        ]);
    }

    public function index()
    {
        return view('Pengguna.Main.newsMain', [
                'headerNews' => collect($this->news2['data'])->take(5),
                'sideNews' => collect($this->news2['data'])->skip(5)->take(3),
                'newNews' => collect($this->news2['data'])->skip(3)->take(4),
               // 'popularNews' => collect($this->newsResult['popularNews']),
                'topicSelected' => collect( $this->selectedTopics2),
                'url' => config('services.api_url'),
        ]);
      
    }

    public function detailNews($kategori ,$slugBerita) {
        return view('Pengguna.Main.detailNews'
                , [
            'auth' => $this->authUser,
            'dataNews' => $this->newsService->detailNews($kategori , $slugBerita),
            'sideNews' => collect($this->news2['data'])->skip(5)->take(3),
            'newNews' => collect($this->news2['data'])->skip(3)->take(4),
            'relatedNews' => collect($this->newsService->relatedNews($kategori)['data'])->take(8),
            'url' =>config('services.api_url'),
        ]);
    }

    public function shareNews(){
        $shareComponent = ShareFacade::page(
            'https://www.positronx.io/create-autocomplete-search-in-laravel-with-typeahead-js/',
            'Your share text comes here',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp()        
        ->reddit();
        
        return view('Pengguna.Main.shareNews', compact('shareComponent'));
    }
}