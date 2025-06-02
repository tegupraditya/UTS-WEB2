<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password; // Import untuk aturan validasi password

class AuthController extends Controller
{
    public function register()
    {
        return view("auth.register");
    }

    public function login()
    {
        return view("auth.login");
    }

    public function store(Request $request)
    {
        // Validasi input, termasuk konfirmasi password dan aturan password default Laravel
        $validated = $request->validate([
            "name" => ['required', 'string', 'max:255'],
            "email" => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // Menggunakan Password::defaults() untuk aturan password yang kuat
            // dan 'confirmed' untuk mencocokkan dengan field 'password_confirmation' di form Anda
            "password" => ['required', 'confirmed', Password::defaults()],
        ]);

        // Membuat user baru dengan password yang sudah di-hash menggunakan Bcrypt
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // MENGGUNAKAN Hash::make()
        ]);

        // Opsional: Langsung login pengguna setelah registrasi
        Auth::login($user);

        // Arahkan ke dashboard dengan pesan sukses
        return redirect()->route("dashboard")->with('success', 'Registrasi berhasil! Anda sudah login.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mencoba untuk mengautentikasi pengguna dengan opsi "remember me"
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate(); // Regenerasi session ID untuk keamanan

            // Arahkan ke halaman yang dituju sebelumnya (intended) atau ke dashboard
            return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email'); // Hanya kembalikan input email agar pengguna tidak perlu mengetik ulang semuanya
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Membatalkan session saat ini
        $request->session()->regenerateToken(); // Membuat token CSRF baru

        // Arahkan ke halaman landing atau login dengan pesan sukses
        return redirect()->route("landing")->with('success', 'Anda berhasil logout.');
    }
}
