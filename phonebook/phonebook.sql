-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 07:51 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `contact_number` int(255) NOT NULL,
  `contact_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `pro_pic` varchar(999) NOT NULL,
  `fname` varchar(999) NOT NULL,
  `lname` varchar(999) NOT NULL,
  `email` varchar(999) NOT NULL,
  `web` varchar(999) NOT NULL,
  `mobile` varchar(999) NOT NULL,
  `address` varchar(999) NOT NULL,
  `bio` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`contact_number`, `contact_id`, `user_id`, `pro_pic`, `fname`, `lname`, `email`, `web`, `mobile`, `address`, `bio`) VALUES
(6, 1, 89, '', 'Muntaz', 'Rahman', 'muntaz.servent.creator@gmail.com', 'www.ravenit.ml', '01752086110', 'Rajshahi University', 'A humble guy'),
(44, 3, 89, '30261554_2592898787601292_546022548529186480_n.jpg', 'Imran', 'Hosen', 'imranhosen133@gmail.com', 'www.ravenit.ml', '01764968900', 'Rajshahi University', 'A nice guy.'),
(46, 4, 89, '41990531_2178249195796396_5571376600789811200_o.jpg', 'Abu ', 'Rayhan', 'arayhan1998@gmail.com', 'www.facebook.com', '01719483832', 'Jahangirnagar Uiversity', 'A cute Boy.'),
(47, 5, 89, 'ash.PNG', 'Asharaful', 'Islam', 'ashraful133@gmail.com', 'www.facebook.com', '01755119826', 'Rajshahi University', 'A handsome Guy.'),
(49, 6, 89, 'muntaz.jpg', 'Imran', 'dsfg', 'imranhosen133@gmail.com', 'www.ravenit.ml', '01764968900', 'Rajshahi University', '');

-- --------------------------------------------------------

--
-- Table structure for table `phonebook_info`
--

CREATE TABLE `phonebook_info` (
  `user_id` int(255) NOT NULL,
  `fname` varchar(999) NOT NULL,
  `lname` varchar(999) NOT NULL,
  `email` varchar(999) NOT NULL,
  `pass` varchar(99) NOT NULL,
  `web` varchar(999) NOT NULL,
  `mobile` varchar(999) NOT NULL,
  `address` varchar(999) NOT NULL,
  `pro_pic` varchar(999) NOT NULL,
  `bio` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phonebook_info`
--

INSERT INTO `phonebook_info` (`user_id`, `fname`, `lname`, `email`, `pass`, `web`, `mobile`, `address`, `pro_pic`, `bio`) VALUES
(89, 'Imran', 'Hosen', 'imranhosen133@gmail.com', '123', 'www.ravenit.ml', '01764968900', 'Rajshahi University', '30261554_2592898787601292_546022548529186480_n.jpg', ''),
(90, 'Abu', 'Rayhan', 'arayhan1998@gmail.com', 'Imran133', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`contact_number`);

--
-- Indexes for table `phonebook_info`
--
ALTER TABLE `phonebook_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `contact_number` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `phonebook_info`
--
ALTER TABLE `phonebook_info`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
