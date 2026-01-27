@extends('layouts.app')

@section('title', 'Edit Pelanggan - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Pelanggan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pelanggan.index') }}">Pelanggan</a></li>
            <li class="breadcrumb-item active">Edit Pelanggan</li>
        </ol>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-warning text-dark">
                        <i class="fas fa-user-edit me-1"></i>
                        Form Edit Pelanggan
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pelanggan.update', $pelanggan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pelanggan <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                    name="nama" value="{{ old('nama', $pelanggan->nama) }}"
                                    placeholder="Masukkan nama pelanggan" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email', $pelanggan->email) }}"
                                    placeholder="Masukkan email pelanggan" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="no_hp" class="form-label">No. HP</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                    name="no_hp" value="{{ old('no_hp', $pelanggan->no_hp) }}"
                                    placeholder="Masukkan nomor HP">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                    name="alamat" rows="3"
                                    placeholder="Masukkan alamat lengkap">{{ old('alamat', $pelanggan->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                                    required>
                                    <option value="aktif" {{ old('status', $pelanggan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="tidak_aktif" {{ old('status', $pelanggan->status) == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save me-1"></i> Update
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
                <div class="card mb-4 shadow border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <i class="fas fa-info-circle me-1"></i> Info Pelanggan
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>ID:</strong> {{ $pelanggan->id }}</p>
                        <p class="mb-2"><strong>Dibuat:</strong> {{ $pelanggan->created_at->format('d M Y H:i') }}</p>
                        <p class="mb-0"><strong>Diupdate:</strong> {{ $pelanggan->updated_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="card mb-4 shadow border-danger">
                    <div class="card-header bg-danger text-white">
                        <i class="fas fa-exclamation-triangle me-1"></i> Zona Berbahaya
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Tindakan ini tidak dapat dibatalkan. Semua transaksi terkait
                            pelanggan ini juga akan dihapus.</p>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100"
                                onclick="return confirm('Yakin ingin menghapus pelanggan ini? Semua data transaksi terkait juga akan dihapus!')">
                                <i class="fas fa-trash me-1"></i> Hapus Pelanggan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection