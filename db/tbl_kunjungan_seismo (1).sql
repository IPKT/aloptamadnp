-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2023 at 12:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gis_dasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kunjungan_seismo`
--

CREATE TABLE `tbl_kunjungan_seismo` (
  `id_kunjungan` int NOT NULL,
  `kondisi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rekomendasi` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kerusakan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pelaksana` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `laporan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_seismo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kunjungan_seismo`
--
ALTER TABLE `tbl_kunjungan_seismo`
  ADD PRIMARY KEY (`id_kunjungan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kunjungan_seismo`
--
ALTER TABLE `tbl_kunjungan_seismo`
  MODIFY `id_kunjungan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
