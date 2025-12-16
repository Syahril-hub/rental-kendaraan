@extends('layouts.admin')

@section('content')
<div class="container">
    <h3>Edit Kendaraan</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kendaraan.update', $kendaraan->id) }}" 
      method="POST" 
      enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kendaraan</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $kendaraan->nama) }}">
        </div>

        <div class="mb-3">
            <label>Brand</label>
            <input type="text" name="brand" class="form-control"
                   value="{{ old('brand', $kendaraan->brand) }}">
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <input type="text" name="tipe" class="form-control"
                   value="{{ old('tipe', $kendaraan->tipe) }}">
        </div>

        <div class="mb-3">
            <label>No Plat</label>
            <input type="text" name="no_plat" class="form-control"
                   value="{{ old('no_plat', $kendaraan->no_plat) }}">
        </div>

        <div class="mb-3">
            <label>Harga per Hari</label>
            <input type="number" name="harga_per_hari" class="form-control"
                   value="{{ old('harga_per_hari', $kendaraan->harga_per_hari) }}">
        </div>

        <div class="mb-3">
            <label>Gambar Kendaraan</label><br>

            @if ($kendaraan->gambar)
                <img src="{{ asset('uploads/kendaraan/' . $kendaraan->gambar) }}" width="120"><br><br>
            @endif

            <input type="file" name="gambar">
        </div>


        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
