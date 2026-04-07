<?php
session_start();
require_once "../config/Database.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$db = (new Database())->connect();

/* ======================
   HAPUS DATA (HANYA SISWA)
====================== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $cek = $db->query("SELECT role FROM users WHERE id_user=$id")->fetch_assoc();

    if ($cek['role'] == 'siswa') {
        $db->query("DELETE FROM users WHERE id_user=$id");
    }

    header("Location: kelola_anggota.php");
}

/* ======================
   TAMBAH ANGGOTA
====================== */
if (isset($_POST['tambah'])) {

    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role  = $_POST['role'];

    $db->query("INSERT INTO users (nama,email,password,role)
                VALUES ('$nama','$email','$pass','$role')");

    header("Location: kelola_anggota.php");
}

/* ======================
   UPDATE
====================== */
if (isset($_POST['update'])) {

    $id    = $_POST['id'];
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    $db->query("UPDATE users SET
        nama='$nama',
        email='$email',
        role='$role'
        WHERE id_user=$id");

    header("Location: kelola_anggota.php");
}

$result = $db->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Kelola Anggota</title>
<style>
body {
    font-family: 'Segoe UI';
    background: #eef5ff;
    padding: 30px;
}
h2 { color: #2563eb; }
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
form input, select {
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

<h2>👥 Kelola Anggota</h2>

<h3>Tambah Anggota</h3>
<form method="POST">
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="role">
        <option value="siswa">Siswa</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit" name="tambah">Tambah</button>
</form>

<hr>

<h3>Data Anggota</h3>

<table>
<tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Role</th>
    <th>Aksi</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr>
    <td><?= $row['id_user'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['role'] ?></td>
    <td>
        <a href="edit_anggota.php?id=<?= $row['id_user'] ?>" class="btn edit">Edit</a>

        <?php if($row['role'] == 'siswa') { ?>
            <a href="kelola_anggota.php?hapus=<?= $row['id_user'] ?>" 
               class="btn hapus"
               onclick="return confirm('Yakin hapus anggota ini?')">
               Hapus
            </a>
        <?php } ?>
    </td>
</tr>
<?php } ?>

</table>

<br>
<a href="admin_dashboard.php">⬅ Kembali</a>

</body>
</html>