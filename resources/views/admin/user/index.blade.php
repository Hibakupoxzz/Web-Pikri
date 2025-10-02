@extends('layout')

@section('title', 'Data User')

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

    .header {
        background: #1e1e1e;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.4);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .header h1 {
        color: #ff4d4d;
        margin: 0;
        font-size: 24px;
    }

    .btn {
        display: inline-block;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: bold;
    }

    .btn-danger {
        background: #333;
        color: #ff4d4d;
        border: 1px solid #ff4d4d;
    }

    .btn:hover {
        opacity: 0.85;
        transform: translateY(-2px);
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

    table {
        width: 100%;
        border-collapse: collapse;
        background: #1c1c1c;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.5);
    }

    th, td {
        padding: 14px 16px;
        text-align: left;
    }

    th {
        background: #ff4d4d;
        color: #fff;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 1px;
    }

    tr:nth-child(even) {
        background: #2a2a2a;
    }

    tr:hover {
        background: #333;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: bold;
    }

    .badge-admin {
        background: #ff4d4d;
        color: white;
    }

    .badge-user {
        background: #28d17c;
        color: white;
    }

    td {
        color: #ddd;
    }
</style>
@endsection

<div class="navbar">
    <div class="brand">BASIKAL TDR3000</div>
    <ul>
        <li><a href="{{ url('/admin') }}">Dashboard</a></li>
        <li><a href="{{ url('/sparepart') }}">Sparepart</a></li>
        <li><a href="{{ url('/users') }}">Pengunjung</a></li>
        <li><a href="{{ url('#') }}">Transaksi</a></li>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </ul>
</div>


@section('content')
<div class="container">
    <div class="header">
        <h1>Data User</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Terdaftar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role == 'admin')
                        <span class="badge badge-admin">Admin</span>
                    @else
                        <span class="badge badge-user">User</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px;">Belum ada data user</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
