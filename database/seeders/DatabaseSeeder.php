<?php

namespace Database\Seeders;

use App\Models\User;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // public function run(): void
{
    // admin
    \App\Models\User::factory()->create([
        'name' => 'admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('123123'),
        'level' => 'superadmin'
    ]);

    // data dummy toko
    $this->call([
        SuplierSeeder::class,
        PelangganSeeder::class,
        StokSeeder::class,
        BarangMasukSeeder::class,
        BarangKeluarSeeder::class,
    ]);
}

    }
}
