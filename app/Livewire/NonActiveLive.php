<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\AdminServices;

class NonActiveLive extends Component
{

    public $search;
    public $url;
    public $dataJurnalis;
    public $currentPage =1;
    public $page;
    public $is_active;

    public function __construct() {
        $this->adminService = app(AdminServices::class);
         $this->url = config('services.api_url');
        $this->dataJurnalis = $this->adminService->searchJurnalis('' , $this->currentPage, $this->is_active , 'true');
     }

       public function updatedSearch(){
            $search = trim($this->search);
           $this->dataJurnalis = $this->adminService->searchJurnalis($search , $this->currentPage, $this->is_active, 'true');
        }

    public function goToPage($page) {
        $this->currentPage = $page;
        $this->updatedSearch($page);
    }


    public function render()
    {
        return view('livewire.non-active-live' ,[
            'data' => $this->dataJurnalis['data'] ,
            'meta' => $this->dataJurnalis['meta'],
            'total' => $this->dataJurnalis['meta']['total'],
            'url' => $this->url
        ]);
    }
}
