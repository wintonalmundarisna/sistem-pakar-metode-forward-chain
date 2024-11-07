-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 11:13 AM
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
-- Database: `db_spfc`
--

-- --------------------------------------------------------

--
-- Table structure for table `basis_aturan`
--

CREATE TABLE `basis_aturan` (
  `idaturan` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basis_aturan`
--

INSERT INTO `basis_aturan` (`idaturan`, `idpenyakit`) VALUES
(11, 4),
(12, 3),
(13, 2),
(14, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_basis_aturan`
--

CREATE TABLE `detail_basis_aturan` (
  `idaturan` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_basis_aturan`
--

INSERT INTO `detail_basis_aturan` (`idaturan`, `idgejala`) VALUES
(11, 5),
(11, 7),
(12, 5),
(12, 7),
(12, 9),
(12, 4),
(12, 6),
(12, 8),
(12, 10),
(1, 4),
(1, 5),
(2, 4),
(2, 5),
(3, 4),
(3, 5),
(4, 4),
(4, 5),
(5, 4),
(5, 5),
(6, 4),
(6, 5),
(7, 4),
(7, 5),
(8, 6),
(8, 7),
(13, 4),
(13, 10),
(9, 4),
(9, 10),
(14, 6),
(14, 8),
(10, 6),
(10, 8),
(11, 4),
(11, 5),
(12, 4),
(12, 5),
(13, 6),
(13, 7),
(14, 9),
(14, 10);

-- --------------------------------------------------------

--
-- Table structure for table `detail_konsultasi`
--

CREATE TABLE `detail_konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_konsultasi`
--

INSERT INTO `detail_konsultasi` (`idkonsultasi`, `idgejala`) VALUES
(18, 5),
(18, 7),
(19, 4),
(19, 5),
(19, 9),
(20, 4),
(20, 5),
(20, 9),
(21, 5),
(21, 7),
(22, 4),
(22, 6),
(22, 8),
(22, 10),
(23, 6),
(23, 7),
(23, 9),
(24, 5),
(25, 4),
(25, 6),
(25, 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyakit`
--

CREATE TABLE `detail_penyakit` (
  `idkonsultasi` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL,
  `persentase` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penyakit`
--

INSERT INTO `detail_penyakit` (`idkonsultasi`, `idpenyakit`, `persentase`) VALUES
(18, 2, 25),
(18, 3, 33),
(18, 4, 75),
(19, 2, 25),
(19, 3, 56),
(19, 4, 75),
(19, 5, 25),
(20, 2, 25),
(20, 3, 56),
(20, 4, 75),
(20, 5, 25),
(21, 2, 25),
(21, 3, 33),
(21, 4, 75),
(22, 2, 75),
(22, 3, 56),
(22, 4, 25),
(22, 5, 75),
(23, 2, 50),
(23, 3, 33),
(23, 4, 25),
(23, 5, 50),
(24, 3, 22),
(24, 4, 50),
(25, 2, 50),
(25, 3, 44),
(25, 4, 25),
(25, 5, 50);

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `nmgejala` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`idgejala`, `nmgejala`) VALUES
(4, 'Penglihatan Hilang'),
(5, 'Penurunan penglihatan warna'),
(6, 'Perasaan terbakar'),
(7, 'Perubahan penglihatan'),
(8, 'Sakit kepala'),
(9, 'Sulit melihat dimalam hari'),
(10, 'Terjadi peningkatan tekanan pada mata');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `idkonsultasi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`idkonsultasi`, `tanggal`, `nama`) VALUES
(18, '2024-10-30', 'Rangga'),
(19, '2024-10-30', 'Baron'),
(20, '2024-10-30', 'Qiswa'),
(22, '2024-10-30', 'Andri'),
(23, '2024-10-30', 'Hana'),
(24, '2024-10-30', 'Samsul'),
(25, '2024-11-07', 'Diyas');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `idpenyakit` int(11) NOT NULL,
  `nmpenyakit` varchar(200) NOT NULL,
  `keterangan` text NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`idpenyakit`, `nmpenyakit`, `keterangan`, `solusi`) VALUES
(2, 'Gagal Jantung', 'Disebabkan karena penyumbatan pada pembuluh darah jantung', 'Operasi'),
(3, 'Glukoma', 'Penyakit yang menyerang optik mata sehingga dapat menyebabkan kebutaan', 'Operasi laser atau operasi mata'),
(4, 'Katarak', 'Penumpukkan lemak pada lensa mata sehingga menyebabkan penglihatan kabur', 'Operasi pengangkatan lemak pada lensa mata'),
(5, 'Mata Kering', 'Kekurangan cairan pada mata sehingga udara berkontak langsung dengan mata', 'Penggunaan obat tetes mata');

-- --------------------------------------------------------

--
-- Table structure for table `persentase`
--

CREATE TABLE `persentase` (
  `idkonsultasi` int(11) NOT NULL,
  `idpenyakit` int(11) NOT NULL,
  `persentase` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `username`, `password`, `role`) VALUES
(2, 'Mimin', '202cb962ac59075b964b07152d234b70', 'admin'),
(3, 'Pashen', '202cb962ac59075b964b07152d234b70', 'pasien'),
(4, 'Doktah', '202cb962ac59075b964b07152d234b70', 'dokter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basis_aturan`
--
ALTER TABLE `basis_aturan`
  ADD PRIMARY KEY (`idaturan`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`idkonsultasi`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`idpenyakit`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basis_aturan`
--
ALTER TABLE `basis_aturan`
  MODIFY `idaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `idkonsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `idpenyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
