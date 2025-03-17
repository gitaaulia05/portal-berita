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
        $this->baseUrl = "http://127.0.0.1:8000/api";
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
        'Authorization' => $this->token
        ])->get($this->baseUrl . '/admin');
        

        return $response->successful() ? $response->json('data') : null;
    }

    public function logout (Request $request) {
     
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token
        ])->delete($this->baseUrl.'/admin/logout');

       return $response;
    }

}