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
    protected $urlMain;
    protected $token;


    public function __construct(){
        $this->baseUrl = config('services.api_base_url');
       # $this->urlMain = "http://127.0.0.1:8000/";
        $this->urlMain =config('services.api_url');;
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

     public function register(Request $request) {
        $response =  Http::post($this->baseUrl.'/jurnalis' , [
            'nama' => $request->nama ,
            'email' => $request->email ,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
           ]);
        
           return $response;
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

    public function updateProfile(Request $request, $slugAdmin) {
  
        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token
        ])->asMultipart();

        if($request->hasFile('gambar')) {
            $httpRequest->attach(
                'gambar', 
                file_get_contents($request->file('gambar')->getRealPath()), 
                $request->file('gambar')->getClientOriginalName()
              );
        }
        
       $response=  $httpRequest->post($this->baseUrl.'/jurnalis/update/'.$slugAdmin , [
            'nama' => $request->nama
        ]);
       return $response->successful() ? $response->json('data') : $response->json('errors');
    }


    // MAIN FEATURE

    public function storeNews(Request $request) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ]);

        if($request->hasFile('gambar') && $request->hasFile('gambar') !== null){
            $response->attach(
                'gambar', // Nama field di request
                file_get_contents($request->file('gambar')->getRealPath()), // Isi file
                $request->file('gambar')->getClientOriginalName());
        }

        if($request->hasFile('gambar2') && $request->hasFile('gambar2') !== null){
            $response->attach(
                'gambar2', // Nama field di request
                file_get_contents($request->file('gambar2')->getRealPath()), // Isi file
                $request->file('gambar2')->getClientOriginalName());
        }
        
        $response =$response->post($this->baseUrl . '/jurnalis/addNews', [
            'judul_berita' => $request->judul_berita,
            'deks_berita' => $request->deks_berita,
            'id_kategori_berita' => $request->kategori,
            'keterangan_gambar' => $request->keterangan_gambar,
            'keterangan_gambar2' => $request->keterangan_gambar2,
        ]);
       return $response->successful() ? $response->json('data') : $response->json();
    }

    public function updateNews(Request $request , $slugBerita)
    {
       $httpRequest = Http::withHeaders([
        'Authorization' => 'Bearer ' . $this->token
    ])->asMultipart();

        if($request->hasFile('gambar') && $request->hasFile('gambar') !== null ){
          $httpRequest->attach(
            'gambar', 
            file_get_contents($request->file('gambar')->getRealPath()), 
            $request->file('gambar')->getClientOriginalName()
          );
          $payload['keterangan_gambar'] = $request->keterangan_gambar;
        } elseif( $request->filled('keterangan_gambar')) {
            $payload['gambar_lama'] = $request->gambar_lama;
             $payload['keterangan_gambar'] = $request->keterangan_gambar;
      }

        if($request->hasFile('gambar2') &&  $request->hasFile('gambar2') !== null)  {
            if($request->hasFile('gambar2')){
                $httpRequest->attach(
                    'gambar2', 
                    file_get_contents($request->file('gambar2')->getRealPath()), 
                    $request->file('gambar2')->getClientOriginalName()
                  );
             
                  $payload['keterangan_gambar2'] = $request->keterangan_gambar2;
            }
          } elseif( $request->filled('keterangan_gambar2')) {
            
        if ($request->filled('gambar_lama2')) {
            $payload['gambar_lama2'] = $request->gambar_lama2;
        }
            $payload['keterangan_gambar2'] = $request->keterangan_gambar2;
          }

          $payload = ($payload ?? []) +[
            'judul_berita' => $request->judul_berita,
            'deks_berita' => $request->deks_berita,
            'kategori' => $request->kategori,    
              ];


     $response = $httpRequest->post($this->baseUrl . '/jurnalis/updateNews/'.$slugBerita, $payload);
         
   return $response->successful() ? $response->json('data') : $response->json('errors');
      
    }

    public function searchNews($judul_berita = null, $is_tayang = null , $is_trash = null) {
       
        $params = [];
        if(!empty($judul_berita)) {
            $params['judul_berita'] = $judul_berita;
        }

        if(!empty($is_tayang)) {
            $params['is_tayang'] = $is_tayang;
        }

        if(!empty($is_trash)) {
            $params['is_tayang'] = $is_trash;
           // dd($this->baseUrl.'/berita' , $params);
        }
       // dd($params);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->get($this->baseUrl.'/berita' , $params);
       
        return $response->successful() ? $response->json('data') : null;
    }

    public function showNews($slugBerita) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->token
        ])->get($this->baseUrl.'/jurnalis/berita/'.$slugBerita);
       return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    public function softDelete(Request $request, $slugBerita)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .$this->token
        ])->post($this->baseUrl.'/beritaJurnalis/delete/'.$slugBerita);
    
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }


    public function delete($slugBerita)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .$this->token
        ])->post($this->baseUrl.'/beritaJurnalis/deleteForce/'.$slugBerita);

        return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    public function restore(Request $request, $slugBerita)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' .$this->token
        ])->post($this->baseUrl.'/beritaJurnalis/restore/'.$slugBerita);
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    

}