@extends('layouts.app')

@section('title', 'Edit Transaksi - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pembeli.index') }}">Transaksi</a></li>
            <li class="breadcrumb-item active">Edit Transaksi</li>
        </ol>

        <!-- Alert Error -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-warning text-dark">
                        <i class="fas fa-edit me-1"></i>
                        Form Edit Transaksi
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pembeli.update', $pembeli->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pelanggan_id" class="form-label">Pelanggan <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('pelanggan_id') is-invalid @enderror"
                                            id="pelanggan_id" name="pelanggan_id" required>
                                            <option value="">-- Pilih Pelanggan --</option>
                                            @foreach($pelanggan as $p)
                                                <option value="{{ $p->id }}" {{ old('pelanggan_id', $pembeli->pelanggan_id) == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama }} ({{ $p->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pelanggan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="produk_id" class="form-label">Produk <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id"
                                            name="produk_id" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($produk as $prod)
                                                <option value="{{ $prod->id }}" data-stok="{{ $prod->jumlah }}" {{ old('produk_id', $pembeli->produk_id) == $prod->id ? 'selected' : '' }}>
                                                    {{ $prod->nama_barang }} (Stok: {{ $prod->jumlah }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('produk_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah_beli" class="form-label">Jumlah Beli <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('jumlah_beli') is-invalid @enderror"
                                            id="jumlah_beli" name="jumlah_beli"
                                            value="{{ old('jumlah_beli', $pembeli->jumlah_beli) }}" min="1" required>
                                        @error('jumlah_beli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="total_harga" class="form-label">Total Harga (Rp) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('total_harga') is-invalid @enderror"
                                            id="total_harga" name="total_harga"
                                            value="{{ old('total_harga', $pembeli->total_harga) }}" min="0" step="1000"
                                            required>
                                        @error('total_harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_beli" class="form-label">Tanggal Beli <span
                                                class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_beli') is-invalid @enderror"
                                            id="tanggal_beli" name="tanggal_beli"
                                            value="{{ old('tanggal_beli', $pembeli->tanggal_beli->format('Y-m-d')) }}"
                                            required>
                                        @error('tanggal_beli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status_pembayaran" class="form-label">Status Pembayaran <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('status_pembayaran') is-invalid @enderror"
                                            id="status_pembayaran" name="status_pembayaran" required>
                                            <option value="belum_lunas" {{ old('status_pembayaran', $pembeli->status_pembayaran) == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas
                                            </option>
                                            <option value="cicilan" {{ old('status_pembayaran', $pembeli->status_pembayaran) == 'cicilan' ? 'selected' : '' }}>Cicilan
                                            </option>
                                            <option value="lunas" {{ old('status_pembayaran', $pembeli->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        </select>
                                        @error('status_pembayaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan"
                                    name="catatan" rows="3"
                                    placeholder="Catatan tambahan (opsional)">{{ old('catatan', $pembeli->catatan) }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-1"></i> Update Transaksi
                                </button>
                                <a href="{{ route('pembeli.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 shadow border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-info-circle me-1"></i> Info Transaksi
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>ID Transaksi:</strong> #{{ $pembeli->id }}</p>
                        <p class="mb-2"><strong>Dibuat:</strong> {{ $pembeli->created_at->format('d M Y H:i') }}</p>
                        <p class="mb-0"><strong>Diupdate:</strong> {{ $pembeli->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="card mb-4 shadow border-danger">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-exclamation-triangle me-1"></i> Zona Berbahaya
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Menghapus transaksi akan mengembalikan stok produk.</p>
                        <form action="{{ route('pembeli.destroy', $pembeli->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                <i class="fas fa-trash me-1"></i> Hapus Transaksi
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection