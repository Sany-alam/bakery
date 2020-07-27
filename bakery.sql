-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2020 at 06:46 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
(3, 'coockies', '../assets/images/3coockie.png'),
(5, 'pastry', '');

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE `courier` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `phone` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `name`, `phone`, `status`, `password`) VALUES
(5, 'asd', '01876626011', 0, 'asd'),
(2, 'shajib', '01812222222', 0, '123'),
(3, 'zozo', '656666256', 0, 'asd'),
(4, 'Sany', '01876626011', 0, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `phone` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `email_status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `phone`, `token`, `email_status`) VALUES
(5, 'Men', 'mazharalam753@gmail.com', 'asd', '01876626011', '', ''),
(6, 'rafi', 'salah1234@gmail.com', 'asd', '01876626011', '', ''),
(7, 'htaccess', 'JoinalAbedinIshan@gmail.com', 'asd', '01876626011', '', ''),
(15, 'Sany', 'mazharulalam26@gmail.com', 'asd', '01876626011', '4a93355b8dcfdaca5203a7ccc9ca96', 'active');

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
(21, 'triple chocolate layer cake', 'cakes', '300', 'this is occasional chocoate cake', '../assets/images/triple-chocolate-cake.jpg'),
(22, 'ombre wadding cake', 'cakes', '299', 'this is an wedding cake design. here is many color of designs available', '../assets/images/ombre-wedding-cake.jpg'),
(23, 'pumpkin chocolate chip cookies', 'coockies', '20', 'this is best pumpkin chocolate chip cookies', '../assets/images/pumpkin-chocolate-chip-cookies.jpg'),
(24, 'crazy color coockie', 'coockies', '20', 'this is crazy color cookies, Different types of colors and Taste', '../assets/images/Crazy-No-Bake-Cookies.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `product_id` text NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `status` text NOT NULL,
  `order_date` text NOT NULL,
  `complete_order_date` text NOT NULL,
  `courier` int(11) NOT NULL,
  `customer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `address`, `product_id`, `product_quantity`, `order_no`, `status`, `order_date`, `complete_order_date`, `courier`, `customer`) VALUES
(50, 'asfgfdfhgjkk\nukfhyukhk\nkhjk\njkjhkhf\nkhjfk\nfhkhjk\nhjkhj\nkj', '21', 2, 2, 'complete', '20-07-2020', '20-07-2020', 2, 6),
(49, 'asfgfdfhgjkk\nukfhyukhk\nkhjk\njkjhkhf\nkhjfk\nfhkhjk\nhjkhj\nkj', '23', 2, 2, 'complete', '20-07-2020', '20-07-2020', 2, 6),
(48, 'Rahmannagar', '22', 3, 1, 'complete', '20-07-2020', '20-07-2020', 2, 6),
(47, 'Rahmannagar', '24', 3, 1, 'complete', '20-07-2020', '20-07-2020', 2, 6);

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
-- Indexes for table `customer`
--
ALTER TABLE `customer`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `item-detail`
--
ALTER TABLE `item-detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
