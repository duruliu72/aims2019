-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2019 at 02:34 PM
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
(1, 1, 1, 1, 1, '6300', 1, 'Rajuk Uttara Model College');

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
(7, 19100007, 'Nwzy6o', 'Durul', 'Kalam', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-01', NULL, NULL, NULL, 1, NULL, NULL, 1, 0, NULL, 1, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '19100007.png', '19100007_signature.jpg', NULL, NULL, '2019-08-08 00:08:14', '2019-08-08 00:08:14');

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
(1, 2, 1, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(2, 2, 2, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(3, 2, 3, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(4, 2, 4, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(5, 2, 5, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(6, 2, 6, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(7, 2, 7, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(8, 2, 8, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(9, 2, 9, 50.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(10, 2, 10, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(11, 2, 11, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(12, 2, 12, 100.00, NULL, NULL, '2019-08-07 05:42:36', '2019-08-07 05:42:36'),
(13, 1, 1, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(14, 1, 2, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(15, 1, 3, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(16, 1, 4, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(17, 1, 5, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(18, 1, 6, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(19, 1, 7, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(20, 1, 8, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(21, 1, 9, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(22, 1, 10, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(23, 1, 11, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(24, 1, 12, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(25, 1, 13, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(26, 1, 14, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(27, 1, 15, 100.00, NULL, NULL, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(28, 2, 13, 100.00, NULL, NULL, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(29, 2, 14, 150.00, NULL, NULL, '2019-08-07 23:38:42', '2019-08-07 23:38:42'),
(30, 2, 15, 100.00, NULL, NULL, '2019-08-07 23:38:42', '2019-08-07 23:38:42');

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
(1, 'Bangla 1st Paper', '102', 4, 0, '2019-08-06 05:26:34', '2019-08-06 05:26:34'),
(2, 'Bangla 2nd Paper', '103', 4, 0, '2019-08-06 05:36:01', '2019-08-06 05:36:01'),
(3, 'English 1st Paper', '201', 4, 0, '2019-08-06 05:36:22', '2019-08-06 05:36:22'),
(4, 'Math', '502', 4, 0, '2019-08-06 05:53:12', '2019-08-06 05:53:12'),
(5, 'Physics 1st Paper', '607', 4, 0, '2019-08-06 05:53:28', '2019-08-06 05:53:28'),
(6, 'Physics 2nd Paper', '709', 4, 0, '2019-08-06 05:53:39', '2019-08-06 05:53:39'),
(7, 'Social Science', '504', 4, 0, '2019-08-06 05:55:10', '2019-08-06 05:55:10'),
(8, 'Islam', '109', 4, 0, '2019-08-06 05:55:27', '2019-08-06 05:55:27'),
(9, 'ICT', '308', 4, 0, '2019-08-06 05:55:45', '2019-08-06 05:55:45'),
(10, 'Biology  1s Part', '203', 4, 0, '2019-08-06 05:56:42', '2019-08-06 05:56:42'),
(11, 'Biology 2nd Part', '306', 4, 0, '2019-08-06 05:57:08', '2019-08-06 05:57:08'),
(12, 'Chemistry 1st Part', '409', 4, 0, '2019-08-06 05:57:48', '2019-08-06 05:57:48'),
(13, 'Chemistry 2nd Part', '508', 4, 0, '2019-08-06 05:58:02', '2019-08-06 05:58:02'),
(14, 'History', '309', 4, 0, '2019-08-07 01:43:17', '2019-08-07 01:43:17'),
(15, 'Socila Sceince', '107', 4, 0, '2019-08-07 03:02:21', '2019-08-07 03:02:21');

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
(1, 'Chapainawabganj', 1, 0, '2019-08-06 04:19:57', '2019-08-06 04:19:57');

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
(1, 'Rajshahi', 0, '2019-08-06 04:11:19', '2019-08-06 04:11:19');

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
  `middle_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `employee_labels`
--

CREATE TABLE `employee_labels` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Rajuk Uttara Model College', '0172677777', NULL, 1, 1, NULL, 1, 'wordno1', 'Claster1', 1233456, 'institute_logo.png', 0, '2019-08-06 04:36:53', '2019-08-06 04:36:53');

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
(10, 1, 1, 0, '2019-08-07 02:55:14', '2019-08-07 02:55:14'),
(11, 1, 2, 0, '2019-08-07 02:55:14', '2019-08-07 02:55:14'),
(12, 1, 3, 0, '2019-08-07 02:55:14', '2019-08-07 02:55:14'),
(13, 1, 4, 0, '2019-08-07 02:55:14', '2019-08-07 02:55:14'),
(14, 1, 5, 0, '2019-08-07 02:55:14', '2019-08-07 02:55:14');

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
(1, 1, 3, 0, '2019-08-06 04:34:08', '2019-08-06 04:34:08'),
(2, 2, 3, 0, '2019-08-06 04:34:19', '2019-08-06 04:34:19'),
(3, 3, 3, 0, '2019-08-06 04:34:31', '2019-08-06 04:34:31'),
(4, 4, 1, 0, '2019-08-06 04:34:47', '2019-08-06 04:34:47'),
(5, 4, 4, 0, '2019-08-06 04:34:47', '2019-08-06 04:34:47'),
(6, 5, 1, 0, '2019-08-06 04:34:54', '2019-08-06 04:34:54'),
(7, 5, 2, 0, '2019-08-06 04:34:54', '2019-08-06 04:34:54');

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
(1, 'Chapainawabganj', 1, 0, '2019-08-06 04:25:11', '2019-08-06 04:25:11');

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
(12, 2, 9, 4, 10.00, 20, 25, 4, 0, '2019-08-08 03:31:40', '2019-08-08 03:31:40');

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
(1, 2, 1, 20.00, 100.00, 20.00, 1, 0, '2019-08-08 06:03:51', '2019-08-08 06:17:20');

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
(25, 'Edit Course Offer', 'editcourseoffer', 18, 100, 0, '2019-08-06 05:09:53', '2019-08-06 05:09:53'),
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
(49, 'Master Mark Edit', 'mstexammarkedit', 44, 100, 0, '2019-08-09 05:45:33', '2019-08-09 05:45:33');

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
  `teacherid` int(11) DEFAULT NULL,
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

INSERT INTO `mst_exam_marks` (`id`, `programofferid`, `sectionid`, `teacherid`, `studentid`, `courseid`, `examnameid`, `examtypeid`, `markcategoryid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, 1, 1, 1, 1, 1, 65.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(2, 2, 1, NULL, 1, 1, 1, 1, 2, 65.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(3, 2, 1, NULL, 1, 1, 1, 1, 4, 55.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(4, 2, 1, NULL, 2, 1, 1, 1, 1, 25.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(5, 2, 1, NULL, 2, 1, 1, 1, 2, 50.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(6, 2, 1, NULL, 2, 1, 1, 1, 4, 50.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(7, 2, 1, NULL, 3, 1, 1, 1, 1, 49.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(8, 2, 1, NULL, 3, 1, 1, 1, 2, 30.00, 0, '2019-08-09 04:30:33', '2019-08-09 04:30:33'),
(9, 2, 1, NULL, 3, 1, 1, 1, 4, 55.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(10, 2, 1, NULL, 4, 1, 1, 1, 1, 34.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(11, 2, 1, NULL, 4, 1, 1, 1, 2, 56.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(12, 2, 1, NULL, 4, 1, 1, 1, 4, 12.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(13, 2, 1, NULL, 5, 1, 1, 1, 1, 8.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(14, 2, 1, NULL, 5, 1, 1, 1, 2, 37.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(15, 2, 1, NULL, 5, 1, 1, 1, 4, 6.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(16, 2, 1, NULL, 6, 1, 1, 1, 1, 34.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(17, 2, 1, NULL, 6, 1, 1, 1, 2, 34.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(18, 2, 1, NULL, 6, 1, 1, 1, 4, 52.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(19, 2, 1, NULL, 7, 1, 1, 1, 1, 33.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(20, 2, 1, NULL, 7, 1, 1, 1, 2, 27.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34'),
(21, 2, 1, NULL, 7, 1, 1, 1, 4, 20.00, 0, '2019-08-09 04:30:34', '2019-08-09 04:30:34');

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
(1, 'Chapainawabganj', 1, 0, '2019-08-06 04:23:43', '2019-08-06 04:23:43');

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
(1, 1, 4, 2, 1, 1, 1, NULL, 250, 12, 0, '2019-08-06 05:04:46', '2019-08-06 05:06:41'),
(2, 1, 4, 1, 1, 1, 1, NULL, 210, 12, 0, '2019-08-06 05:14:14', '2019-08-06 05:45:22'),
(3, 1, 4, 1, 1, 1, 2, NULL, 100, 12, 0, '2019-08-09 00:07:19', '2019-08-09 00:07:19');

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
(1, 'Class X', 4, '10', 0, '2019-08-06 04:57:47', '2019-08-06 04:57:47'),
(2, 'Class IX', 4, '09', 0, '2019-08-06 04:58:05', '2019-08-06 04:58:05');

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
(1, 25, 1),
(1, 25, 2),
(1, 25, 3),
(1, 25, 4),
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
(1, 49, 4);

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
(1, 1, 1, 100, NULL, 0, '2019-08-06 05:04:46', '2019-08-06 05:04:46'),
(2, 1, 2, 100, NULL, 0, '2019-08-06 05:04:46', '2019-08-06 05:04:46'),
(3, 1, 3, 50, NULL, 0, '2019-08-06 05:06:41', '2019-08-06 05:06:41'),
(4, 2, 1, 100, NULL, 0, '2019-08-06 05:14:14', '2019-08-06 05:14:14'),
(5, 2, 2, 50, NULL, 0, '2019-08-06 05:43:05', '2019-08-06 05:43:05'),
(6, 2, 3, 60, NULL, 0, '2019-08-06 05:45:22', '2019-08-06 05:45:22'),
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
(67, 1, 1, 11, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(68, 1, 2, 11, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(69, 1, 3, 11, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(70, 1, 1, 12, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(71, 1, 2, 12, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
(72, 1, 3, 12, NULL, 0, '2019-08-07 06:01:40', '2019-08-07 06:01:40'),
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
(90, 2, 3, 15, NULL, 0, '2019-08-07 23:38:42', '2019-08-07 23:38:42');

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
(1, 0, 2, 1, 19100001, 1, 0, 0, 1, 1, 0, '2019-08-07 23:47:49', '2019-08-07 23:47:49'),
(2, 0, 2, 1, 19100002, 2, 0, 0, 1, 1, 0, '2019-08-07 23:55:50', '2019-08-07 23:55:50'),
(3, 0, 2, 1, 19100003, 3, 0, 0, 1, 1, 0, '2019-08-07 23:56:20', '2019-08-07 23:56:20'),
(4, 0, 2, 1, 19100004, 4, 0, 0, 1, 1, 0, '2019-08-07 23:56:36', '2019-08-07 23:56:36'),
(5, 0, 2, 1, 19100005, 5, 0, 0, 1, 1, 0, '2019-08-08 00:02:01', '2019-08-08 00:02:01'),
(6, 0, 2, 1, 19100006, 6, 0, 0, 1, 1, 0, '2019-08-08 00:08:09', '2019-08-08 00:08:09'),
(7, 0, 2, 1, 19100007, 7, 0, 0, 1, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14');

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
(7, 2, 19100007, NULL, 1, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14');

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
(105, 7, 15, 3, 0, '2019-08-08 00:08:14', '2019-08-08 00:08:14');

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
  `districtid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `thanas`
--

INSERT INTO `thanas` (`id`, `name`, `districtid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chapainawabganj', 1, 0, '2019-08-06 04:22:15', '2019-08-06 04:22:15');

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
(1, 'Supper Admin', 'developer@gmail.com', NULL, '$2y$10$ND.vdRSrW30S3J6LEtAyb./PHHC8Z.6lDbZ9vZYqeVD3wTj/TkkJK', 'UoWdajkjG0mMTXsZIZaloDeAAhx4xI5jn8GDkTSVhcHYOIzUl5p4pi9uia78', '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `child_exam_marks`
--
ALTER TABLE `child_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courseoffer`
--
ALTER TABLE `courseoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `educationinfo`
--
ALTER TABLE `educationinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education_degree`
--
ALTER TABLE `education_degree`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeestatus`
--
ALTER TABLE `employeestatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employeetypes`
--
ALTER TABLE `employeetypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_labels`
--
ALTER TABLE `employee_labels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employmentstatus`
--
ALTER TABLE `employmentstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_point`
--
ALTER TABLE `grade_point`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `label_groups`
--
ALTER TABLE `label_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mark_categories`
--
ALTER TABLE `mark_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mark_distribution`
--
ALTER TABLE `mark_distribution`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_exam`
--
ALTER TABLE `master_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students_house`
--
ALTER TABLE `students_house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_child_exam`
--
ALTER TABLE `tbl_child_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thanas`
--
ALTER TABLE `thanas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
