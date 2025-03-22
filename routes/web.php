<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\JurnalisMiddleware;
use App\Http\Middleware\PenggunaMiddleware;
use App\Http\Controllers\JurnalisController;
use App\Http\Middleware\AdministratorMiddleware;
use App\Http\Controllers\AdministratorController;


// TestTest1&
Route::get('/',[AuthController::class , 'index']);

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

    Route::middleware(PenggunaMiddleware::class)->group(function () {
        //View Password forget
        Route::get('/lupa-passwordAuth' , [AuthController::class , 'forgetPassword']);

        //sending email
        Route::post('/auth/lupa-password' , [AuthController::class,'sendEmailAuth']);

        // checking token before passing to view
        Route::get('/auth/ganti-password/{token}' , [AuthController::class , 'changePassword']);

        // Passing new password to database
        Route::patch('/auth/store-newPassword/{token}', [AuthController::class, 'updatePassword']);

        Route::get('/info' , function (){
            dd(phpinfo());
        });
        Route::delete('/logout' , [AuthController::class, 'logout']);

    });

    Route::middleware(AdministratorMiddleware::class)->group(function() {
        Route::get('/dashboard' , [AdministratorController::class , 'index']);
        Route::get('/profile' , [AdministratorController::class , 'profile']);
        Route::delete('/logout-admin' , [AdministratorController::class , 'logout']);
    });


    Route::middleware(JurnalisMiddleware::class)->group(function () {
        Route::get('/dashboard-jurnalis' , [JurnalisController::class , 'index']);
        Route::delete('/logout-jurnalis' , [JurnalisController::class, 'logout']);

        Route::get('/tambah-berita',  [JurnalisController::class, 'tambahBerita']);
        Route::post('/simpan-berita' ,  [JurnalisController::class, 'storeNews']);
    });