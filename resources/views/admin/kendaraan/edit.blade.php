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
            <label class="form-label">Nama Kendaraan</label>
            <input type="text" name="nama" class="form-control"
                   value="{{ old('nama', $kendaraan->nama) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control"
                   value="{{ old('brand', $kendaraan->brand) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Kendaraan</label>
            <select name="tipe" class="form-control" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="Matic" {{ old('tipe', $kendaraan->tipe) == 'Matic' ? 'selected' : '' }}>Matic</option>
                <option value="Manual" {{ old('tipe', $kendaraan->tipe) == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
            <small class="text-muted">Matic = Otomatis | Manual = Motor Kopling/Bebek</small>
        </div>

        <div class="mb-3">
            <label class="form-label">No Plat</label>
            <input type="text" name="no_plat" class="form-control"
                   value="{{ old('no_plat', $kendaraan->no_plat) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga per Hari</label>
            <input type="number" name="harga_per_hari" class="form-control"
                   value="{{ old('harga_per_hari', $kendaraan->harga_per_hari) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Kendaraan</label><br>

            @if ($kendaraan->gambar)
                <img src="{{ asset('uploads/kendaraan/' . $kendaraan->gambar) }}" width="120" class="mb-2"><br>
            @endif

            <input type="file" name="gambar" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
        </div>

        <button class="btn btn-primary">
            <i class="bi bi-save"></i> Update
        </button>
        <a href="{{ route('admin.kendaraan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </form>
</div>
@endsection
