@extends('layouts.app')

@section('title', 'Tambah Supplier - BL-Noval')

@section('content')
    <style>
        .form-container {
            max-width: 600px;
        }

        .form-card {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: border-color 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus {
            outline: none;
            border-color: #333;
        }

        .form-group input.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 0.25rem;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-family: 'Inter', sans-serif;
        }

        .btn-primary {
            background: #333;
            color: white;
        }

        .btn-primary:hover {
            background: #000;
        }

        .btn-primary:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: #fff;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .btn-secondary:hover {
            background: #f8f8f8;
        }
    </style>

    <div class="form-container">
        <div class="page-header">
            <h1>Tambah Supplier Baru</h1>
            <p>Isi form di bawah untuk menambahkan supplier</p>
        </div>

        <div class="form-card">
            <form action="{{ route('supplier.store') }}" method="POST" id="supplierForm">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Supplier</label>
                    <input 
                        type="text" 
                        id="nama" 
                        name="nama" 
                        placeholder="Masukkan nama supplier (hanya huruf)"
                        value="{{ old('nama') }}"
                        class="{{ $errors->has('nama') ? 'error' : '' }}"
                        required
                    >
                    @if($errors->has('nama'))
                        <div class="error-message show">{{ $errors->first('nama') }}</div>
                    @else
                        <div class="error-message" id="error-nama">Nama supplier hanya boleh berisi huruf dan spasi</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input 
                        type="text" 
                        id="kota" 
                        name="kota" 
                        placeholder="Masukkan nama kota (hanya huruf)"
                        value="{{ old('kota') }}"
                        class="{{ $errors->has('kota') ? 'error' : '' }}"
                        required
                    >
                    @if($errors->has('kota'))
                        <div class="error-message show">{{ $errors->first('kota') }}</div>
                    @else
                        <div class="error-message" id="error-kota">Kota hanya boleh berisi huruf dan spasi</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input 
                        type="text" 
                        id="no_hp" 
                        name="no_hp" 
                        placeholder="Masukkan no. hp (hanya angka)"
                        value="{{ old('no_hp') }}"
                        class="{{ $errors->has('no_hp') ? 'error' : '' }}"
                        required
                    >
                    @if($errors->has('no_hp'))
                        <div class="error-message show">{{ $errors->first('no_hp') }}</div>
                    @else
                        <div class="error-message" id="error-no_hp">No. HP hanya boleh berisi angka</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input 
                        type="text" 
                        id="alamat" 
                        name="alamat" 
                        placeholder="Masukkan alamat lengkap"
                        value="{{ old('alamat') }}"
                        class="{{ $errors->has('alamat') ? 'error' : '' }}"
                        required
                    >
                    @if($errors->has('alamat'))
                        <div class="error-message show">{{ $errors->first('alamat') }}</div>
                    @else
                        <div class="error-message" id="error-alamat">Alamat wajib diisi</div>
                    @endif
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Supplier</button>
                    <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('supplierForm');
        const namaInput = document.getElementById('nama');
        const kotaInput = document.getElementById('kota');
        const noHpInput = document.getElementById('no_hp');
        const alamatInput = document.getElementById('alamat');
        const errorNama = document.getElementById('error-nama');
        const errorKota = document.getElementById('error-kota');
        const errorNoHp = document.getElementById('error-no_hp');
        const errorAlamat = document.getElementById('error-alamat');

        // Validasi Nama (hanya huruf dan spasi)
        namaInput.addEventListener('input', function () {
            const value = this.value;
            const hasNumbers = /\d/.test(value);

            if (hasNumbers || value.trim() === '') {
                this.classList.add('error');
                errorNama.classList.add('show');
            } else {
                this.classList.remove('error');
                errorNama.classList.remove('show');
            }
        });

        // Validasi Kota (hanya huruf dan spasi)
        kotaInput.addEventListener('input', function () {
            const value = this.value;
            const hasNumbers = /\d/.test(value);

            if (hasNumbers || value.trim() === '') {
                this.classList.add('error');
                errorKota.classList.add('show');
            } else {
                this.classList.remove('error');
                errorKota.classList.remove('show');
            }
        });

        // Validasi No. HP (hanya angka)
        noHpInput.addEventListener('input', function () {
            const value = this.value;
            const hasLetters = /[a-zA-Z]/.test(value);
            const isNotNumber = !/^\d+$/.test(value) && value !== '';

            if (hasLetters || isNotNumber || value.trim() === '') {
                this.classList.add('error');
                errorNoHp.classList.add('show');
            } else {
                this.classList.remove('error');
                errorNoHp.classList.remove('show');
            }
        });

        // Validasi Alamat (wajib diisi)
        alamatInput.addEventListener('input', function () {
            const value = this.value;

            if (value.trim() === '') {
                this.classList.add('error');
                errorAlamat.classList.add('show');
            } else {
                this.classList.remove('error');
                errorAlamat.classList.remove('show');
            }
        });

        // Validasi saat submit
        form.addEventListener('submit', function (e) {
            let isValid = true;

            // Validasi Nama
            const namaValue = namaInput.value.trim();
            if (namaValue === '' || /\d/.test(namaValue)) {
                e.preventDefault();
                namaInput.classList.add('error');
                errorNama.classList.add('show');
                isValid = false;
            }

            // Validasi Kota
            const kotaValue = kotaInput.value.trim();
            if (kotaValue === '' || /\d/.test(kotaValue)) {
                e.preventDefault();
                kotaInput.classList.add('error');
                errorKota.classList.add('show');
                isValid = false;
            }

            // Validasi No. HP
            const noHpValue = noHpInput.value.trim();
            if (noHpValue === '' || !/^\d+$/.test(noHpValue)) {
                e.preventDefault();
                noHpInput.classList.add('error');
                errorNoHp.classList.add('show');
                isValid = false;
            }

            // Validasi Alamat
            const alamatValue = alamatInput.value.trim();
            if (alamatValue === '') {
                e.preventDefault();
                alamatInput.classList.add('error');
                errorAlamat.classList.add('show');
                isValid = false;
            }

            if (!isValid) {
                alert('Mohon perbaiki kesalahan pada form!');
            }
        });
    </script>
@endsection