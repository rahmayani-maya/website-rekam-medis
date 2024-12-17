-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2024 at 04:02 PM
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
-- Database: `db_rekamedis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_obat`
--

CREATE TABLE `tbl_obat` (
  `id` int NOT NULL,
  `nama` varchar(25) NOT NULL,
  `kegunaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_obat`
--

INSERT INTO `tbl_obat` (`id`, `nama`, `kegunaan`) VALUES
(2, 'Paracetamol', 'Demam &amp; Sakit Kepala'),
(3, 'Amoxicillin', 'Infeksi Bakter'),
(4, 'Antihistamin', 'Alergi'),
(5, 'Promag', 'Asam Lambung'),
(6, 'Entrostop', 'Diare'),
(7, 'Betadine', 'Infeksi Kulit Ringan'),
(8, 'Alprazolam', 'Imsomnia &amp; Kecemasan'),
(9, 'Counterpain', 'Nyeri Otot &amp; Sendi'),
(13, 'Antalgin', 'Obat Nyeri'),
(14, 'Alpara', 'Flu Ringan'),
(15, 'Curcuma Tab', 'Vitamin'),
(16, 'Dextral', 'Batuk &amp; Pilek'),
(17, 'Anvomer', 'Sesak Nafas'),
(18, 'Baycuten', 'Obat Mata'),
(19, 'Bufacaryl', 'Radang Tenggorokan'),
(20, 'Gliseril Glukolat', 'Batuk Berdahak'),
(21, 'Ranitidin', 'Magh'),
(22, 'Mikonazol', 'Salep Luka'),
(23, 'Spasminal', 'Nyeri Perut &amp; Mules');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pasien`
--

CREATE TABLE `tbl_pasien` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('P','W') NOT NULL,
  `telpon` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id`, `nama`, `tgl_lahir`, `gender`, `telpon`, `alamat`) VALUES
('241217071830', 'Angelina Jolie', '2009-01-21', 'W', '082103923841', 'Sungai Sibam'),
('241217072157', 'Ariana Grande', '2008-12-09', 'W', '082132965818', 'Parit Indah'),
('241217072253', 'Billie Eilish', '2008-05-20', 'W', '082174502981', 'Perhentian Raja'),
('241217072435', 'Sam Smith', '2009-07-09', 'P', '082199943210', 'Arengka'),
('241217072909', 'Bruno Mars', '2008-09-10', 'P', '082199310645', 'Marpoyan Damai'),
('241217073000', 'Rhoma Irama', '2009-01-04', 'P', '081394112405', 'Tarai Gading'),
('241217073223', 'Dean Lewis', '2008-09-07', 'P', '081937216281', 'Simpang Tiga'),
('241217073326', 'Shawn Mendes', '2009-12-07', 'P', '081293310128', 'Sudirman Ujung'),
('241217073442', 'Daniel Caesar', '2009-02-10', 'P', '082621829375', 'Arifin Ahmad'),
('241217073523', 'Sabrina Carpenter', '2009-01-01', 'W', '081387922103', 'Rumbai'),
('241217073557', 'Conan Gray', '2009-12-09', 'P', '082109345686', 'Tapung Hilir'),
('241217073649', 'Sal Priadi', '2009-07-07', 'P', '082168661201', 'Lubuk Sepakat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rekamedis`
--

CREATE TABLE `tbl_rekamedis` (
  `no_rm` varchar(15) NOT NULL,
  `tgl_rm` date NOT NULL,
  `id_pasien` varchar(20) NOT NULL,
  `keluhan` text NOT NULL,
  `id_dokter` int NOT NULL,
  `diagnosa` text NOT NULL,
  `obat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_rekamedis`
--

INSERT INTO `tbl_rekamedis` (`no_rm`, `tgl_rm`, `id_pasien`, `keluhan`, `id_dokter`, `diagnosa`, `obat`) VALUES
('RM-001-171224', '2024-12-17', '241217071830', 'Badan Panas', 4, 'Demam Ringan', 'Paracetamol'),
('RM-002-171224', '2024-12-17', '241217072157', 'Gatal di seluruh badan', 4, 'Alergi Dingin', 'Antihistamin'),
('RM-003-171224', '2024-12-17', '241217072253', 'Sakit Kepala, Meriang', 4, 'Demam', 'Paracetamol, Amoxicillin'),
('RM-004-171224', '2024-12-17', '241217072435', 'Perut terasa kembung', 4, 'Masuk Angin', 'Anvomer'),
('RM-005-171224', '2024-12-17', '241217072909', 'Sakit gigi', 4, 'Sakit gigi', 'Alprazolam'),
('RM-006-171224', '2024-12-17', '241217073000', 'Pegal pegal', 4, 'Pegal pegal', 'Counterpain'),
('RM-007-171224', '2024-12-17', '241217072909', 'Flu', 4, 'Flu', 'Paracetamol'),
('RM-008-171224', '2024-12-17', '241217072909', 'Batuk Berdahak', 4, 'Batuk', 'Alpara'),
('RM-009-171224', '2024-12-17', '241217073523', 'Muntah muntah', 4, 'Masuk angin', 'Bufacaryl'),
('RM-010-171224', '2024-12-17', '241217073649', 'Batuk flu', 4, 'Demam', 'Paracetamol, Alprazolam'),
('RM-011-171224', '2024-12-17', '241217072909', 'Masuk Angin', 4, 'Masuk angin', 'Antihistamin, Paracetamol'),
('RM-012-171224', '2024-12-17', '241217073442', 'Diare', 4, 'Keracunan makanan', 'Amoxicillin, Alprazolam, Alprazolam');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jabatan` enum('1','2','3') NOT NULL COMMENT '1=administrator, 2=petugas, 3=dokter',
  `alamat` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `fullname`, `password`, `jabatan`, `alamat`, `gambar`) VALUES
(2, 'maya', 'Rahma Yani', '$2y$10$J..OXzzFdJbAnaQ7GTMtAe4D1jfEIymJLVU4K0VaYggv..HZSq.aa', '1', 'Pekanbaru', '1734268183.mayas.jpg'),
(3, 'rahila', 'Rahila Syifa Khaira', '$2y$10$5zOXeX7f70Fmm388N61wR.KjPJxQRZFkx.AyDR78XthQTalhBLULe', '2', 'Danau Bingkuang', '1734267921.img2.jpeg'),
(4, 'tia', 'Cendikia Arini, S.Kep.', '$2y$10$EuTBOFOuI6bsbWt4kI3V6uyo0zJixQlPUq7CJXfbhz09yACB3NYTW', '3', 'Kubang Raya', '1734386786.WhatsApp Image 2024-09-25 at 08.57.12 (2).jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pasien`
--
ALTER TABLE `tbl_pasien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rekamedis`
--
ALTER TABLE `tbl_rekamedis`
  ADD PRIMARY KEY (`no_rm`),
  ADD KEY `id_pasien` (`id_pasien`),
  ADD KEY `id_dokter` (`id_dokter`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_obat`
--
ALTER TABLE `tbl_obat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_rekamedis`
--
ALTER TABLE `tbl_rekamedis`
  ADD CONSTRAINT `tbl_rekamedis_ibfk_1` FOREIGN KEY (`id_pasien`) REFERENCES `tbl_pasien` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_rekamedis_ibfk_2` FOREIGN KEY (`id_dokter`) REFERENCES `tbl_user` (`userid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
