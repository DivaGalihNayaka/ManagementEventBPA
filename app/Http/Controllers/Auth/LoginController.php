<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard'); // Arahkan ke halaman setelah login
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        // 1. Keluarkan user dari sistem
        Auth::logout();

        // 2. Hancurkan sesi saat ini agar tidak bisa dibajak
        $request->session()->invalidate();

        // 3. Buat ulang token keamanan
        $request->session()->regenerateToken();

        // 4. Arahkan kembali ke halaman login
        return redirect()->route('login');
    }
}