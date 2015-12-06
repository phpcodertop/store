-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 10:03 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `car`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
`id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `dateOfMade` varchar(255) NOT NULL,
  `carNum` varchar(255) NOT NULL,
  `carNumImage` varchar(255) NOT NULL,
  `driver` varchar(255) NOT NULL,
  `driverImage` varchar(255) NOT NULL,
  `monthlyCheckDate` date NOT NULL,
  `yearlyCheckDate` date NOT NULL,
  `insuranceExpiryDate` date NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `model`, `dateOfMade`, `carNum`, `carNumImage`, `driver`, `driverImage`, `monthlyCheckDate`, `yearlyCheckDate`, `insuranceExpiryDate`, `note`) VALUES
(1, 'ferary', '2015', '21322', 'upload/Chrysanthemum.jpg', 'ahmed', 'upload/Desert.jpg', '2015-09-21', '2015-09-21', '2015-09-21', 'vbngtdfhydr'),
(2, 'ferary', '2000', 'dsgwsghw', 'upload/1426437560924887.jpg', 'ahmed', 'upload/1450329011869075.jpg', '2015-09-23', '2015-09-29', '2015-09-26', 'erh66yrtuy');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `driverId` varchar(255) NOT NULL,
  `driverIdImage` varchar(255) NOT NULL,
  `licence` varchar(255) NOT NULL,
  `licenceImage` varchar(255) NOT NULL,
  `licenceExpiryDate` date NOT NULL,
  `mail` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `nickname`, `driverId`, `driverIdImage`, `licence`, `licenceImage`, `licenceExpiryDate`, `mail`, `note`) VALUES
(1, 'ahmed', 'ahmed', '4564654654', 'upload/ش.jpg', '3546545241323', 'upload/tumblr_mbfkpzOPMo1risj4yo1_500.jpg', '2015-09-21', 'semicolon52@yahoo.com', 'fjdtdjry'),
(3, 'ابراهيم ماهر', 'حليمه', '24354765745', 'upload/1465315350370441.jpg', '6894521321', 'upload/1585214218380553.jpg', '2015-09-21', 'hematemo@yahoo.com', '875456454546545');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`name`, `url`, `email`) VALUES
('cars script ', 'http://localhost/store/', 'mail@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastLogin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `lastLogin`) VALUES
('ahmed', '9193ce3b31332b03f7d8af056c692b84', 'Tuesday 15th of September 2015 09:43:38 PM'),
('mohamed', '309cd3800aacbd003ac36199fa537295', 'Tuesday 15th of September 2015 10:02:55 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
