@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $kendaraan->nama }}</h3>

    <img src="{{ asset($kendaraan->gambar) }}"
     alt="{{ $kendaraan->nama }}"
     style="max-width: 100%;">


    <p>Harga per hari: Rp {{ number_format($kendaraan->harga_per_hari) }}</p>
    <p>Status: {{ $kendaraan->status }}</p>

    <button class="btn btn-success">
        Pesan Kendaraan
    </button>

    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary ms-2">
        Kembali
    </a>
</div>
@endsection
