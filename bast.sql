-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bast
CREATE DATABASE IF NOT EXISTS `bast` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bast`;

-- Dumping structure for table bast.bast_report
CREATE TABLE IF NOT EXISTS `bast_report` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_user_submitted` int NOT NULL,
  `id_user_accepted` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `notes` text COLLATE utf8mb4_general_ci NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.bast_report: ~2 rows (approximately)
INSERT INTO `bast_report` (`id`, `number`, `id_user_submitted`, `id_user_accepted`, `status`, `notes`, `as_dump`, `updated_at`, `created_at`, `created_by`) VALUES
	(3, 'IT/BAST/2024/01/01', 1, 2, 1, 'TES', 0, '2024-01-27 03:55:01', '2024-01-27 10:54:05', 1),
	(4, 'IT/BAST/2024/04/01', 1, 3, 1, 'PEMBERIAN LAPTOP BARU KARENA LAPTOP LAMA RUSAK', 0, '2024-04-08 09:18:25', '2024-04-06 15:40:01', 1);

-- Dumping structure for table bast.bast_report_details
CREATE TABLE IF NOT EXISTS `bast_report_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bast_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_good` int NOT NULL,
  `id_inv_type` int NOT NULL,
  `attach` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.bast_report_details: ~2 rows (approximately)
INSERT INTO `bast_report_details` (`id`, `bast_number`, `id_good`, `id_inv_type`, `attach`, `updated_at`, `created_at`, `created_by`) VALUES
	(2, 'IT/BAST/2024/04/01', 3, 1, '03a2db22c09a707688cd41bd640b85feab61c0c5.pdf', '2024-05-18 17:21:38', '2024-04-08 15:26:31', 1),
	(3, 'IT/BAST/2024/04/01', 6, 1, 'bf1958fb2f0d1300bec09349f504e85321a11e8e.pdf', '2024-05-18 17:37:21', '2024-04-08 16:04:35', 1);

-- Dumping structure for table bast.bast_usage_history
CREATE TABLE IF NOT EXISTS `bast_usage_history` (
  `id` int NOT NULL AUTO_INCREMENT,
  `bast_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tittle` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `attach` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table bast.bast_usage_history: ~9 rows (approximately)
INSERT INTO `bast_usage_history` (`id`, `bast_number`, `tittle`, `description`, `attach`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'IT/BAST/2024/04/01', 'Add Inventory', 'Adding MOUSE WIRELESS LOGITECH M190', NULL, '2024-04-08 08:45:48', '2024-04-08 15:26:31', 1),
	(2, 'IT/BAST/2024/04/01', 'Add Inventory', 'Adding LAPTOP ACER ASPIRE E14 E5-471', NULL, '2024-04-08 09:04:35', '2024-04-08 16:04:35', 1),
	(6, 'IT/BAST/2024/01/01', 'KEYBOARD RUSAK', 'Rusak tombol space', '', '2024-04-08 13:38:55', '2024-04-08 20:38:55', 1),
	(7, 'IT/BAST/2024/01/01', 'UPLOAD FOTO TERBARU', 'foto lengkap dengan tas', 'Picture1.jpg', '2024-04-08 13:49:58', '2024-04-08 20:49:58', 1),
	(8, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/02', NULL, '2024-05-18 17:03:52', '2024-05-19 00:03:52', 1),
	(9, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/05', NULL, '2024-05-18 17:04:10', '2024-05-19 00:04:10', 1),
	(10, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/02', NULL, '2024-05-18 17:21:38', '2024-05-19 00:21:38', 1),
	(11, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/05', NULL, '2024-05-18 17:21:47', '2024-05-19 00:21:47', 1),
	(12, 'IT/BAST/2024/04/01', 'Add Attach', 'Adding Attachment for IT/REG/2024/01/05, <button onclick="window.location.href = \'dist/attach/bf1958fb2f0d1300bec09349f504e85321a11e8e.pdf\'" class="btn btn-sm btn-success">View</button>', NULL, '2024-05-18 17:37:21', '2024-05-19 00:37:21', 1),
	(14, 'IT/BAST/2024/04/01', 'Tambah Foto', 'tambah testing <button onclick="window.location.href = \'dist/img/history-img/6d9ab08ceb07f8aced1180e90a37e449f57c3be8.JPG\'" class="btn btn-sm btn-success">View</button>', '6d9ab08ceb07f8aced1180e90a37e449f57c3be8.JPG', '2024-05-18 17:52:15', '2024-05-19 00:52:15', 1);

-- Dumping structure for table bast.branch
CREATE TABLE IF NOT EXISTS `branch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `initial` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.branch: ~5 rows (approximately)
INSERT INTO `branch` (`id`, `initial`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'HOJKT', 'HEAD OFFICE JAKARTA', '2024-01-12 16:06:42', '2024-01-12 17:05:33', 1),
	(2, 'WSGNP', 'WORKSHOP GUNUNG PUTRI', '2024-01-12 16:06:42', '2024-01-12 17:05:33', 1),
	(5, 'REPPKU', 'REP OFFICE PEKANBARU', '2024-01-12 16:07:49', '2024-01-12 17:07:35', 1),
	(6, 'REPSBY', 'REP OFFICE SURABAYA', '2024-01-12 16:07:49', '2024-01-12 17:07:35', 1),
	(7, 'BOBPN', 'BRANCH OFFICE BALIKPAPAN', '2024-01-12 16:08:35', '2024-01-12 17:08:17', 1);

-- Dumping structure for table bast.dept
CREATE TABLE IF NOT EXISTS `dept` (
  `id` int NOT NULL AUTO_INCREMENT,
  `initial` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.dept: ~5 rows (approximately)
INSERT INTO `dept` (`id`, `initial`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'HRGA', 'HR & GA', '2024-01-12 16:24:37', '2024-01-12 17:23:57', 1),
	(2, 'QC', 'QUALITY CONTROL', '2024-01-12 16:24:37', '2024-01-12 17:23:57', 1),
	(3, 'PC', 'PROJECT CONTROL', '2024-01-12 16:24:56', '2024-01-12 17:24:40', 1),
	(4, 'PECRANES', 'PE CRANES', '2024-01-12 16:24:56', '2024-01-12 17:24:40', 1),
	(5, 'PS', 'PRODUCT & SERVICES', '2024-01-27 04:17:59', '2024-01-27 05:17:44', 1);

-- Dumping structure for table bast.goods
CREATE TABLE IF NOT EXISTS `goods` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `sn` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `specification` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_inv_type` int NOT NULL,
  `id_inv_group` int NOT NULL,
  `id_inv_allotment` int NOT NULL,
  `id_inv_branch` int NOT NULL,
  `id_inv_source` int NOT NULL,
  `id_inv_dept` int NOT NULL,
  `year` varchar(4) COLLATE utf8mb4_general_ci NOT NULL,
  `useful_period` int NOT NULL,
  `id_inv_condition` int NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT '0',
  `as_bast` tinyint(1) DEFAULT '0',
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.goods: ~5 rows (approximately)
INSERT INTO `goods` (`id`, `number`, `sn`, `description`, `specification`, `id_inv_type`, `id_inv_group`, `id_inv_allotment`, `id_inv_branch`, `id_inv_source`, `id_inv_dept`, `year`, `useful_period`, `id_inv_condition`, `notes`, `img`, `updated_at`, `created_at`, `as_dump`, `as_bast`, `created_by`) VALUES
	(2, 'IT/REG/2024/01/01', 'ABP-1232-AWD3-23FS-234F', 'SOUND SYSTEM MIFA K12', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 4, 1, 2, 1, 1, '2024', 3, 1, 'REFF PWR 2023/JKT-0142; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/4; TES', NULL, '2024-03-29 16:58:08', '2024-01-13 12:14:11', 1, 0, 1),
	(3, 'IT/REG/2024/01/02', 'ASDASDSF', 'MOUSE WIRELESS LOGITECH M190', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 1, 2, 2, 1, 3, '2024', 2, 1, 'REFF PWR ; REFF PO ;', NULL, '2024-04-08 08:26:31', '2024-01-15 22:03:04', 0, 1, 1),
	(4, 'IT/REG/2024/01/03', '2223LZ917BZ8', 'MOUSE WIRELESS LOGITECH M190', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 1, 1, 2, 2, 1, 2, '2024', 2, 1, 'REFF PWR 2023/JKT-0241; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/4; UNTUK MAHMUD', '72ff743b4caff43a37b2aa7c764a514b.jpg', '2024-01-16 13:40:45', '2024-01-16 20:40:45', 0, 0, 1),
	(5, 'IT/REG/2024/01/04', '132234-ASDASD-23423DA', 'LISENSI AEC 2024', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 2, 3, 2, 1, 1, 1, '2023', 1, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/6; TES', '', '2024-01-16 15:07:43', '2024-01-16 22:07:43', 0, 0, 1),
	(6, 'IT/REG/2024/01/05', 'APASAJABOLEH', 'LAPTOP ACER ASPIRE E14 E5-471', '<p>PROSESOR : <br>MEMORI :<br>HARD DRIVE :</p>', 2, 1, 2, 1, 3, 1, '2024', 10, 2, 'REFF LAIN-LAIN;', '25dc0b54a56cccef1051cbf493397b22.png', '2024-04-08 09:04:35', '2024-01-16 22:10:48', 0, 1, 1);

-- Dumping structure for table bast.good_incoming
CREATE TABLE IF NOT EXISTS `good_incoming` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.good_incoming: ~10 rows (approximately)
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

-- Dumping structure for table bast.good_incoming_details
CREATE TABLE IF NOT EXISTS `good_incoming_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_incoming` int NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sn` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pwr` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `po` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `img` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `as_inv` tinyint(1) NOT NULL DEFAULT '0',
  `as_dump` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.good_incoming_details: ~8 rows (approximately)
INSERT INTO `good_incoming_details` (`id`, `id_incoming`, `description`, `sn`, `pwr`, `po`, `type`, `notes`, `img`, `updated_at`, `created_at`, `as_inv`, `as_dump`, `created_by`) VALUES
	(1, 5, 'SOUND SYSTEM MIFA K12', 'ABP-1232-AWD3-23FS-234F', '2023/JKT-0142', '2023/JKT-L-0123', 1, 'TES', NULL, '2024-01-13 05:14:11', '2024-01-09 21:14:42', 1, 0, 1),
	(2, 5, 'LISENSI AEC 2024', 'ABP-1232-AWD3-23FS-234F1', '2024/JKT-0023', 'MEMO/JKT-0011', 2, 'AEC 2024 UNTUK ENG', NULL, '2024-01-27 16:17:21', '2024-01-09 21:28:04', 1, 0, 1),
	(6, 7, 'SOUND SYSTEM MIFA K12', '12312BHJB1JH23B', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', NULL, '2024-01-27 15:18:23', '2024-01-10 20:45:10', 0, 0, 1),
	(7, 7, 'LISENSI AEC 2024', '132234-ASDASD-23423DA', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'TES', NULL, '2024-01-16 15:07:43', '2024-01-10 21:02:57', 1, 0, 1),
	(8, 7, 'LISENSI SOLIDWORKS 2024', 'ASDADA-2342Q34A-SDDASD', '2024/JKT-0023', '2023/JKT-L-0123', 2, 'TES', NULL, '2024-01-27 16:18:15', '2024-01-10 21:03:34', 1, 0, 1),
	(9, 5, 'MOUSE WIRELESS LOGITECH M190', '2223LZ917BZ8', '2023/JKT-0241', '2023/JKT-L-0123', 1, 'UNTUK MAHMUD', '72ff743b4caff43a37b2aa7c764a514b.jpg', '2024-01-16 13:40:45', '2024-01-16 19:37:07', 1, 0, 1),
	(10, 5, 'MOUSE WIRELESS LOGITECH M170', '12712BJHDJSAD', '2024/JKT-0023', '2023/JKT-L-0123', 1, 'UNTUK EKA', 'a75c0c76c7237831e9003115b0396070.jpg', '2024-01-20 15:42:44', '2024-01-20 22:42:44', 0, 0, 1),
	(11, 5, 'LISENSI SOLIDWORKS 2024', '121NNDF-23423R2-23423F', '2024/JKT-0056', '2024/JKT-L-0023', 2, 'UNTUK ENGINERING', 'c4e786da9f59f9f0b5adb0b59d098355.jpg', '2024-02-26 13:27:07', '2024-02-26 20:27:07', 0, 0, 1);

-- Dumping structure for table bast.inv_allotment
CREATE TABLE IF NOT EXISTS `inv_allotment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.inv_allotment: ~0 rows (approximately)

-- Dumping structure for table bast.inv_condition
CREATE TABLE IF NOT EXISTS `inv_condition` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.inv_condition: ~4 rows (approximately)
INSERT INTO `inv_condition` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'BAIK', '2024-01-13 05:36:02', '2024-01-13 06:35:49', 1),
	(2, 'KURANG_BAIK', '2024-01-16 15:30:58', '2024-01-13 06:35:49', 1),
	(3, 'RUSAK', '2024-01-13 05:36:13', '2024-01-13 06:36:04', 1),
	(4, 'SCRAPT', '2024-01-13 05:36:13', '2024-01-13 06:36:04', 1);

-- Dumping structure for table bast.inv_group
CREATE TABLE IF NOT EXISTS `inv_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.inv_group: ~5 rows (approximately)
INSERT INTO `inv_group` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'LAPTOP', '2024-01-12 16:11:15', '2024-01-12 17:09:22', 1),
	(2, 'PC', '2024-01-12 16:11:15', '2024-01-12 17:09:22', 1),
	(3, 'PRINTER', '2024-01-12 16:11:45', '2024-01-12 17:11:18', 1),
	(4, 'MIKROTIK', '2024-01-12 16:11:45', '2024-01-12 17:11:18', 1),
	(5, 'SOUND SYSTEM', '2024-01-12 16:11:57', '2024-01-12 17:11:48', 1);

-- Dumping structure for table bast.inv_type
CREATE TABLE IF NOT EXISTS `inv_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.inv_type: ~3 rows (approximately)
INSERT INTO `inv_type` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'GOODS', '2024-01-12 16:13:24', '2024-01-12 17:13:07', 1),
	(2, 'LISENCES', '2024-01-12 16:13:24', '2024-01-12 17:13:07', 1),
	(3, 'CONSUMMABLES', '2024-01-12 16:13:48', '2024-01-12 17:13:27', 1);

-- Dumping structure for table bast.lic_type
CREATE TABLE IF NOT EXISTS `lic_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.lic_type: ~0 rows (approximately)

-- Dumping structure for table bast.lisences
CREATE TABLE IF NOT EXISTS `lisences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `sn` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `id_lic_type` int NOT NULL,
  `seats` int NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `id_lic_dept` int NOT NULL,
  `id_lic_branch` int NOT NULL,
  `id_lic_source` int NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci NOT NULL,
  `as_dump` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.lisences: ~3 rows (approximately)
INSERT INTO `lisences` (`id`, `number`, `sn`, `description`, `id_lic_type`, `seats`, `date_start`, `date_end`, `id_lic_dept`, `id_lic_branch`, `id_lic_source`, `notes`, `as_dump`, `updated_at`, `created_at`, `created_by`) VALUES
	(2, 'IT/LIC/2024/01/01', 'ABP-1232-AWD3-23FS-234F1', 'LISENSI AEC 2024', 2, 5, '2024-01-27 00:00:00', '2025-01-27 00:00:00', 1, 2, 1, 'REFF PWR 2024/JKT-0023; REFF PO MEMO/JKT-0011; RR IT IT/RR/2024/01/4; AEC 2024 UNTUK ENG', 0, '2024-01-27 16:17:21', '2024-01-27 23:17:21', 1),
	(3, 'IT/LIC/2024/01/02', 'ASDADA-2342Q34A-SDDASD', 'LISENSI SOLIDWORKS 2024', 1, 1, '2024-01-24 00:00:00', '0000-00-00 00:00:00', 5, 7, 1, 'REFF PWR 2024/JKT-0023; REFF PO 2023/JKT-L-0123; RR IT IT/RR/2024/01/6; TES', 0, '2024-03-02 17:37:27', '2024-01-27 23:18:15', 1),
	(4, 'IT/LIC/2024/02/01', 'AREA1-123DD-87WF3-14C5G-23MKL', 'MICROSOFT OFFICE PRO PLUS 2021', 1, 3, '2024-02-26 00:00:00', '0000-00-00 00:00:00', 3, 2, 1, 'REFF PWR 2023/JKT-0014 ; REFF PO 2023/JKT-L-0002;', 0, '2024-03-02 17:36:36', '2024-02-26 21:33:22', 1);

-- Dumping structure for table bast.session_log
CREATE TABLE IF NOT EXISTS `session_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `rand_code` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.session_log: ~2 rows (approximately)
INSERT INTO `session_log` (`id`, `user_id`, `rand_code`, `created_at`) VALUES
	(3, 1, 'ZGgtnYWE', '2023-11-29 09:50:34'),
	(4, 1, 'Fim3MuBY', '2023-12-06 04:52:08');

-- Dumping structure for table bast.source
CREATE TABLE IF NOT EXISTS `source` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.source: ~3 rows (approximately)
INSERT INTO `source` (`id`, `name`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'PWR', '2024-01-12 16:28:07', '2024-01-12 17:27:53', 1),
	(2, 'HIBAH', '2024-01-12 16:28:07', '2024-01-12 17:27:53', 1),
	(3, 'LAIN-LAIN', '2024-01-12 16:28:16', '2024-01-12 17:28:09', 1);

-- Dumping structure for table bast.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `initial` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_dept` int NOT NULL,
  `id_branch` int NOT NULL,
  `notes` text COLLATE utf8mb4_general_ci NOT NULL,
  `as_admin` int NOT NULL DEFAULT '0',
  `as_dump` tinyint(1) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bast.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `email`, `password`, `initial`, `name`, `nik`, `position`, `id_dept`, `id_branch`, `notes`, `as_admin`, `as_dump`, `updated_at`, `created_at`, `created_by`) VALUES
	(1, 'mahmudi.nurhasan@jpc.co.id', '$2a$12$54lFY47DRTOrUzlOB0lQ7.rP5sgNhenSPI.abJii.VhQisX3sA6Im', 'MHN', 'M NURHASAN MAHMUDI', 'JPC-JKT-825', 'IT SUPPORT', 1, 2, 'TES', 1, 0, '2024-01-26 15:58:34', '2023-11-29 09:28:31', NULL),
	(2, NULL, NULL, 'RCF', 'RICO FERNANDES', 'JPC-JKT-812', 'TECHNICAL SUPPORT', 5, 2, '-', 0, 0, '2024-04-06 08:39:27', '0000-00-00 00:00:00', 1),
	(3, NULL, NULL, 'FKA', 'RAFIKA ROSADI', '-', 'ADMIN HR&amp;GA', 1, 2, '-', 0, 0, '2024-04-06 08:37:26', '2024-04-06 15:37:26', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
