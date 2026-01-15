<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;

// Dashboard Route
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Route lama Anda
Route::get('/tampil-data', [PostController::class, 'index']);

// Route Resource untuk Produk
Route::resource('produk', ProdukController::class);

// Route Resource untuk Supplier
Route::resource('supplier', SupplierController::class);