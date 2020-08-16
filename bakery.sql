-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2020 at 07:20 AM
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
(34, 'Sany', 'mazharulalam26@gmail.com', 'asd', '01876626011', 'dbe69a6a3ff6a1180d5ccd2627eb26', 'active'),
(35, 'Men', 'mazharalam753@gmail.com', 'asd', '01876626011', 'c4753ef78b7b19af2a044761916b18', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `item-detail`
--

CREATE TABLE `item-detail` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` text NOT NULL,
  `price` text NOT NULL,
  `description` text NOT NULL,
  `img` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item-detail`
--

INSERT INTO `item-detail` (`id`, `name`, `quantity`, `category`, `price`, `description`, `img`) VALUES
(18, 'cake', 0, 'cakes', '250', 'this is a cake', '../assets/images/birthday.png'),
(21, 'triple chocolate layer cake', 0, 'cakes', '300', 'this is occasional chocoate cake', '../assets/images/triple-chocolate-cake.jpg'),
(22, 'ombre wadding cake', 0, 'cakes', '299', 'this is an wedding cake design. here is many color of designs available', '../assets/images/ombre-wedding-cake.jpg'),
(23, 'pumpkin chocolate chip cookies', 0, 'coockies', '20', 'this is best pumpkin chocolate chip cookies', '../assets/images/pumpkin-chocolate-chip-cookies.jpg'),
(24, 'crazy color coockie', 0, 'coockies', '20', 'this is crazy color cookies, Different types of colors and Taste', '../assets/images/Crazy-No-Bake-Cookies.jpg');

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
  `order_time` text NOT NULL,
  `complete_order_date` text NOT NULL,
  `courier` int(11) NOT NULL,
  `customer` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `address`, `product_id`, `product_quantity`, `order_no`, `status`, `order_date`, `order_time`, `complete_order_date`, `courier`, `customer`) VALUES
(87, 'Rahmannagar', '18', 2, 1, 'request', '16-08-2020', '04:39:05', '', 0, 35),
(86, 'Rahmannagar', '21', 2, 1, 'request', '16-08-2020', '04:39:05', '', 0, 35),
(88, 'Rahmannagar', '18', 6, 2, 'request', '16-08-2020', '04:39:47', '', 0, 35),
(89, 'Hathajari', '21', 5, 3, 'request', '16-08-2020', '04:40:52', '', 0, 34);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `payment_method` text NOT NULL,
  `transaction_code` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `order_no`, `payment_method`, `transaction_code`) VALUES
(2, 35, 1, 'bkash', '1234567890'),
(3, 35, 2, 'bkash', 'dasdfdgfgfbh'),
(4, 34, 3, 'bkash', 'sdfvsd34325e');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `item-detail`
--
ALTER TABLE `item-detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
