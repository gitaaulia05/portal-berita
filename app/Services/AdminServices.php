<?php
namespace App\Services;

use Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\BukuServices;
use Illuminate\Support\Facades\Http;

class AdminServices
{
    protected $baseUrl;
    protected $token;


    public function __construct(){
        $this->baseUrl = config('services.api_base_url');
        $this->token = session('Authorization');
    }

    public function login( Request $request) {
       $response =  Http::post($this->baseUrl.'/admin/login' , [
        'email' => $request->email ,
        'password' => $request->password
       ]);

       return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    public function currentAdmin() {
        $response = Http::withHeaders([
        'Authorization' => 'Bearer '.$this->token
        ])->get($this->baseUrl . '/administrator');
     
        return $response->successful() ? $response->json('data') : null;
    }

    public function logout (Request $request) {
     
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token
        ])->delete($this->baseUrl.'/admin/logout');

       return $response;
    }


    // MAIN FEATURE
    public function searchJurnalis($namaJurnalis = null , $page=null, $is_active = null) {
      
        $params = [];
        if(!empty($namaJurnalis)) {
            $params['nama'] = $namaJurnalis;
        }

         if(!empty($page)) {
            $params['page'] = $page;
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->get($this->baseUrl.'/admin/jurnalis/search' , $params);
       
     // dd($this->baseUrl.'/admin/jurnalis/search' , $params);
        return $response->successful() ? $response->json() : $response->json('error');
    }

    public function dataJurnalis($slugJurnalis) {
        $response = Http::withHeaders([
        'Authorization' => $this->token
        ])->get($this->baseUrl . '/admin/jurnalis/'.$slugJurnalis);
        
        return $response->successful() ? $response->json('data') : null;
    }


    public function activeJurnalis( Request $request, $slugJurnalis) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token
        ])->post($this->baseUrl.'/jurnalis/active/'.$slugJurnalis,[
            'slug' => $slugJurnalis,
            'active' => $request->activeAccount
        ]);
       return $response->successful() ? $response->json('data') : $response->json('errors');
    }

}