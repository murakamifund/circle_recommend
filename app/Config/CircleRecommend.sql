-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016 年 2 月 07 日 06:52
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
-- テーブルの構造 `circles`
--

CREATE TABLE IF NOT EXISTS `circles` (
  `id` int(11) NOT NULL,
  `tw_user_id` bigint(30) NOT NULL,
  `tw_screen_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tw_profile_image_url` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tw_profile_banner_url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tw_access_token` varchar(255) CHARACTER SET utf8 NOT NULL,
  `circle_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `phrase` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `activity` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `circles`
--

INSERT INTO `circles` (`id`, `tw_user_id`, `tw_screen_name`, `tw_profile_image_url`, `tw_profile_banner_url`, `tw_access_token`, `circle_name`, `phrase`, `url`, `activity`, `place`, `placetext`, `intercollege`, `all`, `man`, `woman`, `cost_in`, `cost`, `nomi`, `mazime`, `day1`, `day2`, `day3`, `day4`, `day5`, `day6`, `day7`, `pr`, `value`, `value1`, `value2`, `value3`, `value4`, `value5`, `value6`, `value7`, `favorite`) VALUES
(25, 3313870490, 'koichirot11', 'http://pbs.twimg.com/profile_images/631639615233855489/EhVW6NT6_normal.jpg', 'https://pbs.twimg.com/profile_banners/3313870490/1439429615', '3313870490-7UAMyNeAyaB9LEmwqEwtOxoCgttW0jK489rGPKm', 'PSI', '楽しく', 'http://www.si.t.u-tokyo.ac.jp/psi/', 'その他', '本郷', '工学部3号館', '学内', NULL, 47, 2, 0, 0, 3, 3, 1, 1, 1, 1, 1, 0, 0, '工学部システム創成学科Cコースです。文理融合を謳い、グローバルな活躍を目指します。工学部の学問をビジネスの場で利かすべく、金融工学や経営工学、データサイエンスなどを学びます。', 10, 25, 20, 25, 20, 20, 20, 59, 0),
(26, 3319897026, 'sotaro819', 'http://abs.twimg.com/sticky/default_profile_images/default_profile_5_normal.png', 'https://pbs.twimg.com/profile_banners/3319897026/1453862159', '3319897026-BXWWIisgIUOrif2RniYnfH8mzuushZiZDlxuLHT', '美味しいもの探検隊', '皆の知らないグルメの世界へ', 'http://www.si.t.u-tokyo.ac.jp/psi/', 'グルメ', '本郷', '御殿下', 'インカレ', NULL, 24, 13, 0, 20000, 4, 1, 1, 0, 0, 0, 1, 1, 0, '皆さん、美味しいものは好きですか？ラーメン、寿司、焼肉、、、。是非是非みんなで一緒に美味しい店を発掘しましょう！好奇心旺盛な一年生を募集します。', 10, 15, 30, 30, 15, 20, 20, 47, 0),
(28, 359248530, 'muranokami1', 'http://pbs.twimg.com/profile_images/378800000170769103/1a9a686e31e74888dbe5276ab91cbb14_normal.jpeg', NULL, '359248530-zNY7oRJxBQxUmZ0oOARVJlA83SV33XEsZo4iO7wf', '村上ファンド', 'サイト作成中', '', 'その他', '本郷', '３号館', '学内', NULL, 4, 0, 0, 0, 4, 4, 1, 1, 1, 1, 1, 0, 0, 'UT-Circleよろしく！', 0, 0, 25, 0, 25, 10, 10, 0, 0),
(29, 3252392449, 'ut_circles', 'http://pbs.twimg.com/profile_images/690072798451101697/caRhRasn_normal.png', 'https://pbs.twimg.com/profile_banners/3252392449/1451194135', '3252392449-1T75H7fKg5eN21gKETNaCGaUuc7jiJfgPi8zKRR', 'UT-Circle', '東大のサークルならお任せ！', '', 'その他', '本郷', '工学部3号館', '学内', NULL, 4, 0, 50000, 0, 4, 3, 1, 1, 1, 1, 1, 1, 1, 'UT-Circleは東京大学のサークルを紹介するWebサービスです。ツイッターと連携し、「SNS上の新歓」というスタイリッシュな新歓を提供します！', 5, 20, 15, 25, 10, 15, 15, 9, 0);

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
  `money` int(11) DEFAULT '0',
  `for_newcomer` tinyint(1) DEFAULT NULL,
  `practice` tinyint(1) DEFAULT NULL,
  `game` tinyint(1) DEFAULT NULL,
  `camp` tinyint(1) DEFAULT NULL,
  `party` tinyint(1) DEFAULT NULL,
  `other` tinyint(1) DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Scheduled',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `events`
--

INSERT INTO `events` (`id`, `circle_id`, `circle_name`, `event_type_id`, `title`, `day`, `place`, `money`, `for_newcomer`, `practice`, `game`, `camp`, `party`, `other`, `content`, `status`, `active`, `created`, `modified`) VALUES
(26, 26, '美味しいもの探検隊', 0, '寿司会', '2016-02-11 19:00:00', '池袋駅西口', 0, 1, 0, 0, 0, 1, 0, '回転しない寿司を食べに行きます。\\n詳細は秘密。（連絡してね）', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(24, 25, 'PSI', 0, 'オリエンテーション委員会MTG', '2016-02-04 13:00:00', '駒場103号室', 0, 0, 0, 1, 0, 0, 0, 'オリエンテーション委員会との話し合い。', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(23, 24, 'PSI', 0, '話し合い', '2016-02-04 13:00:00', '駒場', 0, 0, 0, 1, 0, 0, 0, 'オリエンテーション委員会との話し合い', 'Scheduled', 1, '2016-01-31', '2016-01-31'),
(27, 25, 'PSI', 0, '最終確認', '2016-02-12 13:00:00', '本郷', 0, 0, 1, 0, 0, 0, 0, '確認する', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(28, 25, 'PSI', 0, '調整', '2016-02-08 00:00:00', '自宅作業', 0, 0, 0, 1, 0, 0, 0, '自宅作業', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(29, 26, '美味しいもの探検隊', 0, '焼肉会', '2016-02-04 17:00:00', '渋谷駅マーク下', 3000, 0, 0, 0, 0, 1, 0, '叙々苑食べに行きましょう！', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(30, 28, '村上ファンド', 0, '会合、ミーティング', '2016-02-04 13:00:00', '駒場', 0, 0, 0, 0, 0, 0, 1, '', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(31, 28, '村上ファンド', 0, '会合', '2016-02-21 10:00:00', '本郷', 0, 0, 0, 0, 0, 0, 1, '', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(32, 29, 'UT-Circle', 0, 'ミーティング', '2016-02-10 10:00:00', '東京大学駒場キャンパス', 0, 0, 0, 0, 0, 0, 1, 'エラーのでバックをやりまくるよ', 'Scheduled', 1, '2016-02-04', '2016-02-04'),
(33, 29, 'UT-Circle', 0, 'ミーティング', '2016-02-20 10:00:00', '東京大学本郷キャンパス', 0, 0, 0, 0, 0, 0, 1, 'デバックをしまくる会', 'Scheduled', 1, '2016-02-04', '2016-02-04');

-- --------------------------------------------------------

--
-- テーブルの構造 `event_types`
--

CREATE TABLE IF NOT EXISTS `event_types` (
  `id` int(11) NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL,
  `user_id` bigint(30) DEFAULT NULL,
  `circle_id` int(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `circle_id`) VALUES
(19, 3313870490, 24);

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
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `students`
--

INSERT INTO `students` (`id`, `tw_user_id`, `tw_name`, `tw_screen_name`, `tw_profile_image_url`, `tw_profile_banner_url`, `tw_description`, `tw_access_token`, `created`, `modified`) VALUES
(18, 3313870490, 'よしを', 'koichirot11', 'http://pbs.twimg.com/profile_images/631639615233855489/EhVW6NT6_normal.jpg', 'https://pbs.twimg.com/profile_banners/3313870490/1439429615', '東大工学部PSI/株/システムトレード/機会学習', '3313870490-7UAMyNeAyaB9LEmwqEwtOxoCgttW0jK489rGPKm', '0000-00-00', '0000-00-00'),
(19, 359248530, '村守@旅', 'muranokami1', 'http://pbs.twimg.com/profile_images/378800000170769103/1a9a686e31e74888dbe5276ab91cbb14_normal.jpeg', NULL, '亀中→日比谷→駿台お茶ＳＹ→東大理一38組→シスＣ／トマト88／ドンキー／化学グランプリ二次（２０１１）／すばせか崇拝者／diva／FF／DQ／テイルズ／ボカロ', '359248530-zNY7oRJxBQxUmZ0oOARVJlA83SV33XEsZo4iO7wf', '0000-00-00', '0000-00-00'),
(20, 2277007022, 'たむこう', '7142857', 'http://pbs.twimg.com/profile_images/422080101883187200/chGYEopG_normal.jpeg', 'https://pbs.twimg.com/profile_banners/2277007022/1449593073', '東京学芸大附属大泉/東京学芸大附属高校/東京大学理科1類13組/PSI', '2277007022-xBANc6U7SGFfliCZSCndL73gyMSx5mUHIcyy7UA', '0000-00-00', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `circles`
--
ALTER TABLE `circles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tw_user_id` (`tw_user_id`,`circle_name`,`phrase`,`activity`,`nomi`,`mazime`,`value`,`value1`,`value2`,`value3`,`value4`,`value5`,`value6`,`value7`,`favorite`),
  ADD KEY `tw_user_id_2` (`tw_user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `circle_id` (`circle_id`,`day`,`money`,`for_newcomer`);

--
-- Indexes for table `event_types`
--
ALTER TABLE `event_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tw_user_id` (`tw_user_id`,`tw_name`,`tw_description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `circles`
--
ALTER TABLE `circles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `event_types`
--
ALTER TABLE `event_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
