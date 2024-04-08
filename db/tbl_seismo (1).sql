-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 19, 2023 at 12:33 AM
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
-- Table structure for table `tbl_seismo`
--

CREATE TABLE `tbl_seismo` (
  `id_seismo` int NOT NULL,
  `kode` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `kondisi_terkini` varchar(10) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'ON',
  `koordinat` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lokasi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `detail_lokasi` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_seismo`
--

INSERT INTO `tbl_seismo` (`id_seismo`, `kode`, `kondisi_terkini`, `koordinat`, `lokasi`, `detail_lokasi`, `tipe`) VALUES
(65, 'DNP', 'ON', '-8.6769, 115.211', 'Stasiun Geofisika Denpasar', 'Pulau Tarakan', 'Libra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_seismo`
--
ALTER TABLE `tbl_seismo`
  ADD PRIMARY KEY (`id_seismo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_seismo`
--
ALTER TABLE `tbl_seismo`
  MODIFY `id_seismo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
