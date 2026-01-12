@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- JUDUL --}}
    <h3 class="mb-3">{{ $kendaraan->nama }}</h3>

    {{-- GAMBAR --}}
    <div class="mb-3">
        <img src="{{ asset('uploads/kendaraan/' . $kendaraan->gambar) }}"
             alt="{{ $kendaraan->nama }}"
             class="img-fluid rounded">
    </div>

    {{-- INFO --}}
    <p>Harga per hari: <strong>Rp {{ number_format($kendaraan->harga_per_hari) }}</strong></p>
    <p>Status: <strong>{{ $kendaraan->status }}</strong></p>

    {{-- ACTION --}}
    <div class="mt-4">
        <button
            type="button"
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

@if ($errors->any())
<div class="alert alert-danger">
    {{ $errors->first() }}
</div>
@endif

{{-- ================= MODAL ================= --}}
<div class="modal fade" id="pesanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">

        <form method="POST" action="{{ route('pesanan.preview') }}">
            @csrf
            <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Pilih Durasi Sewa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                @php
                    $today = now()->toDateString();
                    $jamOptions = [
                        '08:00','09:00','10:00','11:00',
                        '12:00','13:00','14:00','15:00',
                        '16:00','17:00','18:00'
                    ];
                @endphp

                <div class="modal-body">

                    {{-- MULAI --}}
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Tanggal Mulai</label>
                            <input
                                type="date"
                                name="tanggal_mulai"
                                class="form-control"
                                min="{{ $today }}"
                                required>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Jam Mulai</label>
                            <select name="jam_mulai" class="form-select" required>
                                <option value="">Pilih</option>
                                @foreach ($jamOptions as $jam)
                                    <option value="{{ $jam }}">{{ $jam }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- SELESAI --}}
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Tanggal Selesai</label>
                            <input
                                type="date"
                                name="tanggal_selesai"
                                class="form-control"
                                min="{{ $today }}"
                                required>
                        </div>

                        <div class="col-6">
                            <label class="form-label">Jam Selesai</label>
                            <select name="jam_selesai" class="form-select" required>
                                <option value="">Pilih</option>
                                @foreach ($jamOptions as $jam)
                                    <option value="{{ $jam }}">{{ $jam }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">
                        Lanjut
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>
{{-- ================= END MODAL ================= --}}

<script>
document.addEventListener('DOMContentLoaded', function () {
    const jamMulai = document.querySelector('[name="jam_mulai"]');
    const jamSelesai = document.querySelector('[name="jam_selesai"]');

    jamMulai.addEventListener('change', function () {
        const mulai = this.value;

        [...jamSelesai.options].forEach(opt => {
            opt.disabled = opt.value && opt.value <= mulai;
        });

        if (jamSelesai.value <= mulai) {
            jamSelesai.value = '';
        }
    });
});
</script>


@endsection
