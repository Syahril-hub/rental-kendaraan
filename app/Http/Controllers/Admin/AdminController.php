<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Total Kendaraan
        $totalKendaraan = Kendaraan::count();
        
        // Kendaraan Tersedia
        $kendaraanTersedia = Kendaraan::where('status', 'tersedia')->count();
        
        // Kendaraan Disewa
        $kendaraanDisewa = Kendaraan::where('status', 'disewa')->count();
        
        // Total Booking (jika ada table booking)
        $totalBooking = Booking::count();
        
        // Booking Hari Ini
        $bookingHariIni = Booking::whereDate('created_at', today())->count();
        
        // Revenue Hari Ini (jika ada kolom total_harga)
        $revenueHariIni = Booking::whereDate('created_at', today())
            ->sum('total_harga');
        
        // Kendaraan Terpopuler (paling banyak dibooking)
        $kendaraanPopuler = Kendaraan::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalKendaraan',
            'kendaraanTersedia',
            'kendaraanDisewa',
            'totalBooking',
            'bookingHariIni',
            'revenueHariIni',
            'kendaraanPopuler'
        ));
    }
}
