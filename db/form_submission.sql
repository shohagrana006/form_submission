-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2025 at 10:42 PM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form_submission`
--

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` bigint NOT NULL,
  `amount` int NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `items` varchar(255) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `buyer_ip` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hash_key` varchar(255) NOT NULL,
  `entry_at` date NOT NULL,
  `entry_by` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES
(22, 324, 'sdf', 'sdf', 'a:1:{i:0;s:3:\"sdf\";}', 'asdf@dfg.fg', '127.0.0.1', 'sasdf', 'sdf', '8801729138968', 'ad0fb3d6bb3b6262656bcebb894bb4d229dd238edb45a333ad043dd6fa317d63aeeb17f6842fcddc931e64a11f1142f4e9084bc369f2e92e31b193af60a6d226', '2025-02-03', 34),
(32, 111, 'dsf', 'sdf', 'a:1:{i:0;s:4:\"sadf\";}', 'shohagrana006@gmail.com', '::1', 'sdf', 'Dhaka', '8801768828992', '52c021fb9c36a17ef449a8f1ace926de27c9aea494571442b86c37ee5eb19b3abe1d032c4bbde4c8cd3e2bee3e9e51fc1db58ff9fae7dc790bf294bb391718f2', '2025-02-04', 345),
(33, 333, 'sdfsd', 'sdfaf', 'a:1:{i:0;s:4:\"sdfa\";}', 'shohagrana006@gmail.com', '::1', 'asdfasdf', 'Dhaka', '8801768828992', '959f8d19c09b56a5d4157e5657789d99f25fde4885640d8e39cc0c6d3f4bb102fae8cb0b454603980d19b71f7328f1b22113843523202121f821319aa7e97e90', '2025-02-04', 3),
(36, 100, 'Shohag Rana', 'recieptid', 'a:3:{i:0;s:7:\"itemone\";i:1;s:7:\"itemtwo\";i:2;s:9:\"itemthree\";}', 'shohagrana006@gmail.com', '::1', '&&&&  💠 💠', 'Dhaka', '8801768828992', 'b70d0fe13d028951eef95accf30853f5e9951adaf7de927e8d45ec1c501c28f4d7ae5e5b6b26a6c8b62ec52c27963c2f2a60061840b26c0a21724232804bf7af', '2025-02-04', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
