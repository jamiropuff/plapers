# Host: localhost  (Version 5.5.5-10.4.25-MariaDB)
# Date: 2024-09-24 22:07:39
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "cat_roles"
#

DROP TABLE IF EXISTS `cat_roles`;
CREATE TABLE `cat_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

#
# Data for table "cat_roles"
#

INSERT INTO `cat_roles` VALUES (1,'admin',0,'2024-09-06 10:01:49','2024-09-06 10:01:55'),(2,'user',0,'2024-09-06 10:01:53','2024-09-06 10:01:53');
