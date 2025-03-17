<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenggunaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        $token = session('Authorization');

        $pengguna = Pengguna::where('token', $token)->first();

        if($pengguna) {
            $request->headers->set('Authorization' , 'Bearer '.$token);
            return $next($request);
        } else {
            return redirect('/login');
        }
       
    }
}
