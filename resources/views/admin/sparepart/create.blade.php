<!DOCTYPE html>
<html>
<head>
    <title>Tambah Sparepart</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 800px; margin: 50px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #555; }
        input, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; }
        textarea { resize: vertical; min-height: 100px; }
        .btn { display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin: 5px; cursor: pointer; border: none; }
        .btn-primary { background: #007bff; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn:hover { opacity: 0.8; }
        .error { color: red; font-size: 12px; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Sparepart Baru</h1>

        <form action="/sparepart" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Sparepart</label>
                <input type="text" name="nama_sparepart" value="{{ old('nama_sparepart') }}" required>
                @error('nama_sparepart')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" value="{{ old('harga') }}" required>
                @error('harga')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" value="{{ old('stok') }}" required>
                @error('stok')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar" accept="image/*">
                @error('gambar')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/sparepart" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>
</html>
