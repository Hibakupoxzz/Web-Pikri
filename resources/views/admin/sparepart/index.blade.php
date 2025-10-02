@extends('layout')

@section('title', 'Data Sparepart')

@section('extra-css')
<style>
/* Navbar */
.navbar {
    background: linear-gradient(to right, #2a2a2a, #1c1c1c);
    padding: 20px 40px;
    box-shadow: 0 3px 6px rgba(0,0,0,0.6);
    margin: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar .brand {
    font-size: 20px;
    font-weight: 700;
    color: #ff6f61;
}

.navbar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
}
.navbar ul li {
    padding-top: 10px;
}
.navbar ul li a {
    color: #f5f5f5;
    text-decoration: none;
    font-weight: 600;
    transition: 0.3s;
}

.navbar ul li a:hover {
    color: #ff6f61;
}

.header-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 50px;
    margin-bottom: 30px;
}

.product-image {
    width: 90px;
    height: 90px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.4);
}

.table-responsive {
    overflow-x: auto;
    margin-top: 20px;
    border-radius: 10px;
    overflow: hidden;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 14px;
    overflow: hidden;
    background: #1e1e1e;
}

thead {
    background: linear-gradient(90deg, #ff4e50, #1f1f1f);
}

thead th {
    color: #fff;
    text-align: left;
    padding: 20px;
    font-size: 18px;
    font-weight: 600;
}

tbody td {
    padding: 18px;
    font-size: 16px;
    border-bottom: 1px solid #2a2a2a;
    color: #f1f1f1;
}

tbody tr:nth-child(even) {
    background: #242424;
}

.badge {
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    display: inline-block;
}

.action-buttons {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn {
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-secondary {
    background: #2d2d2d;
    color: #ddd;
}

.btn-secondary:hover {
    background: #3c3c3c;
}

.btn-success {
    background: linear-gradient(135deg, #ff6a6a, #ff4040);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(135deg, #ff4040, #e63636);
}

.btn-warning {
    background: #f6ad55;
    color: #1a1a1a;
}

.btn-warning:hover {
    background: #dd6b20;
    color: #fff;
}

.btn-danger {
    background: #e53e3e;
    color: white;
}

.btn-danger {
    background: #333;
    color: #ff4d4d;
    border: 1px solid #ff4d4d;
}

.alert-success {
    background: #2f855a;
    color: #e6fffa;
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 25px;
    font-size: 15px;
}

.empty-state {
    text-align: center;
    padding: 50px;
    color: #aaa;
}

.empty-state h2 {
    font-size: 20px;
    margin-bottom: 10px;
}

.card {
    background: #121212;
    border-radius: 18px;
    box-shadow: 0 6px 22px rgba(0,0,0,0.7);
    padding: 60px;
}

.card-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #ff4e50;
}

.card-header p {
    font-size: 16px;
    color: #bbb;
    margin-top: 6px;
}

.card-body {
    padding: 40px 20px;
}
</style>
@endsection

<!-- Navbar -->
<div class="navbar">
    <div class="brand">BASIKAL TDR3000</div>
    <ul>
        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
        <li><a href="{{ url('/sparepart') }}">Produk</a></li>
        <li><a href="{{ url('/users') }}">Pengunjung</a></li>
        <li><a href="{{ url('#') }}">Transaksi</a></li>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </ul>
</div>

@section('content')
    <div class="header-actions">
        <div>
            <a href="/admin" class="btn btn-secondary">← Dashboard</a>
            <a href="/sparepart/create" class="btn btn-success">+ Tambah Data</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($spareparts as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('uploads/spareparts/' . $item->gambar) }}" alt="{{ $item->nama_sparepart }}" class="product-image">
                        @else
                            <img src="https://via.placeholder.com/90" alt="No Image" class="product-image">
                        @endif
                    </td>
                    <td><strong>{{ $item->nama_sparepart }}</strong></td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge" style="background: {{ $item->stok > 10 ? '#68d391' : '#e53e3e' }}; color: white;">
                            {{ $item->stok }} unit
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="/sparepart/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/sparepart/{{ $item->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty-state">
                        <h2>Belum ada data</h2>
                        <p>Klik tombol "Tambah Data" untuk menambah data</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

