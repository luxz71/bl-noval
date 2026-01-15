@extends('layouts.app')

@section('title', 'Daftar Supplier - BL-Noval')

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

        .alert {
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
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

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-header">
        <div>
            <h1>Daftar Supplier</h1>
            <p>Kelola semua supplier Anda di sini</p>
        </div>
        <a href="{{ route('supplier.create') }}" class="btn btn-primary">+ Tambah Supplier Baru</a>
    </div>

    <div class="search-bar" style="margin-bottom: 1.5rem;">
        <form action="{{ route('supplier.index') }}" method="GET" style="display: flex; gap: 0.75rem; max-width: 500px;">
            <input type="text" name="search" placeholder="Cari nama, kota, no. hp, atau alamat..." value="{{ request('search') }}" 
                   style="flex: 1; padding: 0.75rem; border: 1px solid #e0e0e0; border-radius: 6px; font-family: 'Inter', sans-serif; font-size: 0.9rem;">
            <button type="submit" class="btn btn-primary" style="padding: 0.75rem 1.5rem;">Cari</button>
            @if(request('search'))
                <a href="{{ route('supplier.index') }}" class="btn btn-secondary" style="padding: 0.75rem 1rem; display: flex; align-items: center; justify-content: center;">Reset</a>
            @endif
        </form>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Kota</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>{{ $item->kota }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('supplier.show', $item->id) }}" class="btn btn-sm btn-detail">Detail</a>
                                <a href="{{ route('supplier.edit', $item->id) }}" class="btn btn-sm btn-edit">Edit</a>
                                <form action="{{ route('supplier.destroy', $item->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete"
                                        onclick="return confirm('Yakin ingin menghapus supplier ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-state-icon">🏢</div>
                                @if(request('search'))
                                    <h3>Data tidak ditemukan</h3>
                                    <p>Penelusuran untuk "<strong>{{ request('search') }}</strong>" tidak menghasilkan apa-apa.</p>
                                @else
                                    <h3>Belum ada supplier</h3>
                                    <p>Mulai tambahkan supplier pertama Anda</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection