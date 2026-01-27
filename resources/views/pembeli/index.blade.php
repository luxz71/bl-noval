@extends('layouts.app')

@section('title', 'Daftar Transaksi - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
        </ol>

        <!-- Alert Success/Error -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-gradient bg-info text-white d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-shopping-cart me-1"></i>
                    Data Transaksi Pembelian
                </div>
                <a href="{{ route('pembeli.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Transaksi
                </a>
            </div>
            <div class="card-body">
                <!-- Filter -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form action="{{ route('pembeli.index') }}" method="GET" class="d-flex gap-2">
                            <select name="status_pembayaran" class="form-select form-select-sm"
                                onchange="this.form.submit()">
                                <option value="">-- Semua Status --</option>
                                <option value="lunas" {{ request('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas
                                </option>
                                <option value="belum_lunas" {{ request('status_pembayaran') == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                <option value="cicilan" {{ request('status_pembayaran') == 'cicilan' ? 'selected' : '' }}>
                                    Cicilan</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="50">No</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th width="80">Jumlah</th>
                                <th width="130">Total Harga</th>
                                <th width="110">Tanggal</th>
                                <th width="120">Status</th>
                                <th width="130">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-info bg-opacity-10 rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                style="width: 35px; height: 35px;">
                                                <i class="fas fa-user text-info"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $item->pelanggan->nama ?? '-' }}</strong>
                                                <br><small class="text-muted">{{ $item->pelanggan->email ?? '' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-box text-muted me-1"></i>
                                        <strong>{{ $item->produk->nama_barang ?? '-' }}</strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $item->jumlah_beli }} unit</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">Rp
                                            {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar-alt text-muted me-1"></i>
                                        {{ $item->tanggal_beli->format('d M Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if($item->status_pembayaran == 'lunas')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Lunas</span>
                                        @elseif($item->status_pembayaran == 'cicilan')
                                            <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i>Cicilan</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i>Belum Lunas</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pembeli.show', $item->id) }}" class="btn btn-info btn-sm"
                                                title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pembeli.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pembeli.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus transaksi ini? Stok produk akan dikembalikan.')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-shopping-cart fa-4x mb-3 d-block"></i>
                                            @if(request('search') || request('status_pembayaran'))
                                                <h5>Data tidak ditemukan</h5>
                                                <p class="mb-0">Filter tidak menghasilkan data.</p>
                                            @else
                                                <h5>Belum ada transaksi</h5>
                                                <p class="mb-3">Mulai tambahkan transaksi pertama Anda</p>
                                                <a href="{{ route('pembeli.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-1"></i> Tambah Transaksi Baru
                                                </a>
                                            @endif
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush