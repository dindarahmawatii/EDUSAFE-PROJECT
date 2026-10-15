@extends('layouts.app')

@section('title', 'Login - EduQuiz')

@push('page-css')
    <link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
@endpush

@section('content')
<div class="auth-wrapper">
    <h1 class="auth-main-title">EduSafe</h1>

    <div class="auth-container">
        @if ($errors->any())
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 15px;">
                {{ $errors->first('email') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="txtEmail">Email</label>
                <input type="email" name="email" id="txtEmail" class="form-control" placeholder="Value" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="txtPassword">Password</label>
                <input type="password" name="password" id="txtPassword" class="form-control" placeholder="Value" required>
            </div>

            <button type="submit" id="btnSignIn" class="btn-dark-custom">Sign In</button>
        </form>

        <div class="auth-footer">
            <a href="#" id="lnkLupaPassword">Forgot password?</a>
            <a href="{{ route('register') }}" id="lnkBuatAkun">Buat Akun</a>
        </div>
    </div>
</div>
@endsection