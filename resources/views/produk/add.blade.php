@extends('layouts.app')

@section('title', 'Tambah Produk - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus-circle me-1"></i>
                        Form Tambah Produk Baru
                    </div>
                    <div class="card-body">
                        <form action="{{ route('produk.store') }}" method="POST" id="productForm">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">
                                    <i class="fas fa-tag me-1"></i>Nama Barang <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                    id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang"
                                    value="{{ old('nama_barang') }}" required>
                                @error('nama_barang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Nama barang hanya boleh berisi huruf dan spasi</div>
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">
                                    <i class="fas fa-sort-numeric-up me-1"></i>Jumlah <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                    name="jumlah" placeholder="Masukkan jumlah stok" value="{{ old('jumlah') }}" min="0"
                                    required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Masukkan jumlah stok produk (hanya angka)</div>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">
                                    <i class="fas fa-money-bill me-1"></i>Harga (Rp) <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                    name="harga" placeholder="Masukkan harga produk" value="{{ old('harga') }}" min="0"
                                    step="1000" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Masukkan harga satuan produk</div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Produk
                                </button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4 bg-light">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-1"></i>
                        Panduan
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Tips Pengisian Form</h6>
                        <ul class="small mb-0">
                            <li class="mb-2"><strong>Nama Barang:</strong> Gunakan nama yang jelas dan mudah dikenali</li>
                            <li class="mb-2"><strong>Jumlah:</strong> Stok awal produk yang tersedia</li>
                            <li class="mb-2"><strong>Harga:</strong> Harga satuan produk dalam Rupiah</li>
                        </ul>
                        <hr>
                        <p class="small text-muted mb-0">
                            <i class="fas fa-asterisk text-danger me-1"></i>
                            Field dengan tanda bintang wajib diisi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('productForm').addEventListener('submit', function (e) {
            const namaBarang = document.getElementById('nama_barang').value.trim();
            const jumlah = document.getElementById('jumlah').value.trim();
            const harga = document.getElementById('harga').value.trim();

            // Validasi jumlah (harus angka positif)
            if (jumlah === '' || isNaN(jumlah) || parseInt(jumlah) < 0) {
                e.preventDefault();
                alert('Jumlah harus berupa angka positif!');
                return false;
            }

            // Validasi harga (harus angka positif)
            if (harga === '' || isNaN(harga) || parseFloat(harga) < 0) {
                e.preventDefault();
                alert('Harga harus berupa angka positif!');
                return false;
            }
        });
    </script>
@endsection