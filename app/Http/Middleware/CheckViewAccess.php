<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckViewAccess
{
    public function handle(Request $request, Closure $next)
    {
        $viewName = $request->route()->getName(); // Mendapatkan nama rute

        // Cek apakah pengguna adalah admin
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // Admin memiliki akses ke semua views
        }

        // Mendapatkan nama folder view dari nama peran pengguna
        $viewFolder = strtolower(Auth::user()->role);

        // Mendapatkan nama file view dari nama rute
        $viewFile = str_replace('.', '/', $viewName) . '.blade.php';

        // Cek apakah pengguna memiliki akses ke file view
        if (view()->exists($viewFolder . '/' . $viewFile)) {
            return $next($request);
        }

        // Redirect atau tanggapan lain jika pengguna tidak memiliki izin
        return redirect()->route('home')->with('error', 'Unauthorized access.');
    }
}
