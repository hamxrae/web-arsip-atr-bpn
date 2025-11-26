<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BukuTanahController;
use App\Http\Controllers\SuratUkurController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PengembalianController;

/*
|--------------------------------------------------------------------------
| ROUTE UNTUK TAMU (BELUM LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    // Halaman login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    // Proses login
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post');

    // Register - Halaman Daftar
    Route::get('/register', [LoginController::class, 'showRegisterForm'])
        ->name('register');

    // Proses Register
    Route::post('/register', [LoginController::class, 'register'])
        ->name('register.store');

    // Forgot Password
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])
        ->name('password.request');

    // Send Reset Link
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])
        ->name('password.email');

    // Reset Password Form
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])
        ->name('password.reset');

    // Process Reset Password
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])
        ->name('password.update');

});


/*
|--------------------------------------------------------------------------
| ROUTE UNTUK USER YANG SUDAH LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Resource lainnya
    Route::resource('bukut', BukuTanahController::class);
    Route::resource('suratukur', SuratUkurController::class);
    Route::resource('peminjam', PeminjamController::class);
    Route::resource('pengembalian', PengembalianController::class);

});


