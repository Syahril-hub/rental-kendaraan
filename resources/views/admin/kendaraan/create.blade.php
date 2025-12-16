<h1>Tambah Kendaraan</h1>

@if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ url('/admin/kendaraan') }}" method="POST">
    @csrf

    <label>Nama Kendaraan</label><br>
    <input type="text" name="nama"><br><br>

    <label>Brand</label><br>
    <input type="text" name="brand"><br><br>

    <label>Tipe</label><br>
    <input type="text" name="tipe"><br><br>

    <label>No Plat</label><br>
    <input type="text" name="no_plat"><br><br>

    <label>Harga per Hari</label><br>
    <input type="number" name="harga_per_hari"><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="{{ url('/admin/kendaraan') }}">← Kembali</a>
