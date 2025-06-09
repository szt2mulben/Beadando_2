-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql.omega:3306
-- Generation Time: Jun 09, 2025 at 07:36 PM
-- Server version: 5.7.42-log
-- PHP Version: 7.2.34-54+0~20250311.107+debian12~1.gbpd6988c

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaszilijedc1`
--

-- --------------------------------------------------------

--
-- Table structure for table `kepek`
--

CREATE TABLE `kepek` (
  `id` int(11) NOT NULL,
  `fajlnev` varchar(255) NOT NULL,
  `feltolto` varchar(100) DEFAULT NULL,
  `datum` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kepek`
--

INSERT INTO `kepek` (`id`, `fajlnev`, `feltolto`, `datum`) VALUES
(21, '1749476594_kozos.png', 'Bteszt', '2025-06-09 15:43:14'),
(22, '1749476604_youtube.png', 'Bteszt', '2025-06-09 15:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `subject` varchar(150) COLLATE utf8_hungarian_ci DEFAULT NULL,
  `message` text COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'asdasd', 'dsdsdsd@sdsd.com', 'asddfsf', 'sdfsdfsdfsdfssfagasdsdfasdsdfsdfsdfsdfssfagasdsdfasdsdfsdfsdfsdfssfagasdsdfasdsdfsdfsdfsdfssfagasdsdfasdsdfsdfsdfsdfssfagasdsdfasd', '2025-05-31 20:30:22'),
(2, 'Teszt Elek', 'elek@gmail.com', 'Miért ne?', 'Csokolom!\r\n\r\nasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdasasdasdasdsadasdas', '2025-06-09 16:41:53'),
(3, 'asdasd', 'adasd@com.asd', 'asdasd', 'asdadas', '2025-06-09 17:04:42'),
(4, 'sDASD', 'ASDASD@asd.com', 'asdasd', 'asdasdasdasd', '2025-06-09 17:05:57'),
(5, 'asdasd', 'dsdsdsd@d.com', 'sdsdsd', 'sdsdsdsdsd', '2025-06-09 17:31:35'),
(6, 'sdfsdf', 'sdfsdf@asd.com', 'sfghfghfgh', 'dfhdgdfgdfg', '2025-06-09 17:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('user','admin') COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(3, 'BAdmin', 'BenceTeszt@vp.com', '$2y$10$7uAWc8AhNxItCIKCOipCjebc8YLZCTmHFwc1qD4g86NieWO7CSdhy', '2025-06-09 10:43:02', 'admin'),
(4, 'BUser', 'BenceUser@vp.com', '$2y$10$/fm2ExSOcVt1ZpCj6QCkg.Bd/mc2vPWD59nZylWMs93MFapAOd8aO', '2025-06-09 15:07:50', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kepek`
--
ALTER TABLE `kepek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_username` (`username`),
  ADD UNIQUE KEY `uniq_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kepek`
--
ALTER TABLE `kepek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
