<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    /** @use HasFactory<\Database\Factories\KendaraanFactory> */
    use HasFactory;

    protected $table = 'kendaraans';

    protected $fillable = [
        'nama',
        'brand',
        'tipe',
        'no_plat',
        'harga_per_hari',
        'kapasitas_tangki',
        'gambar',
        'deskripsi',
        'status',
    ];
}
