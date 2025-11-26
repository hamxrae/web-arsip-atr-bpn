<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class initamu
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user sudah login → jangan boleh buka halaman login
        if (Auth::check()) {
           return redirect('/')
                ->with('warning', 'Anda sudah login. Silakan logout terlebih dahulu jika ingin kembali ke halaman login.');
        }

        return $next($request);
    }
}
