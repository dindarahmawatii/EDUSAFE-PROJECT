@extends('layouts.app')

@section('title', 'Buat Akun - EduQuiz')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/auth/register.css') }}">
@endpush

@section('content')
<!-- Topbar khusus register -->
<div class="auth-topbar">
    <a href="{{ url('/') }}" class="auth-topbar-brand">EduQuiz</a>
    <div class="auth-topbar-right">
        <span>Sudah punya akun?</span>
        <a href="{{ route('login') }}" id="btnMasuk">Masuk</a>
    </div>
</div>

<div class="auth-container" style="margin: 20px auto;">
    <div class="auth-header">
        <h1>Buat Akun Baru</h1>
        <p>Lengkapi data di bawah untuk memulai.</p>
    </div>

    @if ($errors->any())
        <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="txtNama">Nama Lengkap</label>
            <input type="text" name="name" id="txtNama" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input type="email" name="email" id="txtEmail" class="form-control" placeholder="contoh@email.com" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input type="password" name="password" id="txtPassword" class="form-control" placeholder="Min. 8 karakter" required>
        </div>

        <div class="form-group">
            <label for="txtKonfirmasi">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="txtKonfirmasi" class="form-control" placeholder="Ulangi password" required>
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 8px; margin: 15px 0;">
            <input type="checkbox" name="terms" id="chkSyaratKetentuan" required style="width: 16px; height: 16px; cursor: pointer;">
            <label for="chkSyaratKetentuan" style="font-size: 13px; color: #475569; margin-bottom: 0; cursor: pointer;">
                Saya setuju dengan <a href="#" style="color: #2563eb; text-decoration: none;">Syarat &amp; Ketentuan</a> yang berlaku.
            </label>
        </div>

        <button type="submit" id="btnDaftarSekarang" class="btn-primary-custom">Daftar Sekarang &rarr;</button>
    </form>
</div>

<!-- Footer bawah layar -->
<div class="auth-page-footer">
    <span>EduQuiz</span>
    <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Contact Us</a>
    </div>
</div>
@endsection