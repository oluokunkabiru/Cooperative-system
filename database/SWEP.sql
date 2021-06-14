-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2021 at 02:27 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SWEP`
--

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `id` int(10) UNSIGNED NOT NULL,
  `interest` decimal(63,6) NOT NULL,
  `date` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `interest`, `date`) VALUES
(1, '0.000000', '12-06-21'),
(2, '0.000000', '12-06-21'),
(3, '0.000000', '12-06-21'),
(4, '0.000000', '12-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `interest_per_head`
--

CREATE TABLE `interest_per_head` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `interest` decimal(63,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interest_per_head`
--

INSERT INTO `interest_per_head` (`id`, `username`, `interest`) VALUES
(1, 'oluokun', '0.000000');

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE `loan` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `loan_borrowed` decimal(63,4) NOT NULL,
  `loan_with_interest` decimal(63,4) NOT NULL,
  `loan_paid_WITH_interest` decimal(63,4) NOT NULL,
  `loan_received` decimal(63,4) NOT NULL,
  `last_loan_duration` decimal(63,4) NOT NULL,
  `last_update` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan`
--

INSERT INTO `loan` (`id`, `username`, `loan_borrowed`, `loan_with_interest`, `loan_paid_WITH_interest`, `loan_received`, `last_loan_duration`, `last_update`) VALUES
(1, 'oluokun', '4000.0000', '4320.0000', '4320.0000', '4000.0000', '0.0000', '3-18-11pm');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(200) NOT NULL,
  `bvn` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneno` varchar(100) NOT NULL,
  `saving` decimal(64,6) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `NameofG` varchar(100) NOT NULL,
  `BvnofG` varchar(100) NOT NULL,
  `EmailofG` varchar(100) NOT NULL,
  `PhoneofG` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `username`, `bvn`, `password`, `email`, `phoneno`, `saving`, `date`, `time`, `NameofG`, `BvnofG`, `EmailofG`, `PhoneofG`) VALUES
(3, 'adesina kabir oluokun', 'oluokun', '781274891', 'village', 'ok@vb.com', '9820942', '3.000000', '12-06-21', '2-48-14pm', 'oluokun adesina', '892472', 'oka@vb.com', '9084294820');

-- --------------------------------------------------------

--
-- Table structure for table `temporary`
--

CREATE TABLE `temporary` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `tem_saving` decimal(63,6) NOT NULL,
  `saving` decimal(63,6) NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temporary`
--

INSERT INTO `temporary` (`id`, `username`, `tem_saving`, `saving`, `status`) VALUES
(1, 'oluokun', '0.000000', '5523523.000000', 'debit');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `type` varchar(40) NOT NULL,
  `to_refund` varchar(40) NOT NULL,
  `Amt` decimal(63,6) NOT NULL,
  `date` varchar(40) NOT NULL,
  `time` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `username`, `email`, `type`, `to_refund`, `Amt`, `date`, `time`) VALUES
(1, 'oluokun', 'ok@vb.com', 'saving', 'saving', '5445646.000000', '12-06-21', '2-48-35pm'),
(2, 'oluokun', 'ok@vb.com', 'saving', 'saving', '77877.000000', '12-06-21', '2-50-44pm'),
(3, 'oluokun', 'ok@vb.com', 'borrow', '2240', '2000.000000', '12-06-21', '3'),
(4, 'oluokun', 'ok@vb.com', 'paid_loan', '2000', '2240.000000', '12-06-21', '3-04-56pm'),
(5, 'oluokun', 'ok@vb.com', 'borrow', '2080', '2000.000000', '12-06-21', '1'),
(6, 'oluokun', 'ok@vb.com', 'paid_loan', '2000', '2080.000000', '12-06-21', '3-18-11pm'),
(7, 'oluokun', '', 'withdraw', '8978979', '5523520.000000', '12-06-21', '3-20-10pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest_per_head`
--
ALTER TABLE `interest_per_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan`
--
ALTER TABLE `loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temporary`
--
ALTER TABLE `temporary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interest_per_head`
--
ALTER TABLE `interest_per_head`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `loan`
--
ALTER TABLE `loan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temporary`
--
ALTER TABLE `temporary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
