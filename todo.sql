-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2019 at 04:29 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
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
  `project` longtext NOT NULL,
  `parentchild` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pegawai` varchar(30) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `deleted_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_pegawai`, `username`, `email`, `password`, `deleted_status`) VALUES
(1, '1', 'admin', 'admin@gspe.co.id', 'vio', 0),
(2, '205017793', 'Firdauz Fanani', 'firdauzfanani@gmail.com', 'vio', 0),
(3, '723606683', 'Faza Ghassani', 'fazaghassani.96@gmail.com', 'vio', 0),
(4, '668662889', 'Riyadi Agung Suharto', 'roy.agoeng@gmail.com', 'vio', 0),
(5, '376571445', 'Wahyudi Prasatia', 'wahyudiprasatia3@gmail.com', 'vio', 0),
(6, '692286966', 'Muhammad Reiza Syaifullah', 'mreizasyaifullah@gmail.com', 'vio', 0),
(7, '644107942', 'Liza A Barezi', 'lizabarezi@gmail.com', 'vio', 0),
(8, '764143199', 'Vicky Yuliandi Siahaan', 'vicky.yuliandi.s@gmail.com', 'vio', 0),
(9, '252488349', 'Muhammad Yasir Abdulazis', 'rayas143120@gmail.com ', 'vio', 0),
(10, '757158209', 'Dwi Prasetyo', 'setyodwipra@gmail.com', 'vio', 1),
(11, '670747420', 'Imam Sulthon', 'sulthon.imam@gmail.com ', 'vio', 0),
(12, '690578780', 'Angga', 'pradipptaa@gmail.com', 'vio', 0);

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
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
