<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * List semua pesanan (admin)
     */
    public function index(Request $request)
    {
        $query = Pesanan::with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc');

        // ======================
        // FILTER STATUS
        // ======================
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pesanans = $query->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }


    /**
     * Detail pesanan
     */
    public function show($id)
    {
        $pesanan = Pesanan::with(['user', 'kendaraan'])
            ->findOrFail($id);

        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Update status pesanan
     */
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::with('kendaraan')->findOrFail($id);

        // ======================
        // VALIDASI
        // ======================
        $request->validate([
            'status' => 'required|in:pending,dibayar,selesai,expired',
        ]);

        // ======================
        // GUARD LOGIC
        // ======================
        if ($pesanan->status === 'selesai') {
            return redirect()
                ->route('admin.pesanan.index')
                ->with('error', 'Pesanan sudah selesai dan tidak bisa diubah');
        }

        // ======================
        // UPDATE STATUS PESANAN
        // ======================
        $pesanan->update([
            'status' => $request->status,
        ]);

        // ======================
        // UPDATE STATUS KENDARAAN
        // ======================
        if ($request->status === 'dibayar') {
            $pesanan->kendaraan->update([
                'status' => 'disewa',
            ]);
        }

        if ($request->status === 'selesai') {
            $pesanan->kendaraan->update([
                'status' => 'tersedia',
            ]);
        }

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diupdate');
    }
}
