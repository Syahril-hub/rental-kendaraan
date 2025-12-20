<form method="POST" action="{{ route('pesanan.store') }}">
    @csrf
    
    <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">
    <input type="hidden" name="tanggal_mulai" value="{{ $mulai->toDateString() }}">
    <input type="hidden" name="tanggal_selesai" value="{{ $selesai->toDateString() }}">
    <input type="hidden" name="total_hari" value="{{ $total_hari }}">
    <input type="hidden" name="total_harga" value="{{ $total_harga }}">

    <button type="submit" class="btn btn-primary">
        Konfirmasi Pesanan
    </button>
</form>
