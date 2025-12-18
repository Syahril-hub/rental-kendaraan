<h3>{{ $kendaraan->nama }}</h3>

<p>Mulai: {{ $mulai->format('d M Y') }}</p>
<p>Selesai: {{ $selesai->format('d M Y') }}</p>
<p>Total Hari: {{ $total_hari }}</p>
<p>Total Harga: Rp {{ number_format($total_harga) }}</p>

<a href="{{ route('kendaraan.index') }}">Kembali</a>
