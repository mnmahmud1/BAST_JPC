-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2024 at 05:22 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bast`
--

-- --------------------------------------------------------

--
-- Table structure for table `bast_report`
--

CREATE TABLE `bast_report` (
  `id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  `id_user_submitted` int(3) NOT NULL,
  `id_user_accepted` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bast_report`
--

INSERT INTO `bast_report` (`id`, `number`, `id_user_submitted`, `id_user_accepted`, `status`, `notes`, `as_dump`, `updated_at`, `created_at`, `created_by`) VALUES
(3, 'IT/BAST/2024/01/01', 1, 2, 1, 'TES', 0, '2024-01-27 03:55:01', '2024-01-27 10:54:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bast_report_details`
--

CREATE TABLE `bast_report_details` (
  `id` int(11) NOT NULL,
  `id_bast` varchar(50) NOT NULL,
  `id_good` int(11) NOT NULL,
  `img_evidence` varchar(50) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `type` int(1) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `initial` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `initial`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'HOJKT', 'HEAD OFFICE JAKARTA', '2024-01-12 16:06:42', '2024-01-12 17:05:33', 1),
(2, 'WSGNP', 'WORKSHOP GUNUNG PUTRI', '2024-01-12 16:06:42', '2024-01-12 17:05:33', 1),
(5, 'REPPKU', 'REP OFFICE PEKANBARU', '2024-01-12 16:07:49', '2024-01-12 17:07:35', 1),
(6, 'REPSBY', 'REP OFFICE SURABAYA', '2024-01-12 16:07:49', '2024-01-12 17:07:35', 1),
(7, 'BOBPN', 'BRANCH OFFICE BALIKPAPAN', '2024-01-12 16:08:35', '2024-01-12 17:08:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id` int(11) NOT NULL,
  `initial` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`id`, `initial`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'HRGA', 'HR & GA', '2024-01-12 16:24:37', '2024-01-12 17:23:57', 1),
(2, 'QC', 'QUALITY CONTROL', '2024-01-12 16:24:37', '2024-01-12 17:23:57', 1),
(3, 'PC', 'PROJECT CONTROL', '2024-01-12 16:24:56', '2024-01-12 17:24:40', 1),
(4, 'PECRANES', 'PE CRANES', '2024-01-12 16:24:56', '2024-01-12 17:24:40', 1),
(5, 'PS', 'PRODUCT & SERVICES', '2024-01-27 04:17:59', '2024-01-27 05:17:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `specification` text NOT NULL,
  `id_inv_type` int(11) NOT NULL,
  `id_inv_group` int(11) NOT NULL,
  `id_inv_allotment` int(11) NOT NULL,
  `id_inv_branch` int(11) NOT NULL,
  `id_inv_source` int(11) NOT NULL,
  `id_inv_dept` int(11) NOT NULL,
  `year` varchar(4) NOT NULL,
  `useful_period` int(11) NOT NULL,
  `id_inv_condition` int(11) NOT NULL,
  `notes` text NOT NULL,
  `img` varchar(60) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `number`, `sn`, `description`, `specification`, `id_inv_type`, `id_inv_group`, `id_inv_allotment`, `id_inv_branch`, `id_inv_source`, `id_inv_dept`, `year`, `useful_period`, `id_inv_condition`, `notes`, `img`, `updated_at`, `created_at`, `as_dump`, `created_by`) VALUES
(2, 'IT/REG/2024/01/01', 'ABP-1232-AWD3-23FS-234F', 'SOUND SYSTEM MIFA K12', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 4, 1, 2, 1, 1, '2023', 3, 1, 'REFF PWR 2023/JKT-0142; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/4; TES', NULL, '2024-01-21 14:50:33', '2024-01-13 12:14:11', 0, 1),
(3, 'IT/REG/2024/01/02', 'ASDASDSF', 'MOUSE WIRELESS LOGITECH M190', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 1, 2, 2, 1, 3, '2024', 2, 1, 'REFF PWR ; REFF PO ;', NULL, '2024-01-15 15:03:04', '2024-01-15 22:03:04', 0, 1),
(4, 'IT/REG/2024/01/03', '2223LZ917BZ8', 'MOUSE WIRELESS LOGITECH M190', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 1, 2, 2, 1, 2, '2024', 2, 1, 'REFF PWR 2023/JKT-0241; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/4; UNTUK MAHMUD', '72ff743b4caff43a37b2aa7c764a514b.jpg', '2024-01-16 13:40:45', '2024-01-16 20:40:45', 0, 1),
(5, 'IT/REG/2024/01/04', '132234-ASDASD-23423DA', 'LISENSI AEC 2024', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 2, 3, 2, 1, 1, 1, '2023', 1, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/6; TES', '', '2024-01-16 15:07:43', '2024-01-16 22:07:43', 0, 1),
(6, 'IT/REG/2024/01/05', 'APASAJABOLEH', 'LAPTOP ACER ASPIRE E14 E5-471', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 2, 1, 2, 1, 3, 1, '2024', 10, 2, 'REFF LAIN-LAIN;', '25dc0b54a56cccef1051cbf493397b22.png', '2024-01-21 14:52:28', '2024-01-16 22:10:48', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `good_incoming`
--

CREATE TABLE `good_incoming` (
  `id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `notes` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `good_incoming`
--

INSERT INTO `good_incoming` (`id`, `number`, `notes`, `updated_at`, `created_at`, `created_by`, `as_dump`) VALUES
(2, 'IT/RR/2024/01/1', NULL, '2024-01-10 13:39:13', '2024-01-08 20:09:04', 1, 1),
(3, 'IT/RR/2024/01/2', NULL, '2024-01-10 13:39:17', '2024-01-08 20:09:34', 1, 1),
(4, 'IT/RR/2024/01/3', NULL, '2024-01-10 13:39:22', '2024-01-08 20:12:53', 1, 1),
(5, 'IT/RR/2024/01/4', 'Kebutuhan consumable IT pada bulan januari 2024', '2024-01-10 13:42:50', '2024-01-09 20:37:36', 1, 0),
(6, 'IT/RR/2024/01/5', 'Kebutuhan PLN indramayu', '2024-01-10 13:38:36', '2024-01-10 19:09:12', 1, 1),
(7, 'IT/RR/2024/01/6', NULL, '2024-01-10 13:45:00', '2024-01-10 20:45:00', 1, 0),
(8, 'IT/RR/2024/01/7', NULL, '2024-01-10 14:06:13', '2024-01-10 21:06:13', 1, 0),
(9, 'IT/RR/2024/01/8', NULL, '2024-01-12 14:06:52', '2024-01-12 21:06:52', 1, 0),
(10, 'IT/RR/2024/01/9', NULL, '2024-01-12 16:12:28', '2024-01-12 23:12:28', 1, 0),
(11, 'IT/RR/2024/01/10', NULL, '2024-01-17 12:13:03', '2024-01-17 19:13:03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `good_incoming_details`
--

CREATE TABLE `good_incoming_details` (
  `id` int(11) NOT NULL,
  `id_incoming` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `pwr` varchar(20) NOT NULL,
  `po` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `img` varchar(60) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `as_inv` tinyint(1) NOT NULL DEFAULT 0,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `good_incoming_details`
--

INSERT INTO `good_incoming_details` (`id`, `id_incoming`, `description`, `sn`, `pwr`, `po`, `type`, `notes`, `img`, `updated_at`, `created_at`, `as_inv`, `as_dump`, `created_by`) VALUES
(1, 5, 'SOUND SYSTEM MIFA K12', 'ABP-1232-AWD3-23FS-234F', '2023/JKT-0142', '2023/JKT-L-0123', 1, 'TES', NULL, '2024-01-13 05:14:11', '2024-01-09 21:14:42', 1, 0, 1),
(2, 5, 'LISENSI AEC 2024', 'ABP-1232-AWD3-23FS-234F1', '2024/JKT-0023', 'MEMO/JKT-0011', 2, 'AEC 2024 UNTUK ENG', NULL, '2024-01-13 04:47:20', '2024-01-09 21:28:04', 0, 0, 1),
(6, 7, 'SOUND SYSTEM MIFA K12', '12312BHJB1JH23B', '2024/JKT-0023', '2023/JKT-L-0123', 2, 'TES', NULL, '2024-01-10 13:45:10', '2024-01-10 20:45:10', 0, 0, 1),
(7, 7, 'LISENSI AEC 2024', '132234-ASDASD-23423DA', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', NULL, '2024-01-16 15:07:43', '2024-01-10 21:02:57', 1, 0, 1),
(8, 7, 'LISENSI SOLIDWORKS 2024', 'ASDADA-2342Q34A-SDDASD', '2024/JKT-0023', '2023/JKT-L-0123', 2, 'TES', NULL, '2024-01-10 14:03:34', '2024-01-10 21:03:34', 0, 0, 1),
(9, 5, 'MOUSE WIRELESS LOGITECH M190', '2223LZ917BZ8', '2023/JKT-0241', '2023/JKT-L-0123', 1, 'UNTUK MAHMUD', '72ff743b4caff43a37b2aa7c764a514b.jpg', '2024-01-16 13:40:45', '2024-01-16 19:37:07', 1, 0, 1),
(10, 5, 'MOUSE WIRELESS LOGITECH M170', '12712BJHDJSAD', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'UNTUK EKA', 'a75c0c76c7237831e9003115b0396070.jpg', '2024-01-20 15:42:44', '2024-01-20 22:42:44', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_allotment`
--

CREATE TABLE `inv_allotment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_condition`
--

CREATE TABLE `inv_condition` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inv_condition`
--

INSERT INTO `inv_condition` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'BAIK', '2024-01-13 05:36:02', '2024-01-13 06:35:49', 1),
(2, 'KURANG_BAIK', '2024-01-16 15:30:58', '2024-01-13 06:35:49', 1),
(3, 'RUSAK', '2024-01-13 05:36:13', '2024-01-13 06:36:04', 1),
(4, 'SCRAPT', '2024-01-13 05:36:13', '2024-01-13 06:36:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_group`
--

CREATE TABLE `inv_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inv_group`
--

INSERT INTO `inv_group` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'LAPTOP', '2024-01-12 16:11:15', '2024-01-12 17:09:22', 1),
(2, 'PC', '2024-01-12 16:11:15', '2024-01-12 17:09:22', 1),
(3, 'PRINTER', '2024-01-12 16:11:45', '2024-01-12 17:11:18', 1),
(4, 'MIKROTIK', '2024-01-12 16:11:45', '2024-01-12 17:11:18', 1),
(5, 'SOUND SYSTEM', '2024-01-12 16:11:57', '2024-01-12 17:11:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_type`
--

CREATE TABLE `inv_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inv_type`
--

INSERT INTO `inv_type` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'GOODS', '2024-01-12 16:13:24', '2024-01-12 17:13:07', 1),
(2, 'LISENCES', '2024-01-12 16:13:24', '2024-01-12 17:13:07', 1),
(3, 'CONSUMMABLES', '2024-01-12 16:13:48', '2024-01-12 17:13:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `licences`
--

CREATE TABLE `licences` (
  `id` int(11) NOT NULL,
  `number` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `id_lic_type` int(2) NOT NULL,
  `seats` int(2) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `id_lic_dept` int(2) NOT NULL,
  `id_lic_branch` int(2) NOT NULL,
  `id_lic_source` int(2) NOT NULL,
  `notes` text NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lic_type`
--

CREATE TABLE `lic_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `session_log`
--

CREATE TABLE `session_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rand_code` varchar(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session_log`
--

INSERT INTO `session_log` (`id`, `user_id`, `rand_code`, `created_at`) VALUES
(3, 1, 'ZGgtnYWE', '2023-11-29 09:50:34'),
(4, 1, 'Fim3MuBY', '2023-12-06 04:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'PWR', '2024-01-12 16:28:07', '2024-01-12 17:27:53', 1),
(2, 'HIBAH', '2024-01-12 16:28:07', '2024-01-12 17:27:53', 1),
(3, 'LAIN-LAIN', '2024-01-12 16:28:16', '2024-01-12 17:28:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `initial` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `position` varchar(50) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL,
  `notes` text NOT NULL,
  `as_admin` int(1) NOT NULL DEFAULT 0,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `initial`, `name`, `nik`, `position`, `id_dept`, `id_branch`, `notes`, `as_admin`, `as_dump`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'mahmudi.nurhasan@jpc.co.id', '$2a$12$54lFY47DRTOrUzlOB0lQ7.rP5sgNhenSPI.abJii.VhQisX3sA6Im', 'MHN', 'M NURHASAN MAHMUDI', 'JPC-JKT-825', 'IT SUPPORT', 1, 2, 'TES', 1, 0, '2024-01-26 15:58:34', '2023-11-29 09:28:31', NULL),
(2, NULL, NULL, 'RCF', 'RICO FERNANDES', 'JPC-JKT-812', 'TECHNICAL SUPPORT', 5, 2, '-', 0, 0, '2024-01-27 04:18:13', '0000-00-00 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bast_report`
--
ALTER TABLE `bast_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bast_report_details`
--
ALTER TABLE `bast_report_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dept`
--
ALTER TABLE `dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_incoming`
--
ALTER TABLE `good_incoming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `good_incoming_details`
--
ALTER TABLE `good_incoming_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_allotment`
--
ALTER TABLE `inv_allotment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_condition`
--
ALTER TABLE `inv_condition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_group`
--
ALTER TABLE `inv_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inv_type`
--
ALTER TABLE `inv_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lic_type`
--
ALTER TABLE `lic_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session_log`
--
ALTER TABLE `session_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bast_report`
--
ALTER TABLE `bast_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bast_report_details`
--
ALTER TABLE `bast_report_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `good_incoming`
--
ALTER TABLE `good_incoming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `good_incoming_details`
--
ALTER TABLE `good_incoming_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inv_allotment`
--
ALTER TABLE `inv_allotment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inv_condition`
--
ALTER TABLE `inv_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_group`
--
ALTER TABLE `inv_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inv_type`
--
ALTER TABLE `inv_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `licences`
--
ALTER TABLE `licences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lic_type`
--
ALTER TABLE `lic_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `session_log`
--
ALTER TABLE `session_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
