-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 04:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `sales_report`
--
CREATE DATABASE IF NOT EXISTS `sales_report` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sales_report`;

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `cart_id` int(100) NOT NULL,
  `book_id` int(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `pay_mode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Database: `sales_report`
--
CREATE DATABASE IF NOT EXISTS `sales_report` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sales_report`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `LName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `FName`, `LName`, `Address`, `Email`, `Phone`, `Password`) VALUES
(1, 'Admin', 'Root', '123 Main St, Cityville', 'vioaescode@gmail.com', '1234567890', '$2y$10$bBJwK/t4eee7o.GgsYfkueY74kQ0QOgWCbsPnFRqJPePG3OWdUmQK'),
(2, 'Daniel', 'Clemente', '123 Main St, Malolos', 'mimuraschool@gmail.com', '09763328722', '$2y$10$QfVe7bvcEMex9Dfsez.a..VeFShmQ3sCQ7blqHEw70jy6N8oieBqe');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TrackingNo` varchar(100) NOT NULL,
  `InvoiceNo` varchar(100) NOT NULL,
  `TotalPrice` varchar(100) NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderStatus` varchar(100) NOT NULL,
  `PaymentMode` varchar(100) NOT NULL,
  `CheckoutURL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CustomerID`, `TrackingNo`, `InvoiceNo`, `TotalPrice`, `OrderDate`, `OrderStatus`, `PaymentMode`, `CheckoutURL`) VALUES
(1, 2, 'fBnxnqN', 'INV-285998', '4770', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/fBnxnqN'),
(2, 2, 'BAPnC2Q', 'INV-248780', '345', '2024-12-09', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/BAPnC2Q'),
(3, 2, 'oY9pZNb', 'INV-900348', '1180', '2024-12-06', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/oY9pZNb'),
(4, 2, '3bYqYUG', 'INV-580498', '1540', '2024-11-08', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/3bYqYUG'),
(5, 2, 'NuzSkuq', 'INV-265815', '600', '2024-11-20', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/NuzSkuq'),
(6, 2, 'uCjYJui', 'INV-717010', '240', '2024-11-21', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/uCjYJui'),
(7, 2, 'P7FoUtr', 'INV-616329', '150', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/P7FoUtr'),
(8, 2, 'tSULfqk', 'INV-954206', '1800', '2024-12-23', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/tSULfqk'),
(9, 2, 'suzuiYX', 'INV-905303', '280', '2024-12-19', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/suzuiYX'),
(10, 2, 'NEmFAvc', 'INV-152414', '7840', '2024-10-08', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/NEmFAvc'),
(11, 2, 'KG9WhVj', 'INV-915357', '840', '2024-09-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/KG9WhVj'),
(12, 2, '7s6ZFVv', 'INV-284548', '1265', '2024-08-12', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/7s6ZFVv'),
(13, 2, 'Dcs8uJ4', 'INV-175688', '780', '2024-08-22', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/Dcs8uJ4'),
(14, 2, 'HSknV1v', 'INV-465861', '390', '2023-12-07', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/HSknV1v'),
(15, 2, 'kkRt5B3', 'INV-227555', '1120', '2023-10-17', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/kkRt5B3'),
(16, 2, '1p7GMKP', 'INV-266773', '1365', '2023-08-08', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/1p7GMKP'),
(17, 2, 'o7nJEKL', 'INV-525446', '200', '2023-04-12', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/o7nJEKL'),
(18, 2, 'F7yKK5n', 'INV-260865', '3640', '2023-02-15', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/F7yKK5n'),
(19, 2, 'gqoi1kC', 'INV-487577', '140', '2023-01-17', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/gqoi1kC'),
(20, 2, 'RHGWX3L', 'INV-554733', '560', '2023-03-28', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/RHGWX3L'),
(21, 2, 'j6tH14T', 'INV-134561', '615', '2023-06-13', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/j6tH14T'),
(22, 2, '4LvPjPG', 'INV-116926', '840', '2024-12-09', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/4LvPjPG'),
(23, 2, 'krdN694', 'INV-421356', '280', '2024-11-17', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/krdN694'),
(24, 2, 'obKtZFi', 'INV-679639', '460', '2024-09-10', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/obKtZFi'),
(25, 2, 'dnWjcCA', 'INV-760077', '730', '2024-08-30', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/dnWjcCA'),
(26, 2, 'H9EAyAE', 'INV-761595', '260', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/H9EAyAE'),
(27, 2, '1zwbhjc', 'INV-421085', '880', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/1zwbhjc'),
(28, 2, 'VRbXPxe', 'INV-561658', '1400', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/VRbXPxe'),
(29, 2, 'gaLhJCx', 'INV-930151', '490', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/gaLhJCx'),
(30, 2, 'wX8Xwsm', 'INV-408542', '705', '2024-12-11', 'Pending', 'GCash', 'https://pm.link/org-dadNeZRrsstHiUfYzYf7HzfJ/test/wX8Xwsm');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `ID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `Quantity` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`ID`, `OrderID`, `ProductID`, `Price`, `Quantity`) VALUES
(1, 1, 1, '115', '10'),
(2, 1, 13, '280', '5'),
(3, 1, 15, '280', '7'),
(4, 1, 2, '130', '2'),
(5, 2, 1, '115', '3'),
(6, 3, 2, '130', '6'),
(7, 3, 4, '100', '4'),
(8, 4, 8, '220', '7'),
(9, 5, 5, '150', '4'),
(10, 6, 3, '120', '2'),
(11, 7, 5, '150', '1'),
(12, 8, 8, '220', '5'),
(13, 8, 7, '140', '5'),
(14, 9, 10, '280', '1'),
(15, 10, 11, '280', '4'),
(16, 10, 12, '280', '4'),
(17, 10, 13, '280', '5'),
(18, 10, 14, '280', '5'),
(19, 10, 15, '280', '10'),
(20, 11, 16, '280', '3'),
(21, 12, 1, '115', '11'),
(22, 13, 2, '130', '6'),
(23, 14, 5, '150', '1'),
(24, 14, 7, '140', '1'),
(25, 14, 4, '100', '1'),
(26, 15, 10, '280', '1'),
(27, 15, 11, '280', '1'),
(28, 15, 12, '280', '1'),
(29, 15, 13, '280', '1'),
(30, 16, 8, '220', '3'),
(31, 16, 9, '235', '3'),
(32, 17, 4, '100', '2'),
(33, 18, 16, '280', '1'),
(34, 18, 15, '280', '12'),
(35, 19, 7, '140', '1'),
(36, 20, 11, '280', '2'),
(37, 21, 1, '115', '1'),
(38, 21, 3, '120', '1'),
(39, 21, 2, '130', '1'),
(40, 21, 4, '100', '1'),
(41, 21, 5, '150', '1'),
(42, 22, 10, '280', '2'),
(43, 22, 11, '280', '1'),
(44, 23, 13, '280', '1'),
(45, 24, 1, '115', '4'),
(46, 25, 5, '150', '3'),
(47, 25, 15, '280', '1'),
(48, 26, 2, '130', '2'),
(49, 27, 8, '220', '4'),
(50, 28, 12, '280', '1'),
(51, 28, 11, '280', '1'),
(52, 28, 13, '280', '1'),
(53, 28, 14, '280', '1'),
(54, 28, 15, '280', '1'),
(55, 29, 1, '115', '2'),
(56, 29, 2, '130', '2'),
(57, 30, 9, '235', '3');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ProductImage` varchar(255) NOT NULL,
  `CategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Price`, `Quantity`, `ProductImage`, `CategoryID`) VALUES
(1, 'Radish Kimchi', 115, 69, 'assets/img/radishkimchi.jpg', 1),
(2, 'Napa Kimchi', 130, 81, 'assets/img/napa.jpg', 1),
(3, 'Kimchi Sauce', 120, 97, 'assets/img/sauce.jpg', 1),
(4, 'Kimchi Rice', 100, 92, 'assets/img/rice.jpg', 1),
(5, 'Kimchi Ramen', 150, 90, 'assets/img/ramen.jpg', 1),
(6, 'Regular Kimbap', 140, 100, 'assets/img/kimbap.jpg', 2),
(7, 'Kimchi Kimbap', 140, 93, 'assets/img/kimchibap.jpg', 2),
(8, 'Pork', 220, 81, 'assets/img/pork.png', 3),
(9, 'Beef', 235, 94, 'assets/img/beef.jpg', 3),
(10, 'Palabok', 280, 96, 'assets/img/palabok.jpg', 4),
(11, 'Pansit', 280, 91, 'assets/img/pansit.jpg', 4),
(12, 'Malabon', 280, 94, 'assets/img/malabon.jpg', 4),
(13, 'Maja', 280, 87, 'assets/img/maja.jpg', 4),
(14, 'Sapin-sapin', 280, 94, 'assets/img/sapin.jpg', 4),
(15, 'Pichi-pichi', 280, 69, 'assets/img/pichi.jpg', 4),
(16, 'Palitaw', 280, 96, 'assets/img/palitaw.jpg', 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `CategoryDescription` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`CategoryID`, `CategoryName`, `CategoryDescription`) VALUES
(1, 'Kimchi Family', 'Kimchi 4 Life'),
(2, 'Kimbap Family', 'Kimbap Bops'),
(3, 'Homemade Specials', 'Freshly Made'),
(4, 'Filipino', 'Filipino Classics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `fk_orders_customer` (`CustomerID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_order_items_order` (`OrderID`),
  ADD KEY `fk_order_items_product` (`ProductID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `fk_product_category` (`CategoryID`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`CustomerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_items_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_category` FOREIGN KEY (`CategoryID`) REFERENCES `product_category` (`CategoryID`) ON DELETE CASCADE ON UPDATE CASCADE;
--


