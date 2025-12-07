<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Kendaraan::create([
            'nama' => 'Honda Genio',
            'brand' => 'Honda',
            'tipe' => 'Matic',
            'no_plat' => 'AB 1234 CD',
            'harga_per_hari' => 75000,
            'kapasitas_tangki' => '4.2L',
            'gambar' => null,
            'deskripsi' => 'Motor matic ringan cocok untuk harian.',
            'status' => 'tersedia',
        ]);

        Kendaraan::create([
            'nama' => 'Honda Vario 160',
            'brand' => 'Honda',
            'tipe' => 'Matic',
            'no_plat' => 'AB 5678 EF',
            'harga_per_hari' => 90000,
            'kapasitas_tangki' => '5.5L',
            'gambar' => null,
            'deskripsi' => 'Motor matic premium, irit dan bertenaga.',
            'status' => 'tersedia',
        ]);
    }
}
