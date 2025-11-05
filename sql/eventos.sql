# Host: localhost  (Version 5.5.5-10.4.25-MariaDB)
# Date: 2024-12-08 21:54:00
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "eventos"
#

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(255) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `archivo_presencial` varchar(255) DEFAULT NULL,
  `archivo_zoom` varchar(255) DEFAULT NULL,
  `orden` int(3) DEFAULT NULL,
  `is_deleted` int(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

#
# Data for table "eventos"
#

INSERT INTO `eventos` VALUES (1,'post_560_3er_congreso_internacional_de_derecho_imesp_2024.png','3er. Congreso Internacional de Derecho, IMESP 2024','2024-12-07','2024-12-08','Programa_presencial_3er_Congreso_Ineternacional_Derecho.pdf','Programa_zoom_3er_Congreso_Ineternacional_Derecho.pdf',1,0,'2024-12-07 09:23:48','2024-12-08 19:31:56'),(16,'posts_x_congreso_internacional_de_pti_impo_2024.png','X Congreso de Psicoterapia Transpersonal, IMPo 2024','2024-12-13','2024-12-14','Programa_presencial_X_Congreso_Psicoterapia_Transpersonal_2024.pdf','Programa_zoom_X_Congreso_Psicoterapia_Transpersonal_2024_compressed.pdf',2,0,'2024-12-08 00:21:42','2024-12-08 20:02:22');
