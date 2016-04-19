-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 11:18 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testrest`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `docid` int(11) NOT NULL,
  `TotalDownload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `authorid` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tag` varchar(30) NOT NULL,
  `authorid` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  `Download` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `name`, `date`, `tag`, `authorid`, `type`, `Download`) VALUES
(7, 'idonto.txt', '2016-04-03 11:11:27', 'jkl', '132', '', 0),
(9, 'imgadk.jpg', '2016-04-18 08:47:05', 'gfdg night photo', 'df', '', 1),
(10, 'city.jpg', '2016-04-17 03:59:52', 'photo noihgt', '12', '', 1),
(12, '232notes2.doc', '2016-04-11 10:07:53', 'Moadkdfjkldj fds', '12', '', 0),
(13, '11CS10011.doc', '2016-04-11 09:26:33', 'photo noihgt', '12', '', 0),
(14, 'DataScience_Lect5_PageRank-2.pdf', '2016-04-11 17:08:15', 'Moadkdfjkldj fds', '45', '', 0),
(15, '2-parse.pdf', '2016-04-12 08:57:43', 'modulo operator', 'DRP', '', 0),
(16, '1.pdf', '2016-04-12 09:02:09', 'modulo operator', 'DRP', '', 0),
(17, '34.pdf', '2016-04-12 09:03:02', 'modulo operator', 'DRP', '', 0),
(18, 'index.pdf', '2016-04-12 09:08:02', 'modulo operator', 'DRP', '', 0),
(19, 'myfile_Rest_app_Demo.txt', '2016-04-12 09:08:46', 'modulo operator', 'DRP', '', 0),
(20, 'Linkers.pptx', '2016-04-12 09:15:45', 'Linker ', 'Vivek', '', 0),
(21, '12810369_970889549667775_1573742926_o.jp', '2016-04-12 09:19:30', 'Linker ', 'Vivek', 'application/octet-stream', 0),
(22, 'algorithms-map.jpg', '2016-04-12 09:19:55', 'Linker ', 'Vivek', 'application/octet-stream', 0),
(23, 'Linux command List.pdf', '2016-04-12 09:21:26', 'Linker ', 'Vivek', 'application/pdf', 0),
(24, 'ChomskyNormalTheorm.jpg', '2016-04-12 09:33:10', 'compiler', 'Gabani', 'image/jpeg', 0),
(25, 'butterfly.jpg', '2016-04-12 09:33:53', 'compiler', 'Gabani', 'image/jpeg', 0),
(26, 'img.jpg', '2016-04-12 09:45:37', 'compiler', 'Gabani', 'image/jpeg', 0),
(27, 'IMG_20151216_153848 (2).jpg', '2016-04-12 09:46:11', 'compiler', 'Gabani', 'image/jpeg', 0),
(28, 'image (2).jpg', '2016-04-12 09:46:49', 'compiler', 'Gabani', 'image/jpeg', 0),
(29, 'complies.txt', '2016-04-17 09:49:41', 'compiler', 'Gabani', 'application/octet-stream', 0),
(30, 'Screenshot (24).png', '2016-04-17 14:21:33', 'asdadda', 'raghav', 'image/png', 0),
(31, 'plotFit.m', '2016-04-18 08:10:25', 'combinatoris', 'aa', 'application/octet-stream', 0),
(32, 'featureNormalize.m', '2016-04-18 08:46:08', 'kldjfkljfkdjfjdkl jklfjkljfkls', 'U13co051', 'application/octet-stream', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(24) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `fname`, `id`, `password`, `email`) VALUES
('Raghav', 'Raghav', 1, 'Raghav', 'atreya.sonu.1996@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`authorid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
