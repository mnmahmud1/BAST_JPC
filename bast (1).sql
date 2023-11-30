-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 11:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `id_bast_branch` varchar(50) NOT NULL,
  `id_user_submitted` int(3) NOT NULL,
  `id_user_accepted` int(3) NOT NULL,
  `notes` text NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

CREATE TABLE `dept` (
  `id` int(11) NOT NULL,
  `initial` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `number` varchar(30) NOT NULL,
  `desc` varchar(100) NOT NULL,
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
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `good_incoming`
--

CREATE TABLE `good_incoming` (
  `id` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `notes` text NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `good_incoming_details`
--

CREATE TABLE `good_incoming_details` (
  `id` int(11) NOT NULL,
  `id_incoming` int(11) NOT NULL,
  `desc` varchar(100) NOT NULL,
  `sn` varchar(40) NOT NULL,
  `pwr` varchar(20) NOT NULL,
  `po` varchar(20) NOT NULL,
  `type` int(11) NOT NULL,
  `notes` text NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_group`
--

CREATE TABLE `inv_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inv_type`
--

CREATE TABLE `inv_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 1, 'ZGgtnYWE', '2023-11-29 09:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_id` int(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `initial` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nik` varchar(15) NOT NULL,
  `position` varchar(50) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `id_branch` int(11) NOT NULL,
  `notes` text NOT NULL,
  `as_admin` int(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `initial`, `name`, `nik`, `position`, `id_dept`, `id_branch`, `notes`, `as_admin`, `updated_at`, `created_at`) VALUES
(1, 'mahmudi.nurhasan@jpc.co.id', '$2a$12$54lFY47DRTOrUzlOB0lQ7.rP5sgNhenSPI.abJii.VhQisX3sA6Im', 'MHN', 'M NURHASAN MAHMUDI', 'JPC-JKT-825', 'IT SUPPORT', 1, 1, '', 1, '2023-11-29 09:16:18', '2023-11-29 09:28:31');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bast_report_details`
--
ALTER TABLE `bast_report_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dept`
--
ALTER TABLE `dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `good_incoming`
--
ALTER TABLE `good_incoming`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `good_incoming_details`
--
ALTER TABLE `good_incoming_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inv_allotment`
--
ALTER TABLE `inv_allotment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inv_condition`
--
ALTER TABLE `inv_condition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inv_group`
--
ALTER TABLE `inv_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inv_type`
--
ALTER TABLE `inv_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
