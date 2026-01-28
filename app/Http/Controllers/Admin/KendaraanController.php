<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kendaraan::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('brand', 'like', "%{$search}%")
                ->orWhere('no_plat', 'like', "%{$search}%");
            });
        }

        // FILTER TIPE
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        // PAGINATION
        $kendaraans = $query->latest()->paginate(10);
        
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:5024',
        ]);

        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/kendaraan'), $filename);

            $data['gambar'] = $filename;
        }

        Kendaraan::create($data);

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

        if ($request->hasFile('gambar')) {
            if ($kendaraan->gambar && file_exists(public_path('uploads/kendaraan/' . $kendaraan->gambar))) {
                unlink(public_path('uploads/kendaraan/' . $kendaraan->gambar));
            }

            $file = $request->file('gambar');
            $namaFile = time() . '.' . $file->extension();
            $file->move(public_path('uploads/kendaraan'), $namaFile);
            $request['gambar'] = $namaFile;
}

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
