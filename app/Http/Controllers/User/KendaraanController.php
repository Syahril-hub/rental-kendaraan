<?php

namespace App\Http\Controllers\User;

use illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kendaraan::query()
            ->where('status', 'tersedia');

        // FILTER TIPE
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

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
