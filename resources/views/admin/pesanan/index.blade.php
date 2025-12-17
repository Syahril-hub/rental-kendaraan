<h1>Data Pesanan</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="GET" action="{{ route('admin.pesanan.index') }}">
    <label>Status:</label>

    <select name="status">
        <option value="">-- Semua --</option>
        <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
        <option value="dibayar" {{ request('status')=='dibayar' ? 'selected' : '' }}>Dibayar</option>
        <option value="selesai" {{ request('status')=='selesai' ? 'selected' : '' }}>Selesai</option>
        <option value="expired" {{ request('status')=='expired' ? 'selected' : '' }}>Expired</option>
    </select>

    <button type="submit">Filter</button>
</form>

<hr>


<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>User</th>
        <th>Kendaraan</th>
        <th>Tanggal</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($pesanans as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->kendaraan->nama }}</td>
        <td>
            {{ $p->tanggal_mulai }} - {{ $p->tanggal_selesai }}
        </td>
        <td>{{ $p->total_harga }}</td>
        <td>{{ $p->status }}</td>
        <td>
            <a href="{{ route('admin.pesanan.show', $p->id) }}">
                Detail
            </a>
        </td>
    </tr>
    @endforeach
</table>
