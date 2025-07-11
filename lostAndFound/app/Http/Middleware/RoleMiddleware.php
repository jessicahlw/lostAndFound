<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();
        
        if (!$user || !in_array($user->role, $roles)){
            return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk
            mengakses halaman tersebut');
        }
        
        return $next($request);
    }
}
