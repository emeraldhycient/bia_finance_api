-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 08:07 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biafinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `cardnumber` bigint(255) NOT NULL,
  `cvv` smallint(11) NOT NULL,
  `expirationdate` varchar(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `userid`, `fullname`, `cardnumber`, `cvv`, `expirationdate`, `createdAt`) VALUES
(1, '611fef826167e', 'emmanuel wood', 5110100000000000, 100, 'January/197', '2021-08-20 19:08:02'),
(3, '611ff121df1ce', 'stone wood', 5110100000000000, 100, 'January/197', '2021-08-20 19:14:57'),
(4, '611ff121df1ce', 'stone wood', 4110100000000000, 100, 'January/197', '2021-08-20 19:14:58'),
(5, '611ff121df1ce', 'stone wood', 6510100000000000, 100, 'January/197', '2021-08-20 19:14:58'),
(6, '611ff121df1ce', 'stone wood', 3710100000000000, 100, 'January/197', '2021-08-20 19:14:58'),
(7, '611ff229b8806', 'stone wooxz', 5110100000000000, 100, 'January/197', '2021-08-20 19:19:22'),
(8, '611ff229b8806', 'stone wooxz', 4110100000000000, 100, 'January/197', '2021-08-20 19:19:22'),
(9, '611ff229b8806', 'stone wooxz', 6510100000000000, 100, 'January/197', '2021-08-20 19:19:22'),
(10, '611ff229b8806', 'stone wooxz', 3710100000000000, 100, 'January/197', '2021-08-20 19:19:22'),
(11, '611ff3a0859e1', 'buks josh', 5110100000000000, 100, 'January/197', '2021-08-20 19:25:36'),
(12, '611ff3a0859e1', 'buks josh', 4110100000000000, 100, 'January/197', '2021-08-20 19:25:36'),
(13, '611ff3a0859e1', 'buks josh', 6510100000000000, 100, 'January/197', '2021-08-20 19:25:36'),
(14, '611ff3a0859e1', 'buks josh', 3710100000000000, 100, 'January/197', '2021-08-20 19:25:36'),
(15, '611ff7bdc908d', 'bdle emma', 5110123234567890, 32767, 'January/197', '2021-08-20 19:43:09'),
(16, '611ff7bdc908d', 'bdle emma', 4110123234567890, 32767, 'January/197', '2021-08-20 19:43:09'),
(17, '611ff7bdc908d', 'bdle emma', 6510123234567890, 32767, 'January/197', '2021-08-20 19:43:09'),
(18, '611ff7bdc908d', 'bdle emma', 3710123234567890, 32767, 'January/197', '2021-08-20 19:43:09'),
(19, '611ff82d6a531', 'bdle emma', 5110123234567890, 32767, 'January/197', '2021-08-20 19:45:01'),
(20, '611ff82d6a531', 'bdle emma', 4110123234567890, 32767, 'January/197', '2021-08-20 19:45:01'),
(21, '611ff82d6a531', 'bdle emma', 6510123234567890, 32767, 'January/197', '2021-08-20 19:45:01'),
(22, '611ff82d6a531', 'bdle emma', 3710123234567890, 32767, 'January/197', '2021-08-20 19:45:01'),
(23, '61212dbca5572', 'jabrilsnail', 5110627812838565, 237, 'January/197', '2021-08-21 17:45:49'),
(24, '61212dbca5572', 'jabrilsnail', 4110384996517414, 671, 'January/197', '2021-08-21 17:45:49'),
(25, '61212dbca5572', 'jabrilsnail', 6510398815971617, 778, 'January/197', '2021-08-21 17:45:49'),
(26, '61212dbca5572', 'jabrilsnail', 3710472842076024, 342, 'January/197', '2021-08-21 17:45:49'),
(27, '61212ee3ebaca', 'jabrilsnail', 5110869439904340, 259, '01/1970', '2021-08-21 17:50:44'),
(28, '61212ee3ebaca', 'jabrilsnail', 4110873139344158, 722, '01/1970', '2021-08-21 17:50:44'),
(29, '61212ee3ebaca', 'jabrilsnail', 6510670692317854, 857, '01/1970', '2021-08-21 17:50:44'),
(30, '61212ee3ebaca', 'jabrilsnail', 3710563313553082, 70, '01/1970', '2021-08-21 17:50:44'),
(31, '61212fa7902d0', 'sailjabral', 5110876712398132, 922, '01/1970', '2021-08-21 17:54:00'),
(32, '61212fa7902d0', 'sailjabral', 4110328283403782, 406, '01/1970', '2021-08-21 17:54:00'),
(33, '61212fa7902d0', 'sailjabral', 6510673018700621, 486, '01/1970', '2021-08-21 17:54:00'),
(34, '61212fa7902d0', 'sailjabral', 3710838348759834, 652, '01/1970', '2021-08-21 17:54:01'),
(35, '61212fdf7460a', 'sailjabral', 5110313430679823, 393, '01/1970', '2021-08-21 17:54:55'),
(36, '61212fdf7460a', 'sailjabral', 4110096223464176, 365, '01/1970', '2021-08-21 17:54:56'),
(37, '61212fdf7460a', 'sailjabral', 6510001327695562, 562, '01/1970', '2021-08-21 17:54:57'),
(38, '61212fdf7460a', 'sailjabral', 3710275633745642, 500, '01/1970', '2021-08-21 17:54:57'),
(39, '612130f83c94d', 'barsbaral', 5110971636215823, 676, '01/1970', '2021-08-21 17:59:36'),
(40, '612130f83c94d', 'barsbaral', 4110479763607515, 726, '01/1970', '2021-08-21 17:59:36'),
(41, '612130f83c94d', 'barsbaral', 651064019041884, 423, '01/1970', '2021-08-21 17:59:36'),
(42, '612130f83c94d', 'barsbaral', 3710720037657312, 837, '01/1970', '2021-08-21 17:59:36'),
(43, '61229ea83bdfc', 'made account', 5110522644367201, 15, '08/2025', '2021-08-22 19:59:52'),
(44, '61229ea83bdfc', 'made account', 411033126647793, 841, '08/2025', '2021-08-22 19:59:52'),
(45, '61229ea83bdfc', 'made account', 6510874298242848, 563, '08/2025', '2021-08-22 19:59:53'),
(46, '61229ea83bdfc', 'made account', 3710107284543062, 331, '08/2025', '2021-08-22 19:59:53'),
(47, '6122a0a460cac', 'openings biafinance', 5110432936331523, 314, '08/2025', '2021-08-22 20:08:20'),
(48, '6122a0a460cac', 'openings biafinance', 4110262027262633, 563, '08/2025', '2021-08-22 20:08:20'),
(49, '6122a0a460cac', 'openings biafinance', 6510883634474683, 312, '08/2025', '2021-08-22 20:08:20'),
(50, '6122a0a460cac', 'openings biafinance', 3710662818234408, 222, '08/2025', '2021-08-22 20:08:20'),
(51, '61257c9958053', 'createaccount', 5110469235132363, 314, '08/2025', '2021-08-25 00:11:21'),
(52, '61257c9958053', 'createaccount', 4110132855652439, 364, '08/2025', '2021-08-25 00:11:22'),
(53, '61257c9958053', 'createaccount', 6510235768746689, 97, '08/2025', '2021-08-25 00:11:22'),
(54, '61257c9958053', 'createaccount', 3710821392509941, 226, '08/2025', '2021-08-25 00:11:22');

-- --------------------------------------------------------

--
-- Table structure for table `cashmailing`
--

CREATE TABLE `cashmailing` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `tracking` varchar(255) NOT NULL,
  `addresses` varchar(255) NOT NULL,
  `zipcode` int(255) NOT NULL,
  `amount` bigint(255) NOT NULL,
  `locations` varchar(255) DEFAULT NULL,
  `statuz` varchar(255) NOT NULL DEFAULT 'processing',
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashmailing`
--

INSERT INTO `cashmailing` (`id`, `userid`, `tracking`, `addresses`, `zipcode`, `amount`, `locations`, `statuz`, `createdAt`) VALUES
(1, 'unixtojd', 'bia-611fe5c7edb08', '6 somerandom address in full update', 12236, 5000, 'aba', 'processing', '2021-08-20 18:26:32'),
(2, 'unixtojd', 'bia-611fe5df250bd', '6 somerandom address in full', 12236, 5000, NULL, 'processing', '2021-08-20 18:26:55'),
(3, '61212dbca5572', 'bia-6124ee4f467aa', '44 street angel los angel', 10234, 500, NULL, 'processing', '2021-08-24 14:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `otp` int(7) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `tx_ref` varchar(255) NOT NULL,
  `purpose` text NOT NULL,
  `amount` bigint(255) NOT NULL,
  `accountnumber` bigint(255) DEFAULT NULL,
  `routing` bigint(255) DEFAULT NULL,
  `accountname` varchar(250) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `userid`, `tx_ref`, `purpose`, `amount`, `accountnumber`, `routing`, `accountname`, `createdAt`) VALUES
(1, 'unixtojd', 'bia-2459447', 'debit', 3000, 1234556677, 122344556, 'emeka wood', '2021-08-20 17:16:38'),
(2, 'unixtojd', 'bia-2459447', 'debit', 3000, 1234556677, 122344556, 'emeka wood', '2021-08-20 17:31:36'),
(3, 'unixtojd', 'bia-611fe5ab13f0c', 'cashmailing', 5000, NULL, NULL, NULL, '2021-08-20 18:26:03'),
(4, 'unixtojd', 'bia-611fe5c80bd13', 'cashmailing', 5000, NULL, NULL, NULL, '2021-08-20 18:26:32'),
(5, 'unixtojd', 'bia-611fe5df34cc6', 'cashmailing', 5000, NULL, NULL, NULL, '2021-08-20 18:26:55'),
(6, '61212dbca5572', 'bia-unixtojd', 'debit', 100, NULL, NULL, NULL, '2021-08-22 17:17:01'),
(7, '61212dbca5572', 'bia-unixtojd', 'debit', 100, 100, NULL, NULL, '2021-08-22 17:17:52'),
(8, '61212dbca5572', 'bia-61249d450afb8', 'debit', 300, 394857685, 394857685, 'secure bix', '2021-08-24 08:18:29'),
(9, '61212dbca5572', 'bia-6124ee51d84c4', 'cashmailing', 500, NULL, NULL, NULL, '2021-08-24 14:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `isadmin` varchar(255) NOT NULL DEFAULT 'false',
  `accountbalance` bigint(255) DEFAULT 0,
  `accountNumber` bigint(255) DEFAULT NULL,
  `addresses` varchar(100) DEFAULT NULL,
  `residentialstate` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `dob` varchar(100) DEFAULT NULL,
  `pin` int(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `fullname`, `email`, `pass`, `isadmin`, `accountbalance`, `accountNumber`, `addresses`, `residentialstate`, `country`, `dob`, `pin`, `createdAt`) VALUES
(1, 'unixtojd', ' emeka emmanuel updated 2', ' emekaemmanuel@gmail.com', '12345678', 'false', 45000, 1234567890, ' 4 edidi street amukoko lagoon', 'null', ' portugal', ' 12/12/12', 1078, '2021-08-20 15:39:02'),
(3, '611fef826167e', 'emmanuel wood', 'emmanuelwoods@gmail.com', '1212121212', 'false', 0, 10000000000, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1079, '2021-08-20 19:08:02'),
(5, '611ff121df1ce', 'stone wood', 'stonewood@gmail.com', '1214sd32121213', 'false', 0, 10000000000, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1071, '2021-08-20 19:14:57'),
(6, '611ff229b8806', 'stone wooxz', 'stonewoodzx@gmail.com', '1214sd3212', 'false', 0, 10000000000, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1072, '2021-08-20 19:19:21'),
(7, '611ff3a0859e1', 'buks josh', 'buksjosh@gmail.com', '1214sd3212xsa', 'false', 0, 10000000000, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1783, '2021-08-20 19:25:36'),
(9, '611ff82d6a531', 'bdle emma', 'bdlemma@gmail.com', '1214sd3212x2', 'false', 0, 123234567890, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1787, '2021-08-20 19:45:01'),
(10, '61212dbca5572', 'jabrilsnail updated', 'shipliveinc@gmail.com', '123qw123', 'false', 9200, 99420555130, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1789, '2021-08-21 17:45:48'),
(12, '61212fa7902d0', 'sailjabral', 'sailjabral@gmail.com', '2w34w223', 'false', 0, 16307517925, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1890, '2021-08-21 17:53:59'),
(14, '612130f83c94d', 'barsbaral', 'barsbaral@gmail.com', '2w34w23', 'false', 0, 56141226624, '4 heaven road jolad', 'italy', 'italy', '11/12/13', 1899, '2021-08-21 17:59:36'),
(15, '61229ea83bdfc', 'made account', 'madeaccount@gmail.com', '1qaz1qaz', 'false', 0, 83122394447, '4427 Chester road', 'Illinois', 'egbeda', '1995-07-04', 1900, '2021-08-22 19:59:52'),
(16, '6122a0a460cac', 'openings biafinance', 'openingsbiafinance@gmail.com', '12qw321we', 'false', 0, 75909583556, 'hungtington beach', 'State / Capital', 'illionois', '3213-03-21', 1601, '2021-08-22 20:08:20'),
(17, '61257c9958053', 'createaccount', 'createaccount@gmail.com', 'createaccount', 'false', 200, 6245203150, '34 createaccount highway', 'ways', 'road', '18/2/1980', 1121, '2021-08-25 00:11:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashmailing`
--
ALTER TABLE `cashmailing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `cashmailing`
--
ALTER TABLE `cashmailing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
