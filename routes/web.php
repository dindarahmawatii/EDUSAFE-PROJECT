<?php

use Illuminate\Support\Facades\Route;

// Redirect halaman utama ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route halaman register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');