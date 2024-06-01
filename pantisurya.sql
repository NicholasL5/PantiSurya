-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 01:12 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pondokkan`
--
ALTER TABLE `data_pondokkan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pondokkan`
--
ALTER TABLE `data_pondokkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
