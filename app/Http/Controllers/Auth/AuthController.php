<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\RiwayatLogin;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
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

        $user = User::where('username', $request->username)
            ->where('password', $request->password)
            ->first();

        if (! $user) {
            return back()->withErrors([
                'login' => 'Username atau password salah'
            ])->withInput();
        }

        Auth::login($user);

        $today = Carbon::today();
        $riwayat = RiwayatLogin::where('user_id', $user->user_id)
            ->whereDate('login_at', $today)
            ->first();

        if (! $riwayat) {
            $riwayat = RiwayatLogin::create([
                'user_id'    => $user->user_id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_at'   => Carbon::now(),
            ]);
        }

        $request->session()->put('riwayat_login_id', $riwayat->id);

        if ($user) {
            if ($user->role === 'pemilik') {
                return redirect()->route('pemilik.dashboard');
            } elseif ($user->role === 'kasir') {
                return redirect()->route('kasir.dashboard');
            } elseif ($user->role === 'petugas_gudang') {
                return redirect()->route('gudang.dashboard');
            }

            return redirect()->route('login')->withErrors(['login' => 'Role tidak dikenali']);
        }

        return back()->withErrors(['login' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        $riwayatId = $request->session()->get('riwayat_login_id');

        if ($riwayatId) {
            $riwayat = RiwayatLogin::find($riwayatId);
            if ($riwayat) {
                $riwayat->update([
                    'logout_at' => Carbon::now(),
                ]);
            }
            $request->session()->forget('riwayat_login_id');
        }
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}