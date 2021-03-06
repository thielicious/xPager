CREATE DATABASE IF NOT EXISTS `news_blog` DEFAULT CHARSET=utf8;

CREATE TABLE `entries` (
  `id` int(101) NOT NULL AUTO_INCREMENT,
  `postdate` datetime DEFAULT NULL,
  `headline` varchar(51) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `entries` VALUES 
	(1,'2017-11-23 12:17:26','headline','content'),(2,'2017-11-23 12:18:05','headline0','content0'),
	(3,'2017-11-23 12:19:08','headline1','content1'),(4,'2017-11-23 12:19:20','headline2','content2'),
	(5,'2017-11-23 12:19:29','headline3','content3'),(6,'2017-11-23 12:19:39','headline4','content4'),
	(7,'2017-11-23 12:19:48','headline5','content5'),(8,'2017-11-23 12:20:02','headline6','content6'),
	(9,'2017-11-23 12:20:10','headline7','content7'),(10,'2017-11-23 12:20:21','headline8','content8'),
	(11,'2017-11-23 12:20:32','headline9','content9'),(12,'2017-11-23 12:20:41','headline10','content10'),
	(13,'2017-11-23 12:20:54','headline11','content11');