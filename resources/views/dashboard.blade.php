@extends('layouts.app')

@section('title', 'Dashboard - EduSafe')

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h1>Dashboard</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>
    </div>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="text-align: center; padding: 20px 0;">
        <p style="color: #6b7280; margin-bottom: 20px;">Kamu berhasil login ke EduSafe.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-primary" style="background: #ef4444;">Logout</button>
        </form>
    </div>
</div>
@endsection
