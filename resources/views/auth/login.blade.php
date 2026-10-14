@extends('layouts.app')

@section('title', 'Login - EduSafe')

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h1>EduQuiz</h1>
        <p>Platform Pembelajaran Online Malware</p>
    </div>

    {{-- Alert sukses (misal setelah logout) --}}
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert error (kredensial salah / akun dikunci) --}}
    @if ($errors->any())
        <div class="alert-danger">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input
                type="email"
                name="email"
                id="txtEmail"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="contoh@email.com"
                value="{{ old('email') }}"
                required
                autocomplete="email"
            >
        </div>

        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input
                type="password"
                name="password"
                id="txtPassword"
                class="form-control"
                placeholder="Masukkan password"
                required
                autocomplete="current-password"
            >
        </div>

        <button type="submit" id="btnSignIn" class="btn-primary">Sign In</button>
    </form>

    <div class="auth-footer">
        <a href="#" id="lnkLupaPassword">Forgot password?</a>
        <a href="{{ route('register') }}" id="lnkBuatAkun">Buat Akun</a>
    </div>
</div>
@endsection