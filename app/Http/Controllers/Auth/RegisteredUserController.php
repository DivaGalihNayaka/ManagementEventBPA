<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman form registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Memproses data pendaftaran masuk.
     */
    public function store(Request $request)
    {
        // 1. Validasi data input dari form
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'terms' => ['required', 'accepted'], // Memastikan checkbox dicentang
        ], [
            // Kustomisasi pesan error bahasa Indonesia
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'terms.accepted' => 'Anda harus menyetujui persyaratan layanan.',
        ]);

        // 2. Simpan user baru ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 3. Alihkan ke halaman login setelah sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}