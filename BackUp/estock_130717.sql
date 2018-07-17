-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2018 at 06:17 PM
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
-- Table structure for table `m_allot_scale`
--

CREATE TABLE `m_allot_scale` (
  `effective_dt` date NOT NULL,
  `prod_desc` varchar(150) NOT NULL,
  `prod_catg` varchar(50) NOT NULL,
  `per_unit` varchar(20) DEFAULT NULL,
  `unit_val` decimal(10,2) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_allot_scale`
--

INSERT INTO `m_allot_scale` (`effective_dt`, `prod_desc`, `prod_catg`, `per_unit`, `unit_val`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('2018-07-09', 'Wheat', 'AAY', 'FAMILY', '10.00', 'pk', '2018-07-12 05:51:23', NULL, NULL);

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
  `del_dist` varchar(20) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_dealers`
--

INSERT INTO `m_dealers` (`sl_no`, `del_cd`, `del_name`, `del_adr`, `del_reg`, `del_dist`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(1, 1, 'P.K Ghosh', 'Udaynaranpur', 'RDA', 'Howrah', 'pk', '2018-07-13 05:16:20', NULL, NULL),
(2, 2, 'M.K Bhowmick', 'Udaynaranpur', 'RDA', 'Howrah', 'pk', '2018-07-13 05:21:05', NULL, NULL),
(3, 41, 'M.Shaw', 'Udaynaranpur', 'H.U.N Pur', 'Howrah', 'pk', '2018-07-13 05:21:45', NULL, NULL),
(4, 25, 'R &amp; S Bhowmick', 'Udaynaranpur', 'Singti', 'Howrah', 'pk', '2018-07-13 05:22:23', NULL, NULL),
(5, 22, 'S.Pachal', 'Udaynaranpur', 'K.Monsuka', 'Howrah', 'pk', '2018-07-13 05:22:59', NULL, NULL),
(6, 23, 'T.K Mondal', 'Udaynaranpur', 'K.Monsuka', 'Howrah', 'pk', '2018-07-13 05:23:31', NULL, NULL),
(7, 47, 'T.K Dhara', 'Udaynaranpur', 'K.Shibpur', 'Howrah', 'pk', '2018-07-13 05:24:10', NULL, NULL);

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
-- Table structure for table `m_params`
--

CREATE TABLE `m_params` (
  `paran_no` int(11) NOT NULL,
  `param_name` varchar(50) DEFAULT NULL,
  `param_value` varchar(100) DEFAULT NULL,
  `edit_flag` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_params`
--

INSERT INTO `m_params` (`paran_no`, `param_name`, `param_value`, `edit_flag`) VALUES
(1, 'Name of the Distributor', 'Laxmi Narayan Stores', 'Y'),
(2, 'Distributor No.', '95', 'N'),
(3, 'Address', 'Belgram PS:Udaynarayanpur', 'Y'),
(4, 'District', 'Howrah', 'Y'),
(5, 'Memo No.', '/INS/F & S/U.N.PUR/', 'Y');

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
(1, 'PDS', 'AAY', 'Rice', 'Y', '0.0030', 'pk', '2018-07-13 03:53:08', NULL, NULL),
(2, 'PDS', 'AAY', 'Wheat/Atta', 'N', '0.0000', 'pk', '2018-07-13 03:54:46', NULL, NULL),
(3, 'PDS', 'AAY', 'Sugar', 'Y', '0.0010', 'pk', '2018-07-13 05:10:42', NULL, NULL),
(4, 'PDS', 'PHH', 'Rice', 'Y', '0.0030', 'pk', '2018-07-13 05:12:26', NULL, NULL),
(5, 'PDS', 'PHH', 'Wheat/Atta', 'N', '0.0000', 'pk', '2018-07-13 05:12:36', NULL, NULL),
(6, 'PDS', 'SPHH', 'Rice', 'Y', '0.0030', 'pk', '2018-07-13 05:13:14', NULL, NULL),
(7, 'PDS', 'SPHH', 'Wheat/Atta', 'N', '0.0000', 'pk', '2018-07-13 05:13:27', NULL, NULL),
(8, 'PDS', 'SPHH', 'Sugar', 'Y', '0.0010', 'pk', '2018-07-13 05:13:51', NULL, NULL),
(9, 'PDS', 'RKSY-I', 'Rice', 'Y', '0.0030', 'pk', '2018-07-13 05:14:15', NULL, NULL),
(10, 'PDS', 'RKSY-I', 'Wheat/Atta', 'N', '0.0000', 'pk', '2018-07-13 05:14:41', NULL, NULL),
(11, 'PDS', 'RKSY-II', 'Rice', 'Y', '0.0030', 'pk', '2018-07-13 05:14:32', NULL, NULL),
(12, 'PDS', 'RKSY-II', 'Wheat/Atta', 'N', '0.0000', 'pk', '2018-07-13 05:14:49', NULL, NULL);

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
(1, 'AAY', 'Family', 'pk', '2018-07-13 03:23:00', NULL, NULL),
(2, 'PHH', 'Head', 'pk', '2018-07-13 03:31:59', NULL, NULL),
(3, 'SPHH', 'Head', 'pk', '2018-07-13 03:32:39', NULL, NULL),
(4, 'RKSY-I', 'Head', 'pk', '2018-07-13 03:34:17', NULL, NULL),
(5, 'RKSY-II', 'Head', 'pk', '2018-07-13 03:34:28', NULL, NULL);

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
(1, 'PDS', 'pk', '2018-07-13 03:20:11', NULL, NULL),
(2, 'Non PDS', 'pk', '2018-07-13 03:20:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `td_allotment_sheet`
--

CREATE TABLE `td_allotment_sheet` (
  `memo_no` varchar(100) NOT NULL,
  `alt_month` int(10) NOT NULL,
  `alt_year` int(10) NOT NULL,
  `gen_date` date NOT NULL,
  `mr_no` int(10) NOT NULL,
  `delr_name` varchar(100) NOT NULL,
  `delr_region` varchar(50) NOT NULL,
  `aay_family` int(10) NOT NULL DEFAULT '0',
  `aay_rice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `aay_wheat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `aay_sugar` decimal(10,2) NOT NULL DEFAULT '0.00',
  `phh_head` int(10) NOT NULL DEFAULT '0',
  `phh_rice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `phh_wheat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sphh_head` int(10) NOT NULL DEFAULT '0',
  `sphh_rice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sphh_wheat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sphh_sugar` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rksy1_head` int(10) NOT NULL DEFAULT '0',
  `rksy1_rice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rhsy1_wheat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rksy2_head` int(10) NOT NULL DEFAULT '0',
  `rksy2_rice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `rksy2_wheat` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addi_head` int(10) NOT NULL DEFAULT '0',
  `addi_aay` decimal(10,2) NOT NULL DEFAULT '0.00',
  `addi_apl_bpl` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `modified_by` varchar(50) NOT NULL,
  `modified_dt` datetime NOT NULL,
  `approval_status` char(1) NOT NULL DEFAULT 'U',
  `approved_by` varchar(50) NOT NULL,
  `approved_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_stock_trans_pds`
--

CREATE TABLE `td_stock_trans_pds` (
  `trans_dt` date NOT NULL,
  `trans_cd` int(10) NOT NULL,
  `do_no` int(10) DEFAULT NULL,
  `prod_sl_no` int(10) NOT NULL,
  `prod_desc` varchar(30) NOT NULL,
  `trans_type` varchar(5) NOT NULL,
  `qty_bag` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qty_qnt` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qty_kg` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qty_gm` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sht_kg` decimal(10,2) NOT NULL DEFAULT '0.00',
  `sht_gm` decimal(10,2) NOT NULL DEFAULT '0.00',
  `bag_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qnt_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kg_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gm_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remarks` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `approval_status` varchar(2) NOT NULL,
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_stock_trans_pds`
--

INSERT INTO `td_stock_trans_pds` (`trans_dt`, `trans_cd`, `do_no`, `prod_sl_no`, `prod_desc`, `trans_type`, `qty_bag`, `qty_qnt`, `qty_kg`, `qty_gm`, `sht_kg`, `sht_gm`, `bag_bal`, `qnt_bal`, `kg_bal`, `gm_bal`, `remarks`, `created_by`, `created_dt`, `approval_status`, `approved_by`, `approved_dt`, `modified_by`, `modified_dt`) VALUES
('2018-07-10', 1, 12, 12, 'dwd', 'I', '10.00', '20.00', '30.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-10 05:33:52', 'U', NULL, NULL, NULL, NULL),
('2018-07-10', 1, 12, 12, 'dwd', 'I', '10.00', '20.00', '30.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-10 05:43:28', 'U', NULL, NULL, NULL, NULL),
('2018-07-10', 1, 12, 12, 'dwd', 'I', '10.00', '20.00', '30.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-10 05:43:32', 'U', NULL, NULL, NULL, NULL),
('2018-07-11', 1, 123, 78, 'khkghkhgjhdjk', 'I', '10.00', '20.00', '20.00', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-11 12:20:29', 'U', NULL, NULL, NULL, NULL),
('2018-07-11', 1, 123, 78, 'khkghkhgjhdjk', 'I', '10.00', '20.00', '20.00', '1.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-11 12:21:43', 'U', NULL, NULL, NULL, NULL),
('2018-07-11', 1, 19, 200, 'Tan', 'O', '85.00', '32.00', '5.00', '5.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-11 12:25:11', 'U', NULL, NULL, NULL, NULL);

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
(115, '2018-07-09 05:14:06', 'sss', 'Tanmoy', NULL),
(116, '2018-07-10 11:05:43', 'pk', 'Tanmoy', '2018-07-10 11:32:23'),
(117, '2018-07-10 11:32:28', 'sss', 'Tanmoy', '2018-07-10 11:34:13'),
(118, '2018-07-10 11:34:19', 'sss', 'Tanmoy', '2018-07-10 11:35:44'),
(119, '2018-07-10 11:35:49', 'sss', 'Tanmoy', '2018-07-10 11:38:16'),
(120, '2018-07-10 11:38:24', 'pk', 'Tanmoy', '2018-07-10 11:40:04'),
(121, '2018-07-10 11:40:13', 'pk', 'Tanmoy', '2018-07-10 11:41:37'),
(122, '2018-07-10 11:42:25', 'sss', 'Tanmoy', NULL),
(123, '2018-07-10 02:30:25', 'sss', 'Tanmoy', NULL),
(124, '2018-07-10 03:51:51', 'pk', 'Tanmoy', '2018-07-10 04:12:57'),
(125, '2018-07-10 04:13:01', 'sss', 'Tanmoy', NULL),
(126, '2018-07-10 05:15:02', 'sss', 'Tanmoy', NULL),
(127, '2018-07-10 05:43:41', 'pk', 'Tanmoy', '2018-07-10 06:03:12'),
(128, '2018-07-10 06:03:17', 'pk', 'Tanmoy', '2018-07-10 06:14:36'),
(129, '2018-07-10 06:14:42', 'pk', 'Tanmoy', '2018-07-10 06:28:20'),
(130, '2018-07-10 06:18:55', 'pk', 'Tanmoy', NULL),
(131, '2018-07-11 12:11:56', 'sss', 'Tanmoy', NULL),
(132, '2018-07-12 02:38:51', 'sss', 'Tanmoy', NULL),
(133, '2018-07-12 05:05:24', 'pk', 'Tanmoy', NULL),
(134, '2018-07-12 05:51:53', 'pk', 'Tanmoy', NULL),
(135, '2018-07-12 06:55:40', 'pk', 'Tanmoy', '2018-07-12 06:56:16'),
(136, '2018-07-13 02:27:34', 'sss', 'Tanmoy', NULL),
(137, '2018-07-13 02:34:11', 'pk', 'Tanmoy', NULL),
(138, '2018-07-13 05:07:34', 'pk', 'Tanmoy', NULL),
(139, '2018-07-13 06:13:10', 'sss', 'Tanmoy', '2018-07-13 06:15:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_allot_scale`
--
ALTER TABLE `m_allot_scale`
  ADD PRIMARY KEY (`effective_dt`,`prod_desc`,`prod_catg`);

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
-- Indexes for table `m_params`
--
ALTER TABLE `m_params`
  ADD PRIMARY KEY (`paran_no`);

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
-- Indexes for table `td_allotment_sheet`
--
ALTER TABLE `td_allotment_sheet`
  ADD PRIMARY KEY (`memo_no`,`alt_month`,`alt_year`,`mr_no`);

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
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `m_params`
--
ALTER TABLE `m_params`
  MODIFY `paran_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_products`
--
ALTER TABLE `m_products`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `m_prod_catg`
--
ALTER TABLE `m_prod_catg`
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `sl_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
