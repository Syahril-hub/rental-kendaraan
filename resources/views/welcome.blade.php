@extends('layouts.app')

@section('content')
<section class="bg-light py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h1 class="fw-bold mb-3">
                    Sewa Kendaraan Mudah & Cepat
                </h1>
                <p class="text-muted mb-4">
                    Pilih kendaraan terbaik dengan harga transparan dan proses
                    pemesanan yang simpel. Cocok untuk perjalanan harian maupun liburan.
                </p>

                <a href="{{ route('kendaraan.index') }}"
                   class="btn btn-primary btn-lg">
                    Lihat Kendaraan
                </a>
            </div>

            <div class="col-md-6 text-center">
                <img
                    src="https://images.unsplash.com/photo-1605559424843-9e4c228bf1c9"
                    alt="Rental Kendaraan"
                    class="img-fluid rounded shadow-sm">
            </div>
        </div>
    </div>
</section>
@endsection
