-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 02:47 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL,
  `productId` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(7,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `desicription` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `desicription`) VALUES
(1, 'Tipkovnice', 'Sve vrste tipkovnica'),
(2, 'Software', 'Sve vezano za software'),
(3, 'Monitori', 'Povoljne cijene a dobre specifikacije?'),
(4, 'Komponente', 'Ovdje se nalaze sve vrste komponenata');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `items` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` decimal(7,2) UNSIGNED NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `desicription` text,
  `productImg` varchar(100) DEFAULT NULL,
  `price` decimal(7,2) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `categoryId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desicription`, `productImg`, `price`, `quantity`, `categoryId`) VALUES
(1, 'Tipkovnica HAVIT, žična, USB, crna', 'Ugodna i jednostavna za korištenje. Ergonomski dizajn, prilagodljiva visina. Zaštita od slučajnog polijevanja tekućinom. Multimedijane tipke omogućuju brže dosezanje sadržaja: video playback, sound volume control, web, e-mail itd. ', '1544485598_47706-878.jpg', '45.00', 10, 1),
(2, 'Tipkovnica HAVIT, žična, USB, crna', 'Multifunkcionalna tipkovnica s pozadinskim osvjetljenjem. ', '1544485842_47707-878.jpg', '109.00', 5, 1),
(3, 'Microsoft Office Home & Business 2016', 'Programi koji su uključeni: Word, Excel, PowerPoint, OneNotei Outlook', '1544486005_60187-878.jpg', '1949.00', 8, 2),
(4, 'Microsoft Windows Server 2012', '1 licenca', '1544486121_35045-878.jpg', '299.00', 12, 2),
(5, 'Windows 10 Pro', '64 Bit', '1544486235_69146-878.jpg', '1265.00', 9, 2),
(6, 'Monitor AOC 21,5\"', 'Maksimalna rezolucija: 1920×1080, \r\nPanel: MVA, \r\nFrekvencija: 60 Hz,\r\nKontrast: 5000:1, \r\nD-SUB: Da, \r\nDVI: Da, \r\nHDMI: Da,\r\nDisplay Port: Da, \r\nZvučnik: Da', '1544486471_aoc-monitor.png', '1139.00', 7, 3),
(7, 'Procesor Intel Core i3 8300', 'Broj jezgri: 3, \r\nBrzina: 3.7 GHz, \r\nCashe: 8 MB, \r\nGPU Intel UHD Graphics 630, \r\nHladnjak: Da', '1544486727_intel-i3-cpu.jpg', '1629.00', 4, 4),
(8, 'Memorija Kingston PC-12800, 8 GB', 'Vrsta memorije: DDR3, \r\nVeličina memorije: 8 GB, \r\nBrzina memorije (MHz): 1600, \r\nNapon: 1.50V', '1544486927_kingston-mem-8.jpg', '540.00', 4, 4),
(9, 'Grafička kartica GAINWARD GeForce RTX 2070 Phoenix, 8GB', 'Sučelje PCI-E\r\nRadni takt GPU [MHz] 1650\r\nVrsta memorije GDDR6\r\nRadna memorija (RAM) 8 GB\r\nMemorijsko sučelje [bit] 256\r\nD-SUB n/a\r\nHDMI 1\r\nDisplayPort 3\r\nUSB-C 1\r\nDVI n/a\r\nProizvođač čipa nVidia', '1544487086_graficka-8gb.jpg', '5034.00', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `top_products`
--

CREATE TABLE `top_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `desicription` text,
  `price` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `top_products`
--

INSERT INTO `top_products` (`id`, `name`, `desicription`, `price`) VALUES
(1, 'Tipkovnica HAVIT, žična, USB, crna', 'Multifunkcionalna tipkovnica s pozadinskim osvjetljenjem.', 109),
(2, 'Win 10 Pro', '64 Bit', 1265);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gradMjesto` varchar(100) NOT NULL,
  `postanskiBroj` int(11) UNSIGNED DEFAULT NULL,
  `role` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `activated` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `top_products`
--
ALTER TABLE `top_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `top_products`
--
ALTER TABLE `top_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
