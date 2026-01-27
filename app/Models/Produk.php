<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama_barang', 'jumlah', 'harga', 'supplier_id'];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    // Relasi: Produk dimiliki oleh satu Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relasi: Produk memiliki banyak transaksi pembelian
    public function pembelian()
    {
        return $this->hasMany(Pembeli::class, 'produk_id');
    }
}

