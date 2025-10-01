<!DOCTYPE html>
<html>
<head>
    <title>Katalog Sparepart</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #007bff; color: white; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px; cursor: pointer; border: none; font-size: 14px; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-success { background: #28a745; color: white; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-info { background: #17a2b8; color: white; }
        .btn:hover { opacity: 0.8; }
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 20px; }
        .product-card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .product-image { width: 100%; height: 200px; object-fit: cover; }
        .product-info { padding: 15px; }
        .product-name { font-size: 18px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .product-desc { color: #666; font-size: 14px; margin-bottom: 10px; }
        .product-price { color: #007bff; font-size: 20px; font-weight: bold; margin-bottom: 10px; }
        .product-stock { color: #28a745; font-size: 14px; margin-bottom: 15px; }
        .out-of-stock { color: #dc3545; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .empty-state { text-align: center; padding: 50px; background: white; border-radius: 8px; }
        .cart-badge { background: #dc3545; color: white; border-radius: 50%; padding: 2px 8px; font-size: 12px; margin-left: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div>
                <h1>Katalog Sparepart Sepeda</h1>
                <p>Selamat datang, {{ Auth::user()->name }}</p>
            </div>
            <div>
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
            </div>
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
            <p>Maaf, saat ini belum ada sparepart yang tersedia.</p>
        </div>
        @endif
    </div>
</body>
</html>
