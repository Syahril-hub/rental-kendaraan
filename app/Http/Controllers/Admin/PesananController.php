<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'kendaraan'])->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'kendaraan'])->findOrFail($id);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        $request->validate([
            'status' => 'required',
        ]);

        $pesanan->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diupdate');
    }
}
