<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembeli extends Model
{
    protected $table = 'pembeli';

    protected $fillable = [
        'pelanggan_id',
        'produk_id',
        'jumlah_beli',
        'total_harga',
        'tanggal_beli',
        'status_pembayaran',
        'catatan',
    ];

    protected $casts = [
        'tanggal_beli' => 'date',
        'total_harga' => 'decimal:2',
    ];

    /**
     * Relasi: Pembeli dimiliki oleh satu pelanggan
     */
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    /**
     * Relasi: Pembeli terkait dengan satu produk
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
