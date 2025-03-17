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
        $this->baseUrl = "http://127.0.0.1:8000/api";
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
               
        return $response;
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

        // dd( $response->json('data'));
        return $response;
    }

    public function passAuthView($token) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. $this->token
        ])->get($this->baseUrl.'/auth/token-ganti-password/' . $token);
            
        return $response->successful() ? $response->json('data') : $response->json('errors');
    }

    public function currentUser()
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer ".$this->token
        ])->get($this->baseUrl.'/pengguna/saatIni');
        
        return $response->successful() ? $response->json('data') : null;
    }
   
}