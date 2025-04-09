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

    public function updatePassword() {
        return view('Pengguna.Main.changePassword' , [
            'auth' => $this->authUser,
            'url' => config('services.api_url'),
        ]);
    }
}
