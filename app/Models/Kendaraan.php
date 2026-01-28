<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Booking;

class Kendaraan extends Model
{
    /** @use HasFactory<\Database\Factories\KendaraanFactory> */
    use HasFactory;

    //protected $table = 'kendaraan';

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

    // Relasi ke table bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'kendaraan_id');
    }
}
