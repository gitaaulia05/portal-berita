<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsServices;
use App\Services\PenggunaServices;

class NewsController extends Controller
{
    public function __construct(PenggunaServices $penggunaService, NewsServices $newsService) {
        $this->penggunaService = $penggunaService;
        $this->newsService = $newsService;
       
        $this->authUser = $this->penggunaService->currentUser();
        $newest=date('Y-m-d');
        $newsResponse = $this->newsService->allNews($newest);
       
        $this->news = $newsResponse;

        $this->selectedTopics = collect($this->newsService->selectedNews($newest)['data']['data'])->groupBy('kategori_berita')->toArray();
     
    }

    public function index(){
        return view('Pengguna.Main.newsMain'
              , [
            'auth' => $this->authUser,
            'headerNews' => collect($this->news['data'])->take(5),
            'sideNews' => collect($this->news['data'])->skip(5)->take(3),
            'newNews' => collect($this->news['data'])->skip(3)->take(4),
            'popularNews' => collect($this->newsService->popularNews()['data']),
            'topicSelected' => $this->selectedTopics,
            'url' =>$this->news['url'],
        ]);
      
    }

    public function detailNews($kategori ,$slugBerita) {
       
      //  dd($this->newsService->detailNews($kategori , $slugBerita));
        return view('Pengguna.Main.detailNews'
                , [
            'auth' => $this->authUser,
            'dataNews' => $this->newsService->detailNews($kategori , $slugBerita),
            'sideNews' => collect($this->news['data'])->skip(5)->take(3),
            'newNews' => collect($this->news['data'])->skip(3)->take(4),
            'relatedNews' => collect($this->newsService->relatedNews($kategori)['data'])->take(8),
            'url' =>$this->news['url'],
            
        ]);
    }
}
