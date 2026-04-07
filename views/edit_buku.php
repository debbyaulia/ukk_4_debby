<?php
session_start();
require_once "../config/Database.php";

$db = (new Database())->connect();

$id = $_GET['id'];
$data = $db->query("SELECT * FROM data_buku WHERE id_buku=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg,#dbeafe,#eff6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 35px;
            width: 420px;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1e3a8a;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 5px rgba(37,99,235,0.4);
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #1e40af;
        }

        .kembali {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #2563eb;
            font-size: 14px;
        }

        .kembali:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>📖 Edit Data Buku</h2>

    <form method="POST" action="kelola_buku.php">
        <input type="hidden" name="id" value="<?= $data['id_buku'] ?>">

        <label>Judul Buku</label>
        <input type="text" name="judul" value="<?= $data['judul'] ?>" required>

        <label>Pengarang</label>
        <input type="text" name="pengarang" value="<?= $data['pengarang'] ?>" required>

        <label>Penerbit</label>
        <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" required>

        <label>Tahun Terbit</label>
        <input type="number" name="tahun" value="<?= $data['tahun'] ?>" required>

        <label>Stok Buku</label>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

        <button type="submit" name="update" class="btn">Update Buku</button>
    </form>

    <a href="kelola_buku.php" class="kembali">← Kembali ke Kelola Buku</a>
</div>

</body>
</html>