<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\UserController;

// ============================================
// REDIRECT ROOT
// ============================================
Route::get('/', function () {
    return redirect()->route('login');
});

// ============================================
// ROUTE GUEST (BELUM LOGIN)
// ============================================
Route::middleware(['guest'])->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);

    // Register
    Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

// ============================================
// ROUTE TERPROTEKSI (SUDAH LOGIN)
// ============================================
Route::middleware(['auth'])->group(function () {

    // Dashboard Route - Semua user bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile & Password - Semua user bisa akses
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile');
    Route::put('/profile/password', [LoginController::class, 'updatePassword'])->name('profile.password');

    // Logout - Semua user bisa akses
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // ============================================
    // ROUTE KHUSUS ADMIN
    // ============================================
    Route::middleware(['role:admin'])->group(function () {
        // Route lama
        Route::get('/tampil-data', [PostController::class, 'index']);

        // Route Resource untuk Produk (Inventori)
        Route::resource('produk', ProdukController::class);

        // Route Resource untuk Supplier (Inventori)
        Route::resource('supplier', SupplierController::class);

        // Route Resource untuk User Management
        Route::resource('users', UserController::class);
    });

    // ============================================
    // ROUTE UNTUK ADMIN DAN USER (TRANSAKSI)
    // ============================================
    // Route Resource untuk Pelanggan
    Route::resource('pelanggan', PelangganController::class);

    // Route Resource untuk Pembeli (Transaksi)
    Route::resource('pembeli', PembeliController::class);
});