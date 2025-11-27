<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangKeluarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('barang_keluars')->insert([
            [
                'kode_transaksi' => 'TRX001',
                'tgl_faktur' => '2025-11-28',
                'tgl_jatuh_tempo' => '2025-12-28',
                'pelanggan_id' => '1',
                'jenis_pembayaran' => 'Cash',
                'barang_id' => '1',
                'jumlah_beli' => 2,
                'harga_jual' => 50000,
                'diskon' => 0,
                'sub_total' => 100000,
                'user_id' => '1',
                'tgl_buat' => '2025-11-28'
            ],
            [
                'kode_transaksi' => 'TRX002',
                'tgl_faktur' => '2025-11-28',
                'tgl_jatuh_tempo' => '2025-12-28',
                'pelanggan_id' => '2',
                'jenis_pembayaran' => 'Transfer',
                'barang_id' => '2',
                'jumlah_beli' => 1,
                'harga_jual' => 30000,
                'diskon' => 0,
                'sub_total' => 30000,
                'user_id' => '1',
                'tgl_buat' => '2025-11-28'
            ]
        ]);
    }
}
