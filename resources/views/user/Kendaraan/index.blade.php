<h1>List Kendaraan</h1>

@foreach ($kendaraans as $kendaraan)
    <p>{{ $kendaraan->nama }}</p>
@endforeach
