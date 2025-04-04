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
     
    }

    public function index(){
      
      $newest=date('Y-m-d');
     // dd($newest);
      $newsResponse = $this->newsService->allNews($newest);
        $news =$newsResponse;
    
        return view('Pengguna.Main.newsMain'
              , [
            'auth' => $this->authUser,
            'headerNews' => collect($news['data'])->take(5),
            'sideNews' => collect($news['data'])->skip(5)->take(3),
            'newNews' => collect($news['data'])->skip(3)->take(4),
            'popularNews' =>collect($news['data']),
            'url' =>$news['url'],
           
        ]);
      
    }

    public function detailNews($slugBerita) {
        dd($slugBerita);
    }
}
