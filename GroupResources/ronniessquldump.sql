-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2016 at 03:02 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `menuitemcategory`
--

CREATE TABLE `menuitemcategory` (
  `categoryId` int(11) NOT NULL,
  `menuItemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuitemcategory`
--

INSERT INTO `menuitemcategory` (`categoryId`, `menuItemId`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2),
(2, 6),
(2, 7),
(3, 10),
(3, 11),
(4, 12),
(4, 13),
(5, 14),
(5, 15);

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
(6, 'Salad Nicoise', 'Mixed greens, roasted potatoes, hariot vert, tomatoes, capers, onions, nicoise olives and sesame seared ahi tuna', b'1', 18),
(7, 'Parisian Jambon Sandwich', 'Mini french baguettes with han, gruyere, cornichons & sweet butter', b'1', 16),
(8, 'French Salad', 'Baby greens, blue cheese, roasted pecans, granny smith apples & pecan vinaigrette', b'1', 8),
(9, 'Artichoke Andree', 'Steamed artichoke with hedda''s family sauce', b'1', 11),
(10, 'Cafe Glace au Chocolat', 'Ice cold coffee flavored with the best Chocolate', b'1', 6),
(11, 'Cappucino Espresso', 'Dark, rich espresso lies in wait under a smoothed and stretched layer of thick foam', b'1', 4),
(12, 'Valrhona Manjari Bavarian Cream', 'Olive oil cake, salted caramel ice cream', b'1', 80),
(13, 'Mascarpone Pecan Cream Cake', 'Cocoa nibs, cinnamon biscotti, kahlua coffee ice cream', b'1', 80),
(14, 'Croque Monsieur', 'a classic French ham sandwich accented with cream sauce and swiss, then baked to a golden brown.', b'1', 7.59),
(15, 'French Dip', 'hot roast beef on parisien with provolone and horseradish sauce, served au jus.', b'1', 7.99);

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `menuItemId`, `path`) VALUES
(1, 1, 'assets/tFries.jpg'),
(2, 2, 'assets/ossobuco.jpg'),
(3, 3, 'assets/rLemons.jpg'),
(4, 4, 'assets/VanillaIce.jpg'),
(6, 6, 'assets/Nicoise'),
(7, 7, 'assets/Jambon'),
(8, 8, 'assets/FrenchSalad'),
(9, 9, 'assets/Andree'),
(10, 10, 'assets/Chocolat'),
(11, 11, 'assets/CappucinoEspresso'),
(12, 12, 'assets/Bavarian'),
(13, 13, 'assets/Mascarpone'),
(14, 14, 'assets/Monsieur'),
(15, 15, 'assets/Frenchdip');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `usertables`
--

CREATE TABLE `usertables` (
  `userID` int(11) NOT NULL,
  `tableID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertables`
--

INSERT INTO `usertables` (`userID`, `tableID`) VALUES
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
-- Indexes for table `menuitems`
--
ALTER TABLE `menuitems`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menuitems`
--
ALTER TABLE `menuitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
