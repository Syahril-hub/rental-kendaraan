<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::where('status', 'tersedia')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.kendaraan.index', compact('kendaraans'));
    }
}
