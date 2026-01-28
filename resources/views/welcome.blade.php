@extends('layouts.app')

@section('content')

@php
  $today = date('Y-m-d');
@endphp

<style>
/* Hero Section */
.hero-section {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 80px 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="rgba(255,255,255,0.1)"/></svg>');
    opacity: 0.1;
}

.hero-content {
    position: relative;
    z-index: 1;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    text-shadow: 0 4px 20px rgba(0,0,0,0.2);
}

.hero-subtitle {
    font-size: 1.25rem;
    color: rgba(255, 255, 255, 0.95);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.hero-features {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.feature-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    color: white;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

/* Search Form */
.search-form-container {
    max-width: 1100px;
    margin: -50px auto 80px;
    position: relative;
    z-index: 10;
    padding: 0 20px;
}

.search-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
}

.search-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    color: #1e293b;
}

.form-group-custom {
    margin-bottom: 0;
}

.form-label-custom {
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    display: block;
}

.form-control-custom {
    padding: 0.875rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    width: 100%;
}

.form-control-custom:focus {
    border-color: #4361EE;
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    outline: none;
}

.form-helper-text {
    font-size: 0.8rem;
    color: #64748b;
    margin-top: 0.25rem;
}

.btn-search {
    background: linear-gradient(135deg, #4361EE, #7209B7);
    color: white;
    padding: 1rem 2.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    width: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
}

.btn-search:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(67, 97, 238, 0.4);
}

/* Vehicle Section */
.vehicles-section {
    max-width: 1200px;
    margin: 0 auto 80px;
    padding: 0 20px;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #64748b;
}

.vehicles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
}

.vehicle-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.vehicle-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.vehicle-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%);
}

.vehicle-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.vehicle-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.75rem;
    line-height: 1.4;
    min-height: 60px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.vehicle-price {
    font-size: 1.5rem;
    font-weight: 800;
    color: #4361EE;
    margin-bottom: 1.25rem;
}

.vehicle-price small {
    font-size: 0.9rem;
    font-weight: 600;
    color: #64748b;
}

.btn-booking {
    background: linear-gradient(135deg, #06D6A0, #00B884);
    color: white;
    padding: 0.875rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s ease;
    display: block;
    margin-top: auto;
}

.btn-booking:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(6, 214, 160, 0.3);
    color: white;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-state i {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 1rem;
}

.empty-state h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #64748b;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #94a3b8;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .search-card {
        padding: 1.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .vehicles-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }
}
</style>

{{-- HERO SECTION --}}
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">
            Rental Motor Cepat & Aman
        </h1>
        <p class="hero-subtitle">
            Jelajahi Yogyakarta dengan motor pilihan terbaik. Proses booking mudah, 
            harga transparan, dan siap melayani 24 jam untuk petualangan Anda.
        </p>
        
        <div class="hero-features">
            <div class="feature-badge">
                <i class="bi bi-check-circle-fill"></i>
                <span>Pilihan Lengkap</span>
            </div>
            <div class="feature-badge">
                <i class="bi bi-shield-check"></i>
                <span>Asuransi Terjamin</span>
            </div>
            <div class="feature-badge">
                <i class="bi bi-clock-fill"></i>
                <span>Layanan 24 Jam</span>
            </div>
        </div>
    </div>
</section>

{{-- SEARCH FORM --}}
<section class="search-form-container">
    <div class="search-card">
        <h3><i class="bi bi-search me-2"></i> Cari Kendaraan</h3>
        
        <form method="GET" action="{{ route('kendaraan.index') }}" class="row g-3">
            
            <div class="col-md-3">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-bicycle me-1"></i> Tipe Kendaraan
                    </label>
                    <select name="tipe" class="form-control-custom">
                        <option value="">Semua Tipe</option>
                        <option value="Matic">Matic</option>     <!-- HARUS "Matic" bukan "matic" -->
                        <option value="Manual">Manual</option>   <!-- HARUS "Manual" bukan "manual" -->
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-calendar me-1"></i> Tanggal Mulai
                    </label>
                    <input type="date" name="tanggal_mulai" min="{{ $today }}" 
                           class="form-control-custom" required>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-clock me-1"></i> Jam Mulai
                    </label>
                    <input type="time" name="jam_mulai" value="08:00" 
                           class="form-control-custom" required>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group-custom">
                    <label class="form-label-custom">
                        <i class="bi bi-hourglass-split me-1"></i> Durasi
                    </label>
                    <select name="durasi" class="form-control-custom" required>
                        @for($i = 1; $i <= 7; $i++)
                            <option value="{{ $i }}">{{ $i }} hari</option>
                        @endfor
                    </select>
                    <small class="form-helper-text">Durasi 24 jam/hari</small>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn-search">
                    <i class="bi bi-search me-2"></i> Cari
                </button>
            </div>

        </form>
    </div>
</section>

{{-- VEHICLES SECTION --}}
<section class="vehicles-section">
    <div class="section-header">
        <h2 class="section-title">Motor Terpopuler</h2>
        <p class="section-subtitle">Pilihan favorit pelanggan kami dengan rating terbaik</p>
    </div>

    <div class="vehicles-grid">
        @forelse($kendaraans as $item)
            <div class="vehicle-card">
                <img src="{{ $item->gambar ? asset('uploads/kendaraan/'.$item->gambar) : 'https://via.placeholder.com/300x200?text=No+Image' }}"
                     alt="{{ $item->nama }}"
                     class="vehicle-image">
                
                <div class="vehicle-content">
                    <h3 class="vehicle-title">{{ $item->nama }}</h3>
                    
                    <div class="vehicle-price">
                        Rp{{ number_format($item->harga_per_hari) }}
                        <small>/hari</small>
                    </div>

                    <a href="{{ route('kendaraan.show', $item->id) }}" class="btn-booking">
                        <i class="bi bi-calendar-check me-2"></i> Booking Sekarang
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Belum Ada Kendaraan</h4>
                    <p>Kendaraan akan segera tersedia. Silakan cek kembali nanti.</p>
                </div>
            </div>
        @endforelse
    </div>
</section>

@endsection
