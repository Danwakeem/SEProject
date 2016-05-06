-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 06, 2016 at 05:27 PM
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
  `ingredient` varchar(256) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `menuItemId`, `ingredient`, `amount`) VALUES
(1, 6, 'cheese', 10),
(2, 7, 'Potato', 30),
(3, 8, 'Poison', 100),
(4, 1, 'Poison', 100),
(5, 1, 'Cheese', 10),
(6, 1, 'Pepper', 1),
(7, 9, 'Poison', 10),
(8, 9, 'Berries', 50),
(9, 10, 'Poison', 100),
(10, 11, 'Cheese', 10),
(11, 11, 'Gold', 50),
(12, 11, 'Poison', 40),
(13, 12, 'Ham', 10),
(14, 12, 'Bread', 10),
(15, 12, 'Mustard', 10),
(16, 13, 'cheese', 50),
(17, 13, 'crackers', 50),
(18, 14, 'bread', 100);

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
(2, 5),
(1, 7),
(5, 7),
(1, 8),
(1, 9),
(5, 9),
(3, 10),
(5, 11),
(2, 11),
(5, 12),
(1, 13),
(1, 14);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menuItems`
--

INSERT INTO `menuItems` (`id`, `title`, `desc`, `active`, `Price`, `timesOrdered`) VALUES
(1, 'Truffle Fries', 'Natural cut Julienne Fries fried in a delicious truffle oil.', b'1', 8, 1),
(2, 'Osso Buco En Croute', 'Braised pork Osso Bucco baked with roasted root vegetables rich herb gravy served in a crispy puff pastry crust.', b'1', 30, 0),
(3, 'Raspberry Lemonade ', 'Fresh lemons squeezed daily by our chefs complimented with real raspberry juice.', b'1', 3, 0),
(4, 'Vanilla ice cream', 'Home made vanilla ice cream made with natural cream and Mexican vanilla.', b'1', 4.5, 0),
(7, 'Name', 'hey', b'0', 10.5, 0),
(8, 'New Item', 'Hello there man', b'0', 5.6, 0),
(9, 'Test', 'hello', b'1', 10, 0),
(10, 'Milk', 'This is the best milk you will ever drink', b'1', 2, 0),
(11, 'Mac n Cheese', 'This mac n cheese is made of pure gold. Just buy some and you will see.', b'1', 1500, 0),
(12, 'Cuban Sandwich', 'This is the best damn cuban sandwich you will ever put in your mouth.', b'1', 10.5, 0),
(13, 'Cheese and Crackers', 'This one is pretty self explanatory isn''t it?', b'1', 3, 0),
(14, 'Pita Bread', 'Its bread ya goof!', b'1', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderItems`
--

CREATE TABLE `orderItems` (
  `orderId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `notes` varchar(250) NOT NULL DEFAULT 'N/A',
  `comped` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderItems`
--

INSERT INTO `orderItems` (`orderId`, `menuId`, `quantity`, `notes`, `comped`) VALUES
(33, 1, 1, 'No cheese on top please', 0),
(33, 2, 2, 'N/A', 0),
(33, 4, 1, 'N/A', 0),
(34, 1, 1, 'N/A', 0),
(34, 2, 1, 'N/A', 0),
(34, 4, 1, 'If you have any chocolate fudge please put it on top!', 0),
(35, 1, 1, 'N/A', 0),
(35, 2, 1, 'N/A', 0),
(35, 4, 1, 'N/A', 0),
(36, 1, 1, 'N/A', 0),
(36, 2, 1, 'N/A', 0),
(37, 1, 1, 'N/A', 0),
(38, 1, 1, 'N/A', 0),
(38, 2, 1, 'N/A', 0),
(39, 1, 1, 'N/A', 0),
(39, 2, 1, 'N/A', 0),
(40, 1, 1, 'N/A', 0),
(40, 2, 1, 'N/A', 0),
(41, 1, 1, 'N/A', 0),
(42, 1, 1, 'N/A', 0),
(43, 1, 1, 'N/A', 0),
(44, 1, 2, 'N/A', 0),
(44, 2, 1, 'N/A', 0),
(45, 1, 2, 'N/A', 0),
(45, 2, 1, 'N/A', 0),
(46, 1, 1, 'N/A', 0),
(46, 2, 2, 'N/A', 0),
(47, 1, 2, 'N/A', 0),
(48, 1, 1, 'N/A', 0),
(49, 1, 2, 'N/A', 0),
(49, 2, 1, 'N/A', 0),
(50, 1, 1, 'N/A', 0),
(50, 2, 2, 'N/A', 0),
(51, 1, 2, 'N/A', 0),
(52, 1, 1, 'N/A', 0),
(53, 1, 2, 'N/A', 0),
(54, 1, 1, 'N/A', 0),
(54, 2, 1, 'N/A', 0),
(55, 1, 1, 'N/A', 0),
(55, 2, 1, 'N/A', 0),
(56, 1, 1, 'N/A', 0),
(56, 2, 1, 'N/A', 0),
(57, 1, 2, 'N/A', 0),
(58, 1, 1, 'N/A', 0),
(59, 1, 1, 'N/A', 0),
(60, 1, 1, 'N/A', 0),
(61, 1, 1, 'N/A', 0),
(62, 1, 2, 'N/A', 0),
(63, 1, 1, 'N/A', 0),
(64, 1, 2, 'N/A', 0),
(65, 1, 3, 'No cheese on top please.', 0),
(65, 2, 2, 'N/A', 0),
(66, 1, 2, 'N/A', 0),
(66, 4, 1, 'If you could put this on top of the fries I would love you forever.', 0),
(67, 1, 2, 'No cheese', 0),
(67, 2, 1, 'N/A', 0),
(68, 1, 2, 'No cheese', 0),
(68, 2, 1, 'N/A', 0),
(69, 1, 2, 'No cheese', 0),
(69, 2, 1, 'N/A', 0),
(70, 1, 2, 'No cheese', 0),
(70, 2, 1, 'N/A', 0),
(71, 1, 2, 'No cheese', 0),
(71, 2, 1, 'N/A', 0),
(72, 1, 2, 'No cheese', 0),
(72, 2, 1, 'N/A', 0),
(73, 1, 2, 'No cheese', 0),
(73, 2, 1, 'N/A', 0),
(74, 1, 2, 'No cheese', 0),
(74, 2, 1, 'N/A', 0),
(75, 1, 2, 'No cheese', 0),
(75, 2, 1, 'N/A', 0),
(76, 1, 2, 'No cheese', 0),
(76, 2, 1, 'N/A', 0),
(77, 1, 2, 'No cheese', 0),
(77, 2, 1, 'N/A', 0),
(78, 1, 2, 'No cheese', 0),
(78, 2, 1, 'N/A', 0),
(79, 1, 2, 'No cheese', 0),
(79, 2, 1, 'N/A', 0),
(80, 1, 2, 'No cheese', 0),
(80, 2, 1, 'N/A', 0),
(81, 1, 2, 'No cheese', 0),
(81, 2, 1, 'N/A', 0),
(82, 1, 2, 'No cheese', 0),
(82, 2, 1, 'N/A', 0),
(83, 1, 2, 'No cheese', 0),
(83, 2, 1, 'N/A', 0),
(84, 1, 2, 'No cheese', 0),
(84, 2, 1, 'N/A', 0),
(85, 1, 2, 'No cheese', 0),
(85, 2, 1, 'N/A', 0),
(86, 1, 2, 'No cheese', 0),
(86, 2, 1, 'N/A', 0),
(87, 1, 2, 'No cheese', 0),
(87, 2, 1, 'N/A', 0),
(88, 1, 2, 'No cheese', 0),
(88, 2, 1, 'N/A', 0),
(89, 1, 2, 'No cheese', 0),
(89, 2, 1, 'N/A', 0),
(90, 1, 2, 'No cheese', 0),
(90, 2, 1, 'N/A', 0),
(91, 1, 2, 'No cheese', 0),
(91, 2, 1, 'N/A', 0),
(92, 1, 2, 'No cheese', 0),
(92, 2, 1, 'N/A', 0),
(93, 1, 2, 'No cheese', 0),
(93, 2, 1, 'N/A', 0),
(94, 1, 2, 'No cheese', 0),
(94, 2, 1, 'N/A', 0),
(95, 1, 2, 'No cheese', 0),
(95, 2, 1, 'N/A', 0),
(96, 1, 2, 'No cheese', 0),
(96, 2, 1, 'N/A', 0),
(97, 1, 2, 'No cheese', 0),
(97, 2, 1, 'N/A', 0),
(98, 1, 2, 'No cheese', 0),
(98, 2, 1, 'N/A', 0),
(99, 1, 2, 'No cheese', 0),
(99, 2, 1, 'N/A', 0),
(100, 1, 2, 'No cheese', 0),
(100, 2, 1, 'N/A', 0),
(101, 1, 2, 'No cheese', 0),
(101, 2, 1, 'N/A', 0),
(102, 1, 2, 'No cheese', 0),
(102, 2, 1, 'N/A', 0),
(103, 1, 2, 'No cheese', 0),
(103, 2, 1, 'N/A', 0),
(104, 1, 2, 'No cheese', 0),
(104, 2, 1, 'N/A', 0),
(105, 1, 2, 'No cheese', 0),
(105, 2, 1, 'N/A', 0),
(106, 1, 2, 'No Cheese', 0),
(106, 2, 1, 'N/A', 0),
(107, 1, 2, 'No Cheese', 0),
(107, 2, 1, 'N/A', 0),
(108, 1, 2, 'No Cheese', 0),
(108, 2, 1, 'N/A', 0),
(109, 1, 2, 'No Cheese', 0),
(109, 2, 1, 'N/A', 0),
(110, 1, 2, 'No Cheese', 0),
(110, 2, 1, 'N/A', 0),
(111, 1, 2, 'N/A', 0),
(112, 1, 2, 'N/A', 0),
(113, 1, 2, 'No cheese please. ', 0),
(113, 2, 1, 'N/A', 0),
(117, 1, 1, 'N/A', 0),
(118, 1, 1, 'N/A', 0),
(119, 1, 1, 'N/A', 0),
(120, 1, 1, 'N/A', 0),
(122, 1, 1, 'N/A', 0),
(122, 1, 1, 'N/A', 0),
(123, 1, 1, 'N/A', 0),
(123, 1, 1, 'N/A', 0),
(124, 1, 1, 'N/A', 0),
(125, 1, 2, 'N/A', 0),
(125, 1, 1, 'N/A', 0),
(125, 1, 2, 'N/A', 0),
(126, 1, 2, 'N/A', 0),
(126, 1, 2, 'N/A', 0),
(126, 1, 2, 'N/A', 0),
(127, 1, 2, 'N/A', 0),
(127, 1, 2, 'N/A', 0),
(127, 1, 1, 'N/A', 0),
(127, 1, 1, 'N/A', 0),
(128, 1, 2, 'N/A', 0),
(128, 1, 2, 'N/A', 0),
(128, 1, 2, 'N/A', 0),
(128, 1, 2, 'N/A', 0),
(129, 1, 2, 'N/A', 0),
(129, 1, 2, 'N/A', 0),
(129, 2, 4, 'N/A', 0),
(130, 1, 2, 'N/A', 0),
(131, 1, 2, 'N/A', 0),
(132, 1, 2, 'N/A', 0),
(133, 1, 2, 'N/A', 0),
(134, 1, 2, 'N/A', 0),
(134, 1, 2, 'N/A', 0),
(135, 1, 2, 'N/A', 0),
(136, 1, 2, 'N/A', 0),
(137, 1, 1, 'N/A', 0),
(138, 1, 1, 'N/A', 0),
(139, 1, 2, 'N/A', 0),
(140, 1, 2, 'N/A', 0),
(141, 1, 3, 'N/A', 0),
(141, 9, 2, 'N/A', 0),
(142, 1, 2, 'N/A', 1),
(142, 9, 1, 'N/A', 1),
(143, 1, 2, 'N/A', 0),
(144, 1, 2, 'N/A', 1),
(145, 1, 3, 'N/A', 1),
(146, 1, 3, 'N/A', 0),
(146, 9, 1, 'N/A', 1),
(146, 13, 1, 'N/A', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

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
(113, 'Paid', 3, NULL, '2016-04-22 17:44:22'),
(117, 'Paid', 3, NULL, '2016-04-25 21:44:02'),
(118, 'Paid', 3, NULL, '2016-04-25 21:45:52'),
(119, 'Paid', 3, NULL, '2016-04-25 21:46:31'),
(120, 'Paid', 3, NULL, '2016-04-25 21:47:07'),
(122, 'Paid', 3, NULL, '2016-04-25 21:49:20'),
(123, 'Paid', 3, NULL, '2016-04-25 22:01:05'),
(124, 'Paid', 3, NULL, '2016-04-25 22:11:54'),
(125, 'Paid', 5, NULL, '2016-05-02 18:56:53'),
(126, 'Paid', 5, NULL, '2016-05-02 19:00:32'),
(127, 'Paid', 5, NULL, '2016-05-02 19:11:58'),
(128, 'Paid', 5, NULL, '2016-05-02 19:15:36'),
(129, 'Paid', 5, NULL, '2016-05-02 19:19:10'),
(130, 'Paid', 5, NULL, '2016-05-02 19:23:50'),
(131, 'Paid', 5, NULL, '2016-05-02 19:25:03'),
(132, 'Paid', 5, NULL, '2016-05-02 19:25:48'),
(133, 'Paid', 5, NULL, '2016-05-02 20:43:23'),
(134, 'Paid', 5, NULL, '2016-05-02 21:01:16'),
(135, 'Paid', 5, NULL, '2016-05-02 21:04:49'),
(136, 'Paid', 5, NULL, '2016-05-02 21:06:34'),
(137, 'Paid', 5, NULL, '2016-05-02 21:08:07'),
(138, 'Paid', 5, NULL, '2016-05-02 21:08:43'),
(139, 'Paid', 5, NULL, '2016-05-02 21:10:59'),
(140, 'Paid', 3, NULL, '2016-05-04 16:33:44'),
(141, 'Paid', 5, NULL, '2016-05-05 06:38:46'),
(142, 'Paid', 5, NULL, '2016-05-05 07:41:12'),
(143, 'Paid', 5, NULL, '2016-05-05 08:49:10'),
(144, 'Paid', 5, NULL, '2016-05-05 08:49:42'),
(145, 'Paid', 3, NULL, '2016-05-05 16:50:25'),
(146, 'Paid', 3, NULL, '2016-05-06 15:10:14');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `menuItemId` int(11) NOT NULL,
  `path` varchar(256) NOT NULL COMMENT 'server path'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `menuItemId`, `path`) VALUES
(1, 1, 'assets/tFries.jpg'),
(2, 2, 'assets/ossobuco.jpg'),
(3, 3, 'assets/rLemons.jpg'),
(4, 4, 'assets/VanillaIce.jpg'),
(6, 7, 'assets/UntCanvas.png'),
(7, 8, 'assets/iPhone@3x.png'),
(8, 9, 'assets/7705.jpg'),
(9, 10, 'assets/milk-500_0.jpg'),
(10, 11, 'assets/FNK_Healthy-Vegan-Mac-n-Cheese_s4x3.jpg'),
(11, 12, 'assets/cuban-sandwich2.jpg'),
(12, 13, 'assets/4129c4927a5b4bf6c88631f529464a61.jpg'),
(13, 14, 'assets/3311998770_013f491043.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `userType` varchar(256) NOT NULL DEFAULT 'customer',
  `Status` varchar(256) NOT NULL DEFAULT 'Ready',
  `coupon` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `userType`, `Status`, `coupon`) VALUES
(1, 'Danwakeem', 'password', 'customer', 'Ready', 0),
(2, 'Dodo', 'password', 'waiter', 'Ready', 0),
(3, 'table1', 'table1', 'table', 'Ready', 0),
(4, 'table2', 'table2', 'table', 'Ready', 0),
(5, 'table3', 'table3', 'table', 'Ready', 0),
(6, 'table4', 'table4', 'table', 'Ready', 0),
(7, 'table5', 'table5', 'table', 'Ready', 0),
(8, 'table6', 'table6', 'table', 'Ready', 0),
(9, 'table7', 'table7', 'table', 'Ready', 0),
(10, 'table8', 'table8', 'table', 'Ready', 0),
(11, 'table9', 'table9', 'table', 'Ready', 0),
(12, 'table10', 'table10', 'table', 'Ready', 0),
(13, 'Carl', 'Carl', 'chef', 'Ready', 0),
(14, 'Manny', 'Manny', 'manager', 'Ready', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `menuItems`
--
ALTER TABLE `menuItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;