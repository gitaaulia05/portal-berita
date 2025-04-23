<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\penggunaServices;

class SaveNews extends Component
{
    public $search;

    public function __construct() {
        $this->penggunaService = app(penggunaServices::class);
         $this->apiBaseUrl = config('services.api_base_url');
         $this->dataBerita = $this->penggunaService->searchSaveNews();
    
     }

     public function updatedSearch(){
            $search = trim($this->search);
            $this->dataBerita =$this->penggunaService->searchSaveNews($search);
     }

    public function render()
    {
        return view('livewire.save-news' , [
            'title' => "Frofile Pengguna| Portal berita" , 
            'data' => $this->dataBerita,
            'url' =>  config('services.api_url'),
        ]);
    }
}
