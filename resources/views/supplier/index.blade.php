@extends('layouts.app')

@section('title', 'Daftar Supplier - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Supplier</li>
        </ol>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Card -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-truck me-1"></i>
                    Data Supplier
                </div>
                <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Supplier
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Supplier</th>
                            <th width="120">Kota</th>
                            <th width="140">No. HP</th>
                            <th>Alamat</th>
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->nama }}</strong>
                                </td>
                                <td>
                                    <i class="fas fa-map-marker-alt text-muted me-1"></i>{{ $item->kota }}
                                </td>
                                <td>
                                    <i class="fas fa-phone text-muted me-1"></i>{{ $item->no_hp }}
                                </td>
                                <td>
                                    <small class="text-muted">{{ Str::limit($item->alamat, 40) }}</small>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('supplier.show', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('supplier.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('supplier.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus supplier ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-building fa-4x mb-3 d-block"></i>
                                        @if(request('search'))
                                            <h5>Data tidak ditemukan</h5>
                                            <p class="mb-0">Penelusuran untuk "<strong>{{ request('search') }}</strong>" tidak
                                                menghasilkan apa-apa.</p>
                                        @else
                                            <h5>Belum ada supplier</h5>
                                            <p class="mb-3">Mulai tambahkan supplier pertama Anda</p>
                                            <a href="{{ route('supplier.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i> Tambah Supplier Baru
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
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush