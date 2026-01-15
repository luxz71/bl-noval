<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik
        $totalProduk = Produk::count();
        $totalStok = Produk::sum('jumlah');
        $totalSupplier = Supplier::count();

        return view('dashboard', compact('totalProduk', 'totalStok', 'totalSupplier'));
    }
}
