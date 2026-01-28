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
        
        // Total Booking
        $totalBooking = Booking::count();
        
        // Booking Hari Ini
        $bookingHariIni = Booking::whereDate('created_at', today())->count();
        
        // Revenue Hari Ini
        $revenueHariIni = Booking::whereDate('created_at', today())
            ->sum('total_harga');
        
        // Kendaraan Terpopuler
        $kendaraanPopuler = Kendaraan::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(5)
            ->get();

        // ✅ PESANAN PENDING (BARU!)
        $pesananPending = Booking::with(['user', 'kendaraan'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact(
            'totalKendaraan',
            'kendaraanTersedia',
            'kendaraanDisewa',
            'totalBooking',
            'bookingHariIni',
            'revenueHariIni',
            'kendaraanPopuler',
            'pesananPending'  // ✅ TAMBAH INI
        ));
    }
}
