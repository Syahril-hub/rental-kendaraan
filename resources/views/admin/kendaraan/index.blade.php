@extends('layouts.admin')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">🏍️ Kelola Kendaraan</h3>
            <p class="text-muted mb-0">Manage semua kendaraan rental</p>
        </div>
        <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Tambah Kendaraan
        </a>
    </div>

    {{-- SEARCH & FILTER --}}
    <div class="card mb-3 border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.kendaraan.index') }}">
                <div class="row g-3">
                    <div class="col-md-5">
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="🔍 Cari nama, brand, atau no plat..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="tipe" class="form-control">
                            <option value="">Semua Tipe</option>
                            <option value="Matic" {{ request('tipe') == 'Matic' ? 'selected' : '' }}>Matic</option>
                            <option value="Manual" {{ request('tipe') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-3">Gambar</th>
                            <th>Nama</th>
                            <th>Brand</th>
                            <th>Tipe</th>
                            <th>No Plat</th>
                            <th>Harga/Hari</th>
                            <th>Status</th>
                            <th class="text-center" width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kendaraans as $item)
                        <tr>
                            <td class="px-3">
                                <img src="{{ $item->gambar ? asset('uploads/kendaraan/'.$item->gambar) : 'https://via.placeholder.com/80x60?text=No+Image' }}" 
                                     width="80" 
                                     height="60"
                                     class="rounded shadow-sm"
                                     style="object-fit: cover;">
                            </td>
                            <td>
                                <strong>{{ $item->nama }}</strong>
                            </td>
                            <td>{{ $item->brand }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $item->tipe }}</span>
                            </td>
                            <td>
                                <span class="badge bg-dark">{{ $item->no_plat }}</span>
                            </td>
                            <td>
                                <strong>Rp{{ number_format($item->harga_per_hari) }}</strong>
                            </td>
                            <td>
                                @if($item->status == 'tersedia')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i> Tersedia
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        <i class="bi bi-clock me-1"></i> Disewa
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    {{-- BUTTON EDIT - JELAS! --}}
                                    <a href="{{ route('admin.kendaraan.edit', $item->id) }}" 
                                       class="btn btn-sm btn-warning"
                                       data-bs-toggle="tooltip"
                                       title="Edit {{ $item->nama }}">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </a>
                                    
                                    {{-- BUTTON DELETE - DENGAN KONFIRMASI JELAS! --}}
                                    <form action="{{ route('admin.kendaraan.destroy', $item->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('⚠️ PERHATIAN!\n\nYakin mau HAPUS {{ $item->nama }}?\n\nData yang dihapus TIDAK BISA dikembalikan!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger"
                                                data-bs-toggle="tooltip"
                                                title="Hapus {{ $item->nama }}">
                                            <i class="bi bi-trash3 me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-0">Tidak ada data kendaraan</p>
                                    <small>Silakan tambah kendaraan baru</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            @if($kendaraans->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted small">
                        Menampilkan {{ $kendaraans->firstItem() }} - {{ $kendaraans->lastItem() }} 
                        dari {{ $kendaraans->total() }} kendaraan
                    </div>
                    <div>
                        {{ $kendaraans->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Hover effect table */
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
    transform: scale(1.01);
    transition: all 0.2s;
}

/* Button style improvements */
.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    font-weight: 600;
}

/* Card hover */
.card {
    transition: box-shadow 0.2s;
}

.card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
}
</style>

{{-- Tooltip Bootstrap (optional) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips if Bootstrap is loaded
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    if (typeof bootstrap !== 'undefined') {
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});
</script>
@endsection
