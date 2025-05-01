<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NewsServices;
use App\Services\AdminServices;
use App\Services\JurnalisServices;

class AdministratorController extends Controller
{
    public function __construct(AdminServices $adminService , NewsServices $newsService , JurnalisServices $jurnalisService) {
        $this->adminService = $adminService;
        $this->newsService = $newsService;   
        $this->jurnalisService = $jurnalisService;

        $this->currentPetugas = $this->adminService->currentAdmin();
            $newest = date('Y-m-d');
        $this->newsData = $this->newsService->allNews($newest);
        $this->url = config('services.api_url');
    }

    public function index() {
        return view('Administrator.Dashboard.index' , [
            'title' => 'Dashboard | Portal Berita WinniCode' , 
            'admin' => $this->currentPetugas,
        ]);
    }

    public function login(){

        return view('Administrator.Auth.login' , [
            "title" => 'Login | Portal Berita WinniCode'
        ]);
    }

    public function profile (){
        $hour  = now()->format('H');
        $greetings  = $hour < 12 ? 'Good Morning' : ($hour > 17 ? 'Good Afternoon' : ($hour > 20 ? 'Good Evening' : 'Good Night'));
     
        return view('Administrator.Dashboard.profile' , [
            "title" => 'Profile | Portal Berita WinniCode', 
            "admin" => $this->currentPetugas,
            "greetings" => $greetings
        ]);
    }

    public function authLogin(Request $request){
       // dd($request->all());
        $response = $this->adminService->login($request);
     
        if($response) {
            $token = $response['token'] ?? null;
            if($token) {
                session(['Authorization' => $token]);
                return redirect('/dashboard');
            } else {
                return redirect()->back()->with('message-error' , $response['message'][0]);
            }  
        } else {
            return redirect()->back()->with('message-error' , $response['message'][0]);
        }
    }

    public function register(){
        return view('Pengguna.Auth.register' , [
              "title" => 'Daftar Akun | Portal Berita WinniCode'
        ]);
    }

    public function forgetPassword(){
        return view('Pengguna.Auth.lupaPassword' , [
              "title" => 'Lupa Password | Portal Berita WinniCode'
        ]);
    }

    Public function logout(Request $request){
        $response = $this->adminService->logout($request);
        
        if($response->status() == 200){
            return redirect('/login-administrator');
        } else {
            return redirect()->back();
        }
    }


    // MAIN FEATURE
    public function dataJurnalis() {
        return view('Administrator.Dashboard.tableJurnalis' , [
            "title" => 'Data Jurnalis | Portal Berita WinniCode', 
            "admin" => $this->currentPetugas,
        ]);
    }

    public function detailJurnalis($slugJurnalis) {
        return view('Administrator.Dashboard.dataJurnalis' , [
            "title" => 'Data Jurnalis | Portal Berita WinniCode', 
            "admin" => $this->currentPetugas,
            "data" => $this->adminService->dataJurnalis($slugJurnalis),
            "url" => $this->url,
        ]);
    }

    Public function activeJurnalis(Request $request, $slugJurnalis){
         // dd($request->all());
         $response = $this->adminService->activeJurnalis($request , $slugJurnalis);
         if($response) {
            return redirect('/akun-jurnalis/'. $slugJurnalis)->with('message-success' , 'Aktivasi Akun Berhasil !');
         } else {
             return redirect()->back()->with('message-error' , $response['message'][0]);
         }
    }

    public function kelolaBerita() {
        return view('Administrator.Dashboard.kelolaBerita' , [
            "title" => 'Data Jurnalis | Portal Berita WinniCode', 
            "admin" => $this->currentPetugas,
            "dataBerita" => $this->newsData['data'],
            "url" => $this->url,
        ]);
    }


    public function detailNews($kategori, $slugBerita){
        $response = $this->newsService->detailNews($kategori, $slugBerita);
        $url = config('services.api_url');
        
        return view('Administrator.Dashboard.detailNews' , [
            "title" => 'Data Jurnalis | Portal Berita WinniCode', 
            "admin" => $this->currentPetugas,
            "dataBerita" => $response,
            "url" => $this->url,
            'gambar' => $url."/storage/" . $response['gambar'][0]['gambar_berita'],
            'gambar2' =>!empty($response['gambar'][0]['gambar_berita']) ? $url."/storage/" .$response['gambar'][0]['gambar_berita'] : null
        ]);

    }
}
