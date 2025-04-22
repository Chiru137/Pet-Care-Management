-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2024 at 03:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petcaredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customer_id`, `customer_name`, `address`, `phone`, `password`) VALUES
(1, 'john', '123 Main St', '123-456-7890', 'password1'),
(2, 'Jane Smith', '456 Elm St', '987-654-3210', 'password2'),
(3, 'Michael Johnson', '789 Oak St', '555-555-5555', 'password3'),
(4, 'Sarah Lee', '321 Pine St', '111-222-3333', 'password4'),
(5, 'Chris Wilson', '654 Maple St', '444-444-4444', 'password5'),
(12, 'alllll', 'udddddddddd', '999999999999999', '12345'),
(33, 'sa', 'df', '989898', '12345'),
(65, 'kj', 'kk', '99', '2');

-- --------------------------------------------------------

--
-- Table structure for table `dog_details`
--

CREATE TABLE `dog_details` (
  `dog_id` varchar(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `dog_name` varchar(50) DEFAULT NULL,
  `dog_breed` varchar(50) DEFAULT NULL,
  `dog_age` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dog_details`
--

INSERT INTO `dog_details` (`dog_id`, `customer_id`, `dog_name`, `dog_breed`, `dog_age`, `image`) VALUES
('1', 65, 'w', '1', 1, 'img/blog-1.jpg'),
('12', 12, 'rocky', 'labrodar', 1, 'img/team-2.jpg'),
('d1', 1, 'browniee', 'half', 3, 'img/blog-2.jpg'),
('d2', 2, 'Max', 'Labrador', 2, 'img/lab.jpg'),
('d3', 3, 'Charlie', 'Poodle', 4, 'img/team-3.jpg'),
('d4', 4, 'Lucy', 'German Shepherd', 5, 'img/blog-2.jpg'),
('d5', 5, 'Daisy', 'Bulldog', 3, 'img\\bulldog.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_details`
--

CREATE TABLE `vaccination_details` (
  `vaccination_id` int(11) NOT NULL,
  `vaccination_name` varchar(50) DEFAULT NULL,
  `before_age` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_details`
--

INSERT INTO `vaccination_details` (`vaccination_id`, `vaccination_name`, `before_age`) VALUES
(1, 'Rabies', '3 months'),
(2, 'Distemper', '1.5 months'),
(3, 'Parvo', '1.5 months'),
(4, 'Leptospirosis', '3 months'),
(5, 'Bordetella', '2 months');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination_done`
--

CREATE TABLE `vaccination_done` (
  `dog_id` varchar(50) DEFAULT NULL,
  `vaccination_id` int(11) DEFAULT NULL,
  `vet_id` int(11) DEFAULT NULL,
  `vaccination_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccination_done`
--

INSERT INTO `vaccination_done` (`dog_id`, `vaccination_id`, `vet_id`, `vaccination_date`) VALUES
('d1', 1, 1, '2023-01-15'),
('d1', 2, 2, '2023-02-20'),
('d1', 3, 3, '2023-03-25'),
('d2', 1, 1, '2023-02-10'),
('d2', 2, 2, '2023-03-15'),
('d2', 3, 3, '2023-04-20'),
('d3', 1, 1, '2023-03-12'),
('d3', 2, 2, '2023-04-18'),
('d3', 3, 3, '2023-05-23'),
('d4', 1, 1, '2023-04-25'),
('d4', 2, 2, '2023-05-30'),
('d4', 3, 3, '2023-06-05'),
('d5', 1, 1, '2023-05-01'),
('d5', 2, 2, '2023-06-06'),
('d5', 3, 3, '2023-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `veterinary`
--

CREATE TABLE `veterinary` (
  `vet_id` int(11) NOT NULL,
  `vet_name` varchar(50) DEFAULT NULL,
  `vet_address` varchar(100) DEFAULT NULL,
  `vet_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `veterinary`
--

INSERT INTO `veterinary` (`vet_id`, `vet_name`, `vet_address`, `vet_phone`) VALUES
(1, 'Dr. Smith', '123 Vet St', '555-123-4567'),
(2, 'Dr. Johnson', '456 Pet St', '888-987-6543'),
(3, 'Dr. Lee', '789 Animal St', '333-111-2222'),
(4, 'Dr. Wilson', '321 Dog St', '444-555-6666'),
(5, 'Dr. Brown', '654 Cat St', '777-888-9999'),
(15, 'Ram', 'Puttur', '64948484');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `dog_details`
--
ALTER TABLE `dog_details`
  ADD PRIMARY KEY (`dog_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `vaccination_details`
--
ALTER TABLE `vaccination_details`
  ADD PRIMARY KEY (`vaccination_id`);

--
-- Indexes for table `vaccination_done`
--
ALTER TABLE `vaccination_done`
  ADD KEY `dog_id` (`dog_id`),
  ADD KEY `vaccination_id` (`vaccination_id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- Indexes for table `veterinary`
--
ALTER TABLE `veterinary`
  ADD PRIMARY KEY (`vet_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dog_details`
--
ALTER TABLE `dog_details`
  ADD CONSTRAINT `dog_details_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer_details` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `vaccination_done`
--
ALTER TABLE `vaccination_done`
  ADD CONSTRAINT `vaccination_done_ibfk_1` FOREIGN KEY (`dog_id`) REFERENCES `dog_details` (`dog_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccination_done_ibfk_2` FOREIGN KEY (`vaccination_id`) REFERENCES `vaccination_details` (`vaccination_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vaccination_done_ibfk_3` FOREIGN KEY (`vet_id`) REFERENCES `veterinary` (`vet_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
