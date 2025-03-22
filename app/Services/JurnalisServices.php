<?php
namespace App\Services;

use Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\BukuServices;
use Illuminate\Support\Facades\Http;

class JurnalisServices
{
    protected $baseUrl;
    protected $token;


    public function __construct(){
        $this->baseUrl = "http://127.0.0.1:8000/api";
        $this->token = session('Authorization');
    }

    public function login( Request $request) {
       // dd('hm');
        $response =  Http::post($this->baseUrl.'/jurnalis/login' , [
         'email' => $request->email ,
         'password' => $request->password
        ]);
          
        return $response->successful() ? $response->json('data') : $response->json('errors');
     }


     public function currentJurnalis() {

        //dd($this->token);
        $response = Http::withHeaders([
        'Authorization' => $this->token
        ])->get($this->baseUrl . '/jurnalis');
    
        return $response->successful() ? $response->json('data') : NULL;
    }

    public function logout (Request $request) {
     
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token
        ])->delete($this->baseUrl.'/jurnalis/logout');
       return $response;
    }

    public function storeNews(Request $request) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->asMultipart()->attach(
            'gambar', // Nama field di request
            file_get_contents($request->file('gambar')->getRealPath()), // Isi file
            $request->file('gambar')->getClientOriginalName() // Nama file
        )->attach(
            'gambar2', // Nama field di request
            file_get_contents($request->file('gambar2')->getRealPath()), // Isi file
            $request->file('gambar2')->getClientOriginalName())->post($this->baseUrl . '/jurnalis/addNews', [
            'judul_berita' => $request->judul_berita,
            'deks_berita' => $request->deks_berita,
            'kategori' => $request->kategori,
            'keterangan_gambar' => $request->keterangan_gambar,
            'keterangan_gambar2' => $request->keterangan_gambar2,
        ]);
       return $response->successful() ? $response->json('data') : $response->json('errors');
    }

}