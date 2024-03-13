-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 12:03 PM
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
-- Database: `schoolapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ocjene`
--

CREATE TABLE `ocjene` (
  `id_ocjene` int(11) NOT NULL,
  `naziv_ocjene` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `ocjene`
--

INSERT INTO `ocjene` (`id_ocjene`, `naziv_ocjene`) VALUES
(1, 'Nedovoljan (1)'),
(2, 'Dovoljan (2)'),
(3, 'Dobar (3)'),
(4, 'Vrlo dobar (4)'),
(5, 'Odličan (5)');

-- --------------------------------------------------------

--
-- Table structure for table `ocjene_ucenika`
--

CREATE TABLE `ocjene_ucenika` (
  `id` int(11) NOT NULL,
  `ucenik_id` int(11) NOT NULL,
  `predmet_id` int(11) NOT NULL,
  `ocjena_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `ocjene_ucenika`
--

INSERT INTO `ocjene_ucenika` (`id`, `ucenik_id`, `predmet_id`, `ocjena_id`, `created_at`, `updated_at`) VALUES
(3, 5, 13, 5, '2024-03-12 23:50:21', '2024-03-13 00:32:41'),
(4, 5, 10, 5, '2024-03-12 23:50:29', '2024-03-13 00:32:32'),
(7, 5, 9, 4, '2024-03-12 23:52:23', '2024-03-12 23:52:23'),
(8, 4, 4, 2, '2024-03-13 00:00:53', '2024-03-13 00:00:53'),
(9, 4, 6, 1, '2024-03-13 00:00:59', '2024-03-13 00:00:59'),
(10, 4, 12, 3, '2024-03-13 00:01:01', '2024-03-13 00:01:01'),
(11, 4, 9, 5, '2024-03-13 00:01:04', '2024-03-13 00:01:04'),
(12, 4, 1, 2, '2024-03-13 00:01:06', '2024-03-13 00:01:06'),
(13, 4, 7, 2, '2024-03-13 00:01:08', '2024-03-13 00:01:08'),
(14, 4, 14, 2, '2024-03-13 00:01:11', '2024-03-13 00:01:11'),
(15, 4, 5, 3, '2024-03-13 00:01:14', '2024-03-13 00:01:14'),
(16, 4, 2, 4, '2024-03-13 00:01:16', '2024-03-13 00:01:16'),
(17, 4, 11, 5, '2024-03-13 00:01:19', '2024-03-13 00:01:19'),
(18, 4, 3, 2, '2024-03-13 00:01:21', '2024-03-13 00:01:21'),
(19, 4, 10, 1, '2024-03-13 00:01:23', '2024-03-13 00:01:23'),
(21, 5, 12, 4, '2024-03-13 00:06:57', '2024-03-13 00:45:33'),
(23, 5, 4, 5, '2024-03-13 00:09:41', '2024-03-13 00:09:41'),
(27, 5, 5, 2, '2024-03-13 00:09:49', '2024-03-13 00:32:37'),
(28, 5, 1, 1, '2024-03-13 00:10:02', '2024-03-13 00:10:02'),
(29, 4, 13, 5, '2024-03-13 00:24:50', '2024-03-13 00:24:50'),
(30, 5, 7, 4, '2024-03-13 00:32:46', '2024-03-13 00:32:46'),
(31, 5, 14, 2, '2024-03-13 00:33:03', '2024-03-13 00:33:03'),
(32, 5, 3, 5, '2024-03-13 00:33:05', '2024-03-13 00:33:09'),
(33, 6, 10, 5, '2024-03-13 00:46:28', '2024-03-13 00:46:28'),
(34, 6, 13, 4, '2024-03-13 00:46:33', '2024-03-13 00:46:33'),
(35, 6, 4, 4, '2024-03-13 00:46:38', '2024-03-13 00:46:38'),
(36, 6, 7, 2, '2024-03-13 00:46:43', '2024-03-13 00:49:15'),
(38, 7, 6, 2, '2024-03-13 10:45:47', '2024-03-13 10:45:47'),
(39, 7, 4, 1, '2024-03-13 10:45:58', '2024-03-13 10:45:58');

-- --------------------------------------------------------

--
-- Table structure for table `predmeti`
--

CREATE TABLE `predmeti` (
  `id_predmeta` int(11) NOT NULL,
  `naziv_predmeta` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `predmeti`
--

INSERT INTO `predmeti` (`id_predmeta`, `naziv_predmeta`, `created_at`, `updated_at`) VALUES
(1, 'Hrvatski jezik', '2024-03-12 22:16:15', '2024-03-12 22:16:15'),
(2, 'Matematika', '2024-03-12 22:22:46', '2024-03-12 22:22:46'),
(3, 'Geografija', '2024-03-12 22:34:42', '2024-03-12 22:40:04'),
(4, 'Biologija', '2024-03-12 22:38:06', '2024-03-12 22:39:57'),
(5, 'Povijest', '2024-03-12 22:40:09', '2024-03-12 22:40:09'),
(6, 'Engleski jezik', '2024-03-12 22:40:52', '2024-03-12 22:40:52'),
(7, 'Kemija', '2024-03-12 22:40:59', '2024-03-12 22:40:59'),
(9, 'Fizika', '2024-03-12 22:42:55', '2024-03-12 22:42:55'),
(10, 'Informatika', '2024-03-12 22:43:02', '2024-03-12 22:43:02'),
(11, 'Likovna kultura', '2024-03-12 22:43:09', '2024-03-12 22:43:09'),
(12, 'Glazbeni jezik', '2024-03-12 22:43:14', '2024-03-12 22:43:14'),
(13, 'Tjelesna i zdravstvena kultura', '2024-03-12 22:43:22', '2024-03-12 22:43:22'),
(14, 'Njemački jezik', '2024-03-12 22:43:30', '2024-03-12 22:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `ucenici`
--

CREATE TABLE `ucenici` (
  `id_ucenika` int(11) NOT NULL,
  `naziv_ucenika` varchar(70) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `lozinka` varchar(40) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `ucenici`
--

INSERT INTO `ucenici` (`id_ucenika`, `naziv_ucenika`, `email`, `lozinka`, `created_at`, `updated_at`) VALUES
(4, 'Ivo Ivić', '', '', '2024-03-12 22:59:36', '2024-03-12 22:59:36'),
(5, 'Ana Anić', '', '', '2024-03-12 23:00:22', '2024-03-12 23:00:22'),
(6, 'Monika Mikec', 'monikamikec03@gmail.com', '123456', '2024-03-13 00:45:50', '2024-03-13 00:45:50'),
(7, 'Maja Majić', '', '', '2024-03-13 10:44:58', '2024-03-13 10:44:58'),
(8, 'Petar Petek', '', '', '2024-03-13 10:46:28', '2024-03-13 10:46:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ocjene`
--
ALTER TABLE `ocjene`
  ADD PRIMARY KEY (`id_ocjene`);

--
-- Indexes for table `ocjene_ucenika`
--
ALTER TABLE `ocjene_ucenika`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ocjena_id` (`ocjena_id`),
  ADD KEY `predmet_id` (`predmet_id`),
  ADD KEY `ucenik_id` (`ucenik_id`);

--
-- Indexes for table `predmeti`
--
ALTER TABLE `predmeti`
  ADD PRIMARY KEY (`id_predmeta`);

--
-- Indexes for table `ucenici`
--
ALTER TABLE `ucenici`
  ADD PRIMARY KEY (`id_ucenika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ocjene`
--
ALTER TABLE `ocjene`
  MODIFY `id_ocjene` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ocjene_ucenika`
--
ALTER TABLE `ocjene_ucenika`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `predmeti`
--
ALTER TABLE `predmeti`
  MODIFY `id_predmeta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ucenici`
--
ALTER TABLE `ucenici`
  MODIFY `id_ucenika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ocjene_ucenika`
--
ALTER TABLE `ocjene_ucenika`
  ADD CONSTRAINT `ocjene_ucenika_ibfk_1` FOREIGN KEY (`ocjena_id`) REFERENCES `ocjene` (`id_ocjene`),
  ADD CONSTRAINT `ocjene_ucenika_ibfk_2` FOREIGN KEY (`predmet_id`) REFERENCES `predmeti` (`id_predmeta`),
  ADD CONSTRAINT `ocjene_ucenika_ibfk_3` FOREIGN KEY (`ucenik_id`) REFERENCES `ucenici` (`id_ucenika`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
