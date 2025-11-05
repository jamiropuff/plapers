# Host: localhost  (Version 5.5.5-10.4.25-MariaDB)
# Date: 2024-09-24 22:06:51
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT 2,
  `usuario` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES (1,1,'admin','admin@impo.org.mx','$2y$10$RdNUU/v5QOsp.u5W2R.eieJ8RFHnVhDlYlqZzOc.LmLr1jNaWqOf.',0,'2024-09-06 16:13:47','2024-09-09 20:01:46');
