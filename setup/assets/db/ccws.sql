-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 11:22 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ccws`
--

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `bed_id` int(10) NOT NULL,
  `loc_id` int(10) NOT NULL,
  `guest_id` int(10) DEFAULT NULL,
  `bed_created` datetime NOT NULL DEFAULT current_timestamp(),
  `bed_created_by` int(10) DEFAULT NULL,
  `bed_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bed_modified_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(10) NOT NULL,
  `usr_id` int(10) DEFAULT NULL,
  `guest_birthdate` date DEFAULT NULL,
  `guest_pet` tinyint(1) NOT NULL DEFAULT 0,
  `guest_family_group` tinyint(1) NOT NULL DEFAULT 0,
  `guest_created` datetime NOT NULL DEFAULT current_timestamp(),
  `guest_created_by` int(10) DEFAULT NULL,
  `guest_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `guest_modified_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `usr_id`, `guest_birthdate`, `guest_pet`, `guest_family_group`, `guest_created`, `guest_created_by`, `guest_modified`, `guest_modified_by`) VALUES
(1, 7, '1992-11-03', 1, 0, '2022-11-16 00:03:09', NULL, '2022-11-16 00:03:09', NULL),
(2, 8, '2013-11-01', 0, 0, '2022-11-16 00:03:09', NULL, '2022-11-16 00:03:09', NULL),
(3, 9, '1984-08-01', 1, 1, '2022-11-16 00:03:09', NULL, '2022-11-16 00:03:09', NULL),
(4, 10, '2013-11-11', 0, 0, '2022-11-16 00:03:09', NULL, '2022-11-16 00:03:09', NULL),
(5, 11, '1993-03-05', 0, 0, '2022-11-16 00:03:09', NULL, '2022-11-16 00:03:09', NULL),
(6, 13, '2011-02-17', 0, 0, '2022-11-16 01:57:53', NULL, '2022-11-16 01:57:53', NULL),
(7, 14, '1990-01-01', 0, 0, '2022-11-16 03:49:31', NULL, '2022-11-16 03:49:31', NULL),
(8, 15, '2018-10-09', 0, 0, '2022-11-16 20:14:40', NULL, '2022-11-16 20:14:40', NULL),
(13, 20, '1972-03-31', 0, 0, '2022-11-19 19:15:08', NULL, '2022-11-19 19:15:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `guest_status`
--

CREATE TABLE `guest_status` (
  `gs_id` int(11) NOT NULL,
  `gs_op_date` date NOT NULL,
  `org_id` int(11) NOT NULL,
  `loc_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `gs_checkin` datetime NOT NULL,
  `gs_checkout` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guest_status`
--

INSERT INTO `guest_status` (`gs_id`, `gs_op_date`, `org_id`, `loc_id`, `usr_id`, `gs_checkin`, `gs_checkout`) VALUES
(1, '2022-11-15', 1, 45, 7, '2022-11-16 11:48:30', '2022-11-17 20:18:25'),
(2, '2022-11-15', 1, 45, 8, '2022-11-16 11:48:31', '2022-11-20 09:17:16'),
(3, '2022-11-15', 1, 45, 9, '2022-11-16 11:48:31', '2022-11-20 10:23:06'),
(4, '2022-11-15', 1, 45, 10, '2022-11-16 11:48:31', '2022-11-16 11:48:31'),
(5, '2022-11-15', 1, 45, 11, '2022-11-16 11:48:31', '2022-11-20 10:23:06'),
(6, '2022-11-15', 1, 45, 12, '2022-11-16 11:48:31', '2022-11-20 10:23:06'),
(7, '2022-11-15', 1, 45, 13, '2022-11-16 11:48:31', '2022-11-16 11:48:31'),
(11, '2022-11-15', 1, 45, 20, '2022-11-20 04:26:15', '2022-11-20 09:18:38'),
(21, '2022-11-15', 1, 45, 14, '2022-11-20 07:50:12', '2022-11-20 09:36:17'),
(22, '2022-11-15', 1, 45, 15, '2022-11-20 08:05:00', '2022-11-20 09:17:33'),
(39, '2022-11-20', 1, 45, 7, '2022-11-20 04:20:09', '2022-11-20 04:21:45'),
(40, '2022-11-20', 1, 45, 8, '2022-11-20 04:20:14', '2022-11-20 04:21:45'),
(41, '2022-11-20', 1, 45, 9, '2022-11-20 04:20:28', '2022-11-20 04:21:45'),
(42, '2022-11-20', 1, 45, 10, '2022-11-20 04:20:42', '2022-11-20 04:21:33'),
(43, '2022-11-20', 1, 45, 20, '2022-11-20 04:20:50', '2022-11-20 04:21:45'),
(44, '2022-11-20', 1, 45, 11, '2022-11-20 04:21:04', '2022-11-20 04:21:45'),
(45, '2022-11-20', 1, 45, 15, '2022-11-20 04:21:19', '2022-11-20 04:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loc_id` int(10) NOT NULL,
  `org_id` int(10) NOT NULL,
  `loc_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_address_street` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_address_street_2` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_address_city` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_address_state` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_serves` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loc_capacity` int(10) NOT NULL DEFAULT 0,
  `loc_status` tinyint(1) NOT NULL DEFAULT 0,
  `loc_op_date` date DEFAULT NULL,
  `loc_created` datetime NOT NULL DEFAULT current_timestamp(),
  `loc_created_by` int(10) DEFAULT NULL,
  `loc_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `loc_modified_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `org_id`, `loc_name`, `loc_address_street`, `loc_address_street_2`, `loc_address_city`, `loc_address_state`, `loc_serves`, `loc_capacity`, `loc_status`, `loc_op_date`, `loc_created`, `loc_created_by`, `loc_modified`, `loc_modified_by`) VALUES
(31, 1, 'East Sunshine Church of Christ', '3721 East Sunshine', NULL, 'Springfield', 'MO', 'Men Only', 50, 0, NULL, '2022-10-25 18:28:11', 0, '2022-10-25 18:28:11', 0),
(41, 1, 'Grace United Methodist Church', '', NULL, 'Springfield', 'MO', '', 20, 0, NULL, '2022-10-25 18:30:12', 0, '2022-11-20 03:51:00', 0),
(42, 1, 'Asbury United Methodist', '1500 South Campbell', NULL, 'Springfield', 'MO', 'couples/singles/pets', 35, 0, NULL, '2022-10-25 18:31:09', 0, '2022-10-25 18:31:09', 0),
(44, 1, 'Unity of Springfield', '2214 East Seminole', NULL, 'Springfield', 'MO', 'couples/singles', 22, 0, NULL, '2022-10-25 19:33:00', 0, '2022-11-20 03:18:49', 0),
(45, 1, 'Revive 66 Campground', '3839 West Chestnut Expressway', NULL, 'Springfield', 'MO', 'Couples/singles/pets', 50, 0, NULL, '2022-10-25 19:33:19', 0, '2022-11-20 04:21:45', 0),
(46, 1, 'Sacred Heart Catholic Church', '1609 North Summit Avenue', NULL, 'Springfield', 'MO', 'men only', 20, 0, NULL, '2022-10-25 19:33:19', 0, '2022-10-25 19:33:19', 0),
(47, 1, 'Harbor House', '636 North Boonville', NULL, 'Springfield', 'MO', 'men only', 15, 0, NULL, '2022-10-25 19:33:19', 0, '2022-10-25 19:33:19', 0),
(48, 1, 'Eden Village', NULL, NULL, 'Springfield', 'MO', NULL, 20, 0, NULL, '2022-10-25 19:33:19', 0, '2022-11-16 03:34:01', 0),
(49, 1, 'The Venues', '425 West Walnut Street', NULL, 'Springfield', 'MO', NULL, 20, 0, NULL, '2022-10-25 19:33:19', 0, '2022-11-16 03:34:08', 0),
(50, 1, 'The Connecting Grounds', '4341 W. Chestnut Expressway', NULL, 'Springfield', 'MO', 'Serves family ', 4, 0, NULL, '2022-10-25 19:33:19', 0, '2022-10-25 19:33:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE `organization` (
  `org_id` int(10) NOT NULL,
  `org_name` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `org_created` datetime NOT NULL DEFAULT current_timestamp(),
  `org_created_by` int(10) DEFAULT NULL,
  `org_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `org_modified_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`org_id`, `org_name`, `org_created`, `org_created_by`, `org_modified`, `org_modified_by`) VALUES
(1, 'CCWS', '2022-10-25 17:53:43', 0, '2022-10-25 17:53:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) NOT NULL,
  `usr_id` int(10) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `usr_id` int(10) NOT NULL,
  `org_id` int(10) NOT NULL,
  `usr_username` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_password_hash` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_auth` int(10) NOT NULL,
  `usr_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_fname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_lname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_email_confirm` tinyint(1) DEFAULT NULL,
  `usr_text_confirm` tinyint(1) DEFAULT NULL,
  `usr_profile_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_notes` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `usr_created` datetime NOT NULL DEFAULT current_timestamp(),
  `usr_created_by` int(10) DEFAULT NULL,
  `usr_modified` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usr_modified_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usr_id`, `org_id`, `usr_username`, `usr_password_hash`, `usr_auth`, `usr_email`, `usr_phone`, `usr_fname`, `usr_lname`, `usr_email_confirm`, `usr_text_confirm`, `usr_profile_img`, `usr_notes`, `usr_created`, `usr_created_by`, `usr_modified`, `usr_modified_by`) VALUES
(1, 1, 'admin', NULL, 1, 'nylahtayrogers@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-11-15 23:45:51', NULL, '2022-11-15 23:45:51', NULL),
(7, 1, NULL, NULL, 3, NULL, NULL, 'Janice', 'Longbottom', NULL, NULL, NULL, NULL, '2022-11-15 23:58:39', NULL, '2022-11-15 23:58:39', NULL),
(8, 1, NULL, NULL, 3, NULL, NULL, 'Jimmy', 'Jackson', NULL, NULL, NULL, NULL, '2022-11-15 23:58:39', NULL, '2022-11-15 23:58:39', NULL),
(9, 1, NULL, NULL, 3, NULL, NULL, 'John', 'Doe', NULL, NULL, NULL, NULL, '2022-11-15 23:58:39', NULL, '2022-11-15 23:58:39', NULL),
(10, 1, NULL, NULL, 3, NULL, NULL, 'June', 'Berry', NULL, NULL, NULL, NULL, '2022-11-15 23:58:39', NULL, '2022-11-15 23:58:39', NULL),
(11, 1, NULL, NULL, 3, NULL, NULL, 'Janice', 'Smith', NULL, NULL, NULL, NULL, '2022-11-15 23:58:39', NULL, '2022-11-15 23:58:39', NULL),
(12, 1, NULL, NULL, 3, NULL, NULL, 'Terry', 'Smith', NULL, NULL, NULL, NULL, '2022-11-16 00:26:57', NULL, '2022-11-16 00:26:57', NULL),
(13, 1, NULL, NULL, 3, NULL, NULL, 'Jimmy ', 'Johns', NULL, NULL, NULL, '', '2022-11-16 01:57:53', NULL, '2022-11-16 01:57:53', NULL),
(14, 1, NULL, NULL, 3, NULL, NULL, 'Test', 'Guest', NULL, NULL, NULL, 'This is a test for this user', '2022-11-16 03:49:30', NULL, '2022-11-16 03:49:30', NULL),
(15, 1, NULL, NULL, 3, NULL, NULL, 'Samantha', 'Jane', NULL, NULL, NULL, '', '2022-11-16 20:14:40', NULL, '2022-11-16 20:14:40', NULL),
(20, 1, NULL, NULL, 3, NULL, NULL, 'Someone', 'Special', NULL, NULL, NULL, '', '2022-11-19 19:15:08', NULL, '2022-11-19 19:15:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD UNIQUE KEY `beds_index_2` (`bed_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `guest_id` (`guest_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`),
  ADD UNIQUE KEY `guest_index_5` (`guest_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Indexes for table `guest_status`
--
ALTER TABLE `guest_status`
  ADD PRIMARY KEY (`gs_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `loc_id` (`loc_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id`),
  ADD UNIQUE KEY `location_index_1` (`loc_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`org_id`),
  ADD UNIQUE KEY `organization_index_0` (`org_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_index_4` (`staff_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `users_index_3` (`usr_id`),
  ADD UNIQUE KEY `usr_phone` (`usr_phone`),
  ADD UNIQUE KEY `usr_username` (`usr_username`),
  ADD KEY `org_id` (`org_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `bed_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `guest_status`
--
ALTER TABLE `guest_status`
  MODIFY `gs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `organization`
--
ALTER TABLE `organization`
  MODIFY `org_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_ibfk_1` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`),
  ADD CONSTRAINT `beds_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`);

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE;

--
-- Constraints for table `guest_status`
--
ALTER TABLE `guest_status`
  ADD CONSTRAINT `guest_status_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`),
  ADD CONSTRAINT `guest_status_ibfk_2` FOREIGN KEY (`loc_id`) REFERENCES `location` (`loc_id`),
  ADD CONSTRAINT `guest_status_ibfk_3` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `users` (`usr_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `organization` (`org_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
