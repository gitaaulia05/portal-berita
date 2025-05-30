<?php
namespace App\Services;

use Log;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\BukuServices;
use Illuminate\Support\Facades\Http;

class PenggunaServices 
{
    protected $baseUrl;
    protected $token;


    public function __construct(){
        $this->baseUrl = config('services.api_base_url');;
        $this->token = session('Authorization');
    }
    
    
    public  function login(Request $request){
        $response = Http::post($this->baseUrl.'/pengguna/login' , [
            'email' => $request->email,
            'password' => $request->password
        ]);
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }

  
    public function register(Request $request) {
        $response = Http::post($this->baseUrl.'/pengguna' , [
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        return $response;
    }

    public function logout (Request $request) {
        $response = Http::withHeaders([
            'Authorization' => "Bearer ".$this->token
        ])->delete($this->baseUrl.'/pengguna/logout');
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }


    public function updateData(Request $request, $slugPengguna) {
        $httpRequest = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->asMultipart();

        if($request->hasFile('gambar')) {
            $httpRequest->attach(
                'gambar', file_get_contents($request->file('gambar')->getRealPath()),
                $request->file('gambar')->getClientOriginalName()
            );
        }
        
        $response = $httpRequest->post($this->baseUrl.'/pengguna/'.$slugPengguna , [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'pekerjaan' => $request->pekerjaan,
        ]);
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    public function sendEmail(Request $request){
        $response = Http::withHeaders([
            'Authorization' => 'Beaerer ' . $this->token
        ])->post($this->baseUrl.'/gantiPassword' , [
            'email' => $request->email
        ]);
        return $response;
    }

    public function tokenCheck($token) 
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post($this->baseUrl.'/pengguna/token-check/'. $token);
               
        return $response;
    }

    public function updatePassword(Request $request , $token)
    {
        
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->patch($this->baseUrl.'/lupa-password/'. $token , [
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
          
        return [
            'status' => $response->status(),
            'data' => $response->json('data'),
            'errors' => $response->json('errors'),
        ];
    }

    public function updatePasswordAuth(Request $request , $token) 
    {

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->patch($this->baseUrl.'/auth/lupa-password-store/'.$token , [
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        return $response;
    }


    public function sendAuthEmail(Request $request) {
       
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post($this->baseUrl.'/auth/gantiPasswordPengguna' , [
            'email' => $request->email
        ]);
        return $response;
    }

    public function passAuthView($token) {
       
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $this->token
        ])->get($this->baseUrl.'/auth/token-ganti-password/' . $token);
            return [
            'status' => $response->status(),
            'data' => $response->json('data'),
            'errors' => $response->json('errors'),
        ];
    }

    public function currentUser()
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer ".$this->token
        ])->get($this->baseUrl.'/pengguna/saatIni');
        
        return $response->successful() ? [
           'data' =>$response->json('data'),
           'url' => config('services.api_url'),

        ] : null;
    }

    public function searchSaveNews($judul_berita =null , $page = null){
            $params=[];

            if(!empty($page)){
                $params['page'] = $page;
            }
            if(!empty($judul_berita)){
                $params['judul_berita'] = $judul_berita;
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token
            ])->get($this->baseUrl.'/pengguna/simpanBerita', $params);

            return $response->successful() ? $response->json() : null;
    }


    public function saveNews(Request $request, $slugBerita) 
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->post($this->baseUrl.'/pengguna/simpanBerita/'. $slugBerita);
       
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    public function deleteNews(Request $request, $slugBerita) 
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token
        ])->delete($this->baseUrl.'/pengguna/hapusSimpanBerita/'. $slugBerita);
       
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }
   
}