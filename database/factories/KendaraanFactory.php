<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kendaraan>
 */
class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->randomElement(['Genio', 'Vario 125', 'Scoopy', 'Beat', 'ADV160']),
            'brand' => 'Honda',
            'tipe' => 'Matic',
            'no_plat' => strtoupper($this->faker->bothify('AB #### ??')),
            'harga_per_hari' => 75000,
            'kapasitas_tangki' => '5L',
            'gambar' => null,
            'deskripsi' => $this->faker->sentence(15),
            'status' => 'tersedia',
        ];
    }
}
