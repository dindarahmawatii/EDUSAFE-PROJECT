<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $throttleKey = Str::lower($request->email) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Akun sementara dikunci karena terlalu banyak percobaan login. '
                        . "Silakan coba lagi dalam {$minutes} menit.",
                ]);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        RateLimiter::hit($throttleKey, 900);

        $attemptsLeft = 5 - RateLimiter::attempts($throttleKey);

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password yang kamu masukkan salah.'
                    . ($attemptsLeft > 0
                        ? " Sisa percobaan: {$attemptsLeft}x."
                        : ''),
            ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'terms.accepted' => 'Kamu harus menyetujui Syarat & Ketentuan.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('home')
            ->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->name . '!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Kamu telah berhasil keluar.');
    }
}
