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

/**
 * ============================================================================
 * ROUTE UNTUK GUEST (PENGGUNA BELUM LOGIN)
 * ============================================================================
 * Middleware 'guest' memastikan route ini hanya dapat diakses oleh pengguna
 * yang belum authenticated. Jika sudah login, user akan di-redirect.
 */
Route::middleware('guest')->group(function () {

    // --------
    // AUTHENTICATION ROUTES
    // --------
    
    // Tampilkan form login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');
    
    // Proses login (POST)
    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.post');

    // --------
    // REGISTRATION ROUTES
    // --------
    
    // Tampilkan form registrasi
    Route::get('/register', [LoginController::class, 'showRegisterForm'])
        ->name('register');
    
    // Proses registrasi (POST)
    Route::post('/register', [LoginController::class, 'register'])
        ->name('register.store');

    // --------
    // PASSWORD RESET ROUTES
    // --------
    
    // Tampilkan form lupa password
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])
        ->name('password.request');
    
    // Kirim email reset link (POST)
    Route::post('/forgot-password', [LoginController::class, 'sendResetLink'])
        ->name('password.email');

    // Tampilkan form reset password dengan token
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])
        ->name('password.reset');
    
    // Proses reset password (POST)
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])
        ->name('password.update');

});


/**
 * ============================================================================
 * ROUTE UNTUK AUTHENTICATED USERS (PENGGUNA SUDAH LOGIN)
 * ============================================================================
 * Middleware 'auth' memastikan route ini hanya dapat diakses oleh pengguna
 * yang sudah authenticated. User yang belum login akan di-redirect ke halaman login.
 */
Route::middleware('auth')->group(function () {

    // --------
    // AUTHENTICATION ROUTES
    // --------
    
    // Proses logout (POST)
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // --------
    // DASHBOARD ROUTE
    // --------
    
    // Halaman dashboard utama
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // --------
    // RESOURCE ROUTES (CRUD)
    // --------
    
    /**
     * Buku Tanah Resource Routes
     * Menghasilkan: index, create, store, show, edit, update, destroy
     */
    Route::resource('buku-tanah', BukuTanahController::class)
        ->names('bukutanah');

    /**
     * Surat Ukur Resource Routes
     * Menghasilkan: index, create, store, show, edit, update, destroy
     */
    Route::resource('surat-ukur', SuratUkurController::class)
        ->names('suratukur');

    /**
     * Peminjam (Peminjaman) Resource Routes
     * Menghasilkan: index, create, store, show, edit, update, destroy
     */
    Route::resource('peminjam', PeminjamController::class)
        ->names('peminjam');

    /**
     * Pengembalian Resource Routes
     * Menghasilkan: index, create, store, show, edit, update, destroy
     */
    Route::resource('pengembalian', PengembalianController::class)
        ->names('pengembalian');

});


