<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenggunaServices;

class AuthController extends Controller
{

    public function __construct(PenggunaServices $penggunaService) {
        $this->penggunaService = $penggunaService;
        $this->authUser = $this->penggunaService->currentUser();
    }

    public function index(){
        return view('Pengguna.Main.newsMain' , [
            'auth' => $this->authUser,
        ]);
    }

    //done
    public function login(){
        return view('Pengguna.Auth.login' , [
            "title" => 'Login | Portal Berita WinniCode'
        ]);
    }

       //done
    public function authLogin(Request $request){
       // dd($request->all());
        $response = $this->penggunaService->login($request);
      
        if($response) {
            $token = $response['token'] ?? null;
            if($token) {
                session(['Authorization' => $token]);
                    return redirect('/');
            } else {
                return redirect()->back()->with('message-error' , $response['message'][0]);
            }  
        } else {
            return redirect()->back()->with('message-error' , $response['message'][0]);
        }
    }
   //done
    public function register(){
        return view('Pengguna.Auth.register' , [
              "title" => 'Daftar Akun | Portal Berita WinniCode'
        ]);
    }

    public function storeRegister(Request $request)
    {
        $response = $this->penggunaService->register($request);
    
        if($response->status() == 201){
            return redirect('/login')->with('message-success' , 'Akun Berhasil Dibuat Silahkan Login!');
        } else {
            $erorrs = $response->json('errors');
            return redirect()->back()->withErrors($erorrs)->withInput();
        }
    }

       //done
    public function forgetPassword(){
        return view('Pengguna.Auth.lupaPassword' , [
              "title" => 'Lupa Password | Portal Berita WinniCode' , 
              'auth' => $this->authUser,
              'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : 'Template.nav',
        ]);
    }

    public function sendEmail(Request $request){
        $response = $this->penggunaService->sendEmail($request);
   
        if(isset($response['data'])){
            return view('Pengguna.Auth.emailNotif' , [
                'title' => 'Password Reset | Portal Berita WinniCode',
                 'message1' => $response['data']['message'] ,
                 'email' => $response['data']['email'],
                 'message2' => $response['data']['message2'],
                'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : 'Template.nav',
                'auth' => $this->authUser ,

            ]);
        } elseif(isset($response['errors'])) {
           
            return redirect()->back()->with('message-error',$response['errors']['message'][0]);
        }
    }

    public function viewCheck($token){
          $response = $this->penggunaService->tokenCheck($token);
          if($response->status() == 200) {
            return view('Pengguna.Auth.resetPasswordNoAuth' , [
                'title' => "Reset Password | Portal Berita WinniCode" , 
                'token' => $token
            ]);
          } else {
            return redirect('/login')->with('message-error' , $response['message']);
          }
    }

    // no auth final
    public function storePassword(Request $request , $token) 
    {
        $response = $this->penggunaService->updatePassword($request , $token);
        if($response->status() == 200){
          return redirect('/login')->with('message-success' , 'Password Berhasil Diganti!');
        } elseif($response->status() == 404) {
            return redirect()->back()->with('message-error' , $response['errors']['message'][0]);
        } else {
            return redirect()->back()->with('message-error' , $response['errors']['message'][0]);
        }
    }


        // no auth 
    public function sendEmailAuth(Request $request){
        $response = $this->penggunaService->sendAuthEmail($request);
        if(isset($response['data'])){
            return view('Pengguna.Auth.emailNotif' , [
                'title' => 'Password Reset | Portal Berita WinniCode',
                 'message1' => $response['data']['message'] ,
                 'email' => $response['data']['email'],
                 'message2' => $response['data']['message2'],
                 'auth' => $this->authUser,
                 'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : 'Template.nav',
            ]);

        } elseif(isset($response['errors'])) {
            return redirect()->back()->with('message-error',$response['errors']['message'][0]);
        }
    }

    public function changePassword ($token){
        $response = $this->penggunaService->passAuthView($token);
       
        if($response == true) {
            return view('Pengguna.Auth.resetPasswordAuth' , [
                'title' => "Reset Password | Portal Berita WinniCode" , 
                'auth' => $this->authUser,
                'token' => $token,
                'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : 'Template.nav',
            ]);
        } else {
           
            return redirect()->back()->with('message-error' , $response['message']['0']);
        }
    }

    // with auth final
    public function updatePassword(Request $request , $token) 
    {
        $response = $this->penggunaService->updatePasswordAuth($request , $token);
        if($response->status() == 200){
          return redirect('/')->with('message-success' , 'Password Berhasil Diganti!');
        } elseif($response->status() == 404) {
            return redirect()->back()->with('message-error' , $response['errors']['message'][0]);
        } else {
            return redirect()->back()->with('message-error' , $response['errors']['message'][0]);
        }
    }

    Public function logout(Request $request){
        $response = $this->penggunaService->logout($request);
        if($response){
            return redirect('/login');
        } else {
            return redirect()->back();
        }
    }
}
