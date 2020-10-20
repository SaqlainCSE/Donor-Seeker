-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 07:50 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donor_seeker2`
--

-- --------------------------------------------------------

--
-- Table structure for table `area_or_village_infos`
--

CREATE TABLE `area_or_village_infos` (
  `id` int(8) NOT NULL,
  `sub_district_id` int(8) NOT NULL,
  `Area_or_Village` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area_or_village_infos`
--

INSERT INTO `area_or_village_infos` (`id`, `sub_district_id`, `Area_or_Village`) VALUES
(1, 14, 'Narayankot');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_donor_infos`
--

CREATE TABLE `deleted_donor_infos` (
  `id` int(8) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Blood_Group` varchar(4) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Weight` int(3) NOT NULL,
  `Division` varchar(20) NOT NULL,
  `District` varchar(20) NOT NULL,
  `Sub_District_or_Police_Station` varchar(22) NOT NULL,
  `Village_or_Area` varchar(25) NOT NULL,
  `Details_of_Your_Area` varchar(30) DEFAULT NULL,
  `Phone` varchar(20) NOT NULL,
  `E_mail` varchar(30) NOT NULL,
  `Role` varchar(20) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `deleted_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deleted_donor_infos`
--

INSERT INTO `deleted_donor_infos` (`id`, `First_Name`, `Last_Name`, `Blood_Group`, `Gender`, `Date_of_Birth`, `Weight`, `Division`, `District`, `Sub_District_or_Police_Station`, `Village_or_Area`, `Details_of_Your_Area`, `Phone`, `E_mail`, `Role`, `Password`, `deleted_at`) VALUES
(45, 'Naeemul Islam', 'Mazumder', 'A-', 'Male', '2000-01-01', 51, 'Dhaka', 'Kishoreganj', 'Austagram', 'Rampura', '', '12345678910', 'naim@gmail.com', 'user', 'Mf@073952', '2020-04-11'),
(47, 'Kawsar', 'Hamid', 'AB+', 'Male', '1995-01-01', 78, 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', '', '12345678910', 'kawsar@gmail.com', 'user', 'Mf@073952', '2020-04-11'),
(54, 'Anwar', 'Shah', 'O-', 'Male', '1996-01-01', 62, 'Dhaka', 'Kishoreganj', 'Itna', 'Rampura', '', '12345678910', 'anwar@gmail.com', 'user', 'Mf@073952', '2020-04-11'),
(58, 'Sanjida', 'Moon', 'O-', 'Female', '1998-01-01', 52, 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', '', '01819037065', 'moon@gmail.com', 'user', 'Mf@073952', '2020-04-11'),
(59, 'Naeemul Islam', 'Mazumder', 'A-', 'Male', '2000-01-01', 51, 'Dhaka', 'Kishoreganj', 'Austagram', 'Rampura', '', '12345678910', 'naim@gmail.com', 'user', 'Mf@073952', '2020-04-11'),
(60, 'Naeemul Islam', 'Mazumder', 'A-', 'Male', '2000-01-01', 51, 'Dhaka', 'Kishoreganj', 'Austagram', 'Rampura', '', '12345678910', 'naim@gmail.com', 'user', 'Mf@073952', '2020-04-11');

-- --------------------------------------------------------

--
-- Table structure for table `district_infos`
--

CREATE TABLE `district_infos` (
  `id` int(8) NOT NULL,
  `division_id` int(8) NOT NULL,
  `District` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district_infos`
--

INSERT INTO `district_infos` (`id`, `division_id`, `District`) VALUES
(1, 3, 'Dhaka'),
(2, 3, 'Ghazipur'),
(3, 3, 'Kishoreganj'),
(5, 2, 'Cumilla'),
(8, 2, 'Chottogram'),
(22, 8, 'Rangpur');

-- --------------------------------------------------------

--
-- Table structure for table `division_infos`
--

CREATE TABLE `division_infos` (
  `id` int(8) NOT NULL,
  `Division` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division_infos`
--

INSERT INTO `division_infos` (`id`, `Division`) VALUES
(1, 'Borishal'),
(2, 'Chottogram'),
(3, 'Dhaka'),
(4, 'Khulna'),
(5, 'Moymonsingho'),
(6, 'Rajshahi'),
(8, 'Rangpur'),
(7, 'Sylhet');

-- --------------------------------------------------------

--
-- Table structure for table `donation_infos`
--

CREATE TABLE `donation_infos` (
  `post_id` int(8) NOT NULL,
  `donor_id` int(8) NOT NULL,
  `Last_donate` date NOT NULL,
  `donee_location` varchar(40) NOT NULL,
  `donee_name` varchar(20) NOT NULL,
  `donee_contact` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donation_infos`
--

INSERT INTO `donation_infos` (`post_id`, `donor_id`, `Last_donate`, `donee_location`, `donee_name`, `donee_contact`) VALUES
(1, 41, '2020-02-05', 'Dhaka , Farazy Hospital', 'Nazir', '01843484950'),
(2, 42, '2019-09-05', 'Dhaka ,Square Hospital', 'Akram', '01683073952'),
(3, 43, '2019-12-07', 'Dhaka,Kishoregonj', 'Sazid', '12345678910'),
(4, 45, '2019-07-01', 'Square Hospital', 'Lokman', '01521123654'),
(5, 44, '2019-04-04', 'Dhaka, Green Hospital', 'Marzan', '12345678910'),
(6, 46, '2020-01-01', 'Dhaka , Farazy Hospital', 'Masum', '12345678910'),
(7, 48, '2020-02-26', 'Dhaka , Farazy Hospital', 'Masum', '12345678910'),
(8, 50, '2019-03-31', 'Dhaka,Kishoregonj', 'Motkafazzak', '12345678910'),
(9, 47, '2020-01-01', 'Dhaka ,Square Hospital', 'Masum', '01843484950'),
(10, 49, '2019-08-08', 'Dhaka, Green Hospital', 'Sakil', '12345678910'),
(11, 51, '2019-04-03', 'Dhaka , Farazy Hospital', 'Masum', '01843484950'),
(12, 53, '2020-01-30', 'Dhaka,Kishoregonj', 'Mahfuz', '01683073952'),
(13, 52, '2020-02-04', 'Dhaka , Farazy Hospital', 'Masum', '01843484950'),
(15, 54, '2020-02-14', 'Dhaka , Farazy Hospital', 'Masum', '01843484950'),
(73, 55, '2020-04-16', 'HR Hospital', 'Rony', '01819037065'),
(73, 55, '2020-04-16', 'HR Hospital', 'Rony', '01819037065'),
(74, 55, '2020-04-14', 'HR Hospital', 'Rony', '01819037065'),
(72, 55, '2020-04-29', 'HR Hospital', 'Rony', '01819037065'),
(73, 41, '2020-04-16', 'HR Hospital', 'Rony', '01819037065');

-- --------------------------------------------------------

--
-- Table structure for table `donor_confirmation`
--

CREATE TABLE `donor_confirmation` (
  `post_id` int(8) NOT NULL,
  `donor_id` int(8) NOT NULL,
  `status` varchar(10) NOT NULL,
  `seeker_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donor_infos`
--

CREATE TABLE `donor_infos` (
  `id` int(8) NOT NULL,
  `First_Name` varchar(20) NOT NULL,
  `Last_Name` varchar(20) NOT NULL,
  `Blood_Group` varchar(4) NOT NULL,
  `Gender` varchar(7) NOT NULL,
  `Date_of_Birth` date NOT NULL,
  `Weight` int(3) NOT NULL,
  `Division` varchar(20) NOT NULL,
  `District` varchar(20) NOT NULL,
  `Sub_District_or_Police_Station` varchar(22) NOT NULL,
  `Village_or_Area` varchar(25) NOT NULL,
  `Details_of_Your_Area` varchar(30) DEFAULT NULL,
  `Phone` varchar(20) NOT NULL,
  `E_mail` varchar(30) NOT NULL,
  `Role` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `status` varchar(8) NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor_infos`
--

INSERT INTO `donor_infos` (`id`, `First_Name`, `Last_Name`, `Blood_Group`, `Gender`, `Date_of_Birth`, `Weight`, `Division`, `District`, `Sub_District_or_Police_Station`, `Village_or_Area`, `Details_of_Your_Area`, `Phone`, `E_mail`, `Role`, `Password`, `status`, `deleted_at`) VALUES
(41, 'Hasan', 'Emon', 'A+', 'Male', '1999-01-01', 68, 'Dhaka', 'Dhaka', 'Adabor', '', '', '12345678901', 'emon@gmail.com', 'admin', 'Mf@073952', ' active', '2020-04-12'),
(42, 'Riyadul', 'Islam', 'A+', 'Male', '1993-01-01', 70, 'Dhaka', 'Dhaka', 'Uttar Khan', '', '', '12345678910', 'faisalbdc15@gmail.com', 'admin', 'Mazumder@8886', 'deleted', '2020-04-12'),
(44, 'Mahfuz', 'Fahim', 'A+', 'Male', '1998-01-01', 62, 'Dhaka', 'Dhaka', 'Katiadi', 'Rampura', '', '01683073952', 'mahfuz8886@gmail.com', 'admin', 'Mf@073952', 'active', '2020-04-12'),
(48, 'Rakibul', 'Alam', 'B-', 'Male', '1997-01-01', 55, 'Dhaka', 'Kishoreganj', 'Austagram', 'Rampura', '', '01234567901', 'rakib@gmail.com', 'admin', 'Mf@073952', 'deleted', '2020-04-12'),
(49, 'Saqline', 'Mustaq', 'AB+', 'Male', '1996-01-01', 69, 'Dhaka', 'Kishoreganj', 'Itna', 'Rampura', '', '12345678910', 'saqline@gmail.com', 'admin', 'Mf@073952', 'active', '2020-04-12'),
(50, 'Mizan', 'Mishu', 'B-', 'Male', '1994-01-01', 53, 'Dhaka', 'Dhaka', 'Uttar Khan', 'Uttara', '', '12345678910', 'mizan@gmail.com', 'user', 'Mf@073952', 'deleted', '2020-04-12'),
(51, 'ABC', 'Rony', 'AB-', 'Male', '1995-01-01', 62, 'Dhaka', 'Kishoreganj', 'Katiadi', 'Rampura', '', '12345678910', 'abc@gmail.com', 'user', 'Mf@073952', 'active', '2020-04-12'),
(55, 'Mofazaal', 'Hossain', 'O+', 'Male', '1995-01-01', 80, 'Dhaka', 'Dhaka', 'Uttara', '', '', '12345678910', 'mota@gmail.com', 'user', 'Mf@073952', 'active', '2020-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `donor_seeker_post`
--

CREATE TABLE `donor_seeker_post` (
  `id` int(8) NOT NULL,
  `seeker_id` int(8) NOT NULL,
  `blood_group` varchar(5) NOT NULL,
  `division` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `sub_district_or_police_station` varchar(20) NOT NULL,
  `village_or_area` varchar(20) NOT NULL,
  `details_of_your_area` varchar(40) DEFAULT NULL,
  `donee_name` varchar(25) NOT NULL,
  `donee_contact` varchar(20) NOT NULL,
  `donee_mail` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) NOT NULL,
  `how_much_needed` int(8) NOT NULL,
  `status` varchar(10) NOT NULL,
  `post_at` int(30) NOT NULL,
  `bag` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor_seeker_post`
--

INSERT INTO `donor_seeker_post` (`id`, `seeker_id`, `blood_group`, `division`, `district`, `sub_district_or_police_station`, `village_or_area`, `details_of_your_area`, `donee_name`, `donee_contact`, `donee_mail`, `date`, `time`, `how_much_needed`, `status`, `post_at`, `bag`) VALUES
(1, 41, 'B+', 'Dhaka', 'Kishoreganj', 'Katiadi', 'Rampura', 'Farazy Hospital', 'Maksud', '01743484950', 'mahfuz@8886@gmail.com', '2020-03-22', '12:00:00.000000', 1, 'die', 0, 0),
(2, 41, 'B+', 'Dhaka', 'Dhaka', 'Rampura', 'Rampura', 'Farazy Hospital', 'Masum', '01843484950', 'mahfuz@8886@gmail.com', '2020-03-25', '00:00:10.000000', 2, 'die', 0, 0),
(3, 41, 'B+', 'Dhaka', 'Kishoreganj', 'Katiadi', 'Rampura', 'Farazy Hospital', 'Asfaq', '01743484952', 'mahfuz8886@gmail.com', '2020-02-04', '12:00:00.000000', 5, 'die', 0, 0),
(4, 41, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', 'United Hospital', 'Zamil', '123456789009', 'mam@gmail.com', '2020-02-08', '12:56:00.000000', 4, 'die', 0, 0),
(5, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'United Hospital', 'Saqline', '01683073952', 'mam@gmail.com', '2020-03-28', '12:30:00.000000', 5, 'die', 0, 0),
(6, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'United Hospital', 'Saqline', '01683073952', 'mam@gmail.com', '2020-03-28', '12:30:00.000000', 5, 'die', 0, 0),
(7, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'United Hospital', 'Saqline', '01683073952', 'mam@gmail.com', '2020-03-28', '12:30:00.000000', 5, 'die', 0, 0),
(8, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'United Hospital', 'Akash', '01819037065', 'mota@gmail.com', '2020-03-28', '12:23:00.000000', 5, 'die', 0, 0),
(9, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'United Hospital', 'Akash', '01819037065', 'mota@gmail.com', '2020-02-28', '12:22:00.000000', 4, 'die', 0, 0),
(10, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'United Hospital', 'Akash', '01819037065', 'mota@gmail.com', '2020-02-28', '12:33:00.000000', 3, 'die', 0, 0),
(11, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'United Hospital', 'Akash', '01819037065', 'mota@gmail.com', '2020-02-28', '12:33:00.000000', 3, 'die', 0, 0),
(12, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'United Hospital', 'Akash', '01819037065', 'mam@gmail.com', '2020-03-30', '12:34:00.000000', 1, 'die', 0, 0),
(13, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Rampura', 'Janina Hospital', 'Janina', '1234567890987', 'janina@gmail.com', '2020-04-08', '12:00:00.000000', 2, 'die', 0, 0),
(14, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Rampura', 'Janina Hospital', 'Janina', '1234567890987', 'janina@gmail.com', '2020-04-08', '12:00:00.000000', 2, 'die', 0, 0),
(15, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Rampura', 'Janina Hospital', 'Janina', '1234567890987', 'janina@gmail.com', '2020-04-08', '12:00:00.000000', 2, 'die', 0, 0),
(16, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Rampura', 'Janina Hospital', 'Janina', '1234567890987', 'janina@gmail.com', '2020-04-08', '12:00:00.000000', 2, 'die', 0, 0),
(17, 41, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', 'Janina Hospital', 'Janina', '123456789000', 'janina@gmail.com', '2020-04-12', '12:40:00.000000', 55, 'die', 0, 0),
(18, 41, 'A-', 'Dhaka', 'Dhaka', 'Adabor', 'Uttara', 'Janina Hospital', 'Janina', '123456789000', 'janina@gmail.com', '2020-04-12', '00:40:00.000000', 55, 'die', 0, 0),
(19, 41, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', 'asd', 'Akash', '12345678900', 'emon@gmail.com', '2020-12-28', '16:30:00.000000', 3, 'die', 1585781696, 0),
(20, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Uttara', 'sdfg', 'Akash', '12345678900', 'mota@gmail.com', '2020-03-30', '17:00:00.000000', 4, 'die', 1585781744, 0),
(21, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Rampura', 'Janina Hospital', 'Janina', '12345678900', 'janina@gmail.com', '2020-04-07', '13:00:00.000000', 2, 'die', 1585831732, 0),
(22, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Rampura', 'Janina Hospital', 'Janina', '12345678900', 'janina@gmail.com', '2020-04-14', '13:00:00.000000', 2, 'die', 1585831830, 0),
(23, 41, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', 'Janina Hospital', 'Janina', '12345678900', 'janina@gmail.com', '2020-04-27', '13:00:00.000000', 1, 'die', 1585832047, 0),
(24, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'Janina Hospital', 'Janina', '12345678900', 'janina@gmail.com', '2020-04-27', '13:00:00.000000', 1, 'die', 1585832077, 0),
(25, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'Janina Hospital', 'Janina', '12345678900', 'janina@gmail.com', '2020-04-07', '13:00:00.000000', -5, 'die', 1585832230, 0),
(26, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'Janina Hospital', 'Janina', '12345678900', 'janina@gmail.com', '2020-04-07', '13:00:00.000000', 39, 'die', 1585832256, 0),
(27, 55, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-09', '12:00:00.000000', 3, 'die', 1586121397, 0),
(28, 55, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Rampura', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-14', '14:00:00.000000', 4, 'die', 1586121679, 0),
(29, 55, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-08', '16:40:00.000000', 3, 'die', 1586121789, 0),
(30, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-08', '16:40:00.000000', 3, 'die', 1586122006, 0),
(31, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-08', '16:40:00.000000', 3, 'die', 1586122199, 0),
(32, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttar Khan', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-08', '16:40:00.000000', 3, 'die', 1586122233, 0),
(33, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '17:55:00.000000', 5, 'die', 1586122302, 0),
(34, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-22', '18:00:00.000000', 6, 'die', 1586122369, 0),
(35, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '20:00:00.000000', 5, 'die', 1586122883, 0),
(36, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-14', '21:00:00.000000', 5, 'die', 1586123040, 0),
(37, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', '', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-14', '21:00:00.000000', 8, 'die', 1586123338, 0),
(38, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '21:00:00.000000', 8, 'die', 1586123556, 0),
(39, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-27', '16:00:00.000000', 6, 'die', 1586123676, 0),
(40, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', '', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '12:00:00.000000', 6, 'die', 1586124080, 0),
(41, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '21:00:00.000000', 7, 'die', 1586124252, 0),
(42, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-14', '12:00:00.000000', 5, 'die', 1586127085, 0),
(43, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586128166, 0),
(44, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'rony@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586130462, 0),
(45, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-14', '16:00:00.000000', 1, 'die', 1586131078, 0),
(46, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 0, 'die', 1586135111, 0),
(47, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '22:00:00.000000', 4, 'die', 1586169917, 4),
(48, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-29', '12:00:00.000000', 4, 'die', 1586176839, 4),
(49, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 4, 'die', 1586178434, 4),
(50, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-22', '20:00:00.000000', 5, 'die', 1586182674, 5),
(51, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 6, 'die', 1586182956, 6),
(52, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '16:00:00.000000', 5, 'die', 1586185798, 5),
(53, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 4, 'die', 1586186087, 4),
(54, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586186380, 5),
(55, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 4, 'die', 1586186474, 4),
(56, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-14', '12:00:00.000000', 6, 'die', 1586186740, 6),
(57, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586189469, 5),
(58, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '14:00:00.000000', 4, 'die', 1586189944, 4),
(59, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 4, 'die', 1586190106, 4),
(60, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 6, 'die', 1586190240, 6),
(61, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', '', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-16', '14:22:00.000000', 5, 'die', 1586190357, 5),
(62, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-16', '14:22:00.000000', 5, 'die', 1586190384, 5),
(63, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', '', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 4, 'die', 1586190657, 4),
(64, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 4, 'die', 1586190685, 4),
(65, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-08', '12:00:00.000000', 5, 'die', 1586190965, 5),
(66, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-10', '12:00:00.000000', 5, 'die', 1586191174, 5),
(67, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586198667, 5),
(68, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 3, 'die', 1586199021, 3),
(69, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 3, 'die', 1586199256, 3),
(70, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-14', '12:00:00.000000', 6, 'die', 1586199517, 6),
(71, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 3, 'die', 1586199775, 3),
(72, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-29', '12:00:00.000000', 3, 'die', 1586200017, 1),
(73, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Rampura', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-16', '12:00:00.000000', 2, 'die', 1586206505, 0),
(74, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Rony', '01819037065', 'faisalbdc15@gmail.com', '2020-04-14', '21:00:00.000000', 5, 'die', 1586207952, 4),
(75, 55, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'Uttara', 'HR Hospital', 'Mahfuz', '01819037065', 'mahfuz8886@gmail.com', '2020-04-07', '12:00:00.000000', 5, 'die', 1586426172, 5),
(76, 41, 'A+', 'Dhaka', 'Dhaka', 'Adabor', 'value', 'HR Hospital', 'Mahfuz', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586471257, 5),
(77, 41, 'A+', 'Dhaka', 'Dhaka', 'Uttara', 'value', 'HR Hospital', 'Mahfuz', '01819037065', 'faisalbdc15@gmail.com', '2020-04-15', '12:00:00.000000', 5, 'die', 1586471353, 5),
(78, 41, 'B+', 'Dhaka', 'Dhaka', 'Uttara', 'value', 'HR Hospital', 'Mahfuz', '01819037065', 'faisalbdc15@gmail.com', '2020-04-20', '12:00:00.000000', 4, 'die', 1586471484, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reset_paasword`
--

CREATE TABLE `reset_paasword` (
  `id` int(11) NOT NULL,
  `request_mail` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `reset_expire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reset_paasword`
--

INSERT INTO `reset_paasword` (`id`, `request_mail`, `selector`, `token`, `reset_expire`) VALUES
(4, 'emon@gmail.com', '2e7196bfe01bf1c2', '$2y$10$hEt5G9a8Os/.4.3Es0oxy.Ry1dGbZy.Rml9ADsTbrwBLBz3uUtopu', '1585596169'),
(6, 'mota@gmail.com', 'dac2ed570b7efdb2', '$2y$10$I5UNJcaMmyxlgL/RcQ8nm.QGV8b5NBYj0f838KJslwh2Noi0TxPE6', '1585757095'),
(19, 'faisalbdc15@gmail.com', '7a3d7e6b0a8a0b4e', '$2y$10$w9jIOyDh0hpo866vgHaLf.NUBQVtsq0UaVJ7h2KKlgTajmoenYcci', '1586113376');

-- --------------------------------------------------------

--
-- Table structure for table `sub_district_infos`
--

CREATE TABLE `sub_district_infos` (
  `id` int(8) NOT NULL,
  `district_id` int(8) NOT NULL,
  `Sub_District_or_Police_Station` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_district_infos`
--

INSERT INTO `sub_district_infos` (`id`, `district_id`, `Sub_District_or_Police_Station`) VALUES
(1, 1, 'Adabor'),
(2, 1, 'Uttar Khan'),
(7, 1, 'Uttara'),
(8, 1, 'Kadamtali'),
(9, 3, 'Austagram'),
(10, 3, 'Itna'),
(11, 3, 'Katiadi'),
(12, 3, 'Karimganj'),
(13, 1, 'Rampura'),
(14, 5, 'Nangolkot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area_or_village_infos`
--
ALTER TABLE `area_or_village_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Area_or_Village` (`Area_or_Village`),
  ADD KEY `sub_district_id` (`sub_district_id`);

--
-- Indexes for table `deleted_donor_infos`
--
ALTER TABLE `deleted_donor_infos`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `district_infos`
--
ALTER TABLE `district_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `District` (`District`),
  ADD UNIQUE KEY `District_2` (`District`),
  ADD KEY `district_infos` (`division_id`);

--
-- Indexes for table `division_infos`
--
ALTER TABLE `division_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Division` (`Division`);

--
-- Indexes for table `donation_infos`
--
ALTER TABLE `donation_infos`
  ADD KEY `post_id` (`post_id`),
  ADD KEY `donor_id` (`donor_id`);

--
-- Indexes for table `donor_infos`
--
ALTER TABLE `donor_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `E-mail` (`E_mail`);

--
-- Indexes for table `donor_seeker_post`
--
ALTER TABLE `donor_seeker_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seeker_id` (`seeker_id`);

--
-- Indexes for table `reset_paasword`
--
ALTER TABLE `reset_paasword`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_district_infos`
--
ALTER TABLE `sub_district_infos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Sub_District_or_Police_Station` (`Sub_District_or_Police_Station`),
  ADD KEY `district_id` (`district_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area_or_village_infos`
--
ALTER TABLE `area_or_village_infos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district_infos`
--
ALTER TABLE `district_infos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `division_infos`
--
ALTER TABLE `division_infos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donor_infos`
--
ALTER TABLE `donor_infos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `donor_seeker_post`
--
ALTER TABLE `donor_seeker_post`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `reset_paasword`
--
ALTER TABLE `reset_paasword`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sub_district_infos`
--
ALTER TABLE `sub_district_infos`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area_or_village_infos`
--
ALTER TABLE `area_or_village_infos`
  ADD CONSTRAINT `area_or_village_infos_ibfk_1` FOREIGN KEY (`sub_district_id`) REFERENCES `sub_district_infos` (`id`);

--
-- Constraints for table `district_infos`
--
ALTER TABLE `district_infos`
  ADD CONSTRAINT `district_infos` FOREIGN KEY (`division_id`) REFERENCES `division_infos` (`id`);

--
-- Constraints for table `donor_seeker_post`
--
ALTER TABLE `donor_seeker_post`
  ADD CONSTRAINT `donor_seeker_post_ibfk_1` FOREIGN KEY (`seeker_id`) REFERENCES `donor_infos` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `sub_district_infos`
--
ALTER TABLE `sub_district_infos`
  ADD CONSTRAINT `sub_district_infos_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district_infos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
