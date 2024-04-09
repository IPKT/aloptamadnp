-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 09, 2024 at 03:16 AM
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
-- Database: `aloptamadnp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taman_alat`
--

CREATE TABLE `tbl_taman_alat` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `petugas` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `shift` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sangkar_meteo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `anemometer` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `panci_penguapan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `campbel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hillman` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `penakar_hujan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `catatan` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_taman_alat`
--

INSERT INTO `tbl_taman_alat` (`id`, `tanggal`, `petugas`, `shift`, `sangkar_meteo`, `anemometer`, `panci_penguapan`, `campbel`, `hillman`, `penakar_hujan`, `catatan`) VALUES
(1, '2024-04-10', 'putu', NULL, NULL, NULL, NULL, NULL, 'baik', NULL, NULL),
(2, '2024-04-09', 'arin', NULL, NULL, NULL, NULL, NULL, 'Kecepatan', NULL, NULL),
(3, '2024-04-10', 'Martin', NULL, NULL, NULL, NULL, NULL, 'buruk', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_taman_alat`
--
ALTER TABLE `tbl_taman_alat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_taman_alat`
--
ALTER TABLE `tbl_taman_alat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
