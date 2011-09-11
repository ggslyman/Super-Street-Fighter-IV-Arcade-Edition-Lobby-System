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
-- テーブルの構造 `ssf4ae_entry_characters`
--

CREATE TABLE IF NOT EXISTS `ssf4ae_entry_characters` (
  `ssf4ae_entry_characters_id` int(11) NOT NULL AUTO_INCREMENT,
  `ssf4ae_entry_id` int(11) NOT NULL,
  `character_id` int(11) NOT NULL,
  `battlepoint` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ssf4ae_entry_characters_id`,`character_id`),
  KEY `fk_ssf4ae_entry_characters_ssf4ae_entries` (`ssf4ae_entry_id`),
  KEY `fk_ssf4ae_entry_characters_ssf4ae_character_master1` (`character_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;
