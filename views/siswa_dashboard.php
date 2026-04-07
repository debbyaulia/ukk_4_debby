<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
    header("Location: login.php");
    exit;
}

require_once '../config/Database.php';

$db = new Database();
$conn = $db->connect();

$id_user = $_SESSION['user']['id_user'];

// Ambil keyword search
$keyword = isset($_GET['search']) ? $_GET['search'] : '';

// Query dengan fitur search
$query = "
SELECT data_buku.*, peminjaman.id_peminjaman, peminjaman.status
FROM data_buku
LEFT JOIN peminjaman 
    ON data_buku.id_buku = peminjaman.id_buku 
    AND peminjaman.id_user = '$id_user'
    AND peminjaman.status = 'dipinjam'
WHERE data_buku.judul LIKE '%$keyword%'
";

$result = $conn->query($query);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Siswa</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #d6ecff, #f0f9ff);
        }

        .header {
            background: #5dade2;
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logout {
            background: white;
            color: #3498db;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .container {
            padding: 30px;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .search-box input {
            padding: 8px;
            width: 250px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .search-box button {
            padding: 8px 12px;
            border: none;
            background: #5dade2;
            color: white;
            border-radius: 6px;
            cursor: pointer;
        }

        .search-box button:hover {
            background: #3498db;
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
            background: #5dade2;
            color: white;
            padding: 12px;
        }

        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f2f9ff;
        }

        .btn-pinjam {
            background: #5dade2;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-kembali {
            background: #e74c3c;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-pinjam:hover {
            background: #3498db;
        }

        .btn-kembali:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>📚 Dashboard Siswa</h2>
    <a href="login.php" class="logout">Logout</a>
</div>

<div class="container">
    <h3>Halo, <?= $_SESSION['user']['nama']; ?> 👋</h3>

    <!-- SEARCH FORM -->
    <div class="search-box">
        <form method="GET">
            <input type="text" name="search" placeholder="Cari judul buku..." value="<?= $keyword ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Aksi</th>
        </tr>

        <?php 
        $no = 1;
        while($row = $result->fetch_assoc()) : 
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['judul']; ?></td>
            <td>
                <?php if ($row['id_peminjaman']) : ?>
                    <a class="btn-kembali"
                       href="../controllers/PeminjamanControllers.php?kembali=<?= $row['id_peminjaman']; ?>">
                       Kembalikan
                    </a>
                <?php else : ?>
                    <a class="btn-pinjam"
                       href="../controllers/PeminjamanControllers.php?pinjam=<?= $row['id_buku']; ?>">
                       Pinjam
                    </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>