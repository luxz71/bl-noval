<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama_barang', 'jumlah', 'supplier_id'];

    // Relasi: Produk dimiliki oleh satu Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}

