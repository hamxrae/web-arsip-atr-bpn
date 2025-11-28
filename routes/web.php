<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    DashboardController,
    BukuTanahController,
    SuratUkurController,
    PeminjamController,
    PengembalianController
};

// ============================================================================
// GUEST ROUTES (PENGGUNA BELUM LOGIN)
// ============================================================================
// Hanya bisa diakses oleh pengguna yang belum login (guest middleware)

Route::middleware('guest')->group(function () {

    // LOGIN
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    // REGISTER
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register'])->name('register.store');

    // PASSWORD RESET
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');

});


// ============================================================================
// AUTHENTICATED ROUTES (PENGGUNA SUDAH LOGIN)
// ============================================================================
// Hanya bisa diakses oleh pengguna yang sudah login (auth middleware)

Route::middleware('auth')->group(function () {

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // DASHBOARD
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ADMIN RESOURCES - Data Master Aplikasi
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Manajemen Buku Tanah
        Route::resource('buku-tanah', BukuTanahController::class)->names('bukutanah');
        
        // Manajemen Surat Ukur
        Route::resource('surat-ukur', SuratUkurController::class)->names('suratukur');
        
        // Manajemen Peminjaman
        Route::resource('peminjam', PeminjamController::class)->names('peminjam');
        
        // Manajemen Pengembalian
        Route::resource('pengembalian', PengembalianController::class)->names('pengembalian');
    });

});


