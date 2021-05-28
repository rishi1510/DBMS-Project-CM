-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 17, 2021 at 02:11 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Courier-Management`
--

-- --------------------------------------------------------

--
-- Table structure for table `BRANCH`
--

CREATE TABLE `BRANCH` (
  `B_CODE` int(5) NOT NULL,
  `B_NAME` varchar(30) DEFAULT NULL,
  `B_ADDRESS` varchar(100) NOT NULL,
  `B_CITY` varchar(30) DEFAULT NULL,
  `B_PIN` int(6) NOT NULL,
  `B_PHONE` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `BRANCH`
--

INSERT INTO `BRANCH` (`B_CODE`, `B_NAME`, `B_ADDRESS`, `B_CITY`, `B_PIN`, `B_PHONE`) VALUES
(1, 'Chennai Branch', 'New No:32,old No:43, K.b.dasan Rd, Teynampet', 'Chennai', 600028, '9328464275'),
(2, 'Mumbai Branch', '44 -g/, Majithia Nagar, S V Road, Kandivali', 'Mumbai', 400004, '7893467324'),
(3, 'Bangalore Branch', '42nd Cross, Khb Colony, 2nd Stage, Basaveshwara', 'Bangalore', 560001, '8463746321');

-- --------------------------------------------------------

--
-- Table structure for table `COURIER`
--

CREATE TABLE `COURIER` (
  `C_CODE` int(5) NOT NULL,
  `C_NAME` varchar(20) NOT NULL,
  `C_PHONE` char(10) DEFAULT NULL,
  `C_EMAIL` varchar(30) NOT NULL,
  `B_CODE` int(5) DEFAULT NULL,
  `C_PASS` varchar(20) NOT NULL,
  `P_COUNT` int(5) NOT NULL DEFAULT 0
) ;

--
-- Dumping data for table `COURIER`
--

INSERT INTO `COURIER` (`C_CODE`, `C_NAME`, `C_PHONE`, `C_EMAIL`, `B_CODE`, `C_PASS`, `P_COUNT`) VALUES
(1, 'Ajay', '9348748365', 'ajay@gmail.com', 1, 'Ajay1234', 0),
(2, 'Raj', '8426754354', 'raj@gmail.com', 1, 'Rajesh1234', 0),
(3, 'Bharat', '9526452657', 'bharat@gmail.com', 3, 'Bharat1234', 0);

-- --------------------------------------------------------

--
-- Table structure for table `CUSTOMER`
--

CREATE TABLE `CUSTOMER` (
  `CS_CODE` int(5) NOT NULL,
  `CS_NAME` varchar(20) NOT NULL,
  `CS_PHONE` char(10) NOT NULL,
  `CS_ADDRESS` varchar(100) NOT NULL,
  `CS_CITY` varchar(30) NOT NULL,
  `CS_PIN` int(6) NOT NULL,
  `CS_EMAIL` varchar(20) NOT NULL,
  `CS_PASSWORD` varchar(20) NOT NULL
) ;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`CS_CODE`, `CS_NAME`, `CS_PHONE`, `CS_ADDRESS`, `CS_CITY`, `CS_PIN`, `CS_EMAIL`, `CS_PASSWORD`) VALUES
(1, 'Rishi', '9828371484', '1, 4B, RM Towers', 'Chennai', 600028, 'rishi@gmail.com', 'Rishi1234'),
(2, 'Rahul', '8732482747', '47 /, Greams Road, T Nagar', 'Chennai', 600036, 'rahul@gmail.com', 'Rahul1234'),
(3, 'Vignesh', '9848364574', '149, Eldams Rd, Teynampet\r\n\r\n', 'Chennai', 600012, 'vicky@gmail.com', 'Vignesh1234'),
(4, 'Ashwin', '9823657456', 'No 5, Anna Nagar', 'Chennai', 600038, 'ash@gmail.com', 'Ashwin1234');

--
-- Triggers `CUSTOMER`
--
DELIMITER $$
CREATE TRIGGER `NEW_CUST` AFTER INSERT ON `CUSTOMER` FOR EACH ROW UPDATE PACKAGE 
SET RC_CODE = NEW.CS_CODE
WHERE R_EMAIL = NEW.CS_EMAIL
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `MANAGER`
--

CREATE TABLE `MANAGER` (
  `M_CODE` int(5) NOT NULL,
  `M_NAME` varchar(20) NOT NULL,
  `M_EMAIL` varchar(20) NOT NULL,
  `M_PASS` varchar(20) NOT NULL,
  `B_CODE` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `MANAGER`
--

INSERT INTO `MANAGER` (`M_CODE`, `M_NAME`, `M_EMAIL`, `M_PASS`, `B_CODE`) VALUES
(1, 'Ram', 'ram@gmail.com', 'Ramesh12', 1),
(2, 'Shivam', 'shiv@gmail.com', 'Shivam123', 2),
(3, 'Akash', 'akash@gmail.com', 'Akash1234', 3);

-- --------------------------------------------------------

--
-- Table structure for table `PACKAGE`
--

CREATE TABLE `PACKAGE` (
  `P_CODE` int(5) NOT NULL,
  `TO_NAME` varchar(20) NOT NULL,
  `TO_ADDRESS` varchar(100) NOT NULL,
  `TO_CITY` varchar(20) NOT NULL,
  `TO_PIN` int(6) NOT NULL,
  `TO_PHONE` varchar(10) NOT NULL,
  `P_CONTENTS` varchar(100) NOT NULL,
  `P_WEIGHT` int(3) NOT NULL,
  `P_COST` int(10) NOT NULL,
  `PYMT_STATUS` varchar(20) NOT NULL,
  `D_DATE` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `C_CODE` int(5) DEFAULT NULL,
  `R_EMAIL` varchar(20) NOT NULL,
  `RC_CODE` int(5) DEFAULT NULL,
  `CS_CODE` int(5) DEFAULT NULL,
  `COMMENTS` varchar(30) DEFAULT NULL,
  `STATUS` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `PACKAGE`
--

INSERT INTO `PACKAGE` (`P_CODE`, `TO_NAME`, `TO_ADDRESS`, `TO_CITY`, `TO_PIN`, `TO_PHONE`, `P_CONTENTS`, `P_WEIGHT`, `P_COST`, `PYMT_STATUS`, `D_DATE`, `C_CODE`, `R_EMAIL`, `RC_CODE`, `CS_CODE`, `COMMENTS`, `STATUS`) VALUES
(1, 'Rahul', '47 /, Greams Road, T Nagar', 'Chennai', 600036, '8747564323', 'Parcel', 10, 500, 'Cash', '2021-05-14 13:09:49', 1, 'rahul@gmail.com', 2, 1, '', 'Delivered'),
(2, 'Vignesh', '149, Eldams Rd, Teynampet\r\n', 'Chennai', 600012, '9832486472', 'Documents', 3, 200, 'Cash', '2021-05-16 00:00:00', 2, 'vig@gmail.com', 5, 1, '', 'Delivered'),
(7, 'Rishi', '1, 4B, RM Towers', 'Chennai', 600028, '9463253424', 'Parcel', 10, 500, 'Credit Card', '2021-05-14 00:00:00', 1, 'rishi@gmail.com', 1, 2, '', 'Delivered'),
(11, 'Ashwin', 'No 5, \r\nAnna Nagar', 'Chennai', 600038, '9832456324', 'Documents', 5, 250, 'Credit Card', '2021-05-14 00:00:00', 1, 'ash@gmail.com', 4, 1, '', 'Delivered'),
(12, 'Sathwik', 'No 1, First street', 'Bangalore', 560012, '9834846372', 'Parcel', 10, 500, 'Cash', '2021-05-16 00:00:00', 3, 'sathwik@gmail.com', NULL, 1, 'Handle with care', 'Delivered'),
(13, 'Sathwik', 'No 1, first street', 'Chennai', 600067, '9435864736', 'Items', 10, 500, 'Cash', '2021-05-16 00:00:00', 1, 'sathwik@gmail.com', NULL, 2, '', 'Delivered');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `BRANCH`
--
ALTER TABLE `BRANCH`
  ADD PRIMARY KEY (`B_CODE`);

--
-- Indexes for table `COURIER`
--
ALTER TABLE `COURIER`
  ADD PRIMARY KEY (`C_CODE`),
  ADD UNIQUE KEY `C_EMAIL` (`C_EMAIL`),
  ADD KEY `B_CODE` (`B_CODE`);

--
-- Indexes for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  ADD PRIMARY KEY (`CS_CODE`),
  ADD UNIQUE KEY `CS_EMAIL` (`CS_EMAIL`);

--
-- Indexes for table `MANAGER`
--
ALTER TABLE `MANAGER`
  ADD PRIMARY KEY (`M_CODE`),
  ADD UNIQUE KEY `M_CODE` (`M_CODE`),
  ADD UNIQUE KEY `M_USER` (`M_EMAIL`),
  ADD KEY `B_CODE` (`B_CODE`);

--
-- Indexes for table `PACKAGE`
--
ALTER TABLE `PACKAGE`
  ADD PRIMARY KEY (`P_CODE`),
  ADD KEY `C_CODE` (`C_CODE`),
  ADD KEY `CS_CODE` (`CS_CODE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `BRANCH`
--
ALTER TABLE `BRANCH`
  MODIFY `B_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `COURIER`
--
ALTER TABLE `COURIER`
  MODIFY `C_CODE` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  MODIFY `CS_CODE` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `MANAGER`
--
ALTER TABLE `MANAGER`
  MODIFY `M_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `PACKAGE`
--
ALTER TABLE `PACKAGE`
  MODIFY `P_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `COURIER`
--
ALTER TABLE `COURIER`
  ADD CONSTRAINT `COURIER_ibfk_1` FOREIGN KEY (`B_CODE`) REFERENCES `BRANCH` (`B_CODE`);

--
-- Constraints for table `MANAGER`
--
ALTER TABLE `MANAGER`
  ADD CONSTRAINT `MANAGER_ibfk_1` FOREIGN KEY (`B_CODE`) REFERENCES `BRANCH` (`B_CODE`);

--
-- Constraints for table `PACKAGE`
--
ALTER TABLE `PACKAGE`
  ADD CONSTRAINT `PACKAGE_ibfk_1` FOREIGN KEY (`C_CODE`) REFERENCES `COURIER` (`C_CODE`),
  ADD CONSTRAINT `PACKAGE_ibfk_2` FOREIGN KEY (`CS_CODE`) REFERENCES `CUSTOMER` (`CS_CODE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
