@extends('layout')

@section('title', 'Keranjang Belanja')

@section('extra-css')
<style>
    body { background: #121212; color: #e5e5e5; }

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

    .btn-info {
    background: #007bff;
    color: #fff;
    }

    .btn-danger {
    background: #333;
    color: #ff4d4d;
    border: 1px solid #ff4d4d;
    }

    .cart-container {
        background: #1e1e1e;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.6);
    }

    .cart-header {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #ff4d4d;
    }

    .cart-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid #333;
        transition: background 0.2s;
    }
    .cart-item:hover { background: rgba(255,255,255,0.03); }

    .cart-image {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 20px;
    }

    .cart-info { flex: 1; }
    .cart-name {
        font-size: 18px;
        font-weight: bold;
        color: #fff;
        margin-bottom: 6px;
    }
    .cart-price {
        color: #28d17c;
        font-size: 16px;
        margin-bottom: 8px;
    }
    .cart-stock {
        font-size: 13px;
        color: #aaa;
    }

    .cart-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: 20px;
    }
    .qty-input {
        width: 60px;
        padding: 6px;
        border: 1px solid #444;
        border-radius: 6px;
        background: #222;
        color: #fff;
        text-align: center;
    }

    .subtotal {
        font-weight: bold;
        font-size: 16px;
        color: #ffb347;
        margin-left: 20px;
    }

    .total-section {
        background: #1c1c1c;
        padding: 25px;
        margin-top: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.5);
    }
    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
        margin-bottom: 20px;
    }

    .empty-cart {
        text-align: center;
        padding: 60px;
        background: #1e1e1e;
        border-radius: 12px;
        color: #aaa;
    }
</style>
@endsection

<div class="navbar">
    <div class="brand">BASIKAL TDR3000</div>
        <ul>
            <a href="/cart" class="btn btn-info">
                🛒 Keranjang
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
<div class="cart-container">
    <div class="cart-header">🛒 Keranjang Belanja</div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    @if($carts->count() > 0)
        @foreach($carts as $cart)
        <div class="cart-item">
            @if($cart->sparepart->gambar)
                <img src="{{ asset('uploads/spareparts/' . $cart->sparepart->gambar) }}" alt="{{ $cart->sparepart->nama_sparepart }}" class="cart-image">
            @else
                <img src="https://via.placeholder.com/100" alt="No Image" class="cart-image">
            @endif

            <div class="cart-info">
                <div class="cart-name">{{ $cart->sparepart->nama_sparepart }}</div>
                <div class="cart-price">Rp {{ number_format($cart->sparepart->harga, 0, ',', '.') }}</div>
                <div class="cart-stock">Stok tersedia: {{ $cart->sparepart->stok }}</div>
            </div>

            <div class="cart-actions">
                <form action="{{ route('cart.update', $cart->id) }}" method="POST" style="display: flex; align-items: center; gap: 8px;">
                    @csrf
                    <input type="number" name="jumlah" value="{{ $cart->jumlah }}" min="1" max="{{ $cart->sparepart->stok }}" class="qty-input">
                    <button type="submit" class="btn btn-warning">Update</button>
                </form>

                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus dari keranjang?')">Hapus</button>
                </form>
            </div>

            <div class="subtotal">
                Subtotal: Rp {{ number_format($cart->sparepart->harga * $cart->jumlah, 0, ',', '.') }}
            </div>
        </div>
        @endforeach

        <div class="total-section">
            <div class="total-row">
                <span>Total Pembayaran:</span>
                <span style="color:#28d17c;">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" style="width:100%; padding:15px; font-size:18px;" onclick="return confirm('Lanjutkan checkout?')">
                    ✅ Checkout Sekarang
                </button>
            </form>
        </div>
    @else
        <div class="empty-cart">
            <h2>Keranjang Kosong</h2>
            <p>Belum ada item di keranjang Anda</p>
            <a style="color: #ff4d4d" href="/user" class="btn btn-primary">Mulai Belanja</a>
        </div>
    @endif
</div>
@endsection
