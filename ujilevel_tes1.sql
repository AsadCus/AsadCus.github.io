-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2021 pada 09.22
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujilevel_tes1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(3) NOT NULL,
  `nama_barang` varchar(30) DEFAULT NULL,
  `stok` int(3) DEFAULT NULL,
  `tersedia` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `tersedia`) VALUES
('B01', 'Laptop Acer', 12, 7),
('B02', 'Infocus In124', 12, 12),
('B03', 'Epson EB-X100', 10, 10),
('B04', 'Laptop Asus', 10, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_peminjaman` varchar(3) NOT NULL,
  `id_barang` varchar(3) NOT NULL,
  `jumlah_dipinjam` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `detail_peminjaman`
--
DELIMITER $$
CREATE TRIGGER `mengurangi` AFTER INSERT ON `detail_peminjaman` FOR EACH ROW BEGIN
UPDATE barang
SET tersedia = tersedia - new.jumlah_dipinjam
WHERE id_barang = new.id_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pembatas` AFTER INSERT ON `detail_peminjaman` FOR EACH ROW BEGIN
IF ((SELECT tersedia FROM barang WHERE barang.id_barang = NEW.id_barang) < 0) THEN
DELETE FROM detail_peminjaman
WHERE id_peminjaman = NEW.id_peminjaman;
END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah` AFTER DELETE ON `detail_peminjaman` FOR EACH ROW BEGIN
UPDATE barang SET tersedia = tersedia + OLD.jumlah_dipinjam
WHERE id_barang = OLD.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventori`
--

CREATE TABLE `inventori` (
  `id_barang` varchar(3) NOT NULL,
  `jenis_barang` varchar(20) DEFAULT NULL,
  `jumlah_baik` int(3) DEFAULT 0,
  `jumlah_rusak` int(3) DEFAULT 0,
  `jumlah_diperbaiki` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventori`
--

INSERT INTO `inventori` (`id_barang`, `jenis_barang`, `jumlah_baik`, `jumlah_rusak`, `jumlah_diperbaiki`) VALUES
('B01', 'Laptop', 6, 3, 3),
('B02', 'Proyektor', 12, 0, 0),
('B03', 'Proyektor', 10, 0, 0),
('B04', 'Laptop', 10, 0, 0);

--
-- Trigger `inventori`
--
DELIMITER $$
CREATE TRIGGER `inventori2` AFTER UPDATE ON `inventori` FOR EACH ROW BEGIN
UPDATE barang
SET tersedia = new.jumlah_baik
WHERE id_barang = new.id_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` varchar(3) NOT NULL,
  `nama_pegawai` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama_pegawai`) VALUES
('S01', 'Admin'),
('S02', 'Admin-2'),
('S03', 'Admin-3'),
('S04', 'Admin-4'),
('S05', 'Admin-5'),
('S06', 'Admin-6'),
('S07', 'Admin-7');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` varchar(3) NOT NULL,
  `no_pengguna` varchar(10) DEFAULT NULL,
  `tgl_pinjam` date DEFAULT current_timestamp(),
  `dikembalikan` varchar(10) DEFAULT 'BELUM'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `hapus` AFTER UPDATE ON `peminjaman` FOR EACH ROW BEGIN

DECLARE status varchar(10);

SET status = new.dikembalikan;

IF (status = "SUDAH") THEN
	DELETE FROM detail_peminjaman
    WHERE id_peminjaman = NEW.id_peminjaman;
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `no_pengguna` varchar(10) NOT NULL,
  `nama_pengguna` varchar(20) DEFAULT NULL,
  `kategori` enum('Murid','Guru','Ruang') DEFAULT NULL,
  `fileActualExt` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`no_pengguna`, `nama_pengguna`, `kategori`, `fileActualExt`) VALUES
('0000000001', 'Asad', 'Murid', 'jpeg'),
('0000000002', 'Joy', 'Murid', 'jpg'),
('0000000003', 'Zein', 'Murid', 'jpg'),
('0009251346', 'Pak Puguh', 'Guru', 'png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`,`id_barang`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `inventori`
--
ALTER TABLE `inventori`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `no_pengguna` (`no_pengguna`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`no_pengguna`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `dp_fk1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`),
  ADD CONSTRAINT `dp_fk2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `inventori`
--
ALTER TABLE `inventori`
  ADD CONSTRAINT `inventori_fk2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_fk1` FOREIGN KEY (`no_pengguna`) REFERENCES `pengguna` (`no_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
