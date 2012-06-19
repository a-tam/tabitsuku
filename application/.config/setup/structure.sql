-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- ホスト: localhost
-- 生成時間: 2012 年 6 月 19 日 10:31
-- サーバのバージョン: 5.5.9
-- PHP のバージョン: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `p0009`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` varchar(45) DEFAULT NULL COMMENT '親ID',
  `path` varchar(221) DEFAULT NULL COMMENT 'パス（最大カテゴリ数10億、10階層）',
  `sort` int(11) DEFAULT NULL COMMENT 'ソート（兄ノード）',
  `name` varchar(200) DEFAULT NULL COMMENT 'カテゴリ名',
  `created_time` datetime DEFAULT NULL COMMENT '作成日時',
  `updated_time` datetime DEFAULT NULL COMMENT '更新日時',
  `status` varchar(45) DEFAULT NULL COMMENT '０：無効、１：有効',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ポイントのカテゴリー';

-- --------------------------------------------------------

--
-- テーブルの構造 `routes`
--

DROP TABLE IF EXISTS `routes`;
CREATE TABLE `routes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tour_id` bigint(20) DEFAULT NULL COMMENT 'イベントID',
  `spot_id` bigint(20) DEFAULT NULL COMMENT 'ポイントID',
  `stay_time` int(11) DEFAULT NULL COMMENT '滞在時間（フリップとは別に任意で変更可能）',
  `sort` int(11) DEFAULT NULL COMMENT 'ソート順',
  `created_time` datetime DEFAULT NULL COMMENT '作成日時',
  `updated_time` datetime DEFAULT NULL COMMENT '更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='経路情報テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `spots`
--

DROP TABLE IF EXISTS `spots`;
CREATE TABLE `spots` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `owner` bigint(20) DEFAULT NULL COMMENT '所有者',
  `name` varchar(200) DEFAULT NULL COMMENT 'イベント名',
  `image` text,
  `description` text COMMENT '説明',
  `stay_time` int(11) DEFAULT NULL COMMENT '滞在時間（分）',
  `x` double DEFAULT NULL COMMENT 'X座標',
  `y` double DEFAULT NULL COMMENT 'Y座標',
  `like_count` bigint(20) DEFAULT NULL COMMENT 'いいね！件数',
  `category` varchar(200) DEFAULT NULL COMMENT 'カテゴリIDをカンマ区切りで登録(mongodbの配列カラムなどを最終的に使う)',
  `tags` varchar(200) DEFAULT NULL COMMENT 'タグIDをカンマ区切りで保持（検索用のインデックス）',
  `keyword` varchar(200) NOT NULL,
  `addition` text NOT NULL,
  `created_time` datetime DEFAULT NULL COMMENT '作成日時',
  `updated_time` datetime DEFAULT NULL COMMENT '更新日時',
  `status` varchar(45) DEFAULT NULL COMMENT '０：無効、１：有効',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='位置情報テーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL COMMENT 'タグ名',
  `created_time` varchar(45) DEFAULT NULL COMMENT '作成日時',
  `updated_time` datetime DEFAULT NULL COMMENT '更新日時',
  `status` varchar(45) DEFAULT NULL COMMENT '０：無効、１：有効',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='タグ検索用';

-- --------------------------------------------------------

--
-- テーブルの構造 `tours`
--

DROP TABLE IF EXISTS `tours`;
CREATE TABLE `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) DEFAULT NULL COMMENT '所有者',
  `name` varchar(200) DEFAULT NULL COMMENT 'スケジュール名（例：オススメ東京観光旅行）',
  `description` text COMMENT '説明',
  `start_time` datetime DEFAULT NULL COMMENT '開始時間',
  `end_time` datetime DEFAULT NULL COMMENT '終了時間',
  `like_count` varchar(45) DEFAULT NULL COMMENT 'いいね！件数',
  `category` varchar(200) DEFAULT NULL,
  `tags` varchar(200) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL COMMENT '作成日時',
  `updated_time` datetime DEFAULT NULL COMMENT '更新日時',
  `status` varchar(45) DEFAULT NULL COMMENT '０：無効、１：有効',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='イベントテーブル';

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `login_id` varchar(255) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(50) DEFAULT NULL COMMENT 'Facebook ID',
  `name` varchar(200) DEFAULT NULL COMMENT '名前',
  `created_time` datetime DEFAULT NULL COMMENT '作成日時',
  `updated_time` datetime DEFAULT NULL COMMENT '更新日時',
  `status` varchar(45) DEFAULT NULL COMMENT '０：無効、１：有効',
  PRIMARY KEY (`id`),
  UNIQUE KEY `facebook_id_UNIQUE` (`facebook_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='ユーザーテーブル（Facebook連携）';
