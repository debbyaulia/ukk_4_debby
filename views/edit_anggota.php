<?php
require_once "../config/Database.php";
$db = (new Database())->connect();

if (!isset($_GET['id'])) {
    header("Location: kelola_anggota.php");
    exit;
}

$id = intval($_GET['id']);
$data = $db->query("SELECT * FROM users WHERE id_user=$id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Anggota - Perpustakaan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #e3f2fd, #f0f8ff);
        }

        .container {
            width: 420px;
            margin: 60px auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #1565c0;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 18px 0;
            border-radius: 8px;
            border: 1px solid #bbdefb;
            outline: none;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 6px rgba(30,136,229,0.4);
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1e88e5;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1565c0;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 18px;
            text-decoration: none;
            color: #1565c0;
            font-weight: 600;
        }

        .back:hover {
            text-decoration: underline;
        }

        .icon {
            text-align: center;
            font-size: 40px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="icon">📚</div>
    <h2>Edit Data Anggota</h2>

    <form method="POST" action="kelola_anggota.php">
        <input type="hidden" name="id" value="<?= $data['id_user'] ?>">

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= $data['email'] ?>" required>

        <label>Role</label>
        <select name="role">
            <option value="siswa" <?= $data['role']=='siswa'?'selected':'' ?>>Siswa</option>
            <option value="admin" <?= $data['role']=='admin'?'selected':'' ?>>Admin</option>
        </select>

        <button type="submit" name="update">Update Data</button>
    </form>

    <a href="kelola_anggota.php" class="back">← Kembali ke Kelola Anggota</a>
</div>

</body>
</html>