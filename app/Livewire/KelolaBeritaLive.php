<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\NewsServices;
use App\Services\JurnalisServices;

class KelolaBeritaLive extends Component
{
    public $search;
    public $currentPage = 1;
    public $apiBaseUrl;
    protected $dataBerita=[];
   protected $jurnalisService;

   public $is_trash=0;
   public $is_tayang=0;

     public function __construct()
    {
        // Initialize the newsService here
        $this->jurnalisService = app(JurnalisServices::class);
          $this->apiBaseUrl = config('services.api_base_url');
          $this->dataBerita = $this->jurnalisService->searchNews();
            $this->currentPage = 1;
       
    }

        public function updatedSearch($page = 1){
            $search = trim($this->search);
            $is_tayangs = (int)$this->is_tayang;
            $is_trash= (int)$this->is_trash;
            $this->dataBerita = $this->jurnalisService->searchNews($search , $is_tayangs, $is_trash, $page);
   
        }

     public function toogleTayang() {
        $this->is_tayang = !$this->is_tayang;
        $this->updatedSearch(); 
    }
    
    public function toogleSoftDelete() {
        $this->is_trash = $this->is_trash === 0 ? 2 : 0;
        $this->updatedSearch(); 
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
