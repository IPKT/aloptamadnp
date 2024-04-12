-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 12, 2024 at 05:52 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

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
-- Table structure for table `tbl_jaringan_internet`
--

CREATE TABLE `tbl_jaringan_internet` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `shift` varchar(30) DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `lintas` varchar(50) DEFAULT NULL,
  `catatan_lintas` varchar(100) DEFAULT NULL,
  `indihome` varchar(50) DEFAULT NULL,
  `catatan_indihome` varchar(100) DEFAULT NULL,
  `biznet` varchar(50) DEFAULT NULL,
  `catatan_biznet` varchar(100) DEFAULT NULL,
  `catatan` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jaringan_internet`
--

INSERT INTO `tbl_jaringan_internet` (`id`, `tanggal`, `petugas`, `shift`, `waktu`, `lintas`, `catatan_lintas`, `indihome`, `catatan_indihome`, `biznet`, `catatan_biznet`, `catatan`) VALUES
(9, '2024-04-12', 'I Putu Kembar Tirtayasa', 'Pagi', '08:00:00', 'Baik', 'Up : 80 , Down : 100', 'Baik', 'Up : 8 , Down : 100', 'Baik', 'Up : 80 , Down : 10', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jaringan_internet`
--
ALTER TABLE `tbl_jaringan_internet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jaringan_internet`
--
ALTER TABLE `tbl_jaringan_internet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
