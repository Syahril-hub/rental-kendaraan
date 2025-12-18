<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Pesanan;
use Carbon\Carbon;

class PesananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|exists:kendaraans,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

        $mulai = Carbon::parse($request->tanggal_mulai);
        $selesai = Carbon::parse($request->tanggal_selesai);

        $total_hari = $mulai->diffInDays($selesai) + 1;
        $total_harga = $total_hari * $kendaraan->harga_per_hari;

        return view('user.pesanan.preview', compact(
            'kendaraan',
            'mulai',
            'selesai',
            'total_hari',
            'total_harga'
        ));
    }
}
