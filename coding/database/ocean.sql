-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2020 at 10:44 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocean`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adminname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adminname`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'radhe krishna', 'Daanji', 'Daanji', '2020-11-07 17:39:44', 'no', 112),
(2, 'shiv shiv', 'Daanji', 'Daanji', '2020-11-08 01:02:38', 'no', 112),
(3, 'mahadev haar', 'Miraa123', 'Uma', '2020-11-08 09:42:41', 'no', 109),
(4, 'shiv shiv', 'Daanji', 'Uma', '2020-11-08 09:44:06', 'no', 109),
(5, 'hare krishna', 'Daanji', 'Miraa123', '2020-11-09 12:17:20', 'no', 108),
(6, 'nice photo', 'Miraa123', 'Uma', '2020-11-10 02:53:28', 'no', 111),
(7, 'nice', 'Ganesh', 'Ganesh', '2020-11-10 17:27:34', 'no', 113),
(8, 'nice', 'Miraa123', 'Miraa123', '2020-11-19 09:41:16', 'no', 114);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `user_from` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(4, 'Daanji', 'Ganesh');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(7, 'Miraa123', 111),
(8, 'Miraa123', 109),
(10, 'Daanji', 111),
(11, 'Daanji', 109),
(18, 'Daanji', 112),
(22, 'Miraa123', 112),
(23, 'Ganesh', 113),
(24, 'Daanji', 108),
(25, 'Ganesh', 112),
(26, 'Ganesh', 110),
(28, 'Miraa123', 113),
(29, 'Miraa123', 114);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(100) NOT NULL,
  `user_from` varchar(100) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'Ganesh', 'Daanji', 'Hello Ganesh', '2020-11-13 16:22:57', 'yes', 'no', 'no'),
(2, 'Ganesh', 'Daanji', 'How are you', '2020-11-13 16:23:04', 'yes', 'no', 'no'),
(3, 'Ganesh', 'Daanji', '???', '2020-11-13 16:23:09', 'yes', 'no', 'no'),
(4, 'Ganesh', 'Daanji', 'how`s your father', '2020-11-13 16:24:39', 'yes', 'no', 'no'),
(5, 'Ganesh', 'Daanji', 'what are you doing now a days', '2020-11-13 16:25:00', 'yes', 'no', 'no'),
(6, 'Daanji', 'Ganesh', 'yes i am fine', '2020-11-13 16:26:47', 'yes', 'no', 'no'),
(7, 'Daanji', 'Ganesh', 'my fathe is doing well', '2020-11-13 16:27:04', 'yes', 'no', 'no'),
(8, 'Daanji', 'Ganesh', 'i am free now a days', '2020-11-13 16:27:18', 'yes', 'no', 'no'),
(20, 'Daanji', 'Ganesh', 'shiv', '2020-11-13 17:38:35', 'yes', 'no', 'no'),
(21, 'Ganesh', 'Daanji', 'shiv shiv', '2020-11-13 17:40:44', 'yes', 'no', 'no'),
(22, 'Daanji', 'Ganesh', 'where are you', '2020-11-13 17:41:10', 'yes', 'no', 'no'),
(23, 'Ganesh', 'Daanji', 'i am in jamnager', '2020-11-13 17:41:41', 'yes', 'no', 'no'),
(24, 'Ganesh', 'Daanji', 'where are you now', '2020-11-13 17:52:10', 'yes', 'no', 'no'),
(25, 'Daanji', 'Ganesh', 'i am @ kailash himalaya', '2020-11-13 17:52:41', 'yes', 'no', 'no'),
(26, 'Daanji', 'Ganesh', 'i am @ kailash himalaya', '2020-11-13 17:53:56', 'yes', 'no', 'no'),
(27, 'Daanji', 'Ganesh', 'hello', '2020-11-13 23:00:39', 'yes', 'no', 'no'),
(28, 'Ganesh', 'Daanji', 'mahadev haar fried how are you doing', '2020-11-14 01:51:37', 'yes', 'no', 'no'),
(29, 'Uma', 'Daanji', 'hello maam', '2020-11-14 02:10:18', 'no', 'no', 'no'),
(30, 'Uma', 'Ganesh', 'hi maa', '2020-11-14 02:12:04', 'no', 'no', 'no'),
(31, 'Daanji', 'Ganesh', 'hii', '2020-11-14 02:18:33', 'no', 'no', 'no'),
(32, 'Miraa123', 'Ganesh', 'hello mira', '2020-11-14 02:35:07', 'yes', 'no', 'no'),
(33, 'Daanji', 'Miraa123', 'hi daan how are you', '2020-11-15 10:54:09', 'no', 'no', 'no'),
(34, 'Uma', 'Miraa123', 'hello uma', '2020-11-15 16:40:51', 'yes', 'no', 'no'),
(35, 'Keval', 'Miraa123', 'hello kalakar :)', '2020-11-17 23:17:20', 'no', 'no', 'no'),
(36, 'Daanji', 'Miraa123', 'hello', '2020-11-19 09:42:10', 'no', 'no', 'no'),
(37, 'Daanji', 'Miraa123', 'hello', '2020-11-20 23:37:56', 'no', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(101, 'jay gurudev', 'Miraa123', '2020-11-02 18:56:46', 'no', 'no', 0, 'assets/images/posts/5fa0485ebb6bc01b8618a713d6bbfca3ab9bc53288400.jpg'),
(102, 'Shree ganeshay namah', 'Miraa123', '2020-11-04 17:33:38', 'no', 'no', 0, ''),
(103, 'Mahadev Haar', 'Miraa123', '2020-11-04 17:34:55', 'no', 'no', 0, 'assets/images/posts/5fa298e7524084c00f7a7b73820caef612c862d8c3281.jpg'),
(108, 'jay ho !!!!!!!', 'Miraa123', '2020-11-05 01:35:08', 'no', 'no', 1, 'assets/images/posts/5fa309748ca0aScreenshot_2019-12-22-15-08-09-11.png'),
(109, 'Mahadev Haar to all of you', 'Uma', '2020-11-06 00:03:03', 'no', 'no', 2, 'assets/images/posts/5fa4455f863002425c4eb-529c-4c77-95df-ef01ce728075.jpg'),
(110, 'Tranipaat', 'Ganesh', '2020-11-06 00:05:37', 'no', 'no', 1, 'assets/images/posts/5fa445f9bd1calord shiva0001.jpg'),
(111, 'hello every one', 'Uma', '2020-11-06 01:11:33', 'no', 'no', 2, 'assets/images/posts/5fa4556d5ab2e20_Quokka.jpg'),
(112, 'hare krishna', 'Daanji', '2020-11-07 11:20:42', 'no', 'no', 3, 'assets/images/posts/5fa635b273c572b8ae9b52bb48cc9521c863d7a13dad4.jpg'),
(114, 'hello', 'Miraa123', '2020-11-19 09:40:55', 'no', 'no', 1, 'assets/images/posts/5fb5f04f517e9IMG_0114.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `cover_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `hometown` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `bio` text DEFAULT NULL,
  `phone` int(20) DEFAULT NULL,
  `work` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `dob`, `gender`, `password`, `signup_date`, `profile_pic`, `cover_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`, `address`, `city`, `hometown`, `country`, `bio`, `phone`, `work`) VALUES
(106, 'Mahadev', 'Shiv', 'Shiv', 'Shiv@gmail.com', '2000-01-03', 'Male', 'shiv32', '2020-11-05', 'assets/images/profile_pics/defaults/male.png', 'assets/images/cover_pics/d-cover.jpg', 0, 0, 'no', ',', '', '', '', '', NULL, NULL, ''),
(107, 'Ganesh', 'Shiv', 'Ganesh', 'Ganesh@gmail.com', '2020-11-02', 'Male', 'abcdefg', '2020-11-05', 'assets/images/profile_pics/2b8ae9b52bb48cc9521c863d7a13dad4.jpg', 'assets/images/cover_pics/02225_cherryflowers_2560x1600.jpg', 2, 3, 'no', ',Uma,Miraa123,', '', '', '', '', ' mahadev haar', NULL, ''),
(108, 'Uma', 'Mahadev', 'Uma', 'Uma@gmail.com', '2020-11-02', 'Female', 'abcd123', '2020-11-05', 'assets/images/profile_pics/defaults/female.png', 'assets/images/cover_pics/d-cover.jpg', 2, 4, 'no', ',Daanji,Ganesh,Miraa123,', '', '', '', '', NULL, NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
