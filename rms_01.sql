-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2016 at 08:58 AM
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
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_goods`
--

INSERT INTO `rt_goods` (`time`, `name`, `category`, `price`) VALUES
('02541257', 'Chicken', 'Alo', '50'),
('022354655', 'Kukra', 'Alo', '40'),
('02645445784', 'Mora Masi', 'DFoll', '85');

-- --------------------------------------------------------

--
-- Table structure for table `rt_order`
--

CREATE TABLE `rt_order` (
  `time` varchar(20) NOT NULL,
  `goods` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('1458977040', 'sdsadsa', '55');

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
('02541257', '0', 'True', '42'),
('022354655', '14', 'False', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rt_table`
--

CREATE TABLE `rt_table` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_table`
--

INSERT INTO `rt_table` (`time`, `name`, `status`) VALUES
('025465445465', 'Apocalipso 05', 'Booked'),
('02635544855', 'Apo Calipso Night 03', 'Free');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
