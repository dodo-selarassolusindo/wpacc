-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 04:50 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_wpacc`
--

-- --------------------------------------------------------

--
-- Table structure for table `adjustment`
--

CREATE TABLE `adjustment` (
  `id` int(11) NOT NULL,
  `akun` int(11) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akun_backup`
--

CREATE TABLE `akun_backup` (
  `id` int(11) NOT NULL,
  `akun` int(11) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL,
  `kode_tahun` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `akun_baru`
--

CREATE TABLE `akun_baru` (
  `id` int(11) NOT NULL,
  `grup_akun` int(11) NOT NULL,
  `kode` varchar(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `debet_lalu` double NOT NULL,
  `kredit_lalu` double NOT NULL,
  `debet_ini` double NOT NULL,
  `kredit_ini` double NOT NULL,
  `bulan_tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akun_baru`
--

INSERT INTO `akun_baru` (`id`, `grup_akun`, `kode`, `nama`, `debet_lalu`, `kredit_lalu`, `debet_ini`, `kredit_ini`, `bulan_tahun`) VALUES
(1, 1, '0101', 'KAS TUNAI', 0, 0, 0, 0, '1222'),
(2, 1, '0102', 'PIUTANG USAHA', 0, 0, 0, 0, '1222'),
(3, 3, '0103', 'PERSEDIAAN', 0, 0, 0, 0, '1222'),
(4, 2, '0104', 'PERLENGKAPAN UMUM', 0, 0, 0, 0, '1222'),
(5, 4, '0201', 'UTANG USAHA', 0, 0, 0, 0, '1222'),
(6, 7, '0401', 'PENDAPATAN PENJUALAN', 0, 0, 0, 0, '1222'),
(7, 8, '0501', 'HARGA POKOK PENJUALAN', 0, 0, 0, 0, '1222'),
(8, 9, '0601', 'BEBAN PERLENGKAPAN UMUM', 0, 0, 0, 0, '1222');

-- --------------------------------------------------------

--
-- Table structure for table `akun_lama`
--

CREATE TABLE `akun_lama` (
  `id` int(11) NOT NULL,
  `grup_akun` int(11) NOT NULL,
  `kode` varchar(4) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `debet_lalu` double NOT NULL,
  `kredit_lalu` double NOT NULL,
  `debet_ini` double NOT NULL,
  `kredit_ini` double NOT NULL,
  `bulan_tahun` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `grup_akun`
--

CREATE TABLE `grup_akun` (
  `id` int(11) NOT NULL,
  `kode` varchar(2) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `grup_akun`
--

INSERT INTO `grup_akun` (`id`, `kode`, `nama`) VALUES
(1, '01', 'AKTIVA LANCAR'),
(2, '02', 'AKTIVA TETAP'),
(3, '03', 'AKTIVA LAIN-LAIN'),
(4, '11', 'HUTANG JANGKA PENDEK'),
(5, '12', 'HUTANG JANGKA PANJANG'),
(6, '13', 'MODAL'),
(7, '21', 'PENDAPATAN USAHA'),
(8, '31', 'HARGA POKOK PENJUALAN'),
(9, '32', 'BIAYA-BIAYA');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `nomor` varchar(7) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `bulan_tahun` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id`, `nomor`, `tanggal`, `keterangan`, `bulan_tahun`) VALUES
(1, '2212001', '2022-12-25', 'Beli Bahan Bakar', NULL),
(2, '2212002', '2022-12-25', 'Beli ATK', NULL),
(3, '2212003', '2022-12-25', 'Bayar Listrik', '1222'),
(4, '2212004', '2022-12-25', 'Bayar PDAM', '1222'),
(5, '2212005', '2022-12-25', '-', '1222'),
(6, '2212006', '2022-12-25', '--', '1222'),
(7, '2212007', '2022-12-25', '---', '1222'),
(8, '2212008', '2022-12-26', 'Testing Data Jurnal', '1222'),
(10, '2212009', '2022-12-26', 'Kas Keluar', '1222');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_backup`
--

CREATE TABLE `jurnal_backup` (
  `id` int(11) NOT NULL,
  `nomor` varchar(7) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `bulan_tahun` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_detail`
--

CREATE TABLE `jurnal_detail` (
  `id` int(11) NOT NULL,
  `jurnal` int(11) NOT NULL,
  `akun` int(11) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jurnal_detail`
--

INSERT INTO `jurnal_detail` (`id`, `jurnal`, `akun`, `debet`, `kredit`) VALUES
(1, 8, 1, 100000, 0),
(2, 8, 6, 0, 100000),
(7, 10, 8, 1250000, 0),
(8, 10, 8, 1350000, 0),
(9, 10, 1, 0, 2600000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_detail_backup`
--

CREATE TABLE `jurnal_detail_backup` (
  `id` int(11) NOT NULL,
  `jurnal` int(11) NOT NULL,
  `akun` int(11) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_detail_lama`
--

CREATE TABLE `jurnal_detail_lama` (
  `id` int(11) NOT NULL,
  `jurnal` int(11) NOT NULL,
  `akun` int(11) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_lama`
--

CREATE TABLE `jurnal_lama` (
  `id` int(11) NOT NULL,
  `nomor` varchar(7) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `bulan_tahun` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adjustment`
--
ALTER TABLE `adjustment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_backup`
--
ALTER TABLE `akun_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_baru`
--
ALTER TABLE `akun_baru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akun_lama`
--
ALTER TABLE `akun_lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grup_akun`
--
ALTER TABLE `grup_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_backup`
--
ALTER TABLE `jurnal_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_detail`
--
ALTER TABLE `jurnal_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_detail_backup`
--
ALTER TABLE `jurnal_detail_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_detail_lama`
--
ALTER TABLE `jurnal_detail_lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurnal_lama`
--
ALTER TABLE `jurnal_lama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adjustment`
--
ALTER TABLE `adjustment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akun_backup`
--
ALTER TABLE `akun_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `akun_baru`
--
ALTER TABLE `akun_baru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `akun_lama`
--
ALTER TABLE `akun_lama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grup_akun`
--
ALTER TABLE `grup_akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jurnal_backup`
--
ALTER TABLE `jurnal_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal_detail`
--
ALTER TABLE `jurnal_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jurnal_detail_backup`
--
ALTER TABLE `jurnal_detail_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal_detail_lama`
--
ALTER TABLE `jurnal_detail_lama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnal_lama`
--
ALTER TABLE `jurnal_lama`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
