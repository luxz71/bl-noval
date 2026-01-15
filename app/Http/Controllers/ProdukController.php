<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::all();
        return view('produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // Menampilkan halaman form (Add)
    public function create()
    {
        return view('produk.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'jumlah' => [
                'required',
                'numeric', // Hanya angka
                'min:1', // Minimal 1
            ],
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi',
            'nama_barang.regex' => 'Nama barang hanya boleh berisi huruf dan spasi',
            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.numeric' => 'Jumlah hanya boleh berisi angka',
            'jumlah.min' => 'Jumlah minimal 1',
        ]);

        // Simpan data
        Produk::create([
            'nama_barang' => $validated['nama_barang'],
            'jumlah' => $validated['jumlah'],
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    /*     
        public function show($id) 
        {
            //var_dump($id);
            $produk = Produk::findOrFail($id);
            //dd($produk);
            //dd($produk);
            return view('produk.detail', compact('produk'));
        }
         */


    public function show(Produk $produk)
    {
        return view('produk.detail', compact('produk'));
    }

    /* 
    public function show(Produk $produk)
    {
        // Seperti perintah Tinker: $p = Produk::find(1)
        $produk = Produk::findOrFail($id);
        // Kirim data ke view detail
        return view('produk.detail', compact('produk'));
    }
 */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $produk->update([
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->route('produk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index');
    }
}
