@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h2 class="mb-0">📋 Detail Pesanan #{{ $pesanan->id }}</h2>
        </div>
        <div>
            @if($pesanan->status == 'pending')
                <span class="badge bg-warning text-dark fs-6">
                    <i class="bi bi-clock"></i> Pending
                </span>
            @elseif($pesanan->status == 'confirmed')
                <span class="badge bg-success fs-6">
                    <i class="bi bi-check-circle"></i> Confirmed
                </span>
            @elseif($pesanan->status == 'completed')
                <span class="badge bg-primary fs-6">
                    <i class="bi bi-flag-fill"></i> Completed
                </span>
            @elseif($pesanan->status == 'cancelled')
                <span class="badge bg-danger fs-6">
                    <i class="bi bi-x-circle"></i> Cancelled
                </span>
            @endif
        </div>
    </div>

    <div class="row g-4">
        {{-- INFORMASI PEMESAN --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-person-fill text-primary"></i> Informasi Pemesan
                    </h5>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="35%" class="text-muted">Nama</td>
                            <td><strong>{{ $pesanan->user->name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>{{ $pesanan->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. Telepon</td>
                            <td>{{ $pesanan->user->phone ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- INFORMASI KENDARAAN --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-bicycle text-success"></i> Informasi Kendaraan
                    </h5>
                    <table class="table table-borderless mb-0">
                        <tr>
                            <td width="35%" class="text-muted">Nama Kendaraan</td>
                            <td><strong>{{ $pesanan->kendaraan->nama }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">No. Plat</td>
                            <td>
                                <span class="badge bg-dark">{{ $pesanan->kendaraan->no_plat }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tipe</td>
                            <td>{{ $pesanan->kendaraan->tipe }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Harga Sewa/Hari</td>
                            <td>Rp {{ number_format($pesanan->kendaraan->harga_sewa, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- DETAIL PEMESANAN --}}
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-calendar-check text-info"></i> Detail Pemesanan
                    </h5>
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-muted mb-1">Tanggal Mulai</p>
                            <h5>{{ \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d M Y, H:i') }}</h5>
                        </div>
                        <div class="col-md-3">
                            <p class="text-muted mb-1">Tanggal Selesai</p>
                            <h5>{{ \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d M Y, H:i') }}</h5>
                        </div>
                        <div class="col-md-2">
                            <p class="text-muted mb-1">Durasi</p>
                            <h5>
                                <span class="badge bg-info fs-6">{{ $pesanan->durasi }} hari</span>
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted mb-1">Total Harga</p>
                            <h3 class="text-success mb-0">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</h3>
                            <small class="text-muted">
                                ({{ $pesanan->durasi }} hari × Rp {{ number_format($pesanan->kendaraan->harga_sewa, 0, ',', '.') }})
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- UPDATE STATUS --}}
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="bi bi-gear text-warning"></i> Update Status Pesanan
                    </h5>
                    
                    @if($pesanan->status == 'completed')
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle"></i>
                            Pesanan ini sudah <strong>selesai</strong> dan tidak bisa diubah lagi.
                        </div>
                    @else
                        <form action="{{ route('admin.pesanan.update', $pesanan->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin ingin mengubah status pesanan ini?')">
                            @csrf
                            @method('PUT')

                            <div class="row align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Status Pesanan</label>
                                    <select name="status" class="form-select form-select-lg" required>
                                        <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>
                                            🟡 Pending - Menunggu Konfirmasi
                                        </option>
                                        <option value="confirmed" {{ $pesanan->status == 'confirmed' ? 'selected' : '' }}>
                                            🟢 Confirmed - Dikonfirmasi
                                        </option>
                                        <option value="completed" {{ $pesanan->status == 'completed' ? 'selected' : '' }}>
                                            🔵 Completed - Selesai
                                        </option>
                                        <option value="cancelled" {{ $pesanan->status == 'cancelled' ? 'selected' : '' }}>
                                            🔴 Cancelled - Dibatalkan
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-check2-circle"></i> Update Status
                                    </button>
                                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary btn-lg ms-2">
                                        <i class="bi bi-x-circle"></i> Batal
                                    </a>
                                </div>
                            </div>
                        </form>

                        {{-- INFO STATUS --}}
                        <div class="alert alert-light border mt-3 mb-0">
                            <small>
                                <i class="bi bi-lightbulb"></i> <strong>Info:</strong><br>
                                • <strong>Confirmed</strong> → Kendaraan akan berstatus "Disewa"<br>
                                • <strong>Completed/Cancelled</strong> → Kendaraan akan berstatus "Tersedia" kembali
                            </small>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
