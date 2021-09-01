-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for api
CREATE DATABASE IF NOT EXISTS `api` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `api`;

-- Dumping structure for table api.hospital
CREATE TABLE IF NOT EXISTS `hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '0',
  `address` varchar(250) NOT NULL DEFAULT '0',
  `phone` varchar(60) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table api.hospital: ~3 rows (approximately)
/*!40000 ALTER TABLE `hospital` DISABLE KEYS */;
INSERT INTO `hospital` (`id`, `name`, `address`, `phone`) VALUES
	(1, 'Saint George', '1 Str. Sofia', '+359-888-123-456'),
	(2, 'Saint Anna', '2 Str. Plovdiv', '+359-888-654-321'),
	(4, 'St. Ivan22', '3 Str. Sofia2', '3332');
/*!40000 ALTER TABLE `hospital` ENABLE KEYS */;

-- Dumping structure for table api.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `type` tinyint(4) DEFAULT '0' COMMENT '0 if the user is doctor',
  `workplace_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table api.user: ~11 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `type`, `workplace_id`, `created_at`) VALUES
	(1, 'ivan.ivanov@hospital.com', 'Ivan', 'Ivanov', 1, 1, '2021-08-30 21:42:17'),
	(2, 'anna.angelova@human.com', 'Anna', 'Anglelova', 0, 0, '2021-08-30 21:42:58'),
	(5, 'marten.igov@human.com', 'Martin', 'Borisov', 0, 0, '2021-08-30 22:44:17'),
	(7, 'lara.fabian@human.be', 'Lara A.', 'Fabian', 0, 0, '2021-08-30 22:47:01'),
	(9, 'jenifer.zaro@doctor.be14', 'Jenn4', 'Zaro', 1, 4, '2021-08-31 23:42:51'),
	(10, 'jenifer.zaro@doctor.be1', 'Jenn1', 'Zaro', 1, 1, '2021-08-31 23:46:05'),
	(11, 'jenifer.zaro@doctor.be4', 'Jenn4', 'Zaro', 1, 2, '2021-08-31 23:46:26'),
	(12, 'jenifer.zaro@doctor.be2', 'Jenn2', 'Zaro', 1, 2, '2021-08-31 23:46:42'),
	(13, 'jenifer.zaro@doctor.be3', 'Jenn3', 'Zaro', 1, 1, '2021-08-31 23:46:52'),
	(15, 'not.doctor@human.ca', 'Not', 'Doctor', 0, NULL, '2021-09-02 00:00:19');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
