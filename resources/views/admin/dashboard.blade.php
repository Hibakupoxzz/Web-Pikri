@extends('layout')

@section('title', 'Admin Dashboard')

@section('extra-css')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-top: 30px;
    }

    .dashboard-card {
        background: #1e1e1e;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.4);
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(255, 0, 0, 0.25);
        border-color: #e63946;
    }

    .dashboard-card h3 {
        font-size: 18px;
        margin-bottom: 12px;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .dashboard-card p {
        color: #cbd5e0;
        margin-bottom: 18px;
        font-size: 14px;
        line-height: 1.6;
    }

    .icon {
        font-size: 28px;
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .welcome-text {
        flex: 1;
    }

    .welcome-text h1 {
        margin-bottom: 6px;
        font-size: 22px;
        color: #fff;
    }

    .welcome-text p {
        color: #a0aec0;
        font-size: 14px;
    }

    .btn {
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        font-size: 14px;
        display: inline-block;
    }

    .btn-primary {
        background: #e63946;
        color: white;
    }

    .btn-primary:hover {
        background: #ff4d5a;
    }

    .btn-success {
        background: #06d6a0;
        color: white;
    }

    .btn-success:hover {
        background: #05b389;
    }

    .btn-warning {
        background: #ffd166;
        color: #222;
    }

    .btn-warning:hover {
        background: #ffb347;
    }

    .btn-danger {
        background: #ef233c;
        color: white;
    }

    .btn-danger:hover {
        background: #ff4b5c;
    }

    .card {
        background: #121212;
        border-radius: 15px;
        border: 1px solid rgba(255,255,255,0.08);
    }

    .card-header {
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding: 20px;
    }

    .card-body {
        padding: 25px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="header-actions">
                <div class="welcome-text">
                    <h1>Dashboard Admin</h1>
                    <p>Selamat datang kembali, {{ Auth::user()->name }}!</p>
                </div>
                <a href="/logout" class="btn btn-danger">Logout</a>
            </div>
        </div>

        <div class="card-body">
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3><span class="icon">📦</span> Kelola Produk</h3>
                    <p>Sistem CRUD data produk. Kelola stok dan harga produk.</p>
                    <a href="/sparepart" class="btn btn-primary">Lihat Sparepart</a>
                </div>

                <div class="dashboard-card">
                    <h3><span class="icon">👥</span> Kelola User</h3>
                    <p>Manajemen data pengguna yang terdaftar di sistem.</p>
                    <a href="/users" class="btn btn-success">Lihat User</a>
                </div>

                <div class="dashboard-card">
                    <h3><span class="icon">📊</span> Statistik</h3>
                    <p>Lihat laporan penjualan dan aktivitas toko.</p>
                    <a href="#" class="btn btn-warning">Segera Hadir</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
