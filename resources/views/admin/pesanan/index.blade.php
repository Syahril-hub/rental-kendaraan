@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">📋 Data Pesanan</h2>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FILTER CARD --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.pesanan.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Filter Status</label>
                    <select name="status" class="form-select">
                        <option value="">-- Semua Status --</option>
                        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>
                            🟡 Pending
                        </option>
                        <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>
                            🟢 Confirmed
                        </option>
                        <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>
                            🔵 Completed
                        </option>
                        <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>
                            🔴 Cancelled
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
                @if(request('status'))
                <div class="col-md-2">
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-x-circle"></i> Reset
                    </a>
                </div>
                @endif
            </form>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            @if($pesanans->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Kendaraan</th>
                                <th>Tanggal</th>
                                <th>Durasi</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanans as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div>
                                        <strong>{{ $p->user->name }}</strong><br>
                                        <small class="text-muted">{{ $p->user->email }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $p->kendaraan->nama }}</strong><br>
                                        <small class="text-muted">{{ $p->kendaraan->no_plat }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ \Carbon\Carbon::parse($p->tanggal_mulai)->format('d M Y') }}</strong><br>
                                        <small class="text-muted">s/d {{ \Carbon\Carbon::parse($p->tanggal_selesai)->format('d M Y') }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $p->durasi }} hari</span>
                                </td>
                                <td>
                                    <strong>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</strong>
                                </td>
                                <td>
                                    @if($p->status == 'pending')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    @elseif($p->status == 'confirmed')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Confirmed
                                        </span>
                                    @elseif($p->status == 'completed')
                                        <span class="badge bg-primary">
                                            <i class="bi bi-flag-fill"></i> Completed
                                        </span>
                                    @elseif($p->status == 'cancelled')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle"></i> Cancelled
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.pesanan.show', $p->id) }}" 
                                       class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                    <p class="text-muted mt-3 mb-0">Belum ada data pesanan</p>
                    @if(request('status'))
                        <p class="text-muted">dengan status <strong>{{ request('status') }}</strong></p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
