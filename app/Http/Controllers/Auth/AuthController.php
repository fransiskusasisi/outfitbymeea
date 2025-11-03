<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username dan password plain
        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if ($user) {
            Auth::login($user);

            // Redirect sesuai role
            if ($user->role === 'pemilik') {
                return redirect()->route('pemilik.pemilik.dashboard');
            } elseif ($user->role === 'kasir') {
                return redirect()->route('kasir.dashboard');
            } elseif ($user->role === 'petugas_gudang') {
                return redirect()->route('gudang.gudang.dashboard');
            }

            return redirect()->route('login')->withErrors(['login' => 'Role tidak dikenali']);
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}