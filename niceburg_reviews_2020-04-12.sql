# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.29)
# Database: niceburg_reviews
# Generation Time: 2020-04-12 14:42:18 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table reviews
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `burger_name` varchar(200) NOT NULL DEFAULT '',
  `restaurant` varchar(200) NOT NULL DEFAULT '',
  `visit_date` date NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT './images/burger_empty.png',
  `price` float unsigned NOT NULL,
  `patty_rating` float unsigned NOT NULL,
  `topping_rating` float unsigned NOT NULL,
  `sides_rating` float unsigned NOT NULL,
  `value_rating` float unsigned NOT NULL,
  `total_score` float unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;

INSERT INTO `reviews` (`id`, `burger_name`, `restaurant`, `visit_date`, `image`, `price`, `patty_rating`, `topping_rating`, `sides_rating`, `value_rating`, `total_score`, `deleted`)
VALUES
	(1,'Smokey \'Bro\' Burger','Three Brothers Bristol','2020-02-01','./images/smoky-bro1-725x479.jpg',8.5,4,4.5,3,3.5,3.8,0),
	(2,'Cheeseburger','Five Guys Bristol','2019-11-15','./images/IMG_0518.jpg',7.95,2,3.5,3,4,3.2,0),
	(3,'Dirty Burger','Dirty Burger and Chicken Shop Whitechapel','2016-05-08','./images/dirty_burger.png',6,5,4,3.5,4.5,4.3,0),
	(4,'Jake &amp Elwood','Atomic Burger Bristol','2018-10-04','./images/jake_el_atomic.png',10.75,4,4.5,4,3,3.9,0),
	(5,'Double Cheeseburger','McDonalds Cribbs Causeway','2019-06-21','./images/mcd_doublecheese.png',1.49,1,2,2.5,4,2.4,0),
	(6,'Bacon Double Cheeseburger','Burger King','2018-09-30','./images/bk_bacondoublecheese.jpg',3.99,3,3,3,4,3.3,0),
	(23,'Manhattan Cheese Burger','Manhattan Burger Bar','2020-02-01','./images/burger_empty.png',5.8,3.5,2,3,5,3.4,0);

/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
