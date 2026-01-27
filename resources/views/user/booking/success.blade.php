@extends('layouts.app')

@section('content')

<style>
.success-container {
    max-width: 800px;
    margin: 60px auto;
    padding: 20px;
}

.success-card {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    text-align: center;
}

.success-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #06D6A0, #00B884);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    animation: scaleIn 0.5s ease;
}

@keyframes scaleIn {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}

.success-icon i {
    font-size: 3rem;
    color: white;
}

.success-title {
    font-size: 2rem;
    font-weight: 800;
    color: #1e293b;
    margin-bottom: 1rem;
}

.success-message {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
}

.booking-details {
    background: #f8fafc;
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: left;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    border-bottom: 2px solid #e2e8f0;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    color: #64748b;
    font-weight: 600;
}

.detail-value {
    color: #1e293b;
    font-weight: 700;
}

.status-pending {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    background: linear-gradient(135deg, #fbbf24, #f59e0b);
    color: white;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
}

.btn-group {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-primary-custom {
    flex: 1;
    padding: 1rem;
    background: linear-gradient(135deg, #4361EE, #7209B7);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-secondary-custom {
    flex: 1;
    padding: 1rem;
    background: white;
    color: #4361EE;
    border: 2px solid #4361EE;
    border-radius: 12px;
    font-weight: 700;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease;
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(67, 97, 238, 0.3);
}

.btn-secondary-custom:hover {
    background: #f8fafc;
}
</style>

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="bi bi-check-lg"></i>
        </div>
        
        <h1 class="success-title">Booking Berhasil!</h1>
        <p class="success-message">
            Terima kasih! Pesanan Anda telah diterima dan sedang menunggu konfirmasi dari admin.
        </p>

        <div class="booking-details">
            <div class="detail-row">
                <span class="detail-label">Kendaraan</span>
                <span class="detail-value">{{ $booking->kendaraan->nama }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Mulai</span>
                <span class="detail-value">{{ $booking->tanggal_mulai->format('d M Y') }} - {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Durasi</span>
                <span class="detail-value">{{ $booking->durasi }} hari</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Selesai</span>
                <span class="detail-value">{{ $booking->tanggal_selesai->format('d M Y') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Harga</span>
                <span class="detail-value">Rp{{ number_format($booking->total_harga) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="status-pending">⏳ Menunggu Konfirmasi</span>
            </div>
        </div>

        <div class="alert alert-info" style="background: #e0f2fe; border: 2px solid #0ea5e9; border-radius: 12px; padding: 1rem; color: #075985;">
            <i class="bi bi-info-circle-fill me-2"></i>
            <strong>Info:</strong> Admin akan menghubungi Anda dalam 1x24 jam untuk konfirmasi pemesanan.
        </div>

        <div class="btn-group">
            <a href="/" class="btn-secondary-custom">
                <i class="bi bi-house-fill me-2"></i>Kembali ke Home
            </a>
            <a href="/kendaraan" class="btn-primary-custom">
                <i class="bi bi-search me-2"></i>Lihat Kendaraan Lain
            </a>
        </div>
    </div>
</div>

@endsection
