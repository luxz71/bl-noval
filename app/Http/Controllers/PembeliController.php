<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pembeli::with(['pelanggan', 'produk']);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('pelanggan', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            })->orWhereHas('produk', function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%");
            });
        }

        if ($request->has('status_pembayaran') && $request->input('status_pembayaran') != '') {
            $query->where('status_pembayaran', $request->input('status_pembayaran'));
        }

        $data = $query->latest('tanggal_beli')->get();
        $pelanggan = Pelanggan::where('status', 'aktif')->get();
        $produk = Produk::all();

        return view('pembeli.index', compact('data', 'pelanggan', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::where('status', 'aktif')->get();
        $produk = Produk::where('jumlah', '>', 0)->get();
        return view('pembeli.add', compact('pelanggan', 'produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelanggan_id' => [
                'required',
                'exists:pelanggan,id',
            ],
            'produk_id' => [
                'required',
                'exists:produk,id',
            ],
            'jumlah_beli' => [
                'required',
                'integer',
                'min:1',
            ],
            'total_harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'tanggal_beli' => [
                'required',
                'date',
            ],
            'status_pembayaran' => [
                'required',
                'in:lunas,belum_lunas,cicilan',
            ],
            'catatan' => [
                'nullable',
            ],
        ], [
            'pelanggan_id.required' => 'Pelanggan wajib dipilih',
            'pelanggan_id.exists' => 'Pelanggan tidak ditemukan',
            'produk_id.required' => 'Produk wajib dipilih',
            'produk_id.exists' => 'Produk tidak ditemukan',
            'jumlah_beli.required' => 'Jumlah beli wajib diisi',
            'jumlah_beli.integer' => 'Jumlah beli harus berupa angka',
            'jumlah_beli.min' => 'Jumlah beli minimal 1',
            'total_harga.required' => 'Total harga wajib diisi',
            'total_harga.numeric' => 'Total harga harus berupa angka',
            'total_harga.min' => 'Total harga tidak boleh negatif',
            'tanggal_beli.required' => 'Tanggal beli wajib diisi',
            'tanggal_beli.date' => 'Format tanggal tidak valid',
            'status_pembayaran.required' => 'Status pembayaran wajib dipilih',
            'status_pembayaran.in' => 'Status pembayaran tidak valid',
        ]);

        // Cek stok produk
        $produk = Produk::find($validated['produk_id']);
        if ($produk->jumlah < $validated['jumlah_beli']) {
            return redirect()->back()->withInput()->with('error', 'Stok produk tidak mencukupi! Stok tersedia: ' . $produk->jumlah);
        }

        // Kurangi stok produk
        $produk->decrement('jumlah', $validated['jumlah_beli']);

        Pembeli::create([
            'pelanggan_id' => $validated['pelanggan_id'],
            'produk_id' => $validated['produk_id'],
            'jumlah_beli' => $validated['jumlah_beli'],
            'total_harga' => $validated['total_harga'],
            'tanggal_beli' => $validated['tanggal_beli'],
            'status_pembayaran' => $validated['status_pembayaran'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('pembeli.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembeli $pembeli)
    {
        $pembeli->load(['pelanggan', 'produk']);
        return view('pembeli.detail', compact('pembeli'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembeli $pembeli)
    {
        $pelanggan = Pelanggan::where('status', 'aktif')->get();
        $produk = Produk::all();
        return view('pembeli.edit', compact('pembeli', 'pelanggan', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembeli $pembeli)
    {
        $validated = $request->validate([
            'pelanggan_id' => [
                'required',
                'exists:pelanggan,id',
            ],
            'produk_id' => [
                'required',
                'exists:produk,id',
            ],
            'jumlah_beli' => [
                'required',
                'integer',
                'min:1',
            ],
            'total_harga' => [
                'required',
                'numeric',
                'min:0',
            ],
            'tanggal_beli' => [
                'required',
                'date',
            ],
            'status_pembayaran' => [
                'required',
                'in:lunas,belum_lunas,cicilan',
            ],
            'catatan' => [
                'nullable',
            ],
        ], [
            'pelanggan_id.required' => 'Pelanggan wajib dipilih',
            'pelanggan_id.exists' => 'Pelanggan tidak ditemukan',
            'produk_id.required' => 'Produk wajib dipilih',
            'produk_id.exists' => 'Produk tidak ditemukan',
            'jumlah_beli.required' => 'Jumlah beli wajib diisi',
            'jumlah_beli.integer' => 'Jumlah beli harus berupa angka',
            'jumlah_beli.min' => 'Jumlah beli minimal 1',
            'total_harga.required' => 'Total harga wajib diisi',
            'total_harga.numeric' => 'Total harga harus berupa angka',
            'total_harga.min' => 'Total harga tidak boleh negatif',
            'tanggal_beli.required' => 'Tanggal beli wajib diisi',
            'tanggal_beli.date' => 'Format tanggal tidak valid',
            'status_pembayaran.required' => 'Status pembayaran wajib dipilih',
            'status_pembayaran.in' => 'Status pembayaran tidak valid',
        ]);

        // Kembalikan stok lama dan kurangi stok baru jika produk atau jumlah berubah
        if ($pembeli->produk_id != $validated['produk_id'] || $pembeli->jumlah_beli != $validated['jumlah_beli']) {
            // Kembalikan stok produk lama
            $produkLama = Produk::find($pembeli->produk_id);
            $produkLama->increment('jumlah', $pembeli->jumlah_beli);

            // Kurangi stok produk baru
            $produkBaru = Produk::find($validated['produk_id']);
            if ($produkBaru->jumlah < $validated['jumlah_beli']) {
                // Batalkan pengembalian stok jika stok tidak cukup
                $produkLama->decrement('jumlah', $pembeli->jumlah_beli);
                return redirect()->back()->withInput()->with('error', 'Stok produk tidak mencukupi! Stok tersedia: ' . $produkBaru->jumlah);
            }
            $produkBaru->decrement('jumlah', $validated['jumlah_beli']);
        }

        $pembeli->update([
            'pelanggan_id' => $validated['pelanggan_id'],
            'produk_id' => $validated['produk_id'],
            'jumlah_beli' => $validated['jumlah_beli'],
            'total_harga' => $validated['total_harga'],
            'tanggal_beli' => $validated['tanggal_beli'],
            'status_pembayaran' => $validated['status_pembayaran'],
            'catatan' => $validated['catatan'] ?? null,
        ]);

        return redirect()->route('pembeli.index')->with('success', 'Transaksi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembeli $pembeli)
    {
        // Kembalikan stok produk
        $produk = Produk::find($pembeli->produk_id);
        $produk->increment('jumlah', $pembeli->jumlah_beli);

        $pembeli->delete();
        return redirect()->route('pembeli.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
