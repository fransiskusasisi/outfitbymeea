<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Master\BarangController; 

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        // Cek kalau belum login
        if (!$user) {
            return redirect('/login');
        }

        // Kalau role user tidak sesuai
        if (!in_array($user->role, $roles)) {
            abort(403, 'Akses ditolak.');
        }

        return $next($request);
    }
}
