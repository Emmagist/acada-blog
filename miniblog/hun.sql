-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.14-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table hr_payroll.blog_comment
CREATE TABLE IF NOT EXISTS `blog_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `blog` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pdate` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `user_guid` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `entity_guid_2` (`entity_guid`) USING BTREE,
  KEY `entity_guid` (`entity_guid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Dumping data for table hr_payroll.blog_comment: ~0 rows (approximately)
/*!40000 ALTER TABLE `blog_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment` ENABLE KEYS */;

-- Dumping structure for table hr_payroll.blog_comment_reply
CREATE TABLE IF NOT EXISTS `blog_comment_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_guid` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `pdate` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `deleted` int(1) NOT NULL DEFAULT 0,
  `user_guid` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `entity_guid_2` (`entity_guid`) USING BTREE,
  KEY `entity_guid` (`entity_guid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- Dumping data for table hr_payroll.blog_comment_reply: ~0 rows (approximately)
/*!40000 ALTER TABLE `blog_comment_reply` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_comment_reply` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
