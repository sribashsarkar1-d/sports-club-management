-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2026 at 05:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_club_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `aadhaar_records`
--

CREATE TABLE `aadhaar_records` (
  `id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `aadhaar_number` varchar(20) NOT NULL,
  `verified` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `action_performed` varchar(255) DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  `browser_info` text DEFAULT NULL,
  `action_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `locality` varchar(150) DEFAULT NULL,
  `village` varchar(150) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `home_address` text DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `full_address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `athlete_id`, `country`, `state`, `district`, `city`, `locality`, `village`, `landmark`, `home_address`, `pin_code`, `full_address`, `created_at`) VALUES
(1, 40, 'India', 'Tamil Nadu', 'District 40', 'City 40', 'Locality 40', 'Village 40', 'Near Stadium 40', 'House 40, Main Road', '700040', 'Full Address For Athlete 40', '2026-05-17 13:02:19'),
(2, 41, 'India', 'Gujarat', 'District 41', 'City 41', 'Locality 41', 'Village 41', 'Near Stadium 41', 'House 41, Main Road', '700041', 'Full Address For Athlete 41', '2026-05-17 13:02:19'),
(3, 42, 'India', 'West Bengal', 'District 42', 'City 42', 'Locality 42', 'Village 42', 'Near Stadium 42', 'House 42, Main Road', '700042', 'Full Address For Athlete 42', '2026-05-17 13:02:19'),
(4, 43, 'India', 'Maharashtra', 'District 43', 'City 43', 'Locality 43', 'Village 43', 'Near Stadium 43', 'House 43, Main Road', '700043', 'Full Address For Athlete 43', '2026-05-17 13:02:19'),
(5, 44, 'India', 'Delhi', 'District 44', 'City 44', 'Locality 44', 'Village 44', 'Near Stadium 44', 'House 44, Main Road', '700044', 'Full Address For Athlete 44', '2026-05-17 13:02:19'),
(6, 45, 'India', 'Karnataka', 'District 45', 'City 45', 'Locality 45', 'Village 45', 'Near Stadium 45', 'House 45, Main Road', '700045', 'Full Address For Athlete 45', '2026-05-17 13:02:19'),
(7, 46, 'India', 'Tamil Nadu', 'District 46', 'City 46', 'Locality 46', 'Village 46', 'Near Stadium 46', 'House 46, Main Road', '700046', 'Full Address For Athlete 46', '2026-05-17 13:02:19'),
(8, 47, 'India', 'Gujarat', 'District 47', 'City 47', 'Locality 47', 'Village 47', 'Near Stadium 47', 'House 47, Main Road', '700047', 'Full Address For Athlete 47', '2026-05-17 13:02:19'),
(9, 48, 'India', 'West Bengal', 'District 48', 'City 48', 'Locality 48', 'Village 48', 'Near Stadium 48', 'House 48, Main Road', '700048', 'Full Address For Athlete 48', '2026-05-17 13:02:19'),
(10, 49, 'India', 'Maharashtra', 'District 49', 'City 49', 'Locality 49', 'Village 49', 'Near Stadium 49', 'House 49, Main Road', '700049', 'Full Address For Athlete 49', '2026-05-17 13:02:19'),
(11, 50, 'India', 'Delhi', 'District 50', 'City 50', 'Locality 50', 'Village 50', 'Near Stadium 50', 'House 50, Main Road', '700050', 'Full Address For Athlete 50', '2026-05-17 13:02:19'),
(12, 51, 'India', 'Karnataka', 'District 51', 'City 51', 'Locality 51', 'Village 51', 'Near Stadium 51', 'House 51, Main Road', '700051', 'Full Address For Athlete 51', '2026-05-17 13:02:19'),
(13, 52, 'India', 'Tamil Nadu', 'District 52', 'City 52', 'Locality 52', 'Village 52', 'Near Stadium 52', 'House 52, Main Road', '700052', 'Full Address For Athlete 52', '2026-05-17 13:02:19'),
(14, 53, 'India', 'Gujarat', 'District 53', 'City 53', 'Locality 53', 'Village 53', 'Near Stadium 53', 'House 53, Main Road', '700053', 'Full Address For Athlete 53', '2026-05-17 13:02:19'),
(15, 54, 'India', 'West Bengal', 'District 54', 'City 54', 'Locality 54', 'Village 54', 'Near Stadium 54', 'House 54, Main Road', '700054', 'Full Address For Athlete 54', '2026-05-17 13:02:19'),
(16, 55, 'India', 'Maharashtra', 'District 55', 'City 55', 'Locality 55', 'Village 55', 'Near Stadium 55', 'House 55, Main Road', '700055', 'Full Address For Athlete 55', '2026-05-17 13:02:19'),
(17, 56, 'India', 'Delhi', 'District 56', 'City 56', 'Locality 56', 'Village 56', 'Near Stadium 56', 'House 56, Main Road', '700056', 'Full Address For Athlete 56', '2026-05-17 13:02:19'),
(18, 57, 'India', 'Karnataka', 'District 57', 'City 57', 'Locality 57', 'Village 57', 'Near Stadium 57', 'House 57, Main Road', '700057', 'Full Address For Athlete 57', '2026-05-17 13:02:19'),
(19, 58, 'India', 'Tamil Nadu', 'District 58', 'City 58', 'Locality 58', 'Village 58', 'Near Stadium 58', 'House 58, Main Road', '700058', 'Full Address For Athlete 58', '2026-05-17 13:02:19'),
(20, 59, 'India', 'Gujarat', 'District 59', 'City 59', 'Locality 59', 'Village 59', 'Near Stadium 59', 'House 59, Main Road', '700059', 'Full Address For Athlete 59', '2026-05-17 13:02:19'),
(21, 60, 'India', 'West Bengal', 'District 60', 'City 60', 'Locality 60', 'Village 60', 'Near Stadium 60', 'House 60, Main Road', '700060', 'Full Address For Athlete 60', '2026-05-17 13:02:19'),
(22, 61, 'India', 'Maharashtra', 'District 61', 'City 61', 'Locality 61', 'Village 61', 'Near Stadium 61', 'House 61, Main Road', '700061', 'Full Address For Athlete 61', '2026-05-17 13:02:19'),
(23, 62, 'India', 'Delhi', 'District 62', 'City 62', 'Locality 62', 'Village 62', 'Near Stadium 62', 'House 62, Main Road', '700062', 'Full Address For Athlete 62', '2026-05-17 13:02:19'),
(24, 63, 'India', 'Karnataka', 'District 63', 'City 63', 'Locality 63', 'Village 63', 'Near Stadium 63', 'House 63, Main Road', '700063', 'Full Address For Athlete 63', '2026-05-17 13:02:19'),
(25, 64, 'India', 'Tamil Nadu', 'District 64', 'City 64', 'Locality 64', 'Village 64', 'Near Stadium 64', 'House 64, Main Road', '700064', 'Full Address For Athlete 64', '2026-05-17 13:02:19'),
(26, 65, 'India', 'Gujarat', 'District 65', 'City 65', 'Locality 65', 'Village 65', 'Near Stadium 65', 'House 65, Main Road', '700065', 'Full Address For Athlete 65', '2026-05-17 13:02:19'),
(27, 66, 'India', 'West Bengal', 'District 66', 'City 66', 'Locality 66', 'Village 66', 'Near Stadium 66', 'House 66, Main Road', '700066', 'Full Address For Athlete 66', '2026-05-17 13:02:19'),
(28, 67, 'India', 'Maharashtra', 'District 67', 'City 67', 'Locality 67', 'Village 67', 'Near Stadium 67', 'House 67, Main Road', '700067', 'Full Address For Athlete 67', '2026-05-17 13:02:19'),
(29, 68, 'India', 'Delhi', 'District 68', 'City 68', 'Locality 68', 'Village 68', 'Near Stadium 68', 'House 68, Main Road', '700068', 'Full Address For Athlete 68', '2026-05-17 13:02:19'),
(30, 69, 'India', 'Karnataka', 'District 69', 'City 69', 'Locality 69', 'Village 69', 'Near Stadium 69', 'House 69, Main Road', '700069', 'Full Address For Athlete 69', '2026-05-17 13:02:19'),
(31, 70, 'India', 'Tamil Nadu', 'District 70', 'City 70', 'Locality 70', 'Village 70', 'Near Stadium 70', 'House 70, Main Road', '700070', 'Full Address For Athlete 70', '2026-05-17 13:02:19'),
(32, 71, 'India', 'Gujarat', 'District 71', 'City 71', 'Locality 71', 'Village 71', 'Near Stadium 71', 'House 71, Main Road', '700071', 'Full Address For Athlete 71', '2026-05-17 13:02:19'),
(33, 72, 'India', 'West Bengal', 'District 72', 'City 72', 'Locality 72', 'Village 72', 'Near Stadium 72', 'House 72, Main Road', '700072', 'Full Address For Athlete 72', '2026-05-17 13:02:19'),
(34, 73, 'India', 'Maharashtra', 'District 73', 'City 73', 'Locality 73', 'Village 73', 'Near Stadium 73', 'House 73, Main Road', '700073', 'Full Address For Athlete 73', '2026-05-17 13:02:19'),
(35, 74, 'India', 'Delhi', 'District 74', 'City 74', 'Locality 74', 'Village 74', 'Near Stadium 74', 'House 74, Main Road', '700074', 'Full Address For Athlete 74', '2026-05-17 13:02:19'),
(36, 75, 'India', 'Karnataka', 'District 75', 'City 75', 'Locality 75', 'Village 75', 'Near Stadium 75', 'House 75, Main Road', '700075', 'Full Address For Athlete 75', '2026-05-17 13:02:19'),
(37, 76, 'India', 'Tamil Nadu', 'District 76', 'City 76', 'Locality 76', 'Village 76', 'Near Stadium 76', 'House 76, Main Road', '700076', 'Full Address For Athlete 76', '2026-05-17 13:02:19'),
(38, 77, 'India', 'Gujarat', 'District 77', 'City 77', 'Locality 77', 'Village 77', 'Near Stadium 77', 'House 77, Main Road', '700077', 'Full Address For Athlete 77', '2026-05-17 13:02:19'),
(39, 78, 'India', 'West Bengal', 'District 78', 'City 78', 'Locality 78', 'Village 78', 'Near Stadium 78', 'House 78, Main Road', '700078', 'Full Address For Athlete 78', '2026-05-17 13:02:19'),
(40, 79, 'India', 'Maharashtra', 'District 79', 'City 79', 'Locality 79', 'Village 79', 'Near Stadium 79', 'House 79, Main Road', '700079', 'Full Address For Athlete 79', '2026-05-17 13:02:19'),
(41, 80, 'India', 'Delhi', 'District 80', 'City 80', 'Locality 80', 'Village 80', 'Near Stadium 80', 'House 80, Main Road', '700080', 'Full Address For Athlete 80', '2026-05-17 13:02:19'),
(42, 81, 'India', 'Karnataka', 'District 81', 'City 81', 'Locality 81', 'Village 81', 'Near Stadium 81', 'House 81, Main Road', '700081', 'Full Address For Athlete 81', '2026-05-17 13:02:19'),
(43, 82, 'India', 'Tamil Nadu', 'District 82', 'City 82', 'Locality 82', 'Village 82', 'Near Stadium 82', 'House 82, Main Road', '700082', 'Full Address For Athlete 82', '2026-05-17 13:02:19'),
(44, 83, 'India', 'Gujarat', 'District 83', 'City 83', 'Locality 83', 'Village 83', 'Near Stadium 83', 'House 83, Main Road', '700083', 'Full Address For Athlete 83', '2026-05-17 13:02:19'),
(45, 84, 'India', 'West Bengal', 'District 84', 'City 84', 'Locality 84', 'Village 84', 'Near Stadium 84', 'House 84, Main Road', '700084', 'Full Address For Athlete 84', '2026-05-17 13:02:19'),
(46, 85, 'India', 'Maharashtra', 'District 85', 'City 85', 'Locality 85', 'Village 85', 'Near Stadium 85', 'House 85, Main Road', '700085', 'Full Address For Athlete 85', '2026-05-17 13:02:19'),
(47, 86, 'India', 'Delhi', 'District 86', 'City 86', 'Locality 86', 'Village 86', 'Near Stadium 86', 'House 86, Main Road', '700086', 'Full Address For Athlete 86', '2026-05-17 13:02:19'),
(48, 87, 'India', 'Karnataka', 'District 87', 'City 87', 'Locality 87', 'Village 87', 'Near Stadium 87', 'House 87, Main Road', '700087', 'Full Address For Athlete 87', '2026-05-17 13:02:19'),
(49, 88, 'India', 'Tamil Nadu', 'District 88', 'City 88', 'Locality 88', 'Village 88', 'Near Stadium 88', 'House 88, Main Road', '700088', 'Full Address For Athlete 88', '2026-05-17 13:02:19'),
(50, 89, 'India', 'Gujarat', 'District 89', 'City 89', 'Locality 89', 'Village 89', 'Near Stadium 89', 'House 89, Main Road', '700089', 'Full Address For Athlete 89', '2026-05-17 13:02:19'),
(51, 104, 'India', 'West Bengal', 'Cooch Behar', 'Dinhata - I', NULL, 'balarampur ,sarayer par', NULL, 'balaram pur', '736134', 'balaram pur', '2026-05-17 19:44:56'),
(52, 105, 'India', 'West Bengal', 'Cooch Behar', 'Dinhata - I', NULL, 'balarampur ,sarayer par', NULL, 'balaram pur', '736134', 'balaram pur', '2026-05-17 20:14:29'),
(53, 106, 'India', 'West Bengal', 'Cooch Behar', 'Dinhata - I', NULL, 'uttar bhatora', NULL, 'mdnejkdfn', '736134', 'mdnejkdfn', '2026-05-17 20:34:07'),
(54, 108, 'India', 'West Bengal', 'Cooch Behar', 'Dinhata - I', NULL, 'balaram pur', NULL, 'balaram pur', '736134', 'balaram pur', '2026-05-17 21:47:01'),
(55, 110, 'India', 'West Bengal', 'Cooch Behar', 'Dinhata - I', NULL, 'balarampur', NULL, 'JKH-223', '736134', 'JKH-223', '2026-05-18 08:47:07'),
(56, 112, 'India', 'West Bengal', 'Cooch Behar', 'Balarāmpur', NULL, 'hjhehf', NULL, 'dxbajbjsb', '736134', 'dxbajbjsb', '2026-05-22 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `admin_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Super Admin','Admin') DEFAULT 'Admin',
  `profile_photo` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `account_status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`admin_id`, `full_name`, `email`, `password`, `role`, `profile_photo`, `mobile`, `last_login`, `account_status`, `created_at`) VALUES
(7, 'Sribash sarkar', 'roy338004@gmail.com', '$2y$10$b2Ze5Kw6UjyAKgzq/YVrWOoy0FIFwRz/z0pkgYMV3E7GlbJv5bUoq', 'Admin', NULL, NULL, '2026-05-22 11:31:12', 'Active', '2026-05-18 08:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `athletes`
--

CREATE TABLE `athletes` (
  `athlete_id` int(11) NOT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `registration_no` varchar(50) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `guardian_email` varchar(150) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `medical_condition` text DEFAULT NULL,
  `previous_achievement` varchar(255) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `athlete_status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `athletes`
--

INSERT INTO `athletes` (`athlete_id`, `application_no`, `registration_no`, `full_name`, `dob`, `age`, `gender`, `country`, `mobile`, `email`, `guardian_email`, `nationality`, `blood_group`, `medical_condition`, `previous_achievement`, `profile_photo`, `athlete_status`, `created_at`, `updated_at`) VALUES
(40, 'APP20260001', 'REG20260001', 'Athlete 1', '2009-12-02', 15, 'Female', 'India', '9000000001', 'athlete1@gmail.com', 'guardian1@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 1', 'profile_1.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(41, 'APP20260002', 'REG20260002', 'Athlete 2', '2009-11-02', 16, 'Other', 'India', '9000000002', 'athlete2@gmail.com', 'guardian2@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 2', 'profile_2.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(42, 'APP20260003', 'REG20260003', 'Athlete 3', '2009-10-03', 17, 'Male', 'India', '9000000003', 'athlete3@gmail.com', 'guardian3@gmail.com', 'Indian', 'AB+', 'Fitness Monitoring', 'Won District Championship 3', 'profile_3.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(43, 'APP20260004', 'REG20260004', 'Athlete 4', '2009-09-03', 18, 'Female', 'India', '9000000004', 'athlete4@gmail.com', 'guardian4@gmail.com', 'Indian', 'A-', 'None', 'Won District Championship 4', 'profile_4.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(44, 'APP20260005', 'REG20260005', 'Athlete 5', '2009-08-04', 19, 'Other', 'India', '9000000005', 'athlete5@gmail.com', 'guardian5@gmail.com', 'Indian', 'B-', 'Asthma', 'Won District Championship 5', 'profile_5.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(45, 'APP20260006', 'REG20260006', 'Athlete 6', '2009-07-05', 20, 'Male', 'India', '9000000006', 'athlete6@gmail.com', 'guardian6@gmail.com', 'Indian', 'O-', 'Knee Injury', 'Won District Championship 6', 'profile_6.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(46, 'APP20260007', 'REG20260007', 'Athlete 7', '2009-06-05', 21, 'Female', 'India', '9000000007', 'athlete7@gmail.com', 'guardian7@gmail.com', 'Indian', 'AB-', 'Fitness Monitoring', 'Won District Championship 7', 'profile_7.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(47, 'APP20260008', 'REG20260008', 'Athlete 8', '2009-05-06', 14, 'Other', 'India', '9000000008', 'athlete8@gmail.com', 'guardian8@gmail.com', 'Indian', 'A+', 'None', 'Won District Championship 8', 'profile_8.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(48, 'APP20260009', 'REG20260009', 'Athlete 9', '2009-04-06', 15, 'Male', 'India', '9000000009', 'athlete9@gmail.com', 'guardian9@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 9', 'profile_9.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(49, 'APP20260010', 'REG20260010', 'Athlete 10', '2009-03-07', 16, 'Female', 'India', '9000000010', 'athlete10@gmail.com', 'guardian10@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 10', 'profile_10.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(50, 'APP20260011', 'REG20260011', 'Athlete 11', '2009-02-05', 17, 'Other', 'India', '9000000011', 'athlete11@gmail.com', 'guardian11@gmail.com', 'Indian', 'AB+', 'Fitness Monitoring', 'Won District Championship 11', 'profile_11.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(51, 'APP20260012', 'REG20260012', 'Athlete 12', '2009-01-06', 18, 'Male', 'India', '9000000012', 'athlete12@gmail.com', 'guardian12@gmail.com', 'Indian', 'A-', 'None', 'Won District Championship 12', 'profile_12.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(52, 'APP20260013', 'REG20260013', 'Athlete 13', '2008-12-07', 19, 'Female', 'India', '9000000013', 'athlete13@gmail.com', 'guardian13@gmail.com', 'Indian', 'B-', 'Asthma', 'Won District Championship 13', 'profile_13.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(53, 'APP20260014', 'REG20260014', 'Athlete 14', '2008-11-07', 20, 'Other', 'India', '9000000014', 'athlete14@gmail.com', 'guardian14@gmail.com', 'Indian', 'O-', 'Knee Injury', 'Won District Championship 14', 'profile_14.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(54, 'APP20260015', 'REG20260015', 'Athlete 15', '2008-10-08', 21, 'Male', 'India', '9000000015', 'athlete15@gmail.com', 'guardian15@gmail.com', 'Indian', 'AB-', 'Fitness Monitoring', 'Won District Championship 15', 'profile_15.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(55, 'APP20260016', 'REG20260016', 'Athlete 16', '2008-09-08', 14, 'Female', 'India', '9000000016', 'athlete16@gmail.com', 'guardian16@gmail.com', 'Indian', 'A+', 'None', 'Won District Championship 16', 'profile_16.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(56, 'APP20260017', 'REG20260017', 'Athlete 17', '2008-08-09', 15, 'Other', 'India', '9000000017', 'athlete17@gmail.com', 'guardian17@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 17', 'profile_17.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(57, 'APP20260018', 'REG20260018', 'Athlete 18', '2008-07-10', 16, 'Male', 'India', '9000000018', 'athlete18@gmail.com', 'guardian18@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 18', 'profile_18.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(58, 'APP20260019', 'REG20260019', 'Athlete 19', '2008-06-10', 17, 'Female', 'India', '9000000019', 'athlete19@gmail.com', 'guardian19@gmail.com', 'Indian', 'AB+', 'Fitness Monitoring', 'Won District Championship 19', 'profile_19.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(59, 'APP20260020', 'REG20260020', 'Athlete 20', '2008-05-11', 18, 'Other', 'India', '9000000020', 'athlete20@gmail.com', 'guardian20@gmail.com', 'Indian', 'A-', 'None', 'Won District Championship 20', 'profile_20.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(60, 'APP20260021', 'REG20260021', 'Athlete 21', '2008-04-11', 19, 'Male', 'India', '9000000021', 'athlete21@gmail.com', 'guardian21@gmail.com', 'Indian', 'B-', 'Asthma', 'Won District Championship 21', 'profile_21.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(61, 'APP20260022', 'REG20260022', 'Athlete 22', '2008-03-12', 20, 'Female', 'India', '9000000022', 'athlete22@gmail.com', 'guardian22@gmail.com', 'Indian', 'O-', 'Knee Injury', 'Won District Championship 22', 'profile_22.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(62, 'APP20260023', 'REG20260023', 'Athlete 23', '2008-02-11', 21, 'Other', 'India', '9000000023', 'athlete23@gmail.com', 'guardian23@gmail.com', 'Indian', 'AB-', 'Fitness Monitoring', 'Won District Championship 23', 'profile_23.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(63, 'APP20260024', 'REG20260024', 'Athlete 24', '2008-01-12', 14, 'Male', 'India', '9000000024', 'athlete24@gmail.com', 'guardian24@gmail.com', 'Indian', 'A+', 'None', 'Won District Championship 24', 'profile_24.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(64, 'APP20260025', 'REG20260025', 'Athlete 25', '2007-12-13', 15, 'Female', 'India', '9000000025', 'athlete25@gmail.com', 'guardian25@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 25', 'profile_25.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(65, 'APP20260026', 'REG20260026', 'Athlete 26', '2007-11-13', 16, 'Other', 'India', '9000000026', 'athlete26@gmail.com', 'guardian26@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 26', 'profile_26.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(66, 'APP20260027', 'REG20260027', 'Athlete 27', '2007-10-14', 17, 'Male', 'India', '9000000027', 'athlete27@gmail.com', 'guardian27@gmail.com', 'Indian', 'AB+', 'Fitness Monitoring', 'Won District Championship 27', 'profile_27.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(67, 'APP20260028', 'REG20260028', 'Athlete 28', '2007-09-14', 18, 'Female', 'India', '9000000028', 'athlete28@gmail.com', 'guardian28@gmail.com', 'Indian', 'A-', 'None', 'Won District Championship 28', 'profile_28.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(68, 'APP20260029', 'REG20260029', 'Athlete 29', '2007-08-15', 19, 'Other', 'India', '9000000029', 'athlete29@gmail.com', 'guardian29@gmail.com', 'Indian', 'B-', 'Asthma', 'Won District Championship 29', 'profile_29.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(69, 'APP20260030', 'REG20260030', 'Athlete 30', '2007-07-16', 20, 'Male', 'India', '9000000030', 'athlete30@gmail.com', 'guardian30@gmail.com', 'Indian', 'O-', 'Knee Injury', 'Won District Championship 30', 'profile_30.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(70, 'APP20260031', 'REG20260031', 'Athlete 31', '2007-06-16', 21, 'Female', 'India', '9000000031', 'athlete31@gmail.com', 'guardian31@gmail.com', 'Indian', 'AB-', 'Fitness Monitoring', 'Won District Championship 31', 'profile_31.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(71, 'APP20260032', 'REG20260032', 'Athlete 32', '2007-05-17', 14, 'Other', 'India', '9000000032', 'athlete32@gmail.com', 'guardian32@gmail.com', 'Indian', 'A+', 'None', 'Won District Championship 32', 'profile_32.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(72, 'APP20260033', 'REG20260033', 'Athlete 33', '2007-04-17', 15, 'Male', 'India', '9000000033', 'athlete33@gmail.com', 'guardian33@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 33', 'profile_33.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(73, 'APP20260034', 'REG20260034', 'Athlete 34', '2007-03-18', 16, 'Female', 'India', '9000000034', 'athlete34@gmail.com', 'guardian34@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 34', 'profile_34.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(74, 'APP20260035', 'REG20260035', 'Athlete 35', '2007-02-16', 17, 'Other', 'India', '9000000035', 'athlete35@gmail.com', 'guardian35@gmail.com', 'Indian', 'AB+', 'Fitness Monitoring', 'Won District Championship 35', 'profile_35.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(75, 'APP20260036', 'REG20260036', 'Athlete 36', '2007-01-17', 18, 'Male', 'India', '9000000036', 'athlete36@gmail.com', 'guardian36@gmail.com', 'Indian', 'A-', 'None', 'Won District Championship 36', 'profile_36.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(76, 'APP20260037', 'REG20260037', 'Athlete 37', '2006-12-18', 19, 'Female', 'India', '9000000037', 'athlete37@gmail.com', 'guardian37@gmail.com', 'Indian', 'B-', 'Asthma', 'Won District Championship 37', 'profile_37.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(77, 'APP20260038', 'REG20260038', 'Athlete 38', '2006-11-18', 20, 'Other', 'India', '9000000038', 'athlete38@gmail.com', 'guardian38@gmail.com', 'Indian', 'O-', 'Knee Injury', 'Won District Championship 38', 'profile_38.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(78, 'APP20260039', 'REG20260039', 'Athlete 39', '2006-10-19', 21, 'Male', 'India', '9000000039', 'athlete39@gmail.com', 'guardian39@gmail.com', 'Indian', 'AB-', 'Fitness Monitoring', 'Won District Championship 39', 'profile_39.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(79, 'APP20260040', 'REG20260040', 'Athlete 40', '2006-09-19', 14, 'Female', 'India', '9000000040', 'athlete40@gmail.com', 'guardian40@gmail.com', 'Indian', 'A+', 'None', 'Won District Championship 40', 'profile_40.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(80, 'APP20260041', 'REG20260041', 'Athlete 41', '2006-08-20', 15, 'Other', 'India', '9000000041', 'athlete41@gmail.com', 'guardian41@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 41', 'profile_41.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(81, 'APP20260042', 'REG20260042', 'Athlete 42', '2006-07-21', 16, 'Male', 'India', '9000000042', 'athlete42@gmail.com', 'guardian42@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 42', 'profile_42.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(82, 'APP20260043', 'REG20260043', 'Athlete 43', '2006-06-21', 17, 'Female', 'India', '9000000043', 'athlete43@gmail.com', 'guardian43@gmail.com', 'Indian', 'AB+', 'Fitness Monitoring', 'Won District Championship 43', 'profile_43.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(83, 'APP20260044', 'REG20260044', 'Athlete 44', '2006-05-22', 18, 'Other', 'India', '9000000044', 'athlete44@gmail.com', 'guardian44@gmail.com', 'Indian', 'A-', 'None', 'Won District Championship 44', 'profile_44.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(84, 'APP20260045', 'REG20260045', 'Athlete 45', '2006-04-22', 19, 'Male', 'India', '9000000045', 'athlete45@gmail.com', 'guardian45@gmail.com', 'Indian', 'B-', 'Asthma', 'Won District Championship 45', 'profile_45.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(85, 'APP20260046', 'REG20260046', 'Athlete 46', '2006-03-23', 20, 'Female', 'India', '9000000046', 'athlete46@gmail.com', 'guardian46@gmail.com', 'Indian', 'O-', 'Knee Injury', 'Won District Championship 46', 'profile_46.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(86, 'APP20260047', 'REG20260047', 'Athlete 47', '2006-02-21', 21, 'Other', 'India', '9000000047', 'athlete47@gmail.com', 'guardian47@gmail.com', 'Indian', 'AB-', 'Fitness Monitoring', 'Won District Championship 47', 'profile_47.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(87, 'APP20260048', 'REG20260048', 'Athlete 48', '2006-01-22', 14, 'Male', 'India', '9000000048', 'athlete48@gmail.com', 'guardian48@gmail.com', 'Indian', 'A+', 'None', 'Won District Championship 48', 'profile_48.jpg', 'Pending', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(88, 'APP20260049', 'REG20260049', 'Athlete 49', '2005-12-23', 15, 'Female', 'India', '9000000049', 'athlete49@gmail.com', 'guardian49@gmail.com', 'Indian', 'B+', 'Asthma', 'Won District Championship 49', 'profile_49.jpg', 'Approved', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(89, 'APP20260050', 'REG20260050', 'Athlete 50', '2005-11-23', 16, 'Other', 'India', '9000000050', 'athlete50@gmail.com', 'guardian50@gmail.com', 'Indian', 'O+', 'Knee Injury', 'Won District Championship 50', 'profile_50.jpg', '', '2026-05-17 13:02:19', '2026-05-17 13:02:19'),
(104, NULL, 'SCM-2026-803564', 'sayan bakin', '2000-05-02', 26, 'Male', 'India', '9898989898', 'sribashsarkar67@gmail.com', NULL, NULL, 'O+', 'good medical', 'x foot baller', '1779046546_118dea7f.jpg', 'Pending', '2026-05-17 19:44:55', '2026-05-17 20:10:18'),
(105, NULL, 'SCM-2026-737573', 'Sribash sarkar', '2020-02-02', 6, 'Male', 'India', '9083646603', 'sribashsarr3467@gmail.com', NULL, NULL, 'AB-', 'vvjbdsvjnds', 'fdngljfdng international', '1779048705_682ef6a3.jpg', 'Approved', '2026-05-17 20:14:29', '2026-05-18 08:20:43'),
(106, NULL, 'SCM-2026-621555', 'Yash roy', '2020-05-14', 6, 'Male', 'India', '9083648888', 'roy3304@gmail.com', NULL, NULL, 'B-', NULL, 'x foot baller', '1779049992_d27f30ec.jpg', 'Approved', '2026-05-17 20:34:07', '2026-05-18 08:47:01'),
(108, NULL, 'SCM-2026-781323', 'Yash roy', '2011-01-28', 15, 'Male', 'India', '9083000000', 'sribashsarkarblp@gmail.com', NULL, NULL, 'B-', NULL, NULL, '1779054325_ee653bc7.jpg', 'Approved', '2026-05-17 21:47:00', '2026-05-18 08:35:02'),
(110, NULL, 'SCM-2026-281232', 'sribash sarkar', '2020-01-01', 6, 'Male', 'India', '8989898945', 'roy338004@gmail.com', NULL, NULL, 'AB+', 'medical condition good', NULL, '1779093900_9632796f.jpg', 'Approved', '2026-05-18 08:47:07', '2026-05-18 08:49:33'),
(112, NULL, 'SCM-2026-606704', 'Yash roy', '2011-11-11', 14, 'Male', 'India', '9083646000', 'sarkarlal67@gmail.com', NULL, NULL, 'AB+', NULL, NULL, '1779449319_c3ed5538.jpg', 'Approved', '2026-05-22 11:29:47', '2026-05-22 12:42:13');

-- --------------------------------------------------------

--
-- Table structure for table `athlete_cards`
--

CREATE TABLE `athlete_cards` (
  `card_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `unique_id` varchar(50) NOT NULL,
  `qr_code_path` varchar(255) DEFAULT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `cert_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `certificate_type` varchar(50) NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `generated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `club_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `club_name` varchar(100) DEFAULT NULL,
  `club_registration_no` varchar(150) DEFAULT NULL,
  `state_association` varchar(100) DEFAULT NULL,
  `association_id` varchar(150) DEFAULT NULL,
  `training_address` text DEFAULT NULL,
  `coach_name` varchar(100) DEFAULT NULL,
  `coach_mobile` varchar(15) DEFAULT NULL,
  `coach_email` varchar(150) DEFAULT NULL,
  `experience_years` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`club_id`, `athlete_id`, `club_name`, `club_registration_no`, `state_association`, `association_id`, `training_address`, `coach_name`, `coach_mobile`, `coach_email`, `experience_years`, `created_at`) VALUES
(16, 40, 'Elite Sports Club 40', 'CLUBREG0040', 'State Association 40', 'ASSOC0040', 'Training Ground 40', 'Coach 40', '9333300040', 'coach40@gmail.com', 15, '2026-05-17 13:02:19'),
(17, 41, 'Elite Sports Club 41', 'CLUBREG0041', 'State Association 41', 'ASSOC0041', 'Training Ground 41', 'Coach 41', '9333300041', 'coach41@gmail.com', 16, '2026-05-17 13:02:19'),
(18, 42, 'Elite Sports Club 42', 'CLUBREG0042', 'State Association 42', 'ASSOC0042', 'Training Ground 42', 'Coach 42', '9333300042', 'coach42@gmail.com', 17, '2026-05-17 13:02:19'),
(19, 43, 'Elite Sports Club 43', 'CLUBREG0043', 'State Association 43', 'ASSOC0043', 'Training Ground 43', 'Coach 43', '9333300043', 'coach43@gmail.com', 18, '2026-05-17 13:02:19'),
(20, 44, 'Elite Sports Club 44', 'CLUBREG0044', 'State Association 44', 'ASSOC0044', 'Training Ground 44', 'Coach 44', '9333300044', 'coach44@gmail.com', 19, '2026-05-17 13:02:19'),
(21, 45, 'Elite Sports Club 45', 'CLUBREG0045', 'State Association 45', 'ASSOC0045', 'Training Ground 45', 'Coach 45', '9333300045', 'coach45@gmail.com', 5, '2026-05-17 13:02:19'),
(22, 46, 'Elite Sports Club 46', 'CLUBREG0046', 'State Association 46', 'ASSOC0046', 'Training Ground 46', 'Coach 46', '9333300046', 'coach46@gmail.com', 6, '2026-05-17 13:02:19'),
(23, 47, 'Elite Sports Club 47', 'CLUBREG0047', 'State Association 47', 'ASSOC0047', 'Training Ground 47', 'Coach 47', '9333300047', 'coach47@gmail.com', 7, '2026-05-17 13:02:19'),
(24, 48, 'Elite Sports Club 48', 'CLUBREG0048', 'State Association 48', 'ASSOC0048', 'Training Ground 48', 'Coach 48', '9333300048', 'coach48@gmail.com', 8, '2026-05-17 13:02:19'),
(25, 49, 'Elite Sports Club 49', 'CLUBREG0049', 'State Association 49', 'ASSOC0049', 'Training Ground 49', 'Coach 49', '9333300049', 'coach49@gmail.com', 9, '2026-05-17 13:02:19'),
(26, 50, 'Elite Sports Club 50', 'CLUBREG0050', 'State Association 50', 'ASSOC0050', 'Training Ground 50', 'Coach 50', '9333300050', 'coach50@gmail.com', 10, '2026-05-17 13:02:19'),
(27, 51, 'Elite Sports Club 51', 'CLUBREG0051', 'State Association 51', 'ASSOC0051', 'Training Ground 51', 'Coach 51', '9333300051', 'coach51@gmail.com', 11, '2026-05-17 13:02:19'),
(28, 52, 'Elite Sports Club 52', 'CLUBREG0052', 'State Association 52', 'ASSOC0052', 'Training Ground 52', 'Coach 52', '9333300052', 'coach52@gmail.com', 12, '2026-05-17 13:02:19'),
(29, 53, 'Elite Sports Club 53', 'CLUBREG0053', 'State Association 53', 'ASSOC0053', 'Training Ground 53', 'Coach 53', '9333300053', 'coach53@gmail.com', 13, '2026-05-17 13:02:19'),
(30, 54, 'Elite Sports Club 54', 'CLUBREG0054', 'State Association 54', 'ASSOC0054', 'Training Ground 54', 'Coach 54', '9333300054', 'coach54@gmail.com', 14, '2026-05-17 13:02:19'),
(31, 55, 'Elite Sports Club 55', 'CLUBREG0055', 'State Association 55', 'ASSOC0055', 'Training Ground 55', 'Coach 55', '9333300055', 'coach55@gmail.com', 15, '2026-05-17 13:02:19'),
(32, 56, 'Elite Sports Club 56', 'CLUBREG0056', 'State Association 56', 'ASSOC0056', 'Training Ground 56', 'Coach 56', '9333300056', 'coach56@gmail.com', 16, '2026-05-17 13:02:19'),
(33, 57, 'Elite Sports Club 57', 'CLUBREG0057', 'State Association 57', 'ASSOC0057', 'Training Ground 57', 'Coach 57', '9333300057', 'coach57@gmail.com', 17, '2026-05-17 13:02:19'),
(34, 58, 'Elite Sports Club 58', 'CLUBREG0058', 'State Association 58', 'ASSOC0058', 'Training Ground 58', 'Coach 58', '9333300058', 'coach58@gmail.com', 18, '2026-05-17 13:02:19'),
(35, 59, 'Elite Sports Club 59', 'CLUBREG0059', 'State Association 59', 'ASSOC0059', 'Training Ground 59', 'Coach 59', '9333300059', 'coach59@gmail.com', 19, '2026-05-17 13:02:19'),
(36, 60, 'Elite Sports Club 60', 'CLUBREG0060', 'State Association 60', 'ASSOC0060', 'Training Ground 60', 'Coach 60', '9333300060', 'coach60@gmail.com', 5, '2026-05-17 13:02:19'),
(37, 61, 'Elite Sports Club 61', 'CLUBREG0061', 'State Association 61', 'ASSOC0061', 'Training Ground 61', 'Coach 61', '9333300061', 'coach61@gmail.com', 6, '2026-05-17 13:02:19'),
(38, 62, 'Elite Sports Club 62', 'CLUBREG0062', 'State Association 62', 'ASSOC0062', 'Training Ground 62', 'Coach 62', '9333300062', 'coach62@gmail.com', 7, '2026-05-17 13:02:19'),
(39, 63, 'Elite Sports Club 63', 'CLUBREG0063', 'State Association 63', 'ASSOC0063', 'Training Ground 63', 'Coach 63', '9333300063', 'coach63@gmail.com', 8, '2026-05-17 13:02:19'),
(40, 64, 'Elite Sports Club 64', 'CLUBREG0064', 'State Association 64', 'ASSOC0064', 'Training Ground 64', 'Coach 64', '9333300064', 'coach64@gmail.com', 9, '2026-05-17 13:02:19'),
(41, 65, 'Elite Sports Club 65', 'CLUBREG0065', 'State Association 65', 'ASSOC0065', 'Training Ground 65', 'Coach 65', '9333300065', 'coach65@gmail.com', 10, '2026-05-17 13:02:19'),
(42, 66, 'Elite Sports Club 66', 'CLUBREG0066', 'State Association 66', 'ASSOC0066', 'Training Ground 66', 'Coach 66', '9333300066', 'coach66@gmail.com', 11, '2026-05-17 13:02:19'),
(43, 67, 'Elite Sports Club 67', 'CLUBREG0067', 'State Association 67', 'ASSOC0067', 'Training Ground 67', 'Coach 67', '9333300067', 'coach67@gmail.com', 12, '2026-05-17 13:02:19'),
(44, 68, 'Elite Sports Club 68', 'CLUBREG0068', 'State Association 68', 'ASSOC0068', 'Training Ground 68', 'Coach 68', '9333300068', 'coach68@gmail.com', 13, '2026-05-17 13:02:19'),
(45, 69, 'Elite Sports Club 69', 'CLUBREG0069', 'State Association 69', 'ASSOC0069', 'Training Ground 69', 'Coach 69', '9333300069', 'coach69@gmail.com', 14, '2026-05-17 13:02:19'),
(46, 70, 'Elite Sports Club 70', 'CLUBREG0070', 'State Association 70', 'ASSOC0070', 'Training Ground 70', 'Coach 70', '9333300070', 'coach70@gmail.com', 15, '2026-05-17 13:02:19'),
(47, 71, 'Elite Sports Club 71', 'CLUBREG0071', 'State Association 71', 'ASSOC0071', 'Training Ground 71', 'Coach 71', '9333300071', 'coach71@gmail.com', 16, '2026-05-17 13:02:19'),
(48, 72, 'Elite Sports Club 72', 'CLUBREG0072', 'State Association 72', 'ASSOC0072', 'Training Ground 72', 'Coach 72', '9333300072', 'coach72@gmail.com', 17, '2026-05-17 13:02:19'),
(49, 73, 'Elite Sports Club 73', 'CLUBREG0073', 'State Association 73', 'ASSOC0073', 'Training Ground 73', 'Coach 73', '9333300073', 'coach73@gmail.com', 18, '2026-05-17 13:02:19'),
(50, 74, 'Elite Sports Club 74', 'CLUBREG0074', 'State Association 74', 'ASSOC0074', 'Training Ground 74', 'Coach 74', '9333300074', 'coach74@gmail.com', 19, '2026-05-17 13:02:19'),
(51, 75, 'Elite Sports Club 75', 'CLUBREG0075', 'State Association 75', 'ASSOC0075', 'Training Ground 75', 'Coach 75', '9333300075', 'coach75@gmail.com', 5, '2026-05-17 13:02:19'),
(52, 76, 'Elite Sports Club 76', 'CLUBREG0076', 'State Association 76', 'ASSOC0076', 'Training Ground 76', 'Coach 76', '9333300076', 'coach76@gmail.com', 6, '2026-05-17 13:02:19'),
(53, 77, 'Elite Sports Club 77', 'CLUBREG0077', 'State Association 77', 'ASSOC0077', 'Training Ground 77', 'Coach 77', '9333300077', 'coach77@gmail.com', 7, '2026-05-17 13:02:19'),
(54, 78, 'Elite Sports Club 78', 'CLUBREG0078', 'State Association 78', 'ASSOC0078', 'Training Ground 78', 'Coach 78', '9333300078', 'coach78@gmail.com', 8, '2026-05-17 13:02:19'),
(55, 79, 'Elite Sports Club 79', 'CLUBREG0079', 'State Association 79', 'ASSOC0079', 'Training Ground 79', 'Coach 79', '9333300079', 'coach79@gmail.com', 9, '2026-05-17 13:02:19'),
(56, 80, 'Elite Sports Club 80', 'CLUBREG0080', 'State Association 80', 'ASSOC0080', 'Training Ground 80', 'Coach 80', '9333300080', 'coach80@gmail.com', 10, '2026-05-17 13:02:19'),
(57, 81, 'Elite Sports Club 81', 'CLUBREG0081', 'State Association 81', 'ASSOC0081', 'Training Ground 81', 'Coach 81', '9333300081', 'coach81@gmail.com', 11, '2026-05-17 13:02:19'),
(58, 82, 'Elite Sports Club 82', 'CLUBREG0082', 'State Association 82', 'ASSOC0082', 'Training Ground 82', 'Coach 82', '9333300082', 'coach82@gmail.com', 12, '2026-05-17 13:02:19'),
(59, 83, 'Elite Sports Club 83', 'CLUBREG0083', 'State Association 83', 'ASSOC0083', 'Training Ground 83', 'Coach 83', '9333300083', 'coach83@gmail.com', 13, '2026-05-17 13:02:19'),
(60, 84, 'Elite Sports Club 84', 'CLUBREG0084', 'State Association 84', 'ASSOC0084', 'Training Ground 84', 'Coach 84', '9333300084', 'coach84@gmail.com', 14, '2026-05-17 13:02:19'),
(61, 85, 'Elite Sports Club 85', 'CLUBREG0085', 'State Association 85', 'ASSOC0085', 'Training Ground 85', 'Coach 85', '9333300085', 'coach85@gmail.com', 15, '2026-05-17 13:02:19'),
(62, 86, 'Elite Sports Club 86', 'CLUBREG0086', 'State Association 86', 'ASSOC0086', 'Training Ground 86', 'Coach 86', '9333300086', 'coach86@gmail.com', 16, '2026-05-17 13:02:19'),
(63, 87, 'Elite Sports Club 87', 'CLUBREG0087', 'State Association 87', 'ASSOC0087', 'Training Ground 87', 'Coach 87', '9333300087', 'coach87@gmail.com', 17, '2026-05-17 13:02:19'),
(64, 88, 'Elite Sports Club 88', 'CLUBREG0088', 'State Association 88', 'ASSOC0088', 'Training Ground 88', 'Coach 88', '9333300088', 'coach88@gmail.com', 18, '2026-05-17 13:02:19'),
(65, 89, 'Elite Sports Club 89', 'CLUBREG0089', 'State Association 89', 'ASSOC0089', 'Training Ground 89', 'Coach 89', '9333300089', 'coach89@gmail.com', 19, '2026-05-17 13:02:19'),
(66, 104, 'b-boys-club', '789456123000', 'West Bengal', 'hn87878787', 'alipur duyar', 'ram ji sing', '9083646603', 'sribashsarkar3467@gmail.com', 5, '2026-05-17 19:44:56'),
(67, 105, 'a-c name', '789456123000', 'West Bengal', 'hn87878787', 'fgejfhewhfg', 'ram ji sing', '8885858584', 'sribashsarkar3467@gmail.com', 10, '2026-05-17 20:14:29'),
(68, 106, 'ndfdjbadmn', '789456123000', 'West Bengal', NULL, NULL, 'scdhvc', '9083646603', 'roy338004@gmail.com', 2, '2026-05-17 20:34:07'),
(69, 108, 'aa', 'aa', 'aaaaaaaa', NULL, NULL, 'aa', '8888888888', NULL, 10, '2026-05-17 21:47:01'),
(70, 110, 'A-india', '4544ddddf', 'West Bengal', '4787fhbs', 'cooch behar', 'ram sing', '6238878778', 'roy338004@gmail.com', 10, '2026-05-18 08:47:07'),
(71, 112, 'abcd-clb', 'clu09890', 'West Bengal', NULL, NULL, 'ram', '9083646603', 'sribashsarkar3467@gmail.com', 10, '2026-05-22 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `club_athletes`
--

CREATE TABLE `club_athletes` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `club_documents`
--

CREATE TABLE `club_documents` (
  `id` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `document_name` varchar(100) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `coach_id` int(11) NOT NULL,
  `club_id` int(11) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `status` enum('Pending','Verified','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `competitions`
--

CREATE TABLE `competitions` (
  `competition_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `competition_name` varchar(100) NOT NULL,
  `event_name` varchar(100) DEFAULT NULL,
  `age_group` varchar(50) DEFAULT NULL,
  `gender_category` varchar(50) DEFAULT NULL,
  `weight_category` varchar(50) DEFAULT NULL,
  `competition_level` enum('District','State','National','International') DEFAULT NULL,
  `competition_experience` varchar(150) DEFAULT NULL,
  `previous_achievement` varchar(255) DEFAULT NULL,
  `medical_condition` text DEFAULT NULL,
  `participation_year` year(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `competitions`
--

INSERT INTO `competitions` (`competition_id`, `athlete_id`, `competition_name`, `event_name`, `age_group`, `gender_category`, `weight_category`, `competition_level`, `competition_experience`, `previous_achievement`, `medical_condition`, `participation_year`, `created_at`) VALUES
(13, 40, 'National Championship 40', '100m Sprint', 'Under 14', 'Male', '40kg', 'District', '1 Years', 'Achievement 40', 'Fit', '2024', '2026-05-17 13:02:19'),
(14, 41, 'National Championship 41', 'Football', 'Under 16', 'Female', '50kg', 'State', '2 Years', 'Achievement 41', 'Fit', '2025', '2026-05-17 13:02:19'),
(15, 42, 'National Championship 42', 'Swimming', 'Under 18', 'Male', '60kg', 'National', '3 Years', 'Achievement 42', 'Fit', '2020', '2026-05-17 13:02:19'),
(16, 43, 'National Championship 43', 'Cricket', 'Senior', 'Female', '70kg', 'International', '4 Years', 'Achievement 43', 'Fit', '2021', '2026-05-17 13:02:19'),
(17, 44, 'National Championship 44', 'Badminton', 'Under 14', 'Male', '80kg', 'District', '5 Years', 'Achievement 44', 'Fit', '2022', '2026-05-17 13:02:19'),
(18, 45, 'National Championship 45', '100m Sprint', 'Under 16', 'Female', '40kg', 'State', '6 Years', 'Achievement 45', 'Fit', '2023', '2026-05-17 13:02:19'),
(19, 46, 'National Championship 46', 'Football', 'Under 18', 'Male', '50kg', 'National', '7 Years', 'Achievement 46', 'Fit', '2024', '2026-05-17 13:02:19'),
(20, 47, 'National Championship 47', 'Swimming', 'Senior', 'Female', '60kg', 'International', '8 Years', 'Achievement 47', 'Fit', '2025', '2026-05-17 13:02:19'),
(21, 48, 'National Championship 48', 'Cricket', 'Under 14', 'Male', '70kg', 'District', '1 Years', 'Achievement 48', 'Fit', '2020', '2026-05-17 13:02:19'),
(22, 49, 'National Championship 49', 'Badminton', 'Under 16', 'Female', '80kg', 'State', '2 Years', 'Achievement 49', 'Fit', '2021', '2026-05-17 13:02:19'),
(23, 50, 'National Championship 50', '100m Sprint', 'Under 18', 'Male', '40kg', 'National', '3 Years', 'Achievement 50', 'Fit', '2022', '2026-05-17 13:02:19'),
(24, 51, 'National Championship 51', 'Football', 'Senior', 'Female', '50kg', 'International', '4 Years', 'Achievement 51', 'Fit', '2023', '2026-05-17 13:02:19'),
(25, 52, 'National Championship 52', 'Swimming', 'Under 14', 'Male', '60kg', 'District', '5 Years', 'Achievement 52', 'Fit', '2024', '2026-05-17 13:02:19'),
(26, 53, 'National Championship 53', 'Cricket', 'Under 16', 'Female', '70kg', 'State', '6 Years', 'Achievement 53', 'Fit', '2025', '2026-05-17 13:02:19'),
(27, 54, 'National Championship 54', 'Badminton', 'Under 18', 'Male', '80kg', 'National', '7 Years', 'Achievement 54', 'Fit', '2020', '2026-05-17 13:02:19'),
(28, 55, 'National Championship 55', '100m Sprint', 'Senior', 'Female', '40kg', 'International', '8 Years', 'Achievement 55', 'Fit', '2021', '2026-05-17 13:02:19'),
(29, 56, 'National Championship 56', 'Football', 'Under 14', 'Male', '50kg', 'District', '1 Years', 'Achievement 56', 'Fit', '2022', '2026-05-17 13:02:19'),
(30, 57, 'National Championship 57', 'Swimming', 'Under 16', 'Female', '60kg', 'State', '2 Years', 'Achievement 57', 'Fit', '2023', '2026-05-17 13:02:19'),
(31, 58, 'National Championship 58', 'Cricket', 'Under 18', 'Male', '70kg', 'National', '3 Years', 'Achievement 58', 'Fit', '2024', '2026-05-17 13:02:19'),
(32, 59, 'National Championship 59', 'Badminton', 'Senior', 'Female', '80kg', 'International', '4 Years', 'Achievement 59', 'Fit', '2025', '2026-05-17 13:02:19'),
(33, 60, 'National Championship 60', '100m Sprint', 'Under 14', 'Male', '40kg', 'District', '5 Years', 'Achievement 60', 'Fit', '2020', '2026-05-17 13:02:19'),
(34, 61, 'National Championship 61', 'Football', 'Under 16', 'Female', '50kg', 'State', '6 Years', 'Achievement 61', 'Fit', '2021', '2026-05-17 13:02:19'),
(35, 62, 'National Championship 62', 'Swimming', 'Under 18', 'Male', '60kg', 'National', '7 Years', 'Achievement 62', 'Fit', '2022', '2026-05-17 13:02:19'),
(36, 63, 'National Championship 63', 'Cricket', 'Senior', 'Female', '70kg', 'International', '8 Years', 'Achievement 63', 'Fit', '2023', '2026-05-17 13:02:19'),
(37, 64, 'National Championship 64', 'Badminton', 'Under 14', 'Male', '80kg', 'District', '1 Years', 'Achievement 64', 'Fit', '2024', '2026-05-17 13:02:19'),
(38, 65, 'National Championship 65', '100m Sprint', 'Under 16', 'Female', '40kg', 'State', '2 Years', 'Achievement 65', 'Fit', '2025', '2026-05-17 13:02:19'),
(39, 66, 'National Championship 66', 'Football', 'Under 18', 'Male', '50kg', 'National', '3 Years', 'Achievement 66', 'Fit', '2020', '2026-05-17 13:02:19'),
(40, 67, 'National Championship 67', 'Swimming', 'Senior', 'Female', '60kg', 'International', '4 Years', 'Achievement 67', 'Fit', '2021', '2026-05-17 13:02:19'),
(41, 68, 'National Championship 68', 'Cricket', 'Under 14', 'Male', '70kg', 'District', '5 Years', 'Achievement 68', 'Fit', '2022', '2026-05-17 13:02:19'),
(42, 69, 'National Championship 69', 'Badminton', 'Under 16', 'Female', '80kg', 'State', '6 Years', 'Achievement 69', 'Fit', '2023', '2026-05-17 13:02:19'),
(43, 70, 'National Championship 70', '100m Sprint', 'Under 18', 'Male', '40kg', 'National', '7 Years', 'Achievement 70', 'Fit', '2024', '2026-05-17 13:02:19'),
(44, 71, 'National Championship 71', 'Football', 'Senior', 'Female', '50kg', 'International', '8 Years', 'Achievement 71', 'Fit', '2025', '2026-05-17 13:02:19'),
(45, 72, 'National Championship 72', 'Swimming', 'Under 14', 'Male', '60kg', 'District', '1 Years', 'Achievement 72', 'Fit', '2020', '2026-05-17 13:02:19'),
(46, 73, 'National Championship 73', 'Cricket', 'Under 16', 'Female', '70kg', 'State', '2 Years', 'Achievement 73', 'Fit', '2021', '2026-05-17 13:02:19'),
(47, 74, 'National Championship 74', 'Badminton', 'Under 18', 'Male', '80kg', 'National', '3 Years', 'Achievement 74', 'Fit', '2022', '2026-05-17 13:02:19'),
(48, 75, 'National Championship 75', '100m Sprint', 'Senior', 'Female', '40kg', 'International', '4 Years', 'Achievement 75', 'Fit', '2023', '2026-05-17 13:02:19'),
(49, 76, 'National Championship 76', 'Football', 'Under 14', 'Male', '50kg', 'District', '5 Years', 'Achievement 76', 'Fit', '2024', '2026-05-17 13:02:19'),
(50, 77, 'National Championship 77', 'Swimming', 'Under 16', 'Female', '60kg', 'State', '6 Years', 'Achievement 77', 'Fit', '2025', '2026-05-17 13:02:19'),
(51, 78, 'National Championship 78', 'Cricket', 'Under 18', 'Male', '70kg', 'National', '7 Years', 'Achievement 78', 'Fit', '2020', '2026-05-17 13:02:19'),
(52, 79, 'National Championship 79', 'Badminton', 'Senior', 'Female', '80kg', 'International', '8 Years', 'Achievement 79', 'Fit', '2021', '2026-05-17 13:02:19'),
(53, 80, 'National Championship 80', '100m Sprint', 'Under 14', 'Male', '40kg', 'District', '1 Years', 'Achievement 80', 'Fit', '2022', '2026-05-17 13:02:19'),
(54, 81, 'National Championship 81', 'Football', 'Under 16', 'Female', '50kg', 'State', '2 Years', 'Achievement 81', 'Fit', '2023', '2026-05-17 13:02:19'),
(55, 82, 'National Championship 82', 'Swimming', 'Under 18', 'Male', '60kg', 'National', '3 Years', 'Achievement 82', 'Fit', '2024', '2026-05-17 13:02:19'),
(56, 83, 'National Championship 83', 'Cricket', 'Senior', 'Female', '70kg', 'International', '4 Years', 'Achievement 83', 'Fit', '2025', '2026-05-17 13:02:19'),
(57, 84, 'National Championship 84', 'Badminton', 'Under 14', 'Male', '80kg', 'District', '5 Years', 'Achievement 84', 'Fit', '2020', '2026-05-17 13:02:19'),
(58, 85, 'National Championship 85', '100m Sprint', 'Under 16', 'Female', '40kg', 'State', '6 Years', 'Achievement 85', 'Fit', '2021', '2026-05-17 13:02:19'),
(59, 86, 'National Championship 86', 'Football', 'Under 18', 'Male', '50kg', 'National', '7 Years', 'Achievement 86', 'Fit', '2022', '2026-05-17 13:02:19'),
(60, 87, 'National Championship 87', 'Swimming', 'Senior', 'Female', '60kg', 'International', '8 Years', 'Achievement 87', 'Fit', '2023', '2026-05-17 13:02:19'),
(61, 88, 'National Championship 88', 'Cricket', 'Under 14', 'Male', '70kg', 'District', '1 Years', 'Achievement 88', 'Fit', '2024', '2026-05-17 13:02:19'),
(62, 89, 'National Championship 89', 'Badminton', 'Under 16', 'Female', '80kg', 'State', '2 Years', 'Achievement 89', 'Fit', '2025', '2026-05-17 13:02:19'),
(63, 104, 'foot ball', 'nike', 'Under 10', NULL, '45kg', '', 'First Time', 'x foot baller', 'good medical', '2026', '2026-05-17 19:44:56'),
(64, 105, 'foot ball', 'nike', 'Senior', NULL, '58kg', 'District', '1-2 Competitions', 'fdngljfdng international', 'vvjbdsvjnds', '2025', '2026-05-17 20:14:29'),
(65, 106, 'ohijtoi', 'nike', 'Senior', NULL, '45kg', 'District', '1-2 Competitions', 'x foot baller', NULL, '2026', '2026-05-17 20:34:07'),
(66, 108, 'aa', 'aa', 'Senior', NULL, '22kg', '', 'First Time', NULL, NULL, '2026', '2026-05-17 21:47:01'),
(67, 110, 'Foot ball', 'F-lake event', 'Under 17', NULL, '45kg', 'District', 'First Time', NULL, 'medical condition good', '2024', '2026-05-18 08:47:07'),
(68, 112, 'foot ball', 'foot ball turna ment', 'Under 17', NULL, '74kg', 'International', '1-2 Competitions', NULL, NULL, '2005', '2026-05-22 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `aadhaar_file` varchar(255) DEFAULT NULL,
  `birth_certificate` varchar(255) DEFAULT NULL,
  `passport_photo` varchar(255) DEFAULT NULL,
  `medical_certificate` varchar(255) DEFAULT NULL,
  `parent_consent_file` varchar(255) DEFAULT NULL,
  `club_certificate_file` varchar(255) DEFAULT NULL,
  `achievement_certificate_file` varchar(255) DEFAULT NULL,
  `photo_id_proof` varchar(255) DEFAULT NULL,
  `additional_document` varchar(255) DEFAULT NULL,
  `upload_status` enum('Pending','Verified','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `athlete_id`, `aadhaar_file`, `birth_certificate`, `passport_photo`, `medical_certificate`, `parent_consent_file`, `club_certificate_file`, `achievement_certificate_file`, `photo_id_proof`, `additional_document`, `upload_status`, `created_at`) VALUES
(16, 40, 'aadhaar_40.pdf', 'birth_40.pdf', 'passport_40.jpg', 'medical_40.pdf', 'consent_40.pdf', 'club_40.pdf', 'achievement_40.pdf', 'photoid_40.pdf', 'additional_40.pdf', '', '2026-05-17 13:02:19'),
(17, 41, 'aadhaar_41.pdf', 'birth_41.pdf', 'passport_41.jpg', 'medical_41.pdf', 'consent_41.pdf', 'club_41.pdf', 'achievement_41.pdf', 'photoid_41.pdf', 'additional_41.pdf', 'Verified', '2026-05-17 13:02:19'),
(18, 42, 'aadhaar_42.pdf', 'birth_42.pdf', 'passport_42.jpg', 'medical_42.pdf', 'consent_42.pdf', 'club_42.pdf', 'achievement_42.pdf', 'photoid_42.pdf', 'additional_42.pdf', 'Pending', '2026-05-17 13:02:19'),
(19, 43, 'aadhaar_43.pdf', 'birth_43.pdf', 'passport_43.jpg', 'medical_43.pdf', 'consent_43.pdf', 'club_43.pdf', 'achievement_43.pdf', 'photoid_43.pdf', 'additional_43.pdf', '', '2026-05-17 13:02:19'),
(20, 44, 'aadhaar_44.pdf', 'birth_44.pdf', 'passport_44.jpg', 'medical_44.pdf', 'consent_44.pdf', 'club_44.pdf', 'achievement_44.pdf', 'photoid_44.pdf', 'additional_44.pdf', 'Verified', '2026-05-17 13:02:19'),
(21, 45, 'aadhaar_45.pdf', 'birth_45.pdf', 'passport_45.jpg', 'medical_45.pdf', 'consent_45.pdf', 'club_45.pdf', 'achievement_45.pdf', 'photoid_45.pdf', 'additional_45.pdf', 'Pending', '2026-05-17 13:02:19'),
(22, 46, 'aadhaar_46.pdf', 'birth_46.pdf', 'passport_46.jpg', 'medical_46.pdf', 'consent_46.pdf', 'club_46.pdf', 'achievement_46.pdf', 'photoid_46.pdf', 'additional_46.pdf', '', '2026-05-17 13:02:19'),
(23, 47, 'aadhaar_47.pdf', 'birth_47.pdf', 'passport_47.jpg', 'medical_47.pdf', 'consent_47.pdf', 'club_47.pdf', 'achievement_47.pdf', 'photoid_47.pdf', 'additional_47.pdf', 'Verified', '2026-05-17 13:02:19'),
(24, 48, 'aadhaar_48.pdf', 'birth_48.pdf', 'passport_48.jpg', 'medical_48.pdf', 'consent_48.pdf', 'club_48.pdf', 'achievement_48.pdf', 'photoid_48.pdf', 'additional_48.pdf', 'Pending', '2026-05-17 13:02:19'),
(25, 49, 'aadhaar_49.pdf', 'birth_49.pdf', 'passport_49.jpg', 'medical_49.pdf', 'consent_49.pdf', 'club_49.pdf', 'achievement_49.pdf', 'photoid_49.pdf', 'additional_49.pdf', '', '2026-05-17 13:02:19'),
(26, 50, 'aadhaar_50.pdf', 'birth_50.pdf', 'passport_50.jpg', 'medical_50.pdf', 'consent_50.pdf', 'club_50.pdf', 'achievement_50.pdf', 'photoid_50.pdf', 'additional_50.pdf', 'Verified', '2026-05-17 13:02:19'),
(27, 51, 'aadhaar_51.pdf', 'birth_51.pdf', 'passport_51.jpg', 'medical_51.pdf', 'consent_51.pdf', 'club_51.pdf', 'achievement_51.pdf', 'photoid_51.pdf', 'additional_51.pdf', 'Pending', '2026-05-17 13:02:19'),
(28, 52, 'aadhaar_52.pdf', 'birth_52.pdf', 'passport_52.jpg', 'medical_52.pdf', 'consent_52.pdf', 'club_52.pdf', 'achievement_52.pdf', 'photoid_52.pdf', 'additional_52.pdf', '', '2026-05-17 13:02:19'),
(29, 53, 'aadhaar_53.pdf', 'birth_53.pdf', 'passport_53.jpg', 'medical_53.pdf', 'consent_53.pdf', 'club_53.pdf', 'achievement_53.pdf', 'photoid_53.pdf', 'additional_53.pdf', 'Verified', '2026-05-17 13:02:19'),
(30, 54, 'aadhaar_54.pdf', 'birth_54.pdf', 'passport_54.jpg', 'medical_54.pdf', 'consent_54.pdf', 'club_54.pdf', 'achievement_54.pdf', 'photoid_54.pdf', 'additional_54.pdf', 'Pending', '2026-05-17 13:02:19'),
(31, 55, 'aadhaar_55.pdf', 'birth_55.pdf', 'passport_55.jpg', 'medical_55.pdf', 'consent_55.pdf', 'club_55.pdf', 'achievement_55.pdf', 'photoid_55.pdf', 'additional_55.pdf', '', '2026-05-17 13:02:19'),
(32, 56, 'aadhaar_56.pdf', 'birth_56.pdf', 'passport_56.jpg', 'medical_56.pdf', 'consent_56.pdf', 'club_56.pdf', 'achievement_56.pdf', 'photoid_56.pdf', 'additional_56.pdf', 'Verified', '2026-05-17 13:02:19'),
(33, 57, 'aadhaar_57.pdf', 'birth_57.pdf', 'passport_57.jpg', 'medical_57.pdf', 'consent_57.pdf', 'club_57.pdf', 'achievement_57.pdf', 'photoid_57.pdf', 'additional_57.pdf', 'Pending', '2026-05-17 13:02:19'),
(34, 58, 'aadhaar_58.pdf', 'birth_58.pdf', 'passport_58.jpg', 'medical_58.pdf', 'consent_58.pdf', 'club_58.pdf', 'achievement_58.pdf', 'photoid_58.pdf', 'additional_58.pdf', '', '2026-05-17 13:02:19'),
(35, 59, 'aadhaar_59.pdf', 'birth_59.pdf', 'passport_59.jpg', 'medical_59.pdf', 'consent_59.pdf', 'club_59.pdf', 'achievement_59.pdf', 'photoid_59.pdf', 'additional_59.pdf', 'Verified', '2026-05-17 13:02:19'),
(36, 60, 'aadhaar_60.pdf', 'birth_60.pdf', 'passport_60.jpg', 'medical_60.pdf', 'consent_60.pdf', 'club_60.pdf', 'achievement_60.pdf', 'photoid_60.pdf', 'additional_60.pdf', 'Pending', '2026-05-17 13:02:19'),
(37, 61, 'aadhaar_61.pdf', 'birth_61.pdf', 'passport_61.jpg', 'medical_61.pdf', 'consent_61.pdf', 'club_61.pdf', 'achievement_61.pdf', 'photoid_61.pdf', 'additional_61.pdf', '', '2026-05-17 13:02:19'),
(38, 62, 'aadhaar_62.pdf', 'birth_62.pdf', 'passport_62.jpg', 'medical_62.pdf', 'consent_62.pdf', 'club_62.pdf', 'achievement_62.pdf', 'photoid_62.pdf', 'additional_62.pdf', 'Verified', '2026-05-17 13:02:19'),
(39, 63, 'aadhaar_63.pdf', 'birth_63.pdf', 'passport_63.jpg', 'medical_63.pdf', 'consent_63.pdf', 'club_63.pdf', 'achievement_63.pdf', 'photoid_63.pdf', 'additional_63.pdf', 'Pending', '2026-05-17 13:02:19'),
(40, 64, 'aadhaar_64.pdf', 'birth_64.pdf', 'passport_64.jpg', 'medical_64.pdf', 'consent_64.pdf', 'club_64.pdf', 'achievement_64.pdf', 'photoid_64.pdf', 'additional_64.pdf', '', '2026-05-17 13:02:19'),
(41, 65, 'aadhaar_65.pdf', 'birth_65.pdf', 'passport_65.jpg', 'medical_65.pdf', 'consent_65.pdf', 'club_65.pdf', 'achievement_65.pdf', 'photoid_65.pdf', 'additional_65.pdf', 'Verified', '2026-05-17 13:02:19'),
(42, 66, 'aadhaar_66.pdf', 'birth_66.pdf', 'passport_66.jpg', 'medical_66.pdf', 'consent_66.pdf', 'club_66.pdf', 'achievement_66.pdf', 'photoid_66.pdf', 'additional_66.pdf', 'Pending', '2026-05-17 13:02:19'),
(43, 67, 'aadhaar_67.pdf', 'birth_67.pdf', 'passport_67.jpg', 'medical_67.pdf', 'consent_67.pdf', 'club_67.pdf', 'achievement_67.pdf', 'photoid_67.pdf', 'additional_67.pdf', '', '2026-05-17 13:02:19'),
(44, 68, 'aadhaar_68.pdf', 'birth_68.pdf', 'passport_68.jpg', 'medical_68.pdf', 'consent_68.pdf', 'club_68.pdf', 'achievement_68.pdf', 'photoid_68.pdf', 'additional_68.pdf', 'Verified', '2026-05-17 13:02:19'),
(45, 69, 'aadhaar_69.pdf', 'birth_69.pdf', 'passport_69.jpg', 'medical_69.pdf', 'consent_69.pdf', 'club_69.pdf', 'achievement_69.pdf', 'photoid_69.pdf', 'additional_69.pdf', 'Pending', '2026-05-17 13:02:19'),
(46, 70, 'aadhaar_70.pdf', 'birth_70.pdf', 'passport_70.jpg', 'medical_70.pdf', 'consent_70.pdf', 'club_70.pdf', 'achievement_70.pdf', 'photoid_70.pdf', 'additional_70.pdf', '', '2026-05-17 13:02:19'),
(47, 71, 'aadhaar_71.pdf', 'birth_71.pdf', 'passport_71.jpg', 'medical_71.pdf', 'consent_71.pdf', 'club_71.pdf', 'achievement_71.pdf', 'photoid_71.pdf', 'additional_71.pdf', 'Verified', '2026-05-17 13:02:19'),
(48, 72, 'aadhaar_72.pdf', 'birth_72.pdf', 'passport_72.jpg', 'medical_72.pdf', 'consent_72.pdf', 'club_72.pdf', 'achievement_72.pdf', 'photoid_72.pdf', 'additional_72.pdf', 'Pending', '2026-05-17 13:02:19'),
(49, 73, 'aadhaar_73.pdf', 'birth_73.pdf', 'passport_73.jpg', 'medical_73.pdf', 'consent_73.pdf', 'club_73.pdf', 'achievement_73.pdf', 'photoid_73.pdf', 'additional_73.pdf', '', '2026-05-17 13:02:19'),
(50, 74, 'aadhaar_74.pdf', 'birth_74.pdf', 'passport_74.jpg', 'medical_74.pdf', 'consent_74.pdf', 'club_74.pdf', 'achievement_74.pdf', 'photoid_74.pdf', 'additional_74.pdf', 'Verified', '2026-05-17 13:02:19'),
(51, 75, 'aadhaar_75.pdf', 'birth_75.pdf', 'passport_75.jpg', 'medical_75.pdf', 'consent_75.pdf', 'club_75.pdf', 'achievement_75.pdf', 'photoid_75.pdf', 'additional_75.pdf', 'Pending', '2026-05-17 13:02:19'),
(52, 76, 'aadhaar_76.pdf', 'birth_76.pdf', 'passport_76.jpg', 'medical_76.pdf', 'consent_76.pdf', 'club_76.pdf', 'achievement_76.pdf', 'photoid_76.pdf', 'additional_76.pdf', '', '2026-05-17 13:02:19'),
(53, 77, 'aadhaar_77.pdf', 'birth_77.pdf', 'passport_77.jpg', 'medical_77.pdf', 'consent_77.pdf', 'club_77.pdf', 'achievement_77.pdf', 'photoid_77.pdf', 'additional_77.pdf', 'Verified', '2026-05-17 13:02:19'),
(54, 78, 'aadhaar_78.pdf', 'birth_78.pdf', 'passport_78.jpg', 'medical_78.pdf', 'consent_78.pdf', 'club_78.pdf', 'achievement_78.pdf', 'photoid_78.pdf', 'additional_78.pdf', 'Pending', '2026-05-17 13:02:19'),
(55, 79, 'aadhaar_79.pdf', 'birth_79.pdf', 'passport_79.jpg', 'medical_79.pdf', 'consent_79.pdf', 'club_79.pdf', 'achievement_79.pdf', 'photoid_79.pdf', 'additional_79.pdf', '', '2026-05-17 13:02:19'),
(56, 80, 'aadhaar_80.pdf', 'birth_80.pdf', 'passport_80.jpg', 'medical_80.pdf', 'consent_80.pdf', 'club_80.pdf', 'achievement_80.pdf', 'photoid_80.pdf', 'additional_80.pdf', 'Verified', '2026-05-17 13:02:19'),
(57, 81, 'aadhaar_81.pdf', 'birth_81.pdf', 'passport_81.jpg', 'medical_81.pdf', 'consent_81.pdf', 'club_81.pdf', 'achievement_81.pdf', 'photoid_81.pdf', 'additional_81.pdf', 'Pending', '2026-05-17 13:02:19'),
(58, 82, 'aadhaar_82.pdf', 'birth_82.pdf', 'passport_82.jpg', 'medical_82.pdf', 'consent_82.pdf', 'club_82.pdf', 'achievement_82.pdf', 'photoid_82.pdf', 'additional_82.pdf', '', '2026-05-17 13:02:19'),
(59, 83, 'aadhaar_83.pdf', 'birth_83.pdf', 'passport_83.jpg', 'medical_83.pdf', 'consent_83.pdf', 'club_83.pdf', 'achievement_83.pdf', 'photoid_83.pdf', 'additional_83.pdf', 'Verified', '2026-05-17 13:02:19'),
(60, 84, 'aadhaar_84.pdf', 'birth_84.pdf', 'passport_84.jpg', 'medical_84.pdf', 'consent_84.pdf', 'club_84.pdf', 'achievement_84.pdf', 'photoid_84.pdf', 'additional_84.pdf', 'Pending', '2026-05-17 13:02:19'),
(61, 85, 'aadhaar_85.pdf', 'birth_85.pdf', 'passport_85.jpg', 'medical_85.pdf', 'consent_85.pdf', 'club_85.pdf', 'achievement_85.pdf', 'photoid_85.pdf', 'additional_85.pdf', '', '2026-05-17 13:02:19'),
(62, 86, 'aadhaar_86.pdf', 'birth_86.pdf', 'passport_86.jpg', 'medical_86.pdf', 'consent_86.pdf', 'club_86.pdf', 'achievement_86.pdf', 'photoid_86.pdf', 'additional_86.pdf', 'Verified', '2026-05-17 13:02:19'),
(63, 87, 'aadhaar_87.pdf', 'birth_87.pdf', 'passport_87.jpg', 'medical_87.pdf', 'consent_87.pdf', 'club_87.pdf', 'achievement_87.pdf', 'photoid_87.pdf', 'additional_87.pdf', 'Pending', '2026-05-17 13:02:19'),
(64, 88, 'aadhaar_88.pdf', 'birth_88.pdf', 'passport_88.jpg', 'medical_88.pdf', 'consent_88.pdf', 'club_88.pdf', 'achievement_88.pdf', 'photoid_88.pdf', 'additional_88.pdf', '', '2026-05-17 13:02:19'),
(65, 89, 'aadhaar_89.pdf', 'birth_89.pdf', 'passport_89.jpg', 'medical_89.pdf', 'consent_89.pdf', 'club_89.pdf', 'achievement_89.pdf', 'photoid_89.pdf', 'additional_89.pdf', 'Verified', '2026-05-17 13:02:19'),
(66, 104, '1779047095_2177.pdf', '1779047095_9512.pdf', '1779046546_118dea7f.jpg', '1779047095_5386.pdf', '1779047095_8848.pdf', '1779047095_9522.pdf', '1779047095_9466.pdf', '1779047095_6129.pdf', '1779047095_5436.pdf', '', '2026-05-17 19:44:56'),
(67, 105, '1779048869_8117.pdf', '1779048869_8510.pdf', '1779048705_682ef6a3.jpg', '1779048869_9461.pdf', '1779048869_9121.pdf', '1779048869_7836.pdf', '1779048869_9380.pdf', '1779048869_9274.pdf', '1779048869_4827.pdf', '', '2026-05-17 20:14:29'),
(68, 106, '1779050047_3852.pdf', '1779050047_9652.pdf', '1779049992_d27f30ec.jpg', '1779050047_2639.pdf', '1779050047_2160.pdf', '1779050047_7254.pdf', NULL, '1779050047_2293.pdf', NULL, '', '2026-05-17 20:34:07'),
(69, 108, '1779054420_3929.pdf', '1779054420_4921.pdf', '1779054325_ee653bc7.jpg', '1779054420_2768.pdf', '1779054420_9498.pdf', '1779054420_2729.pdf', NULL, '1779054420_8767.pdf', NULL, '', '2026-05-17 21:47:01'),
(70, 110, '1779094027_2998.pdf', '1779094027_5859.pdf', '1779093900_9632796f.jpg', '1779094027_2568.pdf', '1779094027_6923.pdf', '1779094027_1891.pdf', NULL, '1779094027_7693.pdf', '1779094027_9852.pdf', 'Verified', '2026-05-18 08:47:08'),
(71, 112, '1779449386_8164.pdf', '1779449386_5711.pdf', '1779449319_c3ed5538.jpg', '1779449386_5808.pdf', '1779449386_4537.pdf', '1779449386_1006.pdf', '1779449386_8440.pdf', '1779449386_4008.pdf', NULL, '', '2026-05-22 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `document_verifications`
--

CREATE TABLE `document_verifications` (
  `id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `verified_by` int(11) NOT NULL,
  `status` enum('Verified','Rejected') NOT NULL,
  `rejection_reason` text DEFAULT NULL,
  `verified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_logs`
--

CREATE TABLE `email_logs` (
  `log_id` int(11) NOT NULL,
  `recipient_email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guardians`
--

CREATE TABLE `guardians` (
  `guardian_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `guardian_mobile` varchar(15) DEFAULT NULL,
  `guardian_email` varchar(150) DEFAULT NULL,
  `caretaker_name` varchar(150) DEFAULT NULL,
  `caretaker_mobile` varchar(20) DEFAULT NULL,
  `emergency_contact` varchar(15) DEFAULT NULL,
  `relation_with_athlete` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guardians`
--

INSERT INTO `guardians` (`guardian_id`, `athlete_id`, `father_name`, `mother_name`, `guardian_name`, `relationship`, `guardian_mobile`, `guardian_email`, `caretaker_name`, `caretaker_mobile`, `emergency_contact`, `relation_with_athlete`, `created_at`) VALUES
(13, 40, 'Father 40', 'Mother 40', 'Guardian 40', 'Father', '8000000040', 'guardian40@gmail.com', 'Caretaker 40', '8111100040', '9999900040', 'Relative', '2026-05-17 13:02:19'),
(14, 41, 'Father 41', 'Mother 41', 'Guardian 41', 'Mother', '8000000041', 'guardian41@gmail.com', 'Caretaker 41', '8111100041', '9999900041', 'Guardian', '2026-05-17 13:02:19'),
(15, 42, 'Father 42', 'Mother 42', 'Guardian 42', 'Uncle', '8000000042', 'guardian42@gmail.com', 'Caretaker 42', '8111100042', '9999900042', 'Parent', '2026-05-17 13:02:19'),
(16, 43, 'Father 43', 'Mother 43', 'Guardian 43', 'Brother', '8000000043', 'guardian43@gmail.com', 'Caretaker 43', '8111100043', '9999900043', 'Relative', '2026-05-17 13:02:19'),
(17, 44, 'Father 44', 'Mother 44', 'Guardian 44', 'Father', '8000000044', 'guardian44@gmail.com', 'Caretaker 44', '8111100044', '9999900044', 'Guardian', '2026-05-17 13:02:19'),
(18, 45, 'Father 45', 'Mother 45', 'Guardian 45', 'Mother', '8000000045', 'guardian45@gmail.com', 'Caretaker 45', '8111100045', '9999900045', 'Parent', '2026-05-17 13:02:19'),
(19, 46, 'Father 46', 'Mother 46', 'Guardian 46', 'Uncle', '8000000046', 'guardian46@gmail.com', 'Caretaker 46', '8111100046', '9999900046', 'Relative', '2026-05-17 13:02:19'),
(20, 47, 'Father 47', 'Mother 47', 'Guardian 47', 'Brother', '8000000047', 'guardian47@gmail.com', 'Caretaker 47', '8111100047', '9999900047', 'Guardian', '2026-05-17 13:02:19'),
(21, 48, 'Father 48', 'Mother 48', 'Guardian 48', 'Father', '8000000048', 'guardian48@gmail.com', 'Caretaker 48', '8111100048', '9999900048', 'Parent', '2026-05-17 13:02:19'),
(22, 49, 'Father 49', 'Mother 49', 'Guardian 49', 'Mother', '8000000049', 'guardian49@gmail.com', 'Caretaker 49', '8111100049', '9999900049', 'Relative', '2026-05-17 13:02:19'),
(23, 50, 'Father 50', 'Mother 50', 'Guardian 50', 'Uncle', '8000000050', 'guardian50@gmail.com', 'Caretaker 50', '8111100050', '9999900050', 'Guardian', '2026-05-17 13:02:19'),
(24, 51, 'Father 51', 'Mother 51', 'Guardian 51', 'Brother', '8000000051', 'guardian51@gmail.com', 'Caretaker 51', '8111100051', '9999900051', 'Parent', '2026-05-17 13:02:19'),
(25, 52, 'Father 52', 'Mother 52', 'Guardian 52', 'Father', '8000000052', 'guardian52@gmail.com', 'Caretaker 52', '8111100052', '9999900052', 'Relative', '2026-05-17 13:02:19'),
(26, 53, 'Father 53', 'Mother 53', 'Guardian 53', 'Mother', '8000000053', 'guardian53@gmail.com', 'Caretaker 53', '8111100053', '9999900053', 'Guardian', '2026-05-17 13:02:19'),
(27, 54, 'Father 54', 'Mother 54', 'Guardian 54', 'Uncle', '8000000054', 'guardian54@gmail.com', 'Caretaker 54', '8111100054', '9999900054', 'Parent', '2026-05-17 13:02:19'),
(28, 55, 'Father 55', 'Mother 55', 'Guardian 55', 'Brother', '8000000055', 'guardian55@gmail.com', 'Caretaker 55', '8111100055', '9999900055', 'Relative', '2026-05-17 13:02:19'),
(29, 56, 'Father 56', 'Mother 56', 'Guardian 56', 'Father', '8000000056', 'guardian56@gmail.com', 'Caretaker 56', '8111100056', '9999900056', 'Guardian', '2026-05-17 13:02:19'),
(30, 57, 'Father 57', 'Mother 57', 'Guardian 57', 'Mother', '8000000057', 'guardian57@gmail.com', 'Caretaker 57', '8111100057', '9999900057', 'Parent', '2026-05-17 13:02:19'),
(31, 58, 'Father 58', 'Mother 58', 'Guardian 58', 'Uncle', '8000000058', 'guardian58@gmail.com', 'Caretaker 58', '8111100058', '9999900058', 'Relative', '2026-05-17 13:02:19'),
(32, 59, 'Father 59', 'Mother 59', 'Guardian 59', 'Brother', '8000000059', 'guardian59@gmail.com', 'Caretaker 59', '8111100059', '9999900059', 'Guardian', '2026-05-17 13:02:19'),
(33, 60, 'Father 60', 'Mother 60', 'Guardian 60', 'Father', '8000000060', 'guardian60@gmail.com', 'Caretaker 60', '8111100060', '9999900060', 'Parent', '2026-05-17 13:02:19'),
(34, 61, 'Father 61', 'Mother 61', 'Guardian 61', 'Mother', '8000000061', 'guardian61@gmail.com', 'Caretaker 61', '8111100061', '9999900061', 'Relative', '2026-05-17 13:02:19'),
(35, 62, 'Father 62', 'Mother 62', 'Guardian 62', 'Uncle', '8000000062', 'guardian62@gmail.com', 'Caretaker 62', '8111100062', '9999900062', 'Guardian', '2026-05-17 13:02:19'),
(36, 63, 'Father 63', 'Mother 63', 'Guardian 63', 'Brother', '8000000063', 'guardian63@gmail.com', 'Caretaker 63', '8111100063', '9999900063', 'Parent', '2026-05-17 13:02:19'),
(37, 64, 'Father 64', 'Mother 64', 'Guardian 64', 'Father', '8000000064', 'guardian64@gmail.com', 'Caretaker 64', '8111100064', '9999900064', 'Relative', '2026-05-17 13:02:19'),
(38, 65, 'Father 65', 'Mother 65', 'Guardian 65', 'Mother', '8000000065', 'guardian65@gmail.com', 'Caretaker 65', '8111100065', '9999900065', 'Guardian', '2026-05-17 13:02:19'),
(39, 66, 'Father 66', 'Mother 66', 'Guardian 66', 'Uncle', '8000000066', 'guardian66@gmail.com', 'Caretaker 66', '8111100066', '9999900066', 'Parent', '2026-05-17 13:02:19'),
(40, 67, 'Father 67', 'Mother 67', 'Guardian 67', 'Brother', '8000000067', 'guardian67@gmail.com', 'Caretaker 67', '8111100067', '9999900067', 'Relative', '2026-05-17 13:02:19'),
(41, 68, 'Father 68', 'Mother 68', 'Guardian 68', 'Father', '8000000068', 'guardian68@gmail.com', 'Caretaker 68', '8111100068', '9999900068', 'Guardian', '2026-05-17 13:02:19'),
(42, 69, 'Father 69', 'Mother 69', 'Guardian 69', 'Mother', '8000000069', 'guardian69@gmail.com', 'Caretaker 69', '8111100069', '9999900069', 'Parent', '2026-05-17 13:02:19'),
(43, 70, 'Father 70', 'Mother 70', 'Guardian 70', 'Uncle', '8000000070', 'guardian70@gmail.com', 'Caretaker 70', '8111100070', '9999900070', 'Relative', '2026-05-17 13:02:19'),
(44, 71, 'Father 71', 'Mother 71', 'Guardian 71', 'Brother', '8000000071', 'guardian71@gmail.com', 'Caretaker 71', '8111100071', '9999900071', 'Guardian', '2026-05-17 13:02:19'),
(45, 72, 'Father 72', 'Mother 72', 'Guardian 72', 'Father', '8000000072', 'guardian72@gmail.com', 'Caretaker 72', '8111100072', '9999900072', 'Parent', '2026-05-17 13:02:19'),
(46, 73, 'Father 73', 'Mother 73', 'Guardian 73', 'Mother', '8000000073', 'guardian73@gmail.com', 'Caretaker 73', '8111100073', '9999900073', 'Relative', '2026-05-17 13:02:19'),
(47, 74, 'Father 74', 'Mother 74', 'Guardian 74', 'Uncle', '8000000074', 'guardian74@gmail.com', 'Caretaker 74', '8111100074', '9999900074', 'Guardian', '2026-05-17 13:02:19'),
(48, 75, 'Father 75', 'Mother 75', 'Guardian 75', 'Brother', '8000000075', 'guardian75@gmail.com', 'Caretaker 75', '8111100075', '9999900075', 'Parent', '2026-05-17 13:02:19'),
(49, 76, 'Father 76', 'Mother 76', 'Guardian 76', 'Father', '8000000076', 'guardian76@gmail.com', 'Caretaker 76', '8111100076', '9999900076', 'Relative', '2026-05-17 13:02:19'),
(50, 77, 'Father 77', 'Mother 77', 'Guardian 77', 'Mother', '8000000077', 'guardian77@gmail.com', 'Caretaker 77', '8111100077', '9999900077', 'Guardian', '2026-05-17 13:02:19'),
(51, 78, 'Father 78', 'Mother 78', 'Guardian 78', 'Uncle', '8000000078', 'guardian78@gmail.com', 'Caretaker 78', '8111100078', '9999900078', 'Parent', '2026-05-17 13:02:19'),
(52, 79, 'Father 79', 'Mother 79', 'Guardian 79', 'Brother', '8000000079', 'guardian79@gmail.com', 'Caretaker 79', '8111100079', '9999900079', 'Relative', '2026-05-17 13:02:19'),
(53, 80, 'Father 80', 'Mother 80', 'Guardian 80', 'Father', '8000000080', 'guardian80@gmail.com', 'Caretaker 80', '8111100080', '9999900080', 'Guardian', '2026-05-17 13:02:19'),
(54, 81, 'Father 81', 'Mother 81', 'Guardian 81', 'Mother', '8000000081', 'guardian81@gmail.com', 'Caretaker 81', '8111100081', '9999900081', 'Parent', '2026-05-17 13:02:19'),
(55, 82, 'Father 82', 'Mother 82', 'Guardian 82', 'Uncle', '8000000082', 'guardian82@gmail.com', 'Caretaker 82', '8111100082', '9999900082', 'Relative', '2026-05-17 13:02:19'),
(56, 83, 'Father 83', 'Mother 83', 'Guardian 83', 'Brother', '8000000083', 'guardian83@gmail.com', 'Caretaker 83', '8111100083', '9999900083', 'Guardian', '2026-05-17 13:02:19'),
(57, 84, 'Father 84', 'Mother 84', 'Guardian 84', 'Father', '8000000084', 'guardian84@gmail.com', 'Caretaker 84', '8111100084', '9999900084', 'Parent', '2026-05-17 13:02:19'),
(58, 85, 'Father 85', 'Mother 85', 'Guardian 85', 'Mother', '8000000085', 'guardian85@gmail.com', 'Caretaker 85', '8111100085', '9999900085', 'Relative', '2026-05-17 13:02:19'),
(59, 86, 'Father 86', 'Mother 86', 'Guardian 86', 'Uncle', '8000000086', 'guardian86@gmail.com', 'Caretaker 86', '8111100086', '9999900086', 'Guardian', '2026-05-17 13:02:19'),
(60, 87, 'Father 87', 'Mother 87', 'Guardian 87', 'Brother', '8000000087', 'guardian87@gmail.com', 'Caretaker 87', '8111100087', '9999900087', 'Parent', '2026-05-17 13:02:19'),
(61, 88, 'Father 88', 'Mother 88', 'Guardian 88', 'Father', '8000000088', 'guardian88@gmail.com', 'Caretaker 88', '8111100088', '9999900088', 'Relative', '2026-05-17 13:02:19'),
(62, 89, 'Father 89', 'Mother 89', 'Guardian 89', 'Mother', '8000000089', 'guardian89@gmail.com', 'Caretaker 89', '8111100089', '9999900089', 'Guardian', '2026-05-17 13:02:19'),
(63, 104, 'tustu sarkar', 'sarala sarkar', 'Tustu sarkar', NULL, '8548878787', 'sribashsarkar3467@gmail.com', NULL, NULL, '9635160436', 'Father', '2026-05-17 19:44:56'),
(64, 105, 'tustu sarkar', 'sarala sarkar', 'Tustu sarkar', NULL, '9635160434', 'sribashsarkar3467@gmail.com', NULL, NULL, '9635160436', 'Father', '2026-05-17 20:14:29'),
(65, 106, 'tustu sarkar', 'sarala sarkar', 'Tustu sarkar', NULL, '9635160434', NULL, NULL, NULL, '9635160436', 'Caretaker', '2026-05-17 20:34:07'),
(66, 108, 'hr', 'hh', 'hh', NULL, '6666666666', NULL, NULL, NULL, '6666666666', 'Mother', '2026-05-17 21:47:00'),
(67, 110, 'Tustu Sarkar', 'Sarala sarkar', 'Tustu sarkar', NULL, '8888584848', 'sribashsarkar3467@gmail.com', NULL, NULL, '9635163555', 'Father', '2026-05-18 08:47:07'),
(68, 112, 'ram', 'sita', 'ram', NULL, '7894565444', 'roy338004@gmail.com', NULL, NULL, '7485845887', 'Father', '2026-05-22 11:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Paid','Unpaid','Pending','Failed') DEFAULT 'Unpaid',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `athlete_id`, `amount`, `status`, `created_at`) VALUES
(1, 105, 149.99, 'Pending', '2026-05-22 10:28:20'),
(2, 110, 500.00, 'Paid', '2026-05-22 10:31:36'),
(3, 112, 15000.00, 'Paid', '2026-05-22 12:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('Admin','Athlete','Coach','Club') NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` varchar(50) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `invoice_id`, `amount_paid`, `payment_method`, `payment_status`, `payment_date`) VALUES
(1, 2, 500.00, 'Cash/Offline', 'Success', '2026-05-22 11:01:22'),
(2, 3, 15000.00, 'Cash/Offline', 'Success', '2026-05-22 12:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qr_verifications`
--

CREATE TABLE `qr_verifications` (
  `id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `scanned_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `scanned_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration_fees`
--

CREATE TABLE `registration_fees` (
  `fee_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `match_time` datetime NOT NULL,
  `venue_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `log_id` int(11) NOT NULL,
  `recipient_mobile` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(50) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `gateway_txn_id` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `venue_id` int(11) NOT NULL,
  `venue_name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aadhaar_records`
--
ALTER TABLE `aadhaar_records`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aadhaar_number` (`aadhaar_number`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `fk_log_admin` (`admin_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `fk_address_athlete` (`athlete_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `athletes`
--
ALTER TABLE `athletes`
  ADD PRIMARY KEY (`athlete_id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `registration_no` (`registration_no`);

--
-- Indexes for table `athlete_cards`
--
ALTER TABLE `athlete_cards`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`cert_id`);

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`club_id`),
  ADD KEY `fk_club_athlete` (`athlete_id`);

--
-- Indexes for table `club_athletes`
--
ALTER TABLE `club_athletes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `club_documents`
--
ALTER TABLE `club_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`coach_id`);

--
-- Indexes for table `competitions`
--
ALTER TABLE `competitions`
  ADD PRIMARY KEY (`competition_id`),
  ADD KEY `fk_competition_athlete` (`athlete_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `fk_document_athlete` (`athlete_id`);

--
-- Indexes for table `document_verifications`
--
ALTER TABLE `document_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_logs`
--
ALTER TABLE `email_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `guardians`
--
ALTER TABLE `guardians`
  ADD PRIMARY KEY (`guardian_id`),
  ADD KEY `fk_guardian_athlete` (`athlete_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `qr_verifications`
--
ALTER TABLE `qr_verifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration_fees`
--
ALTER TABLE `registration_fees`
  ADD PRIMARY KEY (`fee_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aadhaar_records`
--
ALTER TABLE `aadhaar_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `athletes`
--
ALTER TABLE `athletes`
  MODIFY `athlete_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `athlete_cards`
--
ALTER TABLE `athlete_cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `cert_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `club_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `club_athletes`
--
ALTER TABLE `club_athletes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `club_documents`
--
ALTER TABLE `club_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `coach_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `competitions`
--
ALTER TABLE `competitions`
  MODIFY `competition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `document_verifications`
--
ALTER TABLE `document_verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_logs`
--
ALTER TABLE `email_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guardians`
--
ALTER TABLE `guardians`
  MODIFY `guardian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qr_verifications`
--
ALTER TABLE `qr_verifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registration_fees`
--
ALTER TABLE `registration_fees`
  MODIFY `fee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `fk_log_admin` FOREIGN KEY (`admin_id`) REFERENCES `admin_users` (`admin_id`) ON DELETE SET NULL;

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `fk_address_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athletes` (`athlete_id`) ON DELETE CASCADE;

--
-- Constraints for table `clubs`
--
ALTER TABLE `clubs`
  ADD CONSTRAINT `fk_club_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athletes` (`athlete_id`) ON DELETE CASCADE;

--
-- Constraints for table `competitions`
--
ALTER TABLE `competitions`
  ADD CONSTRAINT `fk_competition_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athletes` (`athlete_id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_document_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athletes` (`athlete_id`) ON DELETE CASCADE;

--
-- Constraints for table `guardians`
--
ALTER TABLE `guardians`
  ADD CONSTRAINT `fk_guardian_athlete` FOREIGN KEY (`athlete_id`) REFERENCES `athletes` (`athlete_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
