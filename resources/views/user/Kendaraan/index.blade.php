@extends('layouts.app')

@section('content')

<section style="max-width:1100px; margin:40px auto; padding:0 20px;">
  <h1 style="margin-bottom:20px;">List Kendaraan</h1>

  {{-- INFO FILTER --}}
  <p style="margin-bottom:20px; color:#555;">
    Menampilkan kendaraan
    @if(request('tipe'))
      tipe <strong>{{ ucfirst(request('tipe')) }}</strong>
    @else
      <strong>semua tipe</strong>
    @endif
  </p>

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



        <h3 style="
          margin:12px 0 6px;
          font-size:18px;
          line-height:1.4;
          height:50px;
          overflow:hidden;
        ">
          {{ $item->nama }}
        </h3>

        <p style="color:#555; margin-bottom:12px;">
          Rp{{ number_format($item->harga_per_hari) }}/hari
        </p>

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
