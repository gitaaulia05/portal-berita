<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\NewsServices;

class KelolaBeritaLive extends Component
{
    public $search;
    public $currentPage = 1;
    public $apiBaseUrl;
    protected $dataBerita=[];
   protected $newsService;


     public function __construct()
    {
        // Initialize the newsService here
        $this->newsService = app(NewsServices::class);
          $this->apiBaseUrl = config('services.api_base_url');
          $this->dataBerita = $this->newsService->allNews();
            $this->currentPage = 1;
       
    }


        public function updatedSearch($page = 1){
            $search = trim($this->search);
            $this->dataBerita = $this->newsService->allNews('' , $this->currentPage, $search);
        
          
        }

        public function goToPage($page){
            $this->currentPage = $page;
            $this->updatedSearch($page);
        }

    public function render()
    {
   
        return view('livewire.kelola-berita-live' , [
            "berita" => $this->dataBerita['data']['data'] ?? $this->dataBerita['data'],
            "meta" => $this->dataBerita['data']['meta'] ??$this->dataBerita['meta'] 
        ]);
    }
}
