<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Administrator;
use App\Services\JurnalisServices;

class BeritaLive extends Component
{
    public $search;
    public $is_tayang = 0;
    public $is_trash = 0;
    public $currentPage;

    protected $id_admin;

    protected $jurnalisService;
    protected $dataBerita=[];
    public $apiBaseUrl;
    

    public function __construct() {
       $this->jurnalisService = app(JurnalisServices::class);
        //$this->jurnalisService = $jurnalisService;
        $this->apiBaseUrl = config('services.api_base_url');
        $this->dataBerita = $this->jurnalisService->searchNews('' , 0 , 0, 1);
        $this->currentPage = 1;
    }

    public function toogleTayang() {
        $this->is_tayang = !$this->is_tayang;
        $this->updatedSearch(); 
    }
   

    public function toogleSoftDelete() {
        $this->is_trash = $this->is_trash === 0 ? 2 : 0;
        $this->updatedSearch(); 
    }

    public function updatedSearch($page = 1) {

        $search = trim($this->search);
        $is_tayangs = (int)$this->is_tayang;
        $is_trash= (int)$this->is_trash;
        $this->dataBerita = $this->jurnalisService->searchNews($search , $is_tayangs, $is_trash, $page)['data'];
        $this->id_admin = Administrator::where('id_administrator');
      
    }

    public function goToPage($page){
            $this->currentPage = $page;
            $this->updatedSearch($page);
    }       

    public function render()
    {

         return view('livewire.berita-live' , [
            'title' => "Dashboard Jurnalis | Portal berita" , 
            'jurnalis' => $this->jurnalisService->currentJurnalis(), 
            'berita' => $this->dataBerita['data'],
            'meta' => $this->dataBerita['meta'],
            'status' =>$this->dataBerita['status'],
            'url' =>  config('services.api_url')
        ]);
    }

    public function softDelete(Request $request , $slugBerita){
        $response = $this->jurnalisService->softDelete($request, $slugBerita);
        if($response) {
          return redirect('/dashboard-jurnalis')->with('message-success' , $response['message']);
      } else {
          return redirect()->back()->with('message-error' , $response);
      }

    }

    public function delete($slugBerita) {
        $response = $this->jurnalisService->delete($slugBerita);
        if($response) {
          return redirect('/dashboard-jurnalis')->with('message-success' , 'Berita Berhasil Dihapus');
      } else {
          return redirect()->back()->with('message-error' , $response);
      }
    }

    public function restore($slugBerita) {
        $response = $this->jurnalisService->restore($slugBerita);
        if($response) {
          return redirect('/dashboard-jurnalis')->with('message-success' ,$response['message']);
      } else {
          return redirect()->back()->with('message-error' , $response);
      }
    }

}
