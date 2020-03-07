-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 07:21 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uno`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access_token`
--

INSERT INTO `access_token` (`id`, `user_id`, `token`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'Tftywau1yrkPGrq58ZMoDqROoBCX8SwW54zjWxbc', 2, 0, 0, NULL, 2147483647),
(57, 13, 'shJZhwSogUwJ70SrdwopxZnlkGyUQhacCwyfEq2F', 1, 0, 0, NULL, 1583561786);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `id` int(11) NOT NULL,
  `kelas_nama` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`id`, `kelas_nama`) VALUES
(1, 'X MIPA 1'),
(2, 'X MIPA 2'),
(3, 'X MIPA 3'),
(4, 'X MIPA 4'),
(5, 'X MIPA 5'),
(6, 'X MIPA 6'),
(7, 'X MIPA 7'),
(8, 'X MIPA 8'),
(9, 'X MIPA 9'),
(10, 'X IPS 1'),
(11, 'X IPS 2'),
(12, 'X IPS 3'),
(13, 'XI MIPA 1'),
(14, 'XI MIPA 2'),
(15, 'XI MIPA 3'),
(16, 'XI MIPA 4'),
(17, 'XI MIPA 5'),
(18, 'XI MIPA 6'),
(19, 'XI MIPA 7'),
(20, 'XI MIPA 8'),
(21, 'XI MIPA 9'),
(22, 'XI IPS 1'),
(23, 'XI IPS 2'),
(24, 'XI IPS 3'),
(25, 'XII MIPA 1'),
(26, 'XII MIPA 2'),
(27, 'XII MIPA 3'),
(28, 'XII MIPA 4'),
(29, 'XII MIPA 5'),
(30, 'XII MIPA 6'),
(31, 'XII MIPA 7'),
(32, 'XII MIPA 8'),
(33, 'XII MIPA 9'),
(34, 'XII MIPA 10'),
(35, 'XII IPS 1'),
(36, 'XII IPS 2'),
(37, 'XII IPS 3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lokasi`
--

CREATE TABLE `tbl_lokasi` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lokasi`
--

INSERT INTO `tbl_lokasi` (`id`, `lokasi`) VALUES
(1, 'Kantin Merdeka'),
(2, 'Kantin Depan'),
(3, 'Kantin Belakang'),
(4, 'Kantin Atas');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengunjung`
--

CREATE TABLE `tbl_pengunjung` (
  `pengunjung_id` int(11) NOT NULL,
  `pengunjung_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `pengunjung_ip` varchar(40) DEFAULT NULL,
  `pengunjung_perangkat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengunjung`
--

INSERT INTO `tbl_pengunjung` (`pengunjung_id`, `pengunjung_tanggal`, `pengunjung_ip`, `pengunjung_perangkat`) VALUES
(930, '2018-08-09 08:04:59', '::1', 'Chrome'),
(931, '2018-11-10 02:47:54', '::1', 'Chrome'),
(932, '2018-11-11 05:12:48', '::1', 'Chrome'),
(933, '2018-11-11 05:12:48', '::1', 'Chrome'),
(934, '2018-11-12 14:31:33', '::1', 'Chrome'),
(935, '2018-11-12 17:03:49', '::1', 'Chrome'),
(936, '2019-01-19 09:13:36', '::1', 'Chrome'),
(937, '2019-01-22 17:08:50', '::1', 'Chrome'),
(938, '2019-01-26 03:43:27', '::1', 'Chrome'),
(939, '2019-05-04 13:36:21', '::1', 'Chrome'),
(940, '2019-05-23 12:48:46', '::1', 'Chrome'),
(941, '2019-05-27 14:57:54', '::1', 'Chrome'),
(942, '2019-07-09 18:51:49', '::1', 'Chrome'),
(943, '2019-07-10 17:48:58', '::1', 'Chrome'),
(944, '2019-07-12 17:51:21', '::1', 'Chrome'),
(945, '2019-08-02 11:37:19', '121', '2'),
(946, '2019-08-02 11:37:33', '1222', 'jkjk'),
(947, '2019-08-02 13:36:41', '::1', 'Chrome'),
(948, '2019-08-03 11:33:06', '::1', 'Chrome'),
(949, '2019-08-03 23:54:52', '::1', 'Chrome'),
(950, '2019-08-31 04:11:54', '::1', 'Chrome'),
(951, '2020-02-01 00:27:04', '::1', 'Other'),
(952, '2020-02-01 00:40:18', '192.168.42.112', 'Other'),
(953, '2020-02-01 12:23:27', '192.168.100.31', 'Other'),
(954, '2020-02-01 17:26:04', '::1', 'Other'),
(955, '2020-02-01 18:11:33', '94.23.222.44', 'Other'),
(956, '2020-02-03 12:59:14', '::1', 'Other'),
(957, '2020-02-03 12:59:30', '192.168.100.31', 'Other'),
(958, '2020-02-05 11:39:07', '192.168.100.31', 'Other'),
(959, '2020-02-06 10:50:43', '192.168.100.31', 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `nama_web` varchar(60) NOT NULL,
  `author` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_web`, `author`, `alamat`, `email`) VALUES
(1, 'E - Kartu Pelajar', 'Coder Newbie', 'Garut, Jawa Barat, Jl. Guntur 25', 'akmalmf007@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` int(11) NOT NULL,
  `rfid_key` varchar(12) NOT NULL,
  `photo` varchar(60) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `jenkel` enum('L','P') NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `joindate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_siswa`
--

INSERT INTO `tbl_siswa` (`id`, `rfid_key`, `photo`, `nis`, `nama`, `jenkel`, `kelas_id`, `alamat`, `saldo`, `joindate`) VALUES
(4, '2192115834', 'c58622d5d21b29347ab178726205d074.jpg', '123', 'Akmal Muhamad Firdaus', 'L', 27, 'JL GUNTUR SARI KP. MEKARJAYA RT 01 RW 16 KEL HAURPANGGUNG KABUPATEN GARUT JAWA BARAT', 0, '2020-03-07 09:38:50'),
(5, '432095834', '73ffa3e5168ce8b81d1c058194373479.jpg', '12312', 'Coder Newbie', 'L', 27, 'JL GUNTUR SARI KP. MEKARJAYA RT 01 RW 16 KEL HAURPANGGUNG KABUPATEN GARUT JAWA BARAT', 0, '2020-03-07 09:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('seller','admin','guru') NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `photo` varchar(60) DEFAULT NULL,
  `joindate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `level`, `email`, `nama`, `photo`, `joindate`) VALUES
(1, 'amf007', '$2y$10$PZ1PBLn7F7gZNpMr3U5dme6eSqSAHHL8BlswItgOi/3o8/Qgyn3FK', 'admin', 'akmalmf007@gmail.com', 'Akmal Muhamad Firdaus', 'amf.jpg', '0000-00-00 00:00:00'),
(13, 'admin', '$2y$10$Io5BjETySBMaKZSxzzEmu.3cCuyhpPMJdIj6nSSsPyMLJUeejqIxa', 'admin', 'coder.newbie04@gmail.com', 'Coder Newbie', 'nopic.png', '2020-03-07 13:16:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_token`
--
ALTER TABLE `access_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  ADD PRIMARY KEY (`pengunjung_id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_id` (`kelas_id`) USING BTREE;

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_token`
--
ALTER TABLE `access_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_lokasi`
--
ALTER TABLE `tbl_lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pengunjung`
--
ALTER TABLE `tbl_pengunjung`
  MODIFY `pengunjung_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=960;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `access_token`
--
ALTER TABLE `access_token`
  ADD CONSTRAINT `access_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_ibfk_1` FOREIGN KEY (`kelas_id`) REFERENCES `tbl_kelas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
