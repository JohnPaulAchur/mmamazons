-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 11:13 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodlicious`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `phone`, `email`, `password`, `role`) VALUES
(7, 'john', '09023934353', 'doctor@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin'),
(13, 'barnabas', '09060916461', 'doctor@doctor', '5f4dcc3b5aa765d61d8327deb882cf99', 'User'),
(14, 'Arks', '08152397199', 'akereleayomide1@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Admin'),
(15, 'john paul', '09090344667', 'idahjohnpaul@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `disperse`
--

CREATE TABLE `disperse` (
  `id` int(11) NOT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `qty` int(20) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disperse`
--

INSERT INTO `disperse` (`id`, `employee`, `qty`, `item`, `date`) VALUES
(5, 'Daniel', 50, 'banana', '2022-02-04'),
(6, 'john', 30, 'banana', '2022-02-19'),
(7, 'john', 9, 'banana pack', '2022-02-26'),
(8, 'john', 7, 'beans', '2022-02-26'),
(9, 'john', 3, 'beans', '2022-05-14'),
(10, 'Daniel', 90, 'beans', '2022-05-14'),
(11, 'Happiness', 30, 'bisko biscuit', '2022-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `qty` int(20) DEFAULT NULL,
  `unit_price` int(20) DEFAULT NULL,
  `total` int(20) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `tbl_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `item`, `qty`, `unit_price`, `total`, `creator`, `date`, `tbl_name`) VALUES
(29, 'qwertyy', 300, 500, 150000, 'Ark', '2022-01-29', ''),
(34, 'wewieei', 1300, 1000, 1300000, 'Ark', '2022-02-03', ''),
(35, 'wewieei', 334, 39939, 13339626, 'Ark', '2022-02-03', ''),
(36, 'lapi', 500, 10, 5000, 'Arks', '2022-02-04', ''),
(37, 'lapi', 500, 10, 5000, 'Arks', '2022-02-04', ''),
(39, 'broom and packer', 3, 500, 1500, 'john paul', '2022-02-19', ''),
(40, 'broom', 5, 500, 2500, 'john paul', '2022-05-14', '');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `pos` int(20) NOT NULL,
  `cash` int(20) NOT NULL,
  `transfer` int(20) NOT NULL,
  `expenses` int(20) NOT NULL,
  `others` int(20) NOT NULL,
  `excess` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `date` date DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `tbl_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`id`, `pos`, `cash`, `transfer`, `expenses`, `others`, `excess`, `total`, `date`, `editor`, `tbl_name`) VALUES
(1, 2, 3, 3, 4, 3, 4, 19, '0000-00-00', 'Ark', ''),
(2, 0, 0, 0, 0, 0, 7, 7, '0000-00-00', 'Ark', ''),
(17, 1000, 1000, 1000, 1000, 1000, 1000, 6000, '2022-02-03', 'Ark', ''),
(19, 6000, 7000, 7000, 7000, 7000, 7000, 41000, '2022-02-04', 'Arks', ''),
(20, 500, 500, 500, 500, 500, 500, 3000, '2022-05-14', 'john paul', '');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `item` varchar(255) DEFAULT NULL,
  `unit` varchar(200) NOT NULL DEFAULT 'None',
  `qty` int(20) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `item`, `unit`, `qty`, `date`) VALUES
(46, 'beans', 'Pack', 100, '2022-02-04'),
(47, 'banana pack', 'Pack', 0, '2022-02-04'),
(48, 'bisko biscuit', 'Bag', 10, '2022-05-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disperse`
--
ALTER TABLE `disperse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `disperse`
--
ALTER TABLE `disperse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
