-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2019 at 02:10 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aims_client`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(10) UNSIGNED NOT NULL,
  `divisionid` int(11) NOT NULL,
  `districtid` int(11) NOT NULL,
  `thanaid` int(11) NOT NULL,
  `postofficeid` int(11) NOT NULL,
  `postcode` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localgovid` int(11) NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `divisionid`, `districtid`, `thanaid`, `postofficeid`, `postcode`, `localgovid`, `address`) VALUES
(1, 3, 18, 212, 1, '1230', 1, 'Rajuk Uttara Model College');

-- --------------------------------------------------------

--
-- Table structure for table `admissionresult`
--

CREATE TABLE `admissionresult` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicantid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_programs`
--

CREATE TABLE `admission_programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `required_gpa` double(8,2) DEFAULT NULL,
  `exam_marks` double(8,2) DEFAULT NULL,
  `exam_date` date DEFAULT NULL,
  `exam_time` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_program_subjects`
--

CREATE TABLE `admission_program_subjects` (
  `programofferid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admission_subjects`
--

CREATE TABLE `admission_subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicantid` int(11) NOT NULL,
  `pin_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middleName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localOrOutsider` int(11) DEFAULT NULL,
  `fatherName` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motherName` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_occupation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `m_occupation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_nid` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_nid` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_Phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_Phone` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `age` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthregno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthpalace` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genderid` int(11) NOT NULL,
  `bloodgroupid` int(11) DEFAULT NULL,
  `marital_status` int(11) DEFAULT NULL,
  `religionid` int(11) NOT NULL,
  `nationalityid` int(11) NOT NULL,
  `ethnicty` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quotaid` int(11) NOT NULL,
  `abled` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_income` double(8,2) DEFAULT NULL,
  `present_addressid` int(11) NOT NULL,
  `permanent_addressid` int(11) DEFAULT NULL,
  `guardianName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_religion` int(11) DEFAULT NULL,
  `g_contactno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_occupation` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_income` double(8,2) DEFAULT NULL,
  `gurdian_addressid` int(11) DEFAULT NULL,
  `prevschool` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastclass` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result` double(8,2) DEFAULT NULL,
  `passing_year` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tcno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tcissueddate` date DEFAULT NULL,
  `picture` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_picture` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_picture` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `applicantid`, `pin_code`, `firstName`, `middleName`, `lastName`, `phone`, `localOrOutsider`, `fatherName`, `motherName`, `f_occupation`, `m_occupation`, `father_nid`, `mother_nid`, `father_Phone`, `mother_Phone`, `dob`, `age`, `birthregno`, `birthpalace`, `genderid`, `bloodgroupid`, `marital_status`, `religionid`, `nationalityid`, `ethnicty`, `quotaid`, `abled`, `parent_income`, `present_addressid`, `permanent_addressid`, `guardianName`, `g_religion`, `g_contactno`, `g_occupation`, `g_income`, `gurdian_addressid`, `prevschool`, `lastclass`, `result`, `passing_year`, `tcno`, `tcissueddate`, `picture`, `signature`, `father_picture`, `mother_picture`, `created_at`, `updated_at`) VALUES
(1, 19100001, 't7dCAF', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100001.png', '19100001_signature.jpg', NULL, NULL, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(2, 19100002, '3m246L', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100002.png', '19100002_signature.jpg', NULL, NULL, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(3, 19100003, 'sdSxQU', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100003.png', '19100003_signature.jpg', NULL, NULL, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(4, 19100004, 'HpF7eU', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100004.png', '19100004_signature.jpg', NULL, NULL, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(5, 19100005, '3VybwM', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100005.png', '19100005_signature.jpg', NULL, NULL, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(6, 19100006, 'PSTIw1', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100006.png', '19100006_signature.jpg', NULL, NULL, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(7, 19100007, 'Nwzy6o', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100007.png', '19100007_signature.jpg', NULL, NULL, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(8, 19060001, '5zNeL1', 'Durul', 'Kalam', 'Hoda', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19060001.png', '19060001_signature.jpg', NULL, NULL, '2019-08-22 05:47:20', '2019-08-22 05:47:20'),
(9, 19060002, 'KH0Aqg', 'Durul', 'Kalam', 'Hoda', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-31', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19060002.png', '19060002_signature.jpg', NULL, NULL, '2019-08-23 23:45:52', '2019-08-23 23:45:52'),
(11, 19060003, 'FPNhri', 'Durul', 'Kalam', 'Hoda', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-31', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19060003.png', '19060003_signature.jpg', NULL, NULL, '2019-08-23 23:48:35', '2019-08-23 23:48:35'),
(12, 19060004, '6ZsGC3', 'Fatema', 'Akter', NULL, '01272720772', NULL, 'Rohim', 'Rohima', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-31', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19060004.png', '19060004_signature.jpg', NULL, NULL, '2019-08-25 05:40:27', '2019-08-25 05:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `app_start_end`
--

CREATE TABLE `app_start_end` (
  `id` int(10) UNSIGNED NOT NULL,
  `sessionid` int(11) NOT NULL,
  `app_startDate` datetime NOT NULL,
  `app_endDate` datetime NOT NULL,
  `examStartDate` date DEFAULT NULL,
  `exam_status` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_accounts`
--

CREATE TABLE `bill_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sender_receiver` int(11) NOT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `transactionid` int(11) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `methodid` int(11) DEFAULT NULL,
  `from_account` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_account` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `approved_date` datetime DEFAULT NULL,
  `short_desc` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'B+', 0, '2019-08-09 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `child_exam_marks`
--

CREATE TABLE `child_exam_marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `mst_examnameid` int(11) NOT NULL,
  `child_examnameid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `obt_marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courseoffer`
--

CREATE TABLE `courseoffer` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `coursemark` double(8,2) DEFAULT NULL,
  `meargeid` int(11) DEFAULT NULL,
  `mearge_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courseoffer`
--

INSERT INTO `courseoffer` (`id`, `programofferid`, `courseid`, `coursemark`, `meargeid`, `mearge_name`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 100.00, 11, NULL, '2019-08-21 02:53:32', '2019-08-21 02:53:32'),
(2, 1, 12, 100.00, 12, NULL, '2019-08-21 03:01:40', '2019-08-21 03:01:40'),
(3, 1, 13, 100.00, 13, NULL, '2019-08-21 04:27:42', '2019-08-21 04:27:42'),
(4, 1, 14, 100.00, 14, NULL, '2019-08-24 23:52:47', '2019-08-24 23:52:47'),
(5, 2, 32, 100.00, 32, NULL, '2019-08-25 00:06:23', '2019-08-25 00:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `courseName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseCode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programlabelid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseName`, `courseCode`, `programlabelid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', '101', 1, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(2, 'English', '107', 1, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(3, 'Math', '109', 1, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(4, 'Art & Craft', '143', 1, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(5, 'Bangla', '101', 2, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(6, 'English', '107', 2, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(7, 'Math', '109', 2, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(8, 'Religious & Moral Education ', '111', 2, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(9, 'General Science', '127', 2, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(10, 'Bangladesh & Global Studies', '150', 2, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(11, 'Bangla 1st Paper', '101', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(12, 'Bangla 2nd Paper', '102', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(13, 'English 1st Paper', '107', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(14, 'English 2nd Paper', '108', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(15, 'Math', '109', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(16, 'Geography & Environment', '110', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(17, 'Islam & Moral Education', '111', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(18, 'Hindu & Moral Education', '112', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(19, 'Buddhist & Moral Education', '113', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(20, 'Christian & Moral Education', '114', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(21, 'Arbi', '121', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(22, 'Sanskrit', '123', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(23, 'Pali', '124', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(24, 'General Science', '127', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(25, 'Agriculture Studies', '134', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(26, 'Physical Education & Health', '147', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(27, 'Art & Craft', '148', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(28, 'Bangladesh & Global Studies', '150', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(29, 'Home Science', '151', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(30, 'ICT', '154', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(31, 'Work & Life Oriented Education', '155', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(32, 'Bangla 1st Paper', '101', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(33, 'Bangla 2nd Paper', '102', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(34, 'Esye Bangla 1st Paper', '103', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(35, 'Esye Bangla 2nd Paper', '104', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(36, 'Bangla Language & Bangladeshi Culture 1st Paper', '105', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(37, 'Bangla Language & Bangladeshi Culture 2nd Paper', '106', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(38, 'English 1st Paper', '107', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(39, 'English 2nd Paper', '108', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(40, 'Math', '109', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(41, 'Geography & Environment', '110', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(42, 'Islam & Moral Education', '111', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(43, 'Hindu & Moral Education', '112', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(44, 'Buddhist & Moral Education', '113', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(45, 'Christian & Moral Education', '114', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(46, 'Bangla Language & Literature', '119', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(47, 'English Language & Literature', '120', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(48, 'Arbi', '121', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(49, 'Sanskrit', '123', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(50, 'Pali', '124', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(51, 'Higher Math', '126', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(52, 'General Science', '127', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(53, 'Work Oriented Education', '130', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(54, 'Computer Studies', '131', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(55, 'Physical Education & Sports (Info)', '133', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(56, 'Agriculture Studies', '134', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(57, 'Basic Trade', '135', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(58, 'Physics', '136', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(59, 'Chemistry', '137', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(60, 'Biology', '138', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(61, 'Civic & Citizenship', '140', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(62, 'Economics', '141', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(63, 'Business Entrepreneurship ', '143', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(64, 'Accounting', '146', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(65, 'Physical Education, Health & Sports', '147', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(66, 'Art & Craft', '148', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(67, 'Music', '149', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(68, 'Bangladesh & Global Studies', '150', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(69, 'Home Science', '151', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(70, 'Finance & Banking', '152', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(71, 'History Of Bangladesh & Global Civilization', '153', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(72, 'ICT', '154', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(73, 'Career Education', '156', 4, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(74, 'Bangla', '101', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(75, 'English', '107', 3, 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course_type`
--

CREATE TABLE `course_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_type`
--

INSERT INTO `course_type` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Compulsory', 0, '2019-08-07 23:35:52', '2019-08-07 23:35:52'),
(2, 'Optional', 0, '2019-08-07 23:35:57', '2019-08-07 23:35:57'),
(3, 'Additional', 0, '2019-08-07 23:36:02', '2019-08-07 23:36:02');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Accountant', 0, '2019-08-07 04:13:49', '2019-08-07 04:13:49'),
(2, 'Agriculture', 0, '2019-08-07 04:14:21', '2019-08-07 04:14:21'),
(3, 'Bangla', 0, '2019-08-07 04:14:39', '2019-08-07 04:14:39'),
(4, 'English', 0, '2019-08-07 04:14:46', '2019-08-07 04:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Principal', 1, '2019-08-09 18:00:00', NULL),
(2, 'Vice-Principal', 1, '2019-08-09 18:00:00', NULL),
(3, 'Principal (Acting)', 1, '2019-08-09 18:00:00', NULL),
(4, 'Professor', 1, '2019-08-09 18:00:00', NULL),
(5, 'Associate Professor', 1, '2019-08-09 18:00:00', NULL),
(6, 'Assistant Professor', 1, '2019-08-09 18:00:00', NULL),
(7, 'Lecturer', 1, '2019-08-09 18:00:00', NULL),
(8, 'Head Master', 1, '2019-08-09 18:00:00', NULL),
(9, 'Head Master (Acting)', 1, '2019-08-09 18:00:00', NULL),
(10, 'Assistant Head Master', 1, '2019-08-09 18:00:00', NULL),
(11, 'Assistant Head Master (Acting)', 1, '2019-08-09 18:00:00', NULL),
(12, 'Senior Teacher', 1, '2019-08-09 18:00:00', NULL),
(13, 'Assistant Teacher', 1, '2019-08-09 18:00:00', NULL),
(14, 'Assistant Teacher (Religion)', 1, '2019-08-09 18:00:00', NULL),
(15, 'Assistant Teacher (ICT)', 1, '2019-08-09 18:00:00', NULL),
(16, 'Assistant Teacher (Sports)', 1, '2019-08-09 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divisionid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `divisionid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BARGUNA', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(2, 'BARISAL', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(3, 'BHOLA', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(4, 'JHALOKATI', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(5, 'PATUAKHALI', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(6, 'PIROJPUR', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(7, 'BANDARBAN', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(8, 'BRAHMANBARIA', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(9, 'CHANDPUR', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(10, 'CHITTAGONG', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(11, 'COMILLA', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(12, 'COX\'S BAZAR', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(13, 'FENI', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(14, 'KHAGRACHHARI', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(15, 'LAKSHMIPUR', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(16, 'NOAKHALI', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(17, 'RANGAMATI', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(18, 'DHAKA', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(19, 'FARIDPUR', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(20, 'GAZIPUR', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(21, 'GOPALGANJ', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(22, 'KISHOREGONJ', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(23, 'MADARIPUR', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(24, 'MANIKGANJ', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(25, 'MUNSHIGANJ', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(26, 'NARAYANGANJ', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(27, 'NARSINGDI', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(28, 'RAJBARI', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(29, 'SHARIATPUR', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(30, 'TANGAIL', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(31, 'BAGERHAT', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(32, 'CHUADANGA', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(33, 'JESSORE', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(34, 'JHENAIDAH', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(35, 'KHULNA', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(36, 'KUSHTIA', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(37, 'MAGURA', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(38, 'MEHERPUR', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(39, 'NARAIL', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(40, 'SATKHIRA', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(41, 'JAMALPUR', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(42, 'MYMENSINGH', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(43, 'NETRAKONA', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(44, 'SHERPUR', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(45, 'BOGRA', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(46, 'CHAPAINABABGANJ', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(47, 'JOYPURHAT', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(48, 'PABNA', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(49, 'NAOGAON', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(50, 'NATORE', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(51, 'RAJSHAHI', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(52, 'SIRAJGANJ', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(53, 'DINAJPUR', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(54, 'GAIBANDHA', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(55, 'KURIGRAM,', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(56, 'LALMONIRHAT', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(57, 'NILPHAMARI', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(58, 'PANCHAGARH', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(59, 'RANGPUR', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(60, 'THAKURGAON', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(61, 'HABIGANJ', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(62, 'MAULVIBAZAR', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(63, 'SUNAMGANJ', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(64, 'SYLHET', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BARISHAL', 0, '2019-08-06 04:11:19', '2019-08-09 11:46:49'),
(2, 'CATTRAGRAM', 0, '2019-08-09 11:47:21', '2019-08-09 11:47:21'),
(3, 'DHAKA', 0, '2019-08-09 11:47:50', '2019-08-09 11:47:50'),
(4, 'KHULNA', 0, '2019-08-09 11:49:59', '2019-08-09 11:49:59'),
(5, 'MYMENSINGH', 0, '2019-08-09 11:50:39', '2019-08-09 11:50:39'),
(6, 'RAJSHAHI', 0, '2019-08-09 11:51:16', '2019-08-09 11:51:16'),
(7, 'RANGPUR', 0, '2019-08-09 11:51:26', '2019-08-09 11:51:26'),
(8, 'SYLHET', 0, '2019-08-09 11:52:07', '2019-08-09 11:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `educationinfo`
--

CREATE TABLE `educationinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `employeeid` int(11) NOT NULL,
  `educationdegreeid` int(11) NOT NULL,
  `discipline` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grade` double(8,2) DEFAULT NULL,
  `passingyear` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `board` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educationinfo`
--

INSERT INTO `educationinfo` (`id`, `employeeid`, `educationdegreeid`, `discipline`, `grade`, `passingyear`, `board`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '345234', 5.00, '2018', 'Rajshai', 0, '2019-08-22 04:21:28', '2019-08-22 04:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `education_degree`
--

CREATE TABLE `education_degree` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `education_degree`
--

INSERT INTO `education_degree` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SSC', 1, '2019-08-09 18:00:00', NULL),
(2, 'HSC', 0, '2019-08-22 01:53:32', '2019-08-22 01:53:32'),
(3, 'Honours', 0, '2019-08-22 01:54:02', '2019-08-22 01:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `employeeidno` int(11) NOT NULL,
  `employeetypeid` int(11) NOT NULL,
  `designationid` int(11) NOT NULL,
  `departmentid` int(11) NOT NULL,
  `employmentstatusid` int(11) NOT NULL,
  `employeestatusid` int(11) NOT NULL,
  `joining_date` date NOT NULL,
  `retirement_date` date NOT NULL,
  `employeeposition` int(11) NOT NULL,
  `first_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genderid` int(11) NOT NULL,
  `mobileno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `birthregno` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalityid` int(11) NOT NULL,
  `nationalidno` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bloodgroupid` int(11) NOT NULL,
  `marital_statusid` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_addressid` int(11) NOT NULL,
  `picture` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `indexno` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employeeidno`, `employeetypeid`, `designationid`, `departmentid`, `employmentstatusid`, `employeestatusid`, `joining_date`, `retirement_date`, `employeeposition`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `genderid`, `mobileno`, `dob`, `birthregno`, `nationalityid`, `nationalidno`, `bloodgroupid`, `marital_statusid`, `email`, `present_addressid`, `picture`, `signature`, `indexno`, `created_at`, `updated_at`) VALUES
(1, 1900001, 1, 1, 1, 1, 1, '2019-08-02', '2019-07-31', 1, 'Md', 'Imaan', 'Mollah', 'qwerqwer', 'asdfasdf', 1, '01966023678', '2019-07-30', '123414', 1, '23452345234', 1, 1, 'lima@gmail.com', 2, 'picturef0c2fec52d.png', 'signaturef0c2fec52d.jpg', 1, '2019-08-22 04:21:28', '2019-08-22 04:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `employeestatus`
--

CREATE TABLE `employeestatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employeestatus`
--

INSERT INTO `employeestatus` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Running', 0, '2019-08-09 13:41:39', '2019-08-09 13:41:39');

-- --------------------------------------------------------

--
-- Table structure for table `employeetypes`
--

CREATE TABLE `employeetypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employeetypes`
--

INSERT INTO `employeetypes` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Permanent', 0, '2019-08-09 13:40:50', '2019-08-09 13:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `employee_labels`
--

CREATE TABLE `employee_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `employeeid` int(6) NOT NULL,
  `programlabelid` int(6) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_labels`
--

INSERT INTO `employee_labels` (`id`, `employeeid`, `programlabelid`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 0, '2019-08-22 04:21:28', '2019-08-22 04:21:28'),
(2, 1, 4, 0, '2019-08-22 04:21:28', '2019-08-22 04:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `employmentstatus`
--

CREATE TABLE `employmentstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employmentstatus`
--

INSERT INTO `employmentstatus` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'xx', 1, '2019-08-09 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_event_log`
--

CREATE TABLE `emp_event_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` int(11) NOT NULL,
  `emp_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE `event_log` (
  `sl` int(10) UNSIGNED NOT NULL,
  `device_id` int(11) NOT NULL,
  `programOfferId` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exam_name`
--

CREATE TABLE `exam_name` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `examtypeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_name`
--

INSERT INTO `exam_name` (`id`, `name`, `examtypeid`, `status`, `created_at`, `updated_at`) VALUES
(1, '1st Semi star', 1, 0, '2019-08-08 05:36:42', '2019-08-08 05:36:42'),
(2, '2nd Semi Star', 1, 0, '2019-08-08 05:37:03', '2019-08-08 05:37:03'),
(3, 'CT 1', 2, 0, '2019-08-08 05:37:28', '2019-08-08 05:37:28'),
(4, 'CT 2', 2, 0, '2019-08-08 05:37:47', '2019-08-08 05:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Male', 0, '2019-08-07 04:34:51', '2019-08-07 04:34:51'),
(2, 'Female', 0, '2019-08-07 04:34:58', '2019-08-07 04:34:58');

-- --------------------------------------------------------

--
-- Table structure for table `grade_letter`
--

CREATE TABLE `grade_letter` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade_letter`
--

INSERT INTO `grade_letter` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'A+', 0, '2019-08-25 02:03:22', '2019-08-25 02:03:22'),
(2, 'A', 0, '2019-08-25 02:03:30', '2019-08-25 02:03:30'),
(3, 'A-', 0, '2019-08-25 02:03:55', '2019-08-25 02:03:55'),
(4, 'B', 0, '2019-08-25 02:04:02', '2019-08-25 02:04:02'),
(5, 'C', 0, '2019-08-25 02:04:08', '2019-08-25 02:04:08'),
(6, 'D', 0, '2019-08-25 02:04:12', '2019-08-25 02:04:12'),
(7, 'F', 0, '2019-08-25 02:04:18', '2019-08-25 02:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `grade_point`
--

CREATE TABLE `grade_point` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradeletterid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_mark` double(8,2) NOT NULL,
  `to_mark` double(8,2) NOT NULL,
  `gradepoint` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grade_point`
--

INSERT INTO `grade_point` (`id`, `programofferid`, `gradeletterid`, `from_mark`, `to_mark`, `gradepoint`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 80.00, 100.00, 5.00, 0, '2019-08-25 02:27:00', '2019-08-25 02:27:00'),
(2, '1', '2', 70.00, 79.00, 4.00, 0, '2019-08-25 02:27:00', '2019-08-25 02:27:00'),
(3, '1', '3', 60.00, 69.00, 3.50, 0, '2019-08-25 02:27:01', '2019-08-25 02:27:01'),
(4, '1', '4', 50.00, 59.00, 3.00, 0, '2019-08-25 02:27:01', '2019-08-25 02:27:01'),
(5, '1', '5', 40.00, 49.00, 2.00, 0, '2019-08-25 02:27:01', '2019-08-25 02:27:01'),
(6, '1', '6', 33.00, 39.00, 1.00, 0, '2019-08-25 02:27:01', '2019-08-25 02:27:01'),
(7, '1', '7', 0.00, 32.00, 0.00, 0, '2019-08-25 02:27:01', '2019-08-25 02:27:01'),
(8, '2', '1', 80.00, 100.00, 5.00, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18'),
(9, '2', '2', 70.00, 79.00, 4.00, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18'),
(10, '2', '3', 60.00, 69.00, 3.50, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18'),
(11, '2', '4', 50.00, 59.00, 3.00, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18'),
(12, '2', '5', 40.00, 49.00, 2.00, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18'),
(13, '2', '6', 33.00, 39.00, 1.00, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18'),
(14, '2', '7', 0.00, 32.00, 0.00, 0, '2019-08-25 03:36:18', '2019-08-25 03:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Science', 0, '2019-08-06 04:33:04', '2019-08-06 04:33:04'),
(2, 'Arts', 0, '2019-08-06 04:33:10', '2019-08-06 04:33:10'),
(3, 'General', 0, '2019-08-06 04:33:18', '2019-08-06 04:33:18'),
(4, 'Commerce', 0, '2019-08-06 04:33:24', '2019-08-06 04:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins_mobile_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institutetypeid` int(11) DEFAULT NULL,
  `categoryid` int(11) DEFAULT NULL,
  `subcategoryid` int(11) DEFAULT NULL,
  `addressid` int(11) DEFAULT NULL,
  `wordno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cluster` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ein` bigint(20) DEFAULT NULL,
  `institutelogo` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `ins_mobile_no`, `contact_person`, `institutetypeid`, `categoryid`, `subcategoryid`, `addressid`, `wordno`, `cluster`, `ein`, `institutelogo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rajuk Uttara Model College', '0172677777', 'Imran Molla', 1, 1, 1, 1, 'wordno1', 'Claster1', 1233456, 'institute_logo.png', 0, '2019-08-06 04:36:53', '2019-08-10 01:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `institute_labels`
--

CREATE TABLE `institute_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `instituteid` int(11) NOT NULL,
  `programlabelid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `institute_labels`
--

INSERT INTO `institute_labels` (`id`, `instituteid`, `programlabelid`, `status`, `created_at`, `updated_at`) VALUES
(30, 1, 1, 0, '2019-08-22 01:30:36', '2019-08-22 01:30:36'),
(31, 1, 2, 0, '2019-08-22 01:30:36', '2019-08-22 01:30:36'),
(32, 1, 3, 0, '2019-08-22 01:30:36', '2019-08-22 01:30:36'),
(33, 1, 4, 0, '2019-08-22 01:30:36', '2019-08-22 01:30:36'),
(34, 1, 5, 0, '2019-08-22 01:30:36', '2019-08-22 01:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `label_groups`
--

CREATE TABLE `label_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `programlabelid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `label_groups`
--

INSERT INTO `label_groups` (`id`, `programlabelid`, `groupid`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 3, 0, '2019-08-06 04:34:19', '2019-08-06 04:34:19'),
(3, 3, 3, 0, '2019-08-06 04:34:31', '2019-08-06 04:34:31'),
(8, 4, 1, 0, '2019-08-09 14:14:53', '2019-08-09 14:14:53'),
(9, 4, 2, 0, '2019-08-09 14:14:53', '2019-08-09 14:14:53'),
(10, 4, 4, 0, '2019-08-09 14:14:53', '2019-08-09 14:14:53'),
(11, 5, 1, 0, '2019-08-09 14:15:07', '2019-08-09 14:15:07'),
(12, 5, 2, 0, '2019-08-09 14:15:07', '2019-08-09 14:15:07'),
(13, 5, 4, 0, '2019-08-09 14:15:07', '2019-08-09 14:15:07'),
(16, 1, 3, 0, '2019-08-22 01:33:21', '2019-08-22 01:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `label_programs`
--

CREATE TABLE `label_programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `programlabelid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localgovs`
--

CREATE TABLE `localgovs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanaid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `localgovs`
--

INSERT INTO `localgovs` (`id`, `name`, `thanaid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka North', 212, 0, '2019-08-06 04:25:11', '2019-08-10 02:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `maritalstatus`
--

CREATE TABLE `maritalstatus` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maritalstatus`
--

INSERT INTO `maritalstatus` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Un Marred', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mark_categories`
--

CREATE TABLE `mark_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mark_categories`
--

INSERT INTO `mark_categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'S', 0, '2019-08-08 01:24:37', '2019-08-08 01:24:37'),
(2, 'O', 0, '2019-08-08 01:24:43', '2019-08-08 01:24:43'),
(3, 'P', 0, '2019-08-08 01:24:48', '2019-08-08 01:24:48'),
(4, 'SBA', 0, '2019-08-08 01:24:57', '2019-08-08 01:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `mark_distribution`
--

CREATE TABLE `mark_distribution` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `markcategoryid` int(11) NOT NULL,
  `mark_in_percentage` double(8,2) DEFAULT NULL,
  `cat_hld_mark` int(11) NOT NULL,
  `percentage_mark` int(11) NOT NULL,
  `mark_group_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mark_distribution`
--

INSERT INTO `mark_distribution` (`id`, `programofferid`, `courseid`, `markcategoryid`, `mark_in_percentage`, `cat_hld_mark`, `percentage_mark`, `mark_group_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 35.00, 70, 50, 1, 0, '2019-08-08 03:28:42', '2019-08-08 03:28:42'),
(2, 2, 1, 2, 35.00, 70, 50, 2, 0, '2019-08-08 03:28:42', '2019-08-08 03:28:42'),
(4, 2, 1, 4, 30.00, 60, 50, 4, 0, '2019-08-08 03:28:42', '2019-08-08 03:28:42'),
(5, 2, 2, 1, 35.00, 70, 50, 1, 0, '2019-08-08 03:29:27', '2019-08-08 03:29:27'),
(6, 2, 2, 2, 35.00, 70, 50, 2, 0, '2019-08-08 03:29:27', '2019-08-08 03:29:27'),
(7, 2, 2, 3, 20.00, 40, 50, 3, 0, '2019-08-08 03:29:27', '2019-08-08 03:29:27'),
(8, 2, 2, 4, 10.00, 20, 50, 4, 0, '2019-08-08 03:29:27', '2019-08-08 03:29:27'),
(9, 2, 9, 1, 35.00, 70, 25, 1, 0, '2019-08-08 03:31:40', '2019-08-08 03:31:40'),
(10, 2, 9, 2, 35.00, 70, 25, 2, 0, '2019-08-08 03:31:40', '2019-08-08 03:31:40'),
(11, 2, 9, 3, 20.00, 40, 25, 3, 0, '2019-08-08 03:31:40', '2019-08-08 03:31:40'),
(12, 2, 9, 4, 10.00, 20, 25, 4, 0, '2019-08-08 03:31:40', '2019-08-08 03:31:40'),
(13, 1, 11, 1, 35.00, 70, 50, 1, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(14, 1, 11, 2, 35.00, 70, 50, 1, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(15, 1, 11, 3, 20.00, 40, 50, 3, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(16, 1, 11, 4, 10.00, 20, 50, 4, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(17, 1, 12, 1, 25.00, 50, 50, 1, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(18, 1, 12, 2, 25.00, 50, 50, 1, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(19, 1, 12, 3, 25.00, 50, 50, 3, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(20, 1, 12, 4, 25.00, 50, 50, 4, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(21, 1, 13, 1, 35.00, 35, 100, 1, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(22, 1, 13, 2, 35.00, 35, 100, 2, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(23, 1, 13, 3, 20.00, 20, 100, 3, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(24, 1, 13, 4, 10.00, 10, 100, 4, 0, '2019-08-24 05:20:46', '2019-08-24 05:20:46'),
(25, 1, 14, 1, 35.00, 140, 25, 1, 0, '2019-08-25 00:00:22', '2019-08-25 00:00:22'),
(26, 1, 14, 2, 35.00, 140, 25, 2, 0, '2019-08-25 00:00:22', '2019-08-25 00:00:22'),
(27, 1, 14, 3, 20.00, 80, 25, 3, 0, '2019-08-25 00:00:22', '2019-08-25 00:00:22'),
(28, 1, 14, 4, 10.00, 40, 25, 4, 0, '2019-08-25 00:00:22', '2019-08-25 00:00:22'),
(29, 2, 32, 1, 35.00, 35, 100, 1, 0, '2019-08-25 03:39:23', '2019-08-25 03:39:23'),
(30, 2, 32, 2, 35.00, 35, 100, 2, 0, '2019-08-25 03:39:23', '2019-08-25 03:39:23'),
(31, 2, 32, 3, 20.00, 20, 100, 3, 0, '2019-08-25 03:39:23', '2019-08-25 03:39:23'),
(32, 2, 32, 4, 10.00, 10, 100, 4, 0, '2019-08-25 03:39:23', '2019-08-25 03:39:23');

-- --------------------------------------------------------

--
-- Table structure for table `master_exam`
--

CREATE TABLE `master_exam` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `examnameid` int(11) NOT NULL,
  `exhld_in_percentage` double(8,2) NOT NULL,
  `mxm_in_percentage` double(8,2) NOT NULL,
  `cxm_in_percentage` double(8,2) NOT NULL,
  `result_with_child` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_exam`
--

INSERT INTO `master_exam` (`id`, `programofferid`, `examnameid`, `exhld_in_percentage`, `mxm_in_percentage`, `cxm_in_percentage`, `result_with_child`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 20.00, 100.00, 20.00, 1, 0, '2019-08-08 06:03:51', '2019-08-08 06:17:20'),
(2, 1, 1, 20.00, 100.00, 20.00, 1, 0, '2019-08-24 05:40:07', '2019-08-24 05:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `mearges`
--

CREATE TABLE `mearges` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mediums`
--

CREATE TABLE `mediums` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mediums`
--

INSERT INTO `mediums` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2019-08-06 04:41:44', '2019-08-06 04:41:44'),
(2, 'English', 0, '2019-08-06 04:41:51', '2019-08-06 04:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentid` int(11) NOT NULL,
  `menuorder` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `url`, `parentid`, `menuorder`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Menu Settings', NULL, 0, 100, 0, '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
(2, 'Menu', 'menu', 1, 100, 0, '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
(3, 'Basic Settings', NULL, 0, 2, 0, '2019-08-06 04:00:39', '2019-08-06 04:09:49'),
(4, 'Section', 'sections', 3, 100, 0, '2019-08-06 04:02:34', '2019-08-06 04:02:34'),
(5, 'Settings', NULL, 0, 1, 0, '2019-08-06 04:09:00', '2019-08-06 04:09:41'),
(6, 'Division', 'division', 3, 100, 0, '2019-08-06 04:10:59', '2019-08-06 04:10:59'),
(7, 'District', 'district', 3, 100, 0, '2019-08-06 04:11:54', '2019-08-06 04:11:54'),
(8, 'Thana', 'thana', 3, 100, 0, '2019-08-06 04:21:56', '2019-08-06 04:21:56'),
(9, 'Post Office', 'postoffice', 3, 100, 0, '2019-08-06 04:23:12', '2019-08-06 04:23:12'),
(10, 'Union', 'localgov', 3, 100, 0, '2019-08-06 04:24:34', '2019-08-06 04:24:34'),
(11, 'Institute', 'institute', 5, 100, 0, '2019-08-06 04:25:52', '2019-08-06 04:25:52'),
(12, 'Class Label', 'plabel', 5, 100, 0, '2019-08-06 04:31:43', '2019-08-06 04:31:43'),
(13, 'Group', 'group', 3, 100, 0, '2019-08-06 04:32:47', '2019-08-06 04:32:47'),
(14, 'Session', 'session', 3, 100, 0, '2019-08-06 04:38:53', '2019-08-06 04:38:53'),
(15, 'Medium', 'medium', 3, 100, 0, '2019-08-06 04:40:23', '2019-08-06 04:40:23'),
(16, 'Shift', 'shift', 3, 100, 0, '2019-08-06 04:40:43', '2019-08-06 04:40:43'),
(17, 'Course', 'course', 5, 3, 0, '2019-08-06 04:42:28', '2019-08-06 04:42:28'),
(18, 'Offer Settings', NULL, 0, 100, 0, '2019-08-06 04:43:39', '2019-08-06 04:43:39'),
(19, 'Program Offer', 'programoffer', 18, 1, 0, '2019-08-06 04:44:08', '2019-08-06 04:44:08'),
(20, 'Class', 'program', 5, 100, 0, '2019-08-06 04:48:35', '2019-08-06 04:49:29'),
(21, 'Role Settings', NULL, 0, 100, 0, '2019-08-06 04:50:32', '2019-08-06 04:50:32'),
(22, 'Role', 'role', 21, 100, 0, '2019-08-06 04:50:51', '2019-08-06 04:50:51'),
(23, 'User', 'user', 21, 100, 0, '2019-08-06 04:53:50', '2019-08-06 04:53:50'),
(24, 'Subject Offer', 'courseoffercreate', 18, 100, 0, '2019-08-06 05:08:45', '2019-08-06 05:09:01'),
(25, 'Edit Subject Offer', 'editcourseoffer', 18, 100, 0, '2019-08-06 05:09:53', '2019-08-24 05:43:23'),
(26, 'Employee Settings', NULL, 0, 100, 0, '2019-08-07 02:50:31', '2019-08-07 02:50:31'),
(27, 'Employee', 'employees', 26, 100, 0, '2019-08-07 02:51:51', '2019-08-07 02:51:51'),
(28, 'Department', 'departments', 3, 100, 0, '2019-08-07 04:12:25', '2019-08-07 04:12:25'),
(29, 'Employment Status', 'employmentstatus', 3, 100, 0, '2019-08-07 04:16:15', '2019-08-07 04:17:33'),
(30, 'Employee Type', 'employeetypes', 3, 100, 0, '2019-08-07 04:16:38', '2019-08-07 04:16:38'),
(31, 'Employee Status', 'employeestatus', 3, 100, 0, '2019-08-07 04:17:58', '2019-08-07 04:17:58'),
(32, 'Designation', 'designations', 3, 100, 0, '2019-08-07 04:18:17', '2019-08-07 04:18:17'),
(33, 'Marital Status', 'maritalstatus', 3, 100, 0, '2019-08-07 04:18:39', '2019-08-07 04:18:39'),
(34, 'Education Degree', 'educationdegree', 3, 100, 0, '2019-08-07 04:18:57', '2019-08-07 04:18:57'),
(35, 'Gender', 'gender', 3, 100, 0, '2019-08-07 04:33:45', '2019-08-07 04:33:45'),
(36, 'Student Settings', NULL, 0, 100, 0, '2019-08-07 22:41:13', '2019-08-07 22:41:13'),
(37, 'Student Direct Enroll', 'directenroll', 36, 100, 0, '2019-08-07 22:41:45', '2019-08-07 22:41:45'),
(38, 'Religion', 'religion', 3, 100, 0, '2019-08-07 23:11:14', '2019-08-07 23:11:14'),
(39, 'Quota', 'quota', 3, 100, 0, '2019-08-07 23:12:22', '2019-08-07 23:12:22'),
(40, 'Course Type', 'coursetype', 3, 100, 0, '2019-08-07 23:35:26', '2019-08-07 23:35:26'),
(41, 'Mark Distribution', 'markdistribution', 18, 100, 0, '2019-08-08 00:10:18', '2019-08-08 00:10:18'),
(42, 'Mark Category', 'markcategory', 3, 100, 0, '2019-08-08 01:24:22', '2019-08-08 01:24:22'),
(43, 'Edit Mark Distribution', 'editmarkdistribution', 18, 100, 0, '2019-08-08 03:38:28', '2019-08-08 03:38:28'),
(44, 'Marks Entry', NULL, 0, 3, 0, '2019-08-08 04:34:24', '2019-08-08 04:34:57'),
(45, 'Master Mark Entry', 'mstexammarkentry', 44, 100, 0, '2019-08-08 04:36:04', '2019-08-08 04:36:04'),
(46, 'Exam Settings', NULL, 0, 4, 0, '2019-08-08 05:33:22', '2019-08-08 05:33:22'),
(47, 'Exam Name', 'examname', 46, 100, 0, '2019-08-08 05:36:05', '2019-08-08 05:36:05'),
(48, 'Master Exam', 'masterexam', 46, 2, 0, '2019-08-08 05:41:22', '2019-08-08 05:41:22'),
(49, 'Master Mark Edit', 'mstexammarkedit', 44, 100, 0, '2019-08-09 05:45:33', '2019-08-09 05:45:33'),
(50, 'Student List', 'students', 36, 100, 0, '2019-08-23 23:57:03', '2019-08-23 23:57:03'),
(51, 'Class Result', NULL, 0, 100, 0, '2019-08-24 05:49:30', '2019-08-24 05:49:30'),
(52, 'Master Exam Result', 'mstexamresult', 51, 100, 0, '2019-08-24 05:53:05', '2019-08-24 05:53:05'),
(53, 'Grade Letter', 'gradeletter', 3, 100, 0, '2019-08-25 02:01:38', '2019-08-25 02:01:38'),
(54, 'Grade Point', 'gradepoint', 3, 100, 0, '2019-08-25 02:02:02', '2019-08-25 02:02:02'),
(55, 'Edit Grade Point', 'editgradepoint', 3, 100, 0, '2019-08-25 02:34:13', '2019-08-25 02:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_16_110017_create_religions_table', 1),
(4, '2019_01_16_110038_create_nationalities_table', 1),
(5, '2019_01_16_110057_create_quotas_table', 1),
(6, '2019_01_16_110122_create_blood_groups_table', 1),
(7, '2019_01_16_110210_create_genders_table', 1),
(8, '2019_01_22_074946_create_menus_table', 1),
(9, '2019_01_22_081429_create_roles_table', 1),
(10, '2019_01_22_081945_create_role_menu_table', 1),
(11, '2019_01_22_082120_create_permissions_table', 1),
(12, '2019_01_23_061004_create_role_user_table', 1),
(13, '2019_01_29_104509_create_sessions_table', 1),
(14, '2019_01_29_104619_create_programs_table', 1),
(15, '2019_01_29_104709_create_groups_table', 1),
(16, '2019_01_29_104726_create_mediums_table', 1),
(17, '2019_01_29_104745_create_shifts_table', 1),
(18, '2019_01_31_072619_create_programoffers_table', 1),
(19, '2019_02_02_035854_create_admission_programs_table', 1),
(20, '2019_02_03_094629_create_divisions_table', 1),
(21, '2019_02_03_094754_create_districts_table', 1),
(22, '2019_02_03_094841_create_thanas_table', 1),
(23, '2019_02_03_094916_create_postoffices_table', 1),
(24, '2019_02_03_094957_create_localgovs_table', 1),
(25, '2019_02_05_062142_create_addresses_table', 1),
(26, '2019_02_05_064553_create_applicants_table', 1),
(27, '2019_02_11_062729_create_institutes_table', 1),
(28, '2019_02_12_034715_create_admission_subjects_table', 1),
(29, '2019_02_18_063256_create_bill_accounts_table', 1),
(30, '2019_02_24_092630_create_admissionresult_table', 1),
(31, '2019_02_27_092550_create_courses_table', 1),
(32, '2019_03_02_064027_create_mearges_table', 1),
(33, '2019_03_02_073647_create_courseoffer_table', 1),
(34, '2019_03_03_060538_create_departments_table', 1),
(35, '2019_03_03_064145_create_employmentstatus_table', 1),
(36, '2019_03_03_074840_create_employeetypes_table', 1),
(37, '2019_03_03_081600_create_designations_table', 1),
(38, '2019_03_03_085818_create_employeestatus_table', 1),
(39, '2019_03_03_104527_create_employees_table', 1),
(40, '2019_03_04_045750_create_maritalstatus_table', 1),
(41, '2019_03_06_064958_create_education_degree_table', 1),
(42, '2019_03_06_100949_create_educationinfo_table', 1),
(43, '2019_03_14_094400_create_sections_table', 1),
(44, '2019_03_16_081640_create_sectionoffer_table', 1),
(45, '2019_03_25_083652_create_mark_categories_table', 1),
(47, '2019_03_30_063627_create_grade_point_table', 1),
(48, '2019_03_30_065327_create_grade_letter_table', 1),
(49, '2019_04_07_060856_create_course_type_table', 1),
(50, '2019_04_07_065837_create_students_table', 1),
(51, '2019_04_07_070641_create_student_courses_table', 1),
(52, '2019_04_17_065817_create_master_exam_table', 1),
(53, '2019_04_17_091812_create_exam_name_table', 1),
(54, '2019_04_30_102048_create_admission_program_subjects_table', 1),
(55, '2019_05_06_053818_create_app_start_end_table', 1),
(56, '2019_05_26_055224_create_program_groups_table', 1),
(57, '2019_06_02_090752_create_mst_exam_marks_table', 1),
(58, '2019_06_15_052029_create_students_house_table', 1),
(59, '2019_07_10_071117_create_tbl_child_exam_table', 1),
(60, '2019_07_11_043631_create_child_exam_marks_table', 1),
(61, '2019_08_04_114619_create_label_groups_table', 1),
(62, '2019_08_05_052342_create_label_programs_table', 1),
(63, '2019_08_05_053602_create_plabels_table', 1),
(64, '2019_08_05_104441_create_institute_labels_table', 1),
(65, '2019_08_06_092647_create_section_course_teachers_table', 1),
(66, '2019_03_25_091043_create_mark_distribution_table', 2),
(67, '2019_08_07_102513_create_employee_labels_table', 2),
(68, '2019_08_09_061500_add_stdid_to_students', 3),
(69, '2019_08_09_063943_create_event_log_table', 3),
(70, '2019_08_09_064444_create_emp_event_log_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mst_exam_marks`
--

CREATE TABLE `mst_exam_marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `examnameid` int(11) NOT NULL,
  `examtypeid` int(11) DEFAULT NULL,
  `markcategoryid` int(11) DEFAULT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_exam_marks`
--

INSERT INTO `mst_exam_marks` (`id`, `programofferid`, `sectionid`, `studentid`, `courseid`, `examnameid`, `examtypeid`, `markcategoryid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 1, 1, 1, 1, 65.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(2, 2, 1, 1, 1, 1, 1, 2, 65.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(3, 2, 1, 1, 1, 1, 1, 4, 55.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(4, 2, 1, 2, 1, 1, 1, 1, 25.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(5, 2, 1, 2, 1, 1, 1, 2, 50.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(6, 2, 1, 2, 1, 1, 1, 4, 50.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(7, 2, 1, 3, 1, 1, 1, 1, 49.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(8, 2, 1, 3, 1, 1, 1, 2, 30.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(9, 2, 1, 3, 1, 1, 1, 4, 55.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(10, 2, 1, 4, 1, 1, 1, 1, 34.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(11, 2, 1, 4, 1, 1, 1, 2, 56.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(12, 2, 1, 4, 1, 1, 1, 4, 12.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(13, 2, 1, 5, 1, 1, 1, 1, 8.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(14, 2, 1, 5, 1, 1, 1, 2, 37.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(15, 2, 1, 5, 1, 1, 1, 4, 6.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(16, 2, 1, 6, 1, 1, 1, 1, 34.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(17, 2, 1, 6, 1, 1, 1, 2, 34.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(18, 2, 1, 6, 1, 1, 1, 4, 52.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(19, 2, 1, 7, 1, 1, 1, 1, 33.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(20, 2, 1, 7, 1, 1, 1, 2, 27.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(21, 2, 1, 7, 1, 1, 1, 4, 20.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(22, 1, 1, 1, 11, 1, 1, 1, 50.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(23, 1, 1, 1, 11, 1, 1, 2, 55.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(24, 1, 1, 1, 11, 1, 1, 3, 40.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(25, 1, 1, 1, 11, 1, 1, 4, 19.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(26, 1, 1, 2, 11, 1, 1, 1, 55.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(27, 1, 1, 2, 11, 1, 1, 2, 60.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(28, 1, 1, 2, 11, 1, 1, 3, 30.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(29, 1, 1, 2, 11, 1, 1, 4, 10.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(30, 1, 1, 3, 11, 1, 1, 1, 30.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(31, 1, 1, 3, 11, 1, 1, 2, 40.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(32, 1, 1, 3, 11, 1, 1, 3, 50.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(33, 1, 1, 3, 11, 1, 1, 4, 5.00, 0, '2019-08-24 05:41:53', '2019-08-24 05:41:53'),
(34, 1, 1, 1, 12, 1, 1, 1, 19.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(35, 1, 1, 1, 12, 1, 1, 2, 30.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(36, 1, 1, 1, 12, 1, 1, 3, 40.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(37, 1, 1, 1, 12, 1, 1, 4, 40.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(38, 1, 1, 2, 12, 1, 1, 1, 21.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(39, 1, 1, 2, 12, 1, 1, 2, 26.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(40, 1, 1, 2, 12, 1, 1, 3, 25.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(41, 1, 1, 2, 12, 1, 1, 4, 24.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(42, 1, 1, 3, 12, 1, 1, 1, 49.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(43, 1, 1, 3, 12, 1, 1, 2, 37.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(44, 1, 1, 3, 12, 1, 1, 3, 12.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(45, 1, 1, 3, 12, 1, 1, 4, 35.00, 0, '2019-08-24 23:54:45', '2019-08-24 23:54:45'),
(46, 1, 1, 1, 13, 1, 1, 1, 18.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(47, 1, 1, 1, 13, 1, 1, 2, 30.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(48, 1, 1, 1, 13, 1, 1, 3, 19.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(49, 1, 1, 1, 13, 1, 1, 4, 10.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(50, 1, 1, 2, 13, 1, 1, 1, 35.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(51, 1, 1, 2, 13, 1, 1, 2, 25.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(52, 1, 1, 2, 13, 1, 1, 3, 15.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(53, 1, 1, 2, 13, 1, 1, 4, 8.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(54, 1, 1, 3, 13, 1, 1, 1, 18.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(55, 1, 1, 3, 13, 1, 1, 2, 12.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(56, 1, 1, 3, 13, 1, 1, 3, 18.00, 0, '2019-08-24 23:56:08', '2019-08-24 23:56:08'),
(57, 1, 1, 3, 13, 1, 1, 4, 7.00, 0, '2019-08-24 23:56:09', '2019-08-24 23:56:09'),
(58, 1, 1, 1, 14, 1, 1, 1, 135.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(59, 1, 1, 1, 14, 1, 1, 2, 120.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(60, 1, 1, 1, 14, 1, 1, 3, 70.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(61, 1, 1, 1, 14, 1, 1, 4, 40.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(62, 1, 1, 2, 14, 1, 1, 1, 120.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(63, 1, 1, 2, 14, 1, 1, 2, 115.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(64, 1, 1, 2, 14, 1, 1, 3, 80.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(65, 1, 1, 2, 14, 1, 1, 4, 35.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(66, 1, 1, 3, 14, 1, 1, 1, 125.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(67, 1, 1, 3, 14, 1, 1, 2, 110.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(68, 1, 1, 3, 14, 1, 1, 3, 75.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45'),
(69, 1, 1, 3, 14, 1, 1, 4, 35.00, 0, '2019-08-25 00:02:45', '2019-08-25 00:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangladeshi', 1, '2019-08-09 18:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Read', 0, '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
(2, 'Create', 0, '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
(3, 'Up', 0, '2019-08-06 03:58:22', '2019-08-06 03:58:22'),
(4, 'Del', 0, '2019-08-06 03:58:22', '2019-08-06 03:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `plabels`
--

CREATE TABLE `plabels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plabels`
--

INSERT INTO `plabels` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pre-Primary', 0, '2019-08-06 04:34:08', '2019-08-06 04:34:08'),
(2, 'Primary', 0, '2019-08-06 04:34:19', '2019-08-06 04:34:19'),
(3, 'Junior Secondary', 0, '2019-08-06 04:34:31', '2019-08-06 04:34:31'),
(4, 'Secondary', 0, '2019-08-06 04:34:47', '2019-08-06 04:34:47'),
(5, 'Higher Secondary', 0, '2019-08-06 04:34:54', '2019-08-06 04:34:54');

-- --------------------------------------------------------

--
-- Table structure for table `postoffices`
--

CREATE TABLE `postoffices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thanaid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `postoffices`
--

INSERT INTO `postoffices` (`id`, `name`, `thanaid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Uttara', 212, 0, '2019-08-06 04:23:43', '2019-08-06 04:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `programoffers`
--

CREATE TABLE `programoffers` (
  `id` int(10) UNSIGNED NOT NULL,
  `sessionid` int(11) NOT NULL,
  `programlabelid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `mediumid` int(11) NOT NULL,
  `shiftid` int(11) NOT NULL,
  `cordinator` int(11) DEFAULT NULL,
  `seat` int(11) NOT NULL,
  `number_of_courses` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programoffers`
--

INSERT INTO `programoffers` (`id`, `sessionid`, `programlabelid`, `programid`, `groupid`, `mediumid`, `shiftid`, `cordinator`, `seat`, `number_of_courses`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 6, 3, 1, 1, 1, 112, 10, 0, '2019-08-09 14:19:47', '2019-08-24 01:22:39'),
(2, 1, 4, 9, 1, 1, 1, 1, 210, 10, 0, '2019-08-21 00:45:31', '2019-08-21 01:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programlabelid` int(11) NOT NULL,
  `programsign` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `programlabelid`, `programsign`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Class I', 2, '01', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(2, 'Class II', 2, '02', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(3, 'Class III', 2, '03', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(4, 'Class IV', 2, '04', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(5, 'Class V', 2, '05', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(6, 'Class VI', 3, '06', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(7, 'Class VII', 3, '07', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(8, 'Class VIII', 3, '08', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(9, 'Class IX', 4, '09', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(10, 'Class X', 4, '10', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(11, 'Class XI', 5, '11', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(12, 'Class XII', 5, '12', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(13, 'Class XIII', 6, '13', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(14, 'Class XIV', 6, '14', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(15, 'Class XV', 7, '15', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(16, 'Play Group', 1, '97', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(17, 'Nursery', 1, '98', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(18, 'K.G.', 1, '99', 0, '2019-08-08 18:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `program_groups`
--

CREATE TABLE `program_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `programid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotas`
--

CREATE TABLE `quotas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotas`
--

INSERT INTO `quotas` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'General', 0, '2019-08-07 23:12:40', '2019-08-07 23:12:40');

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Islam', 0, '2019-08-07 23:11:44', '2019-08-07 23:11:44'),
(2, 'Hindu', 0, '2019-08-07 23:11:51', '2019-08-07 23:11:51');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rolecreatorid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `rolecreatorid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Supper Admin', 0, 0, '2019-08-06 03:58:22', '2019-08-06 03:58:22'),
(2, 'River View School(Admin)', 1, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `roleid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `permissionid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`roleid`, `menuid`, `permissionid`) VALUES
(1, 1, 0),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(1, 4, 1),
(1, 4, 2),
(1, 4, 3),
(1, 4, 4),
(1, 5, 0),
(1, 3, 0),
(1, 6, 1),
(1, 6, 2),
(1, 6, 3),
(1, 6, 4),
(1, 7, 1),
(1, 7, 2),
(1, 7, 3),
(1, 7, 4),
(1, 8, 1),
(1, 8, 2),
(1, 8, 3),
(1, 8, 4),
(1, 9, 1),
(1, 9, 2),
(1, 9, 3),
(1, 9, 4),
(1, 10, 1),
(1, 10, 2),
(1, 10, 3),
(1, 10, 4),
(1, 11, 1),
(1, 11, 2),
(1, 11, 3),
(1, 11, 4),
(1, 12, 1),
(1, 12, 2),
(1, 12, 3),
(1, 12, 4),
(1, 13, 1),
(1, 13, 2),
(1, 13, 3),
(1, 13, 4),
(1, 14, 1),
(1, 14, 2),
(1, 14, 3),
(1, 14, 4),
(1, 15, 1),
(1, 15, 2),
(1, 15, 3),
(1, 15, 4),
(1, 16, 1),
(1, 16, 2),
(1, 16, 3),
(1, 16, 4),
(1, 17, 1),
(1, 17, 2),
(1, 17, 3),
(1, 17, 4),
(1, 18, 0),
(1, 19, 1),
(1, 19, 2),
(1, 19, 3),
(1, 19, 4),
(1, 20, 1),
(1, 20, 2),
(1, 20, 3),
(1, 20, 4),
(1, 21, 0),
(1, 22, 1),
(1, 22, 2),
(1, 22, 3),
(1, 22, 4),
(1, 23, 1),
(1, 23, 2),
(1, 23, 3),
(1, 23, 4),
(1, 24, 1),
(1, 24, 2),
(1, 24, 3),
(1, 24, 4),
(1, 26, 0),
(1, 27, 1),
(1, 27, 2),
(1, 27, 3),
(1, 27, 4),
(1, 28, 1),
(1, 28, 2),
(1, 28, 3),
(1, 28, 4),
(1, 30, 1),
(1, 30, 2),
(1, 30, 3),
(1, 30, 4),
(1, 29, 1),
(1, 29, 2),
(1, 29, 3),
(1, 29, 4),
(1, 31, 1),
(1, 31, 2),
(1, 31, 3),
(1, 31, 4),
(1, 32, 1),
(1, 32, 2),
(1, 32, 3),
(1, 32, 4),
(1, 33, 1),
(1, 33, 2),
(1, 33, 3),
(1, 33, 4),
(1, 34, 1),
(1, 34, 2),
(1, 34, 3),
(1, 34, 4),
(1, 35, 1),
(1, 35, 2),
(1, 35, 3),
(1, 35, 4),
(1, 36, 0),
(1, 37, 1),
(1, 37, 2),
(1, 37, 3),
(1, 37, 4),
(1, 38, 1),
(1, 38, 2),
(1, 38, 3),
(1, 38, 4),
(1, 39, 1),
(1, 39, 2),
(1, 39, 3),
(1, 39, 4),
(1, 40, 1),
(1, 40, 2),
(1, 40, 3),
(1, 40, 4),
(1, 41, 1),
(1, 41, 2),
(1, 41, 3),
(1, 41, 4),
(1, 42, 1),
(1, 42, 2),
(1, 42, 3),
(1, 42, 4),
(1, 43, 1),
(1, 43, 2),
(1, 43, 3),
(1, 43, 4),
(1, 44, 0),
(1, 45, 1),
(1, 45, 2),
(1, 45, 3),
(1, 45, 4),
(1, 46, 0),
(1, 47, 1),
(1, 47, 2),
(1, 47, 3),
(1, 47, 4),
(1, 48, 1),
(1, 48, 2),
(1, 48, 3),
(1, 48, 4),
(2, 1, 0),
(2, 2, 1),
(2, 2, 2),
(2, 2, 3),
(2, 2, 4),
(2, 3, 0),
(2, 4, 1),
(2, 4, 2),
(2, 4, 3),
(2, 6, 1),
(2, 6, 2),
(2, 6, 3),
(2, 7, 1),
(2, 7, 2),
(2, 7, 3),
(2, 8, 1),
(2, 8, 2),
(2, 8, 3),
(2, 9, 1),
(2, 9, 2),
(2, 9, 3),
(2, 10, 1),
(2, 10, 2),
(2, 10, 3),
(2, 13, 1),
(2, 13, 2),
(2, 13, 3),
(2, 14, 1),
(2, 14, 2),
(2, 14, 3),
(2, 15, 1),
(2, 15, 2),
(2, 15, 3),
(2, 16, 1),
(2, 16, 2),
(2, 16, 3),
(2, 28, 1),
(2, 28, 2),
(2, 28, 3),
(2, 29, 1),
(2, 29, 2),
(2, 29, 3),
(2, 30, 1),
(2, 30, 2),
(2, 30, 3),
(2, 31, 1),
(2, 31, 2),
(2, 31, 3),
(2, 32, 1),
(2, 32, 2),
(2, 32, 3),
(2, 33, 1),
(2, 33, 2),
(2, 33, 3),
(2, 34, 1),
(2, 34, 2),
(2, 34, 3),
(2, 35, 1),
(2, 35, 2),
(2, 35, 3),
(2, 38, 1),
(2, 38, 2),
(2, 38, 3),
(2, 39, 1),
(2, 39, 2),
(2, 39, 3),
(2, 40, 1),
(2, 40, 2),
(2, 40, 3),
(2, 42, 1),
(2, 42, 2),
(2, 42, 3),
(2, 5, 0),
(2, 11, 1),
(2, 11, 2),
(2, 11, 3),
(2, 12, 1),
(2, 12, 2),
(2, 12, 3),
(2, 17, 1),
(2, 17, 2),
(2, 17, 3),
(2, 20, 1),
(2, 20, 2),
(2, 20, 3),
(2, 18, 0),
(2, 19, 1),
(2, 19, 2),
(2, 19, 3),
(2, 24, 1),
(2, 24, 2),
(2, 24, 3),
(2, 25, 1),
(2, 25, 2),
(2, 25, 3),
(2, 41, 1),
(2, 41, 2),
(2, 41, 3),
(2, 43, 1),
(2, 43, 2),
(2, 43, 3),
(2, 26, 0),
(2, 27, 1),
(2, 27, 2),
(2, 27, 3),
(2, 36, 0),
(2, 37, 1),
(2, 37, 2),
(2, 37, 3),
(2, 46, 0),
(2, 47, 1),
(2, 47, 2),
(2, 47, 3),
(2, 48, 1),
(2, 48, 2),
(2, 48, 3),
(1, 49, 1),
(1, 49, 2),
(1, 49, 3),
(1, 49, 4),
(1, 50, 1),
(1, 50, 2),
(1, 50, 3),
(1, 50, 4),
(1, 25, 1),
(1, 25, 2),
(1, 25, 3),
(1, 25, 4),
(1, 51, 0),
(1, 52, 1),
(1, 52, 2),
(1, 52, 3),
(1, 52, 4),
(1, 53, 1),
(1, 53, 2),
(1, 53, 3),
(1, 53, 4),
(1, 54, 1),
(1, 54, 2),
(1, 54, 3),
(1, 54, 4),
(1, 55, 1),
(1, 55, 2),
(1, 55, 3),
(1, 55, 4);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `roleid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`roleid`, `userid`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sectionoffer`
--

CREATE TABLE `sectionoffer` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `section_std_num` int(11) NOT NULL,
  `section_teacher` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sectionoffer`
--

INSERT INTO `sectionoffer` (`id`, `programofferid`, `sectionid`, `section_std_num`, `section_teacher`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12, 1, 0, '2019-08-06 05:04:46', '2019-08-06 05:04:46'),
(2, 1, 2, 100, 1, 0, '2019-08-06 05:04:46', '2019-08-06 05:04:46'),
(4, 2, 1, 100, 1, 0, '2019-08-06 05:14:14', '2019-08-06 05:14:14'),
(5, 2, 2, 50, 1, 0, '2019-08-06 05:43:05', '2019-08-06 05:43:05'),
(6, 2, 3, 60, 1, 0, '2019-08-06 05:45:22', '2019-08-06 05:45:22'),
(7, 3, 1, 100, NULL, 0, '2019-08-09 00:07:19', '2019-08-09 00:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ka', 0, '2019-08-06 04:03:43', '2019-08-06 04:03:43'),
(2, 'Kha', 0, '2019-08-06 04:03:48', '2019-08-06 04:03:48'),
(3, 'Ga', 0, '2019-08-06 04:04:00', '2019-08-06 04:04:00'),
(4, 'Gha', 0, '2019-08-06 04:04:06', '2019-08-06 04:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `section_course_teachers`
--

CREATE TABLE `section_course_teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_course_teachers`
--

INSERT INTO `section_course_teachers` (`id`, `programofferid`, `sectionid`, `courseid`, `teacherid`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(2, 2, 2, 1, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(3, 2, 3, 1, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(4, 2, 1, 2, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(5, 2, 2, 2, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(6, 2, 3, 2, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(7, 2, 1, 3, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(8, 2, 2, 3, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(9, 2, 3, 3, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(10, 2, 1, 4, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(11, 2, 2, 4, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(12, 2, 3, 4, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(13, 2, 1, 5, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(14, 2, 2, 5, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(15, 2, 3, 5, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(16, 2, 1, 6, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(17, 2, 2, 6, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(18, 2, 3, 6, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(19, 2, 1, 7, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(20, 2, 2, 7, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(21, 2, 3, 7, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(22, 2, 1, 8, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(23, 2, 2, 8, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(24, 2, 3, 8, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(25, 2, 1, 9, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(26, 2, 2, 9, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(27, 2, 3, 9, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(28, 2, 1, 10, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(29, 2, 2, 10, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(30, 2, 3, 10, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(31, 2, 1, 11, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(32, 2, 2, 11, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(33, 2, 3, 11, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(34, 2, 1, 12, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(35, 2, 2, 12, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(36, 2, 3, 12, NULL, 0, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(37, 1, 1, 1, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(38, 1, 2, 1, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(39, 1, 3, 1, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(40, 1, 1, 2, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(41, 1, 2, 2, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(42, 1, 3, 2, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(43, 1, 1, 3, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(44, 1, 2, 3, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(45, 1, 3, 3, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(46, 1, 1, 4, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(47, 1, 2, 4, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(48, 1, 3, 4, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(49, 1, 1, 5, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(50, 1, 2, 5, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(51, 1, 3, 5, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(52, 1, 1, 6, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(53, 1, 2, 6, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(54, 1, 3, 6, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(55, 1, 1, 7, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(56, 1, 2, 7, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(57, 1, 3, 7, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(58, 1, 1, 8, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(59, 1, 2, 8, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(60, 1, 3, 8, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(61, 1, 1, 9, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(62, 1, 2, 9, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(63, 1, 3, 9, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(64, 1, 1, 10, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(65, 1, 2, 10, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(66, 1, 3, 10, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(67, 1, 1, 11, 1, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(68, 1, 2, 11, 1, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(69, 1, 3, 11, 1, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(70, 1, 1, 12, 1, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(71, 1, 2, 12, 1, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(72, 1, 3, 12, 1, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(73, 1, 1, 13, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(74, 1, 2, 13, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(75, 1, 3, 13, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(76, 1, 1, 14, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(77, 1, 2, 14, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(78, 1, 3, 14, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(79, 1, 1, 15, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(80, 1, 2, 15, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(81, 1, 3, 15, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(82, 2, 1, 13, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(83, 2, 2, 13, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(84, 2, 3, 13, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(85, 2, 1, 14, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(86, 2, 2, 14, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(87, 2, 3, 14, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(88, 2, 1, 15, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(89, 2, 2, 15, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(90, 2, 3, 15, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(91, 1, 1, 11, 1, 0, '2019-08-21 02:53:32', '2019-08-21 02:53:32'),
(92, 1, 2, 11, 1, 0, '2019-08-21 02:53:32', '2019-08-21 02:53:32'),
(93, 1, 3, 11, 1, 0, '2019-08-21 02:53:32', '2019-08-21 02:53:32'),
(94, 1, 1, 12, 1, 0, '2019-08-21 03:01:40', '2019-08-21 03:01:40'),
(95, 1, 2, 12, 1, 0, '2019-08-21 03:01:40', '2019-08-21 03:01:40'),
(96, 1, 3, 12, 1, 0, '2019-08-21 03:01:40', '2019-08-21 03:01:40'),
(97, 1, 1, 13, 1, 0, '2019-08-21 04:27:42', '2019-08-21 04:27:42'),
(98, 1, 2, 13, 1, 0, '2019-08-21 04:27:42', '2019-08-21 04:27:42'),
(99, 1, 3, 13, 1, 0, '2019-08-21 04:27:42', '2019-08-21 04:27:42'),
(100, 1, 1, 14, 1, 0, '2019-08-24 23:52:48', '2019-08-24 23:52:48'),
(101, 1, 2, 14, 1, 0, '2019-08-24 23:52:48', '2019-08-24 23:52:48'),
(102, 2, 1, 32, 1, 0, '2019-08-25 00:06:23', '2019-08-25 00:06:23'),
(103, 2, 2, 32, 1, 0, '2019-08-25 00:06:23', '2019-08-25 00:06:23'),
(104, 2, 3, 32, 1, 0, '2019-08-25 00:06:23', '2019-08-25 00:06:23');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2019', 0, '2019-08-06 04:39:13', '2019-08-06 04:39:13'),
(2, '2020', 0, '2019-08-06 04:39:27', '2019-08-06 04:39:27');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `name`, `startTime`, `endTime`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Day', '00:12:00', '00:12:00', 0, '2019-08-06 04:58:45', '2019-08-06 04:58:45'),
(2, 'Night', '00:12:00', '00:12:00', 0, '2019-08-06 04:58:52', '2019-08-06 04:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentid` int(11) NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `applicantid` int(11) NOT NULL,
  `classroll` int(11) NOT NULL,
  `fromclass` int(11) NOT NULL,
  `fromsection` int(11) NOT NULL,
  `studenttype` int(11) NOT NULL,
  `currentclass` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `studentid`, `programofferid`, `sectionid`, `applicantid`, `classroll`, `fromclass`, `fromsection`, `studenttype`, `currentclass`, `status`, `created_at`, `updated_at`) VALUES
(1, 19060001, 1, 1, 19060001, 12, 0, 0, 1, 1, 0, '2019-08-22 05:47:20', '2019-08-22 05:47:20'),
(2, 19060002, 1, 1, 19060002, 13, 0, 0, 1, 1, 0, '2019-08-23 23:45:52', '2019-08-23 23:45:52'),
(3, 19060003, 1, 1, 19060003, 14, 0, 0, 1, 1, 0, '2019-08-23 23:48:35', '2019-08-23 23:48:35'),
(4, 19060004, 1, 1, 19060004, 15, 0, 0, 1, 1, 0, '2019-08-25 05:40:27', '2019-08-25 05:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `students_house`
--

CREATE TABLE `students_house` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `applicantid` int(11) NOT NULL,
  `admssion_roll` int(11) DEFAULT NULL,
  `admittedtypeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students_house`
--

INSERT INTO `students_house` (`id`, `programofferid`, `applicantid`, `admssion_roll`, `admittedtypeid`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 19100001, NULL, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(2, 2, 19100002, NULL, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(3, 2, 19100003, NULL, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(4, 2, 19100004, NULL, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(5, 2, 19100005, NULL, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(6, 2, 19100006, NULL, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(7, 2, 19100007, NULL, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(8, 1, 19060001, NULL, 1, 0, '2019-08-22 05:47:20', '2019-08-22 05:47:20'),
(9, 1, 19060002, NULL, 1, 0, '2019-08-23 23:45:52', '2019-08-23 23:45:52'),
(11, 1, 19060003, NULL, 1, 0, '2019-08-23 23:48:35', '2019-08-23 23:48:35'),
(12, 1, 19060004, NULL, 1, 0, '2019-08-25 05:40:27', '2019-08-25 05:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `coursetypeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `studentid`, `courseid`, `coursetypeid`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(2, 1, 2, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(3, 1, 3, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(4, 1, 4, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(5, 1, 5, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(6, 1, 6, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(7, 1, 7, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(8, 1, 8, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(9, 1, 9, 2, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(10, 1, 10, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(11, 1, 11, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(12, 1, 12, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(13, 1, 13, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(14, 1, 14, 3, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(15, 1, 15, 3, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(16, 2, 1, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(17, 2, 2, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(18, 2, 3, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(19, 2, 4, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(20, 2, 5, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(21, 2, 6, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(22, 2, 7, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(23, 2, 8, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(24, 2, 9, 2, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(25, 2, 10, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(26, 2, 11, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(27, 2, 12, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(28, 2, 13, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(29, 2, 14, 3, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(30, 2, 15, 3, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(31, 3, 1, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(32, 3, 2, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(33, 3, 3, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(34, 3, 4, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(35, 3, 5, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(36, 3, 6, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(37, 3, 7, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(38, 3, 8, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(39, 3, 9, 2, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(40, 3, 10, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(41, 3, 11, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(42, 3, 12, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(43, 3, 13, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(44, 3, 14, 3, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(45, 3, 15, 3, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(46, 4, 1, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(47, 4, 2, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(48, 4, 3, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(49, 4, 4, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(50, 4, 5, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(51, 4, 6, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(52, 4, 7, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(53, 4, 8, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(54, 4, 9, 2, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(55, 4, 10, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(56, 4, 11, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(57, 4, 12, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(58, 4, 13, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(59, 4, 14, 3, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(60, 4, 15, 3, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(61, 5, 1, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(62, 5, 2, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(63, 5, 3, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(64, 5, 4, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(65, 5, 5, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(66, 5, 6, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(67, 5, 7, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(68, 5, 8, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(69, 5, 9, 2, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(70, 5, 10, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(71, 5, 11, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(72, 5, 12, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(73, 5, 13, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(74, 5, 14, 3, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(75, 5, 15, 3, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(76, 6, 1, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(77, 6, 2, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(78, 6, 3, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(79, 6, 4, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(80, 6, 5, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(81, 6, 6, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(82, 6, 7, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(83, 6, 8, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(84, 6, 9, 2, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(85, 6, 10, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(86, 6, 11, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(87, 6, 12, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(88, 6, 13, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(89, 6, 14, 3, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(90, 6, 15, 3, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(91, 7, 1, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(92, 7, 2, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(93, 7, 3, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(94, 7, 4, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(95, 7, 5, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(96, 7, 6, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(97, 7, 7, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(98, 7, 8, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(99, 7, 9, 2, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(100, 7, 10, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(101, 7, 11, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(102, 7, 12, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(103, 7, 13, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(104, 7, 14, 3, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(105, 7, 15, 3, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14'),
(106, 1, 11, 1, 0, '2019-08-22 05:47:21', '2019-08-22 05:47:21'),
(107, 1, 12, 1, 0, '2019-08-22 05:47:21', '2019-08-22 05:47:21'),
(108, 1, 13, 1, 0, '2019-08-22 05:47:21', '2019-08-22 05:47:21'),
(109, 2, 11, 1, 0, '2019-08-23 23:45:52', '2019-08-23 23:45:52'),
(110, 2, 12, 1, 0, '2019-08-23 23:45:52', '2019-08-23 23:45:52'),
(111, 2, 13, 1, 0, '2019-08-23 23:45:52', '2019-08-23 23:45:52'),
(112, 3, 11, 1, 0, '2019-08-23 23:48:35', '2019-08-23 23:48:35'),
(113, 3, 12, 1, 0, '2019-08-23 23:48:35', '2019-08-23 23:48:35'),
(114, 3, 13, 1, 0, '2019-08-23 23:48:35', '2019-08-23 23:48:35'),
(115, 4, 11, 1, 0, '2019-08-25 05:40:27', '2019-08-25 05:40:27'),
(116, 4, 12, 1, 0, '2019-08-25 05:40:27', '2019-08-25 05:40:27'),
(117, 4, 13, 2, 0, '2019-08-25 05:40:27', '2019-08-25 05:40:27'),
(118, 4, 14, 1, 0, '2019-08-25 05:40:27', '2019-08-25 05:40:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_child_exam`
--

CREATE TABLE `tbl_child_exam` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `mst_examnameid` int(11) NOT NULL,
  `child_examnameid` int(11) NOT NULL,
  `hld_marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thanas`
--

CREATE TABLE `thanas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bangla_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `districtid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `name`, `bangla_name`, `districtid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amtali ', ' ?????', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(2, 'Bamna ', ' ?????', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(3, 'Barguna Sadar ', ' ?????? ???', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(4, 'Betagi ', ' ??????', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(5, 'Patharghata ', ' ????????', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(6, 'Taltali ', ' ??????', 1, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(7, 'Muladi ', ' ??????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(8, 'Babuganj ', ' ????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(9, 'Agailjhara ', ' ????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(10, 'Barisal Sadar ', ' ?????? ???', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(11, 'Bakerganj ', ' ?????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(12, 'Banaripara ', ' ??????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(13, 'Gaurnadi ', ' ??????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(14, 'Hizla ', ' ?????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(15, 'Mehendiganj ', ' ??????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(16, 'Wazirpur ', ' ?????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(17, 'Airport ', ' ?????????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(18, 'Kawnia ', ' ???????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(19, 'Bondor ', ' ?????', 2, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(20, 'Bhola Sadar ', ' ???? ???', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(21, 'Burhanuddin ', ' ????????????', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(22, 'Char Fasson ', ' ?? ??????', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(23, 'Daulatkhan ', ' ???????', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(24, 'Lalmohan ', ' ???????', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(25, 'Manpura ', ' ??????', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(26, 'Tazumuddin ', ' ???????????', 3, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(27, 'Jhalokati Sadar ', ' ??????? ???', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(28, 'Kathalia ', ' ?????????', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(29, 'Nalchity ', ' ???????', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(30, 'Rajapur ', ' ???????', 4, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(31, 'Bauphal ', ' ?????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(32, 'Dashmina ', ' ??????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(33, 'Galachipa ', ' ???????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(34, 'Kalapara ', ' ????????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(35, 'Mirzaganj ', ' ??????????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(36, 'Patuakhali Sadar ', ' ????????? ???', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(37, 'Dumki ', ' ?????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(38, 'Rangabali ', ' ??????????', 5, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(39, 'Bhandaria ', ' ????????????', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(40, 'Kaukhali ', ' ???????', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(41, 'Mathbaria ', ' ?????????', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(42, 'Nazirpur ', ' ????????', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(43, 'Nesarabad ', ' ?????????', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(44, 'Pirojpur Sadar ', ' ???????? ???', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(45, 'Zianagar ', ' ???????', 6, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(46, 'Bandarban Sadar ', ' ???????? ???', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(47, 'Thanchi ', ' ?????', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(48, 'Lama ', ' ????', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(49, 'Naikhongchhari ', ' ????????', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(50, 'Ali kadam ', ' ??? ???', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(51, 'Rowangchhari ', ' ????????', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(52, 'Ruma ', ' ????', 7, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(53, 'Brahmanbaria Sadar ', ' ?????????????? ???', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(54, 'Ashuganj ', ' ???????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(55, 'Nasirnagar ', ' ????? ???', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(56, 'Nabinagar ', ' ??????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(57, 'Sarail ', ' ?????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(58, 'Shahbazpur Town ', ' ????????? ????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(59, 'Kasba ', ' ????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(60, 'Akhaura ', ' ??????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(61, 'Bancharampur ', ' ????????????', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(62, 'Bijoynagar ', ' ???? ???', 8, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(63, 'Chandpur Sadar ', ' ??????? ???', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(64, 'Faridganj ', ' ????????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(65, 'Haimchar ', ' ??????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(66, 'Haziganj ', ' ????????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(67, 'Kachua ', ' ?????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(68, 'Matlab Uttar ', ' ???? ?????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(69, 'Matlab Dakkhin ', ' ???? ??????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(70, 'Shahrasti ', ' ?????????', 9, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(71, 'Anwara ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(72, 'Banshkhali ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(73, 'Boalkhali ', ' ?????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(74, 'Chandanaish ', ' ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(75, 'Fatikchhari ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(76, 'Hathazari ', ' ?????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(77, 'Lohagara ', ' ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(78, 'Mirsharai ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(79, 'Patiya ', ' ?????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(80, 'Rangunia ', ' ??????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(81, 'Raozan ', ' ??????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(82, 'Sandwip ', ' ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(83, 'Satkania ', ' ?????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(84, 'Sitakunda ', ' ?????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(85, 'Akborsha ', ' Akborsha', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(86, 'Baijid bostami ', ' ?????? ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(87, 'Bakolia ', ' ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(88, 'Bandar ', ' ?????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(89, 'Chandgaon ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(90, 'Chokbazar ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(91, 'Doublemooring ', ' ???? ?????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(92, 'EPZ ', ' ??????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(93, 'Hali Shohor ', ' ??? ???', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(94, 'Kornafuli ', ' ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(95, 'Kotwali ', ' ?????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(96, 'Kulshi ', ' ?????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(97, 'Pahartali ', ' ?????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(98, 'Panchlaish ', ' ????????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(99, 'Potenga ', ' ???????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(100, 'Shodhorgat ', ' ??????', 10, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(101, 'Barura ', ' ?????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(102, 'Brahmanpara ', ' ????????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(103, 'Burichong ', ' ??????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(104, 'Chandina ', ' ????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(105, 'Chauddagram ', ' ??????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(106, 'Daudkandi ', ' ??????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(107, 'Debidwar ', ' ?????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(108, 'Homna ', ' ?????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(109, 'Comilla Sadar ', ' ???????? ???', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(110, 'Laksam ', ' ??????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(111, 'Monohorgonj ', ' ?????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(112, 'Meghna ', ' ?????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(113, 'Muradnagar ', ' ????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(114, 'Nangalkot ', ' ??????????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(115, 'Comilla Sadar South ', ' ???????? ??? ??????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(116, 'Titas ', ' ?????', 11, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(117, 'Chakaria ', ' ??????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(118, 'Chakaria ', ' ??????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(119, 'Cox\'s Bazar Sadar ', ' ???? ????? ???', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(120, 'Kutubdia ', ' ?????????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(121, 'Maheshkhali ', ' ????????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(122, 'Ramu ', ' ????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(123, 'Teknaf ', ' ??????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(124, 'Ukhia ', ' ?????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(125, 'Pekua ', ' ??????', 12, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(126, 'Feni Sadar ', ' ???? ???', 13, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(127, 'Chagalnaiya ', ' ???? ?????', 13, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(128, 'Daganbhyan ', ' ?????????', 13, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(129, 'Parshuram ', ' ???????', 13, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(130, 'Fhulgazi ', ' ???????', 13, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(131, 'Sonagazi ', ' ????????', 13, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(132, 'Dighinala ', ' ????????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(133, 'Khagrachhari ', ' ????????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(134, 'Lakshmichhari ', ' ??????????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(135, 'Mahalchhari ', ' ??????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(136, 'Manikchhari ', ' ????????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(137, 'Matiranga ', ' ??????????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(138, 'Panchhari ', ' ??????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(139, 'Ramgarh ', ' ?????', 14, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(140, 'Lakshmipur Sadar ', ' ?????????? ???', 15, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(141, 'Raipur ', ' ??????', 15, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(142, 'Ramganj ', ' ???????', 15, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(143, 'Ramgati ', ' ??????', 15, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(144, 'Komol Nagar ', ' ??? ???', 15, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(145, 'Noakhali Sadar ', ' ???????? ???', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(146, 'Begumganj ', ' ????????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(147, 'Chatkhil ', ' ??????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(148, 'Companyganj ', ' ????????????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(149, 'Shenbag ', ' ??????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(150, 'Hatia ', ' ??????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(151, 'Kobirhat ', ' ???????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(152, 'Sonaimuri ', ' ?????????', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(153, 'Suborno Char ', ' ?????? ??', 16, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(154, 'Rangamati Sadar ', ' ?????????? ???', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(155, 'Belaichhari ', ' ????????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(156, 'Bagaichhari ', ' ????????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(157, 'Barkal ', ' ????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(158, 'Juraichhari ', ' ????????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(159, 'Rajasthali ', ' ?????????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(160, 'Kaptai ', ' ???????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(161, 'Langadu ', ' ????????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(162, 'Nannerchar ', ' ?????????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(163, 'Kaukhali ', ' ???????', 17, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(164, 'Adabor ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(165, 'Airport ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(166, 'Badda ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(167, 'Banani ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(168, 'Bangshal ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(169, 'Bhashantek ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(170, 'Cantonment ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(171, 'Chackbazar ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(172, 'Darussalam ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(173, 'Daskhinkhan ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(174, 'Demra ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(175, 'Dhamrai ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(176, 'Dhanmondi ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(177, 'Dohar ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(178, 'Gandaria ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(179, 'Gulshan ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(180, 'Hazaribag ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(181, 'Jatrabari ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(182, 'Kafrul ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(183, 'Kalabagan ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(184, 'Kamrangirchar ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(185, 'Keraniganj ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(186, 'Khilgaon ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(187, 'Khilkhet ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(188, 'Kotwali ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(189, 'Lalbag ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(190, 'Mirpur Model ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(191, 'Mohammadpur ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(192, 'Motijheel ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(193, 'Mugda ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(194, 'Nawabganj ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(195, 'New Market ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(196, 'Pallabi ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(197, 'Paltan ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(198, 'Ramna ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(199, 'Rampura ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(200, 'Rupnagar ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(201, 'Sabujbag ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(202, 'Savar ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(203, 'Shah Ali ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(204, 'Shahbag ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(205, 'Shahjahanpur ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(206, 'Sherebanglanagar ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(207, 'Shyampur ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(208, 'Sutrapur ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(209, 'Tejgaon ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(210, 'Tejgaon I/A ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(211, 'Turag ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(212, 'Uttara ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(213, 'Uttara West ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(214, 'Uttarkhan ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(215, 'Vatara ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(216, 'Wari ', ' null', 18, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(217, 'Faridpur Sadar ', ' ??????? ???', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(218, 'Boalmari ', ' ?????????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(219, 'Alfadanga ', ' ??????????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(220, 'Madhukhali ', ' ???????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(221, 'Bhanga ', ' ??????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(222, 'Nagarkanda ', ' ????????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(223, 'Charbhadrasan ', ' ?????????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(224, 'Sadarpur ', ' ??????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(225, 'Shaltha ', ' ?????', 19, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(226, 'Gazipur Sadar', ' ??????? ???', 20, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(227, 'Kaliakior ', ' ?????????', 20, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(228, 'Kapasia ', ' ????????', 20, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(229, 'Sripur ', ' ???????', 20, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(230, 'Kaliganj ', ' ????????', 20, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(231, 'Tongi ', ' ?????', 20, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(232, 'Gopalganj Sadar ', ' ????????? ???', 21, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(233, 'Kashiani ', ' ????????', 21, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(234, 'Kotalipara ', ' ??????????', 21, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(235, 'Muksudpur ', ' ?????????', 21, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(236, 'Tungipara ', ' ??????????', 21, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(237, 'Astagram ', ' ?????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(238, 'Bajitpur ', ' ????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(239, 'Bhairab ', ' ????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(240, 'Hossainpur ', ' ????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(241, 'Itna ', ' ????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(242, 'Karimganj ', ' ????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(243, 'Katiadi ', ' ???????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(244, 'Kishoreganj Sadar ', ' ????????? ???', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(245, 'Kuliarchar ', ' ?????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(246, 'Mithamain ', ' ????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(247, 'Nikli ', ' ?????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(248, 'Pakundia ', ' ????????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(249, 'Tarail ', ' ??????', 22, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(250, 'Madaripur Sadar ', ' ????????? ???', 23, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(251, 'Kalkini ', ' ???????', 23, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(252, 'Rajoir ', ' ?????', 23, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(253, 'Shibchar ', ' ?????', 23, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(254, 'Manikganj Sadar ', ' ????????? ???', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(255, 'Singair ', ' ????????', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(256, 'Shibalaya ', ' ??????', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(257, 'Saturia ', ' ????????', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(258, 'Harirampur ', ' ?????????', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(259, 'Ghior ', ' ????', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(260, 'Daulatpur ', ' ???????', 24, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(261, 'Lohajang ', ' ??????', 25, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(262, 'Sreenagar ', ' ???????', 25, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(263, 'Munshiganj Sadar ', ' ?????????? ???', 25, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(264, 'Sirajdikhan ', ' ??????????', 25, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(265, 'Tongibari ', ' ?????????', 25, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(266, 'Gazaria ', ' ???????', 25, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(267, 'Araihazar ', ' ?????????', 26, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(268, 'Sonargaon ', ' ?????????', 26, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(269, 'Bandar ', ' ???????', 26, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(270, 'Naryanganj Sadar ', ' ??????????? ???', 26, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(271, 'Rupganj ', ' ???????', 26, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(272, 'Siddirgonj ', ' ???????????', 26, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(273, 'Belabo ', ' ??????', 27, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(274, 'Monohardi ', ' ???????', 27, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(275, 'Narsingdi Sadar ', ' ??????? ???', 27, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(276, 'Palash ', ' ????', 27, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(277, 'Raipura , Narsingdi ', ' ??????', 27, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(278, 'Shibpur ', ' ??????', 27, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(279, 'Baliakandi ', ' ????????????', 28, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(280, 'Goalandaghat ', ' ???????? ???', 28, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(281, 'Pangsha ', ' ?????', 28, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(282, 'Kalukhali ', ' ????????', 28, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(283, 'Rajbari Sadar ', ' ??????? ???', 28, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(284, 'Shariatpur Sadar ', ' ???????? ???', 29, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(285, 'Damudya ', ' ????????', 29, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(286, 'Naria ', ' ?????', 29, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(287, 'Jajira ', ' ??????', 29, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(288, 'Bhedarganj ', ' ?????????', 29, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(289, 'Gosairhat ', ' ?????? ???', 29, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(290, 'Tangail Sadar ', ' ???????? ???', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(291, 'Sakhipur ', ' ??????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(292, 'Basail ', ' ?????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(293, 'Madhupur ', ' ??????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(294, 'Ghatail ', ' ??????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(295, 'Kalihati ', ' ????????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(296, 'Nagarpur ', ' ??????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(297, 'Mirzapur ', ' ?????????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(298, 'Gopalpur ', ' ????????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(299, 'Delduar ', ' ????????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(300, 'Bhuapur ', ' ???????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(301, 'Dhanbari ', ' ???????', 30, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(302, 'Bagerhat Sadar ', ' ???????? ???', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(303, 'Chitalmari ', ' ????????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(304, 'Fakirhat ', ' ???????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(305, 'Kachua ', ' ?????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(306, 'Mollahat ', ' ?????????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(307, 'Mongla ', ' ????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(308, 'Morrelganj ', ' ????????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(309, 'Rampal ', ' ??????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(310, 'Sarankhola ', ' ?????????', 31, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(311, 'Damurhuda ', ' ?????????', 32, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(312, 'Chuadanga', ' ?????????? ???', 32, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(313, 'Jibannagar ', ' ???? ???', 32, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(314, 'Alamdanga ', ' ?????????', 32, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(315, 'Abhaynagar ', ' ??????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(316, 'Keshabpur ', ' ???????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(317, 'Bagherpara ', ' ????? ????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(318, 'Jessore Sadar ', ' ???? ???', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(319, 'Chaugachha ', ' ??????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(320, 'Manirampur ', ' ?????????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(321, 'Jhikargachha ', ' ????????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(322, 'Sharsha ', ' ?????', 33, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(323, 'Jhenaidah Sadar ', ' ??????? ???', 34, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(324, 'Maheshpur ', ' ???????', 34, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(325, 'Kaliganj ', ' ????????', 34, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(326, 'Kotchandpur ', ' ??? ???????', 34, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(327, 'Shailkupa ', ' ???????', 34, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(328, 'Harinakunda ', ' ????????????', 34, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(329, 'Terokhada ', ' ????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(330, 'Batiaghata ', ' ??????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(331, 'Dacope ', ' ?????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(332, 'Dumuria ', ' ????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(333, 'Dighalia ', ' ???????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(334, 'Koyra ', ' ????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(335, 'Paikgachha ', ' ????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(336, 'Phultala ', ' ??????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(337, 'Rupsa ', ' ?????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(338, 'Aranghata ', ' ?????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(339, 'Daulatpur ', ' ???????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(340, 'Harintana ', ' ??????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(341, 'Horintana ', ' ????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(342, 'Khalishpur ', ' ????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(343, 'Khanjahan Ali ', ' ???????? ???', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(344, 'Khulna Sadar ', ' ????? ???', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(345, 'Labanchora ', ' ?????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(346, 'Sonadanga ', ' ??????????', 35, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(347, 'Kushtia Sadar ', ' ???????? ???', 36, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(348, 'Kumarkhali ', ' ?????????', 36, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(349, 'Daulatpur ', ' ???????', 36, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(350, 'Mirpur ', ' ??????', 36, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(351, 'Bheramara ', ' ????????', 36, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(352, 'Khoksa ', ' ?????', 36, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(353, 'Magura Sadar ', ' ?????? ???', 37, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(354, 'Mohammadpur ', ' ????????????', 37, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(355, 'Shalikha ', ' ??????', 37, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(356, 'Sreepur ', ' ???????', 37, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(357, 'Gangni ', ' ????', 38, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(358, 'Mujib Nagar ', ' ????? ???', 38, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(359, 'Meherpur', ' ???????? ???', 38, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(360, 'Narail', ' ????? ???', 39, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(361, 'Lohagara Upazilla ', ' ????????', 39, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(362, 'Kalia Upazilla ', ' ??????', 39, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(363, 'Noragati', '', 39, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(364, 'Satkhira Sadar ', ' ????????? ???', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(365, 'Assasuni ', ' ????????', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(366, 'Debhata ', ' ??????', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(367, 'Tala ', ' ????', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(368, 'Kalaroa ', ' ??????', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(369, 'Kaliganj ', ' ????????', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(370, 'Shyamnagar ', ' ????????', 40, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(371, 'Dewanganj ', ' ??????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(372, 'Baksiganj ', ' ????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(373, 'Islampur ', ' ????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(374, 'Jamalpur Sadar ', ' ???????? ???', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(375, 'Madarganj ', ' ?????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(376, 'Melandaha ', ' ?????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(377, 'Sarishabari ', ' ?????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(378, 'Narundi Police I.C ', ' ????????', 41, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(379, 'Bhaluka ', ' ??????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(380, 'Trishal ', ' ???????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(381, 'Haluaghat ', ' ?????????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(382, 'Muktagachha ', ' ??????????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(383, 'Dhobaura ', ' ???????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(384, 'Fulbaria ', ' ?????????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(385, 'Gaffargaon ', ' ???????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(386, 'Gauripur ', ' ???????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(387, 'Ishwarganj ', ' ?????????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(388, 'Mymensingh Sadar ', ' ??????? ???', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(389, 'Nandail ', ' ???????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(390, 'Phulpur ', ' ??????', 42, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(391, 'Kendua Upazilla ', ' ????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(392, 'Atpara Upazilla ', ' ??????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(393, 'Barhatta Upazilla ', ' ????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(394, 'Durgapur Upazilla ', ' ?????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(395, 'Kalmakanda Upazilla ', ' ??????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(396, 'Madan Upazilla ', ' ???', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(397, 'Mohanganj Upazilla ', ' ????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(398, 'Netrakona', ' ????????? ???', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(399, 'Purbadhala Upazilla ', ' ????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(400, 'Khaliajuri Upazilla ', ' ??????????', 43, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(401, 'Jhenaigati ', ' ?????????', 44, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(402, 'Nakla ', ' ?????', 44, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(403, 'Nalitabari ', ' ??????????', 44, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(404, 'Sherpur Sadar ', ' ?????? ???', 44, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(405, 'Sreebardi ', ' ????????', 44, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(406, 'Adamdighi ', ' ???????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(407, 'Bogra Sadar ', ' ????? ???', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(408, 'Sherpur ', ' ??????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(409, 'Dhunat ', ' ????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(410, 'Dhupchanchia ', ' ?????????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(411, 'Gabtali ', ' ??????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(412, 'Kahaloo ', ' ??????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(413, 'Nandigram ', ' ??????????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(414, 'Sahajanpur ', ' ???????????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(415, 'Sariakandi ', ' ????????????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(416, 'Shibganj ', ' ???????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(417, 'Sonatala ', ' ???????', 45, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(418, 'Joypurhat S ', ' ???????? ???', 46, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(419, 'Akkelpur ', ' ?????????', 46, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(420, 'Kalai ', ' ?????', 46, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(421, 'Khetlal ', ' ??????', 46, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(422, 'Panchbibi ', ' ????????', 46, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(423, 'Naogaon Sadar ', ' ????? ???', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(424, 'Mohadevpur ', ' ?????????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(425, 'Manda ', ' ??????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(426, 'Niamatpur ', ' ?????????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(427, 'Atrai ', ' ??????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(428, 'Raninagar ', ' ???????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(429, 'Patnitala ', ' ????????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(430, 'Dhamoirhat ', ' ????????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(431, 'Sapahar ', ' ???????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(432, 'Porsha ', ' ?????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(433, 'Badalgachhi ', ' ???????', 47, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(434, 'Natore Sadar ', ' ????? ???', 48, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(435, 'Baraigram ', ' ?????????', 48, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(436, 'Bagatipara ', ' ??????????', 48, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(437, 'Lalpur ', ' ??????', 48, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(438, 'Natore Sadar ', ' ????? ???', 48, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(439, 'Baraigram ', ' ???? ?????', 48, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(440, 'Bholahat ', ' ???????', 49, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(441, 'Gomastapur ', ' ??????????', 49, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(442, 'Nachole ', ' ?????', 49, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(443, 'Nawabganj Sadar ', ' ???????? ???', 49, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(444, 'Shibganj ', ' ???????', 49, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(445, 'Atgharia ', ' ???????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(446, 'Bera ', ' ????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(447, 'Bhangura ', ' ????????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(448, 'Chatmohar ', ' ???????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(449, 'Faridpur ', ' ???????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(450, 'Ishwardi ', ' ???????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(451, 'Pabna Sadar ', ' ????? ???', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(452, 'Santhia ', ' ??????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(453, 'Sujanagar ', ' ???????', 50, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(454, 'Bagha ', ' ????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(455, 'Bagmara ', ' ???????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(456, 'Charghat ', ' ??????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(457, 'Durgapur ', ' ?????????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(458, 'Godagari ', ' ????????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(459, 'Mohanpur ', ' ???????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(460, 'Paba ', ' ???', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(461, 'Puthia ', ' ??????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(462, 'Tanore ', ' ?????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(463, 'Boalia ', ' ??????????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(464, 'Motihar ', ' ??????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(465, 'Shahmokhdum ', ' ???? ??????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(466, 'Rajpara ', ' ???????', 51, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(467, 'Sirajganj Sadar ', ' ????????? ???', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(468, 'Belkuchi ', ' ???????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(469, 'Chauhali ', ' ??????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(470, 'Kamarkhanda ', ' ???????????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(471, 'Kazipur ', ' ???????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(472, 'Raiganj ', ' ???????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(473, 'Shahjadpur ', ' ?????????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(474, 'Tarash ', ' ?????', 52, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(475, 'Birampur ', ' ????????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(476, 'Birganj ', ' ???????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(477, 'Biral ', ' ?????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(478, 'Bochaganj ', ' ????????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(479, 'Chirirbandar ', ' ??????????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(480, 'Phulbari ', ' ???????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(481, 'Ghoraghat ', ' ???????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(482, 'Hakimpur ', ' ????????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(483, 'Kaharole ', ' ???????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(484, 'Khansama ', ' ???????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(485, 'Dinajpur Sadar ', ' ???????? ???', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(486, 'Nawabganj ', ' ????????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(487, 'Parbatipur ', ' ??????????', 53, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(488, 'Fulchhari ', ' ??????', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(489, 'Gaibandha sadar ', ' ????????? ???', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(490, 'Gobindaganj ', ' ???????????', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(491, 'Palashbari ', ' ????????', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(492, 'Sadullapur ', ' ???????????', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(493, 'Saghata ', ' ??????', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(494, 'Sundarganj ', ' ??????????', 54, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(495, 'Kurigram Sadar ', ' ????????? ???', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(496, 'Nageshwari ', ' ?????????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(497, 'Bhurungamari ', ' ????????????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(498, 'Phulbari ', ' ???????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(499, 'Rajarhat ', ' ????????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(500, 'Ulipur ', ' ??????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(501, 'Chilmari ', ' ???????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(502, 'Rowmari ', ' ??????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(503, 'Char Rajibpur ', ' ?? ????????', 55, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(504, 'Lalmanirhat Sadar ', ' ?????????? ???', 56, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(505, 'Aditmari ', ' ????????', 56, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(506, 'Kaliganj ', ' ????????', 56, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(507, 'Hatibandha ', ' ??????????', 56, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(508, 'Patgram ', ' ????????', 56, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(509, 'Nilphamari Sadar ', ' ????????? ???', 57, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(510, 'Saidpur ', ' ???????', 57, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(511, 'Jaldhaka ', ' ??????', 57, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(512, 'Kishoreganj ', ' ?????????', 57, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(513, 'Domar ', ' ?????', 57, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(514, 'Dimla ', ' ?????', 57, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(515, 'Panchagarh Sadar ', ' ?????? ???', 58, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(516, 'Debiganj ', ' ????????', 58, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(517, 'Boda ', ' ????', 58, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(518, 'Atwari ', ' ???????', 58, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(519, 'Tetulia ', ' ????????', 58, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(520, 'Badarganj ', ' ???????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(521, 'Mithapukur ', ' ?????????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(522, 'Gangachara ', ' ????????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(523, 'Kaunia ', ' ???????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(524, 'Rangpur Sadar ', ' ????? ???', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(525, 'Pirgachha ', ' ???????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(526, 'Pirganj ', ' ???????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(527, 'Taraganj ', ' ????????', 59, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(528, 'Thakurgaon Sadar ', ' ????????? ???', 60, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(529, 'Pirganj ', ' ???????', 60, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(530, 'Baliadangi ', ' ????????????', 60, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(531, 'Haripur ', ' ??????', 60, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(532, 'Ranisankail ', ' ?????????', 60, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(533, 'Ajmiriganj ', ' ??????????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(534, 'Baniachang ', ' ????????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(535, 'Bahubal ', ' ??????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(536, 'Chunarughat ', ' ?????????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(537, 'Habiganj Sadar ', ' ??????? ???', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(538, 'Lakhai ', ' ???????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(539, 'Madhabpur ', ' ???????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(540, 'Nabiganj ', ' ???????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(541, 'Shaistagonj ', ' ????????????', 61, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(542, 'Moulvibazar Sadar ', ' ??????????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(543, 'Barlekha ', ' ??????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(544, 'Juri ', ' ????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(545, 'Kamalganj ', ' ?????????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(546, 'Kulaura ', ' ???????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(547, 'Rajnagar ', ' ??????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(548, 'Sreemangal ', ' ?????????', 62, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(549, 'Bishwamvarpur ', ' ????????????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(550, 'Chhatak ', ' ????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(551, 'Derai ', ' ?????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(552, 'Dharampasha ', ' ???????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(553, 'Dowarabazar ', ' ???????????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(554, 'Jagannathpur ', ' ??????????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(555, 'Jamalganj ', ' ?????????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(556, 'Sulla ', ' ??????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(557, 'Sunamganj Sadar ', ' ????????? ???', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(558, 'Shanthiganj ', ' ??????????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(559, 'Tahirpur ', ' ????????', 63, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(560, 'Sylhet Sadar ', ' ????? ???', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(561, 'Beanibazar ', ' ???????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(562, 'Bishwanath ', ' ????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(563, 'Dakshin Surma ', ' ?????? ?????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(564, 'Balaganj ', ' ????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(565, 'Companiganj ', ' ????????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(566, 'Fenchuganj ', ' ??????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(567, 'Golapganj ', ' ?????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(568, 'Gowainghat ', ' ?????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(569, 'Jaintiapur ', ' ????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(570, 'Kanaighat ', ' ????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(571, 'Zakiganj ', ' ????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(572, 'Nobigonj ', ' ???????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(573, 'Airport ', ' ??????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(574, 'Hazrat Shah Paran ', ' ???? ??? ????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(575, 'Jalalabad ', ' ?????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(576, 'Kowtali ', ' ?????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(577, 'Moglabazar ', ' ??????????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(578, 'Osmani Nagar ', ' ?????? ???', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00'),
(579, 'South Surma ', ' ?????? ?????', 64, 1, '2019-08-08 18:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Supper Admin', 'developer@gmail.com', NULL, '$2y$10$ND.vdRSrW30S3J6LEtAyb./PHHC8Z.6lDbZ9vZYqeVD3wTj/TkkJK', 'yXnZmkIdKt8wGyk3BkzWzSXehuVAZmHjTi5iIPwgXxGckgVjrpV5Ku6lWbC8', '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
(2, 'School(Admin)', 'school@gmail.com', NULL, '$2y$10$N8OvxtpiQ0BObJSa03.jEe4BV8qoO9QqUsW4yvumodeqa.Dno6682', 'SajEtXrrww8PXlDdbWdCY36zdalK8X4WP5EzR0pfBnu3CMn6rSS5wHzMoXuN', '2019-08-06 04:54:52', '2019-08-06 04:54:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissionresult`
--
ALTER TABLE `admissionresult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admissionresult_applicantid_subjectid_index` (`applicantid`,`subjectid`);

--
-- Indexes for table `admission_programs`
--
ALTER TABLE `admission_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admission_programs_programofferid_unique` (`programofferid`);

--
-- Indexes for table `admission_subjects`
--
ALTER TABLE `admission_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `applicants_applicantid_unique` (`applicantid`);

--
-- Indexes for table `app_start_end`
--
ALTER TABLE `app_start_end`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_accounts`
--
ALTER TABLE `bill_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bill_accounts_transactionid_unique` (`transactionid`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_exam_marks`
--
ALTER TABLE `child_exam_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courseoffer`
--
ALTER TABLE `courseoffer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_type`
--
ALTER TABLE `course_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educationinfo`
--
ALTER TABLE `educationinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_degree`
--
ALTER TABLE `education_degree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_employeeidno_unique` (`employeeidno`);

--
-- Indexes for table `employeestatus`
--
ALTER TABLE `employeestatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeetypes`
--
ALTER TABLE `employeetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_labels`
--
ALTER TABLE `employee_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employmentstatus`
--
ALTER TABLE `employmentstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_event_log`
--
ALTER TABLE `emp_event_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_log`
--
ALTER TABLE `event_log`
  ADD PRIMARY KEY (`sl`);

--
-- Indexes for table `exam_name`
--
ALTER TABLE `exam_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_letter`
--
ALTER TABLE `grade_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_point`
--
ALTER TABLE `grade_point`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_labels`
--
ALTER TABLE `institute_labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label_groups`
--
ALTER TABLE `label_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `label_programs`
--
ALTER TABLE `label_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_programs_programid_unique` (`programid`);

--
-- Indexes for table `localgovs`
--
ALTER TABLE `localgovs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maritalstatus`
--
ALTER TABLE `maritalstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark_categories`
--
ALTER TABLE `mark_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark_distribution`
--
ALTER TABLE `mark_distribution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_exam`
--
ALTER TABLE `master_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mearges`
--
ALTER TABLE `mearges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mediums`
--
ALTER TABLE `mediums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD UNIQUE KEY `menus_url_unique` (`url`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_exam_marks`
--
ALTER TABLE `mst_exam_marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `plabels`
--
ALTER TABLE `plabels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `postoffices`
--
ALTER TABLE `postoffices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programoffers`
--
ALTER TABLE `programoffers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program_groups`
--
ALTER TABLE `program_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotas`
--
ALTER TABLE `quotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD UNIQUE KEY `role_user_userid_unique` (`userid`);

--
-- Indexes for table `sectionoffer`
--
ALTER TABLE `sectionoffer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programofferid` (`programofferid`,`sectionid`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_course_teachers`
--
ALTER TABLE `section_course_teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_applicantid_unique` (`applicantid`);

--
-- Indexes for table `students_house`
--
ALTER TABLE `students_house`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_house_admssion_roll_unique` (`admssion_roll`),
  ADD KEY `students_house_programofferid_admssion_roll_index` (`programofferid`,`admssion_roll`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_child_exam`
--
ALTER TABLE `tbl_child_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thanas`
--
ALTER TABLE `thanas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admissionresult`
--
ALTER TABLE `admissionresult`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_programs`
--
ALTER TABLE `admission_programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admission_subjects`
--
ALTER TABLE `admission_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `app_start_end`
--
ALTER TABLE `app_start_end`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_accounts`
--
ALTER TABLE `bill_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `child_exam_marks`
--
ALTER TABLE `child_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courseoffer`
--
ALTER TABLE `courseoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `educationinfo`
--
ALTER TABLE `educationinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education_degree`
--
ALTER TABLE `education_degree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employeestatus`
--
ALTER TABLE `employeestatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employeetypes`
--
ALTER TABLE `employeetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_labels`
--
ALTER TABLE `employee_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employmentstatus`
--
ALTER TABLE `employmentstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emp_event_log`
--
ALTER TABLE `emp_event_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_log`
--
ALTER TABLE `event_log`
  MODIFY `sl` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_name`
--
ALTER TABLE `exam_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grade_letter`
--
ALTER TABLE `grade_letter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grade_point`
--
ALTER TABLE `grade_point`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute_labels`
--
ALTER TABLE `institute_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `label_groups`
--
ALTER TABLE `label_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `label_programs`
--
ALTER TABLE `label_programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localgovs`
--
ALTER TABLE `localgovs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `maritalstatus`
--
ALTER TABLE `maritalstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mark_categories`
--
ALTER TABLE `mark_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mark_distribution`
--
ALTER TABLE `mark_distribution`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `master_exam`
--
ALTER TABLE `master_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mearges`
--
ALTER TABLE `mearges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mediums`
--
ALTER TABLE `mediums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `mst_exam_marks`
--
ALTER TABLE `mst_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plabels`
--
ALTER TABLE `plabels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `postoffices`
--
ALTER TABLE `postoffices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programoffers`
--
ALTER TABLE `programoffers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `program_groups`
--
ALTER TABLE `program_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotas`
--
ALTER TABLE `quotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sectionoffer`
--
ALTER TABLE `sectionoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section_course_teachers`
--
ALTER TABLE `section_course_teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_house`
--
ALTER TABLE `students_house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `tbl_child_exam`
--
ALTER TABLE `tbl_child_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=580;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
