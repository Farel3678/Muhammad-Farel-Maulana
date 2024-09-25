-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 01:20 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id_admin` int(15) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Kontak` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Level` enum('Admin','User') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id_admin`, `Nama`, `Kontak`, `Email`, `Level`) VALUES
(1, 'Alex', '0813 3445 8876', 'Alexender@gmail.com', 'Admin'),
(2, 'uuya', '0987 6543 1123', 'uuya@gmail.com', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Id` int(15) NOT NULL,
  `Nama_barang` varchar(30) NOT NULL,
  `Jenis_barang` varchar(30) NOT NULL,
  `Kuantitas_stock` int(30) NOT NULL,
  `Lokasi_gudang` varchar(30) NOT NULL,
  `Serial_number` varchar(30) NOT NULL,
  `harga` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Id`, `Nama_barang`, `Jenis_barang`, `Kuantitas_stock`, `Lokasi_gudang`, `Serial_number`, `harga`) VALUES
(17, 'EPSON', 'PRINTERS', 50, 'Surabaya', 'ZR41TS', 'Rp 30000000'),
(18, 'OPPO', 'HP', 10, 'Yogya Karta', 'ZR7GF', 'Rp 2000000'),
(19, 'EPSON 3113', 'PRINTERS', 0, 'Bandung', 'NN778', 'Rp30000000');

-- --------------------------------------------------------

--
-- Table structure for table `storage_unit`
--

CREATE TABLE `storage_unit` (
  `Id` int(15) NOT NULL,
  `Nama_gudang` varchar(30) NOT NULL,
  `Lokasi_gudang` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `storage_unit`
--

INSERT INTO `storage_unit` (`Id`, `Nama_gudang`, `Lokasi_gudang`) VALUES
(13, 'Gudang Melati', 'Surabaya'),
(14, 'Gudang Rose', 'Yogya Karta'),
(15, 'Gudang Surya', 'Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Id` int(15) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Kontak` varchar(30) NOT NULL,
  `Nama_barang` varchar(30) NOT NULL,
  `Nomor_invoice` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Id`, `Nama`, `Kontak`, `Nama_barang`, `Nomor_invoice`) VALUES
(17, 'NEYFA', '0824 66678 998', 'EPSON', '6542'),
(19, 'FAREL', '0867 4456 2345', 'OPPO', '777777'),
(20, 'FAJAR', '0987 6678 4444', 'EPSON 3113', '888888');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id_admin`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nama_barang` (`Nama_barang`,`Lokasi_gudang`),
  ADD KEY `Lokasi_gudang` (`Lokasi_gudang`);

--
-- Indexes for table `storage_unit`
--
ALTER TABLE `storage_unit`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Lokasi_gudang` (`Lokasi_gudang`),
  ADD UNIQUE KEY `Nama_gudang` (`Nama_gudang`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Nama_barang` (`Nama_barang`),
  ADD UNIQUE KEY `Nomor_invoice` (`Nomor_invoice`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `storage_unit`
--
ALTER TABLE `storage_unit`
  MODIFY `Id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `Id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`Nama_barang`) REFERENCES `supplier` (`Nama_barang`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`Lokasi_gudang`) REFERENCES `storage_unit` (`Lokasi_gudang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
