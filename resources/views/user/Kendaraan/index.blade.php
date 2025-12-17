<h1>List Kendaraan</h1>

@foreach ($kendaraans as $kendaraan)
    <p>
        <a href="{{ route('kendaraan.show', $kendaraan->id) }}">
            {{ $kendaraan->nama }}
        </a>
    </p>
@endforeach
