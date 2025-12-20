@extends('layouts.admin')

@section('content')
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
        <th>Gambar</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($kendaraans as $k)
    <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $k->nama }}</td>
    <td>{{ $k->brand }}</td>
    <td>{{ $k->tipe }}</td>
    <td>{{ $k->no_plat }}</td>
    <td>{{ $k->harga_per_hari }}</td>

    <td style="text-align:center">
        @if ($k->gambar)
            <img 
                src="{{ asset('uploads/kendaraan/' . $k->gambar) }}" 
                width="80"
                style="object-fit:cover; border-radius:6px;"
            >
        @else
            -
        @endif
    </td>


    <td>{{ $k->status }}</td>

    <td>
        <a href="{{ route('admin.kendaraan.edit', $k->id) }}">Edit</a>

        <form action="{{ route('admin.kendaraan.destroy', $k->id) }}"
              method="POST"
              style="display:inline;">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Yakin mau hapus?')">
                Hapus
            </button>
        </form>
    </td>
</tr>


    @endforeach
</table>
@endsection
