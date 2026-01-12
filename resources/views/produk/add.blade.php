<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Barang Baru</h1>
    <form action="{{ route('produk.store') }}" method="POST">
    @csrf
        <table border="0" width="600">
            <tr>
                <td>NAMA BARANG</td>
                <td><input type="text" name="nama_barang" required></td>
            </tr>

            <tr>
                <td>JUMLAH BARANG</td>
                <td><input type="text" name="jumlah" required></td>
            </tr>
            <tr>
                <td><a href="{{ route('produk.index') }}">Kembali</a></td>
                <td> <button type="submit">Simpan ke Database</button></td>

            </tr>
        </table>
     </form>

</body>
</html>
