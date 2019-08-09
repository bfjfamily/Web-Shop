-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2019 at 09:33 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oopcas30`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `idart` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`idart`, `brand`, `model`, `description`, `price`, `image`) VALUES
(1, 'HP', 'elitebook', 'Bussiness laptop', 750, 'hp.jpg'),
(2, 'Asus', 'Zbook', 'For gamers...', 1200, 'asus.jpg'),
(3, 'Lenovo', 'yoga', 'Best laptop', 900, 'lenovo.jpg'),
(4, 'Apple', 'Macbook', 'Small notebook', 1400, 'apple.jpg'),
(5, 'Apple', 'Macbook Air', '13 inches', 1200, 'appleair.jpg'),
(6, 'Asus', 'Rog', 'republic of gamers', 1700, 'asusrog.jpg'),
(9, 'Fujitsu Siemens', 'Lifebook A Series', 'Fantastican Laptop', 850, 'Fujitsu.jpg'),
(11, 'Lenovo', 'T440', 'Excellent Business Laptop', 1000, 'lenovo2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `adress` text NOT NULL,
  `id_art` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `count` int(11) NOT NULL,
  `total` double NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sent` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `order_number`, `name`, `surname`, `email`, `phone`, `adress`, `id_art`, `brand`, `model`, `price`, `count`, `total`, `time`, `sent`) VALUES
(81, 6, 2, 'Nebojsa', 'Zivanpvic', 'nesa@gmail.com', '15649841', 'Srbobranska 19', 9, 'Fujitsu Siemens', 'Lifebook A Series', 850, 1, 850, '2019-05-18 14:34:41', 'yes'),
(82, 6, 2, 'Nebojsa', 'Zivanpvic', 'nesa@gmail.com', '15649841', 'Srbobranska 19', 4, 'Apple', 'Macbook', 1400, 1, 1400, '2019-05-18 14:34:41', 'yes'),
(83, 4, 2, 'Kristina', 'Ilic', 'kristina@gmail.com', '15649841', 'Guzva ', 6, 'Asus', 'Rog', 1700, 1, 1700, '2019-05-18 14:34:41', 'yes'),
(87, 6, 7, 'Nebojsa', 'Zivanpvic', 'nesa@gmail.com', '15649841', 'Srbobranska 19', 9, 'Fujitsu Siemens', 'Lifebook A Series', 850, 4, 3400, '2019-05-22 19:47:52', 'yes'),
(88, 6, 7, 'Nebojsa', 'Zivanpvic', 'nesa@gmail.com', '15649841', 'Srbobranska 19', 4, 'Apple', 'Macbook', 1400, 6, 8400, '2019-05-22 19:47:52', 'yes'),
(89, 6, 7, 'Nebojsa', 'Zivanpvic', 'nesa@gmail.com', '15649841', 'Srbobranska 19', 1, 'HP', 'elitebook', 750, 2, 1500, '2019-05-22 19:47:52', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adress` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `surname`, `email`, `adress`, `phone`, `username`, `password`, `admin`) VALUES
(1, 'Nikola', 'Dimitrijevic', 'nikola@gmail.com', 'Lomina 48', '065555555', 'admin', 'admin', 1),
(2, 'Nikola', 'Dimitrijevic', 'anchzb@yahoo.com', 'Lomina', '', 'nik', 'nik', 0),
(3, 'Maja', 'Maric', 'zavezbu123@gmail.com', 'Takovska', '', 'maja', 'maja123', 0),
(4, 'Kristina', 'Ilic', 'kristina@gmail.com', 'Guzva ', '', 'kristina', '12345', 0),
(6, 'Nebojsa', 'Zivanovic', 'nesa@gmail.com', 'Srbobranska 19', '15649841', 'nesa', 'nesa', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`idart`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `idart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
