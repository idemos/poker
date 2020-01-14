-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              5.6.16-1~exp1 - (Ubuntu)
-- S.O. server:                  debian-linux-gnu
-- HeidiSQL Versione:            9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database poker
CREATE DATABASE IF NOT EXISTS `poker` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `poker`;

-- Dump della struttura di tabella poker.hands
CREATE TABLE IF NOT EXISTS `hands` (
  `id_challenge` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user_1` int(10) unsigned NOT NULL,
  `card_1` char(2) DEFAULT NULL,
  `card_2` char(2) DEFAULT NULL,
  `card_3` char(2) DEFAULT NULL,
  `card_4` char(2) DEFAULT NULL,
  `card_5` char(2) DEFAULT NULL,
  `hand_1` varchar(50) DEFAULT NULL,
  `id_user_2` int(10) unsigned NOT NULL,
  `card_6` char(2) DEFAULT NULL,
  `card_7` char(2) DEFAULT NULL,
  `card_8` char(2) DEFAULT NULL,
  `card_9` char(2) DEFAULT NULL,
  `card_10` char(2) DEFAULT NULL,
  `hand_2` varchar(50) DEFAULT NULL,
  `id_user_win` int(10) unsigned DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_challenge`),
  KEY `id_user_1` (`id_user_1`),
  KEY `id_user_2` (`id_user_2`)
) ENGINE=InnoDB AUTO_INCREMENT=1001 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella poker.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- L’esportazione dei dati non era selezionata.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
