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
background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1920' height='800' preserveAspectRatio='none' viewBox='0 0 1920 800'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1035%26quot%3b)' fill='none'%3e%3crect width='1920' height='800' x='0' y='0' fill='rgba(30%2c 30%2c 30%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c430.051C80.582%2c433.691%2c149.64%2c381.593%2c220.687%2c343.396C297.759%2c301.96%2c401.424%2c279.316%2c432.512%2c197.521C463.727%2c115.392%2c399.237%2c29.956%2c371.506%2c-53.414C348.753%2c-121.82%2c321.198%2c-184.537%2c284.743%2c-246.731C240.155%2c-322.801%2c216.299%2c-425.092%2c134.44%2c-457.862C52.583%2c-490.631%2c-35.918%2c-435.231%2c-120.025%2c-408.768C-202.468%2c-382.829%2c-290.923%2c-366.18%2c-351.832%2c-304.864C-414.696%2c-241.58%2c-450.104%2c-154.798%2c-460.335%2c-66.186C-470.404%2c21.02%2c-456.211%2c112.854%2c-408.574%2c186.589C-363.72%2c256.016%2c-279.243%2c281.713%2c-208.237%2c324.024C-139.941%2c364.72%2c-79.421%2c426.464%2c0%2c430.051' fill='%23181818'%3e%3c/path%3e%3cpath d='M1920 1732.886C2092.061 1731.8809999999999 2198.857 1546.775 2324.098 1428.789 2427.456 1331.4189999999999 2510.351 1224.154 2586.942 1104.5819999999999 2676.112 965.3720000000001 2803.642 837.465 2808.709 672.223 2814.051 497.99 2739.575 319.669 2614.74 198.005 2493.3959999999997 79.74300000000005 2308.146 79.30700000000002 2146.906 27.230000000000018 1980.352-26.562999999999988 1822.669-151.46400000000006 1651.931-112.96000000000004 1479.4470000000001-74.06299999999999 1358.4679999999998 81.09500000000003 1259.205 227.418 1167.591 362.465 1102.7640000000001 520.7909999999999 1111.454 683.749 1119.458 833.833 1233.788 948.484 1304.725 1080.987 1370.4650000000001 1203.783 1417.253 1332.233 1512.857 1433.527 1630.8690000000001 1558.5639999999999 1748.07 1733.8899999999999 1920 1732.886' fill='%23242424'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1035'%3e%3crect width='1920' height='800' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
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
