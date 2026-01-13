@extends('layouts.app')

@section('content')

@php
  $today = date('Y-m-d');
@endphp

{{-- HERO --}}
<section style="
  background:#f5f7fa;
  padding:60px 20px;
  text-align:center;
">
  <h1 style="font-size:36px; margin-bottom:10px;">
    Rental Motor Cepat & Aman
  </h1>
  <p style="font-size:18px; color:#555;">
    Pilihan lengkap · Harga transparan · Layanan 24 jam
  </p>
</section>

{{-- FORM CARI --}}
<section style="
  max-width:1000px;
  margin:-35px auto 50px;
  background:#fff;
  padding:24px;
  border-radius:10px;
  box-shadow:0 6px 20px rgba(0,0,0,0.1);
">
  <form method="GET"
        action="{{ route('kendaraan.index') }}"
        style="
          display:grid;
          grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
          gap:16px;
        ">

    <div>
      <label style="font-weight:600;">Tipe Kendaraan</label>
      <select name="tipe"
              style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
        <option value="">Semua</option>
        <option value="matic">Matic</option>
        <option value="manual">Manual</option>
      </select>
    </div>

    <div>
      <label style="font-weight:600;">Tanggal Mulai</label>
      <input type="date"
             name="tanggal_mulai"
             min="{{ $today }}"
             required
             style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
    </div>

    <div>
      <label style="font-weight:600;">Jam Mulai</label>
      <input type="time"
             name="jam_mulai"
             required
             style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
    </div>

    <div>
      <label style="font-weight:600;">Durasi Sewa</label>
      <select name="durasi"
              required
              style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
        @for($i = 1; $i <= 7; $i++)
          <option value="{{ $i }}">{{ $i }} hari</option>
        @endfor
      </select>
      <small style="color:#777;">Durasi 24 jam / hari</small>
    </div>

    <div style="align-self:end;">
      <button type="submit"
              style="
                width:100%;
                padding:12px;
                background:#2563eb;
                color:white;
                border:none;
                border-radius:8px;
                font-size:16px;
                cursor:pointer;
              ">
        Cari Kendaraan
      </button>
    </div>

  </form>
</section>

{{-- MOTOR TERPOPULER --}}
<section style="max-width:1100px; margin:0 auto 60px; padding:0 20px;">
  <h2 style="margin-bottom:20px;">
    Motor Terpopuler
  </h2>

  <div style="
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
    gap:24px;
  ">
    @forelse($kendaraans as $item)
      <div style="
        border:1px solid #eee;
        border-radius:10px;
        padding:16px;
        background:#fff;
        box-shadow:0 4px 12px rgba(0,0,0,0.06);
        display:flex;
        flex-direction:column;
        height:100%;
      ">

        <img
            src="{{ $item->gambar 
                ? asset('uploads/kendaraan/'.$item->gambar) 
                : 'https://via.placeholder.com/300x200?text=No+Image' }}"
            style="
                width:100%;
                height:150px;
                object-fit:cover;
                border-radius:8px;
            "
        >


        {{-- JUDUL DIBATASI TINGGI --}}
        <h3 style="
          margin:12px 0 6px;
          font-size:18px;
          line-height:1.4;
          height:52px;
          overflow:hidden;
        ">
          {{ $item->nama }}
        </h3>

        <p style="color:#555; margin-bottom:14px;">
          Rp{{ number_format($item->harga_per_hari) }}/hari
        </p>

        {{-- BUTTON SELALU DI BAWAH --}}
        <div style="margin-top:auto;">
          <a href="{{ route('kendaraan.show', $item->id) }}"
             style="
               display:block;
               text-align:center;
               padding:10px;
               background:#16a34a;
               color:white;
               border-radius:8px;
               text-decoration:none;
               font-weight:600;
             ">
            Booking
          </a>
        </div>

      </div>
    @empty
      <p>Tidak ada kendaraan tersedia.</p>
    @endforelse
  </div>
</section>

@endsection
