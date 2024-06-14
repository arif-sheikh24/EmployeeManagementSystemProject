-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2024 at 06:53 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `leavedate` date NOT NULL,
  `leaveedate` date NOT NULL,
  `totalday` int(11) NOT NULL,
  `leavereason` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `username`, `name`, `email`, `department`, `leavedate`, `leaveedate`, `totalday`, `leavereason`, `status`) VALUES
(29, 'test0001', 'Arif Sheikh', 'arif@teamexus.com', 'Casual', '2024-04-18', '2024-04-19', 0, '<p>I will go home.</p>\r\n', 0),
(30, 'test0001', 'Arif Sheikh', 'arif@teamexus.com', 'Sick', '0000-00-00', '0000-00-00', 0, '', 2),
(31, 'test0001', 'Arif Sheikh', 'arif@teamexus.com', 'Casual', '2024-04-19', '2024-04-21', 0, '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</p>\r\n', 1),
(32, 'test0001', 'Arif Sheikh', 'arif@teamexus.com', 'Vacation', '2024-04-19', '2024-04-21', 0, '<p>test</p>\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `manager_id` int(30) NOT NULL,
  `user_ids` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `Edate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `user_ids`, `date_created`, `Edate`) VALUES
(3, 'Employee Mangement System', '																																				&lt;span id=&quot;docs-internal-guid-2d8b3f99-7fff-dadb-46ed-2a84fd981b42&quot;&gt;&lt;p dir=&quot;ltr&quot; style=&quot;line-height:1.38;text-align: justify;margin-top:0pt;margin-bottom:0pt;&quot;&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;&quot;&gt;In the contemporary work environment, managing employees efficiently is crucial for organizational success. An Employee Management System (EMS) helps streamline various HR processes, including project management, leave management, attendance tracking, and calendar maintenance. This PHP-based EMS project aims to provide a comprehensive solution for businesses to manage their human resources effectively.&lt;/span&gt;&lt;/p&gt;&lt;div&gt;&lt;span style=&quot;font-size: 11pt; font-family: Arial, sans-serif; color: rgb(0, 0, 0); background-color: transparent; font-variant-numeric: normal; font-variant-east-asian: normal; font-variant-alternates: normal; font-variant-position: normal; vertical-align: baseline; white-space-collapse: preserve;&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;/div&gt;&lt;/span&gt;																																									', 2, '2024-03-01', '2024-04-04', 1, '6', '2024-03-21 11:29:03', '2024-04-04'),
(5, 'TTT', '																																																						test &lt;br&gt;																																													', 0, '2024-02-21', '2024-04-01', 1, '6,7', '2024-03-21 13:53:01', '2024-04-01'),
(6, 'DCM', '																																																																														&lt;span style=&quot;color: rgb(31, 31, 31); font-family: &amp;quot;Google Sans&amp;quot;, arial, sans-serif; font-size: 20px;&quot;&gt;Diagnostic Management System (DMS) is&lt;/span&gt;&lt;span style=&quot;color: rgb(31, 31, 31); font-family: &amp;quot;Google Sans&amp;quot;, arial, sans-serif; font-size: 20px;&quot;&gt;&amp;nbsp; a fully integrated Diagnostic Management System specially designed for diagnostic centers. It consists of several modules that cover all activities of diagnostic center, which includes , Patient Information, Daily MIS, Administration, Reporting, Accounts etc.&lt;/span&gt;																																																																												', 2, '2024-03-01', '2024-04-30', 1, '7', '2024-03-25 10:32:43', '2024-04-30'),
(7, 'test', '												Bangladesh is beautiful.&lt;br&gt;										', 0, '2024-04-17', '2024-04-30', 1, '6,7,8', '2024-04-16 12:30:58', '2024-04-30'),
(8, 'TTS', '						test					', 1, '2024-04-19', '2024-04-30', 1, '10,11', '2024-04-18 08:40:36', '2024-04-30');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(1, 'Sample 101', 'This is a sample schedule only.', '2022-01-10 10:30:00', '2022-01-11 18:00:00'),
(2, 'Sample 102', 'Sample Description 102', '2022-01-08 09:30:00', '2022-01-08 11:30:00'),
(4, 'Sample 102', 'Sample Description', '2022-01-12 14:00:00', '2022-01-12 17:00:00'),
(6, 'holiday', 'test', '2024-03-29 12:00:00', '2024-03-30 12:00:00'),
(20, 'Buddha’s Birthday', 'Buddha’s Birthday', '2024-05-22 00:00:00', '2024-05-22 11:20:00'),
(22, 'Independence Day', 'test', '2024-03-26 12:00:00', '2024-03-26 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `cover_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `address`, `cover_img`) VALUES
(1, 'Task Management System', 'info@sample.comm', '+6948 8542 623', '2102  Caldwell Road, Rochester, New York, 14608', '');

-- --------------------------------------------------------

--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task` varchar(200) NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `task`, `username`, `description`, `status`, `date_created`) VALUES
(5, 3, 'Updated the header', 'test0001', '																&amp;nbsp;Updated the header part, changed the project text and added the data for the user on the Employee Management System PHP project &lt;br&gt;Updated the task option and project progress on the Employee Management System PHP project&amp;nbsp; &lt;br&gt;												', 3, '2024-03-22 15:46:12'),
(6, 6, 'Create a environment for the project', 'test0002', '												Create a dashboard and users authentication.&lt;br&gt;									', 3, '2024-03-28 13:41:47'),
(7, 3, 'Create levae managemant ', 'test0001', '																				Added the employee leave request option and admin accept option.&lt;br&gt;															', 2, '2024-03-28 13:54:01'),
(8, 5, 'User Authentication', 'test0001', '																Created user and admin login from&amp;nbsp;												', 3, '2024-03-28 14:11:22'),
(9, 6, 'HTML Template Setup ', 'test0002', '				test			', 3, '2024-04-01 12:02:57'),
(12, 6, 'test', 'test0002', '								test						', 3, '2024-04-04 09:23:23'),
(13, 5, 'test321', 'test0002', '								test321						', 3, '2024-04-15 12:26:27'),
(14, 7, 'test task', 'test0001', '																				test description&lt;br&gt;															', 3, '2024-04-16 13:01:15'),
(15, 7, 'test', 'test0005', '																								test																		', 3, '2024-04-17 11:25:13'),
(16, 7, 'test ', 'test0002', '												test									', 3, '2024-04-18 16:08:19'),
(17, 8, 'test', 'test0004', '								test						', 2, '2024-04-25 09:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` date NOT NULL,
  `check_in` time NOT NULL,
  `in_status` varchar(255) NOT NULL,
  `check_out` time NOT NULL,
  `out_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`id`, `employee_id`, `shift`, `location`, `message`, `date`, `check_in`, `in_status`, `check_out`, `out_status`, `created_at`) VALUES
(10, 'test0001', '', 'Office', 'test!', '2024-03-28', '12:53:56', 'Late', '12:54:05', 'Over Time', '2024-03-28 06:54:05'),
(12, 'test0001', '', 'Office', 'hello!', '2024-04-01', '10:13:09', 'Late', '10:13:14', 'Early', '2024-04-01 04:13:14'),
(13, 'test0005', '', 'Office', 'hi', '2024-04-01', '15:45:51', 'Late', '15:46:02', 'Early', '2024-04-01 09:46:02'),
(14, 'test0002', '', 'Office', 'hi!', '2024-04-03', '09:47:09', 'Late', '16:35:11', 'Early', '2024-04-15 10:35:11'),
(15, 'test0002', '', 'Office', 'hi', '2024-04-15', '16:35:08', 'Late', '16:35:15', 'Early', '2024-04-15 10:35:15'),
(16, 'test0002', '', 'Home', '', '2024-04-16', '09:35:11', 'Late', '09:41:17', 'Early', '2024-04-16 03:41:17'),
(17, 'test0001', '', 'Office', 'hi!', '2024-04-16', '10:44:03', 'Late', '00:00:00', '', '2024-04-16 04:44:03'),
(18, 'test0005', '', 'Office', 'hi!', '2024-04-16', '14:45:49', 'Late', '14:46:28', 'Early', '2024-04-16 08:46:28'),
(19, 'test0001', '', 'Office', 'hi!', '2024-04-23', '09:32:01', 'Late', '00:00:00', '', '2024-04-23 03:32:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `department_id`, `department_name`, `status`, `created_at`) VALUES
(1, 'SE', 'Software Engineer', 1, '2024-04-02 04:16:45'),
(2, 'JSE', 'Junior Software Engineer', 1, '2024-04-02 04:18:08'),
(3, 'SSE', 'Senior Software Engineer', 1, '2024-04-02 04:19:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `id` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `location`, `created_at`) VALUES
(1, 'Office', '2023-09-29 05:52:28'),
(2, 'Field', '2023-09-29 05:52:40'),
(3, 'Home', '2023-09-29 05:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `id` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active,0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`id`, `start_time`, `end_time`, `status`, `created_at`) VALUES
(3, '08:00:00', '17:00:00', 1, '2024-03-28 03:34:52'),
(5, '09:00:00', '18:00:00', 0, '2024-04-19 08:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1 = admin, 2 = staff',
  `blood` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` int(15) NOT NULL,
  `nid` int(20) NOT NULL,
  `presentaddress` varchar(100) NOT NULL,
  `parmanentaddress` varchar(100) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `Subject` varchar(20) NOT NULL,
  `degree` varchar(20) NOT NULL,
  `emergencycontact` int(15) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `avatar` text NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `type`, `blood`, `gender`, `contact`, `nid`, `presentaddress`, `parmanentaddress`, `designation`, `Subject`, `degree`, `emergencycontact`, `shift`, `department`, `avatar`, `date_created`) VALUES
(1, 'test0000', 'Administrator', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '', '', 0, 0, '', '', '', '', '', 0, '', '', '1711615440_Screenshot_2024-03-28_132945-removebg-preview.png', '2020-11-26 10:57:04'),
(2, 'test0003', 'Tariqul', 'Islam', 'tariqul@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'O+', 'Male', 1576235582, 2147483647, 'Dhaka', 'Dohar, Dhaka', 'Project Manager', 'BBA', 'MBA', 156734834, '08:00:00-17:00:00', '', '1711344240_Screenshot_20221115_103726-removebg-preview - Copy - Copy - Copy.png', '2020-12-03 09:26:03'),
(6, 'test0001', 'Arif', 'Sheikh', 'arif@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'B+', 'Male', 2147483647, 2147483647, 'Dhaka', 'Gaibandha', 'Software Engineer', '', 'BSc', 2147483647, '08:00:00-17:00:00', 'Daffodil International University', '1710996900_1682967707283-removebg-preview-removebg-preview - Copy - Copy - Copy - Copy - Copy.jpg', '2024-03-21 10:55:43'),
(7, 'test0002', 'Rakib', 'Enam', 'rakib@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'B+', 'Male', 1634537979, 2147483647, 'Mirpur, Dhaka', 'Rongpur', 'Software Engineer', 'CSE', 'BSc', 2147483647, '08:00:00-17:00:00', 'Software Engineer', '1711344360_RakibEnamAnik-removebg-preview.png', '2024-03-21 14:05:01'),
(8, 'test0005', 'Tasib', 'Haydar', 'tasib@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'O+', 'Male', 1563545683, 534488273, 'Dhaka', 'Barishal', 'Software Engineer', 'CSE', 'BSc', 1679453479, '08:00:00-17:00:00', 'Senior Software Engineer', '1711341540_tasib-photo-md.-tasib-haider-596x795 - Copy - Copy - Copy - Copy.jpeg', '2024-03-25 10:39:51'),
(10, 'test0004', 'Riadul', 'Islam', 'riadul@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'A+', 'Male', 2147483647, 56582532, 'Mirpur', 'jinaidha', 'software Engineer', 'CSE', 'MSC', 163844334, '08:00:00-17:00:00', 'Senior Software Engineer', '1712034660_TXS_Redwanul-removebg-preview (1) - Copy.png', '2024-04-02 11:11:42'),
(11, 'test0007', 'Noor', 'Islam', 'noor@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'B+', 'Male', 2147483647, 2147483647, 'aa', 'aa', 'aa', 'CSE', 'aa', 0, '08:00:00-17:00:00', 'Software Engineer', '1713256620_Screenshot_2024-03-28_132945-removebg-preview.png', '2024-04-16 14:37:25'),
(12, 'test0006', 'Arif1', 'Sheikh', 'arif1@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'B+', 'Male', 6473537, 2147483647, 'Mirpur', 'Gaibandha', 'Daffodil', 'CSE', 'BSc', 2147483647, '08:00:00-17:00:00', 'Senior Software Engineer', '1713422580_Screenshot_2024-03-28_132945-removebg-preview.png', '2024-04-18 12:43:58'),
(13, 'test0008', 'Limon', 'Ahmed', 'limon@teamexus.com', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'A-', 'Male', 2147483647, 2147483647, 'Mirpur', 'Barishal', 'State University', 'Architect', 'BSc', 2147483647, '08:00:00-17:00:00', 'Senior Software Engineer', '1713953520_lemon.png', '2024-04-24 16:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

CREATE TABLE `user_productivity` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL,
  `task_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_id` int(30) NOT NULL,
  `time_rendered` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_productivity`
--

INSERT INTO `user_productivity` (`id`, `project_id`, `task_id`, `comment`, `subject`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`) VALUES
(1, 1, 1, '							&lt;p&gt;Sample Progress&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Test 1&lt;/li&gt;&lt;li&gt;Test 2&lt;/li&gt;&lt;li&gt;Test 3&lt;/li&gt;&lt;/ul&gt;																			', 'Sample Progress', '2020-12-03', '08:00:00', '10:00:00', 1, 2, '2020-12-03 12:13:28'),
(2, 1, 1, '							Sample Progress						', 'Sample Progress 2', '2020-12-03', '13:00:00', '14:00:00', 1, 1, '2020-12-03 13:48:28'),
(3, 1, 2, '							Sample						', 'Test', '2020-12-03', '08:00:00', '09:00:00', 5, 1, '2020-12-03 13:57:22'),
(4, 1, 2, 'asdasdasd', 'Sample Progress', '2020-12-02', '08:00:00', '10:00:00', 2, 2, '2020-12-03 14:36:30'),
(5, 3, 7, '													', 'Completed the leave management system', '2024-03-28', '08:50:00', '12:50:00', 6, 4, '2024-03-28 13:55:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_list`
--
ALTER TABLE `project_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_list`
--
ALTER TABLE `task_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_productivity`
--
ALTER TABLE `user_productivity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_productivity`
--
ALTER TABLE `user_productivity`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
