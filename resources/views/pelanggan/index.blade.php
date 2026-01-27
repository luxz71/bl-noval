@extends('layouts.app')

@section('title', 'Daftar Pelanggan - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pelanggan</li>
        </ol>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-users me-1"></i>
                    Data Pelanggan
                </div>
                <a href="{{ route('pelanggan.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Pelanggan
                </a>
            </div>
            <div class="card-body">
                <!-- Filter -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <form action="{{ route('pelanggan.index') }}" method="GET" class="d-flex gap-2">
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="">-- Semua Status --</option>
                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="tidak_aktif" {{ request('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatablesSimple" class="table table-striped table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="60">No</th>
                                <th>Nama Pelanggan</th>
                                <th>Email</th>
                                <th width="130">No. HP</th>
                                <th width="100">Status</th>
                                <th width="100">Transaksi</th>
                                <th width="150">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px;">
                                                <i class="fas fa-user text-primary"></i>
                                            </div>
                                            <div>
                                                <strong>{{ $item->nama }}</strong>
                                                @if($item->alamat)
                                                    <br><small class="text-muted"><i
                                                            class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($item->alamat, 30) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope text-muted me-1"></i>{{ $item->email }}
                                    </td>
                                    <td>
                                        @if($item->no_hp)
                                            <i class="fas fa-phone text-muted me-1"></i>{{ $item->no_hp }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'aktif')
                                            <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Aktif</span>
                                        @else
                                            <span class="badge bg-secondary"><i class="fas fa-times-circle me-1"></i>Tidak
                                                Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info">{{ $item->pembelian_count }} transaksi</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('pelanggan.show', $item->id) }}" class="btn btn-info btn-sm"
                                                title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('pelanggan.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pelanggan.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus pelanggan ini? Semua transaksi terkait juga akan dihapus.')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-users fa-4x mb-3 d-block"></i>
                                            @if(request('search') || request('status'))
                                                <h5>Data tidak ditemukan</h5>
                                                <p class="mb-0">Filter atau penelusuran tidak menghasilkan data.</p>
                                            @else
                                                <h5>Belum ada pelanggan</h5>
                                                <p class="mb-3">Mulai tambahkan pelanggan pertama Anda</p>
                                                <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-1"></i> Tambah Pelanggan Baru
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