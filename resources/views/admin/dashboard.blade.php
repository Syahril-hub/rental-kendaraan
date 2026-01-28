@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <h2 class="mb-4">📊 Dashboard Admin</h2>

    {{-- STATISTIK CARDS --}}
    <div class="row g-3 mb-4">
        {{-- Total Kendaraan --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Kendaraan</h6>
                            <h2 class="mb-0">{{ $totalKendaraan ?? 0 }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="bi bi-bicycle text-primary fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kendaraan Tersedia --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Tersedia</h6>
                            <h2 class="mb-0 text-success">{{ $kendaraanTersedia ?? 0 }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="bi bi-check-circle text-success fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kendaraan Disewa --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Disewa</h6>
                            <h2 class="mb-0 text-warning">{{ $kendaraanDisewa ?? 0 }}</h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="bi bi-clock text-warning fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Booking --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Booking</h6>
                            <h2 class="mb-0 text-info">{{ $totalBooking ?? 0 }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="bi bi-calendar-check text-info fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BOOKING HARI INI & REVENUE --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Booking Hari Ini</h5>
                    <h2 class="text-primary">{{ $bookingHariIni ?? 0 }} Booking</h2>
                    <small class="text-muted">{{ date('d F Y') }}</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">Revenue Hari Ini</h5>
                    <h2 class="text-success">Rp{{ number_format($revenueHariIni ?? 0, 0, ',', '.') }}</h2>
                    <small class="text-muted">{{ date('d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ PESANAN PENDING (BARU!) --}}
    <div class="card border-0 shadow-sm mb-4" id="pesanan-section">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title mb-0">⏰ Pesanan Menunggu Konfirmasi</h5>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            
            @if($pesananPending->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Kendaraan</th>
                                <th>Tanggal Mulai</th>
                                <th>Durasi</th>
                                <th>Total Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesananPending as $pesanan)
                            <tr>
                                <td>
                                    <div>
                                        <strong>{{ $pesanan->user->name }}</strong><br>
                                        <small class="text-muted">{{ $pesanan->user->email }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $pesanan->kendaraan->nama }}</strong><br>
                                        <small class="text-muted">{{ $pesanan->kendaraan->no_plat }}</small>
                                    </div>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d M Y, H:i') }}</td>
                                <td>{{ $pesanan->durasi }} hari</td>
                                <td><strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong></td>
                                <td>
                                    <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" 
                                       class="btn btn-sm btn-primary me-1">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    
                                    <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Approve pesanan ini?')">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="bi bi-check-circle text-success fs-1"></i>
                    <p class="text-muted mt-2 mb-0">Semua pesanan sudah dikonfirmasi!</p>
                </div>
            @endif
        </div>
    </div>

    {{-- KENDARAAN TERPOPULER --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">🏆 Kendaraan Terpopuler</h5>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Nama Kendaraan</th>
                            <th>Tipe</th>
                            <th>Total Booking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraanPopuler ?? [] as $item)
                        <tr>
                            <td>{{ $item->nama }}</td>
                            <td><span class="badge bg-secondary">{{ $item->tipe }}</span></td>
                            <td>{{ $item->bookings_count }} kali</td>
                            <td>
                                @if($item->status == 'tersedia')
                                    <span class="badge bg-success">Tersedia</span>
                                @else
                                    <span class="badge bg-warning">Disewa</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada data booking</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
