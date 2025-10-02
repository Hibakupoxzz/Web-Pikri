@extends('layout')

@section('title', 'Katalog Sparepart')

@section('extra-css')
<style>
    body {
        background: #121212;
        color: #e5e5e5;
        font-family: Arial, sans-serif;
    }

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

    .container {
        padding: 20px;
    }

    .btn {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-danger {
        background: #333;
        color: #ff4d4d;
        border: 1px solid #ff4d4d;
    }

    .btn-success {
        background: #28d17c;
        color: #fff;
    }

    .btn-warning {
        background: #ffc107;
        color: #222;
    }

    .btn-info {
        background: #007bff;
        color: #fff;
    }

    .btn:hover {
        opacity: 0.85;
        transform: translateY(-2px);
    }

    .cart-badge {
        background: #ff4d4d;
        color: white;
        border-radius: 50%;
        padding: 3px 8px;
        font-size: 12px;
        margin-left: 5px;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .product-card {
        background: #1c1c1c;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.6);
    }

    .product-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .product-info {
        padding: 15px;
    }

    .product-name {
        font-size: 18px;
        font-weight: bold;
        color: #ff4d4d;
        margin-bottom: 8px;
    }

    .product-desc {
        color: #aaa;
        font-size: 13px;
        margin-bottom: 8px;
        min-height: 36px;
    }

    .product-price {
        color: #28d17c;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .product-stock {
        color: #ccc;
        font-size: 13px;
        margin-bottom: 12px;
    }

    .out-of-stock {
        color: #ff4d4d;
        font-weight: bold;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        font-weight: bold;
    }

    .alert-success {
        background: #1b3a28;
        color: #28d17c;
        border: 1px solid #28d17c;
    }

    .alert-error {
        background: #3a1b1b;
        color: #ff4d4d;
        border: 1px solid #ff4d4d;
    }

    .empty-state {
        text-align: center;
        padding: 50px;
        background: #1c1c1c;
        border-radius: 12px;
        color: #aaa;
    }
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
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
    @endif

    @if($spareparts->count() > 0)
    <div class="products-grid">
        @foreach($spareparts as $item)
        <div class="product-card">
            @if($item->gambar)
                <img src="{{ asset('uploads/spareparts/' . $item->gambar) }}" alt="{{ $item->nama_sparepart }}" class="product-image">
            @else
                <img src="https://via.placeholder.com/250x200?text=No+Image" alt="No Image" class="product-image">
            @endif

            <div class="product-info">
                <div class="product-name">{{ $item->nama_sparepart }}</div>

                @if($item->deskripsi)
                <div class="product-desc">{{ Str::limit($item->deskripsi, 80) }}</div>
                @endif

                <div class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>

                <div class="product-stock {{ $item->stok == 0 ? 'out-of-stock' : '' }}">
                    Stok: {{ $item->stok }}
                </div>

                @if($item->stok > 0)
                <form action="{{ route('cart.add', $item->id) }}" method="POST" style="margin-bottom: 5px;">
                    @csrf
                    <button type="submit" class="btn btn-warning" style="width:100%">🛒 Tambah ke Keranjang</button>
                </form>
                <form action="{{ route('beli', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success" style="width:100%">Beli Sekarang</button>
                </form>
                @else
                <button class="btn btn-danger" style="width:100%" disabled>Stok Habis</button>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <h2>Belum Ada Produk</h2>
        <p>Maaf, saat ini belum ada produk yang tersedia.</p>
    </div>
    @endif
</div>
@endsection
