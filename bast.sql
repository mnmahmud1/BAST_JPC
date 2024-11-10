-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 06:46 PM
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
  `id_user_submitted` int(11) NOT NULL,
  `id_user_accepted` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `notes` text NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `attach` varchar(40) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bast_report`
--

INSERT INTO `bast_report` (`id`, `number`, `id_user_submitted`, `id_user_accepted`, `status`, `notes`, `as_dump`, `attach`, `updated_at`, `created_at`, `created_by`) VALUES
(5, 'IT/BAST/2024/11/01', 1, 2, 1, 'KARYAWAN BARU', 0, '', '2024-11-09 15:21:52', '2024-11-09 22:21:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bast_report_details`
--

CREATE TABLE `bast_report_details` (
  `id` int(11) NOT NULL,
  `bast_number` varchar(50) NOT NULL,
  `id_good` int(11) NOT NULL,
  `id_inv_type` int(11) NOT NULL,
  `attach` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bast_report_details`
--

INSERT INTO `bast_report_details` (`id`, `bast_number`, `id_good`, `id_inv_type`, `attach`, `updated_at`, `created_at`, `created_by`) VALUES
(6, 'IT/BAST/2024/11/01', 8, 1, NULL, '2024-11-09 15:29:07', '2024-11-09 22:29:07', 1),
(8, 'IT/BAST/2024/11/01', 2, 2, NULL, '2024-11-10 13:17:07', '2024-11-10 20:17:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bast_usage_history`
--

CREATE TABLE `bast_usage_history` (
  `id` int(11) NOT NULL,
  `bast_number` varchar(50) NOT NULL,
  `tittle` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `attach` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bast_usage_history`
--

INSERT INTO `bast_usage_history` (`id`, `bast_number`, `tittle`, `description`, `attach`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'IT/BAST/2024/04/01', 'Add Inventory', 'Adding MOUSE WIRELESS LOGITECH M190', NULL, '2024-04-08 08:45:48', '2024-04-08 15:26:31', 1),
(2, 'IT/BAST/2024/04/01', 'Add Inventory', 'Adding LAPTOP ACER ASPIRE E14 E5-471', NULL, '2024-04-08 09:04:35', '2024-04-08 16:04:35', 1),
(6, 'IT/BAST/2024/01/01', 'KEYBOARD RUSAK', 'Rusak tombol space', '', '2024-04-08 13:38:55', '2024-04-08 20:38:55', 1),
(7, 'IT/BAST/2024/01/01', 'UPLOAD FOTO TERBARU', 'foto lengkap dengan tas', 'Picture1.jpg', '2024-04-08 13:49:58', '2024-04-08 20:49:58', 1),
(8, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/02', NULL, '2024-05-18 17:03:52', '2024-05-19 00:03:52', 1),
(9, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/05', NULL, '2024-05-18 17:04:10', '2024-05-19 00:04:10', 1),
(10, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/02', NULL, '2024-05-18 17:21:38', '2024-05-19 00:21:38', 1),
(11, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/05', NULL, '2024-05-18 17:21:47', '2024-05-19 00:21:47', 1),
(12, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/05, <button onclick=\"window.location.href = \'dist/attach/bf1958fb2f0d1300bec09349f504e85321a11e8e.pdf\'\" class=\"btn btn-sm btn-success\">View</button>', NULL, '2024-05-18 17:37:21', '2024-05-19 00:37:21', 1),
(14, 'IT/BAST/2024/04/01', 'Tambah Foto', 'tambah testing <button onclick=\"window.location.href = \'dist/img/history-img/6d9ab08ceb07f8aced1180e90a37e449f57c3be8.JPG\'\" class=\"btn btn-sm btn-success\">View</button>', '6d9ab08ceb07f8aced1180e90a37e449f57c3be8.JPG', '2024-05-18 17:52:15', '2024-05-19 00:52:15', 1),
(15, 'IT/BAST/2024/04/01', 'Add Lisence', 'Adding IT/LIC/2024/01/01 - LISENSI AEC 2024', NULL, '2024-11-09 13:47:06', '2024-11-09 20:47:05', 1),
(16, 'IT/BAST/2024/04/01', 'Add Lisence', 'Adding IT/LIC/2024/01/01 - LISENSI AEC 2024', NULL, '2024-11-09 13:47:16', '2024-11-09 20:47:16', 1),
(17, 'IT/BAST/2024/04/01', 'Delete Lisence', 'Deleted IT/LIC/2024/01/01 - LISENSI AEC 2024', NULL, '2024-11-09 13:47:23', '2024-11-09 20:47:23', 1),
(18, 'IT/BAST/2024/11/01', 'Add Inventory', 'Adding 6.2024/LT03.01/WS1LT2 - LAPTOP ACER E5 471', NULL, '2024-11-09 15:29:07', '2024-11-09 22:29:07', 1),
(19, 'IT/BAST/2024/11/01', 'Add Inventory', 'Adding 6.2024/LT03.02/WS1LT2 - LAPTOP ACER E5 471', NULL, '2024-11-09 15:31:41', '2024-11-09 22:31:41', 1),
(20, 'IT/BAST/2024/11/01', 'Delete Inventory', 'Deleted 6.2024/LT03.02/WS1LT2 - LAPTOP ACER E5 471', NULL, '2024-11-09 15:32:29', '2024-11-09 22:32:28', 1),
(21, 'IT/BAST/2024/11/01', 'Add Lisence', 'Adding IT/LIC/2024/01/01 - LISENSI AEC 2024', NULL, '2024-11-10 13:17:08', '2024-11-10 20:17:07', 1);

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
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `initial`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'HOLT1', 'HEAD OFFICE JAKARTA L1', '2024-11-09 14:00:01', '2024-01-12 17:05:33', 1),
(2, 'HOLT2', 'HEAD OFFICE JAKARTA L2', '2024-11-10 12:52:09', '2024-01-12 17:05:33', 1),
(5, 'WS1LT1', 'WORKSHOP GUNUNG PUTRI GEDUNG 1 LT 1', '2024-11-09 14:00:36', '2024-01-12 17:07:35', 1),
(6, 'WS1LT2', 'WORKSHOP GUNUNG PUTRI GEDUNG 1 LT 2', '2024-11-09 14:00:40', '2024-01-12 17:07:35', 1),
(7, 'WS2LT1', 'WORKSHOP GUNUNG PUTRI GEDUNG 2 LT 1', '2024-11-09 14:00:49', '2024-01-12 17:08:17', 1),
(8, 'WS2LT2', 'WORKSHOP GUNUNG PUTRI GEDUNG 2 LT 2', '2024-11-09 14:00:49', '2024-01-12 17:08:17', 1),
(9, 'PKULT1', 'BRACH OFFICE PEKANBARU LT 1', '2024-11-09 14:00:36', '2024-01-12 17:07:35', 1),
(10, 'PKULT1', 'BRACH OFFICE PEKANBARU LT 2', '2024-11-09 14:00:40', '2024-01-12 17:07:35', 1),
(11, 'SBYLT1', 'BRACH OFFICE SURABAYA LT 1', '2024-11-09 14:00:49', '2024-01-12 17:08:17', 1),
(12, 'SBYLT2', 'BRACH OFFICE SURABAYA LT 2', '2024-11-09 14:00:49', '2024-01-12 17:08:17', 1);

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
  `created_by` int(11) NOT NULL
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
  `id_inv_group` varchar(4) NOT NULL,
  `id_inv_allotment` int(11) NOT NULL,
  `id_inv_branch` varchar(10) NOT NULL,
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
  `as_bast` tinyint(1) DEFAULT 0,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`id`, `number`, `sn`, `description`, `specification`, `id_inv_type`, `id_inv_group`, `id_inv_allotment`, `id_inv_branch`, `id_inv_source`, `id_inv_dept`, `year`, `useful_period`, `id_inv_condition`, `notes`, `img`, `updated_at`, `created_at`, `as_dump`, `as_bast`, `created_by`) VALUES
(8, '6.2024/LT03.01/WS1LT2', 'SCAD3R23RF23', 'LAPTOP ACER E5 471', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 'LT03', 2, 'WS1LT2', 1, 1, '2024', 5, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/11/1; TES', '5000c6c3d576f3840ad8d43129876048.jpeg', '2024-11-10 12:55:08', '2024-11-09 21:43:22', 0, 1, 1),
(9, '6.2024/LT03.02/WS1LT2', 'ADAASDASDWAS', 'LAPTOP ACER E5 471', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 'LT03', 2, 'WS1LT2', 1, 3, '2024', 5, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/11/1; TES', 'f6498590178af9baef7f6cda7593cb4c.jpeg', '2024-11-09 15:32:28', '2024-11-09 22:05:35', 0, 0, 1),
(10, '6.2024/LT03.03/SBYLT2', 'ADAASDASDWASQW', 'LAPTOP ACER E5 471', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 'LT03', 2, 'SBYLT2', 1, 1, '2024', 5, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/11/1; TES', '8bdeacb88b0f2809d806ab5887fab075.jpeg', '2024-11-10 13:12:18', '2024-11-09 22:18:57', 0, 0, 1),
(11, '6.2023/SS02.01/WS2LT1', '12312BHJB1JH23B', 'SOUND SYSTEM MIFA K12', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 'SS02', 1, 'WS2LT1', 1, 1, '2023', 5, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/6; TES', '', '2024-11-09 15:21:25', '2024-11-09 22:21:25', 0, 0, 1);

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
(11, 'IT/RR/2024/01/10', NULL, '2024-01-17 12:13:03', '2024-01-17 19:13:03', 1, 0),
(12, 'IT/RR/2024/11/1', NULL, '2024-11-09 13:37:54', '2024-11-09 20:37:54', 1, 0);

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
(2, 5, 'LISENSI AEC 2024', 'ABP-1232-AWD3-23FS-234F1', '2024/JKT-0023', 'MEMO/JKT-0011', 2, 'AEC 2024 UNTUK ENG', NULL, '2024-01-27 16:17:21', '2024-01-09 21:28:04', 1, 0, 1),
(6, 7, 'SOUND SYSTEM MIFA K12', '12312BHJB1JH23B', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', NULL, '2024-11-09 15:21:25', '2024-01-10 20:45:10', 1, 0, 1),
(8, 7, 'LISENSI SOLIDWORKS 2024', 'ASDADA-2342Q34A-SDDASD', '2024/JKT-0023', '2023/JKT-L-0123', 2, 'TES', NULL, '2024-01-27 16:18:15', '2024-01-10 21:03:34', 1, 0, 1),
(10, 5, 'MOUSE WIRELESS LOGITECH M170', '12712BJHDJSAD', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'UNTUK EKA', 'a75c0c76c7237831e9003115b0396070.jpg', '2024-01-20 15:42:44', '2024-01-20 22:42:44', 0, 0, 1),
(11, 5, 'LISENSI SOLIDWORKS 2024', '121NNDF-23423R2-23423F', '2024/JKT-0056', '2024/JKT-L-0023', 2, 'UNTUK ENGINERING', 'c4e786da9f59f9f0b5adb0b59d098355.jpg', '2024-02-26 13:27:07', '2024-02-26 20:27:07', 0, 0, 1),
(13, 12, 'LAPTOP ACER E5 471', 'SCAD3R23RF23', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', '5000c6c3d576f3840ad8d43129876048.jpeg', '2024-11-09 14:43:22', '2024-11-09 21:40:05', 1, 0, 1),
(14, 12, 'LAPTOP ACER E5 471', 'ADAASDASDWAS', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', 'f6498590178af9baef7f6cda7593cb4c.jpeg', '2024-11-09 15:05:35', '2024-11-09 22:03:22', 1, 0, 1),
(15, 12, 'LAPTOP ACER E5 471', 'ADAASDASDWASQW', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', '8bdeacb88b0f2809d806ab5887fab075.jpeg', '2024-11-09 15:18:57', '2024-11-09 22:18:26', 1, 0, 1),
(16, 12, 'DISPLAY MONITOR 55\"', 'ADAASDASDWASQWASD', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', 'a67124cdf8ab79cbd69f212bb13d50e6.png', '2024-11-10 14:43:11', '2024-11-10 21:35:20', 0, 0, 1),
(17, 12, 'DISPLAY MONITOR 43\"', 'AASDASD', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', '9aa75a6f2a73da495e23c472e90ed035.jpg', '2024-11-10 14:37:49', '2024-11-10 21:37:49', 0, 0, 1),
(18, 12, 'TINTA HP 955XL BLACK', '', '2024/JKT-0023', '2023/JKT-L-0123', 3, 'TES', '06450bd01f152b77248ea409c34b4655.jpeg', '2024-11-10 14:53:31', '2024-11-10 21:53:31', 0, 0, 1),
(19, 12, 'TINTA HP 955XL CYAN', '', '2024/JKT-0023', '2023/JKT-L-0123', 3, 'TES', '1c7681ca99dce501aeee7a3931b85527.jpeg', '2024-11-10 15:09:03', '2024-11-10 22:09:03', 0, 0, 1),
(20, 12, 'MOUSE WIRELESS LOGITECH M190', 'ASDASD24', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', '355b9e4317c58734bf6d1fce78fac4c1.jpg', '2024-11-10 15:10:00', '2024-11-10 22:10:00', 0, 0, 1),
(22, 12, 'TINTA HP 955XL CYAN', '', '2024/JKT-0023', '2023/JKT-L-0123', 3, 'TES', '1c7681ca99dce501aeee7a3931b85527.jpeg', '2024-11-10 15:49:02', '2024-11-10 22:09:03', 0, 0, 1),
(23, 12, 'TINTA HP 955XL CYAN', '', '2024/JKT-0023', '2023/JKT-L-0123', 3, 'TES', '1c7681ca99dce501aeee7a3931b85527.jpeg', '2024-11-10 16:31:59', '2024-11-10 22:09:03', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_allotment`
--

CREATE TABLE `inv_allotment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
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
  `created_by` int(11) NOT NULL
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
  `code` varchar(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inv_group`
--

INSERT INTO `inv_group` (`id`, `code`, `name`, `description`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'LT02', 'LAPTOP', '', '2024-11-09 14:08:52', '2024-01-12 17:09:22', 1),
(2, 'PC01', 'PC', '', '2024-11-09 14:08:55', '2024-01-12 17:09:22', 1),
(3, 'PR01', 'PRINTER', '', '2024-11-09 14:08:59', '2024-01-12 17:11:18', 1),
(4, 'RT01', 'MIKROTIK', '', '2024-11-09 14:09:03', '2024-01-12 17:11:18', 1),
(5, 'SS01', 'SOUND SYSTEM', '', '2024-11-09 14:09:06', '2024-01-12 17:11:48', 1),
(6, 'LT01', 'LAPTOP', 'LAPTOP ASUS A456U', '2024-11-09 13:40:20', '2024-11-09 20:40:20', 1),
(7, 'LT03', 'LAPTOP', 'LAPTOP ACER E5 471', '2024-11-09 14:40:27', '2024-11-09 21:40:27', 1),
(8, 'SS02', 'SOUND SYSTEM', 'SOUND SYSTEM MIFA K12', '2024-11-09 15:20:59', '2024-11-09 22:20:59', 1),
(9, 'DP01', 'DISPLAY MONITOR', 'DISPLAY MONITOR 43\"', '2024-11-10 14:42:41', '2024-11-10 21:38:39', 1),
(10, 'DP02', 'DISPLAY MONITOR', 'DISPLAY MONITOR 55\"', '2024-11-10 14:43:32', '2024-11-10 21:43:32', 1),
(11, 'MO01', 'MOUSE', 'MOUSE WIRELESS LOGITECH M190', '2024-11-10 16:32:23', '2024-11-10 23:32:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inv_type`
--

CREATE TABLE `inv_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
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
-- Table structure for table `lic_type`
--

CREATE TABLE `lic_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lisences`
--

CREATE TABLE `lisences` (
  `id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `id_lic_type` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `id_lic_dept` int(11) NOT NULL,
  `id_lic_branch` int(11) NOT NULL,
  `id_lic_source` int(11) NOT NULL,
  `notes` text NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `as_bast` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lisences`
--

INSERT INTO `lisences` (`id`, `number`, `sn`, `description`, `id_lic_type`, `seats`, `date_start`, `date_end`, `id_lic_dept`, `id_lic_branch`, `id_lic_source`, `notes`, `as_dump`, `as_bast`, `updated_at`, `created_at`, `created_by`) VALUES
(2, 'IT/LIC/2024/01/01', 'ABP-1232-AWD3-23FS-234F1', 'LISENSI AEC 2024', 2, 5, '2024-01-27 00:00:00', '2025-01-27 00:00:00', 1, 2, 1, 'REFF PWR 2024/JKT-0023; REFF PO MEMO/JKT-0011; RR IT IT/RR/2024/01/4; AEC 2024 UNTUK ENG', 0, 2, '2024-11-10 13:17:07', '2024-01-27 23:17:21', 1),
(3, 'IT/LIC/2024/01/02', 'ASDADA-2342Q34A-SDDASD', 'LISENSI SOLIDWORKS 2024', 1, 1, '2024-01-24 00:00:00', '0000-00-00 00:00:00', 5, 7, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/6; TES', 0, 0, '2024-03-02 17:37:27', '2024-01-27 23:18:15', 1),
(4, 'IT/LIC/2024/02/01', 'AREA1-123DD-87WF3-14C5G-23MKL', 'MICROSOFT OFFICE PRO PLUS 2021', 1, 3, '2024-02-26 00:00:00', '0000-00-00 00:00:00', 3, 2, 1, 'REFF PWR 2023/JKT-0014 ; REFF PO 2023/JKT-L-0002;', 0, 0, '2024-03-02 17:36:36', '2024-02-26 21:33:22', 1);

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
  `created_by` int(11) NOT NULL
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
  `as_admin` int(11) NOT NULL DEFAULT 0,
  `as_dump` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `initial`, `name`, `nik`, `position`, `id_dept`, `id_branch`, `notes`, `as_admin`, `as_dump`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'mahmudi.nurhasan@jpc.co.id', '$2a$12$54lFY47DRTOrUzlOB0lQ7.rP5sgNhenSPI.abJii.VhQisX3sA6Im', 'MHN', 'M NURHASAN MAHMUDI', 'JPC-JKT-825', 'IT SUPPORT', 1, 2, 'TES', 1, 0, '2024-01-26 15:58:34', '2023-11-29 09:28:31', NULL),
(2, NULL, NULL, 'RCF', 'RICO FERNANDES', 'JPC-JKT-812', 'TECHNICAL SUPPORT', 5, 2, '-', 0, 0, '2024-04-06 08:39:27', '0000-00-00 00:00:00', 1),
(3, NULL, NULL, 'FKA', 'RAFIKA ROSADI', '-', 'ADMIN HR&amp;GA', 1, 2, '-', 0, 0, '2024-04-06 08:37:26', '2024-04-06 15:37:26', 1);

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
-- Indexes for table `bast_usage_history`
--
ALTER TABLE `bast_usage_history`
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
-- Indexes for table `lic_type`
--
ALTER TABLE `lic_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lisences`
--
ALTER TABLE `lisences`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bast_report_details`
--
ALTER TABLE `bast_report_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bast_usage_history`
--
ALTER TABLE `bast_usage_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `good_incoming`
--
ALTER TABLE `good_incoming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `good_incoming_details`
--
ALTER TABLE `good_incoming_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inv_type`
--
ALTER TABLE `inv_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lic_type`
--
ALTER TABLE `lic_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lisences`
--
ALTER TABLE `lisences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
