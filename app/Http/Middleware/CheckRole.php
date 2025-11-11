<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika user tidak login ATAU rolenya tidak sesuai
        if (!Auth::check() || Auth::user()->role !== $role) {
            
            // Jika sudah login, redirect ke dashboard yang sesuai
            if (Auth::check()) {
                if (Auth::user()->role == 'petugas') {
                    return redirect('/petugas/dashboard');
                } else {
                    return redirect('/dashboard');
                }
            }
            // Jika tidak login, redirect ke login
            return redirect('/login');
        }
        
        return $next($request);
    }
}