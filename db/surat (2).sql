-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2025 pada 05.06
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(255) NOT NULL,
  `waktu_keluar` timestamp NOT NULL DEFAULT current_timestamp(),
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal_surat` timestamp NOT NULL DEFAULT current_timestamp(),
  `perihal` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `kode_surat`, `waktu_keluar`, `nomor_surat`, `tanggal_surat`, `perihal`, `pengirim`, `kepada`, `lampiran`) VALUES
(5, '01', '2025-01-19 17:00:00', 'A-230/KOM/D-IV/KKA/01/2025', '2025-01-18 17:00:00', 'Pemberitahuan Perubahan Regulasi Telekomunikasi', 'DISKOMINFOSTAN DELI SERDANG', 'Telekomunikasi Indonesia', '67c512d17ba60.pdf'),
(6, '02', '2025-01-20 17:00:00', 'B-231/KOM/D-IV/KKA/02/2025', '2025-01-19 17:00:00', 'Laporan Insiden Keamanan Siber Pada Sistem Pemerintahan', 'DISKOMINFOSTAN DELI SERDANG', 'Badan Siber dan Sandi Negara', '67c514aa89131.pdf'),
(7, '03', '2025-01-21 17:00:00', 'C-232KOM/D-IV/KKA/03/2025', '2025-01-20 17:00:00', 'Pedoman Penerapan Sertifikat Elektronik Di Instansi Pemerintah', 'DISKOMINFOSTAN DELI SERDANG', 'Badan Siber dan Sandi Negara', '67c515e82c78d.pdf'),
(8, '04', '2025-01-22 17:00:00', 'D-233/KOM/D-IV/KKA/04/2025', '2025-01-21 17:00:00', 'Pemberitahuan Migrasi Siaran Analog Ke Digital', 'DISKOMINFOSTAN DELI SERDANG', 'Masyarakat', '67c517a99891d.pdf'),
(10, '05', '2025-01-23 17:00:00', 'E-234/KOM/D-IV/KKA/05/2025', '2025-01-22 17:00:00', 'Permohonan Regulasi Terkait Konten Bermuatan Negatif', 'DISKOMINFOSTAN DELI SERDANG', 'Internet Service Provider', '67c51dcfcacef.pdf'),
(11, '06', '2026-01-24 17:00:00', 'F-235/KOM/D-IV/KKA/06/2026', '2026-01-23 17:00:00', 'Peringatan Kepada Lembaga Penyiaran Yang Melanggar Aturan', 'DISKOMINFOSTAN DELI SERDANG', 'Televisi Republik Indonesia', '67c5210010af9.docx'),
(12, '07', '2026-01-25 17:00:00', 'G-236/KOM/D-IV/KKA/07/2026', '2026-01-24 17:00:00', 'Persetujuan Pemasangan Perangkat Komunikasi Satelit', 'DISKOMINFOSTAN DELI SERDANG', 'Operator Telekomunikasi', '67c523053a6b3.pdf'),
(13, '08', '2026-01-26 17:00:00', 'H-237/KOM/D-IV/KKA/08/2026', '2026-01-25 17:00:00', 'Penghentian Operasional Perangkat Yang Tidak Bersertifikasi', 'DISKOMINFOSTAN DELI SERDANG', 'Importir Elektronik', '67c52443a5ca5.pdf'),
(14, '09', '2026-01-27 17:00:00', 'I-238/KOM/D-IV/KKA/09/2026', '2026-01-26 17:00:00', 'Rekomendasi Penggunaan Enkripsi Dalam Komunikasi Resmi', 'DISKOMINFOSTAN DELI SERDANG', 'Instansi Pemerintah', '67c525536cd5c.docx'),
(15, '010', '2026-01-28 17:00:00', 'J-239/KOM/D-IV/KKA/010/2026', '2026-01-27 17:00:00', 'Surat Edaran Pelaksanaan Audit Keamanan Sistem Informasi', 'DISKOMINFOSTAN DELI SERDANG', 'Penyelenggara Sistem Elektronik', '67c5263984ea6.docx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `kode_surat` varchar(255) NOT NULL,
  `waktu_masuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `nomor_surat` varchar(50) NOT NULL,
  `tanggal_surat` timestamp NOT NULL DEFAULT current_timestamp(),
  `perihal` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `kepada` varchar(255) NOT NULL,
  `lampiran` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `kode_surat`, `waktu_masuk`, `nomor_surat`, `tanggal_surat`, `perihal`, `pengirim`, `kepada`, `lampiran`) VALUES
(5, '01', '2025-01-14 17:00:00', 'A-230/PANRB/D-IV/KKA/01/2025', '2025-01-13 17:00:00', 'Registrasi Kartu Pelanggan Telekomunikasi Seluler', 'Telekomunikasi Indonesia', 'DISKOMINFOSTAN DELI SERDANG', '67c169e6d92f6.docx'),
(6, '02', '2025-01-15 17:00:00', 'B-231/PANRB/D-IV/KKA/02/2025', '2025-01-14 17:00:00', 'Pengalihan Sumber Daya Kehumasan', 'Badan Pemeriksa Keuangan', 'DISKOMINFOSTAN DELI SERDANG', '67c162ff6d142.pdf'),
(7, '03', '2025-01-16 17:00:00', 'C-232/PANRB/D-IV/KKA/03/2025', '2025-01-15 17:00:00', 'Bimbingan Teknis Keamanan Siber', 'Badan Siber dan Sandi Negara', 'DISKOMINFOSTAN DELI SERDANG', '67c16173b4b74.pdf'),
(10, '04', '2025-01-17 17:00:00', 'D-233/PANRB/D-IV/KKA/04/2025', '2025-01-16 17:00:00', 'Bimbingan Teknis Pemanfaatan Sertifikat Elektornik', 'Badan Siber dan Sandi Negara', 'DISKOMINFOSTAN DELI SERDANG', '67c161c9ce4da.pdf'),
(12, '05', '2025-01-18 17:00:00', 'E-234/PANRB/D-IV/KKA/05/2025', '2025-01-17 17:00:00', 'Permohonan Izin Penyiaran', 'Komisi Penyiaran Indonesia', 'DISKOMINFOSTAN DELI SERDANG', '67c51a6f21712.docx'),
(13, '06', '2026-01-19 17:00:00', 'F-235/PANRB/D-IV/KKA/06/2026', '2026-01-18 17:00:00', 'Laporan Hasil Pengawasan Konten Digital', 'Badan Pengawas Pemilihan Umum', 'DISKOMINFOSTAN DELI SERDANG', ''),
(14, '07', '2026-01-20 17:00:00', 'G-236/PANRB/D-IV/KKA/07/2026', '2026-01-19 17:00:00', 'Laporan Pelanggaran Hak Siar Dan Hak Cipta Di Media Digital', 'Lembaga Sensor Film', 'DISKOMINFOSTAN DELI SERDANG', '67c5280c0d463.pdf'),
(15, '08', '2026-01-21 17:00:00', 'H-237/PANRB/D-IV/KKA/08/2026', '2026-01-20 17:00:00', 'Permohonan Normalisasi Situs Yang Diblokir', 'Perusahaan Digital', 'DISKOMINFOSTAN DELI SERDANG', '67c528d8d93a1.pdf'),
(16, '09', '2026-01-22 17:00:00', 'I-238/PANRB/D-IV/KKA/09/2026', '2026-01-21 17:00:00', 'Laporan Kesiapan Implementasi Digital ID', 'Dinas Kependudukan Dan Catatan Sipil', 'DISKOMINFOSTAN DELI SERDANG', '67c529b6c9e4f.pdf'),
(17, '010', '2026-01-23 17:00:00', 'J-239/PANRB/D-IV/KKA/010/2026', '2026-01-22 17:00:00', 'Proposal Pembagunan Pusat Data Nasional', 'Badan Siber dan Sandi Negara', 'DISKOMINFOSTAN DELI SERDANG', '67c52a575e86b.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `foto`) VALUES
(2923, 'yogi123', '$2y$10$BkBPp6sMl4WJH3bn0A0DJu.AhypVq952rwHWLMsH7pxoXX5DNfpHe', 'pegawai', 'yogi irwan syahputra', 'user_1740499500.png'),
(2924, 'refin', '$2y$10$b692CP9tCNyhYdc9U3HSguCyMH4nRiRj7uWx8r191BMQN3ef8yqz6', 'admin', 'refin harissandi', 'user_1740551654.png'),
(2925, 'harprit', '$2y$10$7Y9m5jnVLVEe8a16OYXiYeLUcZ4NYrzD2CLZ5nl8a6pvcbh7Qu3QG', 'admin', 'harprit singh', 'user_1740551844.png'),
(2926, 'elin', '$2y$10$bB/HLpo0MRjsofkgSrfPc.k0EMh3STuicsbOVPFHSdvJqGpq3Yg4e', 'admin', 'afrilia elin', 'user_1740552270.png'),
(2927, 'rossya', '$2y$10$bsPsH8fs.9cUN1GQwRu4Q.hQpi7TgSNKzVfgnnKnpenkY8IwrcZMe', 'admin', 'rossya diva anwar', 'user_1740552429.png'),
(2928, 'eliza', '$2y$10$/pRnzihw36SNU6O7Orc6EeFcxEC56ZHtkkt9cgkQUiShNKf0.IXsS', 'admin', 'eliza deani', 'user_1740552634.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2930;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
