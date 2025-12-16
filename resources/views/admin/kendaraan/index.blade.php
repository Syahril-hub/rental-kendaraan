<h1>Data Kendaraan</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<a href="{{ url('/admin/kendaraan/create') }}">+ Tambah Kendaraan</a>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Brand</th>
        <th>Tipe</th>
        <th>No Plat</th>
        <th>Harga / Hari</th>
        <th>Status</th>
    </tr>

    @foreach($kendaraans as $k)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $k->nama }}</td>
        <td>{{ $k->brand }}</td>
        <td>{{ $k->tipe }}</td>
        <td>{{ $k->no_plat }}</td>
        <td>{{ $k->harga_per_hari }}</td>
        <td>{{ $k->status }}</td>
    </tr>
    @endforeach
</table>
