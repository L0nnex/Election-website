-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2025 at 05:48 PM
-- Server version: 9.1.0
-- PHP Version: 8.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elections_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(80) NOT NULL,
  `password_sha1` char(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_sha1`) VALUES
(1, 'elections_admin', '65ee24e7dd7e027356deffcd0f4213563f303378');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

DROP TABLE IF EXISTS `candidates`;
CREATE TABLE IF NOT EXISTS `candidates` (
  `candidate_id` int NOT NULL AUTO_INCREMENT,
  `candidate_name` varchar(100) NOT NULL,
  `Date_Of_Birth` varchar(20) DEFAULT NULL,
  `sect` varchar(50) DEFAULT NULL,
  `list_id` int NOT NULL,
  `photo_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`candidate_id`),
  KEY `fk_candidates_list` (`list_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `candidate_name`, `Date_Of_Birth`, `sect`, `list_id`, `photo_filename`) VALUES
(19, 'Hassan Nasrallah', '8/31/1960', 'Shia', 11, 'Hassan Nasrallah.jpeg\r\n'),
(18, 'Rami Daher', '5/25/1977', 'Maronite', 10, 'Rami Daher.jpeg\r\n'),
(17, 'Elie Gemayel', '11/4/1983', 'Maronite', 9, 'Elie Gemayel.jpeg\r\n'),
(16, 'Georges Haddad', '8/18/1987', 'Maronite', 9, 'Georges Haddad.jpeg\r\n'),
(15, 'Joseph Tannous', '2/3/1982', 'Maronite', 8, 'Joseph Tannous.jpeg\r\n'),
(14, 'Marie Karam', '9/30/1990', 'Maronite', 7, 'Marie Karam.jpeg\r\n'),
(13, 'Tony Frangieh', '7/19/1985', 'Maronite', 7, 'Tony Frangieh.jpeg\r\n'),
(12, 'Karim Othman', '12/5/1979', 'Alawite', 6, 'Karim Othman.jpeg\r\n'),
(11, 'Hassan Youssef', '10/14/1984', 'Sunni', 6, 'Hassan Youssef.jpeg\r\n'),
(10, 'Leila Saadeh', '4/22/1991', 'Greek Orthodox', 5, 'Leila Saadeh.jpeg\r\n'),
(9, 'Samir Fakhoury', '6/2/1978', 'Sunni', 5, 'Samir Fakhoury.jpeg\r\n'),
(8, 'Elie Rahme', '9/29/1981', 'Maronite', 4, 'Elie Rahme.jpeg\r\n'),
(7, 'Ahmad Mansour', '1/17/1990', 'Sunni', 4, 'Ahmad Mansour.jpeg\r\n'),
(4, 'Tarek Itani', '7/7/1982', 'Sunni', 2, 'Tarek Itani.jpeg\r\n'),
(5, 'Khaled Daher', '11/11/1973', 'Sunni', 3, 'Khaled Daher.jpeg\r\n'),
(6, 'Maria Nassar', '3/5/1986', 'Greek Orthodox', 3, 'Maria Nassar.jpeg\r\n'),
(3, 'Rita Haddad', '2/14/1988', 'Greek Orthodox', 2, 'Rita Haddad.jpeg\r\n'),
(2, 'Nadim Khoury', '9/23/1975', 'Maronite', 1, 'Nadim Khoury.jpeg\r\n'),
(1, 'Ali Hassan', '5/12/1980', 'Sunni', 1, 'Ali Hassan.jpeg\r\n'),
(20, 'Ali Jaafar', '3/11/1985', 'Shia', 11, 'Ali Jaafar.jpeg\r\n'),
(21, 'Mohammad Fadlallah', '1/22/1979', 'Shia', 12, 'Mohammad Fadlallah.jpeg\r\n'),
(22, 'Hussein Abbas', '9/9/1992', 'Shia', 12, 'Hussein Abbas.jpeg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
CREATE TABLE IF NOT EXISTS `lists` (
  `list_id` int NOT NULL AUTO_INCREMENT,
  `list_name` varchar(100) NOT NULL,
  `quaza_id` int NOT NULL,
  `logo_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`list_id`),
  KEY `fk_lists_quaza` (`quaza_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`list_id`, `list_name`, `quaza_id`, `logo_filename`) VALUES
(8, 'Unity in Faith', 4, 'Unity in Faith.png'),
(7, 'Zgharta Strong', 4, 'Zgharta Strong.png'),
(3, 'Akkar for Progress', 2, 'Akkar for Progress.jpeg'),
(2, 'Citizens for Change', 1, 'CitizensForChange.png'),
(12, 'Development & Loyalty', 6, 'Development & Loyalty.png'),
(11, 'Baalbek Resistance', 6, 'Baalbek Resistance.jpeg'),
(10, 'Heritage & Hope', 5, 'Heritage & Hope.jpeg'),
(9, 'Bsharre First', 5, 'Bsharre First.png'),
(6, 'Together for Tripoli', 3, 'Together for Tripoli.png'),
(5, 'Tripoli Renewal', 3, 'Tripoli Renewal.jpeg'),
(4, 'People\'s Voice', 2, 'People\'s Voice.png'),
(1, 'Beirut Unity', 1, 'Beirut Unity.png');

-- --------------------------------------------------------

--
-- Table structure for table `quazas`
--

DROP TABLE IF EXISTS `quazas`;
CREATE TABLE IF NOT EXISTS `quazas` (
  `quaza_id` int NOT NULL AUTO_INCREMENT,
  `quaza_name` varchar(100) NOT NULL,
  `image_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`quaza_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `quazas`
--

INSERT INTO `quazas` (`quaza_id`, `quaza_name`, `image_filename`) VALUES
(6, 'Baalbek', 'Baalbek.jpeg'),
(5, 'Bsharre', 'bsharre.jpeg'),
(4, 'Zgharta', 'zgharta.jpeg'),
(3, 'Tripoli', 'tripoli-liban_416.jpg'),
(1, 'Beirut', 'beirut.jpeg'),
(2, 'Akkar', 'akkar.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
