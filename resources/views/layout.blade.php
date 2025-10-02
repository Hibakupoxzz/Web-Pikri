<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Toko Sparepart Sepeda')</title>

    <style>
        /* Reset dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            background: #121212;
            color: #e0e0e0;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 105vh;
        }

        .container {
            padding: 20px;
        }

        .card {
            background: #1e1e1e;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.4);
        }

        .card-header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
            margin-bottom: 5px;
        }

        .card-header p {
            color: #aaa;
            margin-bottom: 20px;
        }

        /* Tombol */
        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-align: center;
            transition: 0.2s ease-in-out;
        }

        .btn-secondary { background: #3a3a3a; color: #fff; }
        .btn-secondary:hover { background: #555; }

        .btn-success { background: #4CAF50; color: #fff; }
        .btn-success:hover { background: #45a049; }

        .btn-warning { background: #ff9800; color: #fff; }
        .btn-warning:hover { background: #e68900; }

        .btn-danger { background: #f44336; color: #fff; }
        .btn-danger:hover { background: #d32f2f; }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #333;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #2c2c2c;
            color: #fff;
        }

        td {
            background: #1e1e1e;
        }

        .table-responsive {
            overflow-x: auto;
        }

        /* Badge stok */
        .badge {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
        }

        /* Gambar */
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.4);
        }

        /* Alert */
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #2e7d32;
            color: #fff;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 15px;
            margin-top: auto;
            font-size: 13px;
            color: #888;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        a:hover {
            opacity: 0.8;
        }
    </style>

    {{-- Tambahan CSS dari tiap halaman --}}
    @yield('extra-css')
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        © 2025 Hibakupoxz. All rights reserved.
    </footer>

</body>
</html>
