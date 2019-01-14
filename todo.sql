-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2019 at 02:08 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` longtext CHARACTER SET cp1250 NOT NULL,
  `detail` longtext NOT NULL,
  `kendala` longtext NOT NULL,
  `due_date` date NOT NULL,
  `progress` int(2) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `delete_status` tinyint(4) NOT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `detail`, `kendala`, `due_date`, `progress`, `user`, `user_name`, `done`, `delete_status`, `created`) VALUES
(1, 'GUI Testing', 'tetes', 'Hello tes', '2019-01-22', 75, '081567920578', 'Firdauz Fanani', 0, 0, '2019-01-14 09:59:25'),
(2, 'Testing', 'testes', 'Test hell', '2019-01-16', 100, '081567920578', 'Firdauz Fanani', 0, 0, '2019-01-14 10:56:22'),
(3, 'Tes harras', 'wadehel testing iki 2', 'heheheh', '2019-01-15', 85, '081567920578', 'Firdauz Fanani', 0, 0, '2019-01-14 11:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pegawai` varchar(30) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_pegawai`, `username`, `password`) VALUES
(1, '1', 'admin', 'vio'),
(2, '081567920578', 'Firdauz Fanani', 'vio'),
(3, '089676824961', 'Faza Ghasani', 'vio'),
(4, '0817737727', 'Riyadi Agung Suharto', 'vio'),
(5, '085363236007', 'Wahyudi Prasatia', 'vio'),
(6, '085274521796', 'Muhammad Reiza Syaifullah', 'vio'),
(7, '085725180999', 'Liza A Barezi', 'vio'),
(8, '08128552527', 'Vicky Yuliandi Siahaan', 'vio'),
(9, '081703078960', 'Muhammad Yasir Abdulazis', 'vio'),
(10, '085224666426', 'Dwi Prasetyo', 'vio'),
(11, '081917558038', 'Imam Sulthon', 'vio'),
(12, '0895802914769', 'Angga', 'vio');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
