<h1>Detail Pesanan</h1>

<p><b>User:</b> {{ $pesanan->user->name }}</p>
<p><b>Email:</b> {{ $pesanan->user->email }}</p>

<p><b>Kendaraan:</b> {{ $pesanan->kendaraan->nama }}</p>
<p><b>No Plat:</b> {{ $pesanan->kendaraan->no_plat }}</p>

<p><b>Tanggal:</b>
    {{ $pesanan->tanggal_mulai }} s/d {{ $pesanan->tanggal_selesai }}
</p>

<p><b>Total Harga:</b> Rp {{ number_format($pesanan->total_harga) }}</p>

<hr>

<form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Status</label>
    <select name="status">
        <option value="pending"  {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="dibayar"  {{ $pesanan->status == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
        <option value="selesai"  {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="expired"  {{ $pesanan->status == 'expired' ? 'selected' : '' }}>Expired</option>
    </select>

    <button type="submit">Update Status</button>
</form>


<br>
<a href="{{ route('admin.pesanan.index') }}">← Kembali</a>
