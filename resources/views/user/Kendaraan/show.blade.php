@extends('layouts.app')

@section('content')
<div class="container">

    {{-- Judul --}}
    <h3 class="mb-3">{{ $kendaraan->nama }}</h3>

    {{-- Gambar Kendaraan --}}
    <div class="mb-3">
        <img src="{{ asset('uploads/kendaraan/' . $kendaraan->gambar) }}"
             alt="{{ $kendaraan->nama }}"
             style="max-width: 100%; height: auto;">
    </div>

    {{-- Info Kendaraan --}}
    <p>Harga per hari: <strong>Rp {{ number_format($kendaraan->harga_per_hari) }}</strong></p>
    <p>Status: <strong>{{ $kendaraan->status }}</strong></p>

    {{-- Action Button --}}
    <div class="mt-4">
        <button type="button"
            class="btn btn-success"
            data-bs-toggle="modal"
            data-bs-target="#pesanModal"
            {{ $kendaraan->status !== 'tersedia' ? 'disabled' : '' }}>
            Pesan Kendaraan
        </button>


        <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary ms-2">
            Kembali
        </a>
    </div>

</div>

{{-- ================= MODAL PESAN ================= --}}
<div class="modal fade" id="pesanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('pesanan.preview') }}">
            @csrf

            <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Durasi Sewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @php
                        $today = now()->toDateString();
                    @endphp

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date"
                            name="tanggal_mulai"
                            class="form-control"
                            min="{{ $today }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date"
                            name="tanggal_selesai"
                            class="form-control"
                            min="{{ $today }}"
                            required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">
                        Lanjut
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const start = document.querySelector('input[name="tanggal_mulai"]');
    const end = document.querySelector('input[name="tanggal_selesai"]');

    if (start && end) {
        start.addEventListener('change', function () {
            end.min = this.value;
            if (end.value && end.value < this.value) {
                end.value = this.value;
            }
        });
    }
});
</script>

{{-- =============== END MODAL ================= --}}

@endsection
