@extends('layout')

@section('title', 'Tambah Sparepart')

@section('extra-css')
<style>
    .form-container {
        max-width: 700px;
        margin: 30px auto;
        padding: 25px;
        background: #1e1e1e;
        border-radius: 12px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.6);
    }

    .form-container h1 {
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 5px;
        color: #ff4d4d;
    }

    .form-container p {
        color: #aaa;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 6px;
        color: #f1f1f1;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #333;
        background: #121212;
        color: #eee;
        font-size: 15px;
        transition: border 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border: 1px solid #ff4d4d;
    }

    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-secondary {
        background: #333;
        color: #fff;
    }
    .btn-secondary:hover {
        background: #444;
    }

    .btn-success {
        background: #ff4d4d;
        color: #fff;
    }
    .btn-success:hover {
        background: #e63939;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <h1>Tambah Data</h1>
    <p>Isi form di bawah untuk menambahkan data baru</p>

    <form action="/sparepart" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama_sparepart">Nama</label>
            <input type="text" name="nama_sparepart" id="nama_sparepart" required placeholder="Contoh: TDR5000">
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" required placeholder="Masukkan harga (Rp)">
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" required placeholder="Masukkan jumlah stok">
        </div>

        <div class="form-group">
            <label for="gambar">Upload Gambar</label>
            <input type="file" name="gambar" id="gambar" accept="image/*">
        </div>

        <div class="form-actions">
            <a href="/sparepart" class="btn btn-secondary">← Kembali</a>
            <button type="submit" class="btn btn-success">+ Simpan Sparepart</button>
        </div>
    </form>
</div>
@endsection
