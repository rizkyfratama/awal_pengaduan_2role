<?php

namespace App\Http\Middleware; // <-- INI YANG SAYA PERBAIKI (typo 'Http{')

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiCheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Periksa apakah user terautentikasi DAN rolenya sesuai
        if (!Auth::check() || Auth::user()->role !== $role) {
            return response()->json(['message' => 'Akses ditolak. Hanya untuk ' . $role . '.'], 403); // 403 = Forbidden
        }
        
        return $next($request);
    }
}