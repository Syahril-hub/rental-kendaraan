@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 60px 0 40px;">
    <div style="max-width: 900px; margin: 0 auto; padding: 0 20px;">
        <a href="{{ route('user.pesanan.index') }}" style="color: white; text-decoration: none; display: inline-block; margin-bottom: 20px;">
            ← Kembali ke Daftar Pesanan
        </a>
        <h1 style="color: white; margin: 0; font-size: 2rem;">Detail Pesanan #{{ $pesanan->id }}</h1>
    </div>
</div>

<div style="max-width: 900px; margin: -30px auto 60px; padding: 0 20px;">
    <style>
        .status-pending { background: #fef3c7; color: #92400e; padding: 10px 30px; border-radius: 30px; font-size: 1rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .status-confirmed { background: #d1fae5; color: #065f46; padding: 10px 30px; border-radius: 30px; font-size: 1rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .status-completed { background: #dbeafe; color: #1e40af; padding: 10px 30px; border-radius: 30px; font-size: 1rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .status-cancelled { background: #fee2e2; color: #991b1b; padding: 10px 30px; border-radius: 30px; font-size: 1rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
        .status-default { background: #f3f4f6; color: #374151; padding: 10px 30px; border-radius: 30px; font-size: 1rem; font-weight: 700; text-transform: uppercase; display: inline-block; }
    </style>
    <div style="background: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); padding: 30px;">
        
        {{-- Status Badge --}}
        @php $class = 'status-' . ($pesanan->status ?? 'default'); @endphp
        <div style="text-align: center; margin-bottom: 30px;">
            <span class="{{ $class }}">
                {{ $pesanan->status }}
            </span>
        </div>

        {{-- Info Kendaraan --}}
        <h3 style="border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; margin-bottom: 20px;">🏍️ Informasi Kendaraan</h3>
        <div style="display: grid; grid-template-columns: 200px 1fr; gap: 15px; margin-bottom: 30px;">
            @if($pesanan->kendaraan->gambar)
                <img src="{{ asset('storage/' . $pesanan->kendaraan->gambar) }}" 
                    alt="{{ $pesanan->kendaraan->nama }}"
                    style="width: 100%; height: 150px; border-radius: 8px; object-fit: cover;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div style="width: 100%; height: 150px; background: #e5e7eb; border-radius: 8px; display: none; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.9rem;">
                    📷 Gambar tidak tersedia
                </div>
            @else
                <div style="width: 100%; height: 150px; background: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af; font-size: 0.9rem;">
                    📷 Gambar tidak tersedia
                </div>
            @endif
            <div>
                <p style="margin: 0 0 8px 0;"><strong>Nama:</strong> {{ $pesanan->kendaraan->nama }}</p>
                <p style="margin: 0 0 8px 0;"><strong>Merk:</strong> {{ $pesanan->kendaraan->brand }}</p>
                <p style="margin: 0 0 8px 0;"><strong>Tipe:</strong> {{ $pesanan->kendaraan->tipe }}</p>
                <p style="margin: 0 0 8px 0;"><strong>No Plat:</strong> {{ $pesanan->kendaraan->no_plat }}</p>
            </div>
        </div>


        {{-- Info Sewa --}}
        <h3 style="border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; margin-bottom: 20px;">📅 Informasi Sewa</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
            <div>
                <p style="color: #9ca3af; margin: 0 0 5px 0;">Tanggal Mulai</p>
                <p style="margin: 0; font-weight: 600;">{{ \Carbon\Carbon::parse($pesanan->tanggal_mulai)->format('d M Y') }}</p>
            </div>
            <div>
                <p style="color: #9ca3af; margin: 0 0 5px 0;">Durasi Sewa</p>
                <p style="margin: 0; font-weight: 600;">{{ $pesanan->total_hari }} hari</p>
            </div>
            <div>
                <p style="color: #9ca3af; margin: 0 0 5px 0;">Tanggal Selesai</p>
                <p style="margin: 0; font-weight: 600;">
                    {{ \Carbon\Carbon::parse($pesanan->tanggal_selesai)->format('d M Y') }}
                </p>
            </div>
        </div>

        {{-- Info Harga --}}
        <h3 style="border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; margin-bottom: 20px;">💰 Rincian Harga</h3>
        <div style="background: #f9fafb; padding: 20px; border-radius: 8px;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <span>Harga per Hari:</span>
                <span>Rp {{ number_format($pesanan->kendaraan->harga_sewa ?? $pesanan->kendaraan->harga_per_hari ?? 0, 0, ',', '.') }}</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                <span>Durasi:</span>
                <span>{{ $pesanan->total_hari }} hari</span>
            </div>
            <div style="border-top: 2px solid #e5e7eb; padding-top: 15px; margin-top: 15px; display: flex; justify-content: space-between; font-size: 1.3rem; font-weight: 700; color: #667eea;">
                <span>Total:</span>
                <span>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

    </div>
</div>
@endsection
