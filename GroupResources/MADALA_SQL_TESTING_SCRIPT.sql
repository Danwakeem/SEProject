-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 24, 2016 at 11:21 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `superfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Appetizer'),
(2, 'Entree'),
(3, 'Drink'),
(4, 'Desert'),
(5, 'Lunch');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `menuItemId` int(11) NOT NULL,
  `ingredient` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menuItemCategory`
--

CREATE TABLE `menuItemCategory` (
  `categoryId` int(11) NOT NULL,
  `menuItemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuItemCategory`
--

INSERT INTO `menuItemCategory` (`categoryId`, `menuItemId`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `menuItems`
--

CREATE TABLE `menuItems` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `desc` varchar(5000) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 is active, 0 is inactive',
  `Price` float NOT NULL,
  `timesOrdered` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuItems`
--

INSERT INTO `menuItems` (`id`, `title`, `desc`, `active`, `Price`, `timesOrdered`) VALUES
(1, 'Truffle Fries', 'Natural cut Julienne Fries fried in a delicious truffle oil.', b'1', 8, 1),
(2, 'Osso Buco En Croute', 'Braised pork Osso Bucco baked with roasted root vegetables rich herb gravy served in a crispy puff pastry crust.', b'1', 30, 0),
(3, 'Raspberry Lemonade ', 'Fresh lemons squeezed daily by our chefs complimented with real raspberry juice.', b'1', 3, 0),
(4, 'Vanilla ice cream', 'Home made vanilla ice cream made with natural cream and Mexican vanilla.', b'1', 4.5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderItems`
--

CREATE TABLE `orderItems` (
  `orderId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `notes` varchar(250) NOT NULL DEFAULT 'N/A'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderItems`
--

INSERT INTO `orderItems` (`orderId`, `menuId`, `quantity`, `notes`) VALUES
(33, 1, 1, 'No cheese on top please'),
(33, 2, 2, 'N/A'),
(33, 4, 1, 'N/A'),
(34, 1, 1, 'N/A'),
(34, 2, 1, 'N/A'),
(34, 4, 1, 'If you have any chocolate fudge please put it on top!'),
(35, 1, 1, 'N/A'),
(35, 2, 1, 'N/A'),
(35, 4, 1, 'N/A'),
(36, 1, 1, 'N/A'),
(36, 2, 1, 'N/A'),
(37, 1, 1, 'N/A'),
(38, 1, 1, 'N/A'),
(38, 2, 1, 'N/A'),
(39, 1, 1, 'N/A'),
(39, 2, 1, 'N/A'),
(40, 1, 1, 'N/A'),
(40, 2, 1, 'N/A'),
(41, 1, 1, 'N/A'),
(42, 1, 1, 'N/A'),
(43, 1, 1, 'N/A'),
(44, 1, 2, 'N/A'),
(44, 2, 1, 'N/A'),
(45, 1, 2, 'N/A'),
(45, 2, 1, 'N/A'),
(46, 1, 1, 'N/A'),
(46, 2, 2, 'N/A'),
(47, 1, 2, 'N/A'),
(48, 1, 1, 'N/A'),
(49, 1, 2, 'N/A'),
(49, 2, 1, 'N/A'),
(50, 1, 1, 'N/A'),
(50, 2, 2, 'N/A'),
(51, 1, 2, 'N/A'),
(52, 1, 1, 'N/A'),
(53, 1, 2, 'N/A'),
(54, 1, 1, 'N/A'),
(54, 2, 1, 'N/A'),
(55, 1, 1, 'N/A'),
(55, 2, 1, 'N/A'),
(56, 1, 1, 'N/A'),
(56, 2, 1, 'N/A'),
(57, 1, 2, 'N/A'),
(58, 1, 1, 'N/A'),
(59, 1, 1, 'N/A'),
(60, 1, 1, 'N/A'),
(61, 1, 1, 'N/A'),
(62, 1, 2, 'N/A'),
(63, 1, 1, 'N/A'),
(64, 1, 2, 'N/A'),
(65, 1, 3, 'No cheese on top please.'),
(65, 2, 2, 'N/A'),
(66, 1, 2, 'N/A'),
(66, 4, 1, 'If you could put this on top of the fries I would love you forever.'),
(67, 1, 2, 'No cheese'),
(67, 2, 1, 'N/A'),
(68, 1, 2, 'No cheese'),
(68, 2, 1, 'N/A'),
(69, 1, 2, 'No cheese'),
(69, 2, 1, 'N/A'),
(70, 1, 2, 'No cheese'),
(70, 2, 1, 'N/A'),
(71, 1, 2, 'No cheese'),
(71, 2, 1, 'N/A'),
(72, 1, 2, 'No cheese'),
(72, 2, 1, 'N/A'),
(73, 1, 2, 'No cheese'),
(73, 2, 1, 'N/A'),
(74, 1, 2, 'No cheese'),
(74, 2, 1, 'N/A'),
(75, 1, 2, 'No cheese'),
(75, 2, 1, 'N/A'),
(76, 1, 2, 'No cheese'),
(76, 2, 1, 'N/A'),
(77, 1, 2, 'No cheese'),
(77, 2, 1, 'N/A'),
(78, 1, 2, 'No cheese'),
(78, 2, 1, 'N/A'),
(79, 1, 2, 'No cheese'),
(79, 2, 1, 'N/A'),
(80, 1, 2, 'No cheese'),
(80, 2, 1, 'N/A'),
(81, 1, 2, 'No cheese'),
(81, 2, 1, 'N/A'),
(82, 1, 2, 'No cheese'),
(82, 2, 1, 'N/A'),
(83, 1, 2, 'No cheese'),
(83, 2, 1, 'N/A'),
(84, 1, 2, 'No cheese'),
(84, 2, 1, 'N/A'),
(85, 1, 2, 'No cheese'),
(85, 2, 1, 'N/A'),
(86, 1, 2, 'No cheese'),
(86, 2, 1, 'N/A'),
(87, 1, 2, 'No cheese'),
(87, 2, 1, 'N/A'),
(88, 1, 2, 'No cheese'),
(88, 2, 1, 'N/A'),
(89, 1, 2, 'No cheese'),
(89, 2, 1, 'N/A'),
(90, 1, 2, 'No cheese'),
(90, 2, 1, 'N/A'),
(91, 1, 2, 'No cheese'),
(91, 2, 1, 'N/A'),
(92, 1, 2, 'No cheese'),
(92, 2, 1, 'N/A'),
(93, 1, 2, 'No cheese'),
(93, 2, 1, 'N/A'),
(94, 1, 2, 'No cheese'),
(94, 2, 1, 'N/A'),
(95, 1, 2, 'No cheese'),
(95, 2, 1, 'N/A'),
(96, 1, 2, 'No cheese'),
(96, 2, 1, 'N/A'),
(97, 1, 2, 'No cheese'),
(97, 2, 1, 'N/A'),
(98, 1, 2, 'No cheese'),
(98, 2, 1, 'N/A'),
(99, 1, 2, 'No cheese'),
(99, 2, 1, 'N/A'),
(100, 1, 2, 'No cheese'),
(100, 2, 1, 'N/A'),
(101, 1, 2, 'No cheese'),
(101, 2, 1, 'N/A'),
(102, 1, 2, 'No cheese'),
(102, 2, 1, 'N/A'),
(103, 1, 2, 'No cheese'),
(103, 2, 1, 'N/A'),
(104, 1, 2, 'No cheese'),
(104, 2, 1, 'N/A'),
(105, 1, 2, 'No cheese'),
(105, 2, 1, 'N/A'),
(106, 1, 2, 'No Cheese'),
(106, 2, 1, 'N/A'),
(107, 1, 2, 'No Cheese'),
(107, 2, 1, 'N/A'),
(108, 1, 2, 'No Cheese'),
(108, 2, 1, 'N/A'),
(109, 1, 2, 'No Cheese'),
(109, 2, 1, 'N/A'),
(110, 1, 2, 'No Cheese'),
(110, 2, 1, 'N/A'),
(111, 1, 2, 'N/A'),
(112, 1, 2, 'N/A'),
(113, 1, 2, 'No cheese please. '),
(113, 2, 1, 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` varchar(256) NOT NULL DEFAULT 'InProgress',
  `tableId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `tableId`, `customerId`, `date`) VALUES
(33, 'Paid', 5, NULL, '2016-04-16 14:49:37'),
(34, 'Paid', 7, NULL, '2016-04-16 15:21:34'),
(35, 'Paid', 7, NULL, '2016-04-17 01:57:29'),
(36, 'Paid', 8, NULL, '2016-04-17 01:58:17'),
(37, 'Paid', 8, NULL, '2016-04-17 02:05:31'),
(38, 'Paid', 6, NULL, '2016-04-17 14:38:39'),
(39, 'Paid', 3, NULL, '2016-04-17 14:50:16'),
(40, 'Paid', 3, NULL, '2016-04-17 16:16:26'),
(41, 'Paid', 3, NULL, '2016-04-17 17:11:52'),
(42, 'Paid', 3, NULL, '2016-04-17 17:16:50'),
(43, 'Paid', 3, NULL, '2016-04-17 17:35:45'),
(44, 'Paid', 3, NULL, '2016-04-17 18:11:46'),
(45, 'Paid', 3, NULL, '2016-04-17 18:15:06'),
(46, 'Paid', 3, NULL, '2016-04-17 18:16:34'),
(47, 'Paid', 3, NULL, '2016-04-17 18:17:25'),
(48, 'Paid', 3, NULL, '2016-04-17 18:19:51'),
(49, 'Paid', 3, NULL, '2016-04-17 18:26:01'),
(50, 'Paid', 3, NULL, '2016-04-17 19:05:38'),
(51, 'Paid', 3, NULL, '2016-04-17 19:09:03'),
(52, 'Paid', 3, NULL, '2016-04-17 19:10:29'),
(53, 'Paid', 3, NULL, '2016-04-17 19:14:06'),
(54, 'Paid', 3, NULL, '2016-04-17 19:18:00'),
(55, 'Paid', 3, NULL, '2016-04-17 19:20:06'),
(56, 'Paid', 3, NULL, '2016-04-17 19:22:50'),
(57, 'Paid', 5, NULL, '2016-04-18 04:25:37'),
(58, 'Paid', 5, NULL, '2016-04-18 04:37:37'),
(59, 'Paid', 5, NULL, '2016-04-18 04:38:46'),
(60, 'Paid', 3, NULL, '2016-04-18 04:40:58'),
(61, 'Paid', 3, NULL, '2016-04-18 04:42:44'),
(62, 'Paid', 3, NULL, '2016-04-18 04:49:27'),
(65, 'Paid', 5, NULL, '2016-04-18 17:30:52'),
(66, 'Paid', 5, NULL, '2016-04-18 17:34:34'),
(79, 'Paid', 3, NULL, '2016-04-21 06:14:34'),
(80, 'Paid', 3, NULL, '2016-04-21 06:14:58'),
(81, 'Paid', 3, NULL, '2016-04-21 06:17:41'),
(82, 'Paid', 3, NULL, '2016-04-21 06:18:25'),
(83, 'Paid', 3, NULL, '2016-04-21 06:19:07'),
(84, 'Paid', 3, NULL, '2016-04-21 06:21:00'),
(85, 'Paid', 3, NULL, '2016-04-21 06:21:51'),
(86, 'Paid', 3, NULL, '2016-04-21 06:23:21'),
(87, 'Paid', 3, NULL, '2016-04-21 06:23:32'),
(88, 'Paid', 3, NULL, '2016-04-21 06:36:23'),
(89, 'Paid', 3, NULL, '2016-04-21 06:37:02'),
(90, 'Paid', 3, NULL, '2016-04-21 06:37:25'),
(91, 'Paid', 3, NULL, '2016-04-21 06:39:30'),
(92, 'Paid', 3, NULL, '2016-04-21 06:39:56'),
(93, 'Paid', 3, NULL, '2016-04-21 06:40:05'),
(94, 'Paid', 3, NULL, '2016-04-21 06:45:37'),
(95, 'Paid', 3, NULL, '2016-04-21 06:46:10'),
(96, 'Paid', 3, NULL, '2016-04-21 06:46:50'),
(97, 'Paid', 3, NULL, '2016-04-21 06:46:52'),
(98, 'Paid', 3, NULL, '2016-04-21 06:50:38'),
(99, 'Paid', 3, NULL, '2016-04-21 06:51:06'),
(100, 'Paid', 3, NULL, '2016-04-21 06:52:07'),
(101, 'Paid', 3, NULL, '2016-04-21 06:52:52'),
(102, 'Paid', 3, NULL, '2016-04-21 06:54:49'),
(103, 'Paid', 3, NULL, '2016-04-21 07:00:54'),
(104, 'Paid', 3, NULL, '2016-04-21 08:02:18'),
(105, 'Paid', 3, NULL, '2016-04-21 08:02:53'),
(106, 'Paid', 3, NULL, '2016-04-21 08:07:16'),
(107, 'Paid', 3, NULL, '2016-04-21 08:08:24'),
(108, 'Paid', 3, NULL, '2016-04-21 08:08:48'),
(109, 'Paid', 3, NULL, '2016-04-21 08:09:02'),
(110, 'Paid', 3, NULL, '2016-04-21 08:09:39'),
(111, 'Paid', 5, NULL, '2016-04-22 06:33:23'),
(112, 'Paid', 5, NULL, '2016-04-22 06:33:44'),
(113, 'Paid', 3, NULL, '2016-04-22 17:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `menuItemId` int(11) NOT NULL,
  `path` varchar(256) NOT NULL COMMENT 'server path'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `menuItemId`, `path`) VALUES
(1, 1, 'assets/tFries.jpg'),
(2, 2, 'assets/ossobuco.jpg'),
(3, 3, 'assets/rLemons.jpg'),
(4, 4, 'assets/VanillaIce.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `userType` varchar(256) NOT NULL DEFAULT 'customer',
  `Status` varchar(256) NOT NULL DEFAULT 'Ready'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `userType`, `Status`) VALUES
(1, 'Danwakeem', 'password', 'customer', 'Ready'),
(2, 'Dodo', 'password', 'waiter', 'Ready'),
(3, 'table1', 'table1', 'table', 'Ready'),
(4, 'table2', 'table2', 'table', 'Ready'),
(5, 'table3', 'table3', 'table', 'Ready'),
(6, 'table4', 'table4', 'table', 'Ready'),
(7, 'table5', 'table5', 'table', 'Ready'),
(8, 'table6', 'table6', 'table', 'Ready'),
(9, 'table7', 'table7', 'table', 'Ready'),
(10, 'table8', 'table8', 'table', 'Ready'),
(11, 'table9', 'table9', 'table', 'Ready'),
(12, 'table10', 'table10', 'table', 'Ready'),
(13, 'Carl', 'Carl', 'chef', 'Ready');

-- --------------------------------------------------------

--
-- Table structure for table `userTables`
--

CREATE TABLE `userTables` (
  `userID` int(11) NOT NULL,
  `tableID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userTables`
--

INSERT INTO `userTables` (`userID`, `tableID`) VALUES
(2, 3),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menuItems`
--
ALTER TABLE `menuItems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`tableId`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menuItems`
--
ALTER TABLE `menuItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;