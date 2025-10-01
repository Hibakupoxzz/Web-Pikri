<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #007bff; color: white; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px; cursor: pointer; border: none; }
        .btn-primary { background: #007bff; color: white; }
        .btn:hover { opacity: 0.8; }
        .empty-state { background: white; padding: 50px; text-align: center; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { width: 100%; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #007bff; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>Riwayat Transaksi</h1>
            <a href="/user" class="btn btn-primary">← Kembali</a>
        </div>
    </div>

    <div class="container">
        @if(count($data) > 0)
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
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $item->sparepart->nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="empty-state">
            <h2>Belum Ada Riwayat Transaksi</h2>
            <p>Anda belum melakukan transaksi apapun</p>
            <a href="/user" class="btn btn-primary">Mulai Belanja</a>
        </div>
        @endif
    </div>
</body>
</html>
