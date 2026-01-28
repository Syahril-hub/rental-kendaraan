<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;  // ✅ GANTI INI!
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * List semua pesanan (admin)
     */
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'kendaraan'])  // ✅ GANTI INI!
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
        $pesanan = Booking::with(['user', 'kendaraan'])  // ✅ GANTI INI!
            ->findOrFail($id);

        return view('admin.pesanan.show', compact('pesanan'));
    }

    /**
     * Update status pesanan
     */
    public function update(Request $request, $id)
    {
        $pesanan = Booking::with('kendaraan')->findOrFail($id);  // ✅ GANTI INI!

        // ======================
        // VALIDASI
        // ======================
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',  // ✅ SESUAIKAN STATUS!
        ]);

        // ======================
        // GUARD LOGIC
        // ======================
        if ($pesanan->status === 'completed') {
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
        if ($request->status === 'confirmed') {
            $pesanan->kendaraan->update([
                'status' => 'disewa',
            ]);
        }

        if ($request->status === 'completed') {
            $pesanan->kendaraan->update([
                'status' => 'tersedia',
            ]);
        }

        if ($request->status === 'cancelled') {
            $pesanan->kendaraan->update([
                'status' => 'tersedia',
            ]);
        }

        return redirect()
            ->route('admin.pesanan.index')
            ->with('success', 'Status pesanan berhasil diupdate');
    }
}
