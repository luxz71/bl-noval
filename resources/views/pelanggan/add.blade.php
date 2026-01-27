@extends('layouts.app')

@section('title', 'Tambah Pelanggan - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active">Tambah Pelanggan</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-primary text-white">
                        <i class="fas fa-user-plus me-1"></i>
                        Form Tambah Pelanggan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pelanggan.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama pelanggan" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" placeholder="Masukkan email pelanggan" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukkan nomor HP">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3"
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                                    required>
                                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak_aktif" {{ old('status') == 'tidak_aktif' ? 'selected' : '' }}>Tidak
                                        Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                                <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 shadow border-info">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-info-circle me-1"></i> Panduan
                    </div>
                    <div class="card-body">
                        <ul class="mb-0 ps-3">
                            <li class="mb-2"><strong>Nama:</strong> Hanya huruf dan spasi yang diperbolehkan</li>
                            <li class="mb-2"><strong>Email:</strong> Harus unik dan format email valid</li>
                            <li class="mb-2"><strong>No. HP:</strong> Hanya angka yang diperbolehkan (opsional)</li>
                            <li class="mb-2"><strong>Alamat:</strong> Alamat lengkap pelanggan (opsional)</li>
                            <li><strong>Status:</strong> Pelanggan aktif dapat melakukan transaksi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection