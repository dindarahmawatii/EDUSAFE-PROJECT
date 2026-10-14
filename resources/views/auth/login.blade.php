@extends('layouts.app')

@section('title', 'Login - EduQuiz')

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h1>EduQuiz</h1>
        <p>Platform Pembelajaran Online Malware</p>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="txtEmail">Email</label>
            <input type="email" name="email" id="txtEmail" class="form-control" placeholder="contoh@email.com" required>
        </div>

        <div class="form-group">
            <label for="txtPassword">Password</label>
            <input type="password" name="password" id="txtPassword" class="form-control" placeholder="Masukkan password" required>
        </div>

        <button type="submit" id="btnSignIn" class="btn-primary">Sign In</button>
    </form>

    <div class="auth-footer">
        <a href="#" id="lnkLupaPassword">Forgot password?</a>
        <a href="{{ route('register') }}" id="lnkBuatAkun">Buat Akun</a>
    </div>
</div>
@endsection