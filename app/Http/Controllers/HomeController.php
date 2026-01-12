<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;

class HomeController extends Controller
{
    public function index()
    {
        $kendaraanPopuler = Kendaraan::where('status', 'tersedia')
            ->latest()
            ->take(4)
            ->get();

        return view('welcome', compact('kendaraanPopuler'));
    }
}
