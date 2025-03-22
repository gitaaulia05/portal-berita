<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('Authorization');
            if(!$token) {
                return $next($request);
            }

       $admin = Administrator::where('token' , $token)->where('role' , 1)->first();
    
        $pengguna = Pengguna::where('token' , $token)->first();

        $jurnalis = Administrator::where('token' , $token)->where('role' , 2)->first();
    
        $restrictRoute = ['login-administrator' , 'authAdmin' , 'login' , 'authLogin' , 'login-jurnalis' , 'authJurnalis'];

        if(in_array($request->path() , $restrictRoute) ) {
           if($admin) {
            return redirect('/dashboard');
           } elseif($pengguna) {
            return redirect('/');
           } elseif($jurnalis) {
            return redirect('/dashboard-jurnalis');
           }
           return $next($request);
        } 
        return $next($request);
    }
}
