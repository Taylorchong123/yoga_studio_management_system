-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 11:05 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yogastudiomanagementsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `position`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'staff', '2020-08-20 06:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `stime` datetime NOT NULL,
  `etime` datetime NOT NULL,
  `participant` int(11) NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `classroom` varchar(255) NOT NULL,
  `student` int(11) NOT NULL,
  `dom` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `classname`, `stime`, `etime`, `participant`, `instructor`, `classroom`, `student`, `dom`, `status`) VALUES
(25, 'Aerial Yoga Class (basic movement)', '2020-12-20 06:00:00', '2020-12-20 07:30:00', 10, 'Taylor Chong', '2B', 1, 0, 'active'),
(36, 'Rope Yoga Class(Basic Movement)', '2020-12-21 08:30:00', '2020-12-21 10:30:00', 10, 'shixian', '1A', 1, 0, 'active'),
(38, 'Aerial Yoga Class ( posture teaching)', '2020-12-20 11:00:00', '2020-12-20 13:30:00', 10, 'shixian', '2A', 1, 0, 'active'),
(40, 'Rope Yoga Class (Posture Correction)', '2021-01-10 19:10:00', '2021-01-10 21:10:00', 10, 'Rugan', '2B', 1, 0, 'active'),
(47, 'Aerial yoga class(hand-stretching)', '2021-01-11 14:50:00', '2021-01-11 16:50:00', 10, 'instructor4', '2B', 0, 0, 'active'),
(50, 'Aerial yoga class (super man)', '2021-01-11 17:42:00', '2021-01-25 19:42:00', 10, 'instructor2', '1A', 0, 4, 'active'),
(51, 'Rope Yoga Class (hand-stretching)', '2021-01-12 21:02:00', '2021-01-12 23:02:00', 10, 'instructor5', '2A', 0, 0, 'active'),
(52, 'Aerial yoga class (Pranayama)', '2021-01-13 21:04:00', '2021-01-13 23:04:00', 10, 'instructor4', '1B', 0, 0, 'active'),
(53, 'Rope yoga class(Pranayama)', '2021-01-15 21:05:00', '2021-01-15 23:05:00', 10, 'instructor5', '2A', 0, 0, 'active'),
(54, 'Rope yoga class(Meditation)', '2021-01-23 21:06:00', '2021-01-23 23:06:00', 10, 'Rugan', '1A', 0, 0, 'active'),
(55, 'Aerial yoga class (Asana)', '2021-01-18 21:08:00', '2021-01-18 23:08:00', 10, 'Taylor Chong', '1B', 0, 0, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `roomname`, `status`) VALUES
(1, '1A', 'active'),
(2, '2A', 'active'),
(3, '1B', 'active'),
(4, '2B', 'active'),
(5, '2C', 'not active'),
(6, '1C', 'not active'),
(7, '1D', 'not active'),
(8, '2D', 'not active'),
(9, '1E', 'not active'),
(10, '2E', 'not active'),
(11, '1F', 'not active'),
(12, '2F', 'not active');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `handphone` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Education_Level` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `name`, `email`, `handphone`, `age`, `gender`, `username`, `Education_Level`, `password`, `status`, `updationDate`) VALUES
(6, 'shixian', 'yongwei0512@gmail.com', '0167148105', 23, 'Male', 'rugan33', 'Diploma in yoga therapy', '0fa298ef94c9dc917c3553912b0a01df', 'active', '2021-01-10 14:24:34'),
(8, 'Taylor Chong', 'yongwei123@gmail.com', '0167148105', 45, 'Male', 'chong', 'Diploma in yoga therapy', 'cad8e42985cc5d8ab5f75b67edfdf420', 'active', '2021-01-10 14:27:02'),
(9, 'Rugan', 'yongwei0512@gmail.com', '0167148105', 42, 'Male', 'rugan', 'Master in yoga', '0fa298ef94c9dc917c3553912b0a01df', 'active', '2021-01-11 20:43:37'),
(13, 'instructor4', 'yongwei0512@hotmail.com', '0143545341', 32, 'Male', 'UF3tM1mN', 'Bachelor degree in yoga', '4a4375544a997db0de2dd791618c6226', 'active', '2021-01-11 12:46:18'),
(14, 'instructor5', 'yongwei000@hotmail.com', '0123234345', 0, 'Male', 'instructor5', 'Master in yoga', 'a014bae5cc89cce09a0c8db717dbb84f', 'active', '2021-01-11 20:37:57'),
(16, 'instructor6', 'yongwei111@hotmail.com', '0123346563', 30, 'Female', 'instructor6', 'Bachelor degree in yoga', 'ec6530eb05fbeb34f9aa81851a7f7382', 'not active', '2021-01-11 12:58:35'),
(17, 'instructor7', 'yong222@hotmail.com', '0123453235', 54, 'Male', 'instructor7', 'Bachelor degree in yoga', '9915dcd2981350e566d6256c64ffa7a4', 'not active', '2021-01-11 12:58:32'),
(18, 'instructor8', 'yongwei333@hotmail.com', '0167842392', 32, 'Male', 'instructor8', 'Diploma in yoga therapy', '0b6f24c1f743fa45c2db9f570188003f', 'not active', '2021-01-11 12:58:29'),
(19, 'instructor9', 'yongwei444@hotmail.com', '0157384294', 25, 'Female', 'instructor9', 'Bachelor degree in yoga', 'a07b96228016da3bb7678583d6fbeb0d', 'not active', '2021-01-11 12:58:26'),
(20, 'instructor10', 'yongwei666@hotmail.com', '0137832548', 28, 'Male', 'instructor10', 'Master in yoga', '2e8d9b388ca1f3e64de1f03b72098e4e', 'not active', '2021-01-11 12:58:23'),
(21, 'instructor11', 'yongwei888@hotmail.com', '0168123542', 29, 'Female', 'instructor11', 'Master in yoga', '790b09b8c740d03307adabd055c850ad', 'not active', '2021-01-11 12:58:19'),
(22, '', 'yongwei0512@homtail.com', '', 0, '', 'ri0CH3', '', '4f3c82229245292458b7000311ea7f47', 'not active', '2021-01-11 20:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `poscode` int(11) NOT NULL,
  `handphone` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `profile` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `fullname`, `email`, `gender`, `address`, `city`, `state`, `poscode`, `handphone`, `age`, `profile`, `password`, `status`, `create_time`) VALUES
(1, 'chong yong wei', 'yongwei0512@gmail.com', 'Female', 'No 33, Jalan Indah 4/3 Taman Bukit Indah', 'Johor Bahru', 'Johor', 81200, 167148105, 26, 'cyberagent .png', 'cad8e42985cc5d8ab5f75b67edfdf420', 'verify', '2021-01-11 20:00:51'),
(3, 'Goh Hui Ting', 'yongwei123@gmail.com', 'Female', '33, jalan bestrari 4/12', 'Johor Bahru', 'Johor', 81212, 167148105, 31, 'member.png', '00387d4b7868273410777702380b1c4e', 'verify', '2020-12-15 08:18:55'),
(4, 'member3', 'yongwei333@gmail.com', 'Male', 'no21, jalan merah 3/2 Taman Bukit Merah ', 'Johor Bahru', 'Johor', 81200, 162343455, 33, 'member.png', 'ce22c117a3b927dd73da515e909711cd', 'verify', '2021-01-11 13:14:33'),
(5, 'member4', 'yongwei4321@gmail.com', 'Female', 'no 32, Jalan Nusa Jaya 2/3 Taman Anggerik jaya', 'Johor Bahru', 'Johor', 81200, 123434323, 23, 'member.png', '8d503e4638b19f3915f58074a1252965', 'verify', '2021-01-11 13:16:58'),
(6, 'member5', 'yongwei5432@gmail.com', 'Male', 'no22, Jalan Biru 1/2 Taman Anggosa', 'Johor Bahru', 'Johor', 81200, 123434432, 29, 'member.png', '7cc62fc3d14a1355ee0838f76f9bd0b8', 'verify', '2021-01-11 13:19:10'),
(7, 'member6', 'yongwei6532@gmail.com', 'Male', 'no 11, Jalan Agung 1/12 Taman Temenggung', 'Johor Bahru', 'Johor', 81200, 167443311, 26, 'member.png', '811a4f059847649d0ae9cf5d8e13526a', 'verify', '2021-01-11 13:21:15'),
(8, 'member7', 'yongwei7654@gmail.com', 'Male', 'no 29, Jalan Besar 3/1, Taman Fraser ', 'Johor Bahru', 'Johor', 81200, 123343443, 31, 'member.png', '96231009a9ef7f16866558888f0eed07', 'verify', '2021-01-11 13:22:42'),
(9, 'member8', 'yongwei8765@gmail.com', 'Female', 'no 14, Jalan Mago 1/2, Taman Unggu', 'Johor Bahru', 'Johor', 81199, 123233434, 34, 'member.png', 'fb99b3f21081e336d2e4708e3be507b5', 'verify', '2021-01-11 13:24:15'),
(10, 'member10', 'yongwei1010@gmail.com', 'Male', 'no 12, Jalan Tahun 2/1, Taman Bukit Biru', 'Johor Bahru', 'Johor', 81200, 123243443, 29, 'member.png', 'd48df6f48e0f0e52f1a70b904e5cfd37', 'verify', '2021-01-11 13:27:23'),
(11, 'Member11', 'yongwei1111@gmail.com', 'Male', 'no44, Jalan Sati 4/11, Taman Bukit Besar', 'Johor Bahru', 'Johor', 81200, 123214341, 34, 'member.png', '64d4a8ccf672999e2cfbca380b5504db', 'verify', '2021-01-11 13:28:46'),
(12, 'member9', 'yongwei9999@gmail.com', 'Male', 'no 33, jalan mahkota 4/12, Taman Ali', 'Johor Bahru', 'Johor', 81200, 123434553, 42, 'member.png', '0f4e0f8d9422f3820ae372ee0284ffdf', 'verify', '2021-01-11 13:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `cardnumber` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `current_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `cardname`, `cardnumber`, `amount`, `current_time`) VALUES
(39, 'chong yong wei', '1111-2222-1212-1232', 110, '2021-01-11 20:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `student_enroll`
--

CREATE TABLE `student_enroll` (
  `id` int(11) NOT NULL,
  `classname` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end_class` datetime NOT NULL,
  `teacher` varchar(255) NOT NULL,
  `student` varchar(255) NOT NULL,
  `subscription_ID` int(11) NOT NULL,
  `class_ID` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `enroll_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_enroll`
--

INSERT INTO `student_enroll` (`id`, `classname`, `start`, `end_class`, `teacher`, `student`, `subscription_ID`, `class_ID`, `status`, `enroll_time`) VALUES
(64, 'Aerial Yoga Class (basic movement)', '2020-12-20 06:00:00', '2020-12-20 07:30:00', 'Taylor Chong', 'chong yong wei', 56, 25, 'active', '2021-01-09 14:07:57'),
(66, 'Aerial Yoga Class ( posture teaching)', '2020-12-20 11:00:00', '2020-12-20 13:30:00', 'shixian', 'chong yong wei', 50, 38, 'active', '2021-01-09 14:44:16'),
(67, 'Rope Yoga Class(Basic Movement)', '2020-12-21 08:30:00', '2020-12-21 10:30:00', 'shixian', 'chong yong wei', 51, 36, 'active', '2021-01-10 11:15:45'),
(68, 'Rope Yoga Class (Posture Correction)', '2021-01-10 19:10:00', '2021-01-10 21:10:00', 'Rugan', 'chong yong wei', 51, 40, 'active', '2021-01-10 13:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(11) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `mfullname` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `class_times` int(11) NOT NULL,
  `current_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `sname`, `mfullname`, `price`, `status`, `class_times`, `current_time`) VALUES
(50, 'Aerial Yoga Class 10 Class Section', 'chong yong wei', 110, 'paid', 9, '2021-01-09 14:44:16'),
(51, 'Rope Yoga Class 10 Class Section', 'chong yong wei', 110, 'paid', 8, '2021-01-11 20:16:59'),
(55, 'Aerial Yoga Class 1 Class Section', 'Goh Hui Ting', 15, 'not paid', 1, '2020-12-30 14:44:05'),
(56, 'Aerial Yoga Class 1 Class Section', 'chong yong wei', 15, 'paid', 0, '2021-01-09 14:07:57'),
(70, 'Aerial Yoga Class 10 Class Section', 'chong yong wei', 110, 'paid', 10, '2021-01-11 20:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_information`
--

CREATE TABLE `subscription_information` (
  `id` int(11) NOT NULL,
  `subscription_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `session` int(1) NOT NULL,
  `validity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_information`
--

INSERT INTO `subscription_information` (`id`, `subscription_name`, `price`, `session`, `validity`, `status`) VALUES
(1, 'Aerial Yoga Class 1 Class Section', 15, 1, '1 week', 'active'),
(2, 'Aerial Yoga Class 10 Class Section', 110, 10, '2 month', 'active'),
(3, 'Rope Yoga Class 10 Class Section', 110, 10, '2 month', 'active'),
(4, 'Flying Yoga 10 class section', 200, 10, '2 month', 'not active'),
(5, 'Rope Yoga Class 1Class Section', 15, 1, '1 week', 'not active'),
(6, 'Flying Yoga 1 class section', 15, 1, '1 week', 'not active'),
(7, 'Aerial Yoga Class 20 Class Section', 200, 20, '4 month', 'not active'),
(8, 'Rope Yoga Class 20 Class Section', 220, 20, '4 month', 'not active'),
(9, 'Flying Yoga 20 class section', 200, 20, '4 month', 'not active'),
(10, 'Aerial Yoga Class 30 Class Section', 300, 30, '6 month', 'not active'),
(11, 'Rope Yoga Class 30 Class Section', 300, 30, '6 month', 'not active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_enroll`
--
ALTER TABLE `student_enroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_information`
--
ALTER TABLE `subscription_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `student_enroll`
--
ALTER TABLE `student_enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `subscription_information`
--
ALTER TABLE `subscription_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
