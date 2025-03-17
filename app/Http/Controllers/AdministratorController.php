<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminServices;

class AdministratorController extends Controller
{
    public function __construct(AdminServices $adminService) {
        $this->adminService = $adminService;
        $this->currentPetugas = $this->adminService->currentAdmin();
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
}
