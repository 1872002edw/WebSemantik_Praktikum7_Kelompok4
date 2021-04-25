-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2021 at 09:22 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latihansemantik`
--
CREATE DATABASE IF NOT EXISTS latihansemantik;
-- --------------------------------------------------------

USE latihansemantik;

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nrp` varchar(15) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `fakultas` varchar(50) NOT NULL,
  `universitas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nrp`, `nama`, `foto`, `prodi`, `fakultas`, `universitas`) VALUES
('1232010', 'John Doe', '1232010.jpg', 'Teknik ', 'Teknik Elektro', 'Universitas Indonesia'),
('1232011', 'Budi', '1232011.jpg', 'Teknik ', 'Teknik Elektro', 'Universitas Indonesia'),
('170000', 'Tes', '170000.jpg', 'Kedokteran', 'Kedokteran', 'Pajajaran'),
('1872000', 'Black Widow', '1872000.jpg', 'Kedokteran', 'Kedokteran', 'Pajajaran'),
('1872002', 'Edward', '1872002.jpg', 'Teknik Informatika', 'Teknologi Informasi', 'Universitas Kristen Maranatha'),
('1872019', 'Ryan', '1872019.jpg', 'Teknik Informatika', 'Teknologi Informasi', 'Universitas Parahyangan'),
('1872027', 'Anthony', '1872027.jpg', 'Teknik Informatika', 'Teknologi Informasi', 'Universitas Kristen Maranatha'),
('1872051', 'Edwin', '1872051.jpg', 'Teknik Informatika', 'Teknologi Informasi', 'Universitas Kristen Maranatha'),
('1872099', 'Loran', '1872099.jpeg', 'Teknik Industri', 'Teknik', 'Universitas Parahyangan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nrp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
