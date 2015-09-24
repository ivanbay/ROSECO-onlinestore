/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.32 : Database - ecommerce
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ecommerce` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ecommerce`;

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `client_ip` varchar(20) DEFAULT NULL,
  `userid` decimal(10,0) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `prod_name` varchar(50) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `delivered` enum('0','1') DEFAULT '0',
  `date_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `checked_out` enum('0','1') DEFAULT '0',
  `processed` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_cart_order` (`order_id`),
  CONSTRAINT `fk_cart_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

/*Data for the table `cart` */

insert  into `cart`(`id`,`order_id`,`client_ip`,`userid`,`prod_id`,`prod_name`,`price`,`qty`,`color`,`delivered`,`date_order`,`checked_out`,`processed`) values (52,23,NULL,1,25,'CG-2',1500,1,NULL,'0','2015-09-21 11:39:35','0','1'),(53,24,NULL,10,37,'HF-9102H',6000,1,NULL,'0','2015-09-21 21:47:26','0','1'),(54,24,NULL,10,41,'NA-107',4000,1,NULL,'0','2015-09-21 21:47:26','0','1'),(55,25,NULL,10,51,'HF-798',1500,10,NULL,'0','2015-09-21 21:50:02','0','1'),(56,25,NULL,10,41,'NA-107',4000,10,NULL,'0','2015-09-21 21:50:02','0','1'),(57,26,NULL,10,44,'TG-46',10000,1,NULL,'0','2015-09-21 21:51:40','0','1'),(58,26,NULL,10,48,'KG-88G',14000,1,NULL,'0','2015-09-21 21:51:40','0','1'),(59,27,NULL,10,25,'CG-2',1500,2,NULL,'0','2015-09-21 21:52:23','0','1'),(60,28,NULL,10,60,'HF-802D',3800,2,NULL,'0','2015-09-21 21:53:57','0','1'),(61,29,NULL,10,58,'HF-802GA',4500,2,NULL,'0','2015-09-21 21:54:58','0','1'),(62,29,NULL,10,43,'CF-10A',4500,2,NULL,'0','2015-09-21 21:54:58','0','1'),(63,30,NULL,10,34,'KS-12D',8000,1,NULL,'0','2015-09-21 21:55:54','0','1'),(64,30,NULL,10,35,'KS-15D',9000,2,NULL,'0','2015-09-21 21:55:54','0','1'),(65,31,NULL,12,28,'CN-3',3000,2,NULL,'0','2015-09-21 21:59:07','0','1'),(66,31,NULL,12,27,'CN-2',1500,2,NULL,'0','2015-09-21 21:59:07','0','1'),(67,32,NULL,12,27,'CN-2',1500,10,NULL,'0','2015-09-21 22:00:01','0','1'),(68,33,NULL,12,36,'KS-18D',10000,1,NULL,'0','2015-09-21 22:00:58','0','1'),(69,33,NULL,12,35,'KS-15D',9000,3,NULL,'0','2015-09-21 22:00:58','0','1'),(70,34,NULL,12,29,'AC-4B',5000,3,NULL,'0','2015-09-21 22:02:20','0','1'),(71,34,NULL,12,31,'AC-5S',4000,3,NULL,'0','2015-09-21 22:02:20','0','1'),(72,35,NULL,12,47,'KG-118G',18000,3,NULL,'0','2015-09-21 22:03:24','0','1'),(73,36,NULL,12,42,'NA-47',3000,1,NULL,'0','2015-09-21 22:03:57','0','1'),(74,37,NULL,12,37,'HF-9102H',6000,1,NULL,'0','2015-09-21 22:05:16','0','1'),(75,37,NULL,12,59,'HF-800G',2500,3,NULL,'0','2015-09-21 22:05:16','0','1'),(76,37,NULL,12,57,'HF-801SA',4500,3,NULL,'0','2015-09-21 22:05:16','0','1'),(77,38,NULL,12,57,'HF-801SA',4500,3,NULL,'0','2015-09-21 22:06:03','0','1'),(78,39,NULL,1,52,'HF-798F',2500,1,NULL,'0','2015-09-24 11:25:40','0','1'),(79,39,NULL,1,52,'HF-798F',2500,1,'brown','0','2015-09-24 11:25:40','0','1'),(80,39,NULL,1,37,'HF-9102H',6000,1,NULL,'0','2015-09-24 11:25:40','0','1');

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_name`) values (1,'Chair'),(2,'Office Table'),(3,'Cabinet'),(4,'Shelves'),(5,'Locker'),(6,'Desk');

/*Table structure for table `order_custom_parts` */

DROP TABLE IF EXISTS `order_custom_parts`;

CREATE TABLE `order_custom_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `part_id` int(11) DEFAULT NULL,
  `choice_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_custom_parts` (`order_id`),
  CONSTRAINT `fk_order_custom_parts` FOREIGN KEY (`order_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `order_custom_parts` */

insert  into `order_custom_parts`(`id`,`order_id`,`part_id`,`choice_id`) values (1,53,19,50),(2,53,20,53),(3,53,21,55),(4,74,19,50),(5,74,20,53),(6,74,21,54),(7,77,22,56);

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `lastname` varchar(30) DEFAULT NULL,
  `firstname` varchar(30) DEFAULT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `landline` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `house_no` varchar(10) DEFAULT NULL,
  `street` varchar(20) DEFAULT NULL,
  `brgy` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `date_ordered` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered` enum('0','1') DEFAULT '0',
  `status` varchar(20) DEFAULT 'New',
  `total` decimal(10,0) DEFAULT NULL,
  `cancelation_reason` char(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `orders` */

insert  into `orders`(`id`,`userid`,`username`,`lastname`,`firstname`,`middlename`,`mobile`,`landline`,`email`,`house_no`,`street`,`brgy`,`city`,`province`,`zip_code`,`delivery_date`,`date_ordered`,`delivered`,`status`,`total`,`cancelation_reason`) values (23,1,NULL,'Admin','Admin','','234','','asdf','213','asf',NULL,'asd','asdf','132','2001-11-20 15:00:00','2015-10-21 11:39:35','0','Deleted',1500,NULL),(24,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','Brgy 5','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2022-09-20 15:00:00','2015-09-21 21:47:26','0','Delivered',12250,NULL),(25,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','Brgy 5','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2023-10-20 15:00:00','2015-08-21 21:50:02','0','Approved',55000,NULL),(26,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','Brgy 5','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2025-09-20 15:00:00','2015-08-21 21:51:40','0','Delivered',24000,NULL),(27,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','Brgy 5','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2023-11-20 15:00:00','2015-09-21 21:52:23','0','Canceled',3000,'Wrong product'),(28,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','Brgy 5','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2026-10-20 15:00:00','2015-07-21 21:53:57','0','Canceled',7600,'Wrong input'),(29,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2024-09-20 15:00:00','2015-07-21 21:54:58','0','Delivered',18000,NULL),(30,10,NULL,'Customer','Customer','','0123456789','','sample@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2028-08-20 15:00:00','2015-09-21 21:55:54','0','New',26000,NULL),(31,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2030-09-20 15:00:00','2015-08-21 21:59:07','0','Approved',9000,NULL),(32,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2012-09-20 15:00:00','2015-10-21 22:00:01','0','Canceled',15000,'Incorrect'),(33,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2030-09-20 15:00:00','2015-05-21 22:00:58','0','New',37000,NULL),(34,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2030-09-20 15:00:00','2015-08-21 22:02:20','0','Disapproved',27000,NULL),(35,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2001-10-20 15:00:00','2015-08-21 22:03:24','0','New',54000,NULL),(36,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2002-10-20 15:00:00','2015-09-21 22:03:57','0','Canceled',3000,'Incorrect'),(37,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2003-10-20 15:00:00','2015-09-21 22:05:15','0','Approved',29250,NULL),(38,12,NULL,'User','User','','0123456789','','user@gmail.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2012-11-20 15:00:00','2015-09-21 22:06:03','0','Disapproved',14500,NULL),(39,1,NULL,'Admin','Admin','','0123456789','','aiiphaul_05@yahoo.com','123','A. Mabini St.',NULL,'Amadeo','Cavite','4119','2030-09-20 15:00:00','2015-09-24 11:25:40','0','New',11000,NULL);

/*Table structure for table `parts_choices` */

DROP TABLE IF EXISTS `parts_choices`;

CREATE TABLE `parts_choices` (
  `choice_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `choices_filename` char(50) DEFAULT NULL,
  `choice_name` varchar(20) DEFAULT NULL,
  `choice_cost` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`choice_id`),
  KEY `fk_parts_choice` (`part_id`),
  CONSTRAINT `fk_parts_choice` FOREIGN KEY (`part_id`) REFERENCES `product_parts` (`part_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `parts_choices` */

insert  into `parts_choices`(`choice_id`,`part_id`,`choices_filename`,`choice_name`,`choice_cost`) values (50,19,'37_19_1.png','Arm 1',500),(51,19,'37_19_2.png','Arm 2',500),(52,20,'37_20_1.png','Back 1',600),(53,20,'37_20_2.png','Back 2',750),(54,21,'37_21_1.png','Base 1',1000),(55,21,'37_21_2.png','Base 2',1000),(56,22,'57_22_1.png','Base 1',1000),(57,22,'57_22_2.png','Base 2',1000);

/*Table structure for table `product_img` */

DROP TABLE IF EXISTS `product_img`;

CREATE TABLE `product_img` (
  `product_id` int(11) DEFAULT NULL,
  `filename` varchar(20) DEFAULT NULL,
  `orig_filename` varchar(20) DEFAULT NULL,
  `extension` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product_img` */

insert  into `product_img`(`product_id`,`filename`,`orig_filename`,`extension`) values (7,'7_1.png','hf-9102h','png'),(7,'7_2.png','hf-9102h_2','png'),(6,'6_3.png','hf-9102h_2','png'),(6,'6_4.png','hf-9102h_2','png'),(12,'12_1.png','backrest_1','png'),(12,'12_2.png','backrest_2','png'),(11,'11_1.png','backrest_1','png'),(11,'11_2.png','backrest_2','png'),(11,'11_3.png','chairbase_2','png'),(16,'16_1.png','chairbase_1','png'),(16,'16_2.png','backrest_1','png'),(17,'17_1.png','hf-9102h_2','png'),(17,'17_2.png','hf-9102h','png'),(18,'18_1.png','hf-9102h_2','png'),(18,'18_2.png','hf-9102h','png'),(19,'19_1.png','hf-9102h_2','png'),(19,'19_2.png','hf-9102h','png'),(20,'20_1.png','hf-9102h_2','png'),(20,'20_2.png','hf-9102h','png'),(21,'21_1.png','hf-9102h_2','png'),(21,'21_2.png','hf-9102h','png'),(22,'22_1.png','hf-9102h_2','png'),(22,'22_2.png','hf-9102h','png'),(23,'23_1.png','hf-9102h_2','png'),(23,'23_2.png','hf-9102h','png'),(24,'24_1.png','hf-9102h','png'),(25,'25_1.PNG','cg-2','PNG'),(26,'26_1.PNG','cg-3','PNG'),(27,'27_1.PNG','cn-2','PNG'),(28,'28_1.PNG','cn-3','PNG'),(29,'29_1.PNG','ac-4b','PNG'),(30,'30_1.PNG','ac-4b','PNG'),(31,'31_1.PNG','ac-5s','PNG'),(32,'32_1.PNG','ks-6d','PNG'),(33,'33_1.PNG','ks-9d','PNG'),(34,'34_1.PNG','ks-12d','PNG'),(35,'35_1.PNG','ks-15d','PNG'),(36,'36_1.PNG','ks-18d','PNG'),(37,'37_1.png','hf-9102h','png'),(37,'37_2.png','hf-9102h_2','png'),(38,'38_1.PNG','na-167','PNG'),(39,'39_1.png','na-147','png'),(40,'40_1.png','na-127','png'),(42,'42_1.png','na-47','png'),(43,'43_1.png','cf-10a','png'),(41,'41_1.png','na-107','png'),(44,'44_1.PNG','tg-46','PNG'),(45,'45_1.PNG','b46-21d','PNG'),(46,'46_1.PNG','tg-36','PNG'),(47,'47_1.PNG','kg-118g','PNG'),(48,'48_1.PNG','kg-88g','PNG'),(49,'49_1.PNG','kg-88b','PNG'),(50,'50_1.png','hf-805va','png'),(51,'51_1.png','hf-798','png'),(52,'52_1.png','hf-798f','png'),(53,'53_1.png','hf-807la','png'),(54,'54_1.png','hf-798tb','png'),(55,'55_1.png','hf-799g','png'),(56,'56_1.png','hf-799d','png'),(57,'57_1.png','hf-801sa','png'),(58,'58_1.png','hf-802ga','png'),(59,'59_1.png','hf-800g','png'),(60,'60_1.png','hf-802d','png');

/*Table structure for table `product_parts` */

DROP TABLE IF EXISTS `product_parts`;

CREATE TABLE `product_parts` (
  `part_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `part_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`part_id`),
  KEY `fk_products_id` (`prod_id`),
  CONSTRAINT `fk_products_id` FOREIGN KEY (`prod_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `product_parts` */

insert  into `product_parts`(`part_id`,`prod_id`,`part_name`) values (19,37,'Armrest'),(20,37,'Backrest'),(21,37,'Chairbase'),(22,57,'Chairbase');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `description` char(100) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `dimensions` varchar(50) DEFAULT NULL,
  `cost` decimal(10,0) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `colors` varchar(150) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `customizable` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`product_id`,`name`,`description`,`category`,`dimensions`,`cost`,`stock`,`colors`,`status`,`customizable`) values (25,'CG-2','',4,'900w x 450d x 740h',1500,20,NULL,'1','0'),(26,'CG-3','',4,'900w x 450d x 1062h',3000,20,NULL,'1','0'),(27,'CN-2','',4,'900w x 450d x 740h',1500,20,NULL,'1','0'),(28,'CN-3','',4,'900w x 450d x 1062h',3000,20,NULL,'1','0'),(29,'AC-4B','2 drawers + 3 shelves',5,'900w x 450d x 1802h',5000,20,NULL,'1','0'),(30,'AC-4B','2 drawers + 3 shelves',5,'900w x 450d x 1802h',5000,20,NULL,'1','0'),(31,'AC-5S','5 Shelves',5,'900w x 450d x 1802h',4000,20,NULL,'1','0'),(32,'KS-6D','',5,'880w x 510d x 1780h',6000,20,NULL,'1','0'),(33,'KS-9D','',5,'880w x 510d x 1780h',7000,20,NULL,'1','0'),(34,'KS-12D','',5,'880w x 510d x 1780h',8000,20,NULL,'1','0'),(35,'KS-15D','',5,'880w x 510d x 1780h',9000,20,NULL,'1','0'),(36,'KS-18D','',5,'880w x 510d x 1780h',10000,20,NULL,'1','0'),(37,'HF-9102H','Office chair',1,'570w x 450d x 770h',6000,20,NULL,'1','1'),(38,'NA-167','',6,'1600w x 700d x 740h',7000,20,NULL,'1','0'),(39,'NA-147','',6,'1400w x 700d x 740h',6000,20,NULL,'1','0'),(40,'NA-127','',6,'1200w x 700d x 740h',5000,20,NULL,'1','0'),(41,'NA-107','',6,'1100w x 700d x 740h',4000,20,NULL,'1','0'),(42,'NA-47','',6,'450w x 700d x 740h',3000,20,NULL,'1','0'),(43,'CF-10A','',6,'1200w x 700d x 740h',4500,20,NULL,'1','0'),(44,'TG-46','4ft glass sliding door',3,'1180w x 400d x 880h',10000,20,NULL,'1','0'),(45,'B46-21D','4ft 21 drawers',3,'1180w x 400d x 880h',16000,20,NULL,'1','0'),(46,'TG-36','3ft glass sliding doors',3,'880w x 400d x 880h',10000,20,NULL,'1','0'),(47,'KG-118G','4ft full glass sliding door',3,'1180w x 400d x 880h',18000,20,NULL,'1','0'),(48,'KG-88G','3ft glass sliding doors',3,'880w x 400d x 880h',14000,20,NULL,'1','0'),(49,'KG-88B','3ft glass sliding + swing',3,'880w x 400d x 880h',15000,20,NULL,'1','0'),(50,'HF-805VA','Office chair',1,'560w x 450d x 795h',2500,20,NULL,'1','0'),(51,'HF-798','',1,'470w x 435d x 795h',1500,20,NULL,'1','0'),(52,'HF-798F','',1,'470w x 435d x 795h',2500,20,'Red;brown','1','0'),(53,'HF-807LA','',1,'580w x 450d x 890h',4500,20,NULL,'1','0'),(54,'HF-798TB','',1,'560w x 450d x 795h',4000,20,NULL,'1','0'),(55,'HF-799G','',1,'360w x 360d x 380~490h',2500,20,NULL,'1','0'),(56,'HF-799D','',1,'360w x 360d x 380~490h',3000,20,NULL,'1','0'),(57,'HF-801SA','',1,'510w x 390d x 785~840h',4500,20,NULL,'1','1'),(58,'HF-802GA','',1,'535w x 415d x820~935h',4500,20,NULL,'1','0'),(59,'HF-800G','',1,'445w x 415d x 845~955h',2500,20,NULL,'1','0'),(60,'HF-802D','',1,'445w x 415d x 845~955h',3800,20,NULL,'1','0');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_role` enum('0','1') DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` text,
  `activation_token` varchar(50) DEFAULT NULL,
  `activated` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`user_role`,`created_at`,`updated_at`,`remember_token`,`activation_token`,`activated`) values (1,'admin','$2y$10$Ibhtt0E/g5DI/jnfmghJluS16DJgoBFPfEw/Zh5rClcaZixUpogXG','1',NULL,'2015-09-21 21:45:21','zzCWOiukpPALYsEifopxrBjvcdZRKQIPHty9M1GSdRHXICZlELlfBNONnNcw',NULL,'1'),(10,'customer','$2y$10$xx7kpiCg4IliO3GOHOFxoeCi8JnYTYwgiJZioN3v1BVz2jWzCbTEe',NULL,NULL,'2015-09-21 21:57:03','flp1YHV26lxUoBSjZV0jwpOWGtMZdMzvg6xZtrLKJqfkMamBnLfpgo9gTulN','3807f60d8839704bfc3d938a19203221','1'),(12,'user','$2y$10$T8tyHRIwBdjUHRjuFTaEK.g95gzyVZXcDrpIrhrLxigBq60W0uz6u',NULL,NULL,'2015-09-21 22:07:59','YS5xhjHcKonuREJgfHeuR8tejzcS4J3DX1AAIKT5NEeleXYhPCEdJjUwv9FE','ef86a2676f1a99f88b878dda3f0864da','1');

/*Table structure for table `users_info` */

DROP TABLE IF EXISTS `users_info`;

CREATE TABLE `users_info` (
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `mname` varchar(20) DEFAULT NULL,
  `lname` varchar(20) DEFAULT NULL,
  `address` text,
  `send_newsletter` enum('0','1') DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users_info` */

insert  into `users_info`(`user_id`,`email`,`fname`,`mname`,`lname`,`address`,`send_newsletter`,`created_at`,`updated_at`) values (1,NULL,'admin','admin','admin','Amadeo, Cavite',NULL,'2015-08-29 20:34:42','0000-00-00 00:00:00'),(10,'sample@gmail.com','customer','customer','customer',NULL,'0','2015-09-21 21:49:01','0000-00-00 00:00:00'),(12,'user@gmail.com','user','user','user',NULL,'0','2015-09-21 21:57:29','0000-00-00 00:00:00');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
