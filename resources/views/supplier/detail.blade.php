@extends('layouts.app')

@section('title', 'Detail Supplier - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-truck me-1"></i>
                                {{ $supplier->nama }}
                            </div>
                            <span class="badge bg-light text-dark">ID: #{{ $supplier->id }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="text-muted small mb-1">
                                        <i class="fas fa-user me-1"></i>Nama Supplier
                                    </div>
                                    <h5 class="mb-0">{{ $supplier->nama }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="text-muted small mb-1">
                                        <i class="fas fa-map-marker-alt me-1"></i>Kota
                                    </div>
                                    <h5 class="mb-0">{{ $supplier->kota }}</h5>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="text-muted small mb-1">
                                        <i class="fas fa-phone me-1"></i>No. HP
                                    </div>
                                    <h5 class="mb-0">
                                        <a href="tel:{{ $supplier->no_hp }}" class="text-decoration-none">
                                            {{ $supplier->no_hp }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="border rounded p-3 h-100">
                                    <div class="text-muted small mb-1">
                                        <i class="fas fa-home me-1"></i>Alamat
                                    </div>
                                    <p class="mb-0">{{ $supplier->alamat }}</p>
                                </div>
                            </div>
                        </div>

                        @if($supplier->created_at || $supplier->updated_at)
                            <hr>
                            <div class="row">
                                @if($supplier->created_at)
                                    <div class="col-md-6">
                                        <div class="text-muted small">
                                            <i class="fas fa-calendar-plus me-1"></i>Dibuat pada
                                        </div>
                                        <div>{{ $supplier->created_at->format('d M Y, H:i') }}</div>
                                    </div>
                                @endif
                                @if($supplier->updated_at)
                                    <div class="col-md-6">
                                        <div class="text-muted small">
                                            <i class="fas fa-calendar-check me-1"></i>Terakhir diupdate
                                        </div>
                                        <div>{{ $supplier->updated_at->format('d M Y, H:i') }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex gap-2">
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Edit Supplier
                            </a>
                            <a href="{{ route('supplier.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" class="ms-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Yakin ingin menghapus supplier ini?')">
                                    <i class="fas fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Contact Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-address-card me-1"></i>
                        Kontak Supplier
                    </div>
                    <div class="card-body text-center">
                        <div class="display-1 text-success mb-3">
                            <i class="fas fa-building"></i>
                        </div>
                        <h5>{{ $supplier->nama }}</h5>
                        <p class="text-muted mb-3">
                            <i class="fas fa-map-marker-alt me-1"></i>{{ $supplier->kota }}
                        </p>
                        <a href="tel:{{ $supplier->no_hp }}" class="btn btn-outline-success w-100">
                            <i class="fas fa-phone me-1"></i> Hubungi Supplier
                        </a>
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
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-edit me-1"></i> Edit Supplier
                            </a>
                            <a href="{{ route('supplier.create') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-plus me-1"></i> Tambah Supplier Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection