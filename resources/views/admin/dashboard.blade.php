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
                    <h2 class="text-success">Rp{{ number_format($revenueHariIni ?? 0) }}</h2>
                    <small class="text-muted">{{ date('d F Y') }}</small>
                </div>
            </div>
        </div>
    </div>

    {{-- KENDARAAN TERPOPULER --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">🏆 Kendaraan Terpopuler</h5>
            <div class="table-responsive">
                <table class="table table-hover">
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
