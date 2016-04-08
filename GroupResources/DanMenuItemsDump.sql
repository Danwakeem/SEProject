-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 08, 2016 at 06:56 PM
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
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menuItems`
--

CREATE TABLE `menuItems` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `desc` varchar(5000) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 is active, 0 is inactive',
  `Price` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuItems`
--

INSERT INTO `menuItems` (`id`, `title`, `desc`, `active`, `Price`) VALUES
(1, 'Truffle Fries', 'Natural cut Julienne Fries fried in a delicious truffle oil.', b'1', 8),
(2, 'Osso Buco En Croute', 'Braised pork Osso Bucco baked with roasted root vegetables rich herb gravy served in a crispy puff pastry crust.', b'1', 30),
(3, 'Raspberry Lemonade ', 'Fresh lemons squeezed daily by our chefs complimented with real raspberry juice.', b'1', 3),
(4, 'Vanilla ice cream', 'Home made vanilla ice cream made with natural cream and Mexican vanilla.', b'1', 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `orderItems`
--

CREATE TABLE `orderItems` (
  `orderId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `userType`, `Status`) VALUES
(1, 'Danwakeem', 'password', 'customer', 'Ready'),
(2, 'Dodo', 'password', 'waiter', 'Ready'),
(3, 'table1', 'table1', 'table', 'needAssistance'),
(4, 'table2', 'table2', 'table', 'Ready'),
(5, 'table3', 'table3', 'table', 'Ready'),
(6, 'table4', 'table4', 'table', 'Ready'),
(7, 'table5', 'table5', 'table', 'Ready'),
(8, 'table6', 'table6', 'table', 'Ready'),
(9, 'table7', 'table7', 'table', 'Ready'),
(10, 'table8', 'table8', 'table', 'Ready'),
(11, 'table9', 'table9', 'table', 'Ready'),
(12, 'table10', 'table10', 'table', 'Ready');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
