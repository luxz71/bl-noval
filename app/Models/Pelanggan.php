<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'alamat',
        'status',
    ];

    /**
     * Relasi: Satu pelanggan bisa memiliki banyak transaksi pembelian
     */
    public function pembelian(): HasMany
    {
        return $this->hasMany(Pembeli::class, 'pelanggan_id');
    }

    /**
     * Mendapatkan total transaksi pelanggan
     */
    public function getTotalTransaksiAttribute(): int
    {
        return $this->pembelian()->count();
    }

    /**
     * Mendapatkan total belanja pelanggan
     */
    public function getTotalBelanjaAttribute(): float
    {
        return $this->pembelian()->sum('total_harga');
    }
}
