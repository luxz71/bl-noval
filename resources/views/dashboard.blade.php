@extends('layouts.app')

@section('title', 'Dashboard - BL-Noval')

@section('content')
    <div class="page-header">
        <h1>Dashboard</h1>
        <p>Selamat datang di sistem manajemen BL-Noval</p>
    </div>

    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: box-shadow 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .stat-card h3 {
            font-size: 0.8rem;
            font-weight: 500;
            color: #888;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0.25rem;
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: #666;
        }

        .quick-actions {
            margin-top: 2rem;
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .quick-actions h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #333;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn {
            padding: 0.65rem 1.25rem;
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

        .recent-activity {
            margin-top: 1.5rem;
            background: #fff;
            padding: 1.5rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }

        .recent-activity h2 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            color: #333;
            font-weight: 600;
        }

        .activity-list {
            list-style: none;
        }

        .activity-item {
            padding: 1rem;
            background: #f8f8f8;
            border-radius: 6px;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .activity-item:last-child {
            margin-bottom: 0;
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-content strong {
            color: #333;
            font-size: 0.9rem;
        }

        .activity-content span {
            color: #666;
            font-size: 0.85rem;
            display: block;
            margin-top: 0.25rem;
        }
    </style>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Produk</h3>
            <div class="stat-value">{{ $totalProduk ?? 0 }}</div>
            <div class="stat-label">Produk terdaftar</div>
        </div>

        <div class="stat-card">
            <h3>Total Stok</h3>
            <div class="stat-value">{{ $totalStok ?? 0 }}</div>
            <div class="stat-label">Item tersedia</div>
        </div>

        <div class="stat-card">
            <h3>Kategori</h3>
            <div class="stat-value">{{ $totalKategori ?? 3 }}</div>
            <div class="stat-label">Kategori aktif</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="quick-actions">
        <h2>Aksi Cepat</h2>
        <div class="action-buttons">
            <a href="{{ route('produk.create') }}" class="btn btn-primary">Tambah Produk Baru</a>
            <a href="{{ route('produk.index') }}" class="btn btn-secondary">Lihat Semua Produk</a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="recent-activity">
        <h2>Aktivitas Terbaru</h2>
        <ul class="activity-list">
            <li class="activity-item">
                <div class="activity-icon">📦</div>
                <div class="activity-content">
                    <strong>Sistem dimulai</strong>
                    <span>Dashboard siap digunakan</span>
                </div>
            </li>
            <li class="activity-item">
                <div class="activity-icon">✨</div>
                <div class="activity-content">
                    <strong>Selamat datang!</strong>
                    <span>Mulai kelola produk Anda sekarang</span>
                </div>
            </li>
        </ul>
    </div>
@endsection