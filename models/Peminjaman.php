<?php
class Peminjaman {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function pinjam($id_user,$id_buku) {
        $tgl_pinjam = date("Y-m-d");
        $jatuh_tempo = date("Y-m-d", strtotime("+7 days"));

        return $this->conn->query(
            "INSERT INTO peminjaman
            (id_user,id_buku,tanggal_pinjam,tanggal_jatuh_tempo)
            VALUES ('$id_user','$id_buku','$tgl_pinjam','$jatuh_tempo')"
        );
    }

    public function kembalikan($id_peminjaman) {
        $tgl_kembali = date("Y-m-d");

        return $this->conn->query(
            "UPDATE peminjaman 
             SET status='dikembalikan',
                 tanggal_kembali='$tgl_kembali'
             WHERE id_peminjaman='$id_peminjaman'"
        );
    }

    public function getByUser($id_user) {
        return $this->conn->query(
            "SELECT p.*, b.judul 
             FROM peminjaman p
             JOIN data_buku b ON p.id_buku=b.id_buku
             WHERE id_user='$id_user'"
        );
    }
}