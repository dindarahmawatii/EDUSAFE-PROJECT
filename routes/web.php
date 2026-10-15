<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ─── Auth Routes (Guest Only) ──────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ─── Protected Routes (Auth Only) ─────────────────────────────────────────
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard (placeholder)
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});











// --- ROUTE DUMMY / TESTING FRONTEND ---

// Contoh 1: Langsung menampilkan view halaman utama (welcome) tanpa periksa login
Route::get('/test-welcome', function () {
    return view('welcome');
});