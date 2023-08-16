-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2023 at 10:55 PM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `blockchain`
--

CREATE TABLE `blockchain` (
  `id` int(11) NOT NULL,
  `block_hash` varchar(64) NOT NULL,
  `previous_block_hash` varchar(64) NOT NULL,
  `data` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_hash` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blockchain`
--

INSERT INTO `blockchain` (`id`, `block_hash`, `previous_block_hash`, `data`, `timestamp`, `data_hash`) VALUES
(11, '3988decf5ecc8b7b45e9451f856f6ceb709e4d38e9e89360795328cabf0d1880', '0', 'Akkas Uddin, CSE, 2019, 3.66, 10/10/2000', '2023-08-06 18:36:58', 'cab7e873b91c493ebf2f11686f691b89ff3623c48e322fd1aaebf4d1005ca46a'),
(12, '837ca6972f5bc0760ec40034a11576bcf394403eaf348164965153039f6e3e7d', '3988decf5ecc8b7b45e9451f856f6ceb709e4d38e9e89360795328cabf0d1880', 'Jhora Khatun, CSE, 2018, 3.46, 10/10/1999', '2023-08-06 18:37:56', '3d1ff59f6402557819e88c543fa4c8e621400158eb18aac9b2243c70d2b63ae8'),
(13, '0252f86048b5577e45e78d3ac6ea53510d563255df6fc909496d4b6444367316', '837ca6972f5bc0760ec40034a11576bcf394403eaf348164965153039f6e3e7d', 'Manushik Haldar, CSE, 2017, 3.88, 10/10/2000', '2023-08-06 18:38:49', '44b68b25e7bc61ed7aa34ae7ce1e54827060bd58ff4434e208e77faf9b36d962');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blockchain`
--
ALTER TABLE `blockchain`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blockchain`
--
ALTER TABLE `blockchain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
