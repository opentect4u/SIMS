-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2018 at 06:47 PM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estock`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_dealers`
--

CREATE TABLE `m_dealers` (
  `sl_no` int(10) NOT NULL,
  `del_cd` int(10) NOT NULL,
  `del_name` varchar(100) NOT NULL,
  `del_adr` varchar(100) DEFAULT NULL,
  `del_reg` varchar(20) DEFAULT NULL,
  `del_dist` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_login_user`
--

CREATE TABLE `m_login_user` (
  `user_id` varchar(30) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(1) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_status` varchar(1) NOT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_login_user`
--

INSERT INTO `m_login_user` (`user_id`, `password`, `user_type`, `user_name`, `user_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('pk', '$2y$10$sGY1F0L5N8Q09NgUjWKbPejpEWroWQB9upGFzDM6i2.3FhoNB7BYm', 'G', 'Pritam Kumar', 'A', 'sss', '2018-06-28 12:28:49', NULL, NULL),
('sss', '$2y$10$yOLmZk477ytT1Wqg5OJ4EOfn4S242YiWvbFT5jqiVxqPOKwNld/Yq', 'A', 'Synergic', 'A', 'pk', '2018-06-28 02:23:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_products`
--

CREATE TABLE `m_products` (
  `sl_no` int(11) NOT NULL,
  `prod_type` varchar(20) NOT NULL,
  `prod_catg` varchar(50) NOT NULL,
  `prod_desc` varchar(150) NOT NULL,
  `short_flag` varchar(1) NOT NULL,
  `short_factor` decimal(10,4) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_products`
--

INSERT INTO `m_products` (`sl_no`, `prod_type`, `prod_catg`, `prod_desc`, `short_flag`, `short_factor`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'PDS', 'AAY', 'Wheat', 'Y', '0.0030', 'sss', '2018-07-09 06:06:45', NULL, NULL),
(2, 'PDS', 'AAY', 'Rice', 'Y', '0.0030', 'sss', '2018-07-09 06:06:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_prod_catg`
--

CREATE TABLE `m_prod_catg` (
  `sl_no` int(11) NOT NULL,
  `prod_catg` varchar(50) NOT NULL,
  `per_unit` varchar(20) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_prod_catg`
--

INSERT INTO `m_prod_catg` (`sl_no`, `prod_catg`, `per_unit`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(2, 'AAY', 'Family', 'sss', '2018-07-09 03:41:37', NULL, NULL),
(3, 'PHH', 'Head', 'sss', '2018-07-09 03:41:48', NULL, NULL),
(4, 'SPHH', 'Head', 'sss', '2018-07-09 03:42:24', NULL, NULL),
(5, 'RKSY-I', 'Head', 'sss', '2018-07-09 03:42:36', NULL, NULL),
(6, 'RKSY-II', 'Head', 'sss', '2018-07-09 03:42:49', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_prod_qty`
--

CREATE TABLE `m_prod_qty` (
  `sl_no` int(11) NOT NULL,
  `prod_qty` varchar(50) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_prod_qty`
--

INSERT INTO `m_prod_qty` (`sl_no`, `prod_qty`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'Bag', 'sss', '2018-07-06 04:51:34', NULL, NULL),
(2, 'Quintal', 'sss', '2018-07-06 04:52:00', NULL, NULL),
(3, 'Kg', 'sss', '2018-07-06 04:52:05', NULL, NULL),
(4, 'Gm', 'sss', '2018-07-06 04:52:14', NULL, NULL),
(5, 'Box', 'sss', '2018-07-06 04:53:48', NULL, NULL),
(6, 'Piece', 'sss', '2018-07-06 04:53:54', NULL, NULL),
(7, 'Litre', 'sss', '2018-07-06 04:58:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_prod_type`
--

CREATE TABLE `m_prod_type` (
  `sl_no` int(11) NOT NULL,
  `prod_type` varchar(100) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_prod_type`
--

INSERT INTO `m_prod_type` (`sl_no`, `prod_type`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 'PDS', 'sss', '2018-07-06 04:13:39', NULL, NULL),
(2, 'NON PDS', 'sss', '2018-07-06 04:13:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_audit_trail`
--

CREATE TABLE `t_audit_trail` (
  `sl_no` int(5) UNSIGNED NOT NULL,
  `login_dt` datetime DEFAULT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `terminal_name` varchar(50) DEFAULT NULL,
  `logout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_audit_trail`
--

INSERT INTO `t_audit_trail` (`sl_no`, `login_dt`, `user_id`, `terminal_name`, `logout`) VALUES
(37, '2018-06-28 01:19:18', 'pk', 'Tanmoy', '2018-06-28 01:20:03'),
(38, '2018-06-28 01:21:58', 'pk', 'Tanmoy', NULL),
(39, '2018-06-28 02:18:10', 'pk', 'Tanmoy', '2018-06-28 02:19:02'),
(40, '2018-06-28 02:23:35', 'pk', 'Tanmoy', '2018-06-28 02:23:54'),
(41, '2018-06-28 02:25:24', 'sss', 'Tanmoy', '2018-06-28 03:02:01'),
(42, '2018-06-28 03:02:08', 'pk', 'Tanmoy', '2018-06-28 03:32:17'),
(43, '2018-06-28 03:32:21', 'sss', 'Tanmoy', '2018-06-28 03:49:43'),
(44, '2018-06-28 04:14:38', 'sss', 'Tanmoy', '2018-06-28 06:31:24'),
(45, '2018-06-29 02:51:34', 'pk', 'Tanmoy', '2018-06-29 03:46:03'),
(46, '2018-06-29 03:46:18', 'sss', 'Tanmoy', NULL),
(47, '2018-07-02 11:31:55', 'sss', 'Tanmoy', '2018-07-02 11:33:00'),
(48, '2018-07-02 03:06:20', 'sss', 'Tanmoy', '2018-07-02 03:06:45'),
(49, '2018-07-02 03:09:57', 'sss', 'Tanmoy', '2018-07-02 03:31:12'),
(50, '2018-07-02 03:31:17', 'pk', 'Tanmoy', '2018-07-02 03:45:43'),
(51, '2018-07-02 03:39:12', 'sss', 'Tanmoy', NULL),
(52, '2018-07-02 03:39:54', 'pk', 'Tanmoy', '2018-07-02 03:41:40'),
(53, '2018-07-02 03:40:55', 'pk', 'Tanmoy', '2018-07-02 03:41:33'),
(54, '2018-07-02 03:45:50', 'sss', 'Tanmoy', '2018-07-02 06:08:12'),
(55, '2018-07-02 04:35:17', 'pk', 'Tanmoy', '2018-07-02 04:36:12'),
(56, '2018-07-02 06:08:23', 'sss', 'Tanmoy', '2018-07-02 06:08:23'),
(57, '2018-07-02 06:08:39', 'sss', 'Tanmoy', '2018-07-02 06:08:39'),
(58, '2018-07-02 06:09:02', 'pk', 'Tanmoy', '2018-07-02 06:09:02'),
(59, '2018-07-02 06:09:49', 'sss', 'Tanmoy', '2018-07-02 06:09:49'),
(60, '2018-07-02 06:10:16', 'sss', 'Tanmoy', '2018-07-02 06:10:21'),
(61, '2018-07-02 06:16:36', 'sss', 'Tanmoy', '2018-07-02 06:16:36'),
(62, '2018-07-02 06:20:11', 'sss', 'Tanmoy', '2018-07-02 06:24:14'),
(63, '2018-07-02 06:24:20', 'sss', 'Tanmoy', '2018-07-02 06:27:44'),
(64, '2018-07-02 06:27:49', 'sss', 'Tanmoy', '2018-07-02 06:28:32'),
(65, '2018-07-02 06:28:22', 'pk', 'Tanmoy', '2018-07-02 06:29:25'),
(66, '2018-07-02 06:40:31', 'pk', 'Tanmoy', '2018-07-02 06:42:55'),
(67, '2018-07-03 11:32:38', 'sss', 'Tanmoy', '2018-07-03 11:52:25'),
(68, '2018-07-03 11:52:31', 'sss', 'Tanmoy', '2018-07-03 12:04:09'),
(69, '2018-07-03 12:05:01', 'sss', 'Tanmoy', '2018-07-03 12:05:14'),
(70, '2018-07-03 12:05:19', 'sss', 'Tanmoy', NULL),
(71, '2018-07-03 12:06:08', 'sss', 'Tanmoy', NULL),
(72, '2018-07-03 12:07:30', 'pk', 'Tanmoy', NULL),
(73, '2018-07-03 01:03:59', 'sss', 'Tanmoy', '2018-07-03 01:04:23'),
(74, '2018-07-03 01:04:41', 'sss', 'Tanmoy', NULL),
(75, '2018-07-03 05:00:16', 'sss', 'Tanmoy', '2018-07-03 05:00:19'),
(76, '2018-07-03 06:33:44', 'sss', 'Tanmoy', '2018-07-03 06:34:47'),
(77, '2018-07-03 06:43:28', 'sss', 'Tanmoy', '2018-07-03 06:43:53'),
(78, '2018-07-04 12:05:10', 'sss', 'Tanmoy', '2018-07-04 12:05:23'),
(79, '2018-07-04 12:27:09', 'sss', 'Tanmoy', '2018-07-04 12:27:12'),
(80, '2018-07-04 12:31:34', 'sss', 'Tanmoy', NULL),
(81, '2018-07-04 12:37:23', 'sss', 'Tanmoy', '2018-07-04 12:43:12'),
(82, '2018-07-04 01:18:41', 'sss', 'Tanmoy', NULL),
(83, '2018-07-04 01:26:14', 'pk', 'Tanmoy', '2018-07-04 01:26:24'),
(84, '2018-07-04 02:19:19', 'sss', 'Tanmoy', '2018-07-04 02:20:46'),
(85, '2018-07-04 02:44:59', 'pk', 'Tanmoy', NULL),
(86, '2018-07-04 04:11:22', 'sss', 'Tanmoy', NULL),
(87, '2018-07-06 12:54:53', 'sss', 'Tanmoy', '2018-07-06 12:55:08'),
(88, '2018-07-06 12:55:14', 'sss', 'Tanmoy', '2018-07-06 12:59:16'),
(89, '2018-07-06 12:59:24', 'sss', 'Tanmoy', NULL),
(90, '2018-07-06 03:57:29', 'sss', 'Tanmoy', '2018-07-06 03:57:38'),
(91, '2018-07-06 04:04:28', 'sss', 'Tanmoy', NULL),
(92, '2018-07-06 04:10:26', 'sss', 'Tanmoy', NULL),
(93, '2018-07-06 04:26:05', 'sss', 'Tanmoy', NULL),
(94, '2018-07-06 05:08:22', 'sss', 'Tanmoy', '2018-07-06 05:10:20'),
(95, '2018-07-06 05:10:26', 'pk', 'Tanmoy', '2018-07-06 05:26:56'),
(96, '2018-07-06 05:27:03', 'pk', 'Tanmoy', '2018-07-06 05:27:34'),
(97, '2018-07-06 05:28:01', 'pk', 'Tanmoy', '2018-07-06 06:34:37'),
(98, '2018-07-06 06:23:42', 'sss', 'Tanmoy', NULL),
(99, '2018-07-06 06:24:33', 'sss', 'Tanmoy', NULL),
(100, '2018-07-09 11:36:01', 'pk', 'Tanmoy', '2018-07-09 12:16:53'),
(101, '2018-07-09 12:16:59', 'pk', 'Tanmoy', NULL),
(102, '2018-07-09 12:41:36', 'sss', 'Tanmoy', NULL),
(103, '2018-07-09 01:56:37', 'sss', 'Tanmoy', '2018-07-09 01:57:29'),
(104, '2018-07-09 02:03:14', 'sss', 'Tanmoy', '2018-07-09 02:03:37'),
(105, '2018-07-09 02:03:53', 'sss', 'Tanmoy', '2018-07-09 02:04:00'),
(106, '2018-07-09 02:04:29', 'pk', 'Tanmoy', '2018-07-09 02:04:51'),
(107, '2018-07-09 02:40:17', 'sss', 'Tanmoy', NULL),
(108, '2018-07-09 03:08:25', 'sss', 'Tanmoy', NULL),
(109, '2018-07-09 03:13:08', 'sss', 'Tanmoy', '2018-07-09 03:13:49'),
(110, '2018-07-09 03:13:54', 'sss', 'Tanmoy', '2018-07-09 03:15:32'),
(111, '2018-07-09 03:18:50', 'sss', 'Tanmoy', NULL),
(112, '2018-07-09 03:43:42', 'sss', 'Tanmoy', NULL),
(113, '2018-07-09 03:48:49', 'sss', 'Tanmoy', '2018-07-09 03:49:03'),
(114, '2018-07-09 05:04:40', 'sss', 'Tanmoy', NULL),
(115, '2018-07-09 05:14:06', 'sss', 'Tanmoy', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_dealers`
--
ALTER TABLE `m_dealers`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `m_login_user`
--
ALTER TABLE `m_login_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `m_products`
--
ALTER TABLE `m_products`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `m_prod_catg`
--
ALTER TABLE `m_prod_catg`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `m_prod_qty`
--
ALTER TABLE `m_prod_qty`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `m_prod_type`
--
ALTER TABLE `m_prod_type`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `t_audit_trail`
--
ALTER TABLE `t_audit_trail`
  ADD PRIMARY KEY (`sl_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_dealers`
--
ALTER TABLE `m_dealers`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_products`
--
ALTER TABLE `m_products`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_prod_catg`
--
ALTER TABLE `m_prod_catg`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `m_prod_qty`
--
ALTER TABLE `m_prod_qty`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `m_prod_type`
--
ALTER TABLE `m_prod_type`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `t_audit_trail`
--
ALTER TABLE `t_audit_trail`
  MODIFY `sl_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
