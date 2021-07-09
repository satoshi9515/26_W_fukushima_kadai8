-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2021 年 7 朁E09 日 17:47
-- サーバのバージョン： 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gs_kdb`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_course_table`
--

CREATE TABLE IF NOT EXISTS `gs_course_table` (
`c_id` int(12) NOT NULL,
  `c_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `t_id` int(12) NOT NULL,
  `tt_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `c_length` int(64) NOT NULL,
  `s_id` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cnt_s_id` int(64) NOT NULL,
  `sselected_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_course_table`
--

INSERT INTO `gs_course_table` (`c_id`, `c_name`, `t_id`, `tt_name`, `c_length`, `s_id`, `cnt_s_id`, `sselected_flg`, `indate`) VALUES
(15, 'ものづくり講座', 0, 'akahoshi', 10, '3', 1, 1, '2021-06-26 21:16:02'),
(16, 'aa', 0, 'fukushima', 30, '', 0, 0, '2021-06-26 23:09:45'),
(17, 'ww', 12, 'fukushima', 10, '3,8,9,10', 4, 0, '2021-06-26 23:09:55'),
(18, '福島　聡', 13, 'ふくしまさとし', 6, '3,4,5', 3, 0, '2021-06-28 18:10:08'),
(19, '微分積分', 3, 'akahoshi', 20, '5,6,7', 3, 0, '2021-07-03 00:29:52'),
(20, 'ITリテラシー', 3, 'fukushima', 1000, '3', 1, 0, '0000-00-00 00:00:00'),
(21, 'DX基礎', 3, 'fukushima', 100, '6,7,8', 3, 0, '0000-00-00 00:00:00'),
(22, '国際教養', 3, 'fukushima', 400, '8,9,10', 3, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_students_table`
--

CREATE TABLE IF NOT EXISTS `gs_students_table` (
`s_id` int(12) NOT NULL,
  `s_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `s_account` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `s_mail` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `s_pw` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `t_id` int(3) NOT NULL,
  `s_life_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_students_table`
--

INSERT INTO `gs_students_table` (`s_id`, `s_name`, `s_account`, `s_mail`, `s_pw`, `t_id`, `s_life_flg`, `indate`) VALUES
(3, '赤星', 'akahoshi', '', '', 0, 0, '2021-05-16 16:58:26'),
(4, '井上', 'ri', '', '', 0, 0, '2021-05-16 16:58:26'),
(5, '臼井', 'aaa', '', '', 0, 0, '2021-06-20 00:09:17'),
(6, '江川', 'ccc', '', '', 0, 0, '2021-06-20 00:09:47'),
(7, '太田', 'hamurinn', '', '', 1118, 0, '2021-06-20 01:06:53'),
(8, '香川', 'aaaa', '', '', 0, 0, '2021-06-20 13:23:01'),
(9, '菊池', 'hoshi', '', 'ss', 0, 0, '2021-06-26 22:04:31'),
(10, '久米', 'hoshi', '', 'ss', 0, 0, '2021-06-26 22:04:36'),
(11, '本田', 'ああ', 'ああ', 'ああ', 0, 0, '2021-07-04 12:55:05');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_teachers_table`
--

CREATE TABLE IF NOT EXISTS `gs_teachers_table` (
`t_id` int(12) NOT NULL,
  `t_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `t_account` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `t_mail` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `t_pw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `selected_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_teachers_table`
--

INSERT INTO `gs_teachers_table` (`t_id`, `t_name`, `t_account`, `t_mail`, `t_pw`, `selected_flg`, `indate`) VALUES
(3, 'akahoshi', 'akahoshi', '', 'yumi', 0, '2021-05-16 16:58:26'),
(12, '田中', 'tanaka', 'aa', 'aa', 0, '2021-06-26 09:53:19'),
(13, 'ふくしまさとし', 'a', 'fukushima@as', 'aa', 0, '2021-06-26 19:57:48'),
(14, 'fukushima', 'fukushima', 'ああ', 'satoshi', 0, '2021-06-26 20:27:31'),
(15, 'マイケル', 'Mickel', 'aa', 'aa', 0, '2021-07-04 11:03:56'),
(16, '福田', 'ああ', 'aa', 'aa', 0, '2021-07-04 12:39:49'),
(17, '福田', 'あ', 'あ', 'あ', 0, '2021-07-04 12:41:09');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_univ_table`
--

CREATE TABLE IF NOT EXISTS `gs_univ_table` (
`u_id` int(12) NOT NULL,
  `u_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `u_account` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `u_pw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `u_life_flg` int(1) NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_univ_table`
--

INSERT INTO `gs_univ_table` (`u_id`, `u_name`, `u_account`, `u_pw`, `u_life_flg`, `indate`) VALUES
(1, 'fukushima', 'fukushima', 'satoshi', 0, '2021-05-16 16:56:02'),
(2, 'aka', 'hoshi', 'desu', 0, '2021-05-16 16:58:26'),
(3, 'akahoshi', 'akahoshi', 'yumi', 0, '2021-05-16 16:58:26'),
(4, 'ra', 'ri', 'ru', 0, '2021-05-16 16:58:26'),
(5, 'aaa', 'aaa', 'aaa', 0, '2021-06-20 00:09:17'),
(6, 'ccc', 'ccc', 'ccc', 0, '2021-06-20 00:09:47'),
(7, 'あかぼし', 'hamurinn', '1118', 0, '2021-06-20 01:06:53'),
(8, 'aaa', 'aaaa', 'aaaa', 0, '2021-06-20 13:23:01'),
(9, '横浜', 'yokohama', 'yokohama', 0, '2021-06-25 22:47:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_course_table`
--
ALTER TABLE `gs_course_table`
 ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `gs_students_table`
--
ALTER TABLE `gs_students_table`
 ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `gs_teachers_table`
--
ALTER TABLE `gs_teachers_table`
 ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `gs_univ_table`
--
ALTER TABLE `gs_univ_table`
 ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_course_table`
--
ALTER TABLE `gs_course_table`
MODIFY `c_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `gs_students_table`
--
ALTER TABLE `gs_students_table`
MODIFY `s_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `gs_teachers_table`
--
ALTER TABLE `gs_teachers_table`
MODIFY `t_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `gs_univ_table`
--
ALTER TABLE `gs_univ_table`
MODIFY `u_id` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
