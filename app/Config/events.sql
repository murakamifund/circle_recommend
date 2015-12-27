-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 11 月 27 日 05:55
-- サーバのバージョン： 5.6.26
-- PHP Version: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CircleRecommend`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `circle_id` int(11) NOT NULL,
  `circle_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `day` datetime NOT NULL,
  `place` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `money` int(11) DEFAULT NULL,
  `for_newcomer` tinyint(1) DEFAULT NULL,
  `practice` tinyint(1) DEFAULT NULL,
  `game` tinyint(1) DEFAULT NULL,
  `camp` tinyint(1) DEFAULT NULL,
  `party` tinyint(1) DEFAULT NULL,
  `other` tinyint(1) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Scheduled',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `events`
--

INSERT INTO `events` (`id`, `circle_id`, `circle_name`, `event_type_id`, `title`, `day`, `place`, `money`, `for_newcomer`, `practice`, `game`, `camp`, `party`, `other`, `status`, `active`, `created`, `modified`) VALUES
(11, 23, 'PSI', 0, 'Twitterログイン頑張ろうne', '2015-11-29 09:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Scheduled', 1, '2015-11-27', '2015-11-27'),
(13, 23, 'PSI', 0, '田村', '2015-11-27 05:47:00', 'なし', 0, 1, 1, 0, 0, NULL, 0, 'Scheduled', 1, '2015-11-27', '2015-11-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
