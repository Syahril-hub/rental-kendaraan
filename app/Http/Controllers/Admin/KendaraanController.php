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
            'no_plat' => 'required|unique:kendaraans,no_plat',
            'harga_per_hari' => 'required|numeric',
        ]);

        Kendaraan::create($request->all());

        return redirect('/admin/kendaraan')
            ->with('success', 'Kendaraan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('admin.kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'brand' => 'required',
            'tipe' => 'required',
            'no_plat' => 'required|unique:kendaraans,no_plat,' . $id,
            'harga_per_hari' => 'required|numeric',
            ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update($request->all());

        return redirect('/admin/kendaraan')
            ->with('success', 'Kendaraan berhasil diupdate');
    }

    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->delete();

        return redirect('/admin/kendaraan')
            ->with('success', 'Kendaraan berhasil dihapus');
    }

}
