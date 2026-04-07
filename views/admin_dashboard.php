<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Perpustakaan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #dbeafe, #eff6ff);
        }

        .navbar {
            background: #2563eb;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .navbar h2 {
            margin: 0;
        }

        .logout-btn {
            background: white;
            color: #2563eb;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #e0f2fe;
        }

        .container {
            padding: 40px;
        }

        .welcome {
            font-size: 22px;
            margin-bottom: 30px;
            color: #1e3a8a;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            transition: 0.3s;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin: 10px 0;
            color: #2563eb;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background: #2563eb;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .card a:hover {
            background: #1e40af;
        }
    </style>
</head>
<body>

<div class="navbar">
    <h2>📚 Admin Perpustakaan</h2>
    <a href="../controllers/AuthControllers.php?logout=true" class="logout-btn">Logout</a>
</div>

<div class="container">
    <div class="welcome">
        Selamat datang, <b><?= $_SESSION['user']['nama']; ?></b> 👋
    </div>

    <div class="cards">
        <div class="card">
            <h3>📖 Kelola Buku</h3>
            <p>Tambah, edit, dan hapus data buku perpustakaan.</p>
            <a href="kelola_buku.php">Masuk</a>
        </div>

        <div class="card">
            <h3>👥 Kelola Anggota</h3>
            <p>Atur data anggota dan siswa.</p>
            <a href="kelola_anggota.php">Masuk</a>
        </div>

        <div class="card">
            <h3>📦 Peminjaman</h3>
            <p>Kelola transaksi peminjaman dan pengembalian buku.</p>
            <a href="kelola_peminjaman.php">Masuk</a>
        </div>
    </div>
</div>

</body>
</html>