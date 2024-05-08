-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 05:56 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pantisurya`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `last_access` date DEFAULT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `date`, `last_access`, `role`) VALUES
(4, 'admin', '$2y$10$gRFDjBVTlkzltOIqR.E30u3ORljWTsVbGKNt.TfA6ENTsOi//ik1.', '2024-03-24', '2024-05-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `date`) VALUES
(1, 'Ibadah Paskah 2023', 'Kegiatan Ibadah Paskah yang dilaksanakan tanggal 31 Maret 2024 yang lalu dihadiri oleh semua penghuni Panti Surya. Ibadah berlangsung dengan baik dari awal hingga akhirnya. Semua berkumpul bersama menikmati hari raya Paskah.', '2023-10-10'),
(2, 'Ibadah Natal 2023', 'Kegiatan Ibadah Natal yang dilaksanakan tanggal 25 Desember 2023 yang lalu dihadiri oleh semua penghuni Panti Surya. Ibadah berlangsung dengan baik dari awal hingga akhirnya. Semua berkumpul bersama menikmati hari raya Natal.', '2023-12-25'),
(4, 'abc', 'abc', '2024-04-17'),
(7, 'aaabbb', 'aaabbb', '2024-04-18'),
(9, 'nnn', 'nnn', '2024-05-02'),
(10, 'lll', 'lll', '2024-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `pengobatan_terakhir` date DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `notelp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `alamat`, `pengobatan_terakhir`, `email`, `notelp`) VALUES
(4, 'Emily Williams', '101 Pine Street', '2024-03-14', 'emily.williams@example.com', '7894561230'),
(5, 'Christopher Brown', '234 Maple Street', '2024-02-25', 'christopher.brown@example.com', '9870123456'),
(7, 'David Garcia', '890 Cedar Street', '2024-02-29', 'david.garcia@example.com', '3218904567'),
(9, 'James Rodriguez', '222 Walnut Street', '2024-03-06', 'james.rodriguez@example.com', '4567890123'),
(10, 'Sarah Lee', '333 Pineapple Street', '2024-03-22', 'sarah.lee@example.com', '6543210987'),
(11, 'Daniel Lopez', '444 Grape Street', '2024-03-08', 'daniel.lopez@example.com', '3210987654'),
(12, 'Megan Harris', '555 Orange Street', '2024-03-08', 'megan.harris@example.com', '8901234567'),
(13, 'Ryan Clark', '666 Lemon Street', '2024-03-22', 'ryan.clark@example.com', '4567890123'),
(14, 'Jennifer Young', '777 Lime Street', '2024-02-29', 'jennifer.young@example.com', '1230987654'),
(15, 'Joshua Turner', '888 Strawberry Street', '2024-02-28', 'joshua.turner@example.com', '3216540987'),
(16, 'Nicole Moore', '999 Raspberry Street', '2024-02-29', 'nicole.moore@example.com', '7890123456'),
(17, 'Jason Hill', '1010 Blueberry Street', '2024-03-08', 'jason.hill@example.com', '6789012345'),
(18, 'Michelle Scott', '1111 Blackberry Street', '2024-03-12', 'michelle.scott@example.com', '7890123456'),
(19, 'Justin Green', '1212 Cranberry Street', '2024-03-12', 'justin.green@example.com', '5678901234'),
(20, 'Rachel Carter', '1313 Raspberry Street', '2024-02-25', 'rachel.carter@example.com', '8901234567'),
(21, 'Brandon King', '1414 Strawberry Street', '2024-03-12', 'brandon.king@example.com', '6789012345'),
(22, 'Melissa White', '1515 Blueberry Street', '2024-03-14', 'melissa.white@example.com', '5678901234'),
(23, 'Kevin Hall', '1616 Blackberry Street', '2024-03-08', 'kevin.hall@example.com', '7890123456'),
(24, 'Stephanie Adams', '1717 Cranberry Street', '2024-03-04', 'stephanie.adams@example.com', '6789012345'),
(25, 'Matthew Stewart', '1818 Raspberry Street', '2024-02-29', 'matthew.stewart@example.com', '8901234567'),
(26, 'Ashley Parker', '1919 Strawberry Street', '2024-03-23', 'ashley.parker@example.com', '5678901234'),
(27, 'Erica Evans', '2020 Blueberry Street', '2024-02-27', 'erica.evans@example.com', '6789012345'),
(28, 'Brian Cook', '2121 Blackberry Street', '2024-03-18', 'brian.cook@example.com', '7890123456'),
(29, 'Rebecca Murphy', '2222 Cranberry Street', '2024-03-11', 'rebecca.murphy@example.com', '6789012345');

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `penduduk_id` int(11) NOT NULL,
  `pengobatan_id` int(11) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `obat` varchar(100) NOT NULL,
  `dosis` int(11) NOT NULL,
  `tanggal_berobat` date NOT NULL,
  `sudah_bayar` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekam_medis`
--

INSERT INTO `rekam_medis` (`penduduk_id`, `pengobatan_id`, `deskripsi`, `jenis`, `obat`, `dosis`, `tanggal_berobat`, `sudah_bayar`) VALUES
(4, 1, 'obat1', 'pengobatan', 'panadol', 1, '2024-04-17', 0),
(4, 2, 'obat2', 'pengobatan', 'neozep', 2, '2023-09-16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD PRIMARY KEY (`pengobatan_id`),
  ADD KEY `penduduk_id` (`penduduk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `pengobatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
