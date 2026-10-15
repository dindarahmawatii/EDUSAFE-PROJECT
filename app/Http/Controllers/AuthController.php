<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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

        $throttleKey = Str::lower($request->email).'|'.$request->ip();
        $user = User::where('email', $request->email)->first();

        // 1. Cek kunci akun berdasarkan database (waktuKunci)
        if ($user && $user->waktuKunci) {
            $lockTime = Carbon::parse($user->waktuKunci);

            if ($lockTime->isFuture()) {
                $seconds = now()->diffInSeconds($lockTime);
                $minutes = (int) ceil($seconds / 60);

                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Akun sementara dikunci karena terlalu banyak percobaan login. '
                            ."Silakan coba lagi dalam {$minutes} menit.",
                    ]);
            }

            // Masa kunci 15 menit sudah berakhir, reset
            $user->update([
                'jumlahGagalLogin' => 0,
                'waktuKunci' => null,
            ]);
            RateLimiter::clear($throttleKey);
        }

        // 2. Cek RateLimiter bawaan
        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = (int) ceil($seconds / 60);

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Akun sementara dikunci karena terlalu banyak percobaan login. '
                        ."Silakan coba lagi dalam {$minutes} menit.",
                ]);
        }

        // 3. Coba Autentikasi
        if (Auth::attempt($request->only('email', 'password'))) {
            RateLimiter::clear($throttleKey);

            if ($user) {
                $user->update([
                    'jumlahGagalLogin' => 0,
                    'waktuKunci' => null,
                ]);
            }

            $request->session()->regenerate();

            return redirect()->intended(route('home'))
                ->with('success', 'Selamat datang kembali, '.Auth::user()->name.'!');
        }

        // 4. Jika Autentikasi Gagal
        RateLimiter::hit($throttleKey, 900);

        if ($user) {
            $gagal = ($user->jumlahGagalLogin ?? 0) + 1;
            $kunciSampai = null;

            if ($gagal >= 5) {
                $kunciSampai = now()->addMinutes(15);
            }

            $user->update([
                'jumlahGagalLogin' => $gagal,
                'waktuKunci' => $kunciSampai,
            ]);

            $attemptsLeft = max(0, 5 - $gagal);

            if ($gagal >= 5) {
                return back()
                    ->withInput($request->only('email'))
                    ->withErrors([
                        'email' => 'Akun sementara dikunci selama 15 menit karena telah salah memasukkan password sebanyak 5 kali.',
                    ]);
            }

            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email atau password yang kamu masukkan salah.'
                        .($attemptsLeft > 0 ? " Sisa percobaan: {$attemptsLeft}x." : ''),
                ]);
        }

        $attemptsLeft = 5 - RateLimiter::attempts($throttleKey);

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Email atau password yang kamu masukkan salah.'
                    .($attemptsLeft > 0 ? " Sisa percobaan: {$attemptsLeft}x." : ''),
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
            'email' => 'required|string|email|max:255|unique:user,email',
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

        User::create([
            'username' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'jumlahGagalLogin' => 0,
            'waktuKunci' => null,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil! Silakan masuk dengan akun Anda.');
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
