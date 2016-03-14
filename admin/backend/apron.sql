-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 182.50.133.170
-- Generation Time: Aug 09, 2014 at 01:41 AM
-- Server version: 5.5.37
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `apron`
--

-- --------------------------------------------------------

--
-- Table structure for table `apron`
--

CREATE TABLE `apron` (
  `ApronId` varchar(50) NOT NULL,
  `BatchNo` int(11) NOT NULL,
  `ArticleCode` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `AssignedTo` varchar(50) NOT NULL,
  `Manufacturer` varchar(40) NOT NULL,
  `Garment` varchar(40) NOT NULL,
  `Core` varchar(40) NOT NULL,
  `Colour` varchar(30) NOT NULL,
  `Monogram` varchar(50) NOT NULL,
  `ManufacturerDate` date NOT NULL,
  `LastInspectionDate` date NOT NULL,
  `NextInspectionDate` date NOT NULL,
  `Status` varchar(40) NOT NULL,
  `Active` int(11) NOT NULL,
  PRIMARY KEY (`ApronId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apron`
--

INSERT INTO `apron` VALUES('0020130809002-079', 0, 111, 5, '231a3sd', 'asd', 'Kiran XRay', 'Frontal', 'Lead Free', 'blue', 'asdas', '2014-03-20', '0000-00-00', '2014-06-22', 'In Service', 1);
INSERT INTO `apron` VALUES('10', 3, 10, 5, 'C', 'atinder', 'Infab', 'Sleeve', 'Lead Composite', 'Blue', 'X', '0000-00-00', '2014-03-22', '2014-06-22', 'In Service', 1);
INSERT INTO `apron` VALUES('11111', 1, 1, 2, '1', 'atinder', 'Mavig', 'Vest', 'Lead Composite', 'red', 'LC', '0000-00-00', '2014-06-28', '2014-12-28', 'Replacing', 1);
INSERT INTO `apron` VALUES('111119', 1, 1, 2, '1', 'atinder', 'Mavig', 'Vest', 'Lead Composite', 'red', 'LC', '0000-00-00', '2014-06-28', '2014-12-28', 'Replacing', 1);
INSERT INTO `apron` VALUES('1112', 23, 1, 2, '2', '2', 'Kiran XRay', 'Coat Apron Regular 60 x 100', 'w', 'blu', 'mng', '0000-00-00', '2014-03-23', '2014-09-23', 'Replacing', 1);
INSERT INTO `apron` VALUES('11129', 23, 1, 2, '2', '2', 'Kiran XRay', 'Coat Apron Regular 60 x 100', 'w', 'blu', 'mng', '0000-00-00', '2014-06-28', '2014-12-28', 'Replacing', 1);
INSERT INTO `apron` VALUES('119', 1, 1, 2, '11', '21', 'Kiran', 'Thyroid Collar', 'Ultralite', 'Accc', 'TC', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('12', 2, 1, 2, '3', '4', 'Infab', 'Breast Shield', 'Lead', '6', '7', '0000-00-00', '2014-06-29', '2014-12-29', 'Replacing', 1);
INSERT INTO `apron` VALUES('123', 1, 1, 3, '11', '21', 'Kiran', 'Thyroid Collar', 'Ultralite', 'Accc', 'TC', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('12345', 12345, 12345, 6, 'Radiology', 'Dr. Raju Solanki', 'Kiran', 'Coat Apron Regular 60 x 100', 'Lead', 'Blue', 'Kiran', '0000-00-00', '2014-07-23', '2015-07-23', 'In Service', 1);
INSERT INTO `apron` VALUES('1235', 0, 111, 2, '231a3sd', 'asd', 'Kiran XRay', 'Frontal', 'Lead Free', 'blue', 'asdas', '2014-03-20', '0000-00-00', '2014-06-22', 'In Service', 1);
INSERT INTO `apron` VALUES('1236', 0, 111, 5, '231a3sd', 'asd', 'Kiran XRay', 'Frontal', 'Lead Free', 'blue', 'asdas', '2014-03-20', '0000-00-00', '2014-06-22', 'In Service', 1);
INSERT INTO `apron` VALUES('124', 1, 1, 2, '11', '21', 'Kiran', 'Thyroid Collar', 'Ultralite', 'Accc', 'TC', '0000-00-00', '2014-06-29', '2014-12-29', 'Replacing', 1);
INSERT INTO `apron` VALUES('1458963', 0, 0, 2, 'A', 'S', 'Infab', 'Breast Shield', 'Lead', 's', 'S', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('145899963', 0, 0, 2, 'A', 'S', 'Infab', 'Breast Shield', 'Lead', 's', 'S', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('1589632', 2, 1, 2, '3H', 'HG', 'Kiran XRay', 'Vest', 'A', 'H', 'GF1', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('158999632', 2, 1, 2, '3H', 'HG', 'Kiran XRay', 'Vest', 'A', 'H', 'GF1', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('15963', 1, 1, 1, 'A', 'B', 'A', 'B', 'A', 'B', 'A', '0000-00-00', '0000-00-00', '0000-00-00', 'Missing', 2);
INSERT INTO `apron` VALUES('1923', 0, 0, 2, 'a', '2', 'Infab', 'Breast Shield', 'Lead', '3', '3', '0000-00-00', '0000-00-00', '0000-00-00', 'Replacing', 1);
INSERT INTO `apron` VALUES('211', 1, 1, 2, '11', '21', 'Kiran', 'Thyroid Collar', 'Ultralite', 'Accc', 'TC', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('211111', 1, 1, 2, '1', 'atinder', 'Mavig', 'Vest', 'Lead Composite', 'red', 'LC', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('2111119', 1, 1, 2, '1', 'atinder', 'Mavig', 'Vest', 'Lead Composite', 'red', 'LC', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('21112', 23, 1, 2, '2', '2', 'Kiran XRay', 'Coat Apron Regular 60 x 100', 'w', 'blu', 'mng', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('211129', 23, 1, 2, '2', '2', 'Kiran XRay', 'Coat Apron Regular 60 x 100', 'w', 'blu', 'mng', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('2119', 1, 1, 2, '11', '21', 'Kiran', 'Thyroid Collar', 'Ultralite', 'Accc', 'TC', '0000-00-00', '0000-00-00', '0000-00-00', 'Damage', 1);
INSERT INTO `apron` VALUES('212', 2, 1, 2, '3', '4', 'Infab', 'Breast Shield', 'Lead', '6', '7', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('2123', 1, 1, 2, 'A', 'B', 'A', 'B', 'A', 'B', 'A', '0000-00-00', '0000-00-00', '0000-00-00', 'Missing', 1);
INSERT INTO `apron` VALUES('21458963', 0, 0, 2, 'A', 'S', 'Infab', 'Breast Shield', 'Lead', 's', 'S', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('222', 0, 0, 2, 'a', '2', 'Infab', 'Breast Shield', 'Lead', '3', '3', '0000-00-00', '0000-00-00', '0000-00-00', 'Replacing', 1);
INSERT INTO `apron` VALUES('2222', 2, 1, 2, '3H', 'HG', 'Kiran XRay', 'Vest', 'A', 'H', 'GF1', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('22222', 22222, 22222, 6, 'Radiology', 'Dr. Jitendra Shah', 'Kiran', 'Coat Apron Regular 60 x 100', 'Lead', 'pink', 'kiran', '0000-00-00', '2014-07-14', '2015-07-14', 'In Service', 1);
INSERT INTO `apron` VALUES('4', 1, 4, 5, 'A', 'atinder', 'Kiran XRay', 'Frontal', 'Lead', 'Blue', 'X', '0000-00-00', '2014-03-20', '2014-06-20', 'In Service', 1);
INSERT INTO `apron` VALUES('5', 1, 5, 5, 'A', 'atinder', 'Kiran XRay', 'Frontal', 'Lead Composite', 'Blue', 'X', '0000-00-00', '2014-03-20', '2014-06-20', 'In Service', 1);
INSERT INTO `apron` VALUES('55', 5, 9, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('552558', 5, 9, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('568855S2285s8', 5, 56, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('568855S85s8', 5, 56, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('588', 2, 1, 2, '3', '4', 'Infab', 'Breast Shield', 'Lead', '6', '7', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('6', 2, 6, 5, 'B', 'atinder', 'Kiran XRay', 'Frontal', 'Lead', 'Blue', 'X', '0000-00-00', '2014-03-20', '2014-06-20', 'In Service', 1);
INSERT INTO `apron` VALUES('7', 2, 7, 5, 'B', 'atinder', 'Kiran XRay', 'Frontal', 'Lead', 'Blue', 'X', '0000-00-00', '2014-03-20', '2014-06-20', 'Replacing', 1);
INSERT INTO `apron` VALUES('78', 5, 9, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('8', 2, 8, 5, 'C', 'atinder', 'Kiran XRay', 'Sleeve', 'Lead Composite', 'Blue', 'X', '0000-00-00', '2014-03-20', '2014-06-20', 'Out of Service', 1);
INSERT INTO `apron` VALUES('8552222', 5, 56, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('85856', 8, 87, 2, '8', '58', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('885', 8, 87, 2, '8', '58', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('8888', 5, 123, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('895856', 8, 87, 2, '8', '58', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('8999', 8, 87, 2, '8', '58', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('9', 5, 56, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('912', 2, 1, 2, '3', '4', 'Infab', 'Breast Shield', 'Lead', '6', '7', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('978', 5, 9, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);
INSERT INTO `apron` VALUES('ABC', 5, 123, 2, '5', '5', 'Infab', 'Breast Shield', 'Lead', '5', '5', '0000-00-00', '0000-00-00', '0000-00-00', 'In Service', 1);

-- --------------------------------------------------------

--
-- Table structure for table `core`
--

CREATE TABLE `core` (
  `CoreId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Core` varchar(50) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`CoreId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `core`
--

INSERT INTO `core` VALUES(1, 1, 'Leaded', 1);
INSERT INTO `core` VALUES(13, 2, 'titanium 4845', 0);
INSERT INTO `core` VALUES(14, 2, 'ACB', 1);
INSERT INTO `core` VALUES(15, 2, 'AVB', 1);
INSERT INTO `core` VALUES(16, 2, 'A', 1);
INSERT INTO `core` VALUES(18, 6, 'Zerolead', 1);
INSERT INTO `core` VALUES(20, 1, 'Ultralite - Light leaded', 1);
INSERT INTO `core` VALUES(21, 1, 'Zerolead - No lead', 1);
INSERT INTO `core` VALUES(22, 8, 'abc', 1);
INSERT INTO `core` VALUES(23, 8, 'dsfd', 1);
INSERT INTO `core` VALUES(24, 8, 'vbvcb', 1);

-- --------------------------------------------------------

--
-- Table structure for table `garment`
--

CREATE TABLE `garment` (
  `GarmentId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Garment` varchar(50) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`GarmentId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `garment`
--

INSERT INTO `garment` VALUES(2, 1, 'Frontal', 1);
INSERT INTO `garment` VALUES(3, 1, 'Full Wrap', 1);
INSERT INTO `garment` VALUES(4, 1, 'Glove', 1);
INSERT INTO `garment` VALUES(5, 1, 'Half Apron', 1);
INSERT INTO `garment` VALUES(6, 1, 'Patient Protection', 1);
INSERT INTO `garment` VALUES(7, 1, 'Gonadal Shield', 1);
INSERT INTO `garment` VALUES(8, 1, 'One-piece Apron', 1);
INSERT INTO `garment` VALUES(9, 1, 'Pediatric Frontal', 1);
INSERT INTO `garment` VALUES(10, 1, 'Skirt', 1);
INSERT INTO `garment` VALUES(11, 1, 'Sleeve', 1);
INSERT INTO `garment` VALUES(12, 1, 'Sternum', 0);
INSERT INTO `garment` VALUES(13, 1, 'Table Apron', 1);
INSERT INTO `garment` VALUES(14, 1, 'Thyroid Collar', 1);
INSERT INTO `garment` VALUES(15, 1, 'Tube Apron', 1);
INSERT INTO `garment` VALUES(16, 1, 'Vest', 1);
INSERT INTO `garment` VALUES(17, 1, 'Vest and Skirt', 1);
INSERT INTO `garment` VALUES(18, 1, 'Vest with Thyroid Attached', 1);
INSERT INTO `garment` VALUES(20, 1, 'Coat Apron', 1);
INSERT INTO `garment` VALUES(21, 1, 'Double Sided Apron', 1);
INSERT INTO `garment` VALUES(22, 1, 'Dental Apron', 1);
INSERT INTO `garment` VALUES(23, 1, 'Ovarian Shield', 1);
INSERT INTO `garment` VALUES(24, 1, 'Head Protection', 1);
INSERT INTO `garment` VALUES(25, 1, 'Hand Shield', 1);
INSERT INTO `garment` VALUES(26, 1, 'Cap', 1);
INSERT INTO `garment` VALUES(27, 8, '21323', 1);
INSERT INTO `garment` VALUES(28, 8, '43324', 1);
INSERT INTO `garment` VALUES(29, 8, '65767', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inspect`
--

CREATE TABLE `inspect` (
  `InspectId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `ApronId` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `Status` varchar(45) NOT NULL,
  `Note` longtext NOT NULL,
  `Pinhole` varchar(30) NOT NULL,
  `Cracks` varchar(30) NOT NULL,
  `Stitching` varchar(30) NOT NULL,
  `Buckle` varchar(30) NOT NULL,
  `Condition` varchar(30) NOT NULL,
  UNIQUE KEY `inspectId` (`InspectId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=216 ;

--
-- Dumping data for table `inspect`
--

INSERT INTO `inspect` VALUES(1, 2, '2', '2014-02-24', 'Damage', 'Minor bruises', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(2, 2, '3', '2014-02-24', 'Missing', 'Lost', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(3, 2, '4', '2014-02-24', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(4, 2, '5', '2014-02-24', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(5, 2, '6', '2014-02-25', 'In Service', 'working great', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(17, 2, '456', '2014-02-27', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(67, 2, '1', '2014-03-02', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(68, 2, '123', '2014-03-02', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(95, 2, '11', '2014-03-03', 'Damage', 'brushed', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(96, 2, '1', '2014-03-03', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(97, 2, '11', '2014-03-03', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(98, 2, '3', '2014-03-03', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(99, 2, '1', '2014-03-04', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(100, 2, '2', '2014-03-04', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(105, 2, '1', '2014-03-08', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(106, 2, '11', '2014-03-08', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(107, 2, '1', '2014-03-08', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(108, 2, '11', '2014-03-08', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(109, 2, '1', '2014-03-08', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(110, 2, '11', '2014-03-08', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(111, 2, '123', '2014-03-08', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(112, 2, '1458963', '2014-03-08', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(113, 2, '1', '2014-03-08', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(114, 2, '11', '2014-03-08', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(115, 2, '123', '2014-03-08', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(116, 2, '1458963', '2014-03-08', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(117, 2, '2', '2014-03-08', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(118, 2, '1', '2014-03-09', 'Out of Service', 'bruises', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(119, 2, '1', '2014-03-09', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(120, 2, '11', '2014-03-09', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(121, 2, '1', '2014-03-09', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(122, 2, '11', '2014-03-09', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(123, 2, '123', '2014-03-09', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(124, 2, '11', '2014-03-09', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(125, 2, '123', '2014-03-09', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(126, 2, '1', '2014-03-09', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(127, 2, '11', '2014-03-09', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(128, 2, '1', '2014-03-09', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(129, 2, '11111', '2014-03-09', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(130, 2, '1112', '2014-03-09', 'Damage', 'Yo', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(131, 2, '11', '2014-03-14', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(132, 2, '12', '2014-03-16', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(133, 2, '11', '2014-03-16', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(134, 2, '11', '2014-03-16', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(135, 5, '2', '2014-03-19', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(136, 5, '3', '2014-03-19', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(137, 6, '12345', '2014-03-20', 'In Service', 'Good', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(138, 6, '12345', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(139, 6, '12345', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(140, 6, '12345', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(141, 6, '12345', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(142, 6, '12345', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(143, 5, '10', '2014-03-20', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(144, 5, '9', '2014-03-20', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(145, 5, '8', '2014-03-20', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(146, 5, '7', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(147, 5, '4', '2014-03-20', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(148, 5, '5', '2014-03-20', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(149, 5, '6', '2014-03-20', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(150, 5, '7', '2014-03-20', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(151, 5, '10', '2014-03-20', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(152, 5, '4', '2014-03-20', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(153, 5, '4', '2014-03-20', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(154, 6, '12345', '2014-03-21', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(155, 6, '22222', '2014-03-21', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(156, 6, '22222', '2014-03-21', 'In Service', 'Good condition', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(157, 2, '11', '2014-03-22', 'Missing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(158, 2, '11', '2014-03-22', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(159, 2, '11111', '2014-03-22', 'Damage', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(160, 5, '2147483647', '2014-03-22', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(161, 5, '2147483647', '2014-03-22', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(162, 5, '2147483647', '2014-03-22', 'Out of Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(163, 5, '10', '2014-03-22', 'In Service', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(164, 5, '2147483647', '2014-03-22', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(165, 2, '11111', '2014-03-23', 'Replacing', 'wdcwc', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(166, 2, '11111', '2014-03-23', 'Replacing', 'Send Blue Apron', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(167, 2, '111119', '2014-03-23', 'Replacing', 'Send Blue Apron', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(168, 2, '11111', '2014-03-23', 'Replacing', 'Send Blue Apron', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(169, 2, '111119', '2014-03-23', 'Replacing', 'Send Blue Apron', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(170, 2, '11111', '2014-03-23', 'Replacing', 'ASAP', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(171, 2, '111119', '2014-03-23', 'Replacing', 'ASADDF', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(172, 2, '1112', '2014-03-23', 'Replacing', 'ASADDF', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(173, 2, '111119', '2014-03-23', 'Replacing', 'ASADDF', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(174, 2, '1112', '2014-03-23', 'Replacing', 'ASADDF', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(175, 5, '0020130809002-079', '2014-03-24', 'Replacing', 'The apron should be replaced with a red one', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(176, 6, '12345', '2014-03-25', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(177, 6, '12345', '2014-03-25', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(178, 6, '12345', '2014-04-11', 'Replacing', '', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(179, 2, '11111', '2014-06-28', 'In Service', 'ABC', '0', '0', '0', '0', '0');
INSERT INTO `inspect` VALUES(180, 2, '11111', '2014-06-28', 'Damage', 'ABC', '0', '0', '0', '0', '1');
INSERT INTO `inspect` VALUES(181, 2, '11111', '2014-06-28', 'In Service', '', '', 'Yes', 'No', 'Yes', 'Bad');
INSERT INTO `inspect` VALUES(182, 2, '11111', '2014-06-28', 'In Service', 'Test TestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTestTest', 'Yes', 'No', 'Yes', 'Yes', 'Good');
INSERT INTO `inspect` VALUES(183, 2, '11111', '2014-06-28', 'Damage', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(184, 2, '111119', '2014-06-28', 'Damage', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(185, 2, '11111', '2014-06-28', 'Replacing', 'ABC', '', '', '', '', '');
INSERT INTO `inspect` VALUES(186, 2, '111119', '2014-06-28', 'Replacing', 'ABC', '', '', '', '', '');
INSERT INTO `inspect` VALUES(187, 2, '11111', '2014-06-28', 'Replacing', 'ABC', '', '', '', '', '');
INSERT INTO `inspect` VALUES(188, 2, '11111', '2014-06-28', 'Replacing', 'ABC', '', '', '', '', '');
INSERT INTO `inspect` VALUES(189, 2, '11111', '2014-06-28', 'Replacing', 'ACB', '', '', '', '', '');
INSERT INTO `inspect` VALUES(190, 2, '11111', '2014-06-28', 'Replacing', 'ACB', '', '', '', '', '');
INSERT INTO `inspect` VALUES(191, 2, '11111', '2014-06-28', 'Replacing', 'ACB', '', '', '', '', '');
INSERT INTO `inspect` VALUES(192, 2, '11111', '2014-06-28', 'Replacing', 'ACB', '', '', '', '', '');
INSERT INTO `inspect` VALUES(193, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(194, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(195, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(196, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(197, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(198, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(199, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(200, 2, '11129', '2014-06-28', 'Replacing', 'A', '', '', '', '', '');
INSERT INTO `inspect` VALUES(201, 2, '12', '2014-06-29', 'Replacing', 'WE', '', '', '', '', '');
INSERT INTO `inspect` VALUES(202, 2, '124', '2014-06-29', 'Replacing', 'WE', '', '', '', '', '');
INSERT INTO `inspect` VALUES(203, 6, '12345', '2014-07-04', 'In Service', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(204, 6, '22222', '2014-07-04', 'In Service', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(205, 6, '12345', '2014-07-04', 'Damage', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(206, 6, '22222', '2014-07-04', 'Damage', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(207, 6, '12345', '2014-07-04', 'Damage', 'notes', 'No', 'Yes', 'Yes', 'Yes', 'Bad');
INSERT INTO `inspect` VALUES(208, 6, '12345', '2014-07-04', 'Replacing', 'ghgy', '', '', '', '', '');
INSERT INTO `inspect` VALUES(209, 6, '12345', '2014-07-04', 'Replacing', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(210, 6, '12345', '2014-07-04', 'Replacing', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(211, 6, '12345', '2014-07-14', 'In Service', 'stains present, need to replace this in 2 months', 'No', 'No', 'Yes', 'Yes', 'Good');
INSERT INTO `inspect` VALUES(212, 6, '12345', '2014-07-14', 'In Service', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(213, 6, '22222', '2014-07-14', 'In Service', '', '', '', '', '', '');
INSERT INTO `inspect` VALUES(214, 6, '12345', '2014-07-15', 'In Service', '', 'No', 'No', 'No', 'No', 'Good');
INSERT INTO `inspect` VALUES(215, 6, '12345', '2014-07-23', 'In Service', 'Hfhf', 'Yes', 'No', 'No', 'No', 'Good');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `User_Id` int(11) NOT NULL,
  `Time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` VALUES(2, '1393307385');
INSERT INTO `login_attempts` VALUES(3, '1393345966');
INSERT INTO `login_attempts` VALUES(3, '1393345969');
INSERT INTO `login_attempts` VALUES(3, '1393345970');
INSERT INTO `login_attempts` VALUES(3, '1393345974');
INSERT INTO `login_attempts` VALUES(3, '1393345974');
INSERT INTO `login_attempts` VALUES(3, '1393345976');
INSERT INTO `login_attempts` VALUES(5, '1393408202');
INSERT INTO `login_attempts` VALUES(5, '1393408249');
INSERT INTO `login_attempts` VALUES(5, '1393408250');
INSERT INTO `login_attempts` VALUES(5, '1393408250');
INSERT INTO `login_attempts` VALUES(5, '1393408250');
INSERT INTO `login_attempts` VALUES(5, '1393408251');
INSERT INTO `login_attempts` VALUES(2, '1393408792');
INSERT INTO `login_attempts` VALUES(2, '1393408805');
INSERT INTO `login_attempts` VALUES(2, '1393409392');
INSERT INTO `login_attempts` VALUES(2, '1393477240');
INSERT INTO `login_attempts` VALUES(2, '1393477242');
INSERT INTO `login_attempts` VALUES(2, '1393479633');
INSERT INTO `login_attempts` VALUES(2, '1393497486');
INSERT INTO `login_attempts` VALUES(3, '1393522839');
INSERT INTO `login_attempts` VALUES(3, '1393522850');
INSERT INTO `login_attempts` VALUES(7, '1393561866');
INSERT INTO `login_attempts` VALUES(7, '1393561870');
INSERT INTO `login_attempts` VALUES(7, '1393561880');
INSERT INTO `login_attempts` VALUES(7, '1393561892');
INSERT INTO `login_attempts` VALUES(2, '1393563671');
INSERT INTO `login_attempts` VALUES(2, '1393563689');
INSERT INTO `login_attempts` VALUES(3, '1393658905');
INSERT INTO `login_attempts` VALUES(3, '1393658906');
INSERT INTO `login_attempts` VALUES(3, '1393658907');
INSERT INTO `login_attempts` VALUES(3, '1393658907');
INSERT INTO `login_attempts` VALUES(3, '1393658907');
INSERT INTO `login_attempts` VALUES(3, '1393658908');
INSERT INTO `login_attempts` VALUES(3, '1393867286');
INSERT INTO `login_attempts` VALUES(1, '1394205604');
INSERT INTO `login_attempts` VALUES(1, '1394205604');
INSERT INTO `login_attempts` VALUES(1, '1394278027');
INSERT INTO `login_attempts` VALUES(1, '1394278035');
INSERT INTO `login_attempts` VALUES(1, '1394278048');
INSERT INTO `login_attempts` VALUES(1, '1394280202');
INSERT INTO `login_attempts` VALUES(1, '1394360495');
INSERT INTO `login_attempts` VALUES(2, '1394976153');
INSERT INTO `login_attempts` VALUES(2, '1394987023');
INSERT INTO `login_attempts` VALUES(3, '1395162040');
INSERT INTO `login_attempts` VALUES(2, '1395162061');
INSERT INTO `login_attempts` VALUES(2, '1395162068');
INSERT INTO `login_attempts` VALUES(1, '1395163583');
INSERT INTO `login_attempts` VALUES(3, '1395208215');
INSERT INTO `login_attempts` VALUES(1, '1395394689');
INSERT INTO `login_attempts` VALUES(2, '1395494543');
INSERT INTO `login_attempts` VALUES(2, '1395494557');
INSERT INTO `login_attempts` VALUES(2, '1395494568');
INSERT INTO `login_attempts` VALUES(2, '1395495746');
INSERT INTO `login_attempts` VALUES(2, '1395495757');
INSERT INTO `login_attempts` VALUES(1, '1397906859');
INSERT INTO `login_attempts` VALUES(1, '1399723075');
INSERT INTO `login_attempts` VALUES(1, '1399723087');
INSERT INTO `login_attempts` VALUES(1, '1399723095');
INSERT INTO `login_attempts` VALUES(1, '1400570519');
INSERT INTO `login_attempts` VALUES(1, '1407568784');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `ManufacturerId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `Manufacturer` varchar(50) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ManufacturerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` VALUES(2, 1, 'Kiran', 1);
INSERT INTO `manufacturer` VALUES(4, 1, '360Cope', 1);
INSERT INTO `manufacturer` VALUES(5, 1, 'Mavig', 1);
INSERT INTO `manufacturer` VALUES(6, 1, 'Infab', 1);
INSERT INTO `manufacturer` VALUES(7, 8, 'ASDSA', 1);
INSERT INTO `manufacturer` VALUES(8, 8, 'WEE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` char(128) NOT NULL,
  `Salt` char(128) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` VALUES(1, 'NA', 'admin@admin.com', 'f0d9b0a2e5d77e59738b3d0b77df7bc553ecf40d70df2c01f03088bbe0d3611dfd73b9dee6d7c5f9bfb2860fbc69df39d8295712b0e36e5468929c734def47db', 'ca00113695909a690e19b8b8878bbac533c70f427a4286a65ad6e780dc897ba31df901dc92d368c332cac5bedffb00358327456e1a1aa498f6fbb11781d82065');
INSERT INTO `members` VALUES(2, 'NA', 'abc123@gmail.com', 'cde2d2968e537b686c6ba813640a7844cc0edd65ecff9e8d09010e664d67355974f6096878f8cde5d7db1f17ff287fe3737d411ca705e8b2284dfc692f91773f', 'd15042a7dc1f531caf2ec075ddb33efc09f9d43cbf68e3ac05e1a3c37960aa978cd424bc099f792bf62d10f5ffa68645fdc590fd8402a3897a43b4f212ee3adb');
INSERT INTO `members` VALUES(3, 'NA', 'abc@gmail.com', 'b9c4ecd40f260211f2745dc2ac14f1077ee0b2792176ac730d3e0a3c94ad09cf1fc07f7fc605b90529d3eb56dff447cdefc31482ecd56da203f372900f129f16', '9a56e178c56df61410704f7f19f63e9aa9194c9498f6edb4884aa98bcbf204cbc69ff293cace313c1a25d5786abf67c31c7b8fc5a6f4837958eb9eb6eb71c765');
INSERT INTO `members` VALUES(4, 'NA', 'shroffgaurav@hotmail.com', 'ef51729b01ac1c559da51fe591c2b4cc19cbb04f55c33dd672364c3a094dd45cd007e156950bd56b0a66c0ce97fb6d715d328d8bfd698ed66fa87b1dc6cb4397', '2d42bd003ec3aece3135e7930913dabb797898bf5a7dd364a05bf4f58fcec733135315f2075a1a0d3f6897dab008a8a1e20af38a4f8b0c44321c563d6efea847');
INSERT INTO `members` VALUES(5, 'NA', 'atnerio@gmail.com', '673df535b6cd11b114c20745452c572f70c9b6bc82e1d4f818fb8763a72c161152fa1962f3f78d150fe3a86a1932aec08b8960a22ead146e938ead6700863e64', '5810d1ff646b051bbdfa637958c61e0a68db2e2ede75c68e25c64bf2d88c866bb3ed73373d9045c59db27753c764e5280456ccc0cd854b74f9800740b41cedc6');
INSERT INTO `members` VALUES(6, 'NA', 'it@kiranxray.com', 'bf61ff22cbb407cbe43764c24f2569d12a9e9060c1573a6b8040894cef2cc4a8fa93e04e03ce03d28f9f0c6092db6d7b21119920dfe553c3b7964aa8e8c69a83', '85e82074692e5a0f87354a8459e036a8a8bbef9eff1c8ead4e5c2e1eadf01f7cfa8ca8dab4d28983e5dfa1b179fec1a828f82b2ddecacb6fb01caacf3374925e');
INSERT INTO `members` VALUES(7, 'NA', 'yogesh.malhotra@kiranxray.com', '497af2027f0e5f733169e49faa8bd8a6cf249ec1e69e2ae774fa67da67ae0fcc0287c152ea522794eb14914f533cd3828f193d4b41128ea2678d2861af9ea4f4', '4489ec410bb1d805ee6dc008b44e1919166f2941bb78be0d97836f49d36a51ddb22613ab92c7b52c6670a3ccb60e0622b50e5c9544e584145ecff474a19a776f');
INSERT INTO `members` VALUES(8, 'NA', 'dhaval80shah@gmail.com', '1d867868862da5bd31e2e7664b5225aa66a65d08e1de71e5dab6f96a6cad16ecb19fdaafbfb09066c30f6a00ffb0403bf209bf977850e6ca530b8892bc8b325f', '61f14d2887b88248ec4c819744cb17d9a0d1ee6c6e08091588cd1723dcc8876e70ffbb7ed8275a76ec483304a71323851f2ec9132e1e7f9bab3b8a47edae9e68');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusId` int(11) NOT NULL AUTO_INCREMENT,
  `Status` varchar(50) NOT NULL,
  PRIMARY KEY (`StatusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` VALUES(1, 'In Service');
INSERT INTO `status` VALUES(2, 'Damage');
INSERT INTO `status` VALUES(3, 'Missing');
INSERT INTO `status` VALUES(4, 'Out of Service');
INSERT INTO `status` VALUES(5, 'Replacing');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Facility` varchar(30) NOT NULL,
  `Address` longtext NOT NULL,
  `City` varchar(30) NOT NULL,
  `Zip` varchar(10) NOT NULL,
  `State` varchar(30) NOT NULL,
  `Country` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `Lastname` varchar(30) NOT NULL,
  `Contact` bigint(20) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  `LastLogin` datetime NOT NULL,
  `CreatedOn` date NOT NULL,
  `RenewDate` date NOT NULL,
  `Term` int(11) NOT NULL,
  `AlertTerm` int(11) NOT NULL,
  `AlertEmail` varchar(255) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `AdminId` int(11) NOT NULL,
  `PackageId` int(11) NOT NULL DEFAULT '1',
  `Switch` tinyint(4) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'ABC', 'Mumbai', 'Mumbai', '123456', 'Maharashtra', 'India', 'admin@admin.com', 'NA', 'Admin', 'Panel', 1234567890, 1, '2014-08-09 12:19:50', '2014-03-09', '2020-11-09', 2, 2, 'admin@admin.com', 2, 1, 1, 1);
INSERT INTO `users` VALUES(2, 'Radiology', 'Mumnbai', 'Mumbai', '123456', 'Maharashtra', 'India', 'abc123@gmail.com', 'NA', 'ABC', '123', 1234567890, 1, '2014-06-29 12:34:45', '2014-03-02', '2015-03-09', 6, 1, 'hitti.modi@gmail.com', 2, 0, 1, 0);
INSERT INTO `users` VALUES(3, '2', '2', '2', '2', '2', '2', 'abc@gmail.com', 'NA', 'h', 'm', 0, 0, '0000-00-00 00:00:00', '2014-03-09', '2015-03-09', 6, 6, '1', 2, 0, 1, 0);
INSERT INTO `users` VALUES(4, 'dont know', 'chembur', 'manhattan', '400074', 'alaska', 'africa', 'shroffgaurav@hotmail.com', 'NA', 'Gaurav', 'Shroff', 9819968555, 1, '2014-03-10 03:08:46', '2014-03-10', '2014-03-09', 1, 1, 'shroffgaurav@hotmail.com', 2, 0, 1, 0);
INSERT INTO `users` VALUES(5, 'Head of Hospital', 'Kalyan', 'Kalyan', '421301', 'Maharashtra', 'India', 'atnerio@gmail.com', 'NA', 'John', 'Doe', 1234567890, 1, '2014-07-26 09:55:50', '2014-03-18', '2015-03-18', 3, 2, 'atnerio@gmail.com', 2, 0, 1, 0);
INSERT INTO `users` VALUES(6, 'abc', '123, asdb hj', 'Mumbai', '4000001', 'Maharashtra', 'India', 'it@kiranxray.com', 'NA', 'Raju', 'Solanki', 8888888888, 1, '2014-07-24 11:31:05', '2014-03-20', '2015-03-20', 12, 2, 'it@kiranxray.com', 2, 0, 1, 0);
INSERT INTO `users` VALUES(7, 'hjhj', 'hjk', 'Mumbai', '400001', 'Maharashtra', 'India', 'yogesh.malhotra@kiranxray.com', 'NA', 'Yogesh', 'Malhotra', 787878787, 1, '2014-07-04 05:01:29', '2014-07-03', '2015-07-03', 3, 2, 'yogesh.malhotra@kiranxray.com', 2, 0, 1, 0);
INSERT INTO `users` VALUES(8, 'cathlab', 'shdgsh sgahdgsajhd sjhdsjhgdhsa dsghds', 'mumbai', '400080', 'maharashtra', 'india', 'dhaval80shah@gmail.com', 'NA', 'dhaval', 'shah', 9619096190, 1, '2014-07-21 03:37:26', '2014-07-21', '2015-07-21', 2, 2, 'dhaval80shah@gmail.com', 2, 0, 1, 0);
