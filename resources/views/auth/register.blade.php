<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')

@section('title', 'Buat Akun - EduQuiz')

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h1>Buat Akun Baru</h1>
        <p>Lengkapi data di bawah untuk memulai.</p>
    </div>

    {{-- Alert Pesan Error Validasi --}}
    @if ($errors->any())
        <div class="alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="txtNama">Nama Lengkap</label>
            <input 
                type="text" 
                name="name" 
                id="txtNama" 
                class="form-control" 
                placeholder="Masukkan nama lengkap" 
                value="{{ old('name') }}" 
                required
            >
        </div>

        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input 
                type="email" 
                name="email" 
                id="txtEmail" 
                class="form-control" 
                placeholder="contoh@email.com" 
                value="{{ old('email') }}" 
                required
            >
        </div>

        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input 
                type="password" 
                name="password" 
                id="txtPassword" 
                class="form-control" 
                placeholder="Min. 8 karakter" 
                required
            >
        </div>

        <div class="form-group">
            <label for="txtKonfirmasi">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                id="txtKonfirmasi" 
                class="form-control" 
                placeholder="Ulangi password" 
                required
            >
        </div>

        <div class="form-group">
            <label class="form-checkbox">
                <input type="checkbox" name="terms" id="chkSyaratKetentuan" required>
                Saya setuju dengan Syarat &amp; Ketentuan yang berlaku.
            </label>
        </div>

        <button type="submit" id="btnDaftarSekarang" class="btn-primary">Daftar Sekarang &rarr;</button>
    </form>

    <div class="auth-footer" style="justify-content: center; margin-top: 20px;">
        <span style="color: #6b7280; margin-right: 5px;">Sudah punya akun?</span>
        <a href="{{ route('login') }}" id="btnMasuk">Masuk</a>
    </div>
</div>
@endsection