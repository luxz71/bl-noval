@extends('layouts.app')

@section('title', 'Detail Pelanggan - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>

        <div class="row">
            <!-- Info Pelanggan -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-primary text-white">
                        <i class="fas fa-user me-1"></i>
                        Informasi Pelanggan
                    </div>
                    <div class="card-body text-center">
                        <div class="avatar-lg bg-primary bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center"
                            style="width: 80px; height: 80px;">
                            <i class="fas fa-user fa-2x text-primary"></i>
                        </div>
                        <h4 class="mb-1">{{ $pelanggan->nama }}</h4>
                        @if($pelanggan->status == 'aktif')
                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                        @else
                            <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i>Tidak Aktif</span>
                        @endif
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-envelope text-muted me-2"></i>Email</span>
                            <strong>{{ $pelanggan->email }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-phone text-muted me-2"></i>No. HP</span>
                            <strong>{{ $pelanggan->no_hp ?? '-' }}</strong>
                        </li>
                        <li class="list-group-item">
                            <div class="mb-1"><i class="fas fa-map-marker-alt text-muted me-2"></i>Alamat</div>
                            <p class="mb-0 text-muted">{{ $pelanggan->alamat ?? '-' }}</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-calendar text-muted me-2"></i>Terdaftar</span>
                            <strong>{{ $pelanggan->created_at->format('d M Y') }}</strong>
                        </li>
                    </ul>
                    <div class="card-footer">
                        <div class="d-flex gap-2">
                            <a href="{{ route('pelanggan.edit', $pelanggan->id) }}"
                                class="btn btn-warning btn-sm flex-fill">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary btn-sm flex-fill">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Statistik -->
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-success text-white">
                        <i class="fas fa-chart-bar me-1"></i>
                        Statistik Transaksi
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <h3 class="text-primary mb-0">{{ $pelanggan->pembelian->count() }}</h3>
                                <small class="text-muted">Total Transaksi</small>
                            </div>
                            <div class="col-6">
                                <h5 class="text-success mb-0">Rp
                                    {{ number_format($pelanggan->pembelian->sum('total_harga'), 0, ',', '.') }}</h5>
                                <small class="text-muted">Total Belanja</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Riwayat Transaksi -->
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div
                        class="card-header bg-gradient bg-info text-white d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-shopping-cart me-1"></i>
                            Riwayat Transaksi
                        </div>
                        <a href="{{ route('pembeli.create') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-plus me-1"></i> Transaksi Baru
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelanggan->pembelian as $index => $transaksi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $transaksi->produk->nama_barang ?? '-' }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $transaksi->jumlah_beli }} unit</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">Rp
                                                    {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                {{ $transaksi->tanggal_beli->format('d M Y') }}
                                            </td>
                                            <td>
                                                @if($transaksi->status_pembayaran == 'lunas')
                                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Lunas</span>
                                                @elseif($transaksi->status_pembayaran == 'cicilan')
                                                    <span class="badge bg-warning text-dark"><i
                                                            class="fas fa-clock me-1"></i>Cicilan</span>
                                                @else
                                                    <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Belum
                                                        Lunas</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                                    <p class="mb-0">Belum ada riwayat transaksi</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection