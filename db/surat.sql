-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 10:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `kode_surat` int(255) NOT NULL,
  `waktu_keluar` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nomor_surat` varchar(255) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `kepada` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`kode_surat`, `waktu_keluar`, `nomor_surat`, `tanggal_surat`, `perihal`, `pengirim`, `kepada`) VALUES
(10103, '2025-02-03 08:14:36', '123Suratizin', '2025-02-03', 'Izin menggunakan gedung untuk acara peresmian', 'HRD PT.Original', 'Kabag.Umum Setdakab'),
(10199, '2025-02-06 08:27:17', '3874974', '2025-02-06', 'jeijf', 'dnjkjs', 'iedu8e');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluars`
--

CREATE TABLE `surat_keluars` (
  `kode_surat` bigint(20) UNSIGNED NOT NULL,
  `waktu_masuk` longtext DEFAULT NULL,
  `nomor_surat` longtext DEFAULT NULL,
  `tanggal` longtext DEFAULT NULL,
  `perihal` longtext DEFAULT NULL,
  `pengirim` longtext DEFAULT NULL,
  `kepada` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
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
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `kode_surat`, `waktu_masuk`, `nomor_surat`, `tanggal_surat`, `perihal`, `pengirim`, `kepada`, `lampiran`) VALUES
(1, '001', '2025-02-22 17:00:00', '001', '2025-02-22 17:00:00', 'r', 'r', 'r', '67bb8f1eadae8.pdf'),
(5, '002', '2025-02-23 17:00:00', '002', '2025-02-27 17:00:00', '003', '003', '003', '67bb962a1fdda.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`) VALUES
(2911, 'refin', '$2y$10$BQRgT1PTVL9zZvR5q4vOfOmJ3AdwZBQ8E3abURqwTDP9o9ks7.0Vy', '', 'Refin'),
(2912, 'yogi123', '$2y$10$i7mDtyEwYX5yoIiQzgq6S.YjCBPpb.tFHPMhlYTh68MCZkcP4MtJy', 'admin', 'yogi irwan syahputra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`kode_surat`);

--
-- Indexes for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  ADD PRIMARY KEY (`kode_surat`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `kode_surat` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10200;

--
-- AUTO_INCREMENT for table `surat_keluars`
--
ALTER TABLE `surat_keluars`
  MODIFY `kode_surat` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2915;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
