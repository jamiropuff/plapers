# Host: localhost  (Version 5.5.5-10.4.32-MariaDB)
# Date: 2024-03-31 19:28:02
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "prospectos"
#

DROP TABLE IF EXISTS `prospectos`;
CREATE TABLE `prospectos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(255) DEFAULT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `plantel` varchar(100) DEFAULT NULL,
  `interes` varchar(255) DEFAULT NULL,
  `medio_entero` varchar(50) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_add` timestamp NULL DEFAULT current_timestamp(),
  `fecha_upd` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

#
# Data for table "prospectos"
#

