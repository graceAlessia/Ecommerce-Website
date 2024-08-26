-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cozy_shark`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Kiara', 'kiara@gmail.com', '0302167479431f9d2e7602129d2938a2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(15) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(3, 120.00, 'paid', 1, '9874835682', 'Yangon', 'U Yae Khel', '2024-08-23 18:47:33'),
(4, 220.00, 'delivered', 1, '9874835682', 'Yangon', 'U Yae Khel', '2024-08-23 19:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `product_image`, `user_id`, `order_date`) VALUES
(1, 3, 1, 'Hoodies1', 120.00, 1, 'Hoodies1.jpg', 1, '2024-08-23 18:47:33'),
(2, 4, 5, 'Shirt1', 110.00, 2, 'Shirt1.jpg', 1, '2024-08-23 19:11:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Hoodies 1', 'hoodies', 'warm hoodies', 'Hoodies1.jpg', 'Hoodies2.jpg', 'Hoodies1.jpg', 'Hoodies2.jpg', 120.00, 10, 'white/cream'),
(2, 'Hoodies2', 'shirts', 'warm hoodies', 'Hoodies2.jpg', 'Hoodies1.jpg', 'Hoodies2.jpg', 'Hoodies1.jpg', 120.00, 0, 'cream/white'),
(3, 'Hoodies3', 'hoodies', 'Hoodies3.PNG', 'Hoodies4.PNG', 'Hoodies3.PNG', 'Hoodies4.PNG', 'New designs, simple and cool!', 130.00, 10, 'Maroon, Ivory'),
(4, 'Hoodies4', 'hoodies', 'New designs! Cool and simple!', 'Hoodies4.PNG', 'Hoodies3.PNG', 'Hoodies4.PNG', 'Hoodies3.PNG', 130.00, 10, 'Ivory, Maroon'),
(5, 'Shirt1', 'shirts', 'For any Season!', 'Shirt1.jpg', 'Shirt1.jpg', 'Shirt1.jpg', 'Shirt1.jpg', 110.00, 30, 'Yellow'),
(6, 'Shirt2', 'shirts', 'New released! ', 'Shirt2.jpg', 'Shirt3.jpg', 'Shirt2.jpg', 'Shirt3.jpg', 100.00, 10, 'green, cream '),
(7, 'Shirt3', 'shirts', 'New released!', 'Shirt3.jpg', 'Shirt2.jpg', 'Shirt3.jpg', 'Shirt2.jpg', 100.00, 10, 'cream, green '),
(8, 'Polo Shirt1', 'polo_shirts', 'Good quality fabrics!', 'PoloShirt1.jpg', 'PoloShirt2.jpg', 'PoloShirt3.jpg', 'PoloShirt1.jpg', 90.00, 5, 'Khaki Brown'),
(9, 'Polo Shirt 2 ', 'polo_shirts', 'Good quality fabrics!', 'PoloShirt2.jpg', 'PoloShirt3.jpg', 'PoloShirt1.jpg', 'PoloShirt2.jpg', 90.00, 5, 'Dark Grey'),
(10, 'Polo Shirt 3 ', 'polo_shirts', 'Good quality fabrics!', 'PoloShirt3.jpg', 'PoloShirt1.jpg', 'PoloShirt2.jpg', 'PoloShirt3.jpg', 90.00, 5, 'Brown'),
(12, 'Naomi', 'polo_shirts', 'polo shirts', 'Naomi1.jpg', 'Naomi2.jpg', 'Naomi3.jpg', 'Naomi4.jpg', 100.00, 10, 'brown');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Kiara', 'dev@gmail.com', 'eaeb8c8f1bf9e133759e7e6f1106b614'),
(2, 'Naomi', 'test@gmail.com', '596258e810183f048b691bef0ee10693');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
