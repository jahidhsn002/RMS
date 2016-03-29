-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2016 at 05:37 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rms_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `rt_goods`
--

CREATE TABLE `rt_goods` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `print` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_goods`
--

INSERT INTO `rt_goods` (`time`, `name`, `category`, `print`, `price`) VALUES
('1459098026', 'Number 1 Gorur Chap', 'Filmy Food', 'Kitchen', '65'),
('1459186684', 'cdcxcxcxc', 'Filmy Food', 'Kitchen', '56'),
('1459186689', 'ddfdsfd', 'Filmy Food', 'Kitchen', '46'),
('1459186694', 'dsdsczxcx', 'Filmy Food', 'Kitchen', '56565'),
('1459186699', 'dfdfdf', 'Filmy Food', 'Kitchen', '3434'),
('1459186858', 'fghbcvgfgf', 'Filmy Food', 'Kitchen', '454'),
('1459186867', 'szczxcxzcxc', 'Filmy Food', 'Kitchen', '23'),
('1459186878', 'fgdfgfd', 'Filmy Food', 'Kitchen', '565'),
('1459186882', 'sdddsfd', 'Filmy Food', 'Kitchen', '455'),
('1459186890', 'fcvbcvbv', 'Filmy Food', 'Kitchen', '245'),
('1459186895', 'dsfdfd', 'Filmy Food', 'Kitchen', '56'),
('1459186900', 'vcvcvcvc', 'Filmy Food', 'Kitchen', '56');

-- --------------------------------------------------------

--
-- Table structure for table `rt_order`
--

CREATE TABLE `rt_order` (
  `id` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `goods` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_order`
--

INSERT INTO `rt_order` (`id`, `time`, `goods`, `status`) VALUES
('1459216670', '1459106584', '1459098026||1//1459186684||1//1459186689||1', 'Painding');

-- --------------------------------------------------------

--
-- Table structure for table `rt_order_history`
--

CREATE TABLE `rt_order_history` (
  `time` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `sale` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_order_history`
--

INSERT INTO `rt_order_history` (`time`, `Name`, `sale`) VALUES
('1458975200', 'Jahid', '99'),
('1458975870', 'Joomber', '204'),
('1458975973', 'Jamuna', '114'),
('1458976265', 'hgfhfgh', '535'),
('1458976620', 'ashiq rani', '198'),
('1458977040', 'sdsadsa', '55'),
('1458831634', 'gags', '190'),
('1458831687', 'hdhsbfhmds dshfbd', '74'),
('1458862170', 'Akash Khan', '83.3'),
('1458862317', 'Korim Choudhori', '113.6'),
('1458862447', 'Kali', '113.3'),
('1458862500', 'my moni', '159.6'),
('1458868180', 'kona', '492.6'),
('1459215688', 'Akash Khab', '298315.5'),
('1459216159', 'Akash Khab', '425665');

-- --------------------------------------------------------

--
-- Table structure for table `rt_stock`
--

CREATE TABLE `rt_stock` (
  `time` varchar(20) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `special` varchar(10) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_stock`
--

INSERT INTO `rt_stock` (`time`, `quantity`, `special`, `price`) VALUES
('1459098026', '12', 'True', '34'),
('1459186684', '-8', 'False', '0'),
('1459186689', '-10', 'False', '0'),
('1459186694', '-14', 'False', '0'),
('1459186699', '-14', 'False', '0'),
('1459186858', '-6', 'False', '0'),
('1459186867', '-4', 'False', '0'),
('1459186878', '-6', 'False', '0'),
('1459186882', '-4', 'False', '0'),
('1459186890', '-6', 'False', '0'),
('1459186895', '-4', 'False', '0'),
('1459186900', '-10', 'False', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rt_table`
--

CREATE TABLE `rt_table` (
  `time` varchar(20) NOT NULL,
  `number` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_table`
--

INSERT INTO `rt_table` (`time`, `number`, `name`) VALUES
('1459105560', '07', 'Shabnur Moushomi'),
('1459106584', '02', 'Kakoli Bonani');

-- --------------------------------------------------------

--
-- Table structure for table `rt_users`
--

CREATE TABLE `rt_users` (
  `id` tinyint(4) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_users`
--

INSERT INTO `rt_users` (`id`, `username`, `password`) VALUES
(1, 'waiter', 'f8b15356be2ba26838a887c6a52c815a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rt_users`
--
ALTER TABLE `rt_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rt_users`
--
ALTER TABLE `rt_users`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
