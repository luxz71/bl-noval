@extends('layouts.app')

@section('title', 'Tambah Supplier - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-plus-circle me-1"></i>
                        Form Tambah Supplier Baru
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supplier.store') }}" method="POST" id="supplierForm">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Supplier <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" placeholder="Masukkan nama supplier" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Nama supplier hanya boleh berisi huruf dan spasi</div>
                            </div>

                            <div class="mb-3">
                                <label for="kota" class="form-label">
                                    <i class="fas fa-map-marker-alt me-1"></i>Kota <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('kota') is-invalid @enderror" id="kota"
                                    name="kota" placeholder="Masukkan nama kota" value="{{ old('kota') }}" required>
                                @error('kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Kota hanya boleh berisi huruf dan spasi</div>
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">
                                    <i class="fas fa-phone me-1"></i>No. HP <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" placeholder="Masukkan no. handphone" value="{{ old('no_hp') }}" required>
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">No. HP hanya boleh berisi angka</div>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">
                                    <i class="fas fa-home me-1"></i>Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                                    required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan Supplier
                                </button>
                                <a href="{{ route('supplier.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4 bg-light">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-1"></i>
                        Panduan
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Tips Pengisian Form</h6>
                        <ul class="small mb-0">
                            <li class="mb-2"><strong>Nama:</strong> Nama lengkap supplier atau perusahaan</li>
                            <li class="mb-2"><strong>Kota:</strong> Lokasi kota supplier</li>
                            <li class="mb-2"><strong>No. HP:</strong> Nomor yang dapat dihubungi</li>
                            <li class="mb-2"><strong>Alamat:</strong> Alamat lengkap supplier</li>
                        </ul>
                        <hr>
                        <p class="small text-muted mb-0">
                            <i class="fas fa-asterisk text-danger me-1"></i>
                            Field dengan tanda bintang wajib diisi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('supplierForm').addEventListener('submit', function (e) {
            const nama = document.getElementById('nama').value.trim();
            const kota = document.getElementById('kota').value.trim();
            const noHp = document.getElementById('no_hp').value.trim();
            const alamat = document.getElementById('alamat').value.trim();

            // Validasi nama (hanya huruf dan spasi)
            if (/\d/.test(nama)) {
                e.preventDefault();
                alert('Nama supplier hanya boleh berisi huruf dan spasi!');
                return false;
            }

            // Validasi kota (hanya huruf dan spasi)
            if (/\d/.test(kota)) {
                e.preventDefault();
                alert('Kota hanya boleh berisi huruf dan spasi!');
                return false;
            }

            // Validasi no hp (harus angka)
            if (!/^\d+$/.test(noHp)) {
                e.preventDefault();
                alert('No. HP harus berupa angka!');
                return false;
            }

            // Validasi alamat
            if (alamat === '') {
                e.preventDefault();
                alert('Alamat wajib diisi!');
                return false;
            }
        });
    </script>
@endsection