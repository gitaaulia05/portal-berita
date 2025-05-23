<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Symfony\Component\HttpFoundation\Response;

class AdministratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('Authorization');
       
        
        $pengguna = Administrator::where('token', $token)->where('role' , 1)->first();

        if($pengguna) {
            $request->headers->set('Authorization' , 'Bearer '.$token);
            return $next($request);
        } else {
            return redirect('/login-administrator');
        }
    }
}
