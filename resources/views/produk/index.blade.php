<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produk</title>
</head>
<body>
    <table border="1" width="700">
        <tr>
            <td>NAMA BARANG</td>
            <td>JUMLAH</td>
            <td>
                <a href="{{ route('produk.create') }}">Tambah Barang Baru</a>
            </td>

        </tr>
        @forelse ($data as $item)
        <tr>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>
                <a href="{{ route('produk.edit', $item->id) }}">Edit</a> |
                <a href="{{ route('produk.show', $item->id) }}">Detail</a> |
                <form action="{{ route('produk.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>

            </td>
        </tr>
        @empty
        <tr>
            <td colspan="2">Data tidak tersedia</td>
        </tr>
        @endforelse
    </table>


</body>
</html>