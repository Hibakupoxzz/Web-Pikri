<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .header { background: white; padding: 30px; border-radius: 8px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { color: #333; margin-bottom: 10px; }
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .menu-card { background: white; padding: 30px; border-radius: 8px; text-align: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); transition: transform 0.2s; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .menu-card h2 { color: #007bff; margin-bottom: 15px; }
        .btn { display: inline-block; padding: 12px 30px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin-top: 10px; }
        .btn:hover { background: #0056b3; }
        .btn-danger { background: #dc3545; }
        .btn-danger:hover { background: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Dashboard Admin</h1>
            <p>Selamat datang, {{ Auth::user()->name }}</p>
            <a href="/logout" class="btn btn-danger">Logout</a>
        </div>

        <div class="menu-grid">
            <div class="menu-card">
                <h2>📦 Kelola Sparepart</h2>
                <p>Tambah, edit, hapus data sparepart</p>
                <a href="/sparepart" class="btn">Lihat Sparepart</a>
            </div>

            <div class="menu-card">
                <h2>👥 Kelola User</h2>
                <p>Manajemen data pengguna</p>
                <a href="/users" class="btn">Lihat User</a>
            </div>
        </div>
    </div>
</body>
</html>
