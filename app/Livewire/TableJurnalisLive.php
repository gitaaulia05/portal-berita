<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AdminServices;

class TableJurnalisLive extends Component
{

    public $search;
    public $url;
    public $dataJurnalis;
    public $currentPage =1;
    public $page;

    public function __construct() {
        $this->adminService = app(AdminServices::class);
         //$this->jurnalisService = $jurnalisService;
        // $this->apiBaseUrl = config('services.api_base_url');
         $this->url = config('services.api_url');
        
        $this->dataJurnalis = $this->adminService->searchJurnalis('' , $this->currentPage);
         
     }
     public function updatedSearch($this->page = 1) {
        $search = trim($this->search);
       dd($this->page, $this->search);
        $this->dataJurnalis = $this->adminService->searchJurnalis($search , $this->page);
    }

    public function goToPage($this->page) {

        $this->currentPage = $this->page;
        $this->updatedSearch($this->page);
    }

    public function render()
    {
        return view('livewire.table-jurnalis-live' , [
            'data' => $this->dataJurnalis['data'] ?? dd($this->dataJurnalis),
            'meta' => $this->dataJurnalis['meta'],
            'url' => $this->url
        ]);
    }
}
