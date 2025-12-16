<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('admin.kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('admin.kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'brand' => 'required',
            'tipe' => 'required',
            'no_plat' => 'required|unique:kendaraan,no_plat',
            'harga_per_hari' => 'required|numeric',
        ]);

        Kendaraan::create($request->all());

        return redirect('/admin/kendaraan')
            ->with('success', 'Kendaraan berhasil ditambahkan');
    }
}
