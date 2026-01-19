@extends('layouts.app')

@section('title', 'Detail Produk - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-box me-1"></i>
                                {{ $produk->nama_barang }}
                            </div>
                            <span class="badge bg-light text-dark">ID: #{{ $produk->id }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="text-muted small mb-1">
                                        <i class="fas fa-tag me-1"></i>Nama Barang
                                    </div>
                                    <h5 class="mb-0">{{ $produk->nama_barang }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="text-muted small mb-1">
                                        <i class="fas fa-cubes me-1"></i>Jumlah Stok
                                    </div>
                                    <h5 class="mb-0">
                                        @if($produk->jumlah > 10)
                                            <span class="badge bg-success fs-6">{{ $produk->jumlah }} unit</span>
                                            <small class="text-success ms-2"><i class="fas fa-check-circle"></i> Stok
                                                Tersedia</small>
                                        @elseif($produk->jumlah > 0)
                                            <span class="badge bg-warning text-dark fs-6">{{ $produk->jumlah }} unit</span>
                                            <small class="text-warning ms-2"><i class="fas fa-exclamation-triangle"></i> Stok
                                                Rendah</small>
                                        @else
                                            <span class="badge bg-danger fs-6">0 unit</span>
                                            <small class="text-danger ms-2"><i class="fas fa-times-circle"></i> Stok
                                                Habis</small>
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>

                        @if($produk->created_at || $produk->updated_at)
                            <hr>
                            <div class="row">
                                @if($produk->created_at)
                                    <div class="col-md-6">
                                        <div class="text-muted small">
                                            <i class="fas fa-calendar-plus me-1"></i>Dibuat pada
                                        </div>
                                        <div>{{ $produk->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                @endif
                                @if($produk->updated_at)
                                    <div class="col-md-6">
                                        <div class="text-muted small">
                                            <i class="fas fa-calendar-check me-1"></i>Terakhir diupdate
                                        </div>
                                        <div>{{ $produk->updated_at->format('d M Y, H:i') }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex gap-2">
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit Produk
                            </a>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="ms-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Quick Stats Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Status Stok
                    </div>
                    <div class="card-body text-center">
                        @if($produk->jumlah > 10)
                            <div class="display-1 text-success mb-2">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h5 class="text-success">Stok Aman</h5>
                            <p class="text-muted small">Stok produk masih mencukupi</p>
                        @elseif($produk->jumlah > 0)
                            <div class="display-1 text-warning mb-2">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <h5 class="text-warning">Stok Menipis</h5>
                            <p class="text-muted small">Segera lakukan restok produk</p>
                        @else
                            <div class="display-1 text-danger mb-2">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h5 class="text-danger">Stok Habis</h5>
                            <p class="text-muted small">Produk perlu segera direstok</p>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card mb-4 bg-light">
                    <div class="card-header">
                        <i class="fas fa-bolt me-1"></i>
                        Aksi Cepat
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit Produk
                            </a>
                            <a href="{{ route('produk.create') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-plus me-1"></i> Tambah Produk Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection