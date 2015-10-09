-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2015 at 06:19 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_ci_ang`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_articles`
--

CREATE TABLE IF NOT EXISTS `tbl_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `content` varchar(10000) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image_title` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `video_title` varchar(100) DEFAULT NULL,
  `video_url` varchar(200) DEFAULT NULL,
  `embed_code` varchar(10000) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(10) DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `meta_key` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(10000) DEFAULT NULL,
  `meta_robots` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `tbl_articles_ibfk_3` (`author`),
  KEY `tbl_articles_ibfk_4` (`modified_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `tbl_articles`
--

INSERT INTO `tbl_articles` (`id`, `name`, `slug`, `content`, `image`, `image_title`, `video`, `video_title`, `video_url`, `embed_code`, `status`, `created_at`, `author`, `modified_by`, `meta_key`, `meta_desc`, `meta_robots`, `updated_at`) VALUES
(65, 'Kadeem Rios', 'kadeem-rios', '', NULL, NULL, NULL, NULL, NULL, NULL, 3, '2015-07-26 13:37:39', 25, NULL, NULL, NULL, NULL, NULL),
(66, 'Brenna Barron', 'brenna-barron', '<p>dfdfd</p>', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2015-07-26 13:39:02', 25, NULL, NULL, NULL, NULL, NULL),
(67, 'Rooney ScottE', 'rooney-scotte', '<p>dfdf</p>', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2015-07-26 13:39:31', 25, NULL, NULL, NULL, NULL, NULL),
(68, 'Britanney Hines', 'britanney-hines', 'Hic consectetur atque voluptatem praesentium nisi voluptatem maiores quisquam rerum provident, nulla perspiciatis.', NULL, NULL, NULL, NULL, NULL, NULL, 2, '2015-08-03 12:28:27', NULL, NULL, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
