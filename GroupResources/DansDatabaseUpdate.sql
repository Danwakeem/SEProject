-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 20, 2016 at 07:54 PM
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
(66, 4, 1, 'If you could put this on top of the fries I would love you forever.');

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
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

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
(63, 'ReadyForDelivery', 2, NULL, '2016-04-18 05:49:04'),
(64, 'ReadyForDelivery', 2, NULL, '2016-04-18 05:49:57'),
(65, 'Paid', 5, NULL, '2016-04-18 17:30:52'),
(66, 'Paid', 5, NULL, '2016-04-18 17:34:34');

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
(2, 'Dodo', 'password', 'waiter', 'OrderReady'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
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