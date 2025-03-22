<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JurnalisServices;

class JurnalisController extends Controller
{

    public function __construct(JurnalisServices $jurnalisService) {
        $this->jurnalisService = $jurnalisService;
        $this->currentPetugas = $this->jurnalisService->currentjurnalis();
    }

    public function index(){
        return view('Jurnalis.Dashboard.index' , [
            'title' => "Dashboard Jurnalis | Portal berita" , 
            'jurnalis' => $this->currentPetugas,
        ]);
    }


    public function login(){
        return view('Jurnalis.Auth.login' , [
            "title" => 'Login | Portal Berita WinniCode'
        ]);
    }

    
    public function authLogin(Request $request){
        // dd($request->all());
         $response = $this->jurnalisService->login($request);
      
         if($response) {
             $token = $response['token'] ?? null;
             if($token) {
                 session(['Authorization' => $token]);
                 return redirect('/dashboard-jurnalis');
             } else {
                 return redirect()->back()->with('message-error' , $response['message'][0]);
             }  
         } else {
             return redirect()->back()->with('message-error' , $response['message'][0]);
         }
     }

     Public function logout(Request $request){
        $response = $this->jurnalisService->logout($request);
        
        if($response->status() == 200){
            return redirect('/login-jurnalis');
        } else {
            return redirect()->back();
        }
    }

    public function tambahBerita() {
        return view('Jurnalis.Dashboard.addNews' , [
            'title' => "Tambah Berita | Portal berita" , 
            'jurnalis' => $this->currentPetugas,
        ]);
    }

    public function storeNews(Request $request) {
        $response = $this->jurnalisService->storeNews($request);
     
        if($response) {
            return redirect('/dashboard-jurnalis');
        } else {
            return redirect()->back()->with('message-error' , $response['message'][0]);
        }
    }
}
