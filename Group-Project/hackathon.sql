-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2023 pada 14.00
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackathon`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_konten`
--

CREATE TABLE `tbl_konten` (
  `id_konten` int(11) NOT NULL,
  `judul_konten` varchar(255) NOT NULL,
  `isi_konten` varchar(255) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_konten`
--

INSERT INTO `tbl_konten` (`id_konten`, `judul_konten`, `isi_konten`, `tanggal`) VALUES
(6, 'Content 2', 'Lorem impsum', '2023-11-11 01:24:00'),
(8, 'Content 3', 'Lorem ipsum dolor met amet', '2023-11-13 07:47:32'),
(9, 'Article 4', 'Loremb ipsums', '2023-11-13 07:56:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_peserta`
--

CREATE TABLE `tbl_peserta` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `lomba` varchar(255) NOT NULL,
  `status` char(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_peserta`
--

INSERT INTO `tbl_peserta` (`id`, `nama`, `nim`, `email`, `no_telp`, `lomba`, `status`, `username`) VALUES
(1, 'Ahmad Rian Syaifullah', 'h1d022010', 'rian@gmail.com', '082113155212', 'stec', 'Pending', 'rian'),
(2, 'Muhammad Sultan Alhakim', 'H1D022105', 'msultanalhakim@gmail.com', '082113155212', 'ic', 'Accepted', 'sultan'),
(3, 'Muhammad Sultan Alhakim', 'H1D020069', 'msultanalhakim@gmail.com', '082113155212', 'ic', 'Pending', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `level` enum('Administrator','Guest') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `fullname`, `username`, `password`, `email`, `level`) VALUES
(1, 'Muhammad Sultan Alhakim', 'msultanalhakim', 'f310bbc6d56f2b8a45b8c40973e3d48a', 'msultanalhakim@gmail.com', 'Administrator'),
(3, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin@mail.com', 'Administrator'),
(4, 'user', 'user', '6ad14ba9986e3615423dfca256d04e3f', 'user@gmail.com', 'Guest'),
(5, 'Ahmad Rian Syaifullah', 'rian', '26ed30f28908645239254ff4f88c1b75', 'rian@gmail.com', 'Guest'),
(6, 'Muhammad Sultan Alhakim', 'sultan', 'f310bbc6d56f2b8a45b8c40973e3d48a', 'sultan@gmail.com', 'Guest');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_konten`
--
ALTER TABLE `tbl_konten`
  ADD PRIMARY KEY (`id_konten`);

--
-- Indeks untuk tabel `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_konten`
--
ALTER TABLE `tbl_konten`
  MODIFY `id_konten` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_peserta`
--
ALTER TABLE `tbl_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
