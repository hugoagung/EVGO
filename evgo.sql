-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jul 2021 pada 10.20
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evgo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(3) NOT NULL,
  `name_admin` varchar(128) NOT NULL,
  `email_admin` varchar(128) NOT NULL,
  `image_admin` varchar(50) NOT NULL,
  `password_admin` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created_admin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `name_admin`, `email_admin`, `image_admin`, `password_admin`, `role_id`, `is_active`, `date_created_admin`) VALUES
(12, 'tholol begotod', 'brego421@gmail.com', 'absen.JPG', '$2y$10$ElYrp5zem6Cgc6rJOfwPDObKGx3Z/8bpCpiyGo0U//rP8hVCP7RkC', 2, 1, 1626006652),
(18, 'hugo agung hokiarto', 'brego421@yahoo.com', 'lenovo_thinkpad.jpg', '$2y$10$u69BywPw5lj0k2D28uAjteQW9CHXXzBwOapsyZZzKsckp24L34oRq', 1, 1, 1619516546);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_keluar` int(3) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_barang_keluar` varchar(20) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `keterangan_keluar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_keluar`, `tanggal_keluar`, `id_barang_keluar`, `jumlah_keluar`, `keterangan_keluar`) VALUES
(1, '2021-06-01', 'nasgor udin', 11, 'coba2 saja'),
(9, '2021-06-14', '15', 5, ''),
(12, '2021-06-16', '18', 5, ''),
(13, '2021-07-03', '19', 1, 'brego'),
(15, '2021-07-04', '18', 5, 'selesai\r\n'),
(17, '2021-07-06', '18', 2, 'brego'),
(18, '2021-07-06', '18', 11, '2121'),
(19, '2021-07-06', '28', 21321, '21e21'),
(23, '2021-07-14', '28', 6, '                            1                            ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_masuk` int(3) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` int(20) NOT NULL,
  `keterangan_masuk` varchar(200) NOT NULL,
  `id_barang_masuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_masuk`, `tanggal_masuk`, `jumlah_masuk`, `keterangan_masuk`, `id_barang_masuk`) VALUES
(6, '2021-06-12', 14, 'Bjir keterangan', 3),
(7, '2021-06-12', 4, '                            Bjirr                            ', 3),
(8, '2021-06-12', 1, '                            bjir                            ', 3),
(10, '2021-06-14', 5, '222', 12),
(11, '2021-06-16', 1, '', 18),
(12, '2021-06-28', 0, '', 17),
(13, '2021-06-28', 0, '', 17),
(14, '2021-06-28', 0, '', 17),
(15, '2021-06-28', 2, '121', 18),
(16, '2021-07-06', 15, '                            12321321                            ', 18),
(17, '2021-07-06', 100, '222', 18),
(30, '2021-07-13', 5, 'sadsadsadsadsa                                            ', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `catatan`
--

CREATE TABLE `catatan` (
  `id_catatan` int(3) NOT NULL,
  `nama_catatan` varchar(15) NOT NULL,
  `kategori_catatan` varchar(11) NOT NULL,
  `keterangan_catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `catatan`
--

INSERT INTO `catatan` (`id_catatan`, `nama_catatan`, `kategori_catatan`, `keterangan_catatan`) VALUES
(5, 'kebab insta', 'makanan', 'dsads');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok` int(3) NOT NULL,
  `nama_barang_stok` varchar(15) NOT NULL,
  `kategori_stok` varchar(10) NOT NULL,
  `stok` int(4) NOT NULL,
  `harga_stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok`, `nama_barang_stok`, `kategori_stok`, `stok`, `harga_stok`) VALUES
(28, 'kebab ', 'makanan', 18, 10000),
(29, 'baso aci', 'food', 16, 200000),
(31, 'susu beo', 'minuman', 1, 2000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`id_catatan`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_keluar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_masuk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `catatan`
--
ALTER TABLE `catatan`
  MODIFY `id_catatan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
