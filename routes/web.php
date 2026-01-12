<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController; // Tambahkan baris ini

Route::get('/', function () {
    return view('welcome');
});

// Route lama Anda
Route::get('/tampil-data', [PostController::class, 'index']);

// Tambahkan Route Resource untuk Produk
Route::resource('produk', ProdukController::class);