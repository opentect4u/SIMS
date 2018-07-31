-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2018 at 06:50 PM
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
('2018-07-30', 'Rice', 'AAY', 'Family', '7.50', 'sss', '2018-07-27 11:54:41', NULL, NULL),
('2018-07-30', 'Rice', 'RKSY-I', 'FAMILY', '1.00', 'sss', '2018-07-30 06:05:38', NULL, NULL),
('2018-07-30', 'Sugar', 'AAY', 'Family', '0.00', 'sss', '2018-07-27 11:57:14', NULL, NULL),
('2018-07-30', 'Wheat', 'AAY', 'FAMILY', '9.50', 'pk', '2018-07-12 05:51:23', NULL, NULL);

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
(3, 41, 'PK', 'UDAYNARANPUR', 'CONTAI', 'Howrah', 'pk', '2018-07-13 05:21:45', 'sss', '2018-07-18 04:13:24'),
(4, 25, 'R &amp; S Bhowmick', 'Udaynaranpur', 'Singti', 'Howrah', 'pk', '2018-07-13 05:22:23', NULL, NULL),
(5, 22, 'S.Pachal', 'Udaynaranpur', 'K.Monsuka', 'Howrah', 'pk', '2018-07-13 05:22:59', NULL, NULL),
(6, 23, 'SUPARSHA DAS', 'UDAYNARAYANPUR', 'HUNPUR', 'Howrah', 'pk', '2018-07-13 05:23:31', 'sss', '2018-07-18 04:15:44'),
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
  `prod_desc` varchar(150) NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_products`
--

INSERT INTO `m_products` (`sl_no`, `prod_type`, `prod_desc`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
(13, 'PDS', 'WHEAT/ATTA', 'pk', '2018-07-20 12:14:45', 'pk', '2018-07-20 12:15:14'),
(14, 'PDS', 'Rice', 'pk', '2018-07-20 12:14:57', NULL, NULL),
(15, 'PDS', 'Sugar', 'pk', '2018-07-20 12:15:06', NULL, NULL),
(16, 'PDS', 'Test', 'sss', '2018-07-26 03:06:42', NULL, NULL),
(17, 'PDS', 'hghfgh', 'sss', '2018-07-26 03:20:06', NULL, NULL);

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
(2, 'QWERT', 'FAMILY', 'pk', '2018-07-13 03:31:59', 'pk', '2018-07-18 01:26:48'),
(3, 'SPHH', 'Head', 'pk', '2018-07-13 03:32:39', NULL, NULL),
(4, 'RKSY-I', 'FAMILY', 'pk', '2018-07-13 03:34:17', 'pk', '2018-07-18 01:26:29'),
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
(3, 'KG', 'sss', '2018-07-06 04:52:05', 'pk', '2018-07-18 02:01:18'),
(4, 'GM', 'sss', '2018-07-06 04:52:14', 'pk', '2018-07-18 02:01:25'),
(5, 'ASDF', 'sss', '2018-07-06 04:53:48', 'pk', '2018-07-18 02:01:33'),
(6, 'PC', 'sss', '2018-07-06 04:53:54', 'pk', '2018-07-18 02:06:23'),
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
(1, 'PDS', 'pk', '2018-07-13 03:20:11', 'pk', '2018-07-18 12:16:33'),
(2, 'NON PDS', 'pk', '2018-07-13 03:20:23', 'pk', '2018-07-18 12:21:20'),
(3, 'TEST', 'pk', '2018-07-17 11:50:36', 'pk', '2018-07-18 12:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `m_rate_master`
--

CREATE TABLE `m_rate_master` (
  `effective_dt` date NOT NULL,
  `prod_desc` varchar(100) NOT NULL,
  `prod_type` varchar(20) NOT NULL,
  `prod_catg` varchar(20) NOT NULL,
  `per_unit` varchar(30) DEFAULT NULL,
  `prod_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_rate_master`
--

INSERT INTO `m_rate_master` (`effective_dt`, `prod_desc`, `prod_type`, `prod_catg`, `per_unit`, `prod_rate`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('2018-07-23', 'Rice', 'PDS', 'QWERT', 'KG', '10.00', 'sss', '2018-07-23 01:00:51', 'sss', '2018-07-30 10:45:22'),
('2018-07-23', 'Sugar', 'PDS', 'QWERT', 'KG', '25.00', 'sss', '2018-07-23 03:27:51', NULL, NULL),
('2018-07-23', 'WHEAT/ATTA', 'PDS', 'AAY', 'Bag', '150.00', 'sss', '2018-07-23 12:59:44', 'sss', '2018-07-23 03:28:04'),
('2018-07-27', '0', '', '0', '0', '0.00', 'sss', '2018-07-27 05:51:12', NULL, NULL),
('2018-07-27', 'WHEAT/ATTA', 'PDS', 'QWERT', 'Bag', '10.00', 'sss', '2018-07-27 05:31:12', NULL, NULL),
('2018-07-27', 'WHEAT/ATTA', 'PDS', 'RKSY-II', 'KG', '10.00', 'sss', '2018-07-27 06:20:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_shortage`
--

CREATE TABLE `m_shortage` (
  `effective_dt` date NOT NULL,
  `prod_desc` varchar(100) NOT NULL,
  `prod_type` varchar(20) NOT NULL,
  `prod_catg` varchar(20) NOT NULL,
  `short_flag` varchar(1) NOT NULL,
  `short_factor` decimal(10,6) NOT NULL DEFAULT '0.000000',
  `created_by` varchar(50) DEFAULT NULL,
  `created_dt` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_dt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_shortage`
--

INSERT INTO `m_shortage` (`effective_dt`, `prod_desc`, `prod_type`, `prod_catg`, `short_flag`, `short_factor`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('2018-07-20', 'WHEAT/ATTA', 'PDS', 'AAY', 'Y', '0.003000', 'sss', '2018-07-20 04:59:25', NULL, NULL);

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
-- Table structure for table `td_stock_balance`
--

CREATE TABLE `td_stock_balance` (
  `trans_dt` date NOT NULL,
  `trans_cd` int(10) NOT NULL,
  `prod_sl_no` int(10) NOT NULL,
  `prod_desc` varchar(100) NOT NULL,
  `prod_type` varchar(10) NOT NULL,
  `prod_catg` varchar(10) NOT NULL,
  `bag_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `qnt_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kg_bal` decimal(10,2) NOT NULL DEFAULT '0.00',
  `gm_bal` decimal(10,2) NOT NULL DEFAULT '0.00'
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
  `prod_type` varchar(10) NOT NULL,
  `prod_catg` varchar(10) NOT NULL,
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

INSERT INTO `td_stock_trans_pds` (`trans_dt`, `trans_cd`, `do_no`, `prod_sl_no`, `prod_desc`, `prod_type`, `prod_catg`, `trans_type`, `qty_bag`, `qty_qnt`, `qty_kg`, `qty_gm`, `sht_kg`, `sht_gm`, `bag_bal`, `qnt_bal`, `kg_bal`, `gm_bal`, `remarks`, `created_by`, `created_dt`, `approval_status`, `approved_by`, `approved_dt`, `modified_by`, `modified_dt`) VALUES
('2018-07-24', 1, 1, 13, 'WHEAT/ATTA', 'PDS', 'AAY', 'I', '146.00', '200.00', '100.00', '40.00', '0.00', '0.00', '146.00', '200.00', '100.00', '40.00', 'WHEAT', 'pk', '2018-07-24 05:35:27', 'A', 'sss', '2018-07-27 11:07:17', 'pk', '2018-07-25 06:49:11'),
('2018-07-25', 1, 2356, 14, 'Rice', 'PDS', 'AAY', 'I', '189.00', '80.00', '58.00', '0.00', '0.00', '0.00', '189.00', '80.00', '58.00', '0.00', 'Rice AAY Stock in', 'sss', '2018-07-25 12:33:43', 'A', 'sss', '2018-07-27 11:07:22', 'pk', '2018-07-25 06:46:41'),
('2018-07-25', 2, 96, 15, 'Sugar', 'PDS', 'AAY', 'I', '150.00', '80.00', '30.00', '170.00', '0.00', '0.00', '150.00', '80.00', '30.00', '170.00', 'Sugar AAY In ', 'sss', '2018-07-25 12:37:15', 'A', 'sss', '2018-07-27 11:07:22', 'pk', '2018-07-25 06:45:04'),
('2018-07-27', 1, 5879, 15, 'Sugar', 'PDS', 'AAY', 'I', '200.00', '80.00', '170.00', '0.00', '0.00', '0.00', '350.00', '160.00', '200.00', '170.00', 'Sugar', 'sss', '2018-07-27 11:24:03', 'A', 'sss', '2018-07-27 11:07:24', NULL, NULL),
('2018-07-27', 2, 5879, 14, 'Rice', 'PDS', 'AAY', 'I', '300.00', '5860.00', '25480.00', '0.00', '0.00', '0.00', '489.00', '5940.00', '25538.00', '0.00', 'Enter Remarks If Any..', 'sss', '2018-07-27 11:26:22', 'A', 'sss', '2018-07-27 11:07:27', NULL, NULL),
('2018-07-30', 1, 3213, 14, 'Rice', 'PDS', 'AAY', 'I', '10.00', '10.00', '11.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'ENTER REMARKS IF ANY..', 'sss', '2018-07-30 03:04:02', 'U', NULL, NULL, 'sss', '2018-07-30 03:38:53'),
('2018-07-30', 2, 123456, 14, 'Rice', 'PDS', 'AAY', 'I', '0.00', '0.00', '10.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'Enter Remarks If Any..\r\n\r\n                                ', 'sss', '2018-07-30 03:08:38', 'U', NULL, NULL, NULL, NULL),
('2018-07-30', 3, 312, 14, 'Rice', 'PDS', 'AAY', 'I', '0.00', '200.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 'ENTER REMARKS IF ANY..', 'sss', '2018-07-30 04:28:03', 'U', NULL, NULL, 'sss', '2018-07-30 04:28:26');

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
(139, '2018-07-13 06:13:10', 'sss', 'Tanmoy', '2018-07-13 06:15:01'),
(140, '2018-07-16 01:48:40', 'sss', 'Tanmoy', '2018-07-16 01:51:11'),
(141, '2018-07-16 01:51:32', 'pk', 'Tanmoy', '2018-07-16 02:09:00'),
(142, '2018-07-16 03:24:11', 'sss', '', NULL),
(143, '2018-07-16 03:28:14', 'sss', '', NULL),
(144, '2018-07-16 03:28:17', 'sss', '', NULL),
(145, '2018-07-16 03:28:27', 'sss', '', NULL),
(146, '2018-07-16 03:31:52', 'sss', '', '2018-07-16 03:31:56'),
(147, '2018-07-16 03:32:12', 'pk', 'Tanmoy', '2018-07-16 03:32:15'),
(148, '2018-07-16 03:32:27', 'pk', 'Tanmoy', '2018-07-16 03:32:29'),
(149, '2018-07-16 03:33:25', 'pk', '', NULL),
(150, '2018-07-16 03:34:16', 'pk', '', NULL),
(151, '2018-07-16 03:34:42', 'sss', '', NULL),
(152, '2018-07-16 03:42:25', 'sss', '', NULL),
(153, '2018-07-16 03:43:47', 'sss', '192.168.1.252', '2018-07-16 03:43:50'),
(154, '2018-07-16 03:44:57', 'sss', '192.168.1.27', '2018-07-16 03:46:13'),
(155, '2018-07-17 11:23:32', 'sss', '192.168.1.252', '2018-07-17 11:41:51'),
(156, '2018-07-17 11:41:56', 'sss', 'Tanmoy', '2018-07-17 11:42:12'),
(157, '2018-07-17 11:45:09', 'sss', '192.168.1.252', '2018-07-17 11:45:53'),
(158, '2018-07-17 11:46:51', 'sss', '192.168.1.252', '2018-07-17 11:49:51'),
(159, '2018-07-17 11:49:58', 'pk', '192.168.1.252', '2018-07-17 12:21:36'),
(160, '2018-07-17 01:06:53', 'pk', '192.168.1.252', NULL),
(161, '2018-07-17 02:06:13', 'pk', '192.168.1.252', NULL),
(162, '2018-07-17 03:02:01', 'sss', '192.168.1.252', NULL),
(163, '2018-07-17 04:09:50', 'pk', '192.168.1.252', NULL),
(164, '2018-07-17 04:48:24', 'sss', '192.168.1.252', NULL),
(165, '2018-07-17 04:49:34', 'pk', '192.168.1.252', NULL),
(166, '2018-07-17 05:21:40', 'sss', '127.0.0.1', '2018-07-17 06:38:12'),
(167, '2018-07-18 11:41:56', 'pk', '127.0.0.1', '2018-07-18 11:54:06'),
(168, '2018-07-18 11:55:44', 'sss', '127.0.0.1', '2018-07-18 12:04:04'),
(169, '2018-07-18 12:04:23', 'pk', '127.0.0.1', '2018-07-18 12:05:01'),
(170, '2018-07-18 12:05:07', 'sss', '127.0.0.1', '2018-07-18 12:05:27'),
(171, '2018-07-18 12:05:32', 'pk', '127.0.0.1', '2018-07-18 12:16:09'),
(172, '2018-07-18 12:16:14', 'pk', '127.0.0.1', '2018-07-18 03:15:36'),
(173, '2018-07-18 03:15:42', 'sss', '127.0.0.1', '2018-07-18 06:33:14'),
(174, '2018-07-18 06:33:21', 'pk', '127.0.0.1', NULL),
(175, '2018-07-18 06:44:36', 'sss', '127.0.0.1', '2018-07-18 06:50:30'),
(176, '2018-07-19 11:42:23', 'pk', '127.0.0.1', '2018-07-19 11:48:07'),
(177, '2018-07-19 01:46:35', 'sss', '127.0.0.1', '2018-07-19 01:46:37'),
(178, '2018-07-19 03:24:53', 'pk', '127.0.0.1', '2018-07-19 03:25:00'),
(179, '2018-07-19 03:26:45', 'pk', '127.0.0.1', '2018-07-19 03:26:47'),
(180, '2018-07-19 03:29:21', 'pk', '192.168.1.34', '2018-07-19 03:29:56'),
(181, '2018-07-19 03:31:49', 'sss', '127.0.0.1', NULL),
(182, '2018-07-19 06:11:30', 'sss', '127.0.0.1', NULL),
(183, '2018-07-19 06:28:10', 'sss', '127.0.0.1', '2018-07-19 06:30:43'),
(184, '2018-07-20 11:53:43', 'pk', '127.0.0.1', NULL),
(185, '2018-07-20 02:49:34', 'sss', '127.0.0.1', NULL),
(186, '2018-07-20 04:41:06', 'sss', '127.0.0.1', NULL),
(187, '2018-07-20 04:59:10', 'sss', '127.0.0.1', NULL),
(188, '2018-07-20 05:51:20', 'sss', '127.0.0.1', NULL),
(189, '2018-07-20 06:06:57', 'sss', '127.0.0.1', NULL),
(190, '2018-07-23 11:24:30', 'sss', '127.0.0.1', '2018-07-23 11:59:58'),
(191, '2018-07-23 12:00:14', 'pk', '127.0.0.1', '2018-07-23 12:56:41'),
(192, '2018-07-23 12:56:45', 'sss', '127.0.0.1', '2018-07-23 12:59:20'),
(193, '2018-07-23 12:59:34', 'sss', '127.0.0.1', NULL),
(194, '2018-07-23 04:22:16', 'sss', '127.0.0.1', '2018-07-23 04:22:43'),
(195, '2018-07-23 04:54:44', 'sss', '127.0.0.1', '2018-07-23 05:10:24'),
(196, '2018-07-24 03:19:22', 'pk', '127.0.0.1', '2018-07-24 03:19:55'),
(197, '2018-07-24 03:28:32', 'pk', '127.0.0.1', '2018-07-24 05:30:41'),
(198, '2018-07-24 05:34:57', 'pk', '127.0.0.1', NULL),
(199, '2018-07-25 11:38:28', 'sss', '127.0.0.1', '2018-07-25 11:58:54'),
(200, '2018-07-25 11:58:58', 'sss', '127.0.0.1', NULL),
(201, '2018-07-25 05:03:47', 'sss', '192.168.1.27', NULL),
(202, '2018-07-25 05:06:50', 'sss', '127.0.0.1', NULL),
(203, '2018-07-25 05:53:40', 'sss', '192.168.1.248', NULL),
(204, '2018-07-25 06:10:22', 'pk', '127.0.0.1', '2018-07-25 06:16:48'),
(205, '2018-07-25 06:16:53', 'pk', '127.0.0.1', NULL),
(206, '2018-07-26 11:33:49', 'sss', '127.0.0.1', NULL),
(207, '2018-07-26 12:22:55', 'sss', '127.0.0.1', '2018-07-26 01:30:44'),
(208, '2018-07-26 01:30:55', 'pk', '127.0.0.1', NULL),
(209, '2018-07-26 03:06:26', 'sss', '192.168.1.248', NULL),
(210, '2018-07-26 04:04:37', 'sss', '192.168.1.248', NULL),
(211, '2018-07-26 04:13:06', 'pk', '127.0.0.1', NULL),
(212, '2018-07-26 05:11:35', 'sss', '192.168.1.248', NULL),
(213, '2018-07-26 05:24:38', 'sss', '127.0.0.1', '2018-07-26 06:36:04'),
(214, '2018-07-26 06:38:33', 'sss', '192.168.1.248', NULL),
(215, '2018-07-27 10:51:25', 'sss', '127.0.0.1', '2018-07-27 10:58:46'),
(216, '2018-07-27 10:58:52', 'pk', '127.0.0.1', NULL),
(217, '2018-07-27 11:02:26', 'sss', '127.0.0.1', '2018-07-27 11:04:00'),
(218, '2018-07-27 11:05:09', 'sss', '127.0.0.1', NULL),
(219, '2018-07-27 11:51:24', 'sss', '::1', NULL),
(220, '2018-07-27 02:11:55', 'sss', '::1', '2018-07-27 03:07:54'),
(221, '2018-07-27 03:07:59', 'sss', '::1', '2018-07-27 03:41:49'),
(222, '2018-07-27 03:14:11', 'sss', '192.168.1.27', NULL),
(223, '2018-07-27 03:17:50', 'sss', '192.168.1.27', '2018-07-27 03:19:28'),
(224, '2018-07-27 03:42:04', 'sss', '::1', NULL),
(225, '2018-07-30 09:57:54', 'sss', '::1', NULL),
(226, '2018-07-30 04:26:25', 'sss', '::1', NULL),
(227, '2018-07-30 06:00:33', 'sss', '::1', NULL);

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
-- Indexes for table `m_rate_master`
--
ALTER TABLE `m_rate_master`
  ADD PRIMARY KEY (`effective_dt`,`prod_desc`,`prod_type`,`prod_catg`);

--
-- Indexes for table `m_shortage`
--
ALTER TABLE `m_shortage`
  ADD PRIMARY KEY (`effective_dt`,`prod_desc`,`prod_catg`);

--
-- Indexes for table `td_allotment_sheet`
--
ALTER TABLE `td_allotment_sheet`
  ADD PRIMARY KEY (`memo_no`,`alt_month`,`alt_year`,`mr_no`);

--
-- Indexes for table `td_stock_balance`
--
ALTER TABLE `td_stock_balance`
  ADD PRIMARY KEY (`trans_dt`,`trans_cd`);

--
-- Indexes for table `td_stock_trans_pds`
--
ALTER TABLE `td_stock_trans_pds`
  ADD PRIMARY KEY (`trans_dt`,`trans_cd`);

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
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
  MODIFY `sl_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `t_audit_trail`
--
ALTER TABLE `t_audit_trail`
  MODIFY `sl_no` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
