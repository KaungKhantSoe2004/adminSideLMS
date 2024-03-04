<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class loginAndRegisterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(url()->current()=== '/register' && Auth::user() !== null ){
            return back();
        };
         if(url()->current() === '/login' && Auth::user() !== null){
            return back();
         };
         if(url()->current() === 'register' && Auth::user() === null){
            return redirect()->route('registerPage');
         };
        return $next($request);
    }
}
