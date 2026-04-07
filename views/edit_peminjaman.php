<?php
require_once "../config/Database.php";
$db = (new Database())->connect();

$id = intval($_GET['id']);
$data = $db->query("SELECT * FROM peminjaman WHERE id_peminjaman=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Peminjaman</title>
    <style>
        body {
            font-family: 'Segoe UI';
            background: #eff6ff;
            padding: 40px;
        }

        .box {
            width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h3 {
            text-align: center;
            color: #2563eb;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin: 10px 0 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
        }

        button:hover {
            background: #1e40af;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="box">
    <h3>Edit Peminjaman</h3>

    <form method="POST" action="kelola_peminjaman.php">
        <input type="hidden" name="id" value="<?= $data['id_peminjaman'] ?>">

        <label>Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali'] ?>">

        <label>Status</label>
        <select name="status">
            <option value="dipinjam" <?= $data['status']=='dipinjam'?'selected':'' ?>>Dipinjam</option>
            <option value="dikembalikan" <?= $data['status']=='dikembalikan'?'selected':'' ?>>Dikembalikan</option>
        </select>

        <button type="submit" name="update">Update</button>
    </form>

    <a href="kelola_peminjaman.php">← Kembali</a>
</div>

</body>
</html>