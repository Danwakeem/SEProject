-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Mar 30, 2016 at 02:31 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `superfood`
--

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
(3, 'table1', 'table1', 'table', 'Ready'),
(4, 'table2', 'table2', 'table', 'Ready'),
(5, 'table3', 'table3', 'table', 'Ready'),
(6, 'table4', 'table4', 'table', 'Ready'),
(7, 'table5', 'table5', 'table', 'Ready'),
(8, 'table6', 'table6', 'table', 'Ready'),
(9, 'table7', 'table7', 'table', 'Ready'),
(10, 'table8', 'table8', 'table', 'Ready'),
(11, 'table9', 'table9', 'table', 'Ready'),
(12, 'table10', 'table10', 'table', 'Ready');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;