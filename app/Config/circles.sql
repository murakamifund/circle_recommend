-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 12 月 27 日 08:20
-- サーバのバージョン： 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `circlerecommend`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `circles`
--

CREATE TABLE IF NOT EXISTS `circles` (
  `id` int(11) NOT NULL,
  `tw_user_id` bigint(30) NOT NULL,
  `tw_screen_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tw_profile_image_url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tw_profile_banner_url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tw_access_token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tw_access_token_secret` varchar(255) CHARACTER SET utf8 NOT NULL,
  `circle_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phrase` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8 NOT NULL,
  `place` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `placetext` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `intercollege` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `all` int(11) DEFAULT NULL,
  `man` int(11) DEFAULT NULL,
  `woman` int(11) DEFAULT NULL,
  `cost_in` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `nomi` int(11) DEFAULT NULL,
  `mazime` int(11) DEFAULT NULL,
  `day1` int(11) DEFAULT NULL,
  `day2` int(11) DEFAULT NULL,
  `day3` int(11) DEFAULT NULL,
  `day4` int(11) DEFAULT NULL,
  `day5` int(11) DEFAULT NULL,
  `day6` int(11) DEFAULT NULL,
  `day7` int(11) DEFAULT NULL,
  `pr` text CHARACTER SET utf8,
  `value` int(11) DEFAULT NULL,
  `value1` int(11) DEFAULT NULL,
  `value2` int(11) DEFAULT NULL,
  `value3` int(11) DEFAULT NULL,
  `value4` int(11) DEFAULT NULL,
  `value5` int(11) DEFAULT NULL,
  `value6` int(11) DEFAULT NULL,
  `value7` int(11) DEFAULT NULL,
  `favorite` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `circles`
--

INSERT INTO `circles` (`id`, `tw_user_id`, `tw_screen_name`, `tw_profile_image_url`, `tw_profile_banner_url`, `tw_access_token`, `tw_access_token_secret`, `circle_name`, `phrase`, `url`, `activity`, `place`, `placetext`, `intercollege`, `all`, `man`, `woman`, `cost_in`, `cost`, `nomi`, `mazime`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `pr`, `value`, `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `favorite`) VALUES
(15, 3313870490, 'koichirot11', 'http://pbs.twimg.com/profile_images/631639615233855489/EhVW6NT6_normal.jpg', '', '3313870490-7UAMyNeAyaB9LEmwqEwtOxoCgttW0jK489rGPKm', 'hbtaWpRuYyUFP11wzvGNqIgX9fDTPfhWSYJooaV29BzAo', 'PSI', '楽しいよ!', 'http://www.si.t.u-tokyo.ac.jp/psi/', 'その他', '本郷', '工学部', '学内', NULL, 48, 2, 0, 0, 4, 4, 1, 1, 1, 1, 1, 0, 0, 'シス創C', 10, 30, 15, 30, 15, 20, 20, 60, 0),
(16, 359248530, 'muranokami1', 'http://pbs.twimg.com/profile_images/378800000170769103/1a9a686e31e74888dbe5276ab91cbb14_normal.jpeg', '', '359248530-zNY7oRJxBQxUmZ0oOARVJlA83SV33XEsZo4iO7wf', 'oBA1QpB4exRlWY7WEgwlIMGZGu7Ux0IBRqrZ7HH8eQzAm', 'トマト', '優勝！', '', 'テニス', '駒場', 'コート', '学内', NULL, 100, 100, 20000, 10000, 3, 4, 1, 0, 1, 0, 0, 1, 0, 'サークル', 5, 25, 10, 20, 15, 15, 15, 205, 1),
(21, 3252392449, 'dekinaiyoooooo1', 'http://pbs.twimg.com/profile_images/620404410884055040/3xiyAVaP_normal.png', 'https://pbs.twimg.com/profile_banners/3252392449/1451194135', '3252392449-1T75H7fKg5eN21gKETNaCGaUuc7jiJfgPi8zKRR', 'yqQo4O12IJy4NFwhKBLEQzJZF0cIHif4kONvaoy8142oT', 'UT-Circle', 'aaaa', '', '', '駒場', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, 1, 0, 1, 0, 0, 'aaaa', 5, 5, 30, 5, 30, 15, 15, 5, 0),
(22, 1560515316, 'machida_mai', 'http://pbs.twimg.com/profile_images/488888858751152128/1xP8xj7b_normal.jpeg', 'https://pbs.twimg.com/profile_banners/1560515316/1378357902', '1560515316-ZLHJKzbZPCSWBj4qN3hueQGyAiXBSnZQie7NICp', 'l9j85FDxAYZ41FDA4wi8rkkbSaWwGpRQoQojplua6en1f', 'まちだ', 'ああああああああ', '', '', '本郷', '', '学内', NULL, 1, 0, 100000, NULL, 10, 10, 0, 0, 0, 1, 0, 0, 1, 'あああああああ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `circles`
--
ALTER TABLE `circles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `circles`
--
ALTER TABLE `circles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
