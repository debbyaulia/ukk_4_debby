-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql112.infinityfree.com
-- Waktu pembuatan: 09 Apr 2026 pada 00.37
-- Versi server: 11.4.10-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41558018_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_anggota`
--

CREATE TABLE `data_anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_anggota`
--

INSERT INTO `data_anggota` (`id_anggota`, `nama`, `alamat`, `email`) VALUES
(1, 'Debby', 'Jl.Kiara Payung', 'debbymaizon@gmail.com'),
(2, 'Alwi', 'Jl.Mawar', 'Alwi@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun`, `stok`) VALUES
(1, 'Indonesia', 'Santi', 'Santo', 2019, 18),
(2, 'Sejarah', 'Anwar', 'Agua', 2020, 21),
(3, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pusaka', 2019, 15),
(4, 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 2023, 16),
(5, 'The Power of Habit', 'Charles Duhigg', 'Random House', 2021, 20),
(6, 'Saman', 'Ayu Utami', 'Kepustakaan Populer Gramedia', 2018, 30),
(7, 'Harry Poter', 'Susila', 'Robbet', 2023, 11),
(8, 'Si Kancil', 'Intan', 'Bambang', 2018, 13),
(9, 'Atomic Habits', 'James Clear ', 'Avery', 2023, 28),
(10, 'Sang Pemimpi ', 'Andrea Hirata', 'Bentang Pustaka', 2020, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_jatuh_tempo` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_user`, `id_buku`, `tanggal_pinjam`, `tanggal_jatuh_tempo`, `tanggal_kembali`, `status`) VALUES
(1, 1, 1, '2026-02-10', NULL, '2026-03-06', 'dikembalikan'),
(9, 4, 2, '2026-02-22', '2026-03-01', '2026-02-23', 'dikembalikan'),
(10, 4, 2, '2026-02-22', '2026-03-01', '2026-02-23', 'dikembalikan'),
(11, 4, 1, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(12, 4, 1, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(13, 4, 1, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(14, 4, 1, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(15, 4, 2, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(16, 4, 1, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(17, 4, 2, '2026-02-23', '2026-03-02', '2026-02-23', 'dikembalikan'),
(18, 4, 1, '2026-02-23', '2026-03-02', '2026-03-10', 'dikembalikan'),
(19, 4, 7, '2026-02-23', '2026-03-02', '2026-03-10', 'dikembalikan'),
(20, 4, 7, '2026-04-02', '2026-04-09', '2026-04-09', 'dikembalikan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`) VALUES
(1, 'Debby', 'debbymaizon@gmail.com', '12345', 'siswa'),
(2, 'Wawan', 'wawan@gmail.com', '$2y$10$5qeMGL5Wfyd72PkKQv.Zt.IahDYPLn02I7elLSQoqugIudrfpDkq2', 'admin'),
(3, 'amalia', 'amalia@gmail.com', '$2y$10$V4CFHIG0dkNyEYaA0TEwkey0t47BFZi2lcxPLQuNa1YMvp.qGxm/i', 'siswa'),
(4, 'salma', 'salma@gmail.com', '$2y$10$Y3Ru6x/6CJwSL.JFKFb0he43MOzvDmLQ0IKx7i.6E7o7lsKkJaKg.', 'siswa'),
(7, 'yanto', 'yanto@gmail.com', '12345', 'admin'),
(12, 'Yusup', 'yusup@gmail.com', '$2y$10$jUvqzYVn4kTWEr53UZstwuabE5g7.NdwMEhjd2ubY1KsILb4fjQsW', 'siswa'),
(13, 'epan', 'epan@gmail.com', '$2y$10$WwonMSR0CGLlfyUUPuXqc.oyvFbZb83dM6uvfmhiiOFWSgmkka4Ru', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_anggota`
--
ALTER TABLE `data_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_anggota`
--
ALTER TABLE `data_anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `data_buku` (`id_buku`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
