-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 21, 2021 at 03:32 AM
-- Server version: 8.0.23
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `animu_weaboo_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `uid` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(4096) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`uid`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$/SPorGV7rBCnQHXXWprL4.EGOHTHhnULvq95hLJy0PDpN0DHMqzmu');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `image`, `price`, `description`) VALUES
(3, 'One Piece Mug', '/uploads/51nqVXTW3qL._AC_SY450_.jpg', 25, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(4, 'Kakashi Body Pillow', '/uploads/HTB1JI3HbEKF3KVjSZFEq6xExFXao.jpg', 129.99, 'For some real Naruto comfy stuff!'),
(5, 'School Days Shirt', '/uploads/Visual-Novel-School-Days-T-Shirts-Multi-style-Long-Sleeve-Anime-Shirts-Sukuru-Deizu-Makoto-Ito.jpg_960x960.jpg', 29.99, 'For some extreme content call Kotonoha!!!'),
(6, 'Death Note Complete Series DVD', '/uploads/718sIDHiYGL._AC_SY445_.jpg', 49.5, 'Light Yagami uwu'),
(7, 'Death Note Notebook', '/uploads/61XfvHq1sjL._AC_UX679_.jpg', 24.99, 'Death Note uwu Ryuuk likes apples'),
(8, 'School Days VN Game', '/uploads/86373.jpg', 139.99, 'Visual Novel School Days hihi Makoto is evil!!!');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `uid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
