-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 02:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contacts_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `company` varchar(200) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `is_blocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `user_id`, `name`, `phone`, `email`, `company`, `notes`, `is_blocked`) VALUES
(1, 1, 'Nguyễn Minh Dũng', '0123456789', 'nguyen.minh.dung@example.com', 'ABC Company', '', 0),
(2, 1, 'Lê Thị Phương Hà', '0987654321', 'le.thi.phuong.ha@example.com', 'DEF Corporation', '', 1),
(3, 2, 'Trần Đức Hoàng', '0123456789', 'tran.duc.hoang@example.com', 'XYZ Ltd.', '', 0),
(4, 2, 'Phạm Văn Thành', '0987654321', 'pham.van.thanh@example.com', 'MNO Inc.', '', 0),
(9, 1, 'Trần Thị Hương', '0123456780', 'tran.thi.huong@example.com', 'HCM Tech', NULL, 0),
(10, 2, 'Nguyễn Văn Tuấn', '0987654320', 'nguyen.van.tuan@example.com', 'ABC Corporation', NULL, 0),
(11, 1, 'Lê Đức Anh', '0123456790', 'le.duc.anh@example.com', 'XYZ Solutions', NULL, 0),
(12, 2, 'Phạm Thị Mai', '0987654333', 'pham.thi.mai@example.com', 'DEF Enterprises', NULL, 0),
(13, 1, 'Vũ Minh Hải', '0123456788', 'vu.minh.hai@example.com', 'SoftwareCo', NULL, 0),
(14, 2, 'Trần Văn Khánh', '0987654322', 'tran.van.khanh@example.com', 'Tech Solutions', NULL, 1),
(15, 1, 'Khánh', '10923899382', 'pk2132002@gmail.com', 'ABC', '', 1),
(16, 1, 'Hello', '121233981', '', '', '', 1),
(17, 1, 'hi', '123', '', '', '', 1),
(19, 1, 'Example', '123792347', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'Hồ', 'Văn An', 'ho.van.an@example.com', 'hashedpassword1'),
(2, 'Lê', 'Thanh Cường', 'le.thanh.cuong@example.com', 'hashedpassword2'),
(15, 'Khánh', 'Phạm', 'kp@gmail.com', '12345678');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `FK_users` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `FK_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
