<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    protected $fillable = ['nama', 'kota', 'no_hp', 'alamat'];

    // Relasi: Supplier memiliki banyak Produk
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
