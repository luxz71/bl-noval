@extends('layouts.app')

@section('title', 'Detail Supplier - BL-Noval')

@section('content')
    <style>
        .detail-container {
            max-width: 800px;
        }

        .detail-card {
            background: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .detail-header {
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .detail-header h2 {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .detail-header .badge {
            display: inline-block;
            padding: 0.35rem 0.75rem;
            background: #333;
            color: white;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .detail-row {
            display: flex;
            padding: 1rem 0;
            border-bottom: 1px solid #f5f5f5;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            color: #666;
            width: 200px;
            font-size: 0.9rem;
        }

        .detail-value {
            flex: 1;
            color: #333;
            font-size: 0.9rem;
        }

        .action-buttons {
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
        }

        .btn-primary {
            background: #333;
            color: white;
        }

        .btn-primary:hover {
            background: #000;
        }

        .btn-secondary {
            background: #fff;
            color: #333;
            border: 1px solid #e0e0e0;
        }

        .btn-secondary:hover {
            background: #f8f8f8;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
        }
    </style>

    <div class="detail-container">
        <div class="page-header">
            <h1>Detail Supplier</h1>
            <p>Informasi lengkap supplier</p>
        </div>

        <div class="detail-card">
            <div class="detail-header">
                <h2>{{ $supplier->nama }}</h2>
                <span class="badge">ID: #{{ $supplier->id }}</span>
            </div>

            <div class="detail-row">
                <div class="detail-label">Nama Supplier</div>
                <div class="detail-value"><strong>{{ $supplier->nama }}</strong></div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Kota</div>
                <div class="detail-value">📍 {{ $supplier->kota }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">No. HP</div>
                <div class="detail-value">📞 {{ $supplier->no_hp }}</div>
            </div>

            <div class="detail-row">
                <div class="detail-label">Alamat</div>
                <div class="detail-value">📧 {{ $supplier->alamat }}</div>
            </div>

            <div class="action-buttons">
                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary">Edit Supplier</a>
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary">Kembali</a>
                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Yakin ingin menghapus supplier ini?')">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection