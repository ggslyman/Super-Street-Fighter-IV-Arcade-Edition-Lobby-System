-- phpMyAdmin SQL Dump
-- version 3.3.10.3
-- http://www.phpmyadmin.net
--
-- ホスト: mysql122.db.sakura.ne.jp
-- 生成時間: 2011 年 9 月 11 日 23:32
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
-- テーブルの構造 `ssf4ae_characters`
--

DROP TABLE IF EXISTS `ssf4ae_characters`;
CREATE TABLE IF NOT EXISTS `ssf4ae_characters` (
  `character_id` int(11) NOT NULL AUTO_INCREMENT,
  `Character_name` varchar(512) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`character_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- テーブルのデータをダンプしています `ssf4ae_characters`
--

INSERT INTO `ssf4ae_characters` (`character_id`, `Character_name`, `created`, `modified`) VALUES
(1, 'リュウ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'ケン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '春麗', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'エドモンド・本田', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ブランカ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ザンギエフ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'ガイル', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'ダルシム', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'バイソン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'バルログ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'サガット', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'ベガ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'クリムゾン・ヴァイパー', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'ルーファス', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'エル・フォルテ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'アベル', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'セス', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, '豪鬼', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, '剛拳', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'キャミィ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'フェイロン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'さくら', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'ローズ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, '元', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'ダン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'サンダー・ホーク', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'ディージェイ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'ガイ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'コーディー', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'いぶき', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'まこと', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'ダッドリー', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'アドン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'ハカン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'ジュリ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'ユン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'ヤン', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, '殺意リュウ', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, '狂オシキ鬼', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
