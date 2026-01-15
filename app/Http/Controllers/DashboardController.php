<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik
        $totalProduk = Produk::count();
        $totalStok = Produk::sum('jumlah');
        $totalKategori = 3; // Bisa disesuaikan dengan data kategori jika ada

        return view('dashboard', compact('totalProduk', 'totalStok', 'totalKategori'));
    }
}
