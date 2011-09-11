-- phpMyAdmin SQL Dump
-- version 3.3.10.3
-- http://www.phpmyadmin.net
--
-- ホスト: mysql122.db.sakura.ne.jp
-- 生成時間: 2011 年 9 月 11 日 23:33
-- サーバのバージョン: 5.1.51
-- PHP のバージョン: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `vash`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `ssf4ae_entries`
--

CREATE TABLE IF NOT EXISTS `ssf4ae_entries` (
  `ssf4ae_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `platform` int(11) NOT NULL,
  `nickname` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `messenger_type` int(11) NOT NULL,
  `messenger_id` text COLLATE utf8_unicode_ci NOT NULL,
  `playerpoint` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `start_datetime` timestamp NULL DEFAULT NULL,
  `end_datetime` timestamp NULL DEFAULT NULL,
  `password` text COLLATE utf8_unicode_ci,
  `delete_flag` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ssf4ae_entry_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=69 ;
