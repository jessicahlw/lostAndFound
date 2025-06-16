<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIS('login') || $request->routeIs('register') || $request->is('/') ) {
            return $next($request);
        }
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silahkan login untuk melanjutkan!');
        }
        
        return $next($request);
    }
}
