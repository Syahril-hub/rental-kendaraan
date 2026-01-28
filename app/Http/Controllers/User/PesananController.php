<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Pesanan;
use Carbon\Carbon;
use App\Models\Booking;

class PesananController extends Controller
{
    public function preview(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        $mulai = Carbon::parse($request->mulai);
        $selesai = Carbon::parse($request->selesai);

        if ($selesai <= $mulai) {
            return back()->withErrors('Waktu selesai harus setelah waktu mulai');
        }

        $totalJam = $mulai->diffInHours($selesai);
        $totalHari = (int) ceil($totalJam / 24);
        $totalHarga = $totalHari * $kendaraan->harga_per_hari;

        return view('user.pesanan.preview', compact(
            'kendaraan',
            'mulai',
            'selesai',
            'totalHari',
            'totalHarga'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'mulai' => 'required|date',
            'selesai' => 'required|date|after:mulai',
        ]);

        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        $mulai = Carbon::parse($request->mulai);
        $selesai = Carbon::parse($request->selesai);

        $totalJam = $mulai->diffInHours($selesai);
        $totalHari = ceil($totalJam / 24);
        $totalHarga = $totalHari * $kendaraan->harga_per_hari;

        Pesanan::create([
            'user_id' => Auth::id(),
            'kendaraan_id' => $kendaraan->id,
            'tanggal_mulai' => $mulai,
            'tanggal_selesai' => $selesai,
            'total_hari' => $totalHari,
            'total_harga' => $totalHarga,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('kendaraan.index')
            ->with('success', 'Pesanan berhasil dibuat');
    }

    public function index()
    {
        $pesanans = Booking::with('kendaraan')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Booking::with('kendaraan', 'user')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.pesanan.show', compact('pesanan'));
    }


}
