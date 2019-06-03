-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2019 at 10:58 AM
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
(1, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(2, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(3, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(4, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(5, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(6, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(7, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(8, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(9, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(10, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(11, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(12, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(13, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(14, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(15, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(16, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(17, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(18, 1, 2, 1, 1, '131234', 1, 'asdfasdf'),
(19, 1, 2, 1, 1, '131234', 1, '23452345'),
(20, 1, 2, 1, 1, '131234', 1, '23452345'),
(21, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(22, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(23, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(24, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(25, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(26, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(29, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(30, 1, 2, 1, 1, '131234', 1, 'Fokir para'),
(31, 1, 2, 1, 1, '1233', 1, 'DDD');

-- --------------------------------------------------------

--
-- Table structure for table `admissionapplicants`
--

CREATE TABLE `admissionapplicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `applicantid` int(11) NOT NULL,
  `admssion_roll` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissionapplicants`
--

INSERT INTO `admissionapplicants` (`id`, `programofferid`, `applicantid`, `admssion_roll`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 19100001, NULL, 0, '2019-05-08 00:23:16', '2019-05-08 00:23:16'),
(2, 1, 19100002, NULL, 0, '2019-05-08 00:23:27', '2019-05-08 00:23:27'),
(3, 1, 19100003, NULL, 0, '2019-05-08 02:10:45', '2019-05-08 02:10:45'),
(4, 1, 19100004, NULL, 0, '2019-05-08 02:10:50', '2019-05-08 02:10:50'),
(5, 1, 19100005, NULL, 0, '2019-05-08 02:32:06', '2019-05-08 02:32:06'),
(6, 1, 19100006, NULL, 0, '2019-05-08 02:32:11', '2019-05-08 02:32:11'),
(7, 1, 19100007, NULL, 0, '2019-05-08 02:33:53', '2019-05-08 02:33:53'),
(8, 1, 19100008, NULL, 0, '2019-05-08 02:38:35', '2019-05-08 02:38:35'),
(9, 1, 19100009, NULL, 0, '2019-05-08 02:39:16', '2019-05-08 02:39:16'),
(10, 2, 19100010, NULL, 0, '2019-05-08 04:10:56', '2019-05-08 04:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `admissionresult`
--

CREATE TABLE `admissionresult` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `applicantid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admissionresult`
--

INSERT INTO `admissionresult` (`id`, `programofferid`, `applicantid`, `subjectid`, `marks`, `created_at`, `updated_at`) VALUES
(1, 1, 19100001, 1, 23.00, '2019-05-29 02:00:21', '2019-05-29 02:00:21'),
(2, 1, 19100001, 2, 20.00, '2019-05-29 02:00:21', '2019-05-29 02:00:21'),
(3, 1, 19100001, 3, 20.00, '2019-05-29 02:00:21', '2019-05-29 02:00:21'),
(4, 1, 19100001, 4, 50.00, '2019-05-29 02:00:21', '2019-05-29 02:00:21'),
(5, 1, 19100002, 1, 20.00, '2019-05-29 02:12:33', '2019-05-29 02:12:33'),
(6, 1, 19100002, 2, 20.00, '2019-05-29 02:12:33', '2019-05-29 02:12:33'),
(7, 1, 19100002, 3, 20.00, '2019-05-29 02:12:33', '2019-05-29 02:12:33'),
(8, 1, 19100002, 4, 20.00, '2019-05-29 02:12:33', '2019-05-29 02:12:33'),
(9, 1, 19100003, 1, 20.00, '2019-05-29 02:39:23', '2019-05-29 02:39:23'),
(10, 1, 19100003, 2, 20.00, '2019-05-29 02:39:23', '2019-05-29 02:39:23'),
(11, 1, 19100003, 3, 20.00, '2019-05-29 02:39:23', '2019-05-29 02:39:23'),
(12, 1, 19100003, 4, 20.00, '2019-05-29 02:39:24', '2019-05-29 02:39:24'),
(13, 1, 19100004, 1, 25.00, '2019-05-29 23:01:25', '2019-05-29 23:01:25'),
(14, 1, 19100004, 2, 19.00, '2019-05-29 23:01:25', '2019-05-29 23:01:25'),
(15, 1, 19100004, 3, 23.00, '2019-05-29 23:01:25', '2019-05-29 23:01:25'),
(16, 1, 19100004, 4, 25.00, '2019-05-29 23:01:25', '2019-05-29 23:01:25'),
(17, 1, 19100005, 1, 34.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(18, 1, 19100005, 2, 15.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(19, 1, 19100005, 3, 59.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(20, 1, 19100005, 4, 49.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(21, 1, 19100006, 1, 39.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(22, 1, 19100006, 2, 12.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(23, 1, 19100006, 3, 15.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(24, 1, 19100006, 4, 15.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(25, 1, 19100007, 1, 13.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(26, 1, 19100007, 2, 13.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(27, 1, 19100007, 3, 13.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26'),
(28, 1, 19100007, 4, 13.00, '2019-05-29 23:02:26', '2019-05-29 23:02:26');

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

--
-- Dumping data for table `admission_programs`
--

INSERT INTO `admission_programs` (`id`, `programofferid`, `required_gpa`, `exam_marks`, `exam_date`, `exam_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3.25, 100.00, '2019-05-30', '12:30:00', 0, '2019-05-07 00:18:50', '2019-05-29 23:00:03'),
(2, 1, 3.98, 200.00, '2019-05-23', '12:15:00', 0, '2019-05-28 00:14:58', '2019-05-28 00:14:58');

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

--
-- Dumping data for table `admission_program_subjects`
--

INSERT INTO `admission_program_subjects` (`programofferid`, `subjectid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 40.00, 0, '2019-05-28 22:55:07', '2019-05-28 22:55:07'),
(1, 2, 20.00, 0, '2019-05-28 22:55:07', '2019-05-28 22:55:07'),
(1, 3, 60.00, 0, '2019-05-28 22:55:07', '2019-05-28 22:55:07'),
(1, 4, 50.00, 0, '2019-05-28 22:55:07', '2019-05-28 22:55:07'),
(2, 1, 40.00, 0, '2019-05-29 23:00:23', '2019-05-29 23:00:23'),
(2, 2, 30.00, 0, '2019-05-29 23:00:23', '2019-05-29 23:00:23'),
(2, 3, 30.00, 0, '2019-05-29 23:00:23', '2019-05-29 23:00:23'),
(2, 4, 30.00, 0, '2019-05-29 23:00:23', '2019-05-29 23:00:23');

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

--
-- Dumping data for table `admission_subjects`
--

INSERT INTO `admission_subjects` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2019-05-08 02:52:15', '2019-05-08 02:52:15'),
(2, 'English', 0, '2019-05-08 02:53:17', '2019-05-08 02:53:17'),
(3, 'Math', 0, '2019-05-26 23:35:56', '2019-05-26 23:35:56'),
(4, 'General Knowledge', 0, '2019-05-28 03:36:26', '2019-05-28 03:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `applicantid` int(11) NOT NULL,
  `pin_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 19100001, 'XGqnaM', 'Md.', 'Durul', 'Hoda', '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 2, 1, NULL, 1, NULL, NULL, 1, 2, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100001.png', NULL, NULL, NULL, '2019-05-08 00:23:16', '2019-05-08 00:23:16'),
(2, 19100002, 'nEJtUA', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 3, 4, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100002.png', NULL, NULL, NULL, '2019-05-08 00:23:27', '2019-05-08 00:23:27'),
(3, 19100003, '1z0VH6', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 2, 1, NULL, 1, NULL, NULL, 5, 6, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100003.png', NULL, NULL, NULL, '2019-05-08 02:10:45', '2019-05-08 02:10:45'),
(4, 19100004, 'rbXaNm', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 7, 8, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100004.png', NULL, NULL, NULL, '2019-05-08 02:10:50', '2019-05-08 02:10:50'),
(5, 19100005, '1c6Fqc', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 9, 10, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100005.png', NULL, NULL, NULL, '2019-05-08 02:32:06', '2019-05-08 02:32:06'),
(6, 19100006, 'CTdipA', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 11, 12, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100006.png', NULL, NULL, NULL, '2019-05-08 02:32:11', '2019-05-08 02:32:11'),
(7, 19100007, 'yCf5TA', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 13, 14, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100007.png', NULL, NULL, NULL, '2019-05-08 02:33:53', '2019-05-08 02:33:53'),
(8, 19100008, 'vONzpV', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 15, 16, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100008.png', NULL, NULL, NULL, '2019-05-08 02:38:35', '2019-05-08 02:38:35'),
(9, 19100009, 'R8ggJ6', 'Durul Hoda', NULL, NULL, '01272720772', NULL, 'Masu', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 17, 18, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100009.png', NULL, NULL, NULL, '2019-05-08 02:39:16', '2019-05-08 02:39:16'),
(10, 19100010, 'kM64cY', 'Rohim', NULL, NULL, '01272720772', NULL, 'Masu', 'Rohima', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30', NULL, NULL, NULL, 1, 0, NULL, 2, 1, NULL, 2, NULL, NULL, 19, 20, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100010.png', '19100010_signature.jpg', NULL, NULL, '2019-05-08 04:10:56', '2019-05-08 04:10:56');

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

--
-- Dumping data for table `app_start_end`
--

INSERT INTO `app_start_end` (`id`, `sessionid`, `app_startDate`, `app_endDate`, `examStartDate`, `exam_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-05-30 00:00:00', '2019-06-30 00:00:00', '2019-05-15', 0, 0, '2019-05-06 02:00:55', '2019-05-29 23:00:48');

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
(1, 'A+', 0, '2019-05-05 03:40:21', '2019-05-05 03:40:21'),
(2, 'AB+', 0, '2019-05-05 03:40:25', '2019-05-05 03:40:25'),
(3, 'AB-', 0, '2019-05-05 03:40:37', '2019-05-05 03:40:37');

-- --------------------------------------------------------

--
-- Table structure for table `child_exam`
--

CREATE TABLE `child_exam` (
  `id` int(10) UNSIGNED NOT NULL,
  `master_exam_id` int(11) NOT NULL,
  `examnameid` int(11) NOT NULL,
  `cxm_in_percentage` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_exam`
--

INSERT INTO `child_exam` (`id`, `master_exam_id`, `examnameid`, `cxm_in_percentage`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 5.00, 0, '2019-05-23 03:24:00', '2019-05-24 22:46:26'),
(2, 2, 2, 15.00, 0, '2019-05-23 03:40:18', '2019-05-24 22:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `child_exam_course`
--

CREATE TABLE `child_exam_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `child_exam_id` int(11) NOT NULL,
  `courseofferid` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_exam_course`
--

INSERT INTO `child_exam_course` (`id`, `child_exam_id`, `courseofferid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10.00, 0, '2019-05-23 03:24:00', '2019-05-23 03:24:00'),
(2, 1, 2, 10.00, 0, '2019-05-23 03:24:00', '2019-05-23 03:24:00'),
(3, 1, 3, 10.00, 0, '2019-05-23 03:24:00', '2019-05-23 03:24:00'),
(4, 2, 1, 10.00, 0, '2019-05-23 03:40:18', '2019-05-23 03:40:18'),
(5, 2, 2, 10.00, 0, '2019-05-23 03:40:18', '2019-05-23 03:40:18'),
(6, 2, 3, 10.00, 0, '2019-05-23 03:40:18', '2019-05-23 03:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `courseoffer`
--

CREATE TABLE `courseoffer` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `coursemark` double(8,2) DEFAULT NULL,
  `meargeid` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courseoffer`
--

INSERT INTO `courseoffer` (`id`, `programofferid`, `coursecodeid`, `coursemark`, `meargeid`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 100.00, NULL, '2019-05-20 00:33:19', '2019-05-20 00:33:19'),
(2, 2, 2, 120.00, 1, '2019-05-20 00:33:19', '2019-05-20 00:33:19'),
(3, 2, 3, 100.00, 1, '2019-05-20 00:33:19', '2019-05-20 00:33:19'),
(4, 1, 1, 100.00, NULL, '2019-06-01 23:04:01', '2019-06-01 23:04:01'),
(5, 1, 2, 100.00, NULL, '2019-06-01 23:04:01', '2019-06-01 23:04:01'),
(6, 1, 3, 100.00, NULL, '2019-06-01 23:04:01', '2019-06-01 23:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2019-05-20 00:11:24', '2019-05-20 00:11:24'),
(2, 'Bangla 1st Paper', 0, '2019-05-20 00:11:32', '2019-05-20 00:11:32'),
(3, 'Bangla 2nd Paper', 0, '2019-05-20 00:11:42', '2019-05-20 00:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `course_codes`
--

CREATE TABLE `course_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_codes`
--

INSERT INTO `course_codes` (`id`, `name`, `courseid`, `status`, `created_at`, `updated_at`) VALUES
(1, '101', 1, 0, '2019-05-20 00:12:59', '2019-05-20 00:12:59'),
(2, '102', 2, 0, '2019-05-20 00:13:11', '2019-05-20 00:13:11'),
(3, '107', 3, 0, '2019-05-20 00:13:19', '2019-05-20 00:13:19');

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
(1, 'Compulsory', 0, '2019-05-21 00:25:46', '2019-05-21 00:25:46'),
(2, 'Optional', 0, '2019-05-21 00:25:58', '2019-05-21 00:25:58'),
(3, 'Additional', 0, '2019-05-21 00:26:14', '2019-05-21 00:26:14');

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
(1, 'Rajshahi', 1, 0, '2019-05-05 03:25:23', '2019-05-05 03:26:18'),
(2, 'Chapi Nawabgonj', 1, 0, '2019-05-05 03:25:46', '2019-05-05 03:25:46');

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
(1, 'Rajshahi', 0, '2019-05-05 03:21:05', '2019-05-05 03:21:05'),
(2, 'Rongpur', 0, '2019-05-05 03:21:16', '2019-05-05 03:21:16');

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
(1, '1st Semi star', 1, 0, '2019-05-23 00:36:02', '2019-05-23 00:36:02'),
(2, 'CT', 2, 0, '2019-05-23 00:38:36', '2019-05-23 00:39:15'),
(3, 'MT', 2, 0, '2019-05-23 00:39:02', '2019-05-23 00:39:02');

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
(1, 'Male', 0, '2019-05-05 03:37:06', '2019-05-05 03:37:06'),
(2, 'Female', 0, '2019-05-05 03:37:15', '2019-05-05 03:37:15');

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
(1, 'A+', 0, '2019-05-20 23:43:01', '2019-05-20 23:43:01'),
(2, 'A', 0, '2019-05-20 23:43:09', '2019-05-20 23:43:09'),
(3, 'A-', 0, '2019-05-20 23:43:18', '2019-05-20 23:43:18'),
(4, 'C', 0, '2019-05-22 04:02:19', '2019-05-22 04:02:19');

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
(1, '1', '1', 80.00, 100.00, 5.00, 0, '2019-05-21 00:09:17', '2019-05-21 00:09:17'),
(2, '1', '2', 70.00, 79.00, 4.00, 0, '2019-05-21 00:09:18', '2019-05-21 00:09:18'),
(3, '1', '3', 60.00, 69.00, 3.50, 0, '2019-05-21 00:09:18', '2019-05-21 00:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programsign` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `programsign`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Science', NULL, 0, '2019-05-02 00:52:38', '2019-05-02 00:52:38'),
(2, 'Arts', NULL, 0, '2019-05-02 00:52:48', '2019-05-02 00:52:48'),
(3, 'Commerce', NULL, 0, '2019-05-02 00:52:57', '2019-05-02 00:52:57'),
(4, 'General', NULL, 0, '2019-05-02 00:53:05', '2019-05-02 00:53:05');

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `institutes` (`id`, `name`, `institutetypeid`, `categoryid`, `subcategoryid`, `addressid`, `wordno`, `cluster`, `ein`, `institutelogo`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Horimohon High School', 1, 1, 1, 31, 'wordno1', 'Claster1', 1233456, 'institute_logo.png', 0, '2019-05-30 02:50:22', '2019-05-30 02:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `level_programs`
--

CREATE TABLE `level_programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `programlevelid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `level_programs`
--

INSERT INTO `level_programs` (`id`, `programlevelid`, `programid`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 0, '2019-04-30 05:58:24', '2019-04-30 05:58:24'),
(2, 3, 2, 0, '2019-04-30 05:58:42', '2019-04-30 05:58:42');

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
(1, 'Nawalavanga', 1, 0, '2019-05-05 03:29:18', '2019-05-05 03:29:53');

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
(1, 'Subj', 0, '2019-05-20 23:32:57', '2019-05-20 23:34:04'),
(2, 'Obj', 0, '2019-05-20 23:34:14', '2019-05-20 23:34:14'),
(3, 'Prac', 0, '2019-05-20 23:34:29', '2019-05-20 23:34:29'),
(4, 'SBA', 0, '2019-05-20 23:34:37', '2019-05-20 23:34:37');

-- --------------------------------------------------------

--
-- Table structure for table `mark_distribution`
--

CREATE TABLE `mark_distribution` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `markcategoryid` int(11) NOT NULL,
  `distribution_mark` double(8,2) DEFAULT NULL,
  `passtypeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mark_distribution`
--

INSERT INTO `mark_distribution` (`id`, `programofferid`, `coursecodeid`, `markcategoryid`, `distribution_mark`, `passtypeid`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 30.00, 1, 0, '2019-05-20 23:37:18', '2019-05-20 23:37:18'),
(2, 2, 1, 2, 30.00, 3, 0, '2019-05-20 23:37:19', '2019-05-20 23:37:19'),
(3, 2, 1, 3, 30.00, 3, 0, '2019-05-20 23:37:19', '2019-05-20 23:37:19'),
(4, 2, 1, 4, 10.00, 4, 0, '2019-05-20 23:37:19', '2019-05-20 23:37:19'),
(5, 2, 2, 1, 80.00, 1, 0, '2019-05-22 23:44:45', '2019-05-22 23:44:45'),
(6, 2, 2, 2, 20.00, 2, 0, '2019-05-23 00:23:29', '2019-05-23 00:23:29'),
(7, 1, 1, 1, 20.00, 1, 0, '2019-06-03 00:53:59', '2019-06-03 00:53:59'),
(8, 1, 1, 2, 45.00, 2, 0, '2019-06-03 00:53:59', '2019-06-03 00:53:59'),
(9, 1, 1, 3, 30.00, 3, 0, '2019-06-03 00:53:59', '2019-06-03 00:53:59'),
(10, 1, 1, 4, 5.00, 4, 0, '2019-06-03 00:53:59', '2019-06-03 00:53:59'),
(11, 1, 2, 1, 100.00, 1, 0, '2019-06-03 00:54:15', '2019-06-03 00:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `master_exam`
--

CREATE TABLE `master_exam` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `examnameid` int(11) NOT NULL,
  `exhld_mark_in_percentage` double(8,2) NOT NULL,
  `mxm_in_percentage` double(8,2) NOT NULL,
  `with_child` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_exam`
--

INSERT INTO `master_exam` (`id`, `programofferid`, `examnameid`, `exhld_mark_in_percentage`, `mxm_in_percentage`, `with_child`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20.00, 100.00, 1, 0, '2019-05-23 01:12:40', '2019-05-24 23:55:02'),
(2, 2, 1, 40.00, 100.00, 1, 0, '2019-05-23 01:17:01', '2019-05-24 23:53:14');

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

--
-- Dumping data for table `mearges`
--

INSERT INTO `mearges` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bangla', 0, '2019-05-19 23:39:10', '2019-05-19 23:39:10'),
(2, 'English', 0, '2019-05-19 23:39:18', '2019-05-19 23:39:18');

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
(1, 'Bangla', 0, '2019-05-02 00:56:13', '2019-05-02 00:56:13'),
(2, 'English', 0, '2019-05-02 00:56:19', '2019-05-02 00:56:19');

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
(1, 'Menu Settings', NULL, 0, 100, 0, '2019-04-30 05:44:16', '2019-04-30 05:44:16'),
(2, 'Menu', 'menu', 1, 100, 0, '2019-04-30 05:44:16', '2019-04-30 05:44:16'),
(3, 'Role Settings', NULL, 0, 100, 0, '2019-04-30 05:45:13', '2019-04-30 05:45:13'),
(4, 'Role', 'role', 3, 100, 0, '2019-04-30 05:46:50', '2019-04-30 05:46:50'),
(5, 'User Settings', NULL, 0, 100, 0, '2019-04-30 05:47:51', '2019-04-30 05:47:51'),
(6, 'User Manager', 'user', 5, 100, 0, '2019-04-30 05:48:11', '2019-04-30 05:48:11'),
(7, 'Program Settings', NULL, 0, 100, 0, '2019-04-30 05:54:00', '2019-04-30 05:54:00'),
(8, 'Session', 'session', 7, 100, 0, '2019-04-30 05:54:27', '2019-04-30 05:54:27'),
(9, 'Program Level', 'plevel', 7, 100, 0, '2019-04-30 05:55:28', '2019-04-30 05:55:28'),
(10, 'Program', 'program', 7, 100, 0, '2019-04-30 05:56:25', '2019-04-30 05:56:25'),
(11, 'Level Program', 'levelprogram', 7, 100, 0, '2019-04-30 05:58:07', '2019-04-30 05:58:07'),
(12, 'Group', 'group', 7, 100, 0, '2019-05-02 00:52:20', '2019-05-02 00:52:20'),
(13, 'Program Group', 'programgroup', 7, 100, 0, '2019-05-02 00:54:06', '2019-05-02 00:54:06'),
(14, 'Medium', 'medium', 7, 100, 0, '2019-05-02 00:55:23', '2019-05-02 00:55:23'),
(15, 'Shift', 'shift', 7, 100, 0, '2019-05-02 00:55:44', '2019-05-02 00:55:44'),
(16, 'Program Offer', 'programoffer', 7, 100, 0, '2019-05-02 00:56:03', '2019-05-02 00:56:03'),
(17, 'Admission  settings', NULL, 0, 100, 0, '2019-05-02 01:03:36', '2019-05-02 01:03:36'),
(18, 'Admission Program', 'admissionprogram', 17, 89, 0, '2019-05-02 01:04:03', '2019-05-02 03:31:19'),
(19, 'Ad Program Subject', 'admissionprogramsubject', 17, 100, 0, '2019-05-02 01:20:02', '2019-05-02 01:28:20'),
(20, 'Admission Subject', 'admissionsubject', 17, 90, 0, '2019-05-02 01:24:41', '2019-05-02 03:30:30'),
(21, 'Basic Settings', NULL, 0, 100, 0, '2019-05-05 03:17:18', '2019-05-05 03:17:18'),
(22, 'Division', 'division', 21, 100, 0, '2019-05-05 03:17:39', '2019-05-05 03:17:39'),
(23, 'District', 'district', 21, 100, 0, '2019-05-05 03:23:28', '2019-05-05 03:23:28'),
(24, 'Thana', 'thana', 21, 100, 0, '2019-05-05 03:25:01', '2019-05-05 03:25:01'),
(25, 'Union', 'localgov', 21, 100, 0, '2019-05-05 03:27:40', '2019-05-05 03:27:40'),
(26, 'Post Office', 'postoffice', 21, 100, 0, '2019-05-05 03:27:57', '2019-05-05 03:27:57'),
(27, 'Gender', 'gender', 21, 100, 0, '2019-05-05 03:35:46', '2019-05-05 03:35:46'),
(28, 'Blood Group', 'bloodgroup', 21, 100, 0, '2019-05-05 03:40:12', '2019-05-05 03:40:12'),
(29, 'Religion', 'religion', 21, 100, 0, '2019-05-05 03:44:01', '2019-05-05 03:44:01'),
(30, 'Nationality', 'nationality', 21, 100, 0, '2019-05-05 03:45:50', '2019-05-05 03:45:50'),
(31, 'Quota', 'quota', 21, 100, 0, '2019-05-05 03:49:10', '2019-05-05 03:49:10'),
(32, 'Application Time', 'startend', 17, 100, 0, '2019-05-06 00:54:28', '2019-05-06 00:54:28'),
(33, 'Admission Marks Entry', 'admissionmarkentry', 17, 100, 0, '2019-05-08 23:10:27', '2019-05-08 23:10:27'),
(34, 'Admission Mark Edit', 'admissionmarkentry/edit', 17, 100, 0, '2019-05-09 03:22:02', '2019-05-09 03:22:02'),
(35, 'Admission Result', 'admissionresults', 17, 100, 0, '2019-05-15 00:35:37', '2019-05-15 00:35:37'),
(36, 'Mearge', 'mearges', 7, 100, 0, '2019-05-19 23:38:58', '2019-05-19 23:38:58'),
(37, 'Course Offer', 'courseoffercreate', 7, 100, 0, '2019-05-19 23:41:32', '2019-05-19 23:41:32'),
(38, 'Course', 'course', 7, 100, 0, '2019-05-20 00:10:56', '2019-05-20 00:10:56'),
(39, 'Course Code', 'coursecode', 7, 100, 0, '2019-05-20 00:12:40', '2019-05-20 00:12:40'),
(40, 'Section', 'sections', 7, 100, 0, '2019-05-20 00:13:52', '2019-05-20 00:13:52'),
(41, 'Section Offer', 'sectionoffer', 7, 100, 0, '2019-05-20 00:20:09', '2019-05-20 00:20:09'),
(42, 'Mearge Offer', 'meargeoffer', 7, 100, 0, '2019-05-20 01:01:26', '2019-05-20 01:01:26'),
(43, 'Mark Distribution', 'markdistribution', 7, 100, 0, '2019-05-20 23:26:05', '2019-05-20 23:26:05'),
(44, 'Mark Category', 'markcategory', 7, 100, 0, '2019-05-20 23:32:35', '2019-05-20 23:32:35'),
(45, 'Grade Letter', 'gradeletter', 7, 100, 0, '2019-05-20 23:40:47', '2019-05-20 23:40:47'),
(46, 'Grade Point', 'gradepoint', 7, 100, 0, '2019-05-20 23:46:47', '2019-05-20 23:46:47'),
(47, 'Edit Grade Point', 'gradepoint/edit', 7, 100, 0, '2019-05-21 00:12:01', '2019-05-21 00:12:01'),
(48, 'Course Type', 'coursetype', 7, 100, 0, '2019-05-21 00:17:35', '2019-05-21 00:17:35'),
(49, 'Academic Settings', NULL, 0, 100, 0, '2019-05-21 00:32:56', '2019-05-21 00:32:56'),
(50, 'Student', 'student', 49, 100, 0, '2019-05-21 00:33:28', '2019-05-21 00:33:28'),
(51, 'Students Registration', 'students', 49, 100, 0, '2019-05-21 00:34:24', '2019-05-21 00:34:24'),
(52, 'Exam Settings', NULL, 0, 100, 0, '2019-05-23 00:24:53', '2019-05-23 00:24:53'),
(53, 'Exam Name', 'examname', 52, 100, 0, '2019-05-23 00:25:17', '2019-05-23 00:25:17'),
(54, 'Master Exam', 'masterexam', 52, 100, 0, '2019-05-23 00:55:06', '2019-05-23 00:55:06'),
(55, 'Child Exam', 'childexam', 52, 100, 0, '2019-05-23 01:32:45', '2019-05-23 01:32:45'),
(56, 'Institute Settings', NULL, 0, 100, 0, '2019-05-30 02:12:24', '2019-05-30 02:12:24'),
(57, 'Institute', 'institute', 56, 100, 0, '2019-05-30 02:12:47', '2019-05-30 02:12:47'),
(58, 'Class Result', NULL, 0, 100, 0, '2019-05-31 23:09:33', '2019-05-31 23:09:33'),
(59, 'Master Mark Entry', 'mstexammarkentry', 58, 100, 0, '2019-06-01 00:49:04', '2019-06-01 00:49:04');

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
(14, '2019_01_29_104556_create_programlevels_table', 1),
(15, '2019_01_29_104619_create_programs_table', 1),
(16, '2019_01_29_104709_create_groups_table', 1),
(17, '2019_01_29_104726_create_mediums_table', 1),
(18, '2019_01_29_104745_create_shifts_table', 1),
(19, '2019_01_29_110217_create_vprogram_groups_table', 1),
(20, '2019_01_30_064955_create_vlevel_programs_table', 1),
(21, '2019_01_31_072619_create_programoffers_table', 1),
(22, '2019_02_02_035854_create_admission_programs_table', 1),
(23, '2019_02_03_094629_create_divisions_table', 1),
(24, '2019_02_03_094754_create_districts_table', 1),
(25, '2019_02_03_094841_create_thanas_table', 1),
(26, '2019_02_03_094916_create_postoffices_table', 1),
(27, '2019_02_03_094957_create_localgovs_table', 1),
(28, '2019_02_05_062142_create_addresses_table', 1),
(30, '2019_02_11_062729_create_institutes_table', 1),
(31, '2019_02_12_034715_create_admission_subjects_table', 1),
(32, '2019_02_18_063256_create_bill_accounts_table', 1),
(33, '2019_02_24_092630_create_admissionresult_table', 1),
(34, '2019_02_27_092550_create_courses_table', 1),
(35, '2019_02_27_100246_create_course_codes_table', 1),
(36, '2019_03_02_064027_create_mearges_table', 1),
(37, '2019_03_02_073647_create_courseoffer_table', 1),
(38, '2019_03_03_060538_create_departments_table', 1),
(39, '2019_03_03_064145_create_employmentstatus_table', 1),
(40, '2019_03_03_074840_create_employeetypes_table', 1),
(41, '2019_03_03_081600_create_designations_table', 1),
(42, '2019_03_03_085818_create_employeestatus_table', 1),
(43, '2019_03_03_104527_create_employees_table', 1),
(44, '2019_03_04_045750_create_maritalstatus_table', 1),
(45, '2019_03_06_064958_create_education_degree_table', 1),
(46, '2019_03_06_100949_create_educationinfo_table', 1),
(47, '2019_03_07_070413_create_imageupload_table', 1),
(48, '2019_03_14_094400_create_sections_table', 1),
(49, '2019_03_16_081640_create_sectionoffer_table', 1),
(50, '2019_03_23_074232_create_section_teachers_table', 1),
(51, '2019_03_25_083652_create_mark_categories_table', 1),
(52, '2019_03_25_091043_create_mark_distribution_table', 1),
(53, '2019_03_30_063627_create_grade_point_table', 1),
(54, '2019_03_30_065327_create_grade_letter_table', 1),
(55, '2019_04_07_060856_create_course_type_table', 1),
(56, '2019_04_07_065837_create_students_table', 1),
(57, '2019_04_07_070641_create_student_courses_table', 1),
(58, '2019_04_17_065817_create_master_exam_table', 1),
(59, '2019_04_17_081101_create_child_exam_table', 1),
(60, '2019_04_17_091812_create_exam_name_table', 1),
(61, '2019_04_23_121902_create_child_exam_course_table', 1),
(62, '2019_04_25_062016_create_admissionapplicants_table', 1),
(63, '2019_04_30_102048_create_admission_program_subjects_table', 1),
(64, '2019_05_06_053818_create_app_start_end_table', 2),
(66, '2019_02_05_064553_create_applicants_table', 3),
(68, '2019_05_26_054545_create_level_programs_table', 4),
(69, '2019_05_26_055224_create_program_groups_table', 4),
(71, '2019_06_02_090752_create_mst_exam_marks_table', 5);

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
  `coursecodeid` int(11) NOT NULL,
  `examnameid` int(11) NOT NULL,
  `examtypeid` int(11) DEFAULT NULL,
  `markcategoryid` int(11) DEFAULT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Bangladeshi', 0, '2019-05-05 03:46:01', '2019-05-05 03:46:01');

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
(1, 'Read', 0, '2019-04-30 05:44:16', '2019-04-30 05:44:16'),
(2, 'Create', 0, '2019-04-30 05:44:17', '2019-04-30 05:44:17'),
(3, 'Up', 0, '2019-04-30 05:44:17', '2019-04-30 05:44:17'),
(4, 'Del', 0, '2019-04-30 05:44:17', '2019-04-30 05:44:17');

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
(1, 'Ranihati Postoffice', 1, 0, '2019-05-05 03:29:38', '2019-05-05 03:29:38');

-- --------------------------------------------------------

--
-- Table structure for table `programlevels`
--

CREATE TABLE `programlevels` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programlevels`
--

INSERT INTO `programlevels` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Pre-Primary', 0, '2019-04-30 05:55:41', '2019-04-30 05:55:41'),
(2, 'primary', 0, '2019-04-30 05:55:50', '2019-04-30 05:55:50'),
(3, 'Secondary', 0, '2019-04-30 05:55:57', '2019-04-30 05:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `programoffers`
--

CREATE TABLE `programoffers` (
  `id` int(10) UNSIGNED NOT NULL,
  `sessionid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `groupid` int(11) NOT NULL,
  `mediumid` int(11) NOT NULL,
  `shiftid` int(11) NOT NULL,
  `cordinator` int(11) DEFAULT NULL,
  `seat` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programoffers`
--

INSERT INTO `programoffers` (`id`, `sessionid`, `programid`, `groupid`, `mediumid`, `shiftid`, `cordinator`, `seat`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 1, NULL, 200, 0, '2019-05-02 00:58:04', '2019-05-02 00:58:04'),
(2, 1, 3, 2, 1, 1, NULL, 200, 0, '2019-05-02 01:00:06', '2019-05-02 01:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programsign` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `programsign`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Class VI', '06', 0, '2019-04-30 05:56:45', '2019-05-06 23:05:03'),
(2, 'Class IX', '09', 0, '2019-04-30 05:56:58', '2019-05-06 23:04:53'),
(3, 'Class X', '10', 0, '2019-04-30 05:57:16', '2019-05-06 06:03:24'),
(4, 'Play', '51', 0, '2019-05-06 06:05:04', '2019-05-19 23:37:07'),
(5, 'Narsary', '50', 0, '2019-05-06 06:06:00', '2019-05-19 23:36:59');

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

--
-- Dumping data for table `program_groups`
--

INSERT INTO `program_groups` (`id`, `programid`, `groupid`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 0, '2019-05-02 00:54:26', '2019-05-02 00:54:26'),
(2, 2, 3, 0, '2019-05-02 00:54:33', '2019-05-02 00:54:33'),
(3, 3, 2, 0, '2019-05-02 00:54:54', '2019-05-02 00:54:54');

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
(1, 'General', 0, '2019-05-05 03:50:05', '2019-05-05 03:50:05'),
(2, 'Disablities', 0, '2019-05-05 03:50:11', '2019-05-05 03:50:11');

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
(1, 'Islam', 0, '2019-05-05 03:44:13', '2019-05-05 03:44:13'),
(2, 'Hindu', 0, '2019-05-05 03:44:21', '2019-05-05 03:44:21');

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
(1, 'Admin', 0, 0, '2019-04-30 05:44:17', '2019-04-30 05:44:17'),
(2, 'School(Admin)', 1, 0, NULL, NULL);

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
(1, 3, 0),
(1, 5, 0),
(1, 6, 1),
(1, 6, 2),
(1, 6, 3),
(1, 6, 4),
(1, 7, 0),
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
(1, 17, 0),
(1, 19, 1),
(1, 19, 2),
(1, 19, 3),
(1, 19, 4),
(1, 20, 1),
(1, 20, 2),
(1, 20, 3),
(1, 20, 4),
(1, 18, 1),
(1, 18, 2),
(1, 18, 3),
(1, 18, 4),
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
(1, 26, 1),
(1, 26, 2),
(1, 26, 3),
(1, 26, 4),
(1, 27, 1),
(1, 27, 2),
(1, 27, 3),
(1, 27, 4),
(1, 28, 1),
(1, 28, 2),
(1, 28, 3),
(1, 28, 4),
(1, 29, 1),
(1, 29, 2),
(1, 29, 3),
(1, 29, 4),
(1, 30, 1),
(1, 30, 2),
(1, 30, 3),
(1, 30, 4),
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
(1, 36, 1),
(1, 36, 2),
(1, 36, 3),
(1, 36, 4),
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
(1, 44, 1),
(1, 44, 2),
(1, 44, 3),
(1, 44, 4),
(1, 45, 1),
(1, 45, 2),
(1, 45, 3),
(1, 45, 4),
(1, 46, 1),
(1, 46, 2),
(1, 46, 3),
(1, 46, 4),
(1, 47, 1),
(1, 47, 2),
(1, 47, 3),
(1, 47, 4),
(1, 48, 1),
(1, 48, 2),
(1, 48, 3),
(1, 48, 4),
(1, 49, 0),
(1, 50, 1),
(1, 50, 2),
(1, 50, 3),
(1, 50, 4),
(1, 51, 1),
(1, 51, 2),
(1, 51, 3),
(1, 51, 4),
(1, 52, 0),
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
(1, 55, 4),
(1, 4, 1),
(1, 4, 2),
(1, 4, 3),
(1, 4, 4),
(2, 1, 0),
(2, 2, 1),
(2, 2, 3),
(2, 3, 0),
(2, 4, 1),
(2, 4, 2),
(2, 4, 3),
(2, 4, 4),
(1, 56, 0),
(1, 57, 1),
(1, 57, 2),
(1, 57, 3),
(1, 57, 4),
(1, 58, 0),
(1, 59, 1),
(1, 59, 2),
(1, 59, 3),
(1, 59, 4);

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
  `section_student` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sectionoffer`
--

INSERT INTO `sectionoffer` (`id`, `programofferid`, `sectionid`, `section_student`, `status`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 200, 0, '2019-05-20 23:22:17', '2019-05-20 23:22:17'),
(8, 1, 2, 150, 0, '2019-05-20 23:22:17', '2019-05-20 23:22:17'),
(9, 1, 3, 150, 0, '2019-05-20 23:22:17', '2019-05-20 23:22:17'),
(11, 2, 1, 200, 0, '2019-05-21 23:25:22', '2019-05-21 23:25:22'),
(12, 2, 2, 150, 0, '2019-05-21 23:25:23', '2019-05-21 23:25:23');

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
(1, 'Ka', 0, '2019-05-20 00:14:05', '2019-05-20 00:14:05'),
(2, 'Kha', 0, '2019-05-20 00:14:10', '2019-05-20 00:14:10'),
(3, 'Ga', 0, '2019-05-20 00:14:14', '2019-05-20 00:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `section_teachers`
--

CREATE TABLE `section_teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `employeeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2019', 0, '2019-04-30 05:54:42', '2019-04-30 05:54:42');

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
(1, 'Day', '19:12:00', '00:12:00', 0, '2019-05-02 00:56:48', '2019-05-02 00:56:48'),
(2, 'Night', '12:12:00', '19:12:00', 0, '2019-05-02 00:57:44', '2019-05-02 00:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `applicantid` int(11) NOT NULL,
  `classroll` int(11) NOT NULL,
  `fromclass` int(11) NOT NULL,
  `fromsection` int(11) NOT NULL,
  `studenttype` int(11) NOT NULL,
  `currentclass` int(3) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `programofferid`, `sectionid`, `applicantid`, `classroll`, `fromclass`, `fromsection`, `studenttype`, `currentclass`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 19100001, 1, 0, 0, 1, 1, 0, '2019-06-01 23:57:16', '2019-06-01 23:57:16'),
(2, 1, 1, 19100002, 2, 0, 0, 1, 1, 0, '2019-06-02 00:02:23', '2019-06-02 00:02:23'),
(3, 1, 1, 19100004, 4, 0, 0, 1, 1, 0, '2019-06-02 01:22:30', '2019-06-02 01:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `coursetypeid` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`id`, `studentid`, `coursecodeid`, `coursetypeid`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 0, '2019-06-01 23:57:16', '2019-06-01 23:57:16'),
(2, 1, 2, 2, 0, '2019-06-01 23:57:16', '2019-06-01 23:57:16'),
(3, 1, 3, 3, 0, '2019-06-01 23:57:16', '2019-06-01 23:57:16'),
(4, 2, 1, 1, 0, '2019-06-02 00:02:24', '2019-06-02 00:02:24'),
(5, 2, 2, 3, 0, '2019-06-02 00:02:24', '2019-06-02 00:02:24'),
(6, 2, 3, 3, 0, '2019-06-02 00:02:24', '2019-06-02 00:02:24'),
(7, 3, 1, 1, 0, '2019-06-02 01:22:30', '2019-06-02 01:22:30'),
(8, 3, 2, 1, 0, '2019-06-02 01:22:30', '2019-06-02 01:22:30'),
(9, 3, 3, 3, 0, '2019-06-02 01:22:30', '2019-06-02 01:22:30');

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
(1, 'Shibganj', 2, 0, '2019-05-05 03:26:03', '2019-05-05 03:26:03');

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
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$snqVZHxzNPD8d51W8ZSSZ.54aYvux3Bq8uNUlIhE1L.9Twh8AswBm', 'jMldkgBR0KI8LGM19G2TOHIHvDhJxwr263MkM2Pv1mfT1qMiHbz1fLUDqTDU', '2019-04-30 05:44:16', '2019-04-30 05:44:16'),
(2, 'School(Admin)', 'school@gmail.com', NULL, '$2y$10$cN.Uzn5GoA21NO6WEnnBzO9wlRMn4ahwStnwTej8eZXHy3HLWTjf.', 'beFk6zUdfuANwDCuP9tFwsyKZzg00TE67tZwhNYI1IOY2W63Smx6At04mSas', '2019-04-30 05:49:57', '2019-04-30 05:49:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admissionapplicants`
--
ALTER TABLE `admissionapplicants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programofferid` (`programofferid`,`admssion_roll`);

--
-- Indexes for table `admissionresult`
--
ALTER TABLE `admissionresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_programs`
--
ALTER TABLE `admission_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `programofferid` (`programofferid`);

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
  ADD UNIQUE KEY `applicantid` (`applicantid`);

--
-- Indexes for table `app_start_end`
--
ALTER TABLE `app_start_end`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_exam`
--
ALTER TABLE `child_exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child_exam_course`
--
ALTER TABLE `child_exam_course`
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
-- Indexes for table `course_codes`
--
ALTER TABLE `course_codes`
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
-- Indexes for table `employmentstatus`
--
ALTER TABLE `employmentstatus`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `level_programs`
--
ALTER TABLE `level_programs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `level_programs_programid_unique` (`programid`);

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
-- Indexes for table `postoffices`
--
ALTER TABLE `postoffices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programlevels`
--
ALTER TABLE `programlevels`
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
-- Indexes for table `section_teachers`
--
ALTER TABLE `section_teachers`
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
  ADD UNIQUE KEY `applicantid` (`applicantid`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `admissionapplicants`
--
ALTER TABLE `admissionapplicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `admissionresult`
--
ALTER TABLE `admissionresult`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admission_programs`
--
ALTER TABLE `admission_programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admission_subjects`
--
ALTER TABLE `admission_subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `app_start_end`
--
ALTER TABLE `app_start_end`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `child_exam`
--
ALTER TABLE `child_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `child_exam_course`
--
ALTER TABLE `child_exam_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courseoffer`
--
ALTER TABLE `courseoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_codes`
--
ALTER TABLE `course_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `employmentstatus`
--
ALTER TABLE `employmentstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_name`
--
ALTER TABLE `exam_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grade_letter`
--
ALTER TABLE `grade_letter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grade_point`
--
ALTER TABLE `grade_point`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `level_programs`
--
ALTER TABLE `level_programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_exam`
--
ALTER TABLE `master_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mearges`
--
ALTER TABLE `mearges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mediums`
--
ALTER TABLE `mediums`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `mst_exam_marks`
--
ALTER TABLE `mst_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `postoffices`
--
ALTER TABLE `postoffices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `programlevels`
--
ALTER TABLE `programlevels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programoffers`
--
ALTER TABLE `programoffers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program_groups`
--
ALTER TABLE `program_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotas`
--
ALTER TABLE `quotas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `section_teachers`
--
ALTER TABLE `section_teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
