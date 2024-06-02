-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 05:14 PM
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
(4, 'admin', '$2y$10$gRFDjBVTlkzltOIqR.E30u3ORljWTsVbGKNt.TfA6ENTsOi//ik1.', '2024-03-24', '2024-06-02', 0),
(6, 'nice', '$2y$10$pcubK.aIK/YrnJKRjQlQDuJKMulGy26nbWUwOmjqKY7ATvXHzO4l6', '2024-05-08', '2024-05-14', 0),
(7, 'asik', '$2y$10$OY62rBeR96KFJQmJuFvUj.njVk/.kTHzyO8HUZUjxnlzTrbmdYFRO', '2024-05-22', '2024-05-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pondokkan`
--

CREATE TABLE `data_pondokkan` (
  `id` int(11) NOT NULL,
  `penduduk_id` int(11) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `tagihan_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_pondokkan`
--

INSERT INTO `data_pondokkan` (`id`, `penduduk_id`, `tagihan`, `status`, `image_path`, `input_date`, `tagihan_date`) VALUES
(16, 4, 150000, 0, NULL, NULL, '2024-06-01'),
(17, 4, 200000, 1, 'keuangan/pondokkan/665b01f7b96aa.jpg', '2024-06-01', '2024-06-01'),
(18, 4, 300000, 1, 'keuangan/pondokkan/665b01e5d6e6b.jpg', '2024-06-01', '2024-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `path_picture` varchar(100) NOT NULL,
  `input_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `path_picture`, `input_date`) VALUES
(1, '../asset/pp/6645f34ad6bd1.jpg', '2024-05-16'),
(2, '../asset/pp/6645f4f95d949.jpg', '2024-05-16'),
(3, '../asset/pp/6645f66113c5f.jpg', '2024-05-16'),
(4, '../asset/pp/664609474f254.jpg', '2024-05-16'),
(5, '../asset/pp/664b1e928abf9.jpg', '2024-05-20');

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
  `tanggal_masuk` date DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `notelp` varchar(15) NOT NULL,
  `keuangan_pondokkan` int(11) NOT NULL,
  `keuangan_tabungan` int(11) NOT NULL,
  `keuangan_obat` int(11) NOT NULL,
  `keuangan_total` int(11) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `KTP` longblob NOT NULL,
  `KK` longblob NOT NULL,
  `BPJS` longblob NOT NULL,
  `keuangan_deposit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `alamat`, `tanggal_masuk`, `email`, `notelp`, `keuangan_pondokkan`, `keuangan_tabungan`, `keuangan_obat`, `keuangan_total`, `profile_picture`, `KTP`, `KK`, `BPJS`, `keuangan_deposit`) VALUES
(4, 'Emily Williams', '111 Pine Street', '2024-03-14', 'emily.williams@example.com', '7894561230', 150000, 1109000, 21312, 0, '', 0x696d616765732f426173655f436f6c6f725f426c61636b5f43502e706e67, '', '', 0),
(5, 'Christopher Brown', '234 Maple Street', '2024-02-25', 'christopher.brown@example.com', '9870123456', 121, 2000000, 5, 0, '', '', '', '', 0),
(7, 'David Garcia', '890 Cedar Street', '2024-02-29', 'david.garcia@example.com', '3218904567', 20, 0, 0, 0, '', 0x696d616765732f6d617872657364656661756c742e6a7067, 0x696d616765732f53637265656e73686f7420323032342d30352d3133203231353935332e706e67, 0x696d616765732f53637265656e73686f7420323032342d30352d3032203133343633382e706e67, 0),
(9, 'James Rodriguez', '222 Walnut Street', '2024-03-06', 'james.rodriguez@example.com', '4567890123', 0, 0, 0, 0, '', '', '', '', 0),
(10, 'Sarah Lee', '333 Pineapple Street', '2024-03-22', 'sarah.lee@example.com', '6543210987', 1, 0, 0, 0, '', '', '', '', 0),
(11, 'Daniel Lopez', '444 Grape Street', '2024-03-08', 'daniel.lopez@example.com', '3210987654', 0, 0, 0, 0, '', '', '', '', 0),
(12, 'Megan Harris', '555 Orange Street', '2024-03-08', 'megan.harris@example.com', '8901234567', 0, 0, 0, 0, '', '', '', '', 0),
(13, 'Ryan Clark', '666 Lemon Street', '2024-03-22', 'ryan.clark@example.com', '4567890123', 0, 0, 0, 0, '', '', '', '', 0),
(14, 'Jennifer Young', '777 Lime Street', '2024-02-29', 'jennifer.young@example.com', '1230987654', 0, 0, 0, 0, '', '', '', '', 0),
(15, 'Joshua Turner', '888 Strawberry Street', '2024-02-28', 'joshua.turner@example.com', '3216540987', 0, 0, 0, 0, '', '', '', '', 0),
(16, 'Nicole Moore', '999 Raspberry Street', '2024-02-29', 'nicole.moore@example.com', '7890123456', 0, 0, 0, 0, '', '', '', '', 0),
(17, 'Jason Hill', '1010 Blueberry Street', '2024-03-08', 'jason.hill@example.com', '6789012345', 0, 0, 0, 0, '', '', '', '', 0),
(18, 'Michelle Scott', '1111 Blackberry Street', '2024-03-12', 'michelle.scott@example.com', '7890123456', 0, 0, 0, 0, '', '', '', '', 0),
(19, 'Justin Green', '1212 Cranberry Street', '2024-03-12', 'justin.green@example.com', '5678901234', 0, 0, 0, 0, '', '', '', '', 0),
(20, 'Rachel Carter', '1313 Raspberry Street', '2024-02-25', 'rachel.carter@example.com', '8901234567', 0, 0, 0, 0, '', '', '', '', 0),
(21, 'Brandon King', '1414 Strawberry Street', '2024-03-12', 'brandon.king@example.com', '6789012345', 0, 0, 0, 0, '', '', '', '', 0),
(22, 'Melissa White', '1515 Blueberry Street', '2024-03-14', 'melissa.white@example.com', '5678901234', 0, 0, 0, 0, '', '', '', '', 0),
(23, 'Kevin Hall', '1616 Blackberry Street', '2024-03-08', 'kevin.hall@example.com', '7890123456', 0, 0, 0, 0, '', '', '', '', 0),
(24, 'Stephanie Adams', '1717 Cranberry Street', '2024-03-04', 'stephanie.adams@example.com', '6789012345', 0, 0, 0, 0, '', '', '', '', 0),
(25, 'Matthew Stewart', '1818 Raspberry Street', '2024-02-29', 'matthew.stewart@example.com', '8901234567', 0, 0, 0, 0, '', '', '', '', 0),
(26, 'Ashley Parker', '1919 Strawberry Street', '2024-03-23', 'ashley.parker@example.com', '5678901234', 0, 0, 0, 0, '', '', '', '', 0),
(27, 'Erica Evans', '2020 Blueberry Street', '2024-02-27', 'erica.evans@example.com', '6789012345', 0, 0, 0, 0, '', '', '', '', 0),
(28, 'Brian Cook', '2121 Blackberry Street', '2024-03-18', 'brian.cook@example.com', '7890123456', 0, 0, 0, 0, '', '', '', '', 0),
(29, 'Rebecca Murphy', '2222 Cranberry Street', '2024-03-11', 'rebecca.murphy@example.com', '6789012345', 0, 0, 0, 0, '', '', '', '', 0),
(43, 'nathan', 'wiyung', '2024-05-16', 'nathangg@gmail.com', '081369369', 0, 0, 0, 0, 'asset/pp/66460f957679b.jpg', '', '', '', 0);

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
(4, 1, 'obat1', 'pengobatan', 'panadol', 1, '2024-04-17', 1),
(4, 2, 'obat2', 'pengobatan', 'neozep', 2, '2023-09-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) NOT NULL,
  `id_penduduk` int(11) NOT NULL,
  `tipe_transaksi` varchar(5) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id`, `id_penduduk`, `tipe_transaksi`, `jumlah`, `tanggal_transaksi`, `saldo`) VALUES
(1, 4, 'debit', 200000, '2024-05-29', 200000),
(2, 5, 'debit', 2000000, '2024-05-29', 2000000),
(3, 4, 'kredi', -11000, '2024-05-29', 189000),
(4, 4, 'kredi', -90000, '2024-05-29', 110000),
(5, 4, 'debit', 1000000, '2024-05-29', 1110000),
(6, 4, 'kredi', -1000, '2024-06-02', 1109000);

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `wali_id` int(11) NOT NULL,
  `penduduk_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tempat_tinggal` varchar(100) DEFAULT NULL,
  `agama` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_pondokkan`
--
ALTER TABLE `data_pondokkan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
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
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tabungan_penduduk` (`id_penduduk`);

--
-- Indexes for table `wali`
--
ALTER TABLE `wali`
  ADD PRIMARY KEY (`wali_id`),
  ADD KEY `penduduk_id` (`penduduk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `data_pondokkan`
--
ALTER TABLE `data_pondokkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `pengobatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wali`
--
ALTER TABLE `wali`
  MODIFY `wali_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  ADD CONSTRAINT `rekam_medis_ibfk_1` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`);

--
-- Constraints for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `fk_tabungan_penduduk` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id`);

--
-- Constraints for table `wali`
--
ALTER TABLE `wali`
  ADD CONSTRAINT `wali_ibfk_1` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
