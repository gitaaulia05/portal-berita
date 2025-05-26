<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsServices;
use Jorenvh\Share\ShareFacade;
use App\Services\PenggunaServices;

class NewsController extends Controller
{
 
    protected $news2; 
    protected $newsResult; 
    protected $selectedTopics2; 

    public function __construct(PenggunaServices $penggunaService, NewsServices $newsService) {
        $this->penggunaService = $penggunaService;
        $this->newsService = $newsService;
       
        $this->authUser = $this->penggunaService->currentUser();

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
        $newest=date('Y-m-d');
        $this->newsResult = $this->newsService->allNewsPopularAndTopics($newest);

        $this->news2 = [
            'data' => $this->newsResult['allNews']
        ];
    
       
        $this->selectedTopics2 = collect($this->newsResult['selectedTopics']['data'])
        ->filter(function ($item) {
            return isset($item['kategori_berita']) && trim($item['kategori_berita']) !== '';
        })
        ->groupBy('kategori_berita')
        ->toArray();    

        return view('Pengguna.Main.newsMain', [
                'headerNews' => collect($this->news2['data'])->take(5),
                'sideNews' => collect($this->news2['data'])->skip(5)->take(3),
                'newNews' => collect($this->news2['data'])->skip(3)->take(4),
                'auth' =>  $this->authUser,
               'popularNews' => collect($this->newsResult['popularNews']),
                'topicSelected' => collect( $this->selectedTopics2),
                'url' => config('services.api_url'),
        ]);
      
    }

    public function detailNews($kategori ,$slugBerita) {
       $data =  $this->newsService->detailNews($kategori , $slugBerita);
       $url = config('services.api_url');

        $gambar1 = !empty($data['gambar'][0]['gambar_berita']) ? $url .'/storage/'. $data['gambar'][0]['gambar_berita'] : asset('assets/images/dummy.jpg');
        
        $caption1 = $data['gambar'][0]['keterangan_gambar']?? '';

        $gambar2 = !empty($data['gambar'][1]['gambar_berita']) ? $url .'/storage/'. $data['gambar'][1]['gambar_berita'] : asset('assets/images/dummy.jpg');

        $caption2 = $data['gambar'][1]['keterangan_gambar']?? '';

        $data['deks_berita'] = str_replace(
            ['&lt;gambar1&gt;', '&lt;gambar2&gt;'],
            [
                '<figure class="my-4 text-center">
                  <img src="' . $gambar1. '"class="rounded-lg w-full h-4/5">
                <figcaption class="mt-2 text-sm text-center text-gray-500 ">'.htmlspecialchars($caption1). '</figcaption>
                </figure>',
                
                '<figure class="my-4 text-center">
                <img src="' . $gambar2. '"class="rounded-lg w-full h-4/5">
              <figcaption class="mt-2 text-sm text-center text-gray-500 ">'.htmlspecialchars($caption2). '</figcaption>
              </figure>'
            ], 
            $data['deks_berita'] 
        );


        $newest=date('Y-m-d');
        $this->newsResult = $this->newsService->allNewsPopularAndTopics($newest);

        $this->news2 = [
            'data' => $this->newsResult['allNews']
        ];
   
   //  dd(collect($this->newsService->relatedNews($kategori)['data']['data'])->take(8));
        
        return view('Pengguna.Main.detailNews'
                , [
            'auth' => $this->authUser,
            'dataNews' => $data,
            'sideNews' => collect($this->news2['data'])->skip(5)->take(3),
            'newNews' => collect($this->news2['data'])->skip(3)->take(4),
            'relateNews' => collect($this->newsService->relatedNews($kategori)['data']['data'])->take(8),
            'url' =>config('services.api_url'),
        ]);
    }

}