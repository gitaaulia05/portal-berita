<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Symfony\Component\HttpFoundation\Response;

class UniversalMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('Authorization');

        $tokenCheck = Pengguna::where('token', $token)->first() ?? Administrator::where('token' , $token)->first();

        if($tokenCheck) {
            $request->headers->set('Authorization' , 'Bearer '.$token);
            return $next($request);
        } else {
            return redirect('/login');
        }
        
    }
}
