<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenggunaServices;

class PenggunaController extends Controller
{

    public function __construct(PenggunaServices $penggunaService) {
        $this->penggunaService = $penggunaService;
        $this->authUser = $this->penggunaService->currentUser();
    }

    public function index() {
      //  dd($this->authUser['data']['alamat']);
            return view('Pengguna.Main.profile' , [
                'auth' => $this->authUser,
                'url' => config('services.api_url'),
            ]);
    }

    public function update($slugPengguna) {
        //dd($this->authUser['data']);
        $pendidikan = ['SD' , 'SMP' , 'SMA/Sederajat' , 'S1' , 'S2' , 'S3'];
        return view('Pengguna.Main.UpdatePrimary' , [
            'auth' => $this->authUser,
            'url' => config('services.api_url'),
            'pendidikanTerakhir' => $pendidikan,
        ]);
    }

    public function updateStore(Request $request, $slugPengguna) {
        $response = $this->penggunaService->updateData($request, $slugPengguna);

        if($response){
            return redirect('/profile/pengguna')->with('message-success' , 'Berhasil Update Informasi Akun!');
        } else {
            return redirect()->back()->withInput()->withErrors($response->json['errors'])->with('message-error' , 'Update Informasi Akun Gagal!');
        }
    }

    public function updatePassword() {  
       
        return view('Pengguna.Main.changePassword' , [
            'auth' => $this->authUser,
            'url' => config('services.api_url'),
        ]);
    }

    public function saveNews(Request $request, $kategori, $slugBerita){
        $response = $this->penggunaService->saveNews($request, $slugBerita);
        if($response){
            return redirect('/berita/'. $kategori.'/'.$slugBerita)->with('toast-sucess' , $response);
        } else {
            return redirect('/berita/'. $kategori.'/'.$slugBerita)->with('toast-erorr' , $response['message']);
        }
    }

    public function deleteNews(Request $request, $kategori, $slugBerita){
        $response = $this->penggunaService->deleteNews($request, $slugBerita);
        if($response){
            return redirect('/berita/'. $kategori.'/'.$slugBerita)->with('toast-sucess' , $response);
        } else {
            return redirect('/berita/'. $kategori.'/'.$slugBerita)->with('toast-erorr' , $response['message']);
        }
    }

    
}
