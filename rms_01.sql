-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2016 at 08:29 PM
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
-- Table structure for table `rt_coock_history`
--

CREATE TABLE `rt_coock_history` (
  `time` varchar(20) NOT NULL,
  `food` varchar(20) NOT NULL,
  `food_qty` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `material` varchar(600) NOT NULL,
  `qty` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rt_due_payment`
--

CREATE TABLE `rt_due_payment` (
  `time` varchar(20) NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `bill` varchar(20) NOT NULL,
  `paid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rt_food`
--

CREATE TABLE `rt_food` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `print` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_food`
--

INSERT INTO `rt_food` (`time`, `name`, `category`, `print`, `price`) VALUES
('1459098026', 'Number 1 Gorur Chap', 'Filmy Food', 'Kitchen', '65'),
('1459200624', 'Boti Keno Gorur-Gorur', 'Filmy Food', 'Kitchen', '65'),
('1459200683', 'Chagoler 3no Chap-Khashir Chap', 'Filmy Food', 'Kitchen', '100'),
('1459200732', 'Boti Keno Khashir-Khashir Boti Kabab', 'Filmy Food', 'Kitchen', '100'),
('1459200773', '4th Person Singular Chicken-chap', 'Filmy Food', 'Kitchen', '90'),
('1459200835', 'Nirshartho Mezbani Gosht', 'Filmy Food', 'Kitchen', '90'),
('1459200872', 'Gila Boro Naki Kolija Boro', 'Filmy Food', 'Kitchen', '65'),
('1459200911', 'Mogoj Dholai', 'Filmy Food', 'Kitchen', '65'),
('1459200941', 'Chuye Dile Kathi-Kabab', 'Filmy Food', 'Kitchen', '65'),
('1459200975', 'Purnodorgho Khiri Kabab', 'Filmy Food', 'Kitchen', '65'),
('1459201007', 'Dhakaiya King Soup', 'Filmy Food', 'Kitchen', '40'),
('1459201061', 'Shami Keno Kabab', 'Filmy Food', 'Kitchen', '15'),
('1459201105', 'Mon Shudhu Chay Tikka', 'Filmy Food', 'Kitchen', '5'),
('1459201195', 'Jibon Luchi-moy', 'Filmy Food', 'Kitchen', '5'),
('1459201209', 'Luchi-The Porota', 'Filmy Food', 'Drinks', '10'),
('1459201254', 'Mango Culpis', 'Filmy Food', 'Drinks', '55'),
('1459201316', 'Madly Laschi', 'Filmy Drinks', 'Drinks', '40'),
('1459201365', 'Banana n Silk', 'Filmy Drinks', 'Drinks', '40'),
('1459201432', 'Rongbaz Tea', 'Bangla Tea', 'Drinks', '10'),
('1459201468', 'Gorom Masala Tea', 'Bangla Tea', 'Drinks', '15'),
('1459201508', 'PK Malai Tea', 'Bangla Tea', 'Drinks', '20'),
('1459201815', 'Captain Jackspraw Cappuccino-R', 'Hollywood Coffee', 'Drinks', '60'),
('1459201857', 'Captain Jackspraw Cappuccino-L', 'Hollywood Coffee', 'Drinks', '90'),
('1459201910', 'Mr Bean Mocha-R', 'Hollywood Coffee', 'Drinks', '60'),
('1459201939', 'Mr Bean Mocha-L', 'Hollywood Coffee', 'Drinks', '90'),
('1459202038', '007 James Bond Latte-R', 'Filmy Food', '1460098390', '60'),
('1459202061', '007 James Bond Latte-L', 'Filmy Food', '1460098276', '90'),
('1459202176', 'Stifler Vanilla Coffee-R', 'Hollywood Coffee', 'Drinks', '70'),
('1459202204', 'Stifler Vanilla Coffee-L', 'Hollywood Coffee', 'Drinks', '100'),
('1459202317', 'Harry Potter Chocolate Milk-R', 'Hollywood Coffee', 'Drinks', '60'),
('1459202365', 'Harry Potter Chocolate Milk-L', 'Hollywood Coffee', 'Drinks', '90'),
('1459202494', 'Chocolate Choco Ice', 'Dessert', 'Drinks', '50'),
('1459202547', 'Smooth Strawberry', 'Dessert', 'Drinks', '50'),
('1459202615', 'Mango Hemlock', 'Dessert', 'Drinks', '50'),
('1459202657', 'Sharlok and Feluda', 'Dessert', 'Drinks', '75'),
('1459202719', 'Bangladeshi Pie', 'Dessert', 'Drinks', '60'),
('1459202766', 'Dilwale Pudding', 'Dessert', 'Drinks', '50'),
('1459202816', 'Mughal-e-Azam Shahi Tukra', 'Dessert', 'Drinks', '40'),
('1459202979', 'Chicken Ball', 'Food papa Item', 'Foodpapa', '25'),
('1459203020', 'Sausage', 'Food papa Item', 'Foodpapa', '25'),
('1459203070', 'Royal Strip', 'Food papa Item', 'Foodpapa', '45'),
('1459203142', 'Chicken Nugget', 'Food papa Item', 'Foodpapa', '50'),
('1459203181', 'Spicy Chicken', 'Food papa Item', 'Foodpapa', '50'),
('1459203232', 'Crispy Breast', 'Food papa Item', 'Foodpapa', '110'),
('1459203309', 'Crispy Thigh', 'Food papa Item', 'Foodpapa', '80'),
('1459203465', 'Hot Wings 4pcs', 'Food papa Item', 'Foodpapa', '80'),
('1459203535', 'Crispy Drumstick', 'Food papa Item', 'Foodpapa', '60'),
('1459203583', 'Crispy Wings', 'Food papa Item', 'Foodpapa', '55'),
('1459203620', 'French Fry', 'Food papa Item', 'Foodpapa', '30'),
('1459203750', 'Chicken Cheese Burger', 'Food papa Item', 'Foodpapa', '100'),
('1459203851', 'Fried Chicken Berger', 'Food papa Item', 'Foodpapa', '90'),
('1459203919', 'Beef Burger', 'Filmy Food', 'Kitchen', '200'),
('1459203964', 'Chicken Burger', 'Filmy Food', 'Foodpapa', '70'),
('1459204104', 'Chicken Shwarma', 'Food papa Item', 'Foodpapa', '60'),
('1459204160', 'Chicken Sandwich', 'Food papa Item', 'Foodpapa', '60'),
('1459204232', 'Water-R', 'Regular Drinks', 'Drinks', '15'),
('1459204273', 'Water-L', 'Regular Drinks', 'Drinks', '30'),
('1459204354', 'Pepsi', 'Regular Drinks', 'Drinks', '15'),
('1459204409', 'Pepsi-bottle 200ml', 'Regular Drinks', 'Drinks', '20'),
('1459204459', 'Pepsi-Can', 'Regular Drinks', 'Drinks', '40'),
('1459204515', 'Nescafe-R', 'Regular Drinks', 'Drinks', '20'),
('1459204547', 'Nescafe-L', 'Regular Drinks', 'Drinks', '35'),
('1459204594', 'Nestea-R', 'Regular Drinks', 'Drinks', '20'),
('1459417289', 'Extra Salad', 'Filmy Food', 'Kitchen', '20'),
('1459417308', 'Mexican Tortila', 'Filmy Food', 'Kitchen', '70'),
('1459417336', 'Koto Butter e Koto Rice', 'Filmy Food', 'Kitchen', '40'),
('1459421681', 'Benson Regular-Single', 'Tobacco', 'Drinks', '15'),
('1459421712', 'Benson Switch-Single', 'Tobacco', 'Drinks', '15'),
('1459421717', 'Benson Light-Single', 'Tobacco', 'Drinks', '15'),
('1459421904', 'Benson Regular-Packet', 'Tobacco', 'Drinks', '230'),
('1459421936', 'Benson Light-Packet', 'Tobacco', 'Drinks', '230'),
('1459421975', 'Benson Switch-Packet', 'Tobacco', 'Drinks', '230'),
('1459422004', 'Marlboro Regular-single', 'Tobacco', 'Drinks', '15'),
('1459422056', 'Marlboro Light-single', 'Tobacco', 'Drinks', '15'),
('1459422078', 'Marlboro Regular-Packet', 'Tobacco', 'Drinks', '230'),
('1459422086', 'Marlboro Light-Packet', 'Tobacco', 'Drinks', '230'),
('1459422467', 'Gold Leaf Regular-Single', 'Tobacco', 'Drinks', '12'),
('1459422488', 'Gold Leaf Light-Single', 'Tobacco', 'Drinks', '12'),
('1459422528', 'Gold Leaf Regular-Packet', 'Tobacco', 'Drinks', '200'),
('1459422555', 'Gold Leaf Light-Packet', 'Tobacco', 'Drinks', '200'),
('1459422661', '7-up-Glass', 'Regular Drinks', 'Drinks', '15'),
('1459422721', '7-up-Bottle 200ml', 'Regular Drinks', 'Drinks', '20'),
('1459422848', 'Mirinda-Glass', 'Regular Drinks', 'Drinks', '15'),
('1459422942', 'Mirinda-Bottle 200ml', 'Regular Drinks', 'Drinks', '20'),
('1459423022', 'Mountain Dew-Bottle 200ml', 'Regular Drinks', 'Drinks', '20'),
('1459423130', 'Mountain Dew-Glass', 'Regular Drinks', 'Drinks', '15');

-- --------------------------------------------------------

--
-- Table structure for table `rt_material`
--

CREATE TABLE `rt_material` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` varchar(20) NOT NULL,
  `print` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_material`
--

INSERT INTO `rt_material` (`time`, `name`, `category`, `price`, `print`) VALUES
('1459477103', 'onion', 'Filmy Food', '36', ''),
('1459477127', 'chili', 'Filmy Food', '95', ''),
('1459477152', 'tomatto', 'Filmy Food', '55', ''),
('1459477166', 'garlic', 'Filmy Food', '120', ''),
('1459477215', 'oil', 'Filmy Food', '88', ''),
('1459477234', 'ginger', 'Filmy Food', '360', ''),
('1459477297', 'potato', 'Filmy Food', '20', ''),
('1459477310', 'dal', 'Filmy Food', '90', ''),
('1459477325', 'salt', 'Filmy Food', '35', ''),
('1459477374', 'sugar', 'Filmy Food', '45', ''),
('1459477384', 'soya souce', 'Filmy Food', '85', ''),
('1459477401', 'cucumber', 'Filmy Food', '36', ''),
('1459477482', 'cabbage', 'Filmy Food', '25', ''),
('1459477487', 'been', 'Filmy Food', '55', ''),
('1459477498', 'chicken', 'Filmy Food', '180', ''),
('1459477505', 'beef', 'Filmy Food', '360', ''),
('1459477534', 'cauly flower', 'Filmy Food', '34', ''),
('1459477583', 'arm', 'Filmy Food', '16', ''),
('1459477598', 'milk', 'Filmy Food', '65', ''),
('1459477629', 'raddish', 'Filmy Food', '22', ''),
('1459477654', 'paijam rice', 'Filmy Food', '42', ''),
('1459477665', 'miniket rice', 'Filmy Food', '45', ''),
('1459954027', 'Pay Due', 'Filmy Food', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `rt_module`
--

CREATE TABLE `rt_module` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_module`
--

INSERT INTO `rt_module` (`time`, `name`, `link`) VALUES
('dash', 'Dashboard', 'home/dash'),
('perchase/material', 'Perchase Material', 'material'),
('waiter', 'Waiter Sales', 'sales/waiter'),
('material/stock', 'Material Stock', 'prestock'),
('food/stock', 'Food Stock', 'stock'),
('perchase/material', 'Perchase Material', 'material'),
('praper/food', 'Praper Food', 'food'),
('salse', 'Salse Manage Order', 'sales/order'),
('due', 'Due Payment', 'due'),
('history', 'View All History', 'due/history'),
('option', 'Change Setting', 'table');

-- --------------------------------------------------------

--
-- Table structure for table `rt_order`
--

CREATE TABLE `rt_order` (
  `time` varchar(20) NOT NULL,
  `table` varchar(20) NOT NULL,
  `food` varchar(600) NOT NULL,
  `quantity` varchar(600) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rt_order_history`
--

CREATE TABLE `rt_order_history` (
  `time` varchar(20) NOT NULL,
  `table` varchar(50) NOT NULL,
  `table_no` varchar(10) NOT NULL,
  `food` varchar(600) NOT NULL,
  `quantity` varchar(600) NOT NULL,
  `bill` varchar(20) NOT NULL,
  `paid` varchar(20) NOT NULL,
  `profit` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rt_prestock`
--

CREATE TABLE `rt_prestock` (
  `time` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `wastage` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_prestock`
--

INSERT INTO `rt_prestock` (`time`, `quantity`, `wastage`, `price`) VALUES
('1459477103', '7.5', '0', '35.11'),
('1459477127', '-8.3', '2', '81.67'),
('1459477152', '0', '0', '0'),
('1459477166', '0', '0', '0'),
('1459477215', '0', '0', '0'),
('1459477234', '0', '0', '0'),
('1459477297', '0', '0', '0'),
('1459477310', '0', '2', '90'),
('1459477325', '0', '0', '0'),
('1459477374', '0', '0', '0'),
('1459477384', '0', '0', '0'),
('1459477401', '3', '3', '36'),
('1459477482', '-63', '0', '25'),
('1459477487', '13', '7', '55'),
('1459477498', '0', '-12', '0'),
('1459477505', '-24.2', '1', '377.08'),
('1459477534', '-100', '-8', '0'),
('1459477583', '9', '14', '16'),
('1459477598', '0', '0', '0'),
('1459477629', '0', '0', '0'),
('1459477654', '0', '0', '0'),
('1459477665', '0', '0', '0'),
('1459954027', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rt_print`
--

CREATE TABLE `rt_print` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_print`
--

INSERT INTO `rt_print` (`time`, `name`) VALUES
('1460098276', 'Food Papa'),
('1460098390', 'Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `rt_stock`
--

CREATE TABLE `rt_stock` (
  `time` varchar(20) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `wastage` varchar(20) NOT NULL,
  `premade` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_stock`
--

INSERT INTO `rt_stock` (`time`, `quantity`, `wastage`, `premade`, `price`) VALUES
('1459098026', '0', '0', '0', '0'),
('1459200624', '0', '0', '0', '0'),
('1459200683', '0', '0', '0', '0'),
('1459200732', '0', '0', '0', '0'),
('1459200773', '-6', '0', '0', '0'),
('1459200835', '0', '0', '0', '0'),
('1459200872', '0', '0', '0', '0'),
('1459200911', '0', '0', '0', '0'),
('1459200941', '0', '0', '0', '0'),
('1459200975', '0', '0', '0', '0'),
('1459201007', '0', '0', '0', '0'),
('1459201061', '0', '0', '0', '0'),
('1459201105', '0', '0', '0', '0'),
('1459201195', '0', '0', '0', '0'),
('1459201209', '0', '0', '0', '0'),
('1459201254', '0', '0', '0', '0'),
('1459201316', '0', '0', '0', '0'),
('1459201365', '0', '0', '0', '0'),
('1459201432', '0', '0', '0', '0'),
('1459201468', '0', '0', '0', '0'),
('1459201508', '0', '0', '0', '0'),
('1459201815', '0', '0', '0', '0'),
('1459201857', '0', '0', '0', '0'),
('1459201910', '0', '0', '0', '0'),
('1459201939', '0', '0', '0', '0'),
('1459202038', '6', '0', '0', '4.17'),
('1459202061', '-3', '0', '0', '0'),
('1459202176', '0', '0', '0', '0'),
('1459202204', '0', '0', '0', '0'),
('1459202317', '0', '0', '0', '0'),
('1459202365', '0', '0', '0', '0'),
('1459202494', '0', '0', '0', '0'),
('1459202547', '0', '0', '0', '0'),
('1459202615', '0', '0', '0', '0'),
('1459202657', '0', '0', '0', '0'),
('1459202719', '0', '0', '0', '0'),
('1459202766', '0', '0', '0', '0'),
('1459202816', '0', '0', '0', '0'),
('1459202979', '0', '0', '0', '0'),
('1459203020', '0', '0', '0', '0'),
('1459203070', '0', '0', '0', '0'),
('1459203142', '0', '0', '0', '0'),
('1459203181', '0', '0', '0', '0'),
('1459203232', '0', '0', '0', '0'),
('1459203309', '0', '0', '0', '0'),
('1459203465', '0', '0', '0', '0'),
('1459203535', '0', '0', '0', '0'),
('1459203583', '0', '0', '0', '0'),
('1459203620', '0', '0', '0', '0'),
('1459203750', '0', '0', '0', '0'),
('1459203851', '0', '0', '0', '0'),
('1459203919', '-1', '0', '0', '160.74'),
('1459203964', '0', '0', '0', '0'),
('1459204104', '0', '0', '0', '0'),
('1459204160', '0', '0', '0', '0'),
('1459204232', '0', '0', '0', '0'),
('1459204273', '0', '0', '0', '0'),
('1459204354', '0', '0', '0', '0'),
('1459204409', '0', '0', '0', '0'),
('1459204459', '0', '0', '0', '0'),
('1459204515', '0', '0', '0', '0'),
('1459204547', '0', '0', '0', '0'),
('1459204594', '0', '0', '0', '0'),
('1459417289', '0', '0', '0', '0'),
('1459417308', '0', '0', '0', '0'),
('1459417336', '0', '0', '0', '0'),
('1459421681', '0', '0', '0', '0'),
('1459421712', '0', '0', '0', '0'),
('1459421717', '0', '0', '0', '0'),
('1459421904', '0', '0', '0', '0'),
('1459421936', '0', '0', '0', '0'),
('1459421975', '0', '0', '0', '0'),
('1459422004', '0', '0', '0', '0'),
('1459422056', '0', '0', '0', '0'),
('1459422078', '0', '0', '0', '0'),
('1459422086', '0', '0', '0', '0'),
('1459422467', '0', '0', '0', '0'),
('1459422488', '0', '0', '0', '0'),
('1459422528', '0', '0', '0', '0'),
('1459422555', '0', '0', '0', '0'),
('1459422661', '2', '0', '0', '0'),
('1459422721', '3', '0', '0', '150.93'),
('1459422848', '0', '0', '0', '0'),
('1459422942', '0', '0', '0', '0'),
('1459423022', '0', '0', '0', '0'),
('1459423130', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `rt_stock_history`
--

CREATE TABLE `rt_stock_history` (
  `time` varchar(20) NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `material` varchar(600) NOT NULL,
  `quantity` varchar(600) NOT NULL,
  `total` varchar(20) NOT NULL,
  `paid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rt_supplier`
--

CREATE TABLE `rt_supplier` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `contact` varchar(25) NOT NULL,
  `address` varchar(150) NOT NULL,
  `comment` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_supplier`
--

INSERT INTO `rt_supplier` (`time`, `name`, `company`, `contact`, `address`, `comment`) VALUES
('1459472607', 'Hub Drive', 'Gr One', '343434', 'rererer', '0');

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
('1459246075', '01', 'Razzak-Babita'),
('1459246093', '02', 'Alamgir-Shabana'),
('1459246108', '03', 'Shabnaz-Naim'),
('1459246125', '04', 'Shalman Shah-Shabnur'),
('1459246157', '05', 'Moushumi-Omar Sani'),
('1459246172', '06', 'Riaz-Purnima'),
('1459246197', '07', 'Shakib-Apu'),
('1459246211', '08', 'Ananta-Barsha'),
('1459246231', '09', 'h-h'),
('1459246256', '01', 'VIP'),
('1459246264', '02', 'VIP'),
('1459246273', '03', 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `rt_user`
--

CREATE TABLE `rt_user` (
  `time` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roll` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rt_user`
--

INSERT INTO `rt_user` (`time`, `name`, `designation`, `username`, `password`, `roll`) VALUES
('1460111364', 'Jahid Hasan', 'Naver', 'admin@gmail.com', 'cbe368ac535b67a90a17238a51759f2a', 'dash|perchase/material|waiter|material/stock|food/stock|perchase/material|praper/food|salse|due|history|option'),
('1460120963', 'Akash', 'nal', 'cc@gmail.com', 'cbe368ac535b67a90a17238a51759f2a', 'dash|waiter|perchase/material|salse');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
