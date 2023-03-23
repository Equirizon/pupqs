-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2023 at 04:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `queuing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_uploads`
--

CREATE TABLE `file_uploads` (
  `id` int(30) NOT NULL,
  `file_path` text NOT NULL,
  `date_uploaded` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file_uploads`
--

INSERT INTO `file_uploads` (`id`, `file_path`, `date_uploaded`) VALUES
(19, '1676470380_puplogo.png', '2023-02-15 22:13:22'),
(20, '1676470440_right.png', '2023-02-15 22:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `queue_list`
--

CREATE TABLE `queue_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `student_no` text NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `window_id` int(30) NOT NULL,
  `queue_no` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `created_timestamp` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `department` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0=Inactive,=1 Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `name`, `department`, `status`) VALUES
(62, 'Transaction 1', 'Department 1', 1),
(63, 'Transaction 2', 'Department 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_windows`
--

CREATE TABLE `transaction_windows` (
  `id` int(30) NOT NULL,
  `transaction_id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(100) DEFAULT 1 COMMENT '0=Inactive,1=Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_windows`
--

INSERT INTO `transaction_windows` (`id`, `transaction_id`, `name`, `status`) VALUES
(1, 1, 'Window 1', 1),
(3, 3, 'Window 1', 1),
(4, 4, 'Window 1', 1),
(13, 6, 'Window 1', 1),
(14, 7, 'Window 4', 1),
(15, 2, 'Window 2', 1),
(19, 0, '', 1),
(24, 62, 'Window 1', 1),
(25, 62, 'Window 2', 1),
(26, 63, 'Window 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `window_id` int(30) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 2 COMMENT '1 = Admin, 2= staff',
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `window_id`, `type`, `username`, `password`) VALUES
(1, 'Administrator', 0, 1, 'admin', '0192023a7bbd73250516f069df18b500'),
(14, 'Robin', 24, 2, 'robin', '827ccb0eea8a706c4c34a16891f84e7b'),
(15, 'Brandon', 26, 2, 'brandon', '827ccb0eea8a706c4c34a16891f84e7b'),
(16, 'Sophie', 25, 2, 'sophie', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_uploads`
--
ALTER TABLE `file_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_list`
--
ALTER TABLE `queue_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_windows`
--
ALTER TABLE `transaction_windows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_uploads`
--
ALTER TABLE `file_uploads`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `queue_list`
--
ALTER TABLE `queue_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `transaction_windows`
--
ALTER TABLE `transaction_windows`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
