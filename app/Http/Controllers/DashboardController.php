<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pelanggan;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung statistik produk & supplier
        $totalProduk = Produk::count();
        $totalStok = Produk::sum('jumlah');
        $totalSupplier = Supplier::count();
        $stokRendah = Produk::where('jumlah', '<', 10)->count();

        // Hitung statistik pelanggan & pembeli
        $totalPelanggan = Pelanggan::count();
        $pelangganAktif = Pelanggan::where('status', 'aktif')->count();
        $totalTransaksi = Pembeli::count();
        $transaksiBulanIni = Pembeli::whereMonth('tanggal_beli', Carbon::now()->month)
            ->whereYear('tanggal_beli', Carbon::now()->year)
            ->count();
        $pendapatanBulanIni = Pembeli::whereMonth('tanggal_beli', Carbon::now()->month)
            ->whereYear('tanggal_beli', Carbon::now()->year)
            ->sum('total_harga');

        // Ambil data pelanggan terbaru (5 terakhir)
        $pelangganTerbaru = Pelanggan::latest()->take(5)->get();

        // Ambil data transaksi terbaru (5 terakhir) dengan relasi
        $transaksiTerbaru = Pembeli::with(['pelanggan', 'produk'])
            ->latest('tanggal_beli')
            ->take(5)
            ->get();

        // Pelanggan dengan transaksi terbanyak
        $topPelanggan = Pelanggan::withCount('pembelian')
            ->orderBy('pembelian_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalStok',
            'totalSupplier',
            'stokRendah',
            'totalPelanggan',
            'pelangganAktif',
            'totalTransaksi',
            'transaksiBulanIni',
            'pendapatanBulanIni',
            'pelangganTerbaru',
            'transaksiTerbaru',
            'topPelanggan'
        ));
    }
}
