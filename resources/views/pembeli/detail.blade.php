@extends('layouts.app')

@section('title', 'Detail Transaksi - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pembeli.index') }}">Transaksi</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>

        <div class="row">
            <!-- Info Transaksi -->
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div
                        class="card-header bg-gradient bg-info text-white d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-shopping-cart me-1"></i>
                            Informasi Transaksi #{{ $pembeli->id }}
                        </div>
                        @if($pembeli->status_pembayaran == 'lunas')
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Lunas</span>
                        @elseif($pembeli->status_pembayaran == 'cicilan')
                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Cicilan</span>
                        @else
                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Belum Lunas</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><i class="fas fa-box text-muted me-2"></i>Produk</td>
                                        <td><strong>{{ $pembeli->produk->nama_barang ?? '-' }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-cubes text-muted me-2"></i>Jumlah Beli</td>
                                        <td><span class="badge bg-primary">{{ $pembeli->jumlah_beli }} unit</span></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-money-bill text-muted me-2"></i>Total Harga</td>
                                        <td><span class="fs-5 fw-bold text-success">Rp
                                                {{ number_format($pembeli->total_harga, 0, ',', '.') }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><i class="fas fa-calendar text-muted me-2"></i>Tanggal Beli</td>
                                        <td><strong>{{ $pembeli->tanggal_beli->format('d M Y') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-clock text-muted me-2"></i>Dibuat</td>
                                        <td>{{ $pembeli->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-edit text-muted me-2"></i>Diupdate</td>
                                        <td>{{ $pembeli->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        @if($pembeli->catatan)
                            <hr>
                            <div class="mb-0">
                                <h6><i class="fas fa-sticky-note text-muted me-2"></i>Catatan</h6>
                                <p class="mb-0 text-muted">{{ $pembeli->catatan }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pembeli.edit', $pembeli->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('pembeli.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Pelanggan -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-primary text-white">
                        <i class="fas fa-user me-1"></i>
                        Informasi Pelanggan
                    </div>
                    <div class="card-body text-center">
                        <div class="avatar-lg bg-primary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                        <h5 class="mb-1">{{ $pembeli->pelanggan->nama ?? '-' }}</h5>
                        @if($pembeli->pelanggan)
                            @if($pembeli->pelanggan->status == 'aktif')
                                <span class="badge bg-success mb-3"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                            @else
                                <span class="badge bg-secondary mb-3"><i class="fas fa-times-circle me-1"></i>Tidak Aktif</span>
                            @endif
                        @endif
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-envelope text-muted me-2"></i>Email</span>
                            <strong>{{ $pembeli->pelanggan->email ?? '-' }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-phone text-muted me-2"></i>No. HP</span>
                            <strong>{{ $pembeli->pelanggan->no_hp ?? '-' }}</strong>
                        </li>
                    </ul>
                    @if($pembeli->pelanggan)
                        <div class="card-footer">
                            <a href="{{ route('pelanggan.show', $pembeli->pelanggan->id) }}"
                                class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-eye me-1"></i> Lihat Detail Pelanggan
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection