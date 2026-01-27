@extends('layouts.app')

@section('title', 'Tambah Transaksi - BL-Noval')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Transaksi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('pembeli.index') }}">Transaksi</a></li>
            <li class="breadcrumb-item active">Tambah Transaksi</li>
        </ol>

        <!-- Alert Error -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 shadow">
                    <div class="card-header bg-gradient bg-info text-white">
                        <i class="fas fa-shopping-cart me-1"></i>
                        Form Tambah Transaksi
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pembeli.store') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pelanggan_id" class="form-label">Pelanggan <span class="text-danger">*</span></label>
                                        <select class="form-select @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                                            <option value="">-- Pilih Pelanggan --</option>
                                            @foreach($pelanggan as $p)
                                                <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                                                    {{ $p->nama }} ({{ $p->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pelanggan_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="produk_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                        <select class="form-select @error('produk_id') is-invalid @enderror" id="produk_id" name="produk_id" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($produk as $prod)
                                                <option value="{{ $prod->id }}" data-stok="{{ $prod->jumlah }}" data-harga="{{ $prod->harga }}" {{ old('produk_id') == $prod->id ? 'selected' : '' }}>
                                                    {{ $prod->nama_barang }} (Stok: {{ $prod->jumlah }}) - Rp {{ number_format($prod->harga, 0, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('produk_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah_beli" class="form-label">Jumlah Beli <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('jumlah_beli') is-invalid @enderror" 
                                            id="jumlah_beli" name="jumlah_beli" value="{{ old('jumlah_beli', 1) }}" 
                                            min="1" required>
                                        @error('jumlah_beli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="total_harga" class="form-label">Total Harga (Rp) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" class="form-control @error('total_harga') is-invalid @enderror" 
                                                id="total_harga" name="total_harga" value="{{ old('total_harga') }}" 
                                                min="0" step="1000" placeholder="0" required readonly>
                                        </div>
                                        <div class="form-text text-success"><i class="fas fa-info-circle me-1"></i>Dihitung otomatis: Harga x Jumlah</div>
                                        @error('total_harga')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tanggal_beli" class="form-label">Tanggal Beli <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_beli') is-invalid @enderror" 
                                            id="tanggal_beli" name="tanggal_beli" value="{{ old('tanggal_beli', date('Y-m-d')) }}" required>
                                        @error('tanggal_beli')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status_pembayaran" class="form-label">Status Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran" name="status_pembayaran" required>
                                            <option value="belum_lunas" {{ old('status_pembayaran') == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                            <option value="cicilan" {{ old('status_pembayaran') == 'cicilan' ? 'selected' : '' }}>Cicilan</option>
                                            <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                        </select>
                                        @error('status_pembayaran')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                    id="catatan" name="catatan" rows="3" 
                                    placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                @error('catatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-info text-white">
                                    <i class="fas fa-save me-1"></i> Simpan Transaksi
                                </button>
                                <a href="{{ route('pembeli.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-4 shadow border-warning">
                    <div class="card-header bg-warning text-dark">
                        <i class="fas fa-lightbulb me-1"></i> Panduan
                    </div>
                    <div class="card-body">
                        <ul class="mb-0 ps-3">
                            <li class="mb-2"><strong>Pelanggan:</strong> Hanya pelanggan aktif yang dapat bertransaksi</li>
                            <li class="mb-2"><strong>Produk:</strong> Hanya produk dengan stok > 0 yang ditampilkan</li>
                            <li class="mb-2"><strong>Jumlah:</strong> Tidak boleh melebihi stok yang tersedia</li>
                            <li class="mb-2"><strong>Total Harga:</strong> <span class="text-success">Dihitung otomatis</span> dari harga produk x jumlah</li>
                            <li><strong>Status:</strong> Pilih status pembayaran transaksi</li>
                        </ul>
                    </div>
                </div>

                <!-- Info Produk -->
                <div class="card mb-4 shadow border-info" id="produk-info" style="display: none;">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-box me-1"></i> Info Produk
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <h4 id="stok-value" class="text-info mb-0">0</h4>
                                <small class="text-muted">Stok Tersedia</small>
                            </div>
                            <div class="col-6">
                                <h4 id="harga-value" class="text-success mb-0">Rp 0</h4>
                                <small class="text-muted">Harga Satuan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    var currentHarga = 0;

    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function calculateTotal() {
        var jumlah = parseInt(document.getElementById('jumlah_beli').value) || 0;
        var total = currentHarga * jumlah;
        document.getElementById('total_harga').value = total;
    }

    document.getElementById('produk_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var stok = selectedOption.getAttribute('data-stok');
        var harga = selectedOption.getAttribute('data-harga');
        var produkInfo = document.getElementById('produk-info');
        var stokValue = document.getElementById('stok-value');
        var hargaValue = document.getElementById('harga-value');
        
        if (stok && harga) {
            currentHarga = parseFloat(harga);
            stokValue.textContent = stok;
            hargaValue.textContent = formatRupiah(parseInt(harga));
            produkInfo.style.display = 'block';
            
            // Set max jumlah berdasarkan stok
            document.getElementById('jumlah_beli').max = stok;
            
            // Calculate total
            calculateTotal();
        } else {
            currentHarga = 0;
            produkInfo.style.display = 'none';
            document.getElementById('total_harga').value = '';
        }
    });

    document.getElementById('jumlah_beli').addEventListener('input', function() {
        calculateTotal();
    });

    // Initial calculation if product is already selected (for old() values)
    document.addEventListener('DOMContentLoaded', function() {
        var produkSelect = document.getElementById('produk_id');
        if (produkSelect.value) {
            produkSelect.dispatchEvent(new Event('change'));
        }
    });
</script>
@endpush
