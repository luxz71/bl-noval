<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pelanggan::withCount('pembelian');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
        }

        if ($request->has('status') && $request->input('status') != '') {
            $query->where('status', $request->input('status'));
        }

        $data = $query->latest()->get();
        return view('pelanggan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'email',
                'unique:pelanggan,email',
            ],
            'no_hp' => [
                'nullable',
                'regex:/^[0-9]+$/',
            ],
            'alamat' => [
                'nullable',
            ],
            'status' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ], [
            'nama.required' => 'Nama pelanggan wajib diisi',
            'nama.regex' => 'Nama pelanggan hanya boleh berisi huruf dan spasi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.regex' => 'No. HP hanya boleh berisi angka',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        Pelanggan::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        $pelanggan->load(['pembelian.produk']);
        return view('pelanggan.detail', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/',
            ],
            'email' => [
                'required',
                'email',
                'unique:pelanggan,email,' . $pelanggan->id,
            ],
            'no_hp' => [
                'nullable',
                'regex:/^[0-9]+$/',
            ],
            'alamat' => [
                'nullable',
            ],
            'status' => [
                'required',
                'in:aktif,tidak_aktif',
            ],
        ], [
            'nama.required' => 'Nama pelanggan wajib diisi',
            'nama.regex' => 'Nama pelanggan hanya boleh berisi huruf dan spasi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.regex' => 'No. HP hanya boleh berisi angka',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        $pelanggan->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus!');
    }
}
