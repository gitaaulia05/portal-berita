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
            return view('Pengguna.Main.profile' , [
                'auth' => $this->authUser,
                'url' => config('services.api_url'),
            ]);
    }

    public function update($slugPengguna) {
        $pendidikan = ['SD' , 'SMP' , 'SMA/Sederajat' , 'S1' , 'S2' , 'S3'];
        return view('Pengguna.Main.UpdatePrimary' , [
            'auth' => $this->authUser,
            'url' => config('services.api_url'),
            'pendidikanTerakhir' => $pendidikan,
        ]);
    }

    public function updateStore(Request $request, $slugPengguna) {
        $response = $this->penggunaService->updateData($request, $slugPengguna);

        if($response->successful()){
            return redirect('/pengguna/')->with('message-sucess' , 'Berhasil Update Informasi Akun!');
        } else {
            return redirect()->back()->withInput()->withErrors($response->json['errors'])->with('message-erorr' , 'Update Informasi Akun Gagal!');
        }
    }

    public function updatePassword() {
        return view('Pengguna.Main.changePassword' , [
            'auth' => $this->authUser,
            'url' => config('services.api_url'),
        ]);
    }
}
