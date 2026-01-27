@extends('layouts.app')

@section('title', 'Edit Supplier - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-edit me-1"></i>
                        Form Edit Supplier
                    </div>
                    <div class="card-body">
                        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" id="supplierForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    <i class="fas fa-user me-1"></i>Nama Supplier <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" placeholder="Masukkan nama supplier"
                                    value="{{ old('nama', $supplier->nama) }}" required>
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
                                    name="kota" placeholder="Masukkan nama kota" value="{{ old('kota', $supplier->kota) }}"
                                    required>
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
                                    name="no_hp" placeholder="Masukkan no. handphone"
                                    value="{{ old('no_hp', $supplier->no_hp) }}" required>
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
                                    required>{{ old('alamat', $supplier->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Supplier
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
                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <i class="fas fa-info-circle me-1"></i>
                        Informasi Supplier
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="text-muted">ID Supplier</td>
                                <td><strong>#{{ $supplier->id }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nama</td>
                                <td>{{ $supplier->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">Kota</td>
                                <td><i class="fas fa-map-marker-alt text-muted me-1"></i>{{ $supplier->kota }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted">No. HP</td>
                                <td><i class="fas fa-phone text-muted me-1"></i>{{ $supplier->no_hp }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="card mb-4 bg-light">
                    <div class="card-header">
                        <i class="fas fa-lightbulb me-1"></i>
                        Tips
                    </div>
                    <div class="card-body">
                        <p class="small text-muted mb-0">
                            <i class="fas fa-asterisk text-danger me-1"></i>
                            Perubahan akan langsung tersimpan setelah menekan tombol "Update Supplier"
                        </p>
                    </div>
                </div>

                <!-- Zona Berbahaya -->
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        Zona Berbahaya
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Tindakan ini tidak dapat dibatalkan. Supplier akan dihapus
                            permanen.</p>
                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                onclick="return confirm('Yakin ingin menghapus supplier ini? Tindakan ini tidak dapat dibatalkan!')">
                                <i class="fas fa-trash me-1"></i> Hapus Supplier
                            </button>
                        </form>
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