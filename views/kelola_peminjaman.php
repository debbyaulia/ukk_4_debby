<?php
session_start();
require_once "../config/Database.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$db = (new Database())->connect();

# =========================
# HAPUS DATA
# =========================
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $db->query("DELETE FROM peminjaman WHERE id_peminjaman=$id");
    header("Location: kelola_peminjaman.php");
    exit;
}

# =========================
# UPDATE DATA
# =========================
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $tgl_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $db->query("UPDATE peminjaman 
                SET tanggal_kembali='$tgl_kembali',
                    status='$status'
                WHERE id_peminjaman=$id");

    header("Location: kelola_peminjaman.php");
    exit;
}

# =========================
# AMBIL DATA
# =========================
$data = $db->query("SELECT * FROM peminjaman ORDER BY id_peminjaman DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Peminjaman</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg,#dbeafe,#eff6ff);
            margin: 0;
            padding: 30px;
        }

        h2 {
            color: #1e3a8a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        th {
            background: #2563eb;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f1f5ff;
        }

        .btn {
            padding: 5px 10px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            color: white;
        }

        .edit { background: #f59e0b; }
        .hapus { background: #ef4444; }

        .edit:hover { background: #d97706; }
        .hapus:hover { background: #dc2626; }

        .kembali {
            display: inline-block;
            margin-bottom: 15px;
            text-decoration: none;
            background: #2563eb;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
        }

        .kembali:hover {
            background: #1e40af;
        }
    </style>
</head>
<body>

<h2>📦 Kelola Peminjaman</h2>
<a href="admin_dashboard.php" class="kembali">← Kembali Dashboard</a>

<table>
    <tr>
        <th>ID</th>
        <th>ID User</th>
        <th>ID Buku</th>
        <th>Tgl Pinjam</th>
        <th>Jatuh Tempo</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while($row = $data->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id_peminjaman'] ?></td>
        <td><?= $row['id_user'] ?></td>
        <td><?= $row['id_buku'] ?></td>
        <td><?= $row['tanggal_pinjam'] ?></td>
        <td><?= $row['tanggal_jatuh_tempo'] ?></td>
        <td><?= $row['tanggal_kembali'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a class="btn edit" href="edit_peminjaman.php?id=<?= $row['id_peminjaman'] ?>">Edit</a>
            <a class="btn hapus" href="?hapus=<?= $row['id_peminjaman'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>