<?php
session_start();

require_once "../config/Database.php";
require_once "../models/Buku.php";

$db = (new Database())->connect();
$buku = new Buku($db);

/*
|--------------------------------------------------------------------------
| TAMBAH BUKU (ADMIN)
|--------------------------------------------------------------------------
*/
if (isset($_POST['tambah'])) {

    if ($_SESSION['user']['role'] != 'admin') {
        die("Akses ditolak!");
    }

    $judul      = $_POST['judul'];
    $pengarang  = $_POST['pengarang'];
    $penerbit   = $_POST['penerbit'];
    $tahun      = $_POST['tahun'];
    $stok       = $_POST['stok'];

    if ($buku->tambah($judul, $pengarang, $penerbit, $tahun, $stok)) {
        header("Location: ../views/admin_dashboard.php?msg=berhasil_tambah");
    } else {
        echo "Gagal menambahkan buku";
    }
}

/*
|--------------------------------------------------------------------------
| HAPUS BUKU (ADMIN)
|--------------------------------------------------------------------------
*/
if (isset($_GET['hapus'])) {

    if ($_SESSION['user']['role'] != 'admin') {
        die("Akses ditolak!");
    }

    $id = $_GET['hapus'];

    $query = $db->query("DELETE FROM data_buku WHERE id_buku=$id");

    if ($query) {
        header("Location: ../views/admin_dashboard.php?msg=berhasil_hapus");
    } else {
        echo "Gagal menghapus buku";
    }
}