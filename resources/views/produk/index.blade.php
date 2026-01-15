@extends('layouts.app')

@section('title', 'Daftar Produk - BL-Noval')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
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
        font-size: 0.85rem;
    }

    .btn-primary {
        background: #333;
        color: white;
    }

    .btn-primary:hover {
        background: #000;
    }

    .btn-sm {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }

    .btn-edit {
        background: #fff;
        color: #333;
        border: 1px solid #e0e0e0;
    }

    .btn-edit:hover {
        background: #f8f8f8;
    }

    .btn-detail {
        background: #fff;
        color: #333;
        border: 1px solid #e0e0e0;
    }

    .btn-detail:hover {
        background: #f8f8f8;
    }

    .btn-delete {
        background: #fff;
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .table-container {
        overflow-x: auto;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }

    thead {
        background: #f8f8f8;
        border-bottom: 2px solid #e0e0e0;
    }

    th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #333;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    td {
        padding: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    tbody tr {
        transition: background-color 0.2s ease;
    }

    tbody tr:hover {
        background-color: #f8f9fa;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .action-buttons form {
        margin: 0;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #999;
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }
</style>

<div class="page-header">
    <div>
        <h1>Daftar Produk</h1>
        <p>Kelola semua produk Anda di sini</p>
    </div>
    <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Produk Baru</a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td><strong>{{ $item->nama_barang }}</strong></td>
                <td>{{ $item->jumlah }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('produk.show', $item->id) }}" class="btn btn-sm btn-detail">Detail</a>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-edit">Edit</a>
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">
                    <div class="empty-state">
                        <div class="empty-state-icon">📦</div>
                        <h3>Belum ada produk</h3>
                        <p>Mulai tambahkan produk pertama Anda</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection