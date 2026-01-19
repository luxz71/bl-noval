@extends('layouts.app')

@section('title', 'Edit Produk - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit me-1"></i>
                        Form Edit Produk
                    </div>
                    <div class="card-body">
                        <form action="{{ route('produk.update', $produk->id) }}" method="POST" id="productForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">
                                    <i class="fas fa-tag me-1"></i>Nama Barang <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror"
                                    id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang"
                                    value="{{ old('nama_barang', $produk->nama_barang) }}" required>
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
                                    name="jumlah" placeholder="Masukkan jumlah stok"
                                    value="{{ old('jumlah', $produk->jumlah) }}" min="0" required>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Masukkan jumlah stok produk (hanya angka)</div>
                            </div>

                            <hr class="my-4">

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Produk
                                </button>
                                <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="ms-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4 border-primary">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-info-circle me-1"></i>
                        Informasi Produk
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="text-muted">ID Produk</td>
                                <td><strong>#{{ $produk->id }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nama</td>
                                <td>{{ $produk->nama_barang }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Stok Saat Ini</td>
                                <td>
                                    @if($produk->jumlah > 10)
                                        <span class="badge bg-success">{{ $produk->jumlah }} unit</span>
                                    @elseif($produk->jumlah > 0)
                                        <span class="badge bg-warning text-dark">{{ $produk->jumlah }} unit</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mb-4 bg-light">
                    <div class="card-header">
                        <i class="fas fa-lightbulb me-1"></i>
                        Tips
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-0">
                            <i class="fas fa-asterisk text-danger me-1"></i>
                            Perubahan akan langsung tersimpan setelah menekan tombol "Update Produk"
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

            // Validasi nama barang (hanya huruf dan spasi)
            if (/\d/.test(namaBarang)) {
                e.preventDefault();
                alert('Nama barang hanya boleh berisi huruf dan spasi!');
                return false;
            }

            // Validasi jumlah (harus angka positif)
            if (jumlah === '' || isNaN(jumlah) || parseInt(jumlah) < 0) {
                e.preventDefault();
                alert('Jumlah harus berupa angka positif!');
                return false;
            }
        });
    </script>
@endsection