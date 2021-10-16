-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2021 at 05:23 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_blockyear`
--

CREATE TABLE `tb_blockyear` (
  `by_ID` int(11) NOT NULL,
  `by_name` varchar(30) NOT NULL,
  `by_status` char(1) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_blockyear`
--

INSERT INTO `tb_blockyear` (`by_ID`, `by_name`, `by_status`, `date_time`) VALUES
(1, '1A', 'A', '2021-10-15 21:19:13'),
(2, '1B', 'A', '2021-10-15 21:19:13'),
(3, '1C', 'A', '2021-10-15 21:19:13'),
(4, '1D', 'A', '2021-10-15 21:19:13'),
(5, '2A', 'A', '2021-10-15 21:19:13'),
(6, '2B', 'A', '2021-10-15 21:19:13'),
(7, '2C', 'A', '2021-10-15 21:19:13'),
(8, '2D', 'A', '2021-10-15 21:19:13'),
(9, '3A', 'A', '2021-10-15 21:19:13'),
(10, '3B', 'A', '2021-10-15 21:19:13'),
(11, '3C', 'A', '2021-10-15 21:19:13'),
(12, '3D', 'A', '2021-10-15 21:19:13'),
(13, '4A', 'A', '2021-10-15 21:19:13'),
(14, '4B', 'A', '2021-10-15 21:19:13'),
(15, '4C', 'A', '2021-10-15 21:19:13'),
(16, '4D', 'A', '2021-10-15 21:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_course`
--

CREATE TABLE `tb_course` (
  `course_ID` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_status` char(1) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_course`
--

INSERT INTO `tb_course` (`course_ID`, `course_name`, `course_status`, `date_time`) VALUES
(1, 'Bachelor of Science in Computer Science', 'A', '2021-10-15 21:12:56'),
(2, 'Bachelor of Science in Information System', 'A', '2021-10-15 21:12:56'),
(3, 'Bachelor of Science in Information Technology Animation', 'A', '2021-10-15 21:12:56'),
(4, 'Bachelor of Science in Information Technology', 'A', '2021-10-15 21:12:56'),
(5, 'Bachelor of Science in Electrical Engineering', 'A', '2021-10-15 21:12:56'),
(6, 'Bachelor of Science in Electronics Communication Engineering', 'A', '2021-10-15 21:12:56'),
(7, 'Bachelor of Science in Computer Engineering', 'A', '2021-10-15 21:12:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dept`
--

CREATE TABLE `tb_dept` (
  `dept_ID` int(11) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `dept_status` char(1) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_dept`
--

INSERT INTO `tb_dept` (`dept_ID`, `dept_name`, `dept_status`, `date_time`) VALUES
(1, 'Computer Science Department', 'A', '2021-10-15 21:05:11'),
(2, 'Engineering Department', 'A', '2021-10-15 21:05:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fee`
--

CREATE TABLE `tb_fee` (
  `fee_ID` int(11) NOT NULL,
  `fee_code` varchar(30) NOT NULL,
  `fee_name` varchar(30) NOT NULL,
  `fee_dscrptn` text NOT NULL,
  `fee_due` date NOT NULL,
  `fee_price` double NOT NULL,
  `fee_status` char(1) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_fee`
--

INSERT INTO `tb_fee` (`fee_ID`, `fee_code`, `fee_name`, `fee_dscrptn`, `fee_due`, `fee_price`, `fee_status`, `date_time`) VALUES
(1, 'F001', 'ID LACE', 'STUDENT ID LACE', '0000-00-00', 170, 'A', '2021-10-16 00:01:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`user_ID`, `username`, `password`, `date_time`) VALUES
(1, 'admin', '1234', '2021-10-15 16:59:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

CREATE TABLE `tb_payment` (
  `transaction_ID` int(11) NOT NULL,
  `stud_ID` int(11) NOT NULL,
  `fee_ID` int(11) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `total_amt` double NOT NULL,
  `rmrks` varchar(15) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`transaction_ID`, `stud_ID`, `fee_ID`, `price`, `qty`, `total_amt`, `rmrks`, `date_time`) VALUES
(1, 1, 1, 170, 1, 170, 'PAID', '2021-10-16 08:39:24'),
(2, 2, 1, 170, 2, 340, 'PAID', '2021-10-16 22:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `stud_ID` int(11) NOT NULL,
  `stud_num` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `mname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `dept_ID` int(11) NOT NULL,
  `course_ID` int(11) NOT NULL,
  `by_ID` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `stud_status` char(1) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`stud_ID`, `stud_num`, `fname`, `mname`, `lname`, `dept_ID`, `course_ID`, `by_ID`, `email`, `stud_status`, `date_time`) VALUES
(1, '2018-PC-100258', 'Maica', 'Dela Cruz', 'Imperial', 1, 4, 14, 'maicaimperial13@gmail.com', 'A', '2021-10-15 22:46:46'),
(2, '2018-PC-100245', 'ANGELICA', 'IBARETA', 'ARABACA', 1, 4, 14, 'angelicaibareta.arabaca@bicol-', 'A', '2021-10-16 22:16:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_blockyear`
--
ALTER TABLE `tb_blockyear`
  ADD PRIMARY KEY (`by_ID`);

--
-- Indexes for table `tb_course`
--
ALTER TABLE `tb_course`
  ADD PRIMARY KEY (`course_ID`);

--
-- Indexes for table `tb_dept`
--
ALTER TABLE `tb_dept`
  ADD PRIMARY KEY (`dept_ID`);

--
-- Indexes for table `tb_fee`
--
ALTER TABLE `tb_fee`
  ADD PRIMARY KEY (`fee_ID`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`transaction_ID`),
  ADD KEY `stud_ID` (`stud_ID`),
  ADD KEY `fee_ID` (`fee_ID`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`stud_ID`),
  ADD KEY `by_ID` (`by_ID`),
  ADD KEY `course_ID` (`course_ID`),
  ADD KEY `dept_ID` (`dept_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_blockyear`
--
ALTER TABLE `tb_blockyear`
  MODIFY `by_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_course`
--
ALTER TABLE `tb_course`
  MODIFY `course_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_dept`
--
ALTER TABLE `tb_dept`
  MODIFY `dept_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_fee`
--
ALTER TABLE `tb_fee`
  MODIFY `fee_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `transaction_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_student`
--
ALTER TABLE `tb_student`
  MODIFY `stud_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD CONSTRAINT `tb_payment_ibfk_1` FOREIGN KEY (`stud_ID`) REFERENCES `tb_student` (`stud_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_payment_ibfk_2` FOREIGN KEY (`fee_ID`) REFERENCES `tb_fee` (`fee_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD CONSTRAINT `tb_student_ibfk_1` FOREIGN KEY (`by_ID`) REFERENCES `tb_blockyear` (`by_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_student_ibfk_2` FOREIGN KEY (`course_ID`) REFERENCES `tb_course` (`course_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_student_ibfk_3` FOREIGN KEY (`dept_ID`) REFERENCES `tb_dept` (`dept_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
