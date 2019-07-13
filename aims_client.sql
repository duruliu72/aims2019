-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2019 at 12:33 PM
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
(31, 1, 2, 1, 1, '1233', 1, 'DDD'),
(40, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(41, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(42, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(43, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(44, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(45, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(46, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(47, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(48, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(49, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(50, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(51, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(52, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(53, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(54, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(55, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(56, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(57, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(58, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(59, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(60, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(61, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(62, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(63, 1, 2, 1, 1, '131234', 1, 'asfasdfasdfasd'),
(64, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(65, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(66, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(67, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(68, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(69, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(70, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(71, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(72, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(73, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(74, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(75, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(76, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(77, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(78, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(79, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(80, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(81, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(82, 1, 2, 1, 1, '6300', 1, 'Ranihati'),
(83, 1, 2, 1, 1, '6300', 1, 'Ranihati');

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
(1, 1, 19090001, 1, 20.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(2, 1, 19090001, 2, 18.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(3, 1, 19090001, 3, 30.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(4, 1, 19090001, 4, 30.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(5, 1, 19090002, 1, 12.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(6, 1, 19090002, 2, 12.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(7, 1, 19090002, 3, 30.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(8, 1, 19090002, 4, 30.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(9, 1, 19090003, 1, 18.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(10, 1, 19090003, 2, 19.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(11, 1, 19090003, 3, 54.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(12, 1, 19090003, 4, 49.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(13, 1, 19090004, 1, 12.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(14, 1, 19090004, 2, 19.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(15, 1, 19090004, 3, 59.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(16, 1, 19090004, 4, 44.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(17, 1, 19090005, 1, 22.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(18, 1, 19090005, 2, 13.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(19, 1, 19090005, 3, 45.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(20, 1, 19090005, 4, 48.00, '2019-06-29 03:47:10', '2019-06-29 03:47:10'),
(21, 2, 19100001, 1, 50.00, '2019-06-30 23:42:00', '2019-06-30 23:42:00'),
(22, 2, 19100001, 2, 23.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(23, 2, 19100001, 3, 55.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(24, 2, 19100001, 4, 23.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(25, 2, 19100002, 1, 49.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(26, 2, 19100002, 2, 24.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(27, 2, 19100002, 3, 56.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(28, 2, 19100002, 4, 20.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(29, 2, 19100003, 1, 43.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(30, 2, 19100003, 2, 30.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(31, 2, 19100003, 3, 57.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(32, 2, 19100003, 4, 20.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(33, 2, 19100004, 1, 42.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(34, 2, 19100004, 2, 37.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(35, 2, 19100004, 3, 56.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(36, 2, 19100004, 4, 25.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(37, 2, 19100005, 1, 37.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(38, 2, 19100005, 2, 36.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(39, 2, 19100005, 3, 48.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(40, 2, 19100005, 4, 34.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(41, 2, 19100006, 1, 38.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(42, 2, 19100006, 2, 35.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(43, 2, 19100006, 3, 47.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(44, 2, 19100006, 4, 15.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(45, 2, 19100007, 1, 39.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(46, 2, 19100007, 2, 34.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(47, 2, 19100007, 3, 55.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(48, 2, 19100007, 4, 13.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(49, 2, 19100008, 1, 40.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(50, 2, 19100008, 2, 33.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(51, 2, 19100008, 3, 42.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(52, 2, 19100008, 4, 15.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(53, 2, 19100009, 1, 41.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(54, 2, 19100009, 2, 48.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(55, 2, 19100009, 3, 41.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(56, 2, 19100009, 4, 17.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(57, 2, 19100010, 1, 42.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(58, 2, 19100010, 2, 49.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(59, 2, 19100010, 3, 37.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01'),
(60, 2, 19100010, 4, 40.00, '2019-06-30 23:42:01', '2019-06-30 23:42:01');

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
(1, 2, 3.25, 200.00, '2019-05-30', '12:30:00', 0, '2019-05-07 00:18:50', '2019-06-30 23:35:02'),
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
(2, 1, 25.00, 0, '2019-06-30 23:36:23', '2019-06-30 23:36:23'),
(2, 2, 25.00, 0, '2019-06-30 23:36:23', '2019-06-30 23:36:23'),
(2, 3, 30.00, 0, '2019-06-30 23:36:23', '2019-06-30 23:36:23'),
(2, 4, 20.00, 0, '2019-06-30 23:36:23', '2019-06-30 23:36:23');

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
(1, 19090001, 'Hpemoo', 'Md.', 'Khalaque', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-12', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 54, 55, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19090001.png', '19090001_signature.jpg', NULL, NULL, '2019-06-29 03:18:38', '2019-06-29 03:18:38'),
(2, 19090002, 'nk5Rhm', 'Md.', 'Khalaque', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-12', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 56, 57, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19090002.png', '19090002_signature.jpg', NULL, NULL, '2019-06-29 03:20:41', '2019-06-29 03:20:41'),
(3, 19090003, 'hkJGtp', 'Md.', 'Khalaque', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-12', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 58, 59, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19090003.png', '19090003_signature.jpg', NULL, NULL, '2019-06-29 03:20:59', '2019-06-29 03:20:59'),
(4, 19090004, 'MC3sJW', 'Md.', 'Khalaque', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-12', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 60, 61, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19090004.png', '19090004_signature.jpg', NULL, NULL, '2019-06-29 03:25:55', '2019-06-29 03:25:55'),
(5, 19090005, '441d34', 'Md.', 'Khalaque', 'Ali', '01272720772', NULL, 'mezanur', 'Amena', NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-12', NULL, NULL, NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 62, 63, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19090005.jpg', '19090005_signature.jpg', NULL, NULL, '2019-06-29 03:31:52', '2019-06-29 03:31:52'),
(6, 19100001, '5VnvuE', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 64, 65, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100001.png', '19100001_signature.jpg', NULL, NULL, '2019-06-30 23:12:06', '2019-06-30 23:12:06'),
(7, 19100002, 'NP64Ic', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 66, 67, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100002.png', '19100002_signature.jpg', NULL, NULL, '2019-06-30 23:12:21', '2019-06-30 23:12:21'),
(8, 19100003, '8H2bSP', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Khadija Akter', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 68, 69, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100003.png', '19100003_signature.jpg', NULL, NULL, '2019-06-30 23:12:25', '2019-06-30 23:12:25'),
(9, 19100004, 'gquTCj', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 70, 71, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100004.png', '19100004_signature.jpg', NULL, NULL, '2019-06-30 23:12:28', '2019-06-30 23:12:28'),
(10, 19100005, 'yIHbig', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 72, 73, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100005.png', '19100005_signature.jpg', NULL, NULL, '2019-06-30 23:12:29', '2019-06-30 23:12:29'),
(11, 19100006, 'yEq9V4', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 74, 75, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100006.png', '19100006_signature.jpg', NULL, NULL, '2019-06-30 23:12:32', '2019-06-30 23:12:32'),
(12, 19100007, '1BmUcj', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 76, 77, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100007.png', '19100007_signature.jpg', NULL, NULL, '2019-06-30 23:12:35', '2019-06-30 23:12:35'),
(13, 19100008, 'yMOnVW', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 78, 79, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100008.png', '19100008_signature.jpg', NULL, NULL, '2019-06-30 23:12:37', '2019-06-30 23:12:37'),
(14, 19100009, 'xxKR6R', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 80, 81, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100009.png', '19100009_signature.jpg', NULL, NULL, '2019-06-30 23:12:39', '2019-06-30 23:12:39'),
(15, 19100010, 'KZu1qy', 'Md.', 'Shohel', 'Rana', '01516129137', NULL, 'Rofiq', 'Ali', NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-18', NULL, '123414', NULL, 1, 0, NULL, 1, 1, NULL, 1, NULL, NULL, 82, 83, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', '19100010.png', '19100010_signature.jpg', NULL, NULL, '2019-06-30 23:12:41', '2019-06-30 23:12:41');

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
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_exam`
--

INSERT INTO `child_exam` (`id`, `master_exam_id`, `examnameid`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(2, 1, 3, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(3, 1, 2, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(4, 2, 3, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `child_exam_course`
--

CREATE TABLE `child_exam_course` (
  `id` int(10) UNSIGNED NOT NULL,
  `child_exam_id` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `child_exam_course`
--

INSERT INTO `child_exam_course` (`id`, `child_exam_id`, `coursecodeid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(2, 1, 2, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(3, 1, 3, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(4, 1, 4, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(5, 1, 5, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(6, 1, 6, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(7, 1, 7, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(8, 1, 8, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(9, 1, 9, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(10, 1, 10, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(11, 1, 11, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(12, 1, 12, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(13, 1, 13, 10.00, 0, '2019-07-07 03:59:55', '2019-07-07 03:59:55'),
(14, 2, 1, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(15, 2, 2, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(16, 2, 3, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(17, 2, 4, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(18, 2, 5, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(19, 2, 6, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(20, 2, 7, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(21, 2, 8, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(22, 2, 10, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(23, 2, 11, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(24, 2, 12, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(25, 2, 13, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(26, 2, 9, 10.00, 0, '2019-07-07 05:14:55', '2019-07-07 05:14:55'),
(27, 3, 1, 12.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(28, 3, 2, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(29, 3, 3, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(30, 3, 4, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(31, 3, 5, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(32, 3, 6, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(33, 3, 7, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(34, 3, 8, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(35, 3, 10, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(36, 3, 11, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(37, 3, 12, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(38, 3, 13, 12.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(39, 3, 9, 10.00, 0, '2019-07-07 05:58:44', '2019-07-07 05:58:44'),
(40, 4, 1, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(41, 4, 2, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(42, 4, 3, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(43, 4, 4, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(44, 4, 5, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(45, 4, 6, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(46, 4, 7, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(47, 4, 8, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(48, 4, 9, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(49, 4, 10, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(50, 4, 11, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(51, 4, 12, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02'),
(52, 4, 13, 10.00, 0, '2019-07-07 06:02:02', '2019-07-07 06:02:02');

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
  `coursecodeid` int(11) NOT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `coursemark` double(8,2) DEFAULT NULL,
  `meargeid` int(11) DEFAULT NULL,
  `mearge_name` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courseoffer`
--

INSERT INTO `courseoffer` (`id`, `programofferid`, `coursecodeid`, `teacherid`, `coursemark`, `meargeid`, `mearge_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 100.00, 1, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(2, 1, 2, NULL, 100.00, 2, 'Bangla1', '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(3, 1, 3, NULL, 100.00, 2, 'Bangla1', '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(4, 1, 4, NULL, 100.00, 4, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(5, 1, 5, NULL, 100.00, 5, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(6, 1, 6, NULL, 100.00, 6, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(7, 1, 7, NULL, 100.00, 7, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(8, 1, 8, NULL, 100.00, 8, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(9, 1, 10, NULL, 100.00, 10, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(10, 1, 11, NULL, 100.00, 11, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(11, 1, 12, NULL, 100.00, 12, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(12, 1, 13, NULL, 100.00, 13, NULL, '2019-06-27 03:53:20', '2019-06-27 03:53:20'),
(13, 1, 9, NULL, 100.00, 9, NULL, '2019-06-27 03:54:55', '2019-06-27 03:54:55'),
(14, 2, 1, NULL, 100.00, 1, NULL, '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(15, 2, 2, NULL, 100.00, 2, 'Bangla', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(16, 2, 3, NULL, 100.00, 2, 'Bangla', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(17, 2, 4, NULL, 100.00, 4, NULL, '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(18, 2, 5, NULL, 100.00, 5, 'English', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(19, 2, 6, NULL, 100.00, 5, 'English', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(20, 2, 7, NULL, 100.00, 7, NULL, '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(21, 2, 8, NULL, 100.00, 8, NULL, '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(22, 2, 9, NULL, 100.00, 9, 'Physics', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(23, 2, 10, NULL, 100.00, 9, 'Physics', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(24, 2, 11, NULL, 100.00, 11, NULL, '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(25, 2, 12, NULL, 100.00, 12, 'Chemistry', '2019-06-27 05:37:58', '2019-06-27 05:37:58'),
(26, 2, 13, NULL, 100.00, 12, 'Chemistry', '2019-06-27 05:37:58', '2019-06-27 05:37:58');

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
(3, 'Bangla 2nd Paper', 0, '2019-05-20 00:11:42', '2019-05-20 00:11:42'),
(4, 'English', 0, '2019-06-20 02:44:23', '2019-06-20 02:44:23'),
(5, 'English 1st Paper', 0, '2019-06-20 02:44:33', '2019-06-20 02:44:33'),
(6, 'English 2nd Paper', 0, '2019-06-20 02:44:38', '2019-06-20 02:44:38'),
(7, 'Math', 0, '2019-06-20 02:44:44', '2019-06-20 02:44:44'),
(8, 'Physics', 0, '2019-06-20 02:45:08', '2019-06-20 02:45:08'),
(9, 'Physics 1st Paper', 0, '2019-06-20 02:45:13', '2019-06-20 02:45:13'),
(10, 'Physics 2nd Paper', 0, '2019-06-20 02:45:20', '2019-06-20 02:45:20'),
(11, 'Chemistry', 0, '2019-06-20 02:45:27', '2019-06-20 02:45:27'),
(12, 'Chemistry 1st Part', 0, '2019-06-20 02:45:44', '2019-06-20 02:45:44'),
(13, 'Chemistry 2nd Part', 0, '2019-06-20 02:45:58', '2019-06-20 02:45:58');

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
(3, '107', 3, 0, '2019-05-20 00:13:19', '2019-05-20 00:13:19'),
(4, '201', 4, 0, '2019-06-20 02:47:08', '2019-06-20 02:47:08'),
(5, '202', 5, 0, '2019-06-20 02:47:24', '2019-06-20 02:47:24'),
(6, '203', 6, 0, '2019-06-20 02:47:34', '2019-06-20 02:47:34'),
(7, '310', 7, 0, '2019-06-20 02:48:01', '2019-06-20 02:48:01'),
(8, '311', 8, 0, '2019-06-20 02:48:15', '2019-06-20 02:48:15'),
(9, '302', 9, 0, '2019-06-20 02:49:15', '2019-06-20 02:49:15'),
(10, '304', 10, 0, '2019-06-20 02:49:22', '2019-06-20 02:49:22'),
(11, '401', 11, 0, '2019-06-20 02:49:34', '2019-06-20 02:49:34'),
(12, '402', 12, 0, '2019-06-20 02:49:41', '2019-06-20 02:49:41'),
(13, '405', 13, 0, '2019-06-20 02:49:51', '2019-06-20 02:49:51');

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
(1, 'Compulsory', 0, '2019-05-21 00:25:46', '2019-06-22 04:52:42'),
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
(2, 'Rangpur', 0, '2019-06-16 05:01:33', '2019-06-16 05:01:33'),
(9, 'name', 0, '2019-06-16 05:03:17', '2019-06-16 05:03:17'),
(10, 'Kumilla', 0, '2019-06-16 05:03:17', '2019-06-16 05:03:17');

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
(2, 'CT 1', 2, 0, '2019-05-23 00:38:36', '2019-07-12 23:24:14'),
(3, 'CT 2', 2, 0, '2019-05-23 00:39:02', '2019-07-12 23:25:53'),
(4, 'MT', 2, 0, '2019-07-12 23:24:35', '2019-07-12 23:26:04');

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
(4, 'C', 0, '2019-05-22 04:02:19', '2019-05-22 04:02:19'),
(5, 'B', 0, '2019-07-03 01:54:51', '2019-07-03 01:54:51'),
(6, 'D', 0, '2019-07-03 01:55:05', '2019-07-03 01:55:05'),
(7, 'F', 0, '2019-07-03 01:55:11', '2019-07-03 01:55:11');

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
(3, '1', '3', 60.00, 69.00, 3.50, 0, '2019-05-21 00:09:18', '2019-05-21 00:09:18'),
(4, '1', '4', 50.00, 59.00, 3.00, 0, '2019-06-20 01:43:31', '2019-06-20 01:43:31'),
(5, '2', '1', 80.00, 100.00, 5.00, 0, '2019-06-25 22:49:12', '2019-06-25 22:49:12'),
(6, '2', '2', 70.00, 79.00, 4.00, 0, '2019-06-25 22:49:12', '2019-06-25 22:49:12'),
(7, '2', '3', 60.00, 69.00, 3.50, 0, '2019-06-25 22:49:12', '2019-06-25 22:49:12'),
(8, '2', '4', 40.00, 49.00, 2.00, 0, '2019-06-25 22:49:12', '2019-06-25 22:49:12'),
(9, '2', '5', 50.00, 59.00, 3.00, 0, '2019-07-03 01:58:16', '2019-07-03 01:58:16'),
(10, '2', '6', 33.00, 39.00, 1.00, 0, '2019-07-03 01:58:16', '2019-07-03 01:58:16'),
(11, '2', '7', 0.00, 32.00, 0.00, 0, '2019-07-03 01:58:16', '2019-07-03 01:58:16');

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
(1, 'S', 0, '2019-05-20 23:32:57', '2019-06-25 05:00:59'),
(2, 'O', 0, '2019-05-20 23:34:14', '2019-06-25 05:01:07'),
(3, 'P', 0, '2019-05-20 23:34:29', '2019-06-25 05:01:15'),
(4, 'SB', 0, '2019-05-20 23:34:37', '2019-06-25 05:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `mark_distribution`
--

CREATE TABLE `mark_distribution` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `markcategoryid` int(11) NOT NULL,
  `mark_in_percentage` double(8,2) NOT NULL,
  `mark_group_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mark_distribution`
--

INSERT INTO `mark_distribution` (`id`, `programofferid`, `coursecodeid`, `markcategoryid`, `mark_in_percentage`, `mark_group_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 35.00, 1, 0, '2019-06-29 04:33:08', '2019-06-29 04:33:08'),
(2, 1, 2, 2, 35.00, 2, 0, '2019-06-29 04:33:08', '2019-06-29 04:33:08'),
(3, 1, 2, 3, 20.00, 3, 0, '2019-06-29 04:33:08', '2019-06-29 04:33:08'),
(4, 1, 2, 4, 10.00, 4, 0, '2019-06-29 04:33:08', '2019-06-29 04:33:08'),
(5, 1, 1, 1, 50.00, 1, 0, '2019-06-29 05:11:29', '2019-06-29 05:11:29'),
(6, 1, 1, 2, 50.00, 2, 0, '2019-06-29 05:11:29', '2019-06-29 05:11:29'),
(7, 1, 3, 1, 35.00, 1, 0, '2019-06-29 05:26:48', '2019-06-29 05:26:48'),
(8, 1, 3, 2, 35.00, 2, 0, '2019-06-29 05:26:48', '2019-06-29 05:26:48'),
(9, 1, 3, 3, 20.00, 3, 0, '2019-06-29 05:26:48', '2019-06-29 05:26:48'),
(10, 1, 3, 4, 10.00, 4, 0, '2019-06-29 05:26:48', '2019-06-29 05:26:48'),
(11, 1, 11, 1, 40.00, 1, 0, '2019-06-29 05:30:01', '2019-06-29 05:30:01'),
(12, 1, 11, 2, 40.00, 2, 0, '2019-06-29 05:30:01', '2019-06-29 05:30:01'),
(13, 1, 11, 3, 10.00, 3, 0, '2019-06-29 05:30:01', '2019-06-29 05:30:01'),
(14, 1, 11, 4, 10.00, 4, 0, '2019-06-29 05:30:01', '2019-06-29 05:30:01'),
(15, 1, 4, 1, 35.00, 1, 0, '2019-06-30 03:14:54', '2019-06-30 03:14:54'),
(16, 1, 4, 2, 35.00, 2, 0, '2019-06-30 03:14:54', '2019-06-30 03:14:54'),
(17, 1, 4, 3, 20.00, 3, 0, '2019-06-30 03:14:54', '2019-06-30 03:14:54'),
(18, 1, 4, 4, 10.00, 4, 0, '2019-06-30 03:14:54', '2019-06-30 03:14:54'),
(19, 2, 1, 1, 35.00, 1, 0, '2019-06-30 23:50:12', '2019-06-30 23:50:12'),
(20, 2, 1, 2, 35.00, 1, 0, '2019-06-30 23:50:12', '2019-06-30 23:50:12'),
(21, 2, 1, 3, 20.00, 3, 0, '2019-06-30 23:50:12', '2019-06-30 23:50:12'),
(22, 2, 1, 4, 10.00, 4, 0, '2019-06-30 23:50:12', '2019-06-30 23:50:12'),
(23, 2, 2, 1, 35.00, 1, 0, '2019-06-30 23:50:12', '2019-06-30 23:50:12'),
(24, 2, 2, 2, 35.00, 2, 0, '2019-06-30 23:50:12', '2019-06-30 23:50:12'),
(25, 2, 2, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(26, 2, 2, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(27, 2, 3, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(28, 2, 3, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(29, 2, 3, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(30, 2, 3, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(31, 2, 4, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(32, 2, 4, 2, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(33, 2, 4, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(34, 2, 4, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(35, 2, 5, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(36, 2, 5, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(37, 2, 5, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(38, 2, 5, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(39, 2, 6, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(40, 2, 6, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(41, 2, 6, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(42, 2, 6, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(43, 2, 7, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(44, 2, 7, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(45, 2, 7, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(46, 2, 7, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(47, 2, 8, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(48, 2, 8, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(49, 2, 8, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(50, 2, 8, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(51, 2, 9, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(52, 2, 9, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(53, 2, 9, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(54, 2, 9, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(55, 2, 10, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(56, 2, 10, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(57, 2, 10, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(58, 2, 10, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(59, 2, 11, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(60, 2, 11, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(61, 2, 11, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(62, 2, 11, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(63, 2, 12, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(64, 2, 12, 2, 35.00, 2, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(65, 2, 12, 3, 20.00, 3, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(66, 2, 12, 4, 10.00, 4, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(67, 2, 13, 1, 35.00, 1, 0, '2019-06-30 23:50:13', '2019-06-30 23:50:13'),
(68, 2, 13, 2, 35.00, 2, 0, '2019-06-30 23:50:14', '2019-06-30 23:50:14'),
(69, 2, 13, 3, 20.00, 3, 0, '2019-06-30 23:50:14', '2019-06-30 23:50:14'),
(70, 2, 13, 4, 10.00, 4, 0, '2019-06-30 23:50:14', '2019-06-30 23:50:14');

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
  `cxm_in_percentage` double(8,2) DEFAULT NULL,
  `result_with_child` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_exam`
--

INSERT INTO `master_exam` (`id`, `programofferid`, `examnameid`, `exhld_in_percentage`, `mxm_in_percentage`, `cxm_in_percentage`, `result_with_child`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20.00, 100.00, 20.00, 1, 0, '2019-06-30 04:58:30', '2019-06-30 05:26:36'),
(2, 2, 1, 20.00, 100.00, 15.00, 1, 0, '2019-06-30 05:03:37', '2019-06-30 05:17:30');

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
(37, 'Course Offer', 'courseoffercreate', 69, 100, 0, '2019-05-19 23:41:32', '2019-06-27 02:00:17'),
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
(49, 'Students Registration', NULL, 0, 100, 0, '2019-05-21 00:32:56', '2019-06-16 05:35:28'),
(50, 'Student Enroll', 'student', 49, 100, 0, '2019-05-21 00:33:28', '2019-06-16 05:37:19'),
(51, 'Students Enroll', 'students', 49, 100, 0, '2019-05-21 00:34:24', '2019-06-16 05:36:53'),
(52, 'Exam Settings', NULL, 0, 100, 0, '2019-05-23 00:24:53', '2019-05-23 00:24:53'),
(53, 'Exam Name', 'examname', 52, 100, 0, '2019-05-23 00:25:17', '2019-05-23 00:25:17'),
(54, 'Master Exam', 'masterexam', 52, 100, 0, '2019-05-23 00:55:06', '2019-05-23 00:55:06'),
(55, 'Child Exam', 'childexam', 52, 100, 0, '2019-05-23 01:32:45', '2019-05-23 01:32:45'),
(56, 'Institute Settings', NULL, 0, 100, 0, '2019-05-30 02:12:24', '2019-05-30 02:12:24'),
(57, 'Institute', 'institute', 56, 100, 0, '2019-05-30 02:12:47', '2019-05-30 02:12:47'),
(58, 'Mark Entryt', NULL, 0, 100, 0, '2019-05-31 23:09:33', '2019-06-15 00:29:52'),
(59, 'Master Mark Entry', 'mstexammarkentry', 58, 100, 0, '2019-06-01 00:49:04', '2019-06-01 00:49:04'),
(60, 'Master Mark Edit', 'mstexammarkedit', 58, 100, 0, '2019-06-13 02:01:38', '2019-06-13 02:01:38'),
(61, 'Child Mark Entry', 'childexammarkentry', 58, 100, 0, '2019-06-13 06:11:23', '2019-06-13 06:11:50'),
(62, 'Child Mark Edit', 'childexammarkedit', 58, 100, 0, '2019-06-13 06:13:03', '2019-06-13 06:13:03'),
(63, 'Import/Export', NULL, 0, 100, 0, '2019-06-14 23:32:39', '2019-06-14 23:32:39'),
(64, 'Student Import', 'studentimport', 63, 100, 0, '2019-06-14 23:34:07', '2019-06-14 23:34:07'),
(65, 'Academic Result', NULL, 0, 100, 0, '2019-06-16 05:31:43', '2019-06-16 05:31:43'),
(66, 'Student Direct Enroll', 'directenroll', 49, 100, 0, '2019-06-16 22:25:02', '2019-06-16 22:25:02'),
(67, 'Master Exam Result', 'mstexamresult', 65, 100, 0, '2019-06-17 23:22:37', '2019-06-17 23:22:37'),
(68, 'Students Edit', 'editstudents', 49, 100, 0, '2019-06-20 03:15:45', '2019-06-20 03:15:45'),
(69, 'Course Offer Setting', NULL, 0, 100, 0, '2019-06-27 01:59:46', '2019-06-27 01:59:46'),
(70, 'Edit Course Offer', 'editcourseoffer', 69, 100, 0, '2019-06-27 02:02:33', '2019-06-27 02:02:33'),
(71, 'All Transcripts', 'transcripts', 65, 100, 0, '2019-07-04 04:20:43', '2019-07-04 04:20:43'),
(72, 'Transfer Certificate', 'transfer_certificate', 65, 100, 0, '2019-07-04 05:19:41', '2019-07-04 05:19:41');

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
(68, '2019_05_26_054545_create_level_programs_table', 4),
(69, '2019_05_26_055224_create_program_groups_table', 4),
(72, '2019_06_02_090752_create_mst_exam_marks_table', 5),
(74, '2019_02_05_064553_create_applicants_table', 6),
(75, '2019_06_15_052029_create_students_house_table', 6),
(76, '2019_07_10_071117_create_tbl_child_exam_table', 7),
(77, '2019_07_11_043631_create_child_exam_marks_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `mst_exam_marks`
--

CREATE TABLE `mst_exam_marks` (
  `id` int(10) UNSIGNED NOT NULL,
  `programofferid` int(11) NOT NULL,
  `sectionid` int(11) NOT NULL,
  `examnameid` int(11) NOT NULL,
  `examtypeid` int(11) DEFAULT NULL,
  `studentid` int(11) NOT NULL,
  `coursecodeid` int(11) NOT NULL,
  `markcategoryid` int(11) DEFAULT NULL,
  `marks` double(8,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_exam_marks`
--

INSERT INTO `mst_exam_marks` (`id`, `programofferid`, `sectionid`, `examnameid`, `examtypeid`, `studentid`, `coursecodeid`, `markcategoryid`, `marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 2, 1, 24.00, 0, '2019-06-29 05:08:33', '2019-06-29 05:08:33'),
(2, 1, 1, 1, 1, 1, 2, 2, 31.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(3, 1, 1, 1, 1, 1, 2, 3, 19.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(4, 1, 1, 1, 1, 1, 2, 4, 10.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(5, 1, 1, 1, 1, 2, 2, 1, 25.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(6, 1, 1, 1, 1, 2, 2, 2, 28.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(7, 1, 1, 1, 1, 2, 2, 3, 12.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(8, 1, 1, 1, 1, 2, 2, 4, 2.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(9, 1, 1, 1, 1, 3, 2, 1, 15.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(10, 1, 1, 1, 1, 3, 2, 2, 30.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(11, 1, 1, 1, 1, 3, 2, 3, 18.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(12, 1, 1, 1, 1, 3, 2, 4, 4.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(13, 1, 1, 1, 1, 4, 2, 1, 34.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(14, 1, 1, 1, 1, 4, 2, 2, 34.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(15, 1, 1, 1, 1, 4, 2, 3, 10.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(16, 1, 1, 1, 1, 4, 2, 4, 8.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(17, 1, 1, 1, 1, 5, 2, 1, 21.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(18, 1, 1, 1, 1, 5, 2, 2, 27.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(19, 1, 1, 1, 1, 5, 2, 3, 17.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(20, 1, 1, 1, 1, 5, 2, 4, 6.00, 0, '2019-06-29 05:08:34', '2019-06-29 05:08:34'),
(21, 1, 1, 1, 1, 1, 1, 1, 24.00, 0, '2019-06-29 05:12:41', '2019-06-29 05:12:41'),
(22, 1, 1, 1, 1, 1, 1, 2, 45.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(23, 1, 1, 1, 1, 2, 1, 1, 23.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(24, 1, 1, 1, 1, 2, 1, 2, 28.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(25, 1, 1, 1, 1, 3, 1, 1, 49.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(26, 1, 1, 1, 1, 3, 1, 2, 37.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(27, 1, 1, 1, 1, 4, 1, 1, 46.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(28, 1, 1, 1, 1, 4, 1, 2, 35.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(29, 1, 1, 1, 1, 5, 1, 1, 48.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(30, 1, 1, 1, 1, 5, 1, 2, 40.00, 0, '2019-06-29 05:12:42', '2019-06-29 05:12:42'),
(31, 1, 1, 1, 1, 1, 3, 1, 12.00, 0, '2019-06-29 05:28:23', '2019-06-29 05:28:23'),
(32, 1, 1, 1, 1, 1, 3, 2, 20.00, 0, '2019-06-29 05:28:23', '2019-06-29 05:28:23'),
(33, 1, 1, 1, 1, 1, 3, 3, 19.00, 0, '2019-06-29 05:28:23', '2019-06-29 05:28:23'),
(34, 1, 1, 1, 1, 1, 3, 4, 2.00, 0, '2019-06-29 05:28:23', '2019-06-29 05:28:23'),
(35, 1, 1, 1, 1, 2, 3, 1, 21.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(36, 1, 1, 1, 1, 2, 3, 2, 33.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(37, 1, 1, 1, 1, 2, 3, 3, 19.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(38, 1, 1, 1, 1, 2, 3, 4, 1.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(39, 1, 1, 1, 1, 3, 3, 1, 15.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(40, 1, 1, 1, 1, 3, 3, 2, 37.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(41, 1, 1, 1, 1, 3, 3, 3, 12.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(42, 1, 1, 1, 1, 3, 3, 4, 4.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(43, 1, 1, 1, 1, 4, 3, 1, 34.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(44, 1, 1, 1, 1, 4, 3, 2, 35.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(45, 1, 1, 1, 1, 4, 3, 3, 3.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(46, 1, 1, 1, 1, 4, 3, 4, 8.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(47, 1, 1, 1, 1, 5, 3, 1, 21.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(48, 1, 1, 1, 1, 5, 3, 2, 37.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(49, 1, 1, 1, 1, 5, 3, 3, 17.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(50, 1, 1, 1, 1, 5, 3, 4, 6.00, 0, '2019-06-29 05:28:24', '2019-06-29 05:28:24'),
(51, 1, 1, 1, 1, 1, 11, 1, 35.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(52, 1, 1, 1, 1, 1, 11, 2, 22.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(53, 1, 1, 1, 1, 1, 11, 3, 10.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(54, 1, 1, 1, 1, 1, 11, 4, 9.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(55, 1, 1, 1, 1, 2, 11, 1, 17.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(56, 1, 1, 1, 1, 2, 11, 2, 16.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(57, 1, 1, 1, 1, 2, 11, 3, 8.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(58, 1, 1, 1, 1, 2, 11, 4, 8.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(59, 1, 1, 1, 1, 3, 11, 1, 18.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(60, 1, 1, 1, 1, 3, 11, 2, 19.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(61, 1, 1, 1, 1, 3, 11, 3, 7.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(62, 1, 1, 1, 1, 3, 11, 4, 10.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(63, 1, 1, 1, 1, 4, 11, 1, 22.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(64, 1, 1, 1, 1, 4, 11, 2, 17.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(65, 1, 1, 1, 1, 4, 11, 3, 8.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(66, 1, 1, 1, 1, 4, 11, 4, 6.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(67, 1, 1, 1, 1, 5, 11, 1, 23.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(68, 1, 1, 1, 1, 5, 11, 2, 37.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(69, 1, 1, 1, 1, 5, 11, 3, 6.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(70, 1, 1, 1, 1, 5, 11, 4, 9.00, 0, '2019-06-29 05:32:05', '2019-06-29 05:32:05'),
(71, 2, 1, 1, 1, 6, 1, 1, 30.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(72, 2, 1, 1, 1, 6, 1, 2, 34.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(73, 2, 1, 1, 1, 6, 1, 3, 19.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(74, 2, 1, 1, 1, 6, 1, 4, 7.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(75, 2, 1, 1, 1, 7, 1, 1, 30.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(76, 2, 1, 1, 1, 7, 1, 2, 27.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(77, 2, 1, 1, 1, 7, 1, 3, 15.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(78, 2, 1, 1, 1, 7, 1, 4, 7.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(79, 2, 1, 1, 1, 8, 1, 1, 3.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(80, 2, 1, 1, 1, 8, 1, 2, 27.00, 0, '2019-06-30 23:59:58', '2019-06-30 23:59:58'),
(81, 2, 1, 1, 1, 8, 1, 3, 15.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(82, 2, 1, 1, 1, 8, 1, 4, 6.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(83, 2, 1, 1, 1, 9, 1, 1, 30.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(84, 2, 1, 1, 1, 9, 1, 2, 28.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(85, 2, 1, 1, 1, 9, 1, 3, 15.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(86, 2, 1, 1, 1, 9, 1, 4, 7.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(87, 2, 1, 1, 1, 10, 1, 1, 30.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(88, 2, 1, 1, 1, 10, 1, 2, 29.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(89, 2, 1, 1, 1, 10, 1, 3, 15.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(90, 2, 1, 1, 1, 10, 1, 4, 5.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(91, 2, 1, 1, 1, 11, 1, 1, 24.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(92, 2, 1, 1, 1, 11, 1, 2, 28.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(93, 2, 1, 1, 1, 11, 1, 3, 15.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(94, 2, 1, 1, 1, 11, 1, 4, 7.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(95, 2, 1, 1, 1, 12, 1, 1, 22.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(96, 2, 1, 1, 1, 12, 1, 2, 31.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(97, 2, 1, 1, 1, 12, 1, 3, 13.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(98, 2, 1, 1, 1, 12, 1, 4, 7.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(99, 2, 1, 1, 1, 13, 1, 1, 23.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(100, 2, 1, 1, 1, 13, 1, 2, 32.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(101, 2, 1, 1, 1, 13, 1, 3, 12.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(102, 2, 1, 1, 1, 13, 1, 4, 8.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(103, 2, 1, 1, 1, 14, 1, 1, 23.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(104, 2, 1, 1, 1, 14, 1, 2, 33.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(105, 2, 1, 1, 1, 14, 1, 3, 20.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(106, 2, 1, 1, 1, 14, 1, 4, 7.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(107, 2, 1, 1, 1, 15, 1, 1, 24.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(108, 2, 1, 1, 1, 15, 1, 2, 34.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(109, 2, 1, 1, 1, 15, 1, 3, 19.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(110, 2, 1, 1, 1, 15, 1, 4, 7.00, 0, '2019-06-30 23:59:59', '2019-06-30 23:59:59'),
(111, 2, 1, 1, 1, 6, 2, 1, 23.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(112, 2, 1, 1, 1, 6, 2, 2, 34.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(113, 2, 1, 1, 1, 6, 2, 3, 19.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(114, 2, 1, 1, 1, 6, 2, 4, 7.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(115, 2, 1, 1, 1, 7, 2, 1, 24.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(116, 2, 1, 1, 1, 7, 2, 2, 23.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(117, 2, 1, 1, 1, 7, 2, 3, 17.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(118, 2, 1, 1, 1, 7, 2, 4, 7.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(119, 2, 1, 1, 1, 8, 2, 1, 16.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(120, 2, 1, 1, 1, 8, 2, 2, 23.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(121, 2, 1, 1, 1, 8, 2, 3, 17.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(122, 2, 1, 1, 1, 8, 2, 4, 3.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(123, 2, 1, 1, 1, 9, 2, 1, 33.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(124, 2, 1, 1, 1, 9, 2, 2, 12.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(125, 2, 1, 1, 1, 9, 2, 3, 18.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(126, 2, 1, 1, 1, 9, 2, 4, 4.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(127, 2, 1, 1, 1, 10, 2, 1, 21.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(128, 2, 1, 1, 1, 10, 2, 2, 15.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(129, 2, 1, 1, 1, 10, 2, 3, 18.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(130, 2, 1, 1, 1, 10, 2, 4, 5.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(131, 2, 1, 1, 1, 11, 2, 1, 22.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(132, 2, 1, 1, 1, 11, 2, 2, 19.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(133, 2, 1, 1, 1, 11, 2, 3, 13.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(134, 2, 1, 1, 1, 11, 2, 4, 7.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(135, 2, 1, 1, 1, 12, 2, 1, 29.00, 0, '2019-07-01 00:01:45', '2019-07-01 00:01:45'),
(136, 2, 1, 1, 1, 12, 2, 2, 21.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(137, 2, 1, 1, 1, 12, 2, 3, 14.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(138, 2, 1, 1, 1, 12, 2, 4, 7.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(139, 2, 1, 1, 1, 13, 2, 1, 25.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(140, 2, 1, 1, 1, 13, 2, 2, 27.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(141, 2, 1, 1, 1, 13, 2, 3, 15.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(142, 2, 1, 1, 1, 13, 2, 4, 8.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(143, 2, 1, 1, 1, 14, 2, 1, 25.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(144, 2, 1, 1, 1, 14, 2, 2, 28.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(145, 2, 1, 1, 1, 14, 2, 3, 15.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(146, 2, 1, 1, 1, 14, 2, 4, 7.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(147, 2, 1, 1, 1, 15, 2, 1, 25.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(148, 2, 1, 1, 1, 15, 2, 2, 29.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(149, 2, 1, 1, 1, 15, 2, 3, 15.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(150, 2, 1, 1, 1, 15, 2, 4, 7.00, 0, '2019-07-01 00:01:46', '2019-07-01 00:01:46'),
(151, 2, 1, 1, 1, 6, 3, 1, 23.00, 0, '2019-07-01 00:03:45', '2019-07-01 00:03:45'),
(152, 2, 1, 1, 1, 6, 3, 2, 34.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(153, 2, 1, 1, 1, 6, 3, 3, 19.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(154, 2, 1, 1, 1, 6, 3, 4, 8.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(155, 2, 1, 1, 1, 7, 3, 1, 24.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(156, 2, 1, 1, 1, 7, 3, 2, 27.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(157, 2, 1, 1, 1, 7, 3, 3, 15.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(158, 2, 1, 1, 1, 7, 3, 4, 7.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(159, 2, 1, 1, 1, 8, 3, 1, 34.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(160, 2, 1, 1, 1, 8, 3, 2, 24.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(161, 2, 1, 1, 1, 8, 3, 3, 21.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(162, 2, 1, 1, 1, 8, 3, 4, 5.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(163, 2, 1, 1, 1, 9, 3, 1, 30.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(164, 2, 1, 1, 1, 9, 3, 2, 25.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(165, 2, 1, 1, 1, 9, 3, 3, 40.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(166, 2, 1, 1, 1, 9, 3, 4, 7.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(167, 2, 1, 1, 1, 10, 3, 1, 21.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(168, 2, 1, 1, 1, 10, 3, 2, 15.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(169, 2, 1, 1, 1, 10, 3, 3, 15.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(170, 2, 1, 1, 1, 10, 3, 4, 5.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(171, 2, 1, 1, 1, 11, 3, 1, 22.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(172, 2, 1, 1, 1, 11, 3, 2, 23.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(173, 2, 1, 1, 1, 11, 3, 3, 15.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(174, 2, 1, 1, 1, 11, 3, 4, 7.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(175, 2, 1, 1, 1, 12, 3, 1, 22.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(176, 2, 1, 1, 1, 12, 3, 2, 31.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(177, 2, 1, 1, 1, 12, 3, 3, 13.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(178, 2, 1, 1, 1, 12, 3, 4, 7.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(179, 2, 1, 1, 1, 13, 3, 1, 25.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(180, 2, 1, 1, 1, 13, 3, 2, 32.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(181, 2, 1, 1, 1, 13, 3, 3, 15.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(182, 2, 1, 1, 1, 13, 3, 4, 8.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(183, 2, 1, 1, 1, 14, 3, 1, 25.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(184, 2, 1, 1, 1, 14, 3, 2, 33.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(185, 2, 1, 1, 1, 14, 3, 3, 15.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(186, 2, 1, 1, 1, 14, 3, 4, 7.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(187, 2, 1, 1, 1, 15, 3, 1, 25.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(188, 2, 1, 1, 1, 15, 3, 2, 34.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(189, 2, 1, 1, 1, 15, 3, 3, 19.00, 0, '2019-07-01 00:03:46', '2019-07-01 00:03:46'),
(190, 2, 1, 1, 1, 15, 3, 4, 7.00, 0, '2019-07-01 00:03:47', '2019-07-01 00:03:47'),
(191, 2, 1, 1, 1, 6, 4, 1, 23.00, 0, '2019-07-01 00:05:30', '2019-07-01 00:05:30'),
(192, 2, 1, 1, 1, 6, 4, 2, 34.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(193, 2, 1, 1, 1, 6, 4, 3, 19.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(194, 2, 1, 1, 1, 6, 4, 4, 7.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(195, 2, 1, 1, 1, 7, 4, 1, 24.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(196, 2, 1, 1, 1, 7, 4, 2, 27.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(197, 2, 1, 1, 1, 7, 4, 3, 15.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(198, 2, 1, 1, 1, 7, 4, 4, 7.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(199, 2, 1, 1, 1, 8, 4, 1, 34.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(200, 2, 1, 1, 1, 8, 4, 2, 23.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(201, 2, 1, 1, 1, 8, 4, 3, 10.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(202, 2, 1, 1, 1, 8, 4, 4, 3.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(203, 2, 1, 1, 1, 9, 4, 1, 15.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(204, 2, 1, 1, 1, 9, 4, 2, 24.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(205, 2, 1, 1, 1, 9, 4, 3, 11.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(206, 2, 1, 1, 1, 9, 4, 4, 7.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(207, 2, 1, 1, 1, 10, 4, 1, 30.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(208, 2, 1, 1, 1, 10, 4, 2, 15.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(209, 2, 1, 1, 1, 10, 4, 3, 12.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(210, 2, 1, 1, 1, 10, 4, 4, 5.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(211, 2, 1, 1, 1, 11, 4, 1, 31.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(212, 2, 1, 1, 1, 11, 4, 2, 10.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(213, 2, 1, 1, 1, 11, 4, 3, 13.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(214, 2, 1, 1, 1, 11, 4, 4, 7.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(215, 2, 1, 1, 1, 12, 4, 1, 32.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(216, 2, 1, 1, 1, 12, 4, 2, 35.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(217, 2, 1, 1, 1, 12, 4, 3, 14.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(218, 2, 1, 1, 1, 12, 4, 4, 7.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(219, 2, 1, 1, 1, 13, 4, 1, 35.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(220, 2, 1, 1, 1, 13, 4, 2, 32.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(221, 2, 1, 1, 1, 13, 4, 3, 15.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(222, 2, 1, 1, 1, 13, 4, 4, 8.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(223, 2, 1, 1, 1, 14, 4, 1, 35.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(224, 2, 1, 1, 1, 14, 4, 2, 33.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(225, 2, 1, 1, 1, 14, 4, 3, 16.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(226, 2, 1, 1, 1, 14, 4, 4, 7.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(227, 2, 1, 1, 1, 15, 4, 1, 24.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(228, 2, 1, 1, 1, 15, 4, 2, 22.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(229, 2, 1, 1, 1, 15, 4, 3, 17.00, 0, '2019-07-01 00:05:31', '2019-07-01 00:05:31'),
(230, 2, 1, 1, 1, 15, 4, 4, 7.00, 0, '2019-07-01 00:05:32', '2019-07-01 00:05:32'),
(231, 2, 1, 1, 1, 6, 5, 1, 23.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(232, 2, 1, 1, 1, 6, 5, 2, 34.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(233, 2, 1, 1, 1, 6, 5, 3, 19.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(234, 2, 1, 1, 1, 6, 5, 4, 7.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(235, 2, 1, 1, 1, 7, 5, 1, 24.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(236, 2, 1, 1, 1, 7, 5, 2, 27.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(237, 2, 1, 1, 1, 7, 5, 3, 16.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(238, 2, 1, 1, 1, 7, 5, 4, 7.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(239, 2, 1, 1, 1, 8, 5, 1, 16.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(240, 2, 1, 1, 1, 8, 5, 2, 21.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(241, 2, 1, 1, 1, 8, 5, 3, 15.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(242, 2, 1, 1, 1, 8, 5, 4, 5.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(243, 2, 1, 1, 1, 9, 5, 1, 15.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(244, 2, 1, 1, 1, 9, 5, 2, 25.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(245, 2, 1, 1, 1, 9, 5, 3, 14.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(246, 2, 1, 1, 1, 9, 5, 4, 4.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(247, 2, 1, 1, 1, 10, 5, 1, 21.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(248, 2, 1, 1, 1, 10, 5, 2, 34.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(249, 2, 1, 1, 1, 10, 5, 3, 13.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(250, 2, 1, 1, 1, 10, 5, 4, 5.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(251, 2, 1, 1, 1, 11, 5, 1, 22.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(252, 2, 1, 1, 1, 11, 5, 2, 35.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(253, 2, 1, 1, 1, 11, 5, 3, 12.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(254, 2, 1, 1, 1, 11, 5, 4, 7.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(255, 2, 1, 1, 1, 12, 5, 1, 22.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(256, 2, 1, 1, 1, 12, 5, 2, 33.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(257, 2, 1, 1, 1, 12, 5, 3, 12.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(258, 2, 1, 1, 1, 12, 5, 4, 7.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(259, 2, 1, 1, 1, 13, 5, 1, 25.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(260, 2, 1, 1, 1, 13, 5, 2, 32.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(261, 2, 1, 1, 1, 13, 5, 3, 16.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(262, 2, 1, 1, 1, 13, 5, 4, 8.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(263, 2, 1, 1, 1, 14, 5, 1, 25.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(264, 2, 1, 1, 1, 14, 5, 2, 11.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(265, 2, 1, 1, 1, 14, 5, 3, 17.00, 0, '2019-07-01 00:07:28', '2019-07-01 00:07:28'),
(266, 2, 1, 1, 1, 14, 5, 4, 7.00, 0, '2019-07-01 00:07:29', '2019-07-01 00:07:29'),
(267, 2, 1, 1, 1, 15, 5, 1, 25.00, 0, '2019-07-01 00:07:29', '2019-07-01 00:07:29'),
(268, 2, 1, 1, 1, 15, 5, 2, 16.00, 0, '2019-07-01 00:07:29', '2019-07-01 00:07:29'),
(269, 2, 1, 1, 1, 15, 5, 3, 18.00, 0, '2019-07-01 00:07:29', '2019-07-01 00:07:29'),
(270, 2, 1, 1, 1, 15, 5, 4, 7.00, 0, '2019-07-01 00:07:29', '2019-07-01 00:07:29'),
(271, 2, 1, 1, 1, 6, 6, 1, 23.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(272, 2, 1, 1, 1, 6, 6, 2, 34.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(273, 2, 1, 1, 1, 6, 6, 3, 19.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(274, 2, 1, 1, 1, 6, 6, 4, 6.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(275, 2, 1, 1, 1, 7, 6, 1, 24.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(276, 2, 1, 1, 1, 7, 6, 2, 27.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(277, 2, 1, 1, 1, 7, 6, 3, 17.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(278, 2, 1, 1, 1, 7, 6, 4, 6.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(279, 2, 1, 1, 1, 8, 6, 1, 34.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(280, 2, 1, 1, 1, 8, 6, 2, 17.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(281, 2, 1, 1, 1, 8, 6, 3, 14.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(282, 2, 1, 1, 1, 8, 6, 4, 6.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(283, 2, 1, 1, 1, 9, 6, 1, 24.00, 0, '2019-07-01 00:09:05', '2019-07-01 00:09:05'),
(284, 2, 1, 1, 1, 9, 6, 2, 24.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(285, 2, 1, 1, 1, 9, 6, 3, 11.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(286, 2, 1, 1, 1, 9, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(287, 2, 1, 1, 1, 10, 6, 1, 30.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(288, 2, 1, 1, 1, 10, 6, 2, 15.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(289, 2, 1, 1, 1, 10, 6, 3, 15.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(290, 2, 1, 1, 1, 10, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(291, 2, 1, 1, 1, 11, 6, 1, 31.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(292, 2, 1, 1, 1, 11, 6, 2, 28.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(293, 2, 1, 1, 1, 11, 6, 3, 15.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(294, 2, 1, 1, 1, 11, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(295, 2, 1, 1, 1, 12, 6, 1, 22.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(296, 2, 1, 1, 1, 12, 6, 2, 31.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(297, 2, 1, 1, 1, 12, 6, 3, 13.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(298, 2, 1, 1, 1, 12, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(299, 2, 1, 1, 1, 13, 6, 1, 25.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(300, 2, 1, 1, 1, 13, 6, 2, 32.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(301, 2, 1, 1, 1, 13, 6, 3, 15.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(302, 2, 1, 1, 1, 13, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(303, 2, 1, 1, 1, 14, 6, 1, 25.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(304, 2, 1, 1, 1, 14, 6, 2, 11.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(305, 2, 1, 1, 1, 14, 6, 3, 17.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(306, 2, 1, 1, 1, 14, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(307, 2, 1, 1, 1, 15, 6, 1, 25.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(308, 2, 1, 1, 1, 15, 6, 2, 34.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(309, 2, 1, 1, 1, 15, 6, 3, 18.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(310, 2, 1, 1, 1, 15, 6, 4, 6.00, 0, '2019-07-01 00:09:06', '2019-07-01 00:09:06'),
(311, 2, 1, 1, 1, 6, 7, 1, 3.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(312, 2, 1, 1, 1, 6, 7, 2, 34.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(313, 2, 1, 1, 1, 6, 7, 3, 19.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(314, 2, 1, 1, 1, 6, 7, 4, 5.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(315, 2, 1, 1, 1, 7, 7, 1, 33.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(316, 2, 1, 1, 1, 7, 7, 2, 27.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(317, 2, 1, 1, 1, 7, 7, 3, 15.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(318, 2, 1, 1, 1, 7, 7, 4, 7.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(319, 2, 1, 1, 1, 8, 7, 1, 33.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(320, 2, 1, 1, 1, 8, 7, 2, 23.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(321, 2, 1, 1, 1, 8, 7, 3, 19.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(322, 2, 1, 1, 1, 8, 7, 4, 7.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(323, 2, 1, 1, 1, 9, 7, 1, 23.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(324, 2, 1, 1, 1, 9, 7, 2, 16.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(325, 2, 1, 1, 1, 9, 7, 3, 19.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(326, 2, 1, 1, 1, 9, 7, 4, 7.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(327, 2, 1, 1, 1, 10, 7, 1, 24.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(328, 2, 1, 1, 1, 10, 7, 2, 15.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(329, 2, 1, 1, 1, 10, 7, 3, 15.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(330, 2, 1, 1, 1, 10, 7, 4, 5.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(331, 2, 1, 1, 1, 11, 7, 1, 32.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(332, 2, 1, 1, 1, 11, 7, 2, 28.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(333, 2, 1, 1, 1, 11, 7, 3, 15.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(334, 2, 1, 1, 1, 11, 7, 4, 7.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(335, 2, 1, 1, 1, 12, 7, 1, 23.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(336, 2, 1, 1, 1, 12, 7, 2, 31.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(337, 2, 1, 1, 1, 12, 7, 3, 13.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(338, 2, 1, 1, 1, 12, 7, 4, 7.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(339, 2, 1, 1, 1, 13, 7, 1, 24.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(340, 2, 1, 1, 1, 13, 7, 2, 32.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(341, 2, 1, 1, 1, 13, 7, 3, 15.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(342, 2, 1, 1, 1, 13, 7, 4, 8.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(343, 2, 1, 1, 1, 14, 7, 1, 23.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(344, 2, 1, 1, 1, 14, 7, 2, 33.00, 0, '2019-07-01 00:17:34', '2019-07-01 00:17:34'),
(345, 2, 1, 1, 1, 14, 7, 3, 15.00, 0, '2019-07-01 00:17:35', '2019-07-01 00:17:35'),
(346, 2, 1, 1, 1, 14, 7, 4, 7.00, 0, '2019-07-01 00:17:35', '2019-07-01 00:17:35'),
(347, 2, 1, 1, 1, 15, 7, 1, 4.00, 0, '2019-07-01 00:17:35', '2019-07-01 00:17:35'),
(348, 2, 1, 1, 1, 15, 7, 2, 29.00, 0, '2019-07-01 00:17:35', '2019-07-01 00:17:35'),
(349, 2, 1, 1, 1, 15, 7, 3, 17.00, 0, '2019-07-01 00:17:35', '2019-07-01 00:17:35'),
(350, 2, 1, 1, 1, 15, 7, 4, 6.00, 0, '2019-07-01 00:17:35', '2019-07-01 00:17:35'),
(351, 2, 1, 1, 1, 6, 8, 1, 23.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(352, 2, 1, 1, 1, 6, 8, 2, 34.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(353, 2, 1, 1, 1, 6, 8, 3, 19.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(354, 2, 1, 1, 1, 6, 8, 4, 7.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(355, 2, 1, 1, 1, 7, 8, 1, 24.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(356, 2, 1, 1, 1, 7, 8, 2, 27.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(357, 2, 1, 1, 1, 7, 8, 3, 15.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(358, 2, 1, 1, 1, 7, 8, 4, 6.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(359, 2, 1, 1, 1, 8, 8, 1, 34.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(360, 2, 1, 1, 1, 8, 8, 2, 23.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(361, 2, 1, 1, 1, 8, 8, 3, 19.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(362, 2, 1, 1, 1, 8, 8, 4, 4.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(363, 2, 1, 1, 1, 9, 8, 1, 24.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(364, 2, 1, 1, 1, 9, 8, 2, 24.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(365, 2, 1, 1, 1, 9, 8, 3, 18.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(366, 2, 1, 1, 1, 9, 8, 4, 4.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(367, 2, 1, 1, 1, 10, 8, 1, 21.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(368, 2, 1, 1, 1, 10, 8, 2, 15.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(369, 2, 1, 1, 1, 10, 8, 3, 15.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(370, 2, 1, 1, 1, 10, 8, 4, 6.00, 0, '2019-07-01 00:20:31', '2019-07-01 00:20:31'),
(371, 2, 1, 1, 1, 11, 8, 1, 22.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(372, 2, 1, 1, 1, 11, 8, 2, 28.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(373, 2, 1, 1, 1, 11, 8, 3, 15.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(374, 2, 1, 1, 1, 11, 8, 4, 7.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(375, 2, 1, 1, 1, 12, 8, 1, 22.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(376, 2, 1, 1, 1, 12, 8, 2, 31.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(377, 2, 1, 1, 1, 12, 8, 3, 13.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(378, 2, 1, 1, 1, 12, 8, 4, 7.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(379, 2, 1, 1, 1, 13, 8, 1, 25.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(380, 2, 1, 1, 1, 13, 8, 2, 32.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(381, 2, 1, 1, 1, 13, 8, 3, 15.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(382, 2, 1, 1, 1, 13, 8, 4, 8.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(383, 2, 1, 1, 1, 14, 8, 1, 25.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(384, 2, 1, 1, 1, 14, 8, 2, 28.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(385, 2, 1, 1, 1, 14, 8, 3, 16.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(386, 2, 1, 1, 1, 14, 8, 4, 5.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(387, 2, 1, 1, 1, 15, 8, 1, 25.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(388, 2, 1, 1, 1, 15, 8, 2, 16.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(389, 2, 1, 1, 1, 15, 8, 3, 15.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(390, 2, 1, 1, 1, 15, 8, 4, 5.00, 0, '2019-07-01 00:20:32', '2019-07-01 00:20:32'),
(391, 2, 1, 1, 1, 6, 9, 1, 23.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(392, 2, 1, 1, 1, 6, 9, 2, 34.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(393, 2, 1, 1, 1, 6, 9, 3, 19.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(394, 2, 1, 1, 1, 6, 9, 4, 7.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(395, 2, 1, 1, 1, 7, 9, 1, 24.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(396, 2, 1, 1, 1, 7, 9, 2, 15.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(397, 2, 1, 1, 1, 7, 9, 3, 18.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(398, 2, 1, 1, 1, 7, 9, 4, 7.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(399, 2, 1, 1, 1, 8, 9, 1, 21.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(400, 2, 1, 1, 1, 8, 9, 2, 23.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(401, 2, 1, 1, 1, 8, 9, 3, 18.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(402, 2, 1, 1, 1, 8, 9, 4, 3.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(403, 2, 1, 1, 1, 9, 9, 1, 24.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(404, 2, 1, 1, 1, 9, 9, 2, 24.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(405, 2, 1, 1, 1, 9, 9, 3, 11.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(406, 2, 1, 1, 1, 9, 9, 4, 4.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(407, 2, 1, 1, 1, 10, 9, 1, 27.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(408, 2, 1, 1, 1, 10, 9, 2, 15.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(409, 2, 1, 1, 1, 10, 9, 3, 15.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(410, 2, 1, 1, 1, 10, 9, 4, 5.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(411, 2, 1, 1, 1, 11, 9, 1, 22.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(412, 2, 1, 1, 1, 11, 9, 2, 28.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(413, 2, 1, 1, 1, 11, 9, 3, 15.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(414, 2, 1, 1, 1, 11, 9, 4, 7.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(415, 2, 1, 1, 1, 12, 9, 1, 22.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(416, 2, 1, 1, 1, 12, 9, 2, 31.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(417, 2, 1, 1, 1, 12, 9, 3, 13.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(418, 2, 1, 1, 1, 12, 9, 4, 7.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(419, 2, 1, 1, 1, 13, 9, 1, 25.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(420, 2, 1, 1, 1, 13, 9, 2, 32.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(421, 2, 1, 1, 1, 13, 9, 3, 15.00, 0, '2019-07-01 00:22:19', '2019-07-01 00:22:19'),
(422, 2, 1, 1, 1, 13, 9, 4, 8.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(423, 2, 1, 1, 1, 14, 9, 1, 25.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(424, 2, 1, 1, 1, 14, 9, 2, 33.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(425, 2, 1, 1, 1, 14, 9, 3, 17.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(426, 2, 1, 1, 1, 14, 9, 4, 7.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(427, 2, 1, 1, 1, 15, 9, 1, 25.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(428, 2, 1, 1, 1, 15, 9, 2, 22.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(429, 2, 1, 1, 1, 15, 9, 3, 18.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(430, 2, 1, 1, 1, 15, 9, 4, 5.00, 0, '2019-07-01 00:22:20', '2019-07-01 00:22:20'),
(431, 2, 1, 1, 1, 6, 10, 1, 23.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(432, 2, 1, 1, 1, 6, 10, 2, 34.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(433, 2, 1, 1, 1, 6, 10, 3, 19.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(434, 2, 1, 1, 1, 6, 10, 4, 7.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(435, 2, 1, 1, 1, 7, 10, 1, 24.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(436, 2, 1, 1, 1, 7, 10, 2, 27.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(437, 2, 1, 1, 1, 7, 10, 3, 15.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(438, 2, 1, 1, 1, 7, 10, 4, 7.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(439, 2, 1, 1, 1, 8, 10, 1, 34.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(440, 2, 1, 1, 1, 8, 10, 2, 23.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(441, 2, 1, 1, 1, 8, 10, 3, 18.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(442, 2, 1, 1, 1, 8, 10, 4, 3.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(443, 2, 1, 1, 1, 9, 10, 1, 33.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(444, 2, 1, 1, 1, 9, 10, 2, 24.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(445, 2, 1, 1, 1, 9, 10, 3, 11.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(446, 2, 1, 1, 1, 9, 10, 4, 4.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(447, 2, 1, 1, 1, 10, 10, 1, 21.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(448, 2, 1, 1, 1, 10, 10, 2, 15.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(449, 2, 1, 1, 1, 10, 10, 3, 15.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(450, 2, 1, 1, 1, 10, 10, 4, 5.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(451, 2, 1, 1, 1, 11, 10, 1, 22.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(452, 2, 1, 1, 1, 11, 10, 2, 28.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(453, 2, 1, 1, 1, 11, 10, 3, 15.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(454, 2, 1, 1, 1, 11, 10, 4, 7.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(455, 2, 1, 1, 1, 12, 10, 1, 32.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(456, 2, 1, 1, 1, 12, 10, 2, 31.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(457, 2, 1, 1, 1, 12, 10, 3, 13.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(458, 2, 1, 1, 1, 12, 10, 4, 7.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(459, 2, 1, 1, 1, 13, 10, 1, 25.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(460, 2, 1, 1, 1, 13, 10, 2, 32.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(461, 2, 1, 1, 1, 13, 10, 3, 15.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(462, 2, 1, 1, 1, 13, 10, 4, 8.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(463, 2, 1, 1, 1, 14, 10, 1, 25.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(464, 2, 1, 1, 1, 14, 10, 2, 33.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(465, 2, 1, 1, 1, 14, 10, 3, 15.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(466, 2, 1, 1, 1, 14, 10, 4, 7.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(467, 2, 1, 1, 1, 15, 10, 1, 25.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(468, 2, 1, 1, 1, 15, 10, 2, 16.00, 0, '2019-07-01 00:23:40', '2019-07-01 00:23:40'),
(469, 2, 1, 1, 1, 15, 10, 3, 17.00, 0, '2019-07-01 00:23:41', '2019-07-01 00:23:41'),
(470, 2, 1, 1, 1, 15, 10, 4, 7.00, 0, '2019-07-01 00:23:41', '2019-07-01 00:23:41'),
(471, 2, 1, 1, 1, 6, 11, 1, 23.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(472, 2, 1, 1, 1, 6, 11, 2, 34.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(473, 2, 1, 1, 1, 6, 11, 3, 19.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(474, 2, 1, 1, 1, 6, 11, 4, 7.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(475, 2, 1, 1, 1, 7, 11, 1, 24.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(476, 2, 1, 1, 1, 7, 11, 2, 27.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(477, 2, 1, 1, 1, 7, 11, 3, 15.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(478, 2, 1, 1, 1, 7, 11, 4, 7.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(479, 2, 1, 1, 1, 8, 11, 1, 34.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(480, 2, 1, 1, 1, 8, 11, 2, 23.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(481, 2, 1, 1, 1, 8, 11, 3, 14.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(482, 2, 1, 1, 1, 8, 11, 4, 3.00, 0, '2019-07-01 00:25:49', '2019-07-01 00:25:49'),
(483, 2, 1, 1, 1, 9, 11, 1, 30.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(484, 2, 1, 1, 1, 9, 11, 2, 29.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(485, 2, 1, 1, 1, 9, 11, 3, 18.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(486, 2, 1, 1, 1, 9, 11, 4, 4.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(487, 2, 1, 1, 1, 10, 11, 1, 21.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(488, 2, 1, 1, 1, 10, 11, 2, 15.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(489, 2, 1, 1, 1, 10, 11, 3, 15.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(490, 2, 1, 1, 1, 10, 11, 4, 5.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(491, 2, 1, 1, 1, 11, 11, 1, 22.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(492, 2, 1, 1, 1, 11, 11, 2, 35.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(493, 2, 1, 1, 1, 11, 11, 3, 15.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(494, 2, 1, 1, 1, 11, 11, 4, 7.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(495, 2, 1, 1, 1, 12, 11, 1, 22.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(496, 2, 1, 1, 1, 12, 11, 2, 33.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(497, 2, 1, 1, 1, 12, 11, 3, 13.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(498, 2, 1, 1, 1, 12, 11, 4, 7.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(499, 2, 1, 1, 1, 13, 11, 1, 25.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(500, 2, 1, 1, 1, 13, 11, 2, 32.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(501, 2, 1, 1, 1, 13, 11, 3, 16.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(502, 2, 1, 1, 1, 13, 11, 4, 8.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(503, 2, 1, 1, 1, 14, 11, 1, 25.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(504, 2, 1, 1, 1, 14, 11, 2, 33.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(505, 2, 1, 1, 1, 14, 11, 3, 15.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(506, 2, 1, 1, 1, 14, 11, 4, 7.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(507, 2, 1, 1, 1, 15, 11, 1, 25.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(508, 2, 1, 1, 1, 15, 11, 2, 22.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(509, 2, 1, 1, 1, 15, 11, 3, 19.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(510, 2, 1, 1, 1, 15, 11, 4, 7.00, 0, '2019-07-01 00:25:50', '2019-07-01 00:25:50'),
(511, 2, 1, 1, 1, 6, 12, 1, 23.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(512, 2, 1, 1, 1, 6, 12, 2, 34.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(513, 2, 1, 1, 1, 6, 12, 3, 19.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(514, 2, 1, 1, 1, 6, 12, 4, 7.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(515, 2, 1, 1, 1, 7, 12, 1, 24.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(516, 2, 1, 1, 1, 7, 12, 2, 27.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(517, 2, 1, 1, 1, 7, 12, 3, 15.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(518, 2, 1, 1, 1, 7, 12, 4, 7.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(519, 2, 1, 1, 1, 8, 12, 1, 34.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(520, 2, 1, 1, 1, 8, 12, 2, 23.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(521, 2, 1, 1, 1, 8, 12, 3, 15.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(522, 2, 1, 1, 1, 8, 12, 4, 5.00, 0, '2019-07-01 00:30:39', '2019-07-01 00:30:39'),
(523, 2, 1, 1, 1, 9, 12, 1, 24.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(524, 2, 1, 1, 1, 9, 12, 2, 24.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(525, 2, 1, 1, 1, 9, 12, 3, 11.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(526, 2, 1, 1, 1, 9, 12, 4, 4.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(527, 2, 1, 1, 1, 10, 12, 1, 21.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(528, 2, 1, 1, 1, 10, 12, 2, 15.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(529, 2, 1, 1, 1, 10, 12, 3, 18.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(530, 2, 1, 1, 1, 10, 12, 4, 5.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(531, 2, 1, 1, 1, 11, 12, 1, 22.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(532, 2, 1, 1, 1, 11, 12, 2, 28.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(533, 2, 1, 1, 1, 11, 12, 3, 15.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(534, 2, 1, 1, 1, 11, 12, 4, 7.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(535, 2, 1, 1, 1, 12, 12, 1, 22.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(536, 2, 1, 1, 1, 12, 12, 2, 31.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(537, 2, 1, 1, 1, 12, 12, 3, 13.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(538, 2, 1, 1, 1, 12, 12, 4, 7.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(539, 2, 1, 1, 1, 13, 12, 1, 25.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(540, 2, 1, 1, 1, 13, 12, 2, 32.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(541, 2, 1, 1, 1, 13, 12, 3, 15.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(542, 2, 1, 1, 1, 13, 12, 4, 8.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(543, 2, 1, 1, 1, 14, 12, 1, 25.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(544, 2, 1, 1, 1, 14, 12, 2, 28.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(545, 2, 1, 1, 1, 14, 12, 3, 20.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(546, 2, 1, 1, 1, 14, 12, 4, 5.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(547, 2, 1, 1, 1, 15, 12, 1, 25.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(548, 2, 1, 1, 1, 15, 12, 2, 16.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(549, 2, 1, 1, 1, 15, 12, 3, 18.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(550, 2, 1, 1, 1, 15, 12, 4, 5.00, 0, '2019-07-01 00:30:40', '2019-07-01 00:30:40'),
(551, 2, 1, 1, 1, 6, 13, 1, 23.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(552, 2, 1, 1, 1, 6, 13, 2, 34.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(553, 2, 1, 1, 1, 6, 13, 3, 19.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(554, 2, 1, 1, 1, 6, 13, 4, 6.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(555, 2, 1, 1, 1, 7, 13, 1, 24.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(556, 2, 1, 1, 1, 7, 13, 2, 27.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(557, 2, 1, 1, 1, 7, 13, 3, 15.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(558, 2, 1, 1, 1, 7, 13, 4, 7.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(559, 2, 1, 1, 1, 8, 13, 1, 34.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(560, 2, 1, 1, 1, 8, 13, 2, 23.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(561, 2, 1, 1, 1, 8, 13, 3, 21.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(562, 2, 1, 1, 1, 8, 13, 4, 3.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(563, 2, 1, 1, 1, 9, 13, 1, 24.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(564, 2, 1, 1, 1, 9, 13, 2, 24.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(565, 2, 1, 1, 1, 9, 13, 3, 11.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(566, 2, 1, 1, 1, 9, 13, 4, 4.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(567, 2, 1, 1, 1, 10, 13, 1, 21.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(568, 2, 1, 1, 1, 10, 13, 2, 15.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(569, 2, 1, 1, 1, 10, 13, 3, 15.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(570, 2, 1, 1, 1, 10, 13, 4, 5.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(571, 2, 1, 1, 1, 11, 13, 1, 22.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(572, 2, 1, 1, 1, 11, 13, 2, 28.00, 0, '2019-07-01 00:32:39', '2019-07-01 00:32:39'),
(573, 2, 1, 1, 1, 11, 13, 3, 15.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(574, 2, 1, 1, 1, 11, 13, 4, 7.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(575, 2, 1, 1, 1, 12, 13, 1, 22.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(576, 2, 1, 1, 1, 12, 13, 2, 31.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(577, 2, 1, 1, 1, 12, 13, 3, 13.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(578, 2, 1, 1, 1, 12, 13, 4, 7.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(579, 2, 1, 1, 1, 13, 13, 1, 25.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(580, 2, 1, 1, 1, 13, 13, 2, 32.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(581, 2, 1, 1, 1, 13, 13, 3, 15.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(582, 2, 1, 1, 1, 13, 13, 4, 8.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(583, 2, 1, 1, 1, 14, 13, 1, 25.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(584, 2, 1, 1, 1, 14, 13, 2, 28.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(585, 2, 1, 1, 1, 14, 13, 3, 16.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(586, 2, 1, 1, 1, 14, 13, 4, 6.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(587, 2, 1, 1, 1, 15, 13, 1, 25.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(588, 2, 1, 1, 1, 15, 13, 2, 22.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(589, 2, 1, 1, 1, 15, 13, 3, 15.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40'),
(590, 2, 1, 1, 1, 15, 13, 4, 6.00, 0, '2019-07-01 00:32:40', '2019-07-01 00:32:40');

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
  `number_of_courses` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programoffers`
--

INSERT INTO `programoffers` (`id`, `sessionid`, `programid`, `groupid`, `mediumid`, `shiftid`, `cordinator`, `seat`, `number_of_courses`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 1, 1, NULL, 200, 12, 0, '2019-05-02 00:58:04', '2019-05-02 00:58:04'),
(2, 1, 3, 2, 1, 1, NULL, 200, 12, 0, '2019-05-02 01:00:06', '2019-05-02 01:00:06');

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
(1, 59, 1),
(1, 59, 2),
(1, 59, 3),
(1, 59, 4),
(1, 60, 1),
(1, 60, 2),
(1, 60, 3),
(1, 60, 4),
(1, 61, 1),
(1, 61, 2),
(1, 61, 3),
(1, 61, 4),
(1, 62, 1),
(1, 62, 2),
(1, 62, 3),
(1, 62, 4),
(1, 63, 0),
(1, 64, 1),
(1, 64, 2),
(1, 64, 3),
(1, 64, 4),
(1, 58, 0),
(1, 65, 0),
(1, 49, 0),
(1, 51, 1),
(1, 51, 2),
(1, 51, 3),
(1, 51, 4),
(1, 50, 1),
(1, 50, 2),
(1, 50, 3),
(1, 50, 4),
(1, 66, 1),
(1, 66, 2),
(1, 66, 3),
(1, 66, 4),
(1, 67, 1),
(1, 67, 2),
(1, 67, 3),
(1, 67, 4),
(1, 68, 1),
(1, 68, 2),
(1, 68, 3),
(1, 68, 4),
(1, 69, 0),
(1, 37, 1),
(1, 37, 2),
(1, 37, 3),
(1, 37, 4),
(1, 70, 1),
(1, 70, 2),
(1, 70, 3),
(1, 70, 4),
(1, 71, 1),
(1, 71, 2),
(1, 71, 3),
(1, 71, 4),
(1, 72, 1),
(1, 72, 2),
(1, 72, 3),
(1, 72, 4);

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
(1, 1, 1, 19090001, 1, 0, 0, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(2, 1, 1, 19090002, 2, 0, 0, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(3, 1, 1, 19090003, 3, 0, 0, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(4, 1, 1, 19090004, 4, 0, 0, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(5, 1, 1, 19090005, 5, 0, 0, 1, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(6, 2, 1, 19100001, 1, 0, 0, 1, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(7, 2, 1, 19100002, 2, 0, 0, 1, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(8, 2, 1, 19100003, 3, 0, 0, 1, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(9, 2, 1, 19100004, 4, 0, 0, 1, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(10, 2, 1, 19100005, 5, 0, 0, 1, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(11, 2, 1, 19100006, 6, 0, 0, 1, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(12, 2, 1, 19100007, 7, 0, 0, 1, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(13, 2, 1, 19100008, 8, 0, 0, 1, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(14, 2, 1, 19100009, 9, 0, 0, 1, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(15, 2, 1, 19100010, 10, 0, 0, 1, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56');

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
(1, 1, 19090001, NULL, 2, 0, '2019-06-29 03:18:38', '2019-06-29 03:18:38'),
(2, 1, 19090002, NULL, 2, 0, '2019-06-29 03:20:41', '2019-06-29 03:20:41'),
(3, 1, 19090003, NULL, 2, 0, '2019-06-29 03:20:59', '2019-06-29 03:20:59'),
(4, 1, 19090004, NULL, 2, 0, '2019-06-29 03:25:55', '2019-06-29 03:25:55'),
(5, 1, 19090005, NULL, 2, 0, '2019-06-29 03:31:52', '2019-06-29 03:31:52'),
(6, 2, 19100001, NULL, 2, 0, '2019-06-30 23:12:06', '2019-06-30 23:12:06'),
(7, 2, 19100002, NULL, 2, 0, '2019-06-30 23:12:21', '2019-06-30 23:12:21'),
(8, 2, 19100003, NULL, 2, 0, '2019-06-30 23:12:25', '2019-06-30 23:12:25'),
(9, 2, 19100004, NULL, 2, 0, '2019-06-30 23:12:28', '2019-06-30 23:12:28'),
(10, 2, 19100005, NULL, 2, 0, '2019-06-30 23:12:29', '2019-06-30 23:12:29'),
(11, 2, 19100006, NULL, 2, 0, '2019-06-30 23:12:32', '2019-06-30 23:12:32'),
(12, 2, 19100007, NULL, 2, 0, '2019-06-30 23:12:35', '2019-06-30 23:12:35'),
(13, 2, 19100008, NULL, 2, 0, '2019-06-30 23:12:37', '2019-06-30 23:12:37'),
(14, 2, 19100009, NULL, 2, 0, '2019-06-30 23:12:39', '2019-06-30 23:12:39'),
(15, 2, 19100010, NULL, 2, 0, '2019-06-30 23:12:41', '2019-06-30 23:12:41');

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
(1, 1, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(2, 1, 2, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(3, 1, 3, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(4, 1, 4, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(5, 1, 5, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(6, 1, 6, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(7, 1, 7, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(8, 1, 8, 2, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(9, 1, 10, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(10, 1, 11, 3, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(11, 1, 12, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(12, 1, 13, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(13, 1, 9, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(14, 2, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(15, 2, 2, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(16, 2, 3, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(17, 2, 4, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(18, 2, 5, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(19, 2, 6, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(20, 2, 7, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(21, 2, 8, 2, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(22, 2, 10, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(23, 2, 11, 3, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(24, 2, 12, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(25, 2, 13, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(26, 2, 9, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(27, 3, 1, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(28, 3, 2, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(29, 3, 3, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(30, 3, 4, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(31, 3, 5, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(32, 3, 6, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(33, 3, 7, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(34, 3, 8, 2, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(35, 3, 10, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(36, 3, 11, 3, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(37, 3, 12, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(38, 3, 13, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(39, 3, 9, 1, 0, '2019-07-01 00:35:36', '2019-07-01 00:35:36'),
(40, 4, 1, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(41, 4, 2, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(42, 4, 3, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(43, 4, 4, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(44, 4, 5, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(45, 4, 6, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(46, 4, 7, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(47, 4, 8, 2, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(48, 4, 10, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(49, 4, 11, 3, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(50, 4, 12, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(51, 4, 13, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(52, 4, 9, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(53, 5, 1, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(54, 5, 2, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(55, 5, 3, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(56, 5, 4, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(57, 5, 5, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(58, 5, 6, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(59, 5, 7, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(60, 5, 8, 2, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(61, 5, 10, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(62, 5, 11, 3, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(63, 5, 12, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(64, 5, 13, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(65, 5, 9, 1, 0, '2019-07-01 00:35:37', '2019-07-01 00:35:37'),
(66, 6, 1, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(67, 6, 2, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(68, 6, 3, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(69, 6, 4, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(70, 6, 5, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(71, 6, 6, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(72, 6, 7, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(73, 6, 8, 2, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(74, 6, 9, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(75, 6, 10, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(76, 6, 11, 3, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(77, 6, 12, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(78, 6, 13, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(79, 7, 1, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(80, 7, 2, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(81, 7, 3, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(82, 7, 4, 1, 0, '2019-07-01 00:36:53', '2019-07-01 00:36:53'),
(83, 7, 5, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(84, 7, 6, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(85, 7, 7, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(86, 7, 8, 2, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(87, 7, 9, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(88, 7, 10, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(89, 7, 11, 3, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(90, 7, 12, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(91, 7, 13, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(92, 8, 1, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(93, 8, 2, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(94, 8, 3, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(95, 8, 4, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(96, 8, 5, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(97, 8, 6, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(98, 8, 7, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(99, 8, 8, 2, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(100, 8, 9, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(101, 8, 10, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(102, 8, 11, 3, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(103, 8, 12, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(104, 8, 13, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(105, 9, 1, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(106, 9, 2, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(107, 9, 3, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(108, 9, 4, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(109, 9, 5, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(110, 9, 6, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(111, 9, 7, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(112, 9, 8, 2, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(113, 9, 9, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(114, 9, 10, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(115, 9, 11, 3, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(116, 9, 12, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(117, 9, 13, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(118, 10, 1, 1, 0, '2019-07-01 00:36:54', '2019-07-01 00:36:54'),
(119, 10, 2, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(120, 10, 3, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(121, 10, 4, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(122, 10, 5, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(123, 10, 6, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(124, 10, 7, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(125, 10, 8, 2, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(126, 10, 9, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(127, 10, 10, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(128, 10, 11, 3, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(129, 10, 12, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(130, 10, 13, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(131, 11, 1, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(132, 11, 2, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(133, 11, 3, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(134, 11, 4, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(135, 11, 5, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(136, 11, 6, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(137, 11, 7, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(138, 11, 8, 2, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(139, 11, 9, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(140, 11, 10, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(141, 11, 11, 3, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(142, 11, 12, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(143, 11, 13, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(144, 12, 1, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(145, 12, 2, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(146, 12, 3, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(147, 12, 4, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(148, 12, 5, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(149, 12, 6, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(150, 12, 7, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(151, 12, 8, 2, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(152, 12, 9, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(153, 12, 10, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(154, 12, 11, 3, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(155, 12, 12, 1, 0, '2019-07-01 00:36:55', '2019-07-01 00:36:55'),
(156, 12, 13, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(157, 13, 1, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(158, 13, 2, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(159, 13, 3, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(160, 13, 4, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(161, 13, 5, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(162, 13, 6, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(163, 13, 7, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(164, 13, 8, 2, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(165, 13, 9, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(166, 13, 10, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(167, 13, 11, 3, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(168, 13, 12, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(169, 13, 13, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(170, 14, 1, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(171, 14, 2, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(172, 14, 3, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(173, 14, 4, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(174, 14, 5, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(175, 14, 6, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(176, 14, 7, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(177, 14, 8, 2, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(178, 14, 9, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(179, 14, 10, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(180, 14, 11, 3, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(181, 14, 12, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(182, 14, 13, 1, 0, '2019-07-01 00:36:56', '2019-07-01 00:36:56'),
(183, 15, 1, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(184, 15, 2, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(185, 15, 3, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(186, 15, 4, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(187, 15, 5, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(188, 15, 6, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(189, 15, 7, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(190, 15, 8, 2, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(191, 15, 9, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(192, 15, 10, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(193, 15, 11, 3, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(194, 15, 12, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57'),
(195, 15, 13, 1, 0, '2019-07-01 00:36:57', '2019-07-01 00:36:57');

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

--
-- Dumping data for table `tbl_child_exam`
--

INSERT INTO `tbl_child_exam` (`id`, `programofferid`, `mst_examnameid`, `child_examnameid`, `hld_marks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, 11.00, 0, '2019-07-13 00:28:31', '2019-07-13 04:19:45'),
(2, 2, 1, 3, 10.00, 0, '2019-07-13 00:39:40', '2019-07-13 00:39:40');

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
  ADD UNIQUE KEY `applicants_applicantid_unique` (`applicantid`);

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
-- Indexes for table `students_house`
--
ALTER TABLE `students_house`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `admissionresult`
--
ALTER TABLE `admissionresult`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `child_exam_course`
--
ALTER TABLE `child_exam_course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `child_exam_marks`
--
ALTER TABLE `child_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courseoffer`
--
ALTER TABLE `courseoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_codes`
--
ALTER TABLE `course_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `master_exam`
--
ALTER TABLE `master_exam`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `mst_exam_marks`
--
ALTER TABLE `mst_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students_house`
--
ALTER TABLE `students_house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `tbl_child_exam`
--
ALTER TABLE `tbl_child_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
