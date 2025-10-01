<!DOCTYPE html>
<html>
<head>
    <title>Keranjang Belanja</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #007bff; color: white; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px; cursor: pointer; border: none; }
        .btn-primary { background: #007bff; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn:hover { opacity: 0.8; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .cart-container { background: white; border-radius: 8px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .cart-item { display: flex; align-items: center; padding: 20px; border-bottom: 1px solid #ddd; }
        .cart-item:last-child { border-bottom: none; }
        .cart-image { width: 100px; height: 100px; object-fit: cover; border-radius: 8px; margin-right: 20px; }
        .cart-info { flex: 1; }
        .cart-name { font-size: 18px; font-weight: bold; color: #333; margin-bottom: 5px; }
        .cart-price { color: #007bff; font-size: 16px; margin-bottom: 10px; }
        .cart-actions { display: flex; align-items: center; gap: 10px; }
        .qty-input { width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 5px; text-align: center; }
        .empty-cart { text-align: center; padding: 50px; }
        .total-section { background: #f8f9fa; padding: 20px; margin-top: 20px; border-radius: 8px; }
        .total-row { display: flex; justify-content: space-between; font-size: 24px; font-weight: bold; color: #333; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>🛒 Keranjang Belanja</h1>
            <a href="/user" class="btn btn-primary">← Kembali Belanja</a>
        </div>
    </div>

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

        <div class="cart-container">
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
                        <div style="color: #666; font-size: 14px;">Stok tersedia: {{ $cart->sparepart->stok }}</div>
                    </div>

                    <div class="cart-actions">
                        <form action="{{ route('cart.update', $cart->id) }}" method="POST" style="display: flex; align-items: center; gap: 10px;">
                            @csrf
                            <label>Jumlah:</label>
                            <input type="number" name="jumlah" value="{{ $cart->jumlah }}" min="1" max="{{ $cart->sparepart->stok }}" class="qty-input">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </form>

                        <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus dari keranjang?')">Hapus</button>
                        </form>
                    </div>

                    <div style="margin-left: 20px;">
                        <div style="font-weight: bold; color: #333;">Subtotal:</div>
                        <div style="font-size: 18px; color: #007bff;">
                            Rp {{ number_format($cart->sparepart->harga * $cart->jumlah, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="total-section">
                    <div class="total-row">
                        <span>Total Pembayaran:</span>
                        <span style="color: #007bff;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <form action="{{ route('cart.checkout') }}" method="POST" style="margin-top: 20px;">
                        @csrf
                        <button type="submit" class="btn btn-success" style="width: 100%; padding: 15px; font-size: 18px;" onclick="return confirm('Lanjutkan checkout?')">
                            Checkout Sekarang
                        </button>
                    </form>
                </div>
            @else
                <div class="empty-cart">
                    <h2>Keranjang Kosong</h2>
                    <p>Belum ada item di keranjang Anda</p>
                    <a href="/user" class="btn btn-primary">Mulai Belanja</a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
