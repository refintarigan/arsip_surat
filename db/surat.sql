-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 02:58 PM
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
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `kode_surat`, `waktu_keluar`, `nomor_surat`, `tanggal_surat`, `perihal`, `pengirim`, `kepada`, `lampiran`) VALUES
(5, '1', '2025-02-25 17:00:00', '2T349721739197', '2025-02-25 17:00:00', '141604', '107480', '18410', '67bea44889a63.pdf'),
(6, '1', '2025-02-24 17:00:00', '001', '2025-02-24 17:00:00', '001', '001', '001', '67bd4d2c49a11.pdf'),
(7, '1', '2025-02-24 17:00:00', '001', '2025-02-24 17:00:00', '001', '001', '001', NULL),
(8, '1', '2025-02-24 17:00:00', '001', '2025-02-24 17:00:00', '001', '001', '001', NULL),
(9, '001', '2025-02-24 17:00:00', '001', '2025-02-24 17:00:00', '001', '001', '001', '67bd57957cab0.pdf'),
(10, '11', '2025-02-26 17:00:00', '11', '2025-02-24 17:00:00', '111', '11', '11', NULL),
(11, '11', '2025-02-25 17:00:00', '11', '2025-02-25 17:00:00', '11', '11', '11', NULL);

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
(5, '007', '2025-02-14 17:00:00', '006', '2025-02-14 17:00:00', '007', 'yogi', 'yono', '67bca3ee9fffc.pdf'),
(6, '003', '2025-02-27 17:00:00', '003', '2025-02-23 17:00:00', '002', '002', '002', '67bc39f02bf79.pdf'),
(7, '001', '2025-02-23 17:00:00', '002', '2025-02-27 17:00:00', 'pemberian izin', 'apa aj', 'apa iya', '67bc7e660a127.pdf'),
(9, '001', '2025-02-24 17:00:00', '001', '2025-02-24 17:00:00', '001', '001', '001', ''),
(10, '002', '2025-02-25 17:00:00', '002', '2025-02-25 17:00:00', '001', '001', '001', ''),
(11, 's', '2026-01-25 17:00:00', '1', '2026-01-25 17:00:00', '11', '11', '11', ''),
(12, '1', '2025-02-26 17:00:00', '1', '2025-02-26 17:00:00', '1', '1', '1', ''),
(13, '11', '2025-02-25 17:00:00', '11', '2025-02-25 17:00:00', '111', '11', '11', ''),
(14, '11', '2025-02-25 17:00:00', '11', '2025-02-25 17:00:00', '11', '11', '11', ''),
(15, '11', '2025-02-25 17:00:00', '111', '2025-02-25 17:00:00', '11', '111', '11', ''),
(16, '11', '2026-01-25 17:00:00', '11', '2026-06-15 17:00:00', '111', '11', '11', ''),
(17, 'S', '2025-02-27 17:00:00', 'S', '2025-02-27 17:00:00', 'S', 'S', 'S', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `foto`) VALUES
(2923, 'yogi123', '$2y$10$BkBPp6sMl4WJH3bn0A0DJu.AhypVq952rwHWLMsH7pxoXX5DNfpHe', 'admin', 'yogi irwan syahputra', 'user_1740499500.png'),
(2924, 'yogi2', '$2y$10$ewYluMEef7CTZB8wkV2mXOmR4GJhbXoL198EO0kHJR8lCShvH4ade', 'pegawai', 'yogi2', 'user_1740549934.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2925;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
