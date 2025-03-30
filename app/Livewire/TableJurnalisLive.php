<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AdminServices;

class TableJurnalisLive extends Component
{

    public $search = '';
    public $url;
    public $dataJurnalis;

    public function __construct() {
        $this->adminService = app(AdminServices::class);
         //$this->jurnalisService = $jurnalisService;
        // $this->apiBaseUrl = config('services.api_base_url');
         $this->url = config('services.api_url');
         $this->dataJurnalis = $this->adminService->searchJurnalis();
         
     }
     public function updatedSearch() {
        $search = trim($this->search);
        $this->dataJurnalis = $this->adminService->searchJurnalis($search);
    }

    public function render()
    {
        return view('livewire.table-jurnalis-live' , [
            'data' => $this->dataJurnalis,
            'url' => $this->url
        ]);
    }
}
