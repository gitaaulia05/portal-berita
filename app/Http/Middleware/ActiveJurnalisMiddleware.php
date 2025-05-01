<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Administrator;
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

        if(!$token || !$jurnalis) {
            return redirect()->back();
        }
        $request->headers->set('Authorization' , 'Bearer '.$token);
        return $next($request);
        
    }
}
