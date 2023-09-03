-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2023 at 03:15 PM
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
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_list`
--

CREATE TABLE `contact_list` (
  `contact_id` int(11) NOT NULL,
  `contact_owner` int(11) NOT NULL,
  `contact_number` varchar(20) NOT NULL,
  `name` varchar(25) DEFAULT 'new user',
  `img` varchar(255) NOT NULL DEFAULT 'profile.jpg',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_list`
--

INSERT INTO `contact_list` (`contact_id`, `contact_owner`, `contact_number`, `name`, `img`, `date`) VALUES
(2, 1131423536, '01458745968', 'Siam', 'profile.jpg', '2023-09-03 04:28:52'),
(3, 1131423536, '01721208871', 'new user', 'profile.jpg', '2023-09-03 04:29:43'),
(4, 1131423536, '01716746149', 'new user', 'profile.jpg', '2023-09-03 09:56:25'),
(5, 1131423536, '01358965412', 'new user', 'profile.jpg', '2023-09-03 10:00:18'),
(6, 1131423536, '01745527909', 'new user', 'profile.jpg', '2023-09-03 10:01:08'),
(7, 1131423536, '01316746149', 'new user', 'profile.jpg', '2023-09-03 10:01:50'),
(8, 1131423536, '01459687412', 'new user', 'profile.jpg', '2023-09-03 10:07:50');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender` int(255) NOT NULL,
  `receiver` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'unseen',
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender`, `receiver`, `msg`, `status`, `date`) VALUES
(1, 1131423536, 8, 'Hello.', 'unseen', '2023-09-03 11:14:46'),
(2, 1131423536, 7, 'Hi', 'unseen', '2023-09-03 11:19:13'),
(3, 8, 1131423536, 'how are you brother?', 'seen', '2023-09-03 11:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_status` varchar(25) NOT NULL DEFAULT 'unpaid',
  `contact_number` varchar(20) DEFAULT NULL,
  `contact_owner` int(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `payment_status`, `contact_number`, `contact_owner`, `date`) VALUES
(0, 950795655, 'Siam', 'Ahmed', 'siam@gmail.com', '17f4f8466a9b66da98bef908339d21d7', '1693717999hasib.jpg', 'Active now', 'unpaid', NULL, NULL, '2023-09-03 05:13:19'),
(2, 1131423536, 'Md.', 'Rahman', 'hasibkyau.cse@gmail.com', '0dda0ea5fefcfa826d12d1902b8b80ac', '169371407320230721_020901.jpg', 'Active now', 'unpaid', NULL, NULL, '2023-09-03 04:07:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_list`
--
ALTER TABLE `contact_list`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `contact_owner` (`contact_owner`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_list`
--
ALTER TABLE `contact_list`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_list`
--
ALTER TABLE `contact_list`
  ADD CONSTRAINT `contact_list_ibfk_1` FOREIGN KEY (`contact_owner`) REFERENCES `users` (`unique_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
