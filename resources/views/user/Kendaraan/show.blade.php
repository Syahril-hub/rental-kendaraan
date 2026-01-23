@extends('layouts.app')

@section('content')

<style>
.detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.breadcrumb-custom {
    background: none;
    padding: 0;
    margin-bottom: 2rem;
}

.breadcrumb-custom a {
    color: #4361EE;
    text-decoration: none;
    font-weight: 600;
}

.breadcrumb-custom a:hover {
    text-decoration: underline;
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 2.5rem;
}

.main-content-section {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

.vehicle-image-large {
    width: 100%;
    height: 450px;
    object-fit: cover;
    background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%);
}

.content-body {
    padding: 2.5rem;
}

.vehicle-title-large {
    font-size: 2.25rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}

.vehicle-meta {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #64748b;
    font-weight: 600;
}

.meta-item i {
    color: #4361EE;
    font-size: 1.1rem;
}

.info-section {
    margin-bottom: 2.5rem;
}

.info-section h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.info-item {
    background: #f8fafc;
    padding: 1.25rem;
    border-radius: 12px;
    border: 2px solid #e2e8f0;
}

.info-label {
    font-size: 0.85rem;
    color: #64748b;
    font-weight: 600;
    margin-bottom: 0.25rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    font-size: 1.1rem;
    font-weight: 700;
    color: #1e293b;
}

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1.25rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
}

.status-available {
    background: linear-gradient(135deg, #06D6A0, #00B884);
    color: white;
}

.status-unavailable {
    background: #ef4444;
    color: white;
}

/* Sidebar Booking Card */
.booking-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.12);
    position: sticky;
    top: 100px;
}

.price-section {
    text-align: center;
    padding: 1.5rem;
    background: linear-gradient(135deg, #4361EE, #7209B7);
    border-radius: 16px;
    margin-bottom: 2rem;
    color: white;
}

.price-label {
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: 0.25rem;
}

.price-value {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1;
}

.price-value small {
    font-size: 1rem;
    font-weight: 600;
    opacity: 0.9;
}

.booking-form-group {
    margin-bottom: 1.5rem;
}

.form-label-booking {
    display: block;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.form-control-booking {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control-booking:focus {
    border-color: #4361EE;
    box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1);
    outline: none;
}

.calculation-box {
    background: #f8fafc;
    padding: 1.5rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
}

.calc-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    font-size: 0.95rem;
}

.calc-row:last-child {
    margin-bottom: 0;
    padding-top: 0.75rem;
    border-top: 2px solid #e2e8f0;
    font-weight: 700;
    font-size: 1.1rem;
}

.btn-booking-full {
    width: 100%;
    padding: 1.125rem;
    background: linear-gradient(135deg, #06D6A0, #00B884);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(6, 214, 160, 0.3);
}

.btn-booking-full:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(6, 214, 160, 0.4);
}

.btn-disabled {
    background: #cbd5e1 !important;
    cursor: not-allowed;
    box-shadow: none;
}

.btn-disabled:hover {
    transform: none;
}

.requirements-box {
    margin-top: 2rem;
    padding: 1.5rem;
    background: #fef3c7;
    border-left: 4px solid #f59e0b;
    border-radius: 12px;
}

.requirements-box h4 {
    font-size: 1rem;
    font-weight: 700;
    color: #92400e;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.requirements-box ul {
    margin: 0;
    padding-left: 1.25rem;
    color: #78350f;
}

.requirements-box li {
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

/* Responsive */
@media (max-width: 992px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .booking-card {
        position: relative;
        top: 0;
    }
}

@media (max-width: 768px) {
    .vehicle-image-large {
        height: 300px;
    }
    
    .vehicle-title-large {
        font-size: 1.75rem;
    }
    
    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="detail-container">
    
    {{-- Breadcrumb --}}
    <nav class="breadcrumb-custom">
        <a href="/">Home</a>
        <span class="mx-2">/</span>
        <a href="/kendaraan">Kendaraan</a>
        <span class="mx-2">/</span>
        <span class="text-muted">{{ $kendaraan->nama }}</span>
    </nav>

    
    <div class="detail-grid">
        
        {{-- MAIN CONTENT --}}
        <div class="main-content-section">
            <img src="{{ $kendaraan->gambar ? asset('uploads/kendaraan/'.$kendaraan->gambar) : 'https://via.placeholder.com/800x450?text=No+Image' }}"
                 alt="{{ $kendaraan->nama }}"
                 class="vehicle-image-large">
            
            <div class="content-body">
                <h1 class="vehicle-title-large">{{ $kendaraan->nama }}</h1>
                
                <div class="vehicle-meta">
                    <div class="meta-item">
                        <i class="bi bi-tag-fill"></i>
                        <span>{{ $kendaraan->brand }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-gear-fill"></i>
                        <span>{{ ucfirst($kendaraan->tipe) }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="bi bi-credit-card-fill"></i>
                        <span>{{ $kendaraan->no_plat }}</span>
                    </div>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    @if($kendaraan->status == 'tersedia')
                        <span class="status-badge status-available">
                            <i class="bi bi-check-circle-fill"></i>
                            Tersedia untuk disewa
                        </span>
                    @else
                        <span class="status-badge status-unavailable">
                            <i class="bi bi-x-circle-fill"></i>
                            Sedang disewa
                        </span>
                    @endif
                </div>

                {{-- Spesifikasi --}}
                <div class="info-section">
                    <h3>
                        <i class="bi bi-clipboard-data"></i>
                        Spesifikasi Kendaraan
                    </h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Brand</div>
                            <div class="info-value">{{ $kendaraan->brand }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tipe</div>
                            <div class="info-value">{{ ucfirst($kendaraan->tipe) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">No. Plat</div>
                            <div class="info-value">{{ $kendaraan->no_plat }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">{{ ucfirst($kendaraan->status) }}</div>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="info-section">
                    <h3>
                        <i class="bi bi-file-text"></i>
                        Deskripsi
                    </h3>
                    <p style="color: #64748b; line-height: 1.8;">
                        Motor {{ $kendaraan->nama }} ini cocok untuk perjalanan wisata atau keperluan sehari-hari di Yogyakarta. 
                        Dilengkapi dengan helmet SNI, jas hujan, dan asuransi kendaraan. Kendaraan dalam kondisi terawat dan siap pakai.
                    </p>
                </div>
            </div>
        </div>

        {{-- BOOKING SIDEBAR --}}
        <div class="booking-card">
            <div class="price-section">
                <div class="price-label">Harga Sewa</div>
                <div class="price-value">
                    Rp{{ number_format($kendaraan->harga_per_hari) }}
                    <small>/hari</small>
                </div>
            </div>

            @if($kendaraan->status == 'tersedia')
                <form method="GET" action="{{ route('pesanan.preview') }}">
                    <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

                    <div class="booking-form-group">
                        <label class="form-label-booking">
                            <i class="bi bi-calendar-event me-1"></i> Tanggal Mulai
                        </label>
                        <input type="date" name="tanggal_mulai" class="form-control-booking" 
                               min="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="booking-form-group">
                        <label class="form-label-booking">
                            <i class="bi bi-clock me-1"></i> Jam Mulai
                        </label>
                        <input type="time" name="jam_mulai" class="form-control-booking" 
                               value="08:00" required>
                    </div>

                    <div class="booking-form-group">
                        <label class="form-label-booking">
                            <i class="bi bi-hourglass-split me-1"></i> Durasi Sewa
                        </label>
                        <select name="total_hari" class="form-control-booking" id="durasiSelect" data-price="{{ $kendaraan->harga_per_hari }}" required>
                            @for($i = 1; $i <= 30; $i++)
                                <option value="{{ $i }}">{{ $i }} hari</option>
                            @endfor
                        </select>
                    </div>

                    {{-- Calculation Preview --}}
                    <div class="calculation-box">
                        <div class="calc-row">
                            <span>Harga per hari</span>
                            <span id="pricePerDay">Rp{{ number_format($kendaraan->harga_per_hari) }}</span>
                        </div>
                        <div class="calc-row">
                            <span>Durasi</span>
                            <span id="durationText">1 hari</span>
                        </div>
                        <div class="calc-row">
                            <span>Total</span>
                            <span id="totalPrice">Rp{{ number_format($kendaraan->harga_per_hari) }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-booking-full">
                        <i class="bi bi-calendar-check me-2"></i>
                        Lanjut ke Pemesanan
                    </button>
                </form>

                {{-- Requirements --}}
                <div class="requirements-box">
                    <h4>
                        <i class="bi bi-info-circle-fill"></i>
                        Persyaratan Sewa
                    </h4>
                    <ul>
                        <li>KTP/SIM asli (fotocopy diserahkan)</li>
                        <li>Deposit Rp500.000 (dikembalikan)</li>
                        <li>Usia minimal 17 tahun</li>
                        <li>Pemesanan H-1 lebih awal</li>
                    </ul>
                </div>
            @else
                <button class="btn-booking-full btn-disabled" disabled>
                    <i class="bi bi-x-circle me-2"></i>
                    Kendaraan Tidak Tersedia
                </button>
            @endif
        </div>

    </div>
</div>

<script>
const durasiSelect = document.getElementById('durasiSelect');
if (durasiSelect) {
    durasiSelect.addEventListener('change', function() {
        const days = parseInt(this.value);
        const pricePerDay = parseInt(this.getAttribute('data-price'));
        const total = days * pricePerDay;
        
        const durationText = document.getElementById('durationText');
        const totalPrice = document.getElementById('totalPrice');
        
        if (durationText) {
            durationText.textContent = days + ' hari';
        }
        
        if (totalPrice) {
            totalPrice.textContent = 'Rp' + total.toLocaleString('id-ID');
        }
    });
}
</script>


@endsection
