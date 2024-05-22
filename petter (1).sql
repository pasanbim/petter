-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 22, 2024 at 02:10 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petter`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(1000) NOT NULL,
  `time` varchar(200) NOT NULL,
  `user` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `time`, `user`) VALUES
(50, 'New Record Added Successfully', '2024-05-22 05:33 PM', 'pasantaxila@gmail.com'),
(49, 'Pet 123 Deleted Successfully', '2024-05-22 05:33 PM', 'pasantaxila@gmail.com'),
(48, 'New Record Added Successfully', '2024-05-22 05:32 PM', 'pasantaxila@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

DROP TABLE IF EXISTS `pets`;
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `breed` varchar(200) NOT NULL,
  `color` varchar(200) NOT NULL,
  `weight` varchar(200) NOT NULL,
  `birthday` varchar(200) NOT NULL,
  `sex` varchar(200) NOT NULL,
  `socialability` varchar(200) NOT NULL,
  `petImage` varchar(300) NOT NULL,
  `allergies` varchar(200) DEFAULT NULL,
  `user` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `name`, `type`, `breed`, `color`, `weight`, `birthday`, `sex`, `socialability`, `petImage`, `allergies`, `user`) VALUES
(124, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(125, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(126, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(128, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(129, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(131, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(132, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(133, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(134, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '11810e42a60082c92b58ecc0bb4a892b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(135, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(136, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(137, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(138, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(139, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(140, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(142, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(143, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(144, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(145, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(146, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(147, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(148, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '209bd1772597591b02d5a0432af8973f_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(149, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(150, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(151, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(152, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(153, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(154, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(155, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(156, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(157, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(158, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(159, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(160, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(161, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(162, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(163, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(164, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(165, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '4064a83733c466ed111064b24fe7c50b_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(166, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(167, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(168, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(169, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(170, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(171, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(172, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(173, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com'),
(174, 'Allen', 'dog', 'Lab', 'Brown', '21', '2020', 'male', 'social', '6373a2bcce64871dbadf787724bd5fdf_bg.jpg', 'Chicken,Beef', 'pasantaxila@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `petid` int(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `record` varchar(500) NOT NULL,
  `proof` varchar(500) DEFAULT NULL,
  `added_by` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `petid`, `type`, `record`, `proof`, `added_by`, `date`) VALUES
(1, 175, 'Vaccinations', 'sdsd', '', 'pasantaxila@gmail.com', '05/22/2024'),
(2, 121, 'Vaccinations', 'New vaccine', '70eb7e7cebb6c227f470cf86276ff4e8_bg.jpg', 'pasantaxila@gmail.com', '05/22/2024'),
(3, 124, 'Vaccinations', 'New record', 'da1ae0e30e61056fc21b2dc46cc83a52_amember-invoice-W0X35.pdf', 'pasantaxila@gmail.com', '05/22/2024'),
(4, 123, 'Allergies', 'sdsd sdsdsd', '', 'pasantaxila@gmail.com', '05/23/2024'),
(5, 175, 'Allergies', 'dvcvcv', '6b26684f8820698e4d8a0ae544e6653c_HANSANI MALKA ATH DATHWADUGE, ADT, 14MAY, CMB.pdf', 'pasantaxila@gmail.com', '05/22/2024'),
(6, 121, 'Vaccinations', 'dfdfdf', '', 'pasantaxila@gmail.com', '05/22/2024'),
(7, 121, 'Vaccinations', 'ghghh', '', 'pasantaxila@gmail.com', '05/22/2024'),
(8, 175, 'Vaccinations', 'ghghh', '', 'pasantaxila@gmail.com', '05/22/2024'),
(9, 121, 'Vaccinations', 'ghghh', '', 'pasantaxila@gmail.com', '05/22/2024'),
(10, 121, 'Vaccinations', 'ghghh', '', 'pasantaxila@gmail.com', '05/22/2024'),
(11, 121, 'Vaccinations', 'ghghh', '', 'pasantaxila@gmail.com', '05/22/2024'),
(12, 121, 'Vaccinations', 'dfdfdf', '', 'pasantaxila@gmail.com', '05/22/2024'),
(13, 121, 'Vaccinations', 'xcxc', '', 'pasantaxila@gmail.com', '05/22/2024'),
(14, 121, 'Vaccinations', 'xcxcxcxc', '', 'pasantaxila@gmail.com', '05/22/2024'),
(15, 121, 'Vaccinations', 'xcxcxcxc', '', 'pasantaxila@gmail.com', '05/22/2024'),
(16, 175, 'Vaccinations', 'cvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024'),
(17, 175, 'Vaccinations', 'dfdfdf', 'dea61797e9188f668cfae28913ceb1ac_kurahan-1.pdf', 'pasantaxila@gmail.com', '05/22/2024'),
(18, 122, 'Vaccinations', 'dfdfdf', '', 'pasantaxila@gmail.com', '05/22/2024'),
(19, 121, 'Vaccinations', 'hhhi', '', 'pasantaxila@gmail.com', '05/22/2024'),
(20, 122, 'Vaccinations', 'fdfdfdfdf', '', 'pasantaxila@gmail.com', '05/22/2024'),
(21, 123, 'Vaccinations', 'dfdfdf', '', 'pasantaxila@gmail.com', '05/22/2024'),
(22, 124, 'Vaccinations', 'vcvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024'),
(23, 124, 'Vaccinations', 'vcvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024'),
(24, 124, 'Vaccinations', 'vcvcvcvcv', '', 'vet', '05/22/2024'),
(25, 124, 'Vaccinations', 'vcvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024'),
(26, 124, 'Vaccinations', 'vcvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024'),
(27, 124, 'Vaccinations', 'vcvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024'),
(28, 124, 'Vaccinations', 'vcvcvcvcv', '', 'pasantaxila@gmail.com', '05/22/2024');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `latitude` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `latitude`, `longitude`, `password`) VALUES
(1, 'Pasan', 'pasantaxila@gmail.com', 'Samaja Sewa Mawatha, Sri Lanka', '6.729993299999999', '80.0395616', '$2y$10$BOWRPGhYu/FfVKFdPL6hi.Mc.86gQogIok9hmueV.6B.j2y7KTfni'),
(2, 'dfdf df', 'wuganape@finews.biz', '', '', '', '$2y$10$BOWRPGhYu/FfVKFdPL6hi.Mc.86gQogIok9hmueV.6B.j2y7KTfni'),
(3, 'Pasan Bimsara', 'user@mail.com', '', '', '', '$2y$10$9DZp9BlvhuCGjgxvs6JSh.XSYAjv7C3fgz/z5awFSWrsuVKMqdwi.'),
(4, 'sdsd', 'jjerrydewon21@gmail.com', '', '', '', '$2y$10$ckewOQTbJJWolthOGXLjxORlxl8kU15Xm48vqM56DMM9Ho3UN5SEe'),
(5, 'sdds', 'sdssd@gmail.com', '', '', '', '$2y$10$JrZsjxx6WKSvDZ80BXyEQekz/tm2XYzD8t67C/RuWb051E1gFHBqq'),
(6, 'xcxcxc', 'usedddr@mail.com', '', '', '', '$2y$10$PZShjb5dLuGt2E1pLOISX.ZnIA.9xBW1wodiAYfIhUI5Ezlw9su56'),
(7, 'DFDFDF', 'uddfdfser@mail.com', '', '', '', '$2y$10$n0Zqn0CI5y55GMEZ8b9yJe/x.lI6AbkFIyQw14PkbCDKxdvkNLoz2'),
(8, 'ddfdf', 'sdsdasasasaszsdsds@ddd.coma', 'Samaja Sewa Mawatha, Sri Lanka', '6.729993299999999', '80.0395616', '$2y$10$md5IMErHLAaSstTcnb4yX.enZ9xqPvoaKYTaewgDU5JRfCczJSOcW');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
