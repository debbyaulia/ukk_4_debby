<?php
class Buku {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM data_buku");
    }

    public function tambah($judul,$pengarang,$penerbit,$tahun,$stok) {
        return $this->conn->query(
            "INSERT INTO data_buku 
            (judul,pengarang,penerbit,tahun,stok)
            VALUES ('$judul','$pengarang','$penerbit','$tahun','$stok')"
        );
    }

    public function kurangiStok($id) {
        $this->conn->query(
            "UPDATE data_buku SET stok = stok - 1 WHERE id_buku=$id"
        );
    }

    public function tambahStok($id) {
        $this->conn->query(
            "UPDATE data_buku SET stok = stok + 1 WHERE id_buku=$id"
        );
    }
}