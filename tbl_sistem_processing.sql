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
-- Table structure for table `tbl_sistem_processing`
--

CREATE TABLE `tbl_sistem_processing` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `petugas` varchar(50) NOT NULL,
  `shift` varchar(30) DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `sc_seismo_server` varchar(50) DEFAULT NULL,
  `sc_seismo_client` varchar(50) DEFAULT NULL,
  `sc_acc_server` varchar(50) DEFAULT NULL,
  `sc_acc_pusat` varchar(50) DEFAULT NULL,
  `sc_acc_regional` varchar(50) DEFAULT NULL,
  `petir` varchar(50) DEFAULT NULL,
  `anemometer` varchar(50) DEFAULT NULL,
  `catatan` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sistem_processing`
--

INSERT INTO `tbl_sistem_processing` (`id`, `tanggal`, `petugas`, `shift`, `waktu`, `sc_seismo_server`, `sc_seismo_client`, `sc_acc_server`, `sc_acc_pusat`, `sc_acc_regional`, `petir`, `anemometer`, `catatan`) VALUES
(9, '2024-04-12', 'I Putu Kembar Tirtayasa', 'Pagi', '08:00:00', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', 'Baik', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_sistem_processing`
--
ALTER TABLE `tbl_sistem_processing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_sistem_processing`
--
ALTER TABLE `tbl_sistem_processing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
