<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Administrator;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ActiveJurnalisMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('Authorization');
      
        $jurnalis = Administrator::where('token' , $token)->first();
        Log::info($jurnalis->active);
      
        if(!$token || !$jurnalis->active == 1) {
            return redirect()->back()->with('message-error' , 'Akun anda belum active silahkan hubungi bagian administrator!');
        }
        $request->headers->set('Authorization' , 'Bearer '.$token);
        return $next($request);
        
    }
}
