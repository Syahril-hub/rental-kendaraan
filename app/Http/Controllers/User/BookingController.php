<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'tanggal_mulai' => 'required|date|after_or_equal:today',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1',
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        
        // Calculate tanggal_selesai
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = $tanggalMulai->copy()->addDays((int)$request->durasi);
        
        // Calculate total_harga
        $totalHarga = $kendaraan->harga_per_hari * $request->durasi;

        // Create booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'kendaraan_id' => $kendaraan->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'jam_mulai' => $request->jam_mulai,
            'durasi' => $request->durasi,
            'tanggal_selesai' => $tanggalSelesai,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.success', $booking->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function success($id)
    {
        $booking = Booking::with(['kendaraan', 'user'])->findOrFail($id);
        
        // Make sure user can only see their own booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.booking.success', compact('booking'));
    }
}
