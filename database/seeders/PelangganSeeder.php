<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pelanggans')->insert([
            [
                'nama_pelanggan' => 'Budi Santoso',
                'telp' => '0812-3456-7890',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Merdeka No. 1',
                'kota' => 'Palembang',
                'provinsi' => 'Sumatera Selatan',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_pelanggan' => 'Siti Aminah',
                'telp' => '0813-9876-5432',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Sudirman No. 12',
                'kota' => 'Palembang',
                'provinsi' => 'Sumatera Selatan',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
