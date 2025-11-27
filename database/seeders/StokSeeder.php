<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stoks')->insert([
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Kopi Arabika',
                'harga' => '50000',
                'stok' => '20',
                'suplier_id' => '1',
                'cabang' => 'Palembang'
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Teh Hijau',
                'harga' => '30000',
                'stok' => '15',
                'suplier_id' => '2',
                'cabang' => 'Palembang'
            ]
        ]);
    }
}
