CREATE DATABASE `323activity` /*!40100 DEFAULT CHARACTER SET utf8 */;

CREATE TABLE `profile` (
  `idprofile` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` varchar(45) NOT NULL,
  `bio` varchar(255) NOT NULL DEFAULT 'Nothing yet!',
  PRIMARY KEY (`idprofile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `albumtitle` varchar(45) DEFAULT NULL,
  `songtitle` varchar(45) DEFAULT NULL,
  `posttime` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '0',
  `artist` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `dob` date DEFAULT NULL,
  `role` int(11) DEFAULT '0',
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
