<?php

use App\Livewire\BeritaLive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\JurnalisMiddleware;
use App\Http\Middleware\PenggunaMiddleware;
use App\Http\Controllers\JurnalisController;
use App\Http\Controllers\PenggunaController;
use App\Http\Middleware\UniversalMiddleware;
use App\Http\Middleware\AdministratorMiddleware;
use App\Http\Controllers\AdministratorController;
use App\Http\Middleware\ActiveJurnalisMiddleware;


// TestTest1&
Route::get('/',[NewsController::class , 'index']);
Route::get('/berita/{kategori}/{slugberita}',[NewsController::class , 'detailNews']);
Route::get('/beritaKategori/{kategori}/{page}',[NewsController::class , 'goToPage']);

Route::get('/berita/{kategori}',[NewsController::class , 'header']);
Route::get('/bagikanTautan' , [NewsController::class, 'shareNews']);

    Route::middleware(LoginMiddleware::class)->group(function () {
                // AUTH USER
        Route::get('/login' , [AuthController::class , 'login']);    
        Route::post('/authLogin' ,[AuthController::class , 'authLogin']);

                // AUTH ADMINISTRATOR   
        Route::get('/login-administrator' , [AdministratorController::class , 'login']);
        Route::post('/authAdmin' , [AdministratorController::class , 'authLogin']);

        // AUTH JURNALIS
        Route::get('/login-jurnalis' , [JurnalisController::class , 'login']);
        Route::post('/authJurnalis' , [JurnalisController::class , 'authLogin']);
    });

    Route::get('/register' , [AuthController::class , 'register']);
    Route::post('/simpan-akun', [AuthController::class , 'storeRegister']);

    Route::get('/lupa-password' , [AuthController::class , 'forgetPassword']);

    // sending email
    Route::post('/lupa-password-email' ,  [AuthController::class , 'sendEmail']);

    // check token before passing to view
    Route::get('/ganti-password/{token}' , [AuthController::class , 'viewCheck']);

    // store new password to db 
    Route::patch('/simpan-password/{token}' ,  [AuthController::class , 'storePassword']);

    Route::middleware(UniversalMiddleware::class)->group(function () {
         Route::get('/administrator/update-profile/{slugAdmin}' , [JurnalisController::class, 'updateProfile'])->name('jurnalis-update');
         Route::post('/administrator/simpan-update-profile/{slugAdmin}' ,  [JurnalisController::class, 'storeProfile'])->name('jurnalis-update');
         
            //View Password forget
            Route::get('/lupa-passwordAuth' , [AuthController::class , 'forgetPassword']);

            //sending email
            Route::post('/auth/lupa-password' , [AuthController::class,'sendEmailAuth']);
    
            // checking token before passing to view
            Route::get('/auth/ganti-password/{token}' , [AuthController::class , 'changePassword']);
    
        // Passing new password to database
            Route::patch('/auth/store-newPassword/{token}', [AuthController::class, 'updatePassword']);
    });

    Route::middleware(PenggunaMiddleware::class)->group(function () {
        Route::get('/info' , function (){
            dd(phpinfo());
        });
        Route::get('/profile/pengguna' , [PenggunaController::class, 'index']);

         
        // ubah data dasar pengguna
        Route::get('/profile/ubah-data/{slugPengguna}' ,[PenggunaController::class, 'update']);
        Route::post('/profile/storeUpdate/{slugPengguna}' ,[PenggunaController::class, 'updateStore']);

         // ubah password
        Route::get('/profile/ganti-password' , [PenggunaController::class, 'updatePassword']);

        //simpan Berita
        Route::post('/profile/saveNews/{kategori}/{slugBerita}',[PenggunaController::class, 'saveNews']);
        Route::delete('/profile/deleteSaveNews/{kategori}/{slugBerita}',[PenggunaController::class, 'deleteNews']);
    
        Route::delete('/logout' , [AuthController::class, 'logout']);

    });

    Route::middleware(AdministratorMiddleware::class)->group(function() {
        Route::get('/dashboard' , [AdministratorController::class , 'index']);
        Route::get('/profile' , [AdministratorController::class , 'profile']);
      
        Route::delete('/logout-admin' , [AdministratorController::class , 'logout']);

        // MAIN FEATURE
        Route::get('/akun-jurnalis' , [AdministratorController::class , 'dataJurnalis']);
        Route::get('/akun-jurnalis/{slugJurnalis}' , [AdministratorController::class , 'detailJurnalis']);
        Route::post('/aktif-akun/{slugJurnalis}' , [AdministratorController::class , 'activeJurnalis']);
        Route::get('/kelola-berita' , [AdministratorController::class , 'kelolaBerita']);

        Route::get('/kategori-berita' , [AdministratorController::class , 'kategoriBerita'] );
        Route::get('/kategori-berita/{idKb}' , [AdministratorController::class , 'ubahKB'] );
        Route::post('/kategori-berita' , [AdministratorController::class , 'storeKb']);
        Route::patch('/kategori-berita/{idKb}' , [AdministratorController::class , 'updateKb']);
        Route::delete('/kategori-berita/{idKb}' , [AdministratorController::class , 'deleteKb']);

    });

    Route::get('/register-jurnalis' , [JurnalisController::class, 'register']);
    Route::post('/registerJurnalis' , [JurnalisController::class, 'Authregister']);

    Route::middleware(JurnalisMiddleware::class)->group(function () {
        Route::get('/dashboard-jurnalis' , [JurnalisController::class , 'index'])->name('dashboard-jurnalis');
        Route::delete('/logout-jurnalis' , [JurnalisController::class, 'logout'])->name('logout-jurnalis');
        Route::get('/jurnalis/profile' , [JurnalisController::class, 'profile'])->name('jurnalis-profile');
        Route::get('/jurnalis/update-profile/{slugPengguna}',  [JurnalisController::class, 'updateProfile']);
});
    Route::middleware(ActiveJurnalisMiddleware::class)->group(function () {
        Route::get('/tambah-berita',  [JurnalisController::class, 'tambahBerita']);
        Route::post('/simpan-berita' ,  [JurnalisController::class, 'storeNews']);
        Route::post('/berita/softHapus/{slugberita}' , [JurnalisController::class, 'softDelete'])->name('berita.softHapus');
        Route::post('/berita/restore/{slugberita}' , [JurnalisController::class, 'restore']);
        Route::post('/berita/delete/{slugberita}' , [JurnalisController::class, 'delete']);
        Route::get('/ubah-berita/{slugBerita}' , [JurnalisController::class, 'update']);
        Route::post('/update-berita/{slugBerita}' , [JurnalisController::class, 'updateNews']);
        Route::get('/beritaAdmin/{kategori}/{slugBerita}' , [AdministratorController::class, 'detailNews']);

        });