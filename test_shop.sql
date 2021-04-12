-- phpMyAdmin SQL Dump
-- version 5.0.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 12, 2021 at 08:08 PM
-- Server version: 10.3.22-MariaDB-1:10.3.22+maria~bionic
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `admin_role` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `last_name`, `first_name`, `phone`, `email`, `password`, `city`, `admin_role`) VALUES
(2, 'Лендєл', 'Ольга', '+380501111111', 'admin@example.com', '202cb962ac59075b964b07152d234b70', 'Mukachevo', 1),
(13, 'Murff', 'Donald', '+443125911482', 'murf@microsoft.com', '202cb962ac59075b964b07152d234b70', 'Chicago', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` smallint(2) DEFAULT NULL,
  `admin_access` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `path`, `active`, `sort_order`, `admin_access`) VALUES
(1, 'Товари', '/product/list', 1, 1, 0),
(2, 'Клієнти', '/customer/list', 1, 2, 1),
(3, 'Тест', '/test/test', 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `sku` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `qty` decimal(12,3) NOT NULL DEFAULT 0.000,
  `description` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `price`, `qty`, `description`) VALUES
(1, 't00001', 'Google Pixel 3 XL ', '16500.00', '120.000', 'Диагональ экрана: 6.3&quot;; Разрешение экрана: 2960x1440; Камера: 12.2 Мп; Количество ядер: 8; Оперативная память: 4 Гб; Стандарт защиты: IP68;'),
(4, 't00003', 'Samsung Galaxy S10e', '18000.00', '100.000', '            Диагональ экрана: 5.8&quot;; Разрешение экрана: 2280x1080; Камера: 12 Мп + 16 Мп; Количество ядер: 8; Оперативная память: 6 Гб; Стандарт защиты: IP68;            '),
(13, 't00002', 'Apple iPhone 11 Pro Max', '36000.00', '1000.000', 'Диагональ экрана: 6.5&quot;;\r\nРазрешение экрана: 2688х1242; \r\nКамера: 12 Мп + 12 Мп + 12 Мп; \r\nКоличество ядер: 6; \r\nОперативная память: 4 Гб;\r\nСтандарт защиты: IP68;                                                               '),
(14, 't00004', 'Apple iPhone 11 64GB Red', '23000.00', '1000.000', '             Диагональ экрана: 6.1&quot;; Разрешение экрана: 1792x828; Камера: 12 Мп + 12 Мп; Количество ядер: 6; Оперативная память: 4 Гб; Стандарт защиты: IP68;\r\n                           ');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`order_id`, `customer_id`, `datetime`) VALUES
(1, 2, '2019-10-23 21:32:28'),
(2, 2, '2019-10-23 21:37:08');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orderitem`
--

CREATE TABLE `sales_orderitem` (
  `orderitem_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` decimal(12,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales_orderitem`
--

INSERT INTO `sales_orderitem` (`orderitem_id`, `order_id`, `product_id`, `qty`) VALUES
(1, 1, 1, '2.000'),
(4, 2, 4, '4.000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_ORDER_CUSTOMER` (`customer_id`);

--
-- Indexes for table `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD PRIMARY KEY (`orderitem_id`),
  ADD KEY `FK_ORDERITEM_ORDER` (`order_id`),
  ADD KEY `FK_ORDERITEM_PRODUCT` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  MODIFY `orderitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD CONSTRAINT `FK_ORDER_CUSTOMER` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_orderitem`
--
ALTER TABLE `sales_orderitem`
  ADD CONSTRAINT `FK_ORDERITEM_ORDER` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ORDERITEM_PRODUCT` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

