-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2020 at 08:57 PM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bakery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `language` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`first_name`, `last_name`, `id`, `name`, `email`, `password`, `phone`, `address`, `city`, `language`) VALUES
('Mazharul', 'Alam', 2, 'Sany', 'mazharulalam26@gmail.com', 'admin', '01876626011', 'Rahmannagar ', 'rahmannagar', 'Bangla'),
('Sany', 'Alam', 3, 'sany1', 'playerc950@gmail.com', 'admin', '01876626011', 'Rahmannagar ', 'rahmannagar', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `img`) VALUES
(1, 'cakes', '../assets/images/cakes.png'),
(3, 'coockies', '../assets/images/3coockie.png');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `name`, `phone`, `status`, `img`) VALUES
(1, 'robert', '+8801811111111', 1, '../assets/images/robert.png'),
(2, 'shajib', '01812222222', 0, ''),
(3, 'zozo', '018********', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `item-detail`
--

CREATE TABLE `item-detail` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category` text NOT NULL,
  `price` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item-detail`
--

INSERT INTO `item-detail` (`id`, `name`, `category`, `price`, `description`, `img`) VALUES
(18, 'cake', 'cakes', '250', 'this is a cake', '../assets/images/birthday.png'),
(19, 'coockie', 'coockies', '30', 'biscuit', '../assets/images/3coockie.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `product_id` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `status` text NOT NULL,
  `order_date` text NOT NULL,
  `complete_order_date` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `product_id`, `product_quantity`, `order_no`, `status`, `order_date`, `complete_order_date`) VALUES
(16, 'sany', 'mazharalam753@gmail.com', '01876626011', 'Rahmannagar ', '18', 4, 2, 'request', '27-12-2019', ''),
(15, 'rafi', 'playerc950@gmail.com', '01876626011', 'Rahmannagar ', '18', 2, 1, '1', '27-12-2019', ''),
(14, 'rafi', 'playerc950@gmail.com', '01876626011', 'Rahmannagar ', '19', 2, 1, '1', '27-12-2019', ''),
(17, 'sany', 'mazharalam753@gmail.com', '01876626011', 'Rahmannagar ', '19', 4, 2, 'request', '27-12-2019', ''),
(18, 'jahed', 'mazharulalam26@gmail.com', '01876626011', 'Rahmannagar ', '19', 1, 3, 'complete', '27-12-2019', '31-12-2019'),
(19, 'shajib', 'mazharalam753@gmail.com', '01876626011', 'Rahmannagar ', '19', 3, 4, 'request', '27-12-2019', ''),
(20, 'shajib', 'mazharalam753@gmail.com', '01876626011', 'Rahmannagar ', '18', 1, 4, 'request', '27-12-2019', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item-detail`
--
ALTER TABLE `item-detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item-detail`
--
ALTER TABLE `item-detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
