@extends('layout')

@section('title', 'Riwayat Transaksi')

@section('extra-css')
<style>
body { background: #121212; color: #e5e5e5; }
.header { background: #1e1e1e; padding: 20px; border-radius: 10px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; }
.header h1 { color: #ff4d4d; font-size: 22px; }

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

table { width: 100%; background: #1e1e1e; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.5);}
th, td { padding: 14px; text-align: left; border-bottom: 1px solid #333; }
th { background: #ff4d4d; color: #fff; }
td { color: #ddd; font-size: 14px; }
tr:hover { background: rgba(255,255,255,0.03); }

.total-box { margin-top: 20px; padding: 15px; background: #1e1e1e; border-radius: 10px; font-weight: bold; color: #28d17c; }
.empty-state { text-align: center; padding: 60px; background: #1e1e1e; border-radius: 12px; color: #aaa; box-shadow: 0 4px 12px rgba(0,0,0,0.5); }
</style>
@endsection

<div class="navbar">
<div class="brand">BASIKAL TDR3000</div>
    <ul>
        <a href="/cart" class="btn btn-info">
            Keranjang
            @if(Auth::check())
                @php
                    $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                @endphp
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            @endif
        </a>
        <a href="/riwayat" class="btn btn-success">Riwayat Transaksi</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </ul>
</div>
</div>
@section('content')
<div class="container">
    <div class="header">
        <h1>Riwayat Transaksi</h1>
    </div>

    @if($data->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Sparepart</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}</td>
                        <td>{{ $item->sparepart ? $item->sparepart->nama_sparepart : 'Sparepart tidak tersedia' }}</td>
                        <td>{{ $item->jumlah ?? '-' }}</td>
                        <td style="color:#28d17c;">Rp {{ $item->total ? number_format($item->total, 0, ',', '.') : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-box">
            Total Belanja: Rp {{ number_format($data->sum('total'), 0, ',', '.') }}
        </div>
    @else
        <div class="empty-state">
            <h2>Belum Ada Riwayat Transaksi</h2>
            <p>Anda belum melakukan transaksi apapun</p>
            <a href="/user" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
