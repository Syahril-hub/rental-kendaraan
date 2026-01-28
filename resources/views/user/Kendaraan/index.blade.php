@extends('layouts.app')

@section('content')
<div class="bg-light py-5">
    <div class="container">
        {{-- HEADER --}}
        <div class="row mb-4">
            <div class="col-lg-8">
                <h2 class="mb-2">🏍️ Pilih Kendaraan</h2>
                <p class="text-muted mb-0">
                    Menampilkan 
                    @if(request('tipe'))
                        <span class="badge bg-primary">{{ ucfirst(request('tipe')) }}</span>
                    @else
                        <strong>Semua Kendaraan</strong>
                    @endif
                    ({{ $kendaraans->count() }} tersedia)
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <div class="btn-group" role="group">
                    <a href="{{ route('kendaraan.index') }}" 
                       class="btn btn-sm {{ !request('tipe') ? 'btn-primary' : 'btn-outline-primary' }}">
                        Semua
                    </a>
                    <a href="{{ route('kendaraan.index', ['tipe' => 'motor']) }}" 
                       class="btn btn-sm {{ request('tipe') == 'motor' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Motor
                    </a>
                    <a href="{{ route('kendaraan.index', ['tipe' => 'mobil']) }}" 
                       class="btn btn-sm {{ request('tipe') == 'mobil' ? 'btn-primary' : 'btn-outline-primary' }}">
                        Mobil
                    </a>
                </div>
            </div>
        </div>

        {{-- GRID KENDARAAN --}}
        <div class="row g-4">
            @forelse($kendaraans as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 hover-card">
                        {{-- IMAGE --}}
                        <div class="position-relative">
                            <img
                                src="{{ $item->gambar 
                                    ? asset('uploads/kendaraan/'.$item->gambar) 
                                    : 'https://via.placeholder.com/400x250?text=No+Image' }}"
                                class="card-img-top"
                                style="height: 200px; object-fit: cover;"
                                alt="{{ $item->nama }}"
                            >
                            {{-- BADGE STATUS --}}
                            @if($item->status == 'tersedia')
                                <span class="badge bg-success position-absolute top-0 end-0 m-2">
                                    <i class="bi bi-check-circle"></i> Tersedia
                                </span>
                            @else
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2">
                                    <i class="bi bi-x-circle"></i> Disewa
                                </span>
                            @endif
                            
                            {{-- BADGE TIPE --}}
                            <span class="badge bg-dark position-absolute bottom-0 start-0 m-2">
                                @if($item->tipe == 'motor')
                                    <i class="bi bi-bicycle"></i> Motor
                                @else
                                    <i class="bi bi-car-front"></i> Mobil
                                @endif
                            </span>
                        </div>

                        <div class="card-body d-flex flex-column">
                            {{-- NAMA KENDARAAN --}}
                            <h5 class="card-title mb-2" style="min-height: 48px;">
                                {{ $item->nama }}
                            </h5>

                            {{-- NO PLAT --}}
                            <p class="text-muted mb-2">
                                <i class="bi bi-credit-card-2-front"></i> 
                                <strong>{{ $item->no_plat }}</strong>
                            </p>

                            {{-- HARGA --}}
                            <div class="mb-3">
                                <h4 class="text-success mb-0">
                                    Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                </h4>
                                <small class="text-muted">per hari</small>
                            </div>

                            {{-- BUTTON --}}
                            <div class="mt-auto">
                                @if($item->status == 'tersedia')
                                    <a href="{{ route('kendaraan.show', $item->id) }}"
                                       class="btn btn-primary w-100">
                                        <i class="bi bi-calendar-check"></i> Booking Sekarang
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="bi bi-lock"></i> Sedang Disewa
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="bi bi-info-circle fs-1 mb-3 d-block"></i>
                        <h5>Tidak ada kendaraan tersedia</h5>
                        <p class="mb-0">Silakan coba filter lain atau kembali nanti.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0,0,0,0.12) !important;
}
</style>
@endsection
