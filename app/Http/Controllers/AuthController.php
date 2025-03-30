<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminServices;
use App\Services\JurnalisServices;
use App\Services\PenggunaServices;

class AuthController extends Controller
{

    public function __construct(PenggunaServices $penggunaService, JurnalisServices $jurnalisService, AdminServices $adminService) {
        $this->penggunaService = $penggunaService;
        $this->jurnalisService = $jurnalisService;
       
        $this->authUser = $this->penggunaService->currentUser();
        $this->authAdmin = $this->jurnalisService->currentjurnalis();
     
    }

    public function index(){
      //  dd( $this->authUser);
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
        dd($this->authAdmin['role']);
        return view('Pengguna.Auth.lupaPassword' , [
              "title" => 'Lupa Password | Portal Berita WinniCode' , 
              'auth' => $this->authUser || $this->authAdmin,
              'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : (isset($this->authAdmin) ? 'Template.asideJ' : 'Template.nav'),
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
                'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : (isset($this->authAdmin) ? 'Template.asideJ' : 'Template.nav'),
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
      dd($response);
        if($response['status'] === 200) {
            switch($response['role']) {
                case 1 :
                    return redirect('/login-administrator')->with('message-success' , 'Password Berhasil Diganti!');
                case 2 :
                    return redirect('/login-jurnalis')->with('message-success' , 'Password Berhasil Diganti!');
                case 'user' :
                    return redirect('/login')->with('message-success' , 'Password Berhasil Diganti!');
                default :
                return redirect('/login')->with('message-success' , 'Password Berhasil Diganti!');
            }
         
        }  elseif($response['status'] === 404) {
            return redirect('/login')->with('message-error' , $response['errors']['message'][0]);
        } else {
            $errors = array_map(fn($messages) => $messages[0], $response['errors']);

            return redirect()->back()->withInput()->withErrors($errors);
        }
    }
        // with auth 
    public function sendEmailAuth(Request $request){
        $response = $this->penggunaService->sendAuthEmail($request);
        $authCheck = $this->authUser ?? $this->authAdmin;
       // dd($authCheck);
        if(isset($response['data'])){

            return view('Pengguna.Auth.emailNotif' , [
                'title' => 'Password Reset | Portal Berita WinniCode',
                 'message1' => $response['data']['message'] ,
                 'email' => $response['data']['email'],
                 'message2' => $response['data']['message2'],
                 'auth' => $authCheck,
                 'jurnalis' => $authCheck,
                 'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : (isset($this->authAdmin) ? 'Template.asideJ' : 'Template.nav'),
            ]);

        } elseif(isset($response['errors'])) {
            return redirect()->back()->with('message-error',$response['errors']['message'][0]);
        }
    }

    public function changePassword ($token){
        $response = $this->penggunaService->passAuthView($token);
    //    dd($response['status']);
        $authCheck = $this->authUser ?? $this->authAdmin;
        if($response['status'] === 200) {
            return view('Pengguna.Auth.resetPasswordAuth' , [
                'title' => "Reset Password | Portal Berita WinniCode" , 
                'auth' => $this->authUser,
                'token' => $token,
                'auth' => $authCheck,
                'jurnalis' => $authCheck,
                'layout' => isset($this->authUser) ? 'Pengguna.Main.main' : (isset($this->authAdmin) ? 'Template.asideJ' : 'Template.nav'),
            ]);
        } else {
           $path = isset($this->authUser) ? 'profile' : '/jurnalis/profile';
            return redirect($path)->with('message-error' , $response['errors']['message']['0']);
        }
    }

    // with auth final
    public function updatePassword(Request $request , $token) 
    {
        $response = $this->penggunaService->updatePasswordAuth($request , $token);

        if($response->status() == 200) {
            $path = isset($this->authUser) ? 'profile' : '/jurnalis/profile';
          return redirect($path)->with('message-success' , 'Password Berhasil Diganti!');
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
