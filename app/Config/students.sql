-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015 年 12 月 29 日 17:01
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
-- テーブルの構造 `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL,
  `tw_user_id` bigint(20) NOT NULL,
  `tw_name` varchar(30) NOT NULL,
  `tw_screen_name` varchar(30) DEFAULT NULL,
  `tw_profile_image_url` varchar(255) DEFAULT NULL,
  `tw_profile_banner_url` varchar(255) DEFAULT NULL,
  `tw_description` varchar(255) NOT NULL,
  `tw_access_token` varchar(255) DEFAULT NULL,
  `tw_access_token_secret` varchar(255) DEFAULT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `students`
--

INSERT INTO `students` (`id`, `tw_user_id`, `tw_name`, `tw_screen_name`, `tw_profile_image_url`, `tw_profile_banner_url`, `tw_description`, `tw_access_token`, `tw_access_token_secret`, `created`, `modified`) VALUES
(1, 0, '', NULL, NULL, '', '', NULL, NULL, '0000-00-00', '0000-00-00'),
(2, 0, '', NULL, NULL, '', '', NULL, NULL, '0000-00-00', '0000-00-00'),
(3, 0, '', NULL, NULL, '', '', NULL, NULL, '0000-00-00', '0000-00-00'),
(9, 3313870490, '', 'koichirot11', 'http://pbs.twimg.com/profile_images/63163961523385', '', '', '3313870490-7UAMyNeAyaB9LEmwqEwtOxoCgttW0jK489rGPKm', 'hbtaWpRuYyUFP11wzvGNqIgX9fDTPfhWSYJooaV29BzAo', '0000-00-00', '0000-00-00'),
(13, 3252392449, 'UT-Circle', 'dekinaiyoooooo1', 'http://pbs.twimg.com/profile_images/620404410884055040/3xiyAVaP_normal.png', 'https://pbs.twimg.com/profile_banners/3252392449/1451194135', 'UT-Circleは、東京大学のサークルを紹介するWebサービスです。Twitterと連携し、「SNS上での新歓」というスタイリッシュな新歓を提供します!!', '3252392449-1T75H7fKg5eN21gKETNaCGaUuc7jiJfgPi8zKRR', 'yqQo4O12IJy4NFwhKBLEQzJZF0cIHif4kONvaoy8142oT', '0000-00-00', '0000-00-00'),
(14, 1560515316, 'まちだ', 'machida_mai', 'http://pbs.twimg.com/profile_images/488888858751152128/1xP8xj7b_normal.jpeg', 'https://pbs.twimg.com/profile_banners/1560515316/1378357902', 'UT 3rd シス創C/卓球部', '1560515316-ZLHJKzbZPCSWBj4qN3hueQGyAiXBSnZQie7NICp', 'l9j85FDxAYZ41FDA4wi8rkkbSaWwGpRQoQojplua6en1f', '0000-00-00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
