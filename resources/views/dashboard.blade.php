@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <!-- Statistik Cards - Row 1 -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-white-50">Total Produk</div>
                                <div class="fs-3 fw-bold">{{ $totalProduk }}</div>
                            </div>
                            <i class="fas fa-box fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('produk.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-white-50">Total Supplier</div>
                                <div class="fs-3 fw-bold">{{ $totalSupplier }}</div>
                            </div>
                            <i class="fas fa-truck fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('supplier.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-info text-white mb-4 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-white-50">Total Pelanggan</div>
                                <div class="fs-3 fw-bold">{{ $totalPelanggan }}</div>
                            </div>
                            <i class="fas fa-users fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('pelanggan.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4 shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="small text-white-50">Stok Rendah</div>
                                <div class="fs-3 fw-bold">{{ $stokRendah }}</div>
                            </div>
                            <i class="fas fa-exclamation-triangle fa-2x text-white-50"></i>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('produk.index') }}">Lihat Detail</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Cards - Row 2 (Transaksi) -->
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-primary border-4 mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">Pelanggan Aktif</div>
                                <div class="fs-4 fw-bold text-primary">{{ $pelangganAktif }}</div>
                            </div>
                            <i class="fas fa-user-check fa-2x text-primary opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-success border-4 mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">Total Transaksi</div>
                                <div class="fs-4 fw-bold text-success">{{ $totalTransaksi }}</div>
                            </div>
                            <i class="fas fa-shopping-cart fa-2x text-success opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-info border-4 mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">Transaksi Bulan Ini</div>
                                <div class="fs-4 fw-bold text-info">{{ $transaksiBulanIni }}</div>
                            </div>
                            <i class="fas fa-calendar-check fa-2x text-info opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-start border-warning border-4 mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">Pendapatan Bulan Ini</div>
                                <div class="fs-4 fw-bold text-warning">Rp
                                    {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</div>
                            </div>
                            <i class="fas fa-money-bill-wave fa-2x text-warning opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data - Row 3 -->
        <div class="row">
            <!-- Tabel Pelanggan Terbaru -->
            <div class="col-xl-6">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-users me-2"></i>
                                Pelanggan Terbaru
                            </div>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-eye"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No. HP</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelangganTerbaru as $pelanggan)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                        style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user text-primary"></i>
                                                    </div>
                                                    <span class="fw-medium">{{ $pelanggan->nama }}</span>
                                                </div>
                                            </td>
                                            <td class="text-muted">{{ $pelanggan->email }}</td>
                                            <td>{{ $pelanggan->no_hp ?? '-' }}</td>
                                            <td>
                                                @if($pelanggan->status == 'aktif')
                                                    <span class="badge bg-success"><i
                                                            class="fas fa-check-circle me-1"></i>Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i>Tidak
                                                        Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <p class="mb-0">Belum ada data pelanggan</p>
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

            <!-- Tabel Top Pelanggan -->
            <div class="col-xl-6">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-trophy me-2"></i>
                                Top Pelanggan (Transaksi Terbanyak)
                            </div>
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-eye"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Total Transaksi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topPelanggan as $index => $pelanggan)
                                        <tr>
                                            <td>
                                                @if($index == 0)
                                                    <span class="badge bg-warning text-dark"><i class="fas fa-crown"></i> 1</span>
                                                @elseif($index == 1)
                                                    <span class="badge bg-secondary">2</span>
                                                @elseif($index == 2)
                                                    <span class="badge bg-danger">3</span>
                                                @else
                                                    <span class="badge bg-light text-dark">{{ $index + 1 }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{ $pelanggan->nama }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $pelanggan->pembelian_count }} transaksi</span>
                                            </td>
                                            <td>
                                                @if($pelanggan->status == 'aktif')
                                                    <span class="badge bg-success"><i
                                                            class="fas fa-check-circle me-1"></i>Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i>Tidak
                                                        Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-trophy fa-3x mb-3"></i>
                                                    <p class="mb-0">Belum ada data pelanggan</p>
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

        <!-- Tabel Transaksi Terbaru - Full Width -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-shopping-cart me-2"></i>
                                Transaksi Pembelian Terbaru
                            </div>
                            <a href="{{ route('pembeli.index') }}" class="btn btn-sm btn-light">
                                <i class="fas fa-eye"></i> Lihat Semua
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Pelanggan</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($transaksiTerbaru as $index => $transaksi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-info bg-opacity-10 rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                        style="width: 35px; height: 35px;">
                                                        <i class="fas fa-user text-info"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-medium">{{ $transaksi->pelanggan->nama ?? '-' }}</span>
                                                        <br>
                                                        <small
                                                            class="text-muted">{{ $transaksi->pelanggan->email ?? '' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="fw-medium">{{ $transaksi->produk->nama_barang ?? '-' }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $transaksi->jumlah_beli }} unit</span>
                                            </td>
                                            <td>
                                                <span class="fw-bold text-success">Rp
                                                    {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                                            </td>
                                            <td>
                                                <i class="fas fa-calendar-alt text-muted me-1"></i>
                                                {{ $transaksi->tanggal_beli->format('d M Y') }}
                                            </td>
                                            <td>
                                                @if($transaksi->status_pembayaran == 'lunas')
                                                    <span class="badge bg-success"><i
                                                            class="fas fa-check-circle me-1"></i>Lunas</span>
                                                @elseif($transaksi->status_pembayaran == 'cicilan')
                                                    <span class="badge bg-warning text-dark"><i
                                                            class="fas fa-clock me-1"></i>Cicilan</span>
                                                @else
                                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Belum
                                                        Lunas</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                                                    <p class="mb-0">Belum ada data transaksi</p>
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