<?php

namespace App\Http\Controllers;

use services;
use Illuminate\Http\Request;
use App\Services\JurnalisServices;

class JurnalisController extends Controller
{

    public function __construct(JurnalisServices $jurnalisService) {
        $this->jurnalisService = $jurnalisService;
        $this->currentPetugas = $this->jurnalisService->currentjurnalis();
        $this->url = config('services.api_url');
    }

    public function index(){ 
        return view('Jurnalis.Dashboard.index' , [
            'title' => "Dashboard Jurnalis | Portal berita" , 
            'jurnalis' => $this->currentPetugas,
        ]);
    }
    
    public function profile(){
       // dd($this->currentPetugas);
        return view('Jurnalis.Dashboard.profile' , [
            'title' => "Dashboard Jurnalis | Portal berita" , 
            'jurnalis' => $this->currentPetugas,
            'Url' => $this->url,
        ]);
    }

    public function register() {
        return view('Jurnalis.Auth.register' , [
            'title' => 'Register | Portal Berita'
        ]);
 }


    public function login(){
        return view('Jurnalis.Auth.login' , [
            "title" => 'Login | Portal Berita WinniCode'
        ]);
    }

    public function authRegister(Request $request){
        // dd($request->all());
         $response = $this->jurnalisService->register($request);
   
         if($response->successful()) {     
                 return redirect('/login-jurnalis')->with('message-success' ,'Daftar Akun Berhasil !');;
         } else {
            $error = $response->json('errors') ?? [];
             return redirect()->back()->withInput()->withErrors($error)->with('message-error', 'Daftar Akun Gagal !' );
         }
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

    public function updateProfile() {
        return view('Jurnalis.Dashboard.updateProfile' , [
            'title' => "Update Profile | Portal berita" , 
            'jurnalis' => $this->currentPetugas,
            'gambar' => !empty($this->currentPetugas['gambar']) ? $this->currentPetugas['gambar'] : asset('assets/avatars/face-1.jpg') ,
        ]);
    }

    public function storeProfile(Request $request, $slugAdmin) {
        $response = $this->jurnalisService->updateProfile($request , $slugAdmin);
        if($response){
            return redirect('/jurnalis/profile')->with('message-success' , 'Data Profile Berhasil Di Update !');
        } else {
            return redirect()->back();
        }
    }



    // MAIN FEATURE
    public function tambahBerita() {
        return view('Jurnalis.Dashboard.addNews' , [
            'title' => "Tambah Berita | Portal berita" , 
            'jurnalis' => $this->currentPetugas,
        ]);
    }

    public function update($slugBerita) {
        $response = $this->jurnalisService->showNews($slugBerita);
        $url = config('services.api_url');
        // dd($response);
        if($response) {
            return view('Jurnalis.Dashboard.changeNews' , [
                'title' => "Tambah Berita | Portal berita" , 
                'jurnalis' => $this->currentPetugas,
                'data' => $response,
                'gambar' => $url."/storage/" . $response['gambar'][0]['gambar_berita'],
                'gambar2' =>!empty($response['gambar'][0]['gambar_berita']) ? $url."/storage/" .$response['gambar'][0]['gambar_berita'] : null
            ]);
        } else {
            return redirect()->back()->with('message-error' , $response['message'][0]);
        }

    }

    public function updateNews(Request $request, $slugBerita) {

        $response = $this->jurnalisService->updateNews($request, $slugBerita);
        if($response) {
            return redirect('/dashboard-jurnalis')->with('message-success' , 'Data Berita Berhasil Di Update');
        } else {
            return redirect()->back()->withInput()->withErrors($response)->with('message-error' , 'Data Berita Gagal Di Update');
        }
    }

    public function storeNews(Request $request) {
        $response = $this->jurnalisService->storeNews($request);
       // dd(isset($response['errors']));
        if (isset($response['errors'])) {
            // gagal
            return redirect()->back()
                ->withInput()
                ->withErrors($response['errors'])
                ->with('message-error', 'Data Berita Gagal Ditambahkan!');
        }
        
            return redirect('/dashboard-jurnalis')->with('message-success' , 'Data Baru Berhasil Ditambahkan!');
      
    }


    public function softDelete(Request $request , $slugBerita){
      $response = $this->jurnalisService->softDelete($request, $slugBerita);

      if($response) {
        $path = ($this->currentPetugas == 2 ? '/dashboard-jurnalis' : '/kelola-berita'); 
        return redirect($path)->with('message-success' , 'Berita Berhasil Dihapus');
    } else {
        return redirect()->back()->with('message-error' , $response['message'][0]);
    }
    }

    public function restore(Request $request, $slugBerita) {
        $response = $this->jurnalisService->restore($request, $slugBerita);
        if($response) {
            $path = ($this->currentPetugas == 2 ? '/dashboard-jurnalis' : '/kelola-berita'); 
          return redirect($path)->with('message-success' ,$response['message']);
      } else {
          return redirect()->back()->with('message-error' , $response);
      }
    }
    public function delete($slugBerita) {
        $response = $this->jurnalisService->delete($slugBerita);
        if($response) {
            $path = ($this->currentPetugas == 2 ? '/dashboard-jurnalis' : '/kelola-berita'); 
          return redirect($path)->with('message-success' , 'Berita Berhasil Dihapus');
      } else {
          return redirect()->back()->with('message-error' , $response);
      }
    }

   

}
