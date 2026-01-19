@extends('layouts.app')

@section('title', 'Daftar Produk - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Produk</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Produk</li>
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
                    <i class="fas fa-box me-1"></i>
                    Data Produk
                </div>
                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Tambah Produk
                </a>
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Barang</th>
                            <th width="120">Jumlah</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->nama_barang }}</strong>
                                </td>
                                <td class="text-center">
                                    @if($item->jumlah > 10)
                                        <span class="badge bg-success">{{ $item->jumlah }} unit</span>
                                    @elseif($item->jumlah > 0)
                                        <span class="badge bg-warning text-dark">{{ $item->jumlah }} unit</span>
                                    @else
                                        <span class="badge bg-danger">Habis</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('produk.show', $item->id) }}" class="btn btn-info btn-sm"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-box-open fa-4x mb-3 d-block"></i>
                                        <h5>Belum ada produk</h5>
                                        <p class="mb-3">Mulai tambahkan produk pertama Anda</p>
                                        <a href="{{ route('produk.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Tambah Produk Baru
                                        </a>
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