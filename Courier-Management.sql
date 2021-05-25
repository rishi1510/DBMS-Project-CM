-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2021 at 12:57 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

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
-- Table structure for table `ADMIN`
--

CREATE TABLE `ADMIN` (
  `A_CODE` int(5) NOT NULL,
  `A_USER` varchar(30) DEFAULT NULL,
  `A_PASS` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ADMIN`
--

INSERT INTO `ADMIN` (`A_CODE`, `A_USER`, `A_PASS`) VALUES
(1, 'admin', 'password');

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
  `B_PHONE` char(10) NOT NULL,
  `M_CODE` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `BRANCH`
--

INSERT INTO `BRANCH` (`B_CODE`, `B_NAME`, `B_ADDRESS`, `B_CITY`, `B_PIN`, `B_PHONE`, `M_CODE`) VALUES
(1, 'Chennai Branch', 'New No:32,old No:43, K.b.dasan Rd, Teynampet', 'Chennai', 600028, '9328464275', 1),
(2, 'Mumbai Branch', '44 -g/, Majithia Nagar, S V Road, Kandivali', 'Mumbai', 400004, '7893467324', 2),
(3, 'Bangalore Branch', '42nd Cross, Khb Colony, 2nd Stage, Basaveshwara', 'Bangalore', 560001, '8463746321', 3),
(6, 'Delhi Branch', '64, Janpath', 'New Delhi', 110001, '9832814573', 6);

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
  `P_COUNT` int(5) NOT NULL DEFAULT 0,
  `D_COUNT` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `COURIER`
--

INSERT INTO `COURIER` (`C_CODE`, `C_NAME`, `C_PHONE`, `C_EMAIL`, `B_CODE`, `C_PASS`, `P_COUNT`, `D_COUNT`) VALUES
(2, 'Raj', '8426754354', 'raj@gmail.com', 1, 'Rajesh1234', 0, 4),
(3, 'Bharat', '9526452657', 'bharat@gmail.com', 3, 'Bharat1234', 0, 1),
(4, 'Ajay', '9385634765', 'ajay@gmail.com', 1, 'Ajay1234', 0, 3),
(5, 'Vijay', '9346457465', 'vijay@gmail.com', 2, 'Vijay1234', 0, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `CUSTOMER`
--

INSERT INTO `CUSTOMER` (`CS_CODE`, `CS_NAME`, `CS_PHONE`, `CS_ADDRESS`, `CS_CITY`, `CS_PIN`, `CS_EMAIL`, `CS_PASSWORD`) VALUES
(1, 'Rishi', '9828371484', '1, 4B, RM Towers', 'Chennai', 600028, 'rishi@gmail.com', 'Rishi1234'),
(2, 'Rahul', '8732482747', '47 /, Greams Road, T Nagar', 'Chennai', 600036, 'rahul@gmail.com', 'Rahul1234'),
(3, 'Vignesh', '9848364574', '149, Eldams Rd, Teynampet\r\n\r\n', 'Chennai', 600012, 'vicky@gmail.com', 'Vignesh1234'),
(4, 'Ashwin', '9823657456', 'No 5, Anna Nagar', 'Chennai', 600038, 'ash@gmail.com', 'Ashwin1234'),
(5, 'Sathwik', '9329375483', 'No 75 Cross Street', 'Mumbai', 560469, 'sathwik@gmail.com', 'Sathwik1234');

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
(3, 'Akash', 'akash@gmail.com', 'Akash1234', 3),
(6, 'Sam', 'sam123@gmail.com', 'Samuel1234', 6);

--
-- Triggers `MANAGER`
--
DELIMITER $$
CREATE TRIGGER `NEW_MANAGER` AFTER INSERT ON `MANAGER` FOR EACH ROW UPDATE BRANCH
SET M_CODE = NEW.M_CODE
WHERE NEW.B_CODE = B_CODE
$$
DELIMITER ;

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
(2, 'Vignesh', '149, Eldams Rd, Teynampet\r\n', 'Chennai', 600012, '9832486472', 'Documents', 3, 200, 'Cash', '2021-05-22 17:33:50', 2, 'vig@gmail.com', 3, 1, '', 'Delivered'),
(7, 'Rishi', '1, 4B, RM Towers', 'Chennai', 600028, '9463253424', 'Parcel', 10, 500, 'Credit Card', '2021-05-19 18:30:00', 2, 'rishi@gmail.com', 1, 2, '', 'Delivered'),
(11, 'Ashwin', 'No 5, \r\nAnna Nagar', 'Chennai', 600038, '9832456324', 'Documents', 5, 250, 'Credit Card', '2021-05-20 10:33:01', 2, 'ash@gmail.com', 4, 1, '', 'Delivered'),
(12, 'Sathwik', 'No 1, First street', 'Bangalore', 560012, '9834846372', 'Parcel', 10, 500, 'Cash', '2021-05-24 09:20:25', 3, 'sathwik@gmail.com', 5, 1, 'Handle with care', 'Delivered'),
(13, 'Sathwik', 'No 1, first street', 'Chennai', 600067, '9435864736', 'Items', 10, 500, 'Cash', '2021-05-24 09:20:25', 2, 'sathwik@gmail.com', 5, 2, '', 'Delivered'),
(15, 'Rahul', '47 /, Greams Road, T Nagar', 'Chennai', 600036, '9756473564', 'Documents', 2, 100, 'Cash', '2021-05-21 16:58:01', 4, 'rahul@gmail.com', 2, 1, 'Handle with care', 'Delivered'),
(18, 'Rahul', 'ABC Road', 'Chennai', 600345, '9326575643', 'Items', 25, 1250, 'Cash', '2021-05-21 18:30:00', 4, 'rahul@gmail.com', 2, 1, 'Fragile', 'Delivered'),
(19, 'Ashwin', '1234 Road', 'Chennai', 600045, '9643754735', 'Food', 30, 1500, 'Cash', '2021-05-21 18:30:00', 4, 'ash@gmail.com', 4, 3, '', 'Delivered'),
(23, 'Ashwin', 'No 546 , Cross Street', 'Mumbai', 560002, '9383475855', 'Gift', 10, 500, 'Credit Card', '2021-05-23 18:30:00', 5, 'ash@gmail.com', 4, 5, '', 'Delivered');

--
-- Triggers `PACKAGE`
--
DELIMITER $$
CREATE TRIGGER `DEL_COUNT_DEC` BEFORE DELETE ON `PACKAGE` FOR EACH ROW UPDATE COURIER 
SET P_COUNT = P_COUNT-1
WHERE OLD.STATUS = 'Courier Assigned' AND OLD.C_CODE = C_CODE
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `D_COUNT_INC` AFTER UPDATE ON `PACKAGE` FOR EACH ROW UPDATE COURIER
SET D_COUNT = D_COUNT + 1
WHERE NEW.STATUS = 'Delivered' AND OLD.STATUS = 'Courier Assigned' AND NEW.C_CODE = C_CODE
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `P_COUNT_DEC` AFTER UPDATE ON `PACKAGE` FOR EACH ROW UPDATE COURIER
SET P_COUNT = P_COUNT - 1
WHERE NEW.STATUS = 'Delivered' AND OLD.STATUS = 'Courier Assigned' AND NEW.C_CODE = C_CODE
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `P_COUNT_INC` AFTER UPDATE ON `PACKAGE` FOR EACH ROW UPDATE COURIER
SET P_COUNT = P_COUNT+1
WHERE OLD.STATUS = 'Processing Request' AND NEW.STATUS = 'Courier Assigned' AND NEW.C_CODE = C_CODE
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD PRIMARY KEY (`A_CODE`);

--
-- Indexes for table `BRANCH`
--
ALTER TABLE `BRANCH`
  ADD PRIMARY KEY (`B_CODE`),
  ADD KEY `M_CODE` (`M_CODE`);

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
-- AUTO_INCREMENT for table `ADMIN`
--
ALTER TABLE `ADMIN`
  MODIFY `A_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `BRANCH`
--
ALTER TABLE `BRANCH`
  MODIFY `B_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `COURIER`
--
ALTER TABLE `COURIER`
  MODIFY `C_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `CUSTOMER`
--
ALTER TABLE `CUSTOMER`
  MODIFY `CS_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `MANAGER`
--
ALTER TABLE `MANAGER`
  MODIFY `M_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `PACKAGE`
--
ALTER TABLE `PACKAGE`
  MODIFY `P_CODE` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `BRANCH`
--
ALTER TABLE `BRANCH`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`M_CODE`) REFERENCES `MANAGER` (`M_CODE`);

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
