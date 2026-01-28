<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar
        $query = Kendaraan::where('status', 'tersedia');

        // FILTER TIPE - FIX: Tambahkan kondisi strict
        if ($request->filled('tipe') && $request->tipe != '') {
            $query->where('tipe', '=', $request->tipe);
        }

        // Ambil data & sort
        $kendaraans = $query
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.kendaraan.index', compact('kendaraans'));
    }

    public function show($id)
    {
        $kendaraan = Kendaraan::where('status', 'tersedia')
            ->findOrFail($id);

        return view('user.kendaraan.show', compact('kendaraan'));
    }
}
