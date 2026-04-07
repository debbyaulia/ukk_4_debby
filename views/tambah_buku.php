<?php
session_start();
if ($_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
}
?>

<h2>Tambah Buku</h2>

<form method="POST" action="../controllers/BukuControllers.php">
    Judul: <input type="text" name="judul"><br><br>
    Pengarang: <input type="text" name="pengarang"><br><br>
    Penerbit: <input type="text" name="penerbit"><br><br>
    Tahun: <input type="number" name="tahun"><br><br>
    Stok: <input type="number" name="stok"><br><br>
    <button type="submit" name="tambah">Tambah Buku</button>
</form>

<br>
<a href="admin_dashboard.php">Kembali</a>