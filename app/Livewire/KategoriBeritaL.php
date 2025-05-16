<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\NewsServices;
use Illuminate\Support\Facades\Http;

class KategoriBeritaL extends Component
{
    protected $dataKB =[];
    public $currentPage;
    public $search;
    public $token;
    public $baseUrl;
    protected  $newsService;


    public function mount(){

     $this->baseUrl = config('services.api_base_url');
        $this->url = config('services.api_url');
        $this->token = session('Authorization');

        $this->apiBaseUrl = config('services.api_base_url');
        $this->currentPage = 1;
        $this->dataKB = $this->dataKategori();
     
    }

    public function updatedSearch(){
        $search = trim($this->search);
        $this->dataKB = $this->dataKategori($search,   $this->currentPage);
    }

    public function goToPage($page){
        $this->currentPage = $page;
        $this->updatedSearch($page);
    }

    public function render()
    {
        return view('livewire.kategori-berita-l' , [
            'data' => $this->dataKB['data'], 
            'meta' => $this->dataKB['meta']
        ]);
    }

       public function dataKategori($search = null, $page = null){
    
        $params= [];
        if(!empty($page)){
        $params['page'] = $page;
        }

         if(!empty($search)){
        $params['kategori'] = $search;
        }
     
            $response = Http::withHeaders([
                'Authorization' => "Bearer ". $this->token,
            ])->get($this->baseUrl."/kategoriBerita?" .http_build_query($params));
         
            return $response->successful() ? $response->json() : null;
     }


}
