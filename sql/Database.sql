-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 04:59 AM
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
-- Database: `hehepp`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_contacts`
--

CREATE TABLE `blocked_contacts` (
  `ID` int(11) NOT NULL,
  `Blocker` varchar(200) NOT NULL,
  `Blocked` varchar(200) NOT NULL,
  `BlockDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `ID` int(11) NOT NULL,
  `User1` varchar(200) NOT NULL,
  `User2` varchar(200) NOT NULL,
  `Creator` varchar(200) NOT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`ID`, `User1`, `User2`, `Creator`, `CreationDate`) VALUES
(4, '@janedoe9', '@henen.programmer8', '4', '2023-12-29 02:59:03'),
(5, '@johndoe9', '@henen.programmer8', '4', '2023-12-29 02:59:27'),
(6, '@johndoe9', '@janedoe9', '3', '2023-12-29 03:08:58'),
(7, '@johndoe9', '@lady0', '5', '2023-12-29 03:25:53'),
(8, '@johndoe9', '@doo1', '6', '2023-12-29 03:36:49'),
(9, '@johndoe9', '@james5', '7', '2023-12-29 03:40:58');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `SentTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `UserFrom` int(11) NOT NULL,
  `UserTo` int(11) NOT NULL,
  `MessageType` enum('text','image','video','audio','docx') NOT NULL DEFAULT 'text',
  `MessageBody` text NOT NULL,
  `ReplyBody` text DEFAULT NULL,
  `HaveRead` enum('true','false','','') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `SentTime`, `UserFrom`, `UserTo`, `MessageType`, `MessageBody`, `ReplyBody`, `HaveRead`) VALUES
(11, '2023-12-29 03:03:21', 4, 2, 'text', 'What&#039;s up, John?', NULL, 'true'),
(12, '2023-12-29 03:03:21', 4, 2, 'text', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dolorem natus perferendis culpa aut magni officia sapiente molestias consectetur totam aliquam, fugit neque distinctio sunt quibusdam reiciendis quisquam dolor laudantium.', NULL, 'true'),
(13, '2023-12-29 03:03:49', 2, 4, 'text', 'Okay', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque dolorem natus perferendis culpa aut magni officia sapiente molestias consectetur totam aliquam, fugit neque distinctio sunt quibusdam reiciendis quisquam dolor laudantium.', 'true'),
(14, '2023-12-29 03:05:49', 4, 2, 'text', 'Can you send me your Facebook profile link?<br>I really need to show someone a project on your profile.', NULL, 'true'),
(15, '2023-12-29 03:06:45', 2, 4, 'text', 'Okay, https://facebook.com/HenenTheProgrammer', NULL, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(100) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `DayOfBirth` int(2) NOT NULL,
  `YearOfBirth` int(4) NOT NULL,
  `MonthOfBirth` varchar(10) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `Photo` varchar(2000) NOT NULL DEFAULT 'default',
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ActiveStatus` varchar(100) NOT NULL DEFAULT 'Sat Feb 18 2023 17:06:59 GMT-0400 (Atlantic Standard Time)',
  `UserKey` varchar(200) NOT NULL,
  `LINE` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Email`, `UserName`, `DayOfBirth`, `YearOfBirth`, `MonthOfBirth`, `Password`, `Photo`, `RegDate`, `ActiveStatus`, `UserKey`, `LINE`) VALUES
(2, 'johndoe@gmail.com', 'John Doe', 2, 2000, 'august', '$2y$10$QmWijmm4XS6x/3SeJeoRQuSs4f9H4wcOKEuq6HE1Vz27TlRvmb87.', 'MOI2nZfcTdyINgTB5GYMCvgx0XGykUrsdmVQI1B55jS1oHwPWb8Y5me5ztNSfg.jpg', '2023-12-29 03:58:15', 'Thu Dec 28 2023 19:58:15 GMT-0800 (GMT-08:00)', '@johndoe9', NULL),
(3, 'janedoe@gmail.com', 'Jane Doe', 5, 1982, 'december', '$2y$10$8kXcjTeWSkzE3WbY/FxsqO4gdcWWYvWgbBRWU04QVzxVRvjcvs8rW', 'XAwMOhUOT3v5Lj3JB6Z2vcvsNS1d4fecNBUh351KmwpCkidBS0okhh4GMWS0KX.jpg', '2023-12-29 03:56:39', 'Thu Dec 28 2023 19:56:39 GMT-0800 (GMT-08:00)', '@janedoe9', NULL),
(4, 'henen.programmer@proton.me', 'Henen The Programmer', 27, 2001, 'may', '$2y$10$ZmL.Nf1V1nF3IqBBISLBRuDgQAraBPFffPcdiYVLwLYm/nuFmU9Ve', 'Mxd7MxWOmFK0eAsQngjnny61Jfne0Ercuf1MOohKzkqFjWMGG7CDB2k0xeeLxK.jpg', '2023-12-29 03:57:52', 'Thu Dec 28 2023 19:57:52 GMT-0800 (GMT-08:00)', '@henen.programmer8', NULL),
(5, 'lady@gmail.com', 'Lady Ada', 5, 1789, 'september', '$2y$10$A3EfDxYelHJjjg.fAbYnTORibBDvh6u9AW/MtkyGx1efG3TIBJzci', 'w6HtLj9KZSG7G2VYhokkqsaqsa51TuqLGFHlVELllLjzbKq8gtNCkWju8OtuKT.jpg', '2023-12-29 03:31:51', 'Thu Dec 28 2023 19:31:50 GMT-0800 (GMT-08:00)', '@lady0', NULL),
(6, 'doo@gmail.com', 'Dooshima', 1, 2003, 'april', '$2y$09$zk/kS8y8lfQkWMYUpTcANOmKdCx8yh7ueeUgy6AdwIaNdvcEQV2wi', 'nuJ7ISma7khMilqE7pGjStaHml9gLb8s0HQkyLFrc9RKiPMbIxau_NXrqSyO1d.jpg', '2023-12-29 03:37:59', 'Thu Dec 28 2023 19:37:59 GMT-0800 (GMT-08:00)', '@doo1', NULL),
(7, 'james@gmail.com', 'James Gosling', 2, 1782, 'october', '$2y$10$mTokbUcQwAYqt5dLKc9Dr.83JQIJK/2Q.TlzzJNPJ4AS63/VpqqVe', 'kl6jT6Vwv7VI7YkZ1cjQVKy81kbLa4RRfQolt1Gw_aTUmyleejMqgh8q54b2AD.jpg', '2023-12-29 03:40:49', 'Thu Dec 28 2023 19:39:58 GMT-0800 (GMT-08:00)', '@james5', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_contacts`
--
ALTER TABLE `blocked_contacts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_contacts`
--
ALTER TABLE `blocked_contacts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
