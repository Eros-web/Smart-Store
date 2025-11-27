<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangMasukSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barang_masuks')->insert([
            [
                'tanggal_faktur' => '2025-11-28',
                'nama_barang_id' => '1',
                'suplier_id' => '1',
                'harga_beli' => '45000',
                'jumlah_barang_masuk' => '10',
                'admin_id' => '1'
            ],
            [
                'tanggal_faktur' => '2025-11-28',
                'nama_barang_id' => '2',
                'suplier_id' => '2',
                'harga_beli' => '25000',
                'jumlah_barang_masuk' => '20',
                'admin_id' => '1'
            ]
        ]);
    }
}
