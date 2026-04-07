<?php
session_start();
require_once "../config/Database.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$db = (new Database())->connect();

/* ======================
   HAPUS DATA
====================== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $db->query("DELETE FROM data_buku WHERE id_buku=$id");
    header("Location: kelola_buku.php");
}

/* ======================
   TAMBAH DATA
====================== */
if (isset($_POST['tambah'])) {

    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $db->query("INSERT INTO data_buku 
        (judul,pengarang,penerbit,tahun,stok)
        VALUES ('$judul','$pengarang','$penerbit','$tahun','$stok')");

    header("Location: kelola_buku.php");
}

/* ======================
   EDIT DATA
====================== */
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];

    $db->query("UPDATE data_buku SET
        judul='$judul',
        pengarang='$pengarang',
        penerbit='$penerbit',
        tahun='$tahun',
        stok='$stok'
        WHERE id_buku=$id");

    header("Location: kelola_buku.php");
}

$result = $db->query("SELECT * FROM data_buku");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kelola Buku</title>
<style>
body {
    font-family: 'Segoe UI';
    background: #eef5ff;
    margin: 0;
    padding: 30px;
}
h2 {
    color: #2563eb;
}
table {
    width: 100%;
    background: white;
    border-collapse: collapse;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}
th, td {
    padding: 10px;
    border: 1px solid #ddd;
}
th {
    background: #2563eb;
    color: white;
}
a.btn {
    padding: 5px 10px;
    border-radius: 5px;
    text-decoration: none;
    color: white;
}
.edit { background: orange; }
.hapus { background: red; }
.tambah-btn {
    background: #2563eb;
    padding: 10px 15px;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}
form input {
    padding: 8px;
    margin: 5px;
}
button {
    padding: 8px 12px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 5px;
}
</style>
</head>
<body>

<h2>📚 Kelola Buku</h2>

<h3>Tambah Buku</h3>
<form method="POST">
    <input type="text" name="judul" placeholder="Judul" required>
    <input type="text" name="pengarang" placeholder="Pengarang" required>
    <input type="text" name="penerbit" placeholder="Penerbit" required>
    <input type="number" name="tahun" placeholder="Tahun" required>
    <input type="number" name="stok" placeholder="Stok" required>
    <button type="submit" name="tambah">Tambah</button>
</form>

<hr>

<h3>Data Buku</h3>
<table>
<tr>
    <th>ID</th>
    <th>Judul</th>
    <th>Pengarang</th>
    <th>Penerbit</th>
    <th>Tahun</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id_buku'] ?></td>
    <td><?= $row['judul'] ?></td>
    <td><?= $row['pengarang'] ?></td>
    <td><?= $row['penerbit'] ?></td>
    <td><?= $row['tahun'] ?></td>
    <td><?= $row['stok'] ?></td>
    <td>
        <a href="edit_buku.php?id=<?= $row['id_buku'] ?>" class="btn edit">Edit</a>
        <a href="kelola_buku.php?hapus=<?= $row['id_buku'] ?>" class="btn hapus" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>

</table>

<br>
<a href="admin_dashboard.php" class="tambah-btn">⬅ Kembali</a>

</body>
</html>