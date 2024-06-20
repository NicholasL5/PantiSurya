-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 09:01 AM
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
(4, 'admin', '$2y$10$gRFDjBVTlkzltOIqR.E30u3ORljWTsVbGKNt.TfA6ENTsOi//ik1.', '2024-03-24', '2024-06-20', 0),
(6, 'nice', '$2y$10$pcubK.aIK/YrnJKRjQlQDuJKMulGy26nbWUwOmjqKY7ATvXHzO4l6', '2024-05-08', '2024-06-19', 0),
(7, 'asik', '$2y$10$OY62rBeR96KFJQmJuFvUj.njVk/.kTHzyO8HUZUjxnlzTrbmdYFRO', '2024-05-22', '2024-05-22', 0),
(9, 'tes', '$2y$10$Mc60d24sOCUo.vCr/1u0/eVlt6h7M3D3GnvpQ/U6onsNoROvbXT0e', '2024-06-20', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `data_pondokkan`
--

CREATE TABLE `data_pondokkan` (
  `id` int(11) NOT NULL,
  `penduduk_id` int(11) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `ruangan` varchar(30) NOT NULL,
  `status` int(11) NOT NULL,
  `image_path` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `tagihan_date` date NOT NULL,
  `kwitansi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(9, '../asset/pp/6666d83d58519.jpg', '2024-06-10');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `date` date NOT NULL,
  `image_path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `description`, `date`, `image_path`) VALUES
(1, 'Ibadah Paskah 2023', 'Kegiatan Ibadah Paskah yang dilaksanakan tanggal 31 Maret 2024 yang lalu dihadiri oleh semua penghuni Panti Surya. Ibadah berlangsung dengan baik dari awal hingga akhirnya. Semua berkumpul bersama menikmati hari raya Paskah.', '2023-10-10', '../Front-PantiSurya/images/berita/6668040272ccd.jpg'),
(2, 'Ibadah Natal 2023', 'Kegiatan Ibadah Natal yang dilaksanakan tanggal 25 Desember 2023 yang lalu dihadiri oleh semua penghuni Panti Surya. Ibadah berlangsung dengan baik dari awal hingga akhirnya. Semua berkumpul bersama menikmati hari raya Natal.', '2023-12-25', '../Front-PantiSurya/images/berita/6668040a618f1.jpg'),
(3, 'aaaa', 'aaaa', '2024-06-11', '../Front-PantiSurya/images/berita/6668039e8e8d7.jpg'),
(4, 'safa', 'safa', '2024-06-11', '../Front-PantiSurya/images/berita/666804885cad9.jpg'),
(7, 'bb', 'bb', '2024-06-11', '../Front-PantiSurya/images/berita/666804b8aef05.jpg'),
(8, 'aswew', 'aesdaw', '2024-06-11', '../Front-PantiSurya/images/berita/6668084383743.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `keuangan_pondokkan` int(11) NOT NULL,
  `keuangan_tabungan` int(11) NOT NULL,
  `keuangan_obat` int(11) NOT NULL,
  `keuangan_total` int(11) NOT NULL,
  `profile_picture` varchar(100) NOT NULL,
  `KTP` varchar(100) DEFAULT NULL,
  `KK` varchar(100) DEFAULT NULL,
  `BPJS` varchar(100) DEFAULT NULL,
  `deposit` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `tempat_lahir` varchar(100) NOT NULL DEFAULT '',
  `agama` varchar(15) NOT NULL DEFAULT ' ',
  `tanggal_lahir` date DEFAULT NULL,
  `nomor_induk` int(11) NOT NULL DEFAULT 0,
  `kwitansi_path` varchar(300) DEFAULT NULL,
  `bukti_path` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `alamat`, `tanggal_masuk`, `keuangan_pondokkan`, `keuangan_tabungan`, `keuangan_obat`, `keuangan_total`, `profile_picture`, `KTP`, `KK`, `BPJS`, `deposit`, `status`, `tempat_lahir`, `agama`, `tanggal_lahir`, `nomor_induk`, `kwitansi_path`, `bukti_path`) VALUES
(70, 'Sie Giok Siek', 'Taman Surya Agung A/2, Wage, Sidoarjo', '2024-06-18', 0, 0, 0, 0, '', 'images/ktp/WhatsApp Image 2024-06-17 at 18.10.01.jpeg', 'images/kk/WhatsApp Image 2024-06-17 at 18.10.01 (1).jpeg', 'images/bpjs/WhatsApp Image 2024-06-17 at 18.10.00 (1).jpeg', 5000000, 0, 'Surabaya', 'Buddha', '1940-12-15', 443, NULL, 'Base_Color_Black_CP.png'),
(71, 'Tioso Sekarwati', 'Jl. Mojoarum VI/17 i Kav 6. Surabaya', '2024-02-05', 0, 0, 0, 0, '', 'images/ktp/ktp.jpg', 'images/kk/kk.jpg', 'images/bpjs/bpjs.jpg', 5000000, 0, 'Blitar', 'Kristen', '1942-11-15', 503, NULL, NULL),
(75, 'Gunadi Wongso', 'Lawang Seketeng 2/9-11', '2019-12-01', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Blitar', 'Buddha', '1935-04-16', 454, NULL, NULL),
(76, 'Liliana Leonie', 'Wisma Permai Barat 2', '2021-02-15', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Singaraja', 'Kristen', '1932-07-06', 460, NULL, NULL),
(77, 'Muid', 'Jl. Bekip LR Hanan No.2122', '2021-06-09', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Palembang', 'Kristen', '1954-03-01', 461, NULL, NULL),
(78, 'Sudini Warti', 'Pandegiling 223-C', '2021-11-01', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1939-08-03', 463, NULL, NULL),
(79, 'Evie Susilowati', '-', '2021-11-08', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Blitar', 'Kristen', '1931-05-15', 464, NULL, NULL),
(80, 'Wuryaningsih', 'Jl. Pucangan 3', '2022-02-08', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Malang', 'Islam', '1947-03-14', 468, NULL, NULL),
(81, 'Paulus Mustari', 'Wiguna Timur Regency 5/4', '2022-03-01', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Kediri', 'Katolik', '1945-07-30', 470, NULL, NULL),
(82, 'Poniti', 'Sromo Barat 1/7 Pacar Keling, Kejayan, Pasuruan', '2022-03-05', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Pasuruan', 'Kristen', '1962-08-18', 471, NULL, NULL),
(85, 'Lilijana Lumanto', 'Simolawang Baru 5/29, Surabaya', '2022-03-07', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1962-10-03', 472, NULL, NULL),
(86, 'Go Bjie Tju', 'Jl. Mastrip No.106', '2022-04-02', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Mojokerto', 'Kristen', '1952-09-08', 473, NULL, NULL),
(87, 'R. Anton Susilo Murti', 'Kedung Pengkol 6/35', '2022-04-30', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Yogyakarta', 'Katolik', '1955-03-31', 474, NULL, NULL),
(88, 'Lisa Nuagraha Hadi Kusuma', 'Tenggilis Mejoyo Selatan 3/42', '2022-05-04', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1951-12-28', 475, NULL, NULL),
(89, 'Pepita', 'Jedong 56', '2022-05-20', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1936-12-19', 476, NULL, NULL),
(90, 'Eviniwati', 'Kapasan Dalam 1/17, Surabaya', '2022-05-20', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1939-06-30', 477, NULL, NULL),
(91, 'Adi Wibowo', 'Perum JPS Blok J-03', '2022-06-12', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Banyuwangi', 'Buddha', '1949-09-12', 481, NULL, NULL),
(92, 'Sutinah', 'Dusun Sonogunting', '2022-06-20', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Madiun', 'Islam', '1946-12-31', 482, NULL, NULL),
(93, 'Malia Inina', 'Darmo Permai Selatan 11/11 ', '2022-07-04', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Lumajang', 'Kristen', '1942-03-21', 484, NULL, NULL),
(94, 'Liman Waty', 'Granting Baru Tengah 24', '2022-07-07', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1951-03-05', 485, NULL, NULL),
(95, 'Winardi', 'Kalongan Kidul 02/18-A', '2022-10-11', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Blora', 'Kristen', '1946-07-23', 486, NULL, NULL),
(96, 'Jhon Alexander Kamalo', 'Perum Puri Bagus Harmoni Kota', '2022-01-21', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Palopo', 'Katolik', '1946-11-18', 492, NULL, NULL),
(97, 'Yustini', 'Perum Puri Bagus Harmoni Kota', '2022-01-21', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Pati', 'Katolik', '1952-06-23', 493, NULL, NULL),
(98, 'Go Sioe Lan', '-', '2023-05-20', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, '-', 'Kristen', '1942-01-03', 494, NULL, NULL),
(99, 'Tjwa Yunisia', 'Jl. Caman Barat Sampit', '2023-07-10', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Kotawaringin', 'Kristen', '1943-07-30', 495, NULL, NULL),
(100, 'Tik\'Ah', 'Wonorejo 1/96', '2023-07-15', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Lamongan', 'Kristen', '1945-02-17', 496, NULL, NULL),
(101, 'Wiwik Suharti', 'Jl. Petemon 2/40-B ', '2023-08-14', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Mojokerto', 'Kristen', '1953-09-14', 498, NULL, NULL),
(102, 'Lea Kristanti', 'Jl. Argomulyo Mukti Timur I No.14', '2023-10-16', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Tegal', 'Kristen', '1953-09-05', 500, NULL, NULL),
(103, 'Njo Tjin Heng / Henni', 'Jl. Penghela', '2023-11-14', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1946-10-22', 501, NULL, NULL),
(104, 'Muryani', 'Candi Lempung 48-A / 54 5/9 Lontar', '2024-02-15', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Surabaya', 'Kristen', '1942-05-15', 504, NULL, NULL),
(105, 'Gustini Niengsih', 'Jl. Golf Avenue Blok GV 6/10', '2024-03-18', 0, 0, 0, 0, '', NULL, NULL, NULL, 5000000, 0, 'Banyuwangi', 'Kristen', '1942-01-11', 505, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rekam_medis`
--

CREATE TABLE `rekam_medis` (
  `penduduk_id` int(11) NOT NULL,
  `pengobatan_id` int(11) NOT NULL,
  `deskripsi` varchar(500) DEFAULT NULL,
  `jenis` varchar(100) NOT NULL,
  `obat` varchar(100) NOT NULL,
  `dosis` int(11) NOT NULL,
  `tagihan` int(15) NOT NULL,
  `tanggal_berobat` date NOT NULL,
  `sudah_bayar` tinyint(1) DEFAULT 0,
  `image_path` varchar(100) DEFAULT NULL,
  `input_date` date DEFAULT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `kwitansi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `saldo` int(11) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `image_path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

CREATE TABLE `wali` (
  `wali_id` int(11) NOT NULL,
  `penduduk_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `agama` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `hubungan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wali`
--

INSERT INTO `wali` (`wali_id`, `penduduk_id`, `nama`, `alamat`, `agama`, `no_telp`, `pekerjaan`, `hubungan`) VALUES
(19, 70, 'Kartika Ayu Sidharta', 'Taman Surya Agung A/2, Wage, Sidoarjo', '1', '081212126032', 'Karyawan Swasta', 'Bibi'),
(20, 70, 'Sie May Tjie', 'Jalan Lingga no 6, Surabaya', '1', '085204987955', 'Karyawan Swasta', 'Bibi'),
(21, 71, 'Martino Dwidjo P.M', 'Jl. Wonorejo Asri XIX / 31, Surabaya', '1', '081230860585', 'Driver Taxi online', 'anak'),
(22, 71, 'Lusi Setyawati', 'Jl. Kalijudan III/34A, Surabaya', '1', '085895997553', 'UMKM', 'Adik Ipar'),
(23, 75, 'Ibu Sullivin', 'Jl. Dharma Indah Regensi F-11', '-', '082338404633', '-', 'Kakak Ipar'),
(24, 75, 'Aziz Wirawan', 'Jl. Sutorejo Prima Selatan 5/5, Surabaya', '-', '087853679700', '-', 'Saudara Sepupu'),
(25, 75, 'Anyuk', '-', '-', '087852186366', '-', 'Anak'),
(26, 75, 'Afi', '-', '-', '083874468859', '-', 'Anak');

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
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_induk` (`nomor_induk`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `data_pondokkan`
--
ALTER TABLE `data_pondokkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `rekam_medis`
--
ALTER TABLE `rekam_medis`
  MODIFY `pengobatan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tabungan`
--
ALTER TABLE `tabungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wali`
--
ALTER TABLE `wali`
  MODIFY `wali_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
