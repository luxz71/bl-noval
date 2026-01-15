<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Supplier::all();
        return view('supplier.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'kota' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/', // Hanya huruf dan spasi
            ],
            'no_hp' => [
                'required',
                'regex:/^[0-9]+$/', // Hanya angka
            ],
            'alamat' => [
                'required',
            ],
        ], [
            'nama.required' => 'Nama supplier wajib diisi',
            'nama.regex' => 'Nama supplier hanya boleh berisi huruf dan spasi',
            'kota.required' => 'Kota wajib diisi',
            'kota.regex' => 'Kota hanya boleh berisi huruf dan spasi',
            'no_hp.required' => 'No. HP wajib diisi',
            'no_hp.regex' => 'No. HP hanya boleh berisi angka',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        // Simpan data
        Supplier::create([
            'nama' => $validated['nama'],
            'kota' => $validated['kota'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.detail', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'kota' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'no_hp' => [
                'required',
                'regex:/^[0-9]+$/',
            ],
            'alamat' => [
                'required',
            ],
        ], [
            'nama.required' => 'Nama supplier wajib diisi',
            'nama.regex' => 'Nama supplier hanya boleh berisi huruf dan spasi',
            'kota.required' => 'Kota wajib diisi',
            'kota.regex' => 'Kota hanya boleh berisi huruf dan spasi',
            'no_hp.required' => 'No. HP wajib diisi',
            'no_hp.regex' => 'No. HP hanya boleh berisi angka',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        $supplier->update([
            'nama' => $validated['nama'],
            'kota' => $validated['kota'],
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}
