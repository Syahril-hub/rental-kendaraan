@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Kendaraan</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/admin/kendaraan') }}" 
        method="POST"  
        enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kendaraan</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ old('brand') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Kendaraan</label>
            <select name="tipe" class="form-control" required>
                <option value="">-- Pilih Tipe --</option>
                <option value="Matic" {{ old('tipe') == 'Matic' ? 'selected' : '' }}>Matic</option>
                <option value="Manual" {{ old('tipe') == 'Manual' ? 'selected' : '' }}>Manual</option>
            </select>
            <small class="text-muted">Matic = Otomatis | Manual = Motor Kopling/Bebek</small>
        </div>

        <div class="mb-3">
            <label class="form-label">No Plat</label>
            <input type="text" name="no_plat" class="form-control" value="{{ old('no_plat') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga per Hari</label>
            <input type="number" name="harga_per_hari" class="form-control" value="{{ old('harga_per_hari') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Kendaraan</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Simpan
        </button>
        <a href="{{ url('/admin/kendaraan') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </form>
</div>
@endsection
