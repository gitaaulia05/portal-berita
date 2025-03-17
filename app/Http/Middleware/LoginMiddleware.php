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
      
       $admin = Administrator::where('token' , $token)->first();

        $pengguna = Pengguna::where('token' , $token)->first();
    
        $restrictRoute = ['login-administrator' , 'authAdmin' , 'login' , 'authLogin'];

        if( ( $admin || $pengguna) && in_array($request->path() , $restrictRoute) ) {
            return redirect()->back();
            
        } else {
            return $next($request);
        }
    }
}
