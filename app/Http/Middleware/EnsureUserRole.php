<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek 1: Apakah user sudah login?
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek 2: Apakah role user sesuai dengan yang diminta?
        // Kita asumsikan role di database adalah: 'admin', 'pemilik', 'pencari'
        if (Auth::user()->role !== $role) {
            abort(403, 'AKSES DITOLAK: Anda tidak memiliki izin untuk masuk ke halaman ini.');
        }

        return $next($request);
    }
}