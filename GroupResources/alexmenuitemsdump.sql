-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2016 at 01:07 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE `menuitems` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `desc` varchar(5000) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 is active, 0 is inactive',
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`id`, `title`, `desc`, `active`, `Price`) VALUES
(1, 'Truffle Fries', 'Natural cut Julienne Fries fried in a delicious truffle oil.', b'1', 8),
(2, 'Osso Buco En Croute', 'Braised pork Osso Bucco baked with roasted root vegetables rich herb gravy served in a crispy puff pastry crust.', b'1', 30),
(3, 'Raspberry Lemonade ', 'Fresh lemons squeezed daily by our chefs complimented with real raspberry juice.', b'1', 3),
(4, 'Vanilla ice cream', 'Home made vanilla ice cream made with natural cream and Mexican vanilla.', b'1', 4.5),
(5, 'Bacon Cheeseburger', '1/3 Pound burger piled high with smoked apple wood bacon and cheddar cheese', b'1', 19.99),
(6, 'Chicken Quesadillas', 'Fresh flour tortilla, chicken breast, and cheese blend.', b'1', 11.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
