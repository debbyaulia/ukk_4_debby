<?php
session_start();

require_once "../config/Database.php";
require_once "../models/Peminjaman.php";
require_once "../models/Buku.php";

$db = (new Database())->connect();
$peminjaman = new Peminjaman($db);
$buku = new Buku($db);

/*
|--------------------------------------------------------------------------
| PINJAM BUKU (SISWA)
|--------------------------------------------------------------------------
*/
if (isset($_GET['pinjam'])) {

    if ($_SESSION['user']['role'] != 'siswa') {
        die("Akses ditolak!");
    }

    $id_user = $_SESSION['user']['id_user'];
    $id_buku = $_GET['pinjam'];

    // Cek stok dulu
    $cek = $db->query("SELECT stok FROM data_buku WHERE id_buku=$id_buku");
    $data = $cek->fetch_assoc();

    if ($data['stok'] > 0) {

        // Insert peminjaman
        if ($peminjaman->pinjam($id_user, $id_buku)) {

            // Kurangi stok
            $buku->kurangiStok($id_buku);

            header("Location: ../views/siswa_dashboard.php?msg=berhasil_pinjam");
        } else {
            echo "Gagal meminjam buku";
        }

    } else {
        echo "Stok buku habis!";
    }
}

/*
|--------------------------------------------------------------------------
| KEMBALIKAN BUKU (SISWA)
|--------------------------------------------------------------------------
*/
if (isset($_GET['kembali'])) {

    if ($_SESSION['user']['role'] != 'siswa') {
        die("Akses ditolak!");
    }

    $id_peminjaman = $_GET['kembali'];

    // Ambil id_buku dulu
    $ambil = $db->query("SELECT id_buku FROM peminjaman WHERE id_peminjaman=$id_peminjaman");
    $data = $ambil->fetch_assoc();
    $id_buku = $data['id_buku'];

    // Update status jadi dikembalikan
    if ($peminjaman->kembalikan($id_peminjaman)) {

        // Tambah stok kembali
        $buku->tambahStok($id_buku);

        header("Location: ../views/siswa_dashboard.php?msg=berhasil_kembali");
    } else {
        echo "Gagal mengembalikan buku";
    }
}