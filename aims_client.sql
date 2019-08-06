-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 02:35 PM
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
  `teacherid` int(11) DEFAULT NULL,
  `coursemark` double(8,2) DEFAULT NULL,
  `meargeid` int(11) DEFAULT NULL,
  `mearge_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(13, 'Chemistry 2nd Part', '508', 4, 0, '2019-08-06 05:58:02', '2019-08-06 05:58:02');

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
(1, 1, 1, 0, '2019-08-06 04:36:53', '2019-08-06 04:36:53'),
(2, 1, 2, 0, '2019-08-06 04:36:53', '2019-08-06 04:36:53'),
(3, 1, 3, 0, '2019-08-06 04:36:53', '2019-08-06 04:36:53'),
(4, 1, 4, 0, '2019-08-06 04:36:53', '2019-08-06 04:36:53'),
(5, 1, 5, 0, '2019-08-06 04:36:53', '2019-08-06 04:36:53');

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
(25, 'Edit Course Offer', 'editcourseoffer', 18, 100, 0, '2019-08-06 05:09:53', '2019-08-06 05:09:53');

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
(46, '2019_03_25_091043_create_mark_distribution_table', 1),
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
(65, '2019_08_06_092647_create_section_course_teachers_table', 1);

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
(2, 1, 4, 1, 1, 1, 1, NULL, 210, 12, 0, '2019-08-06 05:14:14', '2019-08-06 05:45:22');

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
(2, 24, 3);

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
(6, 2, 3, 60, NULL, 0, '2019-08-06 05:45:22', '2019-08-06 05:45:22');

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
  `teacherid` int(11) NOT NULL,
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
(1, 'Supper Admin', 'developer@gmail.com', NULL, '$2y$10$ND.vdRSrW30S3J6LEtAyb./PHHC8Z.6lDbZ9vZYqeVD3wTj/TkkJK', NULL, '2019-08-06 03:58:21', '2019-08-06 03:58:21'),
(2, 'School(Admin)', 'school@gmail.com', NULL, '$2y$10$N8OvxtpiQ0BObJSa03.jEe4BV8qoO9QqUsW4yvumodeqa.Dno6682', NULL, '2019-08-06 04:54:52', '2019-08-06 04:54:52');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_type`
--
ALTER TABLE `course_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `employmentstatus`
--
ALTER TABLE `employmentstatus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_name`
--
ALTER TABLE `exam_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mark_distribution`
--
ALTER TABLE `mark_distribution`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_exam`
--
ALTER TABLE `master_exam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `mst_exam_marks`
--
ALTER TABLE `mst_exam_marks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sectionoffer`
--
ALTER TABLE `sectionoffer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section_course_teachers`
--
ALTER TABLE `section_course_teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students_house`
--
ALTER TABLE `students_house`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
