<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kendaraan;
use App\Models\Pesanan;
use Carbon\Carbon;

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

        $totalJam = $mulai->diffInHours($selesai);
        $totalHari = ceil($totalJam / 24);
        $totalHarga = $totalHari * $kendaraan->harga_per_hari;

        return view('user.pesanan.preview', compact(
            'kendaraan',
            'mulai',
            'selesai',
            'totalHari',
            'totalHarga'
        ));

        if ($selesai <= $mulai) {
            return back()->withErrors('Waktu selesai harus setelah waktu mulai');
        }

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



}
