<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $suppliers = [
            ['nama' => 'PT Maju Jaya', 'kota' => 'Jakarta', 'no_hp' => '08123456789', 'alamat' => 'Jl. Maju Jaya No. 1'],
            ['nama' => 'CV Sejahtera', 'kota' => 'Bandung', 'no_hp' => '08123456789', 'alamat' => 'Jl. Sejahtera No. 1'],
            ['nama' => 'UD Berkah', 'kota' => 'Surabaya', 'no_hp' => '08123456789', 'alamat' => 'Jl. Berkah No. 1'],
            ['nama' => 'PT Global Indo', 'kota' => 'Semarang', 'no_hp' => '08123456789', 'alamat' => 'Jl. Global Indo No. 1'],
            ['nama' => 'CV Mandiri', 'kota' => 'Yogyakarta', 'no_hp' => '08123456789', 'alamat' => 'Jl. Mandiri No. 1'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
