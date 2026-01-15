@extends('layouts.app')

@section('title', 'Tambah Produk - BL-Noval')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
         <h1>Detail Data dengan id {{$produk->id}}</h1>
  <form action="{{ route('produk.update', $produk->id) }}" method="POST">
      @csrf
      @method('PUT') {{-- WAJIB untuk Update --}}
         <table border="0" width="600">
             <tr>
                 <td>NAMA BARANG</td>
                 <td><input type="text" name="nama_barang" value="{{ $produk->nama_barang }}"></td>

             </tr>

             <tr>
                 <td>JUMLAH BARANG</td>
                 <td><input type="number" name="jumlah" value="{{ $produk->jumlah }}"></td>
             </tr>
             
             <tr>
                 <td><a href="{{ route('produk.index') }}">Kembali</a></td>
                 <td> <button type="submit">Update</button></td>
             </tr>
         </table>
    </form>
{{-- 
      <form action="{{ route('produk.update', $produk->id) }}" method="POST">
          @csrf
          @method('PUT') 

          <label>Nama Barang:</label><br>
          <input type="text" name="nama_barang" value="{{ $produk->nama_barang }}"><br><br>

          <label>Jumlah:</label><br>
          <input type="number" name="jumlah" value="{{ $produk->jumlah }}"><br><br>

          <button type="submit">Update Data</button>
          <a href="{{ route('produk.index') }}">Batal</a>
      </form>
 --}}

</body>
</html>
@endsection