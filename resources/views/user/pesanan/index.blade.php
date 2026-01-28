@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0 40px;">
    <div style="max-width: 1140px; margin: 0 auto; padding: 0 20px;">
        <h1 style="color: white; margin: 0; font-size: 2.5rem;">📋 Daftar Pesanan Saya</h1>
        <p style="color: rgba(255,255,255,0.9); margin-top: 10px;">Lihat semua riwayat booking kendaraan Anda</p>
    </div>
</div>

<div style="max-width: 1140px; margin: -30px auto 60px; padding: 0 20px;">
    <style>
        .status-pending { background: #fef3c7; color: #92400e; border: 1px solid #fbbf24; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; display: inline-block; }
        .status-confirmed { background: #d1fae5; color: #065f46; border: 1px solid #10b981; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; display: inline-block; }
        .status-completed { background: #dbeafe; color: #1e40af; border: 1px solid #3b82f6; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; display: inline-block; }
        .status-cancelled { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; display: inline-block; }
        .status-default { background: #f3f4f6; color: #374151; padding: 6px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; display: inline-block; }
    </style>
    @if($pesanans->count() > 0)
        @foreach($pesanans as $pesanan)
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; display: flex; gap: 20px; align-items: center;">
            
            {{-- Image Kendaraan --}}
            <div style="flex-shrink: 0;">
                @if($pesanan->kendaraan->gambar)
                    <img src="{{ asset('storage/' . $pesanan->kendaraan->gambar) }}" 
                         alt="{{ $pesanan->kendaraan->nama }}"
                         style="width: 150px; height: 120px; object-fit: cover; border-radius: 8px;">
                @else
                    <div style="width: 150px; height: 120px; background: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                        No Image
                    </div>
                @endif
            </div>

            {{-- Info Pesanan --}}
            <div style="flex: 1;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                    <div>
                        <h3 style="margin: 0 0 5px 0; font-size: 1.3rem; color: #1f2937;">
                            {{ $pesanan->kendaraan->nama }}
                        </h3>
                        <p style="margin: 0; color: #6b7280; font-size: 0.9rem;">
                            📅 {{ \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d M Y') }} 
                            | 📆 {{ $pesanan->total_hari }} hari
                        </p>
                    </div>
                    
                    {{-- Badge Status --}}
                    @php
                        $class = 'status-' . ($pesanan->status ?? 'default');
                    @endphp
                    <span class="{{ $class }}">
                        {{ $pesanan->status }}
                    </span>
                </div>

                <div style="display: flex; gap: 30px; margin-top: 15px; padding-top: 15px; border-top: 1px solid #e5e7eb;">
                    <div>
                        <p style="margin: 0; color: #9ca3af; font-size: 0.85rem;">Total Harga</p>
                        <p style="margin: 5px 0 0 0; font-size: 1.2rem; font-weight: 700; color: #667eea;">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </p>
                    </div>
                    <div>
                        <p style="margin: 0; color: #9ca3af; font-size: 0.85rem;">Kendaraan</p>
                        <p style="margin: 5px 0 0 0; font-weight: 600; color: #374151;">
                            {{ $pesanan->kendaraan->brand }} - {{ $pesanan->kendaraan->no_plat }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Action Button --}}
            <div style="flex-shrink: 0;">
                <a href="{{ route('user.pesanan.show', $pesanan->id) }}" 
                   style="display: inline-block; background: #667eea; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s;">
                    Lihat Detail
                </a>
            </div>
        </div>
        @endforeach
    @else
        {{-- Empty State --}}
        <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 60px 20px; text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 20px;">📭</div>
            <h3 style="color: #374191; margin-bottom: 10px;">Belum Ada Pesanan</h3>
            <p style="color: #9ca3af; margin-bottom: 30px;">Anda belum memiliki riwayat booking kendaraan</p>
            <a href="{{ route('kendaraan.index') }}" 
               style="display: inline-block; background: #667eea; color: white; padding: 12px 30px; border-radius: 8px; text-decoration: none; font-weight: 600;">
                🏍️ Pilih Kendaraan
            </a>
        </div>
    @endif
</div>
@endsection
