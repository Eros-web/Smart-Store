<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuplierSeeder extends Seeder
{
    public function run(): void
            {
                DB::table('supliers')->insert([
            [
                'nama_suplier' => 'PT Sumber Rezeki Palembang',
                'alamat' => 'Jl. Demang Lebar Daun No. 12, Palembang',
                'telp' => '0711-123456',
                'email' => 'admin1@example.com',
                'tgl_terdaftar' => now(),
                'status' => 'aktif',
            ],
            [
                'nama_suplier' => 'UD Makmur Bersama',
                'alamat' => 'Jl. Angkatan 45 No. 88, Palembang',
                'telp' => '0813-7000-8899',
                'email' => 'admin2@example.com',
                'tgl_terdaftar' => now(),
                'status' => 'aktif',
            ],
            [
                'nama_suplier' => 'Toko Sentosa Raya',
                'alamat' => 'Jl. Mayor Ruslan No. 55, Palembang',
                'telp' => '0812-3456-7890',
                'email' => 'admin3@example.com',
                'tgl_terdaftar' => now(),
                'status' => 'aktif',
            ],
        ]);

    }
}
