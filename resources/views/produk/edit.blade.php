@extends('layouts.app')

@section('title', 'Edit Produk - BL-Noval')

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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: border-color 0.2s ease;
            font-family: 'Inter', sans-serif;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #333;
        }

        .form-group input.error,
        .form-group select.error {
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
            <h1>Edit Produk</h1>
            <p>Update informasi produk</p>
        </div>

        <div class="form-card">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" id="productForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input 
                    type="text" 
                    id="nama_barang" 
                    name="nama_barang" 
                    placeholder="Masukkan nama barang (hanya huruf)"
                    value="{{ old('nama_barang', $produk->nama_barang) }}"
                    class="{{ $errors->has('nama_barang') ? 'error' : '' }}"
                    required
                >
                @if($errors->has('nama_barang'))
                    <div class="error-message show">{{ $errors->first('nama_barang') }}</div>
                @else
                    <div class="error-message" id="error-nama">Nama barang hanya boleh berisi huruf dan spasi</div>
                @endif
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input 
                    type="text" 
                    id="jumlah" 
                    name="jumlah" 
                    placeholder="Masukkan jumlah (hanya angka)"
                    value="{{ old('jumlah', $produk->jumlah) }}"
                    class="{{ $errors->has('jumlah') ? 'error' : '' }}"
                    required
                >
                @if($errors->has('jumlah'))
                    <div class="error-message show">{{ $errors->first('jumlah') }}</div>
                @else
                    <div class="error-message" id="error-jumlah">Jumlah hanya boleh berisi angka</div>
                @endif
            </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Update Produk</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        const form = document.getElementById('productForm');
        const namaBarangInput = document.getElementById('nama_barang');
        const jumlahInput = document.getElementById('jumlah');
        const errorNama = document.getElementById('error-nama');
        const errorJumlah = document.getElementById('error-jumlah');

        // Validasi Nama Barang (hanya huruf dan spasi)
        namaBarangInput.addEventListener('input', function () {
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

        // Validasi Jumlah (hanya angka)
        jumlahInput.addEventListener('input', function () {
            const value = this.value;
            const hasLetters = /[a-zA-Z]/.test(value);
            const isNotNumber = !/^\d+$/.test(value) && value !== '';

            if (hasLetters || isNotNumber || value.trim() === '') {
                this.classList.add('error');
                errorJumlah.classList.add('show');
            } else {
                this.classList.remove('error');
                errorJumlah.classList.remove('show');
            }
        });

        // Validasi saat submit
        form.addEventListener('submit', function (e) {
            let isValid = true;

            // Validasi Nama Barang
            const namaValue = namaBarangInput.value.trim();
            if (namaValue === '' || /\d/.test(namaValue)) {
                e.preventDefault();
                namaBarangInput.classList.add('error');
                errorNama.classList.add('show');
                isValid = false;
            }

            // Validasi Jumlah
            const jumlahValue = jumlahInput.value.trim();
            if (jumlahValue === '' || !/^\d+$/.test(jumlahValue)) {
                e.preventDefault();
                jumlahInput.classList.add('error');
                errorJumlah.classList.add('show');
                isValid = false;
            }

            if (!isValid) {
                alert('Mohon perbaiki kesalahan pada form!');
            }
        });
    </script>
@endsection