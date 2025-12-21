@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Preview Pesanan</h5>
                </div>

                <div class="card-body">
                    <table class="table table-borderless mb-3">
                        <tr>
                            <td>Nama Kendaraan</td>
                            <td class="text-end"><strong>{{ $kendaraan->nama }}</strong></td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td class="text-end">{{ $mulai->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Selesai</td>
                            <td class="text-end">{{ $selesai->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <td>Total Hari</td>
                            <td class="text-end">{{ $total_hari }} hari</td>
                        </tr>
                        <tr>
                            <td>Harga / Hari</td>
                            <td class="text-end">
                                Rp {{ number_format($kendaraan->harga_per_hari) }}
                            </td>
                        </tr>
                        <tr class="border-top">
                            <td><strong>Total Harga</strong></td>
                            <td class="text-end">
                                <strong class="text-success">
                                    Rp {{ number_format($total_harga) }}
                                </strong>
                            </td>
                        </tr>
                    </table>

                    <form method="POST" action="{{ route('pesanan.store') }}">
                        @csrf
                        <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">
                        <input type="hidden" name="tanggal_mulai" value="{{ $mulai->toDateString() }}">
                        <input type="hidden" name="tanggal_selesai" value="{{ $selesai->toDateString() }}">
                        <input type="hidden" name="total_hari" value="{{ $total_hari }}">
                        <input type="hidden" name="total_harga" value="{{ $total_harga }}">

                        <button type="submit" class="btn btn-primary w-100">
                            Konfirmasi Pesanan
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
