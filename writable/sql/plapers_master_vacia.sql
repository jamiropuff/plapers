-- PLAPERS - Esquema y catálogos maestros
-- Compatible con MySQL/MariaDB; importar seleccionando antes la base de datos destino.
-- Incluye estructura completa y catálogos públicos; no incluye datos personales ni transacciones.
SET NAMES utf8mb4;

-- VARIANTE: base vacía. Crear primero la base de datos y luego importar este archivo.
-- Crea las 33 tablas, agrega catálogos públicos y crea el usuario admin inicial.

CREATE TABLE IF NOT EXISTS `plap_cat_boletin` (
  `id_boletin` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(150) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_add` date DEFAULT NULL,
  PRIMARY KEY (`id_boletin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_caracteres` (
  `id_caracter` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL DEFAULT 0,
  `id_subcategoria` int(11) NOT NULL DEFAULT 0,
  `id_fuente` int(11) NOT NULL DEFAULT 0,
  `caracteres` int(5) NOT NULL DEFAULT 0,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_caracter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categoria` varchar(100) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_colores` (
  `id_color` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(20) DEFAULT NULL,
  `hex` varchar(10) DEFAULT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_cuenta_deposito` (
  `id_cuenta_deposito` int(11) NOT NULL AUTO_INCREMENT,
  `cuenta` varchar(50) DEFAULT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `banco` varchar(150) DEFAULT NULL,
  `beneficiario` varchar(200) DEFAULT NULL,
  `clabe` varchar(18) DEFAULT NULL,
  `tarjeta_debito` varchar(16) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_cuenta_deposito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_datos_facturacion` (
  `id_facturacion` int(11) NOT NULL AUTO_INCREMENT,
  `razon_social` varchar(100) DEFAULT NULL,
  `rfc` varchar(50) NOT NULL DEFAULT '0',
  `curp` varchar(50) NOT NULL DEFAULT '0',
  `calle` varchar(300) NOT NULL DEFAULT '0',
  `numero` varchar(300) NOT NULL DEFAULT '0',
  `interior` varchar(300) NOT NULL DEFAULT '0',
  `colonia` varchar(50) NOT NULL DEFAULT '0',
  `municipio` varchar(50) NOT NULL DEFAULT '0',
  `estado` int(11) DEFAULT NULL,
  `codigo_postal` varchar(10) NOT NULL DEFAULT '0',
  `pais` int(11) NOT NULL DEFAULT 0,
  `nombres` varchar(50) NOT NULL DEFAULT '0',
  `paterno` varchar(50) NOT NULL DEFAULT '0',
  `materno` varchar(50) NOT NULL DEFAULT '0',
  `uso` varchar(50) NOT NULL DEFAULT '0',
  `tipo_persona` tinyint(4) NOT NULL DEFAULT 1,
  `id_user` int(11) DEFAULT NULL,
  `documento_situacion_fiscal` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_facturacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_descuentos` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `rango_inicio` int(5) DEFAULT NULL,
  `rango_fin` int(5) DEFAULT NULL,
  `precio` double(20,2) DEFAULT NULL,
  `descuento` int(3) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `precio_final` double(20,2) DEFAULT NULL,
  PRIMARY KEY (`id_descuento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_direcciones` (
  `id_direccion` int(11) NOT NULL AUTO_INCREMENT,
  `recibe` varchar(100) NOT NULL DEFAULT '0',
  `calle` varchar(100) NOT NULL DEFAULT '0',
  `numero` varchar(20) NOT NULL DEFAULT '0',
  `interior` varchar(20) NOT NULL DEFAULT '0',
  `colonia` varchar(50) NOT NULL DEFAULT '0',
  `municipio` varchar(50) NOT NULL DEFAULT '0',
  `estado` int(11) DEFAULT NULL,
  `codigo_postal` varchar(20) NOT NULL DEFAULT '0',
  `telefono` varchar(20) NOT NULL,
  `referencia` varchar(100) NOT NULL DEFAULT '0',
  `notas_adicionales` varchar(100) NOT NULL DEFAULT '0',
  `pais` int(11) NOT NULL DEFAULT 0,
  `id_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_direccion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_estados` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_estatus_pago` (
  `id_estatus_pago` int(11) NOT NULL AUTO_INCREMENT,
  `estatus_pago` varchar(100) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_estatus_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_estatus_pedido` (
  `id_estatus_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_envio` int(11) DEFAULT NULL,
  `estatus_pedido` varchar(100) DEFAULT NULL,
  `nottifica_cliente` int(1) NOT NULL DEFAULT 0,
  `notifica_admin` int(1) NOT NULL DEFAULT 0,
  `texto_correo` text DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_estatus_pedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_fuentes` (
  `id_fuente` int(11) NOT NULL AUTO_INCREMENT,
  `fuente` varchar(50) NOT NULL DEFAULT '',
  `nom_fuente` varchar(100) DEFAULT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_fuente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_medidas` (
  `id_medida` int(11) NOT NULL AUTO_INCREMENT,
  `largo` double(4,1) NOT NULL DEFAULT 0.0,
  `ancho` double(4,1) NOT NULL DEFAULT 0.0,
  `unidad` varchar(20) DEFAULT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_medida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_pais` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_posiciones` (
  `id_posicion` int(11) NOT NULL AUTO_INCREMENT,
  `numero_posicion` int(4) DEFAULT NULL,
  `id_renglon` int(11) NOT NULL DEFAULT 0,
  `id_fuente_linea1` varchar(10) NOT NULL DEFAULT '0',
  `id_fuente_linea2` varchar(10) NOT NULL DEFAULT '0',
  `id_fuente_linea3` varchar(10) NOT NULL DEFAULT '0',
  `caracter1` varchar(10) DEFAULT NULL,
  `caracter2` varchar(10) DEFAULT NULL,
  `caracter3` varchar(10) DEFAULT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_posicion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL DEFAULT 0,
  `id_subcategoria` int(11) NOT NULL DEFAULT 0,
  `clave` varchar(150) DEFAULT NULL,
  `nom_producto` varchar(100) DEFAULT '0',
  `descripcion` mediumtext DEFAULT NULL,
  `id_medida` int(11) NOT NULL DEFAULT 0,
  `id_terminado` varchar(10) NOT NULL DEFAULT '0',
  `id_renglon` int(11) NOT NULL DEFAULT 0,
  `id_caracter` varchar(10) NOT NULL DEFAULT '0',
  `id_signo` varchar(10) NOT NULL DEFAULT '0',
  `id_color` varchar(25) NOT NULL DEFAULT '0',
  `id_posicion` varchar(20) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `ejemplo` varchar(100) DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1,
  `precio_unitario` float(11,2) unsigned DEFAULT NULL,
  `new` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_producto`),
  KEY `FK_tc_cat_productos_tc_cat_categorias` (`id_categoria`),
  CONSTRAINT `FK_tc_cat_productos_tc_cat_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `plap_cat_categorias` (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_renglones` (
  `id_renglon` int(11) NOT NULL AUTO_INCREMENT,
  `numero_renglones` int(4) NOT NULL DEFAULT 0,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_renglon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_roles` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `nom_rol` varchar(50) NOT NULL DEFAULT '0',
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_signos` (
  `id_signo` int(11) NOT NULL AUTO_INCREMENT,
  `nom_signo` varchar(30) DEFAULT NULL,
  `signo` varchar(10) DEFAULT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_signo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_subcategorias` (
  `id_subcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) NOT NULL,
  `nom_subcategoria` varchar(100) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_subcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_terminado` (
  `id_terminado` int(11) NOT NULL AUTO_INCREMENT,
  `nom_terminado` varchar(70) DEFAULT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_terminado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_tipo_envio` (
  `id_tipo_envio` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_envio` varchar(100) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_envio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_tipo_pago` (
  `id_tipo_pago` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_pago` varchar(100) DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_tipo_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_usuario` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_cat_uso_cfdi` (
  `id_uso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_uso` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_uso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_galeria` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT NULL,
  `id_subcategoria` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_galeria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_info_usuarios` (
  `id_info` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `nombres` varchar(200) NOT NULL,
  `paterno` varchar(100) NOT NULL DEFAULT '',
  `materno` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_info`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_inventarios` (
  `id_inventario` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` float(11,2) unsigned NOT NULL DEFAULT 0.00,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_inventario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_orden` (
  `id_orden` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_tipo_pago` int(11) DEFAULT NULL,
  `id_tipo_envio` int(11) DEFAULT NULL,
  `id_estatus_pago` int(11) DEFAULT NULL,
  `id_estatus_pedido` int(11) DEFAULT NULL,
  `subtotal` double(10,2) DEFAULT NULL,
  `iva` double(10,2) DEFAULT NULL,
  `envio` double(10,2) DEFAULT NULL,
  `total` double(15,2) DEFAULT NULL,
  `id_direccion` int(11) DEFAULT NULL,
  `id_facturacion` int(11) DEFAULT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `id_usuario_produccion` int(11) DEFAULT NULL,
  `fecha_produccion` datetime DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `id_usuario_fabricado` int(11) DEFAULT NULL,
  `fecha_fabricado` datetime DEFAULT NULL,
  `id_usuario_enviado` int(11) DEFAULT NULL,
  `fecha_enviado` datetime DEFAULT NULL,
  `id_usuario_finalizado` int(11) DEFAULT NULL,
  `fecha_completo` datetime DEFAULT NULL,
  `id_usuario_pagado` int(11) DEFAULT NULL,
  `fecha_pagado` datetime DEFAULT NULL,
  `id_usuario_cancelado` int(11) DEFAULT NULL,
  `fecha_cancelado` datetime DEFAULT NULL,
  `historial` int(11) NOT NULL DEFAULT 0,
  `observaciones_usuario` text DEFAULT NULL,
  `observaciones_plapers` text DEFAULT NULL,
  `texto_produccion` text DEFAULT NULL,
  `texto_enviado` text DEFAULT NULL,
  `texto_finalizado` text DEFAULT NULL,
  `activo` int(1) NOT NULL DEFAULT 1,
  `payer_id` varchar(50) DEFAULT NULL,
  `txn_id` varchar(50) DEFAULT NULL,
  `verify_sign` varchar(200) DEFAULT NULL,
  `paypal` text DEFAULT NULL,
  `fecha_add` datetime DEFAULT NULL,
  `id_usuario_upd` int(11) DEFAULT NULL,
  `fecha_upd` datetime DEFAULT NULL,
  `id_usuario_del` int(11) DEFAULT NULL,
  `fecha_del` datetime DEFAULT NULL,
  `obs_del` text DEFAULT NULL,
  `comprobante` varchar(100) DEFAULT NULL,
  `id_uso` varchar(255) DEFAULT NULL,
  `constancia` varchar(100) DEFAULT NULL,
  `fecha_constancia` datetime DEFAULT NULL,
  PRIMARY KEY (`id_orden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_orden_producto` (
  `id_orden_producto` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_orden` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nom_categoria` varchar(100) DEFAULT NULL,
  `nom_producto` varchar(100) DEFAULT NULL,
  `id_posicion` int(11) DEFAULT NULL,
  `texto_linea1` varchar(30) DEFAULT NULL,
  `fuente_linea1` int(11) DEFAULT NULL,
  `caracteres_linea1` int(11) DEFAULT NULL,
  `texto_linea2` varchar(30) DEFAULT NULL,
  `fuente_linea2` int(11) DEFAULT NULL,
  `caracteres_linea2` int(11) DEFAULT NULL,
  `texto_linea3` varchar(30) DEFAULT NULL,
  `fuente_linea3` int(11) DEFAULT NULL,
  `caracteres_linea3` int(11) DEFAULT NULL,
  `id_color` int(11) DEFAULT NULL,
  `id_terminado` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `cantidad` int(10) DEFAULT NULL,
  `precio_unitario` double(10,2) DEFAULT NULL,
  `total` double(15,2) DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_orden_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_paypal` (
  `id_paypal` int(11) NOT NULL AUTO_INCREMENT,
  `id_orden` int(11) DEFAULT NULL,
  `paypal` text DEFAULT NULL,
  `fecha_add` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_paypal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_resenas` (
  `id_resena` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `rating` int(5) DEFAULT NULL,
  `fecha_add` date DEFAULT NULL,
  PRIMARY KEY (`id_resena`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS `plap_t_usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `id_rol` tinyint(3) unsigned DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `active` tinyint(4) DEFAULT 1,
  `correo_electronico` varchar(150) DEFAULT NULL,
  `id_tipo_usuario` int(11) NOT NULL DEFAULT 1,
  `fecha_add` datetime DEFAULT NULL,
  `id_user_upd` int(11) DEFAULT NULL,
  `fecha_upd` datetime DEFAULT NULL,
  `id_user_del` int(11) DEFAULT NULL,
  `fecha_del` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

INSERT IGNORE INTO `plap_cat_caracteres` (`id_caracter`, `id_categoria`, `id_subcategoria`, `id_fuente`, `caracteres`, `activo`)
VALUES ('1', '1', '1', '1', '7', '1'),
('2', '1', '2', '1', '7', '1'),
('3', '1', '2', '1', '7', '1'),
('4', '4', '9', '2', '7', '1'),
('5', '4', '9', '3', '9', '1'),
('6', '4', '9', '4', '8', '1'),
('7', '4', '10', '2', '7', '1'),
('8', '4', '10', '3', '9', '1'),
('9', '4', '10', '4', '8', '1'),
('10', '4', '11', '2', '8', '1'),
('11', '4', '11', '3', '10', '1'),
('12', '4', '11', '4', '9', '1'),
('13', '4', '12', '2', '8', '1'),
('14', '4', '12', '3', '10', '1'),
('15', '4', '12', '4', '9', '1'),
('16', '4', '12', '2', '5', '1'),
('17', '4', '12', '3', '6', '1'),
('18', '4', '12', '4', '5', '1'),
('19', '4', '12', '2', '7', '1'),
('20', '4', '12', '4', '8', '1'),
('21', '2', '4', '5', '7', '1'),
('22', '2', '4', '6', '11', '1'),
('23', '2', '5', '5', '7', '1'),
('24', '2', '5', '6', '11', '1'),
('25', '3', '6', '4', '9', '1'),
('26', '3', '7', '4', '9', '1'),
('27', '3', '8', '4', '11', '1');

INSERT IGNORE INTO `plap_cat_categorias` (`id_categoria`, `nom_categoria`, `activo`)
VALUES ('1', 'Placa bicicleta', '1'),
('2', 'Placa americana', '1'),
('3', 'Placa euromini', '1'),
('4', 'Placa europea', '1'),
('5', 'Accesorios 1', '1'),
('6', 'Accesorios 2', '1'),
('7', 'Accesorios 3', '1');

INSERT IGNORE INTO `plap_cat_colores` (`id_color`, `color`, `hex`, `activo`)
VALUES ('1', 'azul', '065389', '1'),
('2', 'azul mora', '1F42A7', '1'),
('3', 'negro', '000000', '1'),
('4', 'blanco', 'FFFFFF', '1'),
('5', 'amarillo', 'F79822', '1'),
('6', 'rojo', 'ED3125', '1'),
('7', 'verde', '0B7052', '1'),
('8', 'plata', '696A6C', '1');

INSERT IGNORE INTO `plap_cat_descuentos` (`id_descuento`, `id_categoria`, `rango_inicio`, `rango_fin`, `precio`, `descuento`, `activo`, `precio_final`)
VALUES ('1', '1', '1', '9', '103.00', '0', '1', '103.00'),
('2', '2', '1', '9', '234.00', '0', '1', '234.00'),
('3', '3', '1', '9', '175.50', '0', '1', '175.50'),
('4', '4', '1', '9', '331.50', '0', '1', '331.50'),
('5', '1', '10', '19', '103.00', '10', '1', '92.70'),
('6', '2', '10', '19', '234.00', '10', '1', '210.60'),
('7', '3', '10', '19', '175.50', '10', '1', '157.95'),
('8', '4', '10', '19', '331.50', '10', '1', '298.35'),
('9', '1', '20', '29', '103.00', '15', '1', '87.55'),
('10', '2', '20', '29', '234.00', '15', '1', '198.90'),
('11', '3', '20', '29', '175.50', '15', '1', '149.18'),
('12', '4', '20', '29', '331.50', '15', '1', '281.78'),
('13', '1', '30', '-1', '103.00', '20', '1', '82.40'),
('14', '2', '30', '-1', '234.00', '20', '1', '187.20'),
('15', '3', '30', '-1', '175.50', '20', '1', '140.40'),
('16', '4', '30', '-1', '331.50', '20', '1', '265.20'),
('17', '5', '1', '9', '58.50', '0', '1', '58.50'),
('18', '6', '1', '9', '52.50', '0', '1', '52.50'),
('19', '7', '1', '9', '117.00', '0', '1', '117.00'),
('20', '5', '10', '19', '58.50', '10', '1', '52.65'),
('21', '6', '10', '19', '52.50', '10', '1', '47.25'),
('22', '7', '10', '19', '117.00', '10', '1', '105.30'),
('23', '5', '20', '29', '58.50', '15', '1', '49.73'),
('24', '6', '20', '29', '52.50', '15', '1', '44.63'),
('25', '7', '20', '29', '117.00', '15', '1', '99.45'),
('26', '5', '30', '-1', '58.50', '20', '1', '46.80'),
('27', '6', '30', '-1', '52.50', '20', '1', '42.00'),
('28', '7', '30', '-1', '117.00', '20', '1', '93.60');

INSERT IGNORE INTO `plap_cat_estados` (`id_estado`, `nombre_estado`)
VALUES ('1', 'Aguascalientes'),
('2', 'Baja California Norte'),
('3', 'Baja California Sur'),
('4', 'Campeche'),
('5', 'Chiapas'),
('6', 'Chihuahua'),
('7', 'Ciudad de Mexico'),
('8', 'Coahuila'),
('9', 'Colima'),
('10', 'Durango'),
('11', 'Guanajuato'),
('12', 'Guerrero'),
('13', 'Hidalgo'),
('14', 'Jalisco'),
('15', 'Estado de Mexico'),
('16', 'Michoacan'),
('17', 'Morelos'),
('18', 'Nayarit'),
('19', 'Nuevo Leon'),
('20', 'Oaxaca'),
('21', 'Puebla'),
('22', 'Queretaro'),
('23', 'Quintana Roo'),
('24', 'San Luis Potosi'),
('25', 'Sinaloa'),
('26', 'Sonora'),
('27', 'Tabasco'),
('28', 'Tamaulipas'),
('29', 'Tlaxcala'),
('30', 'Veracruz'),
('31', 'Yucatan'),
('32', 'Zacatecas');

INSERT IGNORE INTO `plap_cat_estatus_pago` (`id_estatus_pago`, `estatus_pago`, `activo`)
VALUES ('1', 'Sin Pagar', '1'),
('2', 'Pagado', '1'),
('3', 'Cancelado', '1');

INSERT IGNORE INTO `plap_cat_estatus_pedido` (`id_estatus_pedido`, `id_tipo_envio`, `estatus_pedido`, `nottifica_cliente`, `notifica_admin`, `texto_correo`, `activo`)
VALUES ('1', '1', 'Pendiente', '1', '1', NULL, '1'),
('2', '1', 'En Producci?n', '1', '1', 'Hola, te informamos que tu pedido ya ingres? a producci?n. En 8 d?as h?biles a m?s tardar te estaremos haciendo llegar el n?mero de gu?a de tu env?o.\r\nCualquier duda y/o aclaraci?n estamos a tus ?rdenes.\r\nMuchas gracias por tu compra.', '1'),
('3', '1', 'Fabricado', '0', '1', NULL, '1'),
('4', '1', 'Enviado', '1', '1', 'Hola, te informamos que tu pedido ya fue enviado; la informaci?n del env?o es:\r\n\r\nN?mero(s) de gu?a:\r\n\r\n\r\nLink para rastrearlo:\r\nhttps://www.fedex.com/es-mx/home.html\r\n\r\nCualquier duda y/o aclaraci?n estamos a tus ?rdenes.\r\nMuchas gracias por tu compra.', '1'),
('5', '2', 'Pendiente', '1', '1', NULL, '1'),
('6', '2', 'En Producci?n', '1', '1', 'Hola, te informamos que tu pedido ya ingres? a producci?n. En 8 d?as h?biles a m?s tardar te estaremos haciendo llegar la direcci?n donde podr?s recolectar tu pedido.\r\nCualquier duda y/o aclaraci?n estamos a tus ?rdenes.\r\nMuchas gracias por tu compra.', '1'),
('7', '2', 'Fabricado', '0', '1', NULL, '1'),
('8', '1', 'Finalizado', '1', '0', 'Hola, la mensajeria ya entreg? tu pedido. Te agradecemos tu compra y esperamos que nuestro trabajo sea de tu agrado.', '1'),
('9', '2', 'Finalizado', '1', '0', 'Hola, tu pedido ya esta listo; la direcci?n donde lo podr?s recolectar es:\r\n\r\nCALLE: \r\nMARTINIANO GUERRERO NO. 43 (La calle tiene el letrero como Martiniano Guerrero, pero es conocida tambi?n como Vicente Guerrero)\r\n\r\nCOLONIA: BARRIO SAN MIGUEL\r\nALCALD?A: IZTAPALAPA\r\nC.P.: 09360\r\nESTADO: CDMX\r\nPA?S: M?XICO\r\n\r\nREFERENCIA 1: \r\nESTAMOS ATR?S DEL TELMEX QUE ESTA SOBRE ERMITA IZTAPALAPA\r\n\r\nREFERENCIA 2: \r\nENTRE LAS ESTACIONES DEL METRO DE UAMI Y CERRO DE LA ESTRELLA\r\n\r\nHORARIO:\r\nLUNES A VIERNES DE 09:00 A LAS 18:00 HRS.\r\n\r\nTe agradecemos tu compra y esperamos que nuestro trabajo sea  de tu agrado.', '1');

INSERT IGNORE INTO `plap_cat_fuentes` (`id_fuente`, `fuente`, `nom_fuente`, `activo`)
VALUES ('1', 'ALADINE 721 BT', 'ALADINE 721 BT', '1'),
('2', 'EUROFAT', 'TIPOGRAF?A ANCHA', '1'),
('3', 'EUROTHIN', 'TIPOGRAF?A DELGADA', '1'),
('4', 'EUROMINI', 'TIPOGRAF?A MODERNA', '1'),
('5', 'LicensePlate', 'TIPOGRAF?A GRANDE GRUESA', '1'),
('6', 'BUILT TITLING LT', 'TIPOGRAF?A GRANDE DELGADA', '1'),
('7', 'BEBAS KAI ', 'TIPOGRAF?A MEDIANA', '1'),
('8', 'BUILT TITLING RG', 'TIPOGRAF?A CHICA', '1');

INSERT IGNORE INTO `plap_cat_medidas` (`id_medida`, `largo`, `ancho`, `unidad`, `activo`)
VALUES ('1', '14.0', '7.9', 'cms.', '1'),
('2', '52.0', '11.0', 'cms.', '1'),
('3', '39.0', '12.0', 'cms.', '1'),
('4', '52.3', '11.3', 'cms.', '1'),
('5', '30.0', '15.0', 'cms.', '1'),
('6', '46.0', '7.0', 'cms.', '1');

INSERT IGNORE INTO `plap_cat_paises` (`id_pais`, `nombre_pais`)
VALUES ('1', 'Mexico');

INSERT IGNORE INTO `plap_cat_posiciones` (`id_posicion`, `numero_posicion`, `id_renglon`, `id_fuente_linea1`, `id_fuente_linea2`, `id_fuente_linea3`, `caracter1`, `caracter2`, `caracter3`, `activo`)
VALUES ('1', '1', '2', '8', '5,6', '0', '15', '7,11', NULL, '1'),
('2', '2', '3', '8', '8', '8', '15', '15', '15', '1'),
('3', '3', '2', '7', '7', '0', '8', '8', NULL, '1'),
('4', '4', '1', '5,6', '0', '0', '7,11', NULL, NULL, '1'),
('5', '5', '2', '5,6', '8', '0', '7,11', '15', NULL, '1');

INSERT IGNORE INTO `plap_cat_productos` (`id_producto`, `id_categoria`, `id_subcategoria`, `clave`, `nom_producto`, `descripcion`, `id_medida`, `id_terminado`, `id_renglon`, `id_caracter`, `id_signo`, `id_color`, `id_posicion`, `foto`, `ejemplo`, `activo`, `precio_unitario`, `new`)
VALUES ('1', '2', '3', 'VPA-TROQAMCOLAQU', 'COLOR AQUA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_1.png', 'EJ_AME_1.jpg', '1', '286.00', '0'),
('2', '2', '3', 'VPA-TROQAMCOLAZU', 'COLOR AZUL', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_2.png', 'EJ_AME_2.jpg', '1', '286.00', '0'),
('3', '2', '3', 'VPA-TROQAMCOLBLA', 'COLOR BLANCA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_3.png', 'EJ_AME_3.jpg', '1', '286.00', '0'),
('4', '2', '3', 'VPA-TROQAMCOLFAM', 'COLOR FLUORESCENTE AMARILLA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_4.png', 'EJ_AME_4.jpg', '1', '286.00', '0'),
('5', '2', '3', 'VPA-TROQAMCOLFNA', 'COLOR FLUORESCENTE NARANJA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_5.png', 'EJ_AME_5.jpg', '1', '286.00', '0'),
('6', '2', '3', 'VPA-TROQAMCOLFVE', 'COLOR FLUORESCENTE VERDE', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_6.png', 'EJ_AME_6.jpg', '0', '357.50', '0'),
('7', '2', '3', 'VPA-TROQAMCOLLIL', 'COLOR LILA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_7.png', 'EJ_AME_7.jpg', '0', '357.50', '0'),
('8', '2', '3', 'VPA-TROQAMCOLNEG', 'COLOR NEGRA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_8.png', 'EJ_AME_8.jpg', '1', '286.00', '0'),
('9', '2', '3', 'VPA-TROQAMCOLROJ', 'COLOR ROJA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_9.png', 'EJ_AME_9.jpg', '1', '286.00', '0'),
('10', '2', '3', 'VPA-TROQAMCOLVER', 'COLOR VERDE', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_10.png', 'EJ_AME_10.jpg', '1', '286.00', '0'),
('11', '2', '4', 'VPA-TROQAMAIRFOR', 'AIR FORCE', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_11.png', 'EJ_AME_11.jpg', '1', '286.00', '0'),
('12', '2', '4', 'VPA-TROQAMARIZON', 'ARIZONA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_12.png', 'EJ_AME_12.jpg', '1', '286.00', '0'),
('13', '2', '4', 'VPA-TROQAMARMY', 'ARMY', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_13.png', 'EJ_AME_13.jpg', '1', '286.00', '0'),
('14', '2', '4', 'VPA-TROQAMCALIDR', 'CALIFORNIA DREAMS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_14.png', 'EJ_AME_14.jpg', '1', '286.00', '0'),
('15', '2', '4', 'VPA-TROQAMCALIFO', 'CALIFORNIA ', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_15.png', 'EJ_AME_15.jpg', '1', '286.00', '0'),
('16', '2', '4', 'VPA-TROQAMCALIPL', 'CALIFORNIA PLAYA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_16.png', 'EJ_AME_16.jpg', '1', '286.00', '0'),
('17', '2', '4', 'VPA-TROQAMFLORID', 'FLORIDA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_17.png', 'EJ_AME_17.jpg', '1', '286.00', '0'),
('18', '2', '4', 'VPA-TROQAMILLINO', 'ILLINOIS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_18.png', 'EJ_AME_18.jpg', '1', '286.00', '0'),
('19', '2', '4', 'VPA-TROQAMLOBOS', 'LOBOS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_19.png', 'EJ_AME_19.jpg', '1', '286.00', '0'),
('20', '2', '4', 'VPA-TROQAMNAVY', 'NAVY', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_20.png', 'EJ_AME_20.jpg', '1', '286.00', '0'),
('21', '2', '4', 'VPA-TROQAMNEVAZU', 'NEVADA AZUL', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_21.png', 'EJ_AME_21.jpg', '1', '286.00', '0'),
('22', '2', '4', 'VPA-TROQAMNEVBLA', 'NEVADA BLANCA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_22.png', 'EJ_AME_22.jpg', '1', '286.00', '0'),
('23', '2', '4', 'VPA-TROQAMNUEMEX', 'NUEVO M?XICO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_23.png', 'EJ_AME_23.jpg', '1', '286.00', '0'),
('24', '2', '4', 'VPA-TROQAMNYMETS', 'NEW YORK METS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_24.png', 'EJ_AME_24.jpg', '1', '286.00', '0'),
('25', '2', '4', 'VPA-TROQAMNYORK', 'NEW YORK', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_25.png', 'EJ_AME_25.jpg', '1', '286.00', '0'),
('26', '2', '4', 'VPA-TROQAMTEXAS', 'TEXAS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_26.png', 'EJ_AME_26.jpg', '1', '286.00', '0'),
('27', '2', '4', 'VPA-TROQAMTEXEST', 'TEXAS ESTRELLA ', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_27.png', 'EJ_AME_27.jpg', '1', '286.00', '0'),
('28', '2', '4', 'VPA-TROQAMTEXVAQ', 'TEXAS VAQUERO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_28.png', 'EJ_AME_28.jpg', '1', '286.00', '0'),
('29', '2', '5', 'VPA-TROQAMBALON', 'BAL?N', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_29.png', 'EJ_AME_29.jpg', '1', '286.00', '0'),
('30', '2', '5', 'VPA-TROQAMBANDER', 'BANDERAS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_30.png', 'EJ_AME_30.jpg', '1', '286.00', '0'),
('31', '2', '5', 'VPA-TROQAMBOLA8', 'BOLA 8 ', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_31.png', 'EJ_AME_31.jpg', '1', '286.00', '0'),
('32', '2', '5', 'VPA-TROQAMCORAZO', 'CORAZONES', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_32.png', 'EJ_AME_32.jpg', '1', '286.00', '0'),
('33', '2', '5', 'VPA-TROQAMNAAZUL', 'NASCAR AZUL CON ROJO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_33.png', 'EJ_AME_33.jpg', '1', '286.00', '0'),
('34', '2', '5', 'VPA-TROQAMNAAZRO', 'NASCAR AZUL ', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_34.png', 'EJ_AME_34.jpg', '1', '286.00', '0'),
('35', '2', '5', 'VPA-TROQAMNAMRA', 'NASCAR MORADO, ROJO Y AMARILLO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '2', '1', '23,24', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_35.png', 'EJ_AME_35.jpg', '1', '286.00', '0'),
('36', '2', '16', 'VPA-TROQAMTRICOL', 'TRICOLOR', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_36.png', 'EJ_AME_36.jpg', '1', '286.00', '0'),
('37', '4', '9', 'VPE-TROQEUALBAAM', 'BANDERA ALEMANIA AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_37.png', 'EJ_EUR_37.jpg', '1', '405.00', '0'),
('38', '4', '9', 'VPE-TROQEUALBABL', 'BANDERA ALEMANIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_38.png', 'EJ_EUR_38.jpg', '1', '405.00', '0'),
('39', '4', '9', 'VPE-TROQEUALBANE', 'BANDERA ALEMANIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_39.png', 'EJ_EUR_39.jpg', '1', '405.00', '0'),
('40', '4', '9', 'VPE-TROQEUALCOAM', 'COMUNIDAD EUROPEA ALEMANIA AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_40.png', 'EJ_EUR_40.jpg', '1', '405.00', '0'),
('41', '4', '9', 'VPE-TROQEUALCOBL', 'COMUNIDAD EUROPEA ALEMANIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_41.png', 'EJ_EUR_41.jpg', '1', '405.00', '0'),
('42', '4', '9', 'VPE-TROQEUALCONE', 'COMUNIDAD EUROPEA ALEMANIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_42.png', 'EJ_EUR_42.jpg', '1', '405.00', '0'),
('43', '4', '9', 'VPE-TROQEUESPBBL', 'BANDERA ESPA?A BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_43.png', 'EJ_EUR_43.jpg', '0', '477.00', '0'),
('44', '4', '9', 'VPE-TROQEUESPBNE', 'BANDERA ESPA?A NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_44.png', 'EJ_EUR_44.jpg', '0', '405.00', '0'),
('45', '4', '9', 'VPE-TROQEUFRABBL', 'BANDERA FRANCIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_45.png', 'EJ_EUR_45.jpg', '1', '405.00', '0'),
('46', '4', '9', 'VPE-TROQEUFRABNE', 'BANDERA FRANCIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_46.png', 'EJ_EUR_46.jpg', '1', '405.00', '0'),
('47', '4', '9', 'VPE-TROQEUFRCOAM', 'COMUNIDAD EUROPEA FRANCIA AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_47.png', 'EJ_EUR_47.jpg', '0', '477.00', '0'),
('48', '4', '9', 'VPE-TROQEUFRCOBL', 'COMUNIDAD EUROPEA FRANCIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_48.png', 'EJ_EUR_48.jpg', '0', '477.00', '0'),
('49', '4', '9', 'VPE-TROQEUFRCONE', 'COMUNIDAD EUROPEA FRANCIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_49.png', 'EJ_EUR_49.jpg', '0', '477.00', '0'),
('50', '4', '9', 'VPE-TROQEUINGBBL', 'BANDERA INGLATERRA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_50.png', 'EJ_EUR_50.jpg', '0', '477.00', '0'),
('51', '4', '9', 'VPE-TROQEUINGBNE', 'BANDERA INGLATERRA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_51.png', 'EJ_EUR_51.jpg', '0', '477.00', '0'),
('52', '4', '9', 'VPE-TROQEUITABBL', 'BANDERA ITALIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_52.png', 'EJ_EUR_52.jpg', '1', '405.00', '0'),
('53', '4', '9', 'VPE-TROQEUITABNE', 'BANDERA ITALIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_53.png', 'EJ_EUR_53.jpg', '1', '405.00', '0'),
('54', '4', '9', 'VPE-TROQEUMEXBAM', 'BANDERA M?XICO AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_54.png', 'EJ_EUR_54.jpg', '1', '405.00', '0'),
('55', '4', '9', 'VPE-TROQEUMEXBBL', 'BANDERA M?XICO BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_55.png', 'EJ_EUR_55.jpg', '1', '405.00', '0'),
('56', '4', '9', 'VPE-TROQEUMEXBNE', 'BANDERA M?XICO NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_56.png', 'EJ_EUR_56.jpg', '1', '405.00', '0'),
('57', '4', '9', 'VPE-TROQEURUSBBL', 'BANDERA RUSIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_57.png', 'EJ_EUR_57.jpg', '1', '405.00', '0'),
('58', '4', '9', 'VPE-TROQEURUSBNE', 'BANDERA RUSIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_58.png', 'EJ_EUR_58.jpg', '1', '405.00', '0'),
('59', '4', '9', 'VPE-TROQEUSUIBBL', 'BANDERA SUIZA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_59.png', 'EJ_EUR_59.jpg', '1', '405.00', '0'),
('60', '4', '9', 'VPE-TROQEUSUIBNE', 'BANDERA SUIZA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_60.png', 'EJ_EUR_60.jpg', '1', '405.00', '0'),
('61', '4', '9', 'VPE-TROQEUUGAND', 'UGANDA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '4,5,6', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_61.png', 'EJ_EUR_61.jpg', '1', '405.00', '0'),
('62', '4', '10', 'VPE-TROQEUESAGBL', 'ESCUDO ?GUILA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_62.png', 'EJ_EUR_62.jpg', '1', '405.00', '0'),
('63', '4', '10', 'VPE-TROQEUESAGMA', 'ESCUDO ?GUILA AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_63.png', 'EJ_EUR_63.jpg', '1', '405.00', '0'),
('64', '4', '10', 'VPE-TROQEUESAGNG', 'ESCUDO ?GUILA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_64.png', 'EJ_EUR_64.jpg', '1', '405.00', '0'),
('65', '4', '10', 'VPE-TROQEUESBAAM', 'ESCUDO Y BANDERA ALEMANIA AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_65.png', 'EJ_EUR_65.jpg', '1', '405.00', '0'),
('66', '4', '10', 'VPE-TROQEUESBABL', 'ESCUDO Y BANDERA ALEMANIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_66.png', 'EJ_EUR_66.jpg', '1', '405.00', '0'),
('67', '4', '10', 'VPE-TROQEUESBANE', 'ESCUDO Y BANDERA ALEMANIA NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_67.png', 'EJ_EUR_67.jpg', '1', '405.00', '0'),
('68', '4', '10', 'VPE-TROQEUESCDAM', 'ESCUDO ALEMANIA \"D\" AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_68.png', 'EJ_EUR_68.jpg', '0', '477.00', '0'),
('69', '4', '10', 'VPE-TROQEUESCDBL', 'ESCUDO ALEMANIA \"D\" BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_69.png', 'EJ_EUR_69.jpg', '0', '477.00', '0'),
('70', '4', '10', 'VPE-TROQEUESCDNE', 'ESCUDO ALEMANIA \"D\" NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_70.png', 'EJ_EUR_70.jpg', '0', '477.00', '0'),
('71', '4', '10', 'VPE-TROQEUGBBABL', 'ESCUDO GRAN BRETA?A BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_71.png', 'EJ_EUR_71.jpg', '1', '405.00', '0'),
('72', '4', '10', 'VPE-TROQEUGBBANE', 'ESCUDO GRAN BRETA?A NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_72.png', 'EJ_EUR_72.jpg', '1', '405.00', '0'),
('73', '4', '10', 'VPE-TROQEUGBELBL', 'ESCUDO LEONES BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_73.png', 'EJ_EUR_73.jpg', '1', '405.00', '0'),
('74', '4', '10', 'VPE-TROQEUGBELNE', 'ESCUDO LEONES NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_74.png', 'EJ_EUR_74.jpg', '1', '405.00', '0'),
('75', '4', '10', 'VPE-TROQEUNASBBL', 'NASCAR BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_75.png', 'EJ_EUR_75.jpg', '1', '405.00', '0'),
('76', '4', '10', 'VPE-TROQEUZAMIA', 'ZAMBIA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '7,8,9', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_76.png', 'EJ_EUR_76.jpg', '1', '405.00', '0'),
('77', '4', '11', 'VPE-TROQEUROCOAM', 'AMARILLA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '10,11,12', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_77.png', 'EJ_EUR_77.jpg', '1', '405.00', '0'),
('78', '4', '11', 'VPE-TROQEUROCOAZ', 'AZUL', 'PLACA EN ALUMINIO, TAMA?O EUROPEO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '10,11,12', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_78.png', 'EJ_EUR_78.jpg', '1', '405.00', '0'),
('79', '4', '11', 'VPE-TROQEUROCOBL', 'BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '10,11,12', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_79.png', 'EJ_EUR_79.jpg', '1', '405.00', '0'),
('80', '4', '11', 'VPE-TROQEUROCONE', 'NEGRA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '10,11,12', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_80.png', 'EJ_EUR_80.jpg', '1', '405.00', '0'),
('81', '4', '11', 'VPE-TROQEUROCORO', 'ROSA', 'PLACA EN ALUMINIO, TAMA?O EUROPEO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '10,11,12', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_81.png', 'EJ_EUR_81.jpg', '0', '405.00', '0'),
('82', '4', '11', 'VPE-TROQEUROREVE', 'VERDE', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, FONDO VERDE CON EL CONTORNO DE LA PLACA EN COLOR BLANCO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '10,11,12', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_82.png', 'EJ_EUR_82.jpg', '0', '477.00', '0'),
('83', '4', '12', 'VPE-TROQEUESPBNC', 'ESPA?A', 'PLACA EN ALUMINIO, TAMA?O EUROPEO, CON MARCA DE AGUA DEL ESCUDO ESPA?A EN EL FONDO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '2', '1', '1', '13,14,15', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_83.png', 'EJ_EUR_83.jpg', '1', '477.00', '0'),
('84', '4', '12', 'VPE-TROQEUSMARIN', 'SAN MARINO', 'PLACA EN ALUMINIO, TAMA?O ESPECIAL, CON ESCUDO DE SAN MARINO IMPRESO Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '3', '3', '1', '16,17,18', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_84.png', 'EJ_EUR_84.jpg', '1', '405.00', '0'),
('85', '4', '12', 'VPE-TROQEUTURQ', 'TURQU?A', 'PLACA EN ALUMINIO, TAMA?O ESPECIAL, CON MARCA DE AGUA DEL ESCUDO DE TURQU?A Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '4', '3', '1', '14,19,20', '1,5', '1,2,3,4,5,6,7,8', NULL, 'EUR_85.png', 'EJ_EUR_85.jpg', '1', '405.00', '0'),
('86', '1', '1', 'VPB-TROQ45BIKERS', '45 BIKERS', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_86.png', 'EJ_BIC_86.jpg', '1', '126.00', '0'),
('87', '1', '1', 'VPB-TROQANGEL', '?NGEL', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_87.png', 'EJ_BIC_87.jpg', '1', '126.00', '0'),
('88', '1', '1', 'VPB-TROQANTIBICI', 'ANTIGUAS', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_88.png', 'EJ_BIC_88.jpg', '1', '126.00', '0'),
('89', '1', '1', 'VPB-TROQBICIS', 'BICIS', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_89.png', 'EJ_BIC_89.jpg', '1', '126.00', '0'),
('90', '1', '1', 'VPB-TROQBIKEBICI', 'BIKE CITY', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_90.png', 'EJ_BIC_90.jpg', '1', '126.00', '0'),
('91', '1', '1', 'VPB-TROQBIKESTYL', 'BIKE STYLE', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_91.png', 'EJ_BIC_91.jpg', '1', '126.00', '0'),
('92', '1', '1', 'VPB-TROQDFBICI', 'D.F.', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_92.png', 'EJ_BIC_92.jpg', '1', '126.00', '0'),
('93', '1', '1', 'VPB-TROQEVOLHOMB', 'EVOL. HOMBRE', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_93.png', 'EJ_BIC_93.jpg', '1', '126.00', '0'),
('94', '1', '1', 'VPB-TROQEVOLMUJE', 'EVOL. MUJER', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_94.png', 'EJ_BIC_94.jpg', '1', '126.00', '0'),
('95', '1', '1', 'VPB-TROQFAMILY', 'FAMILY', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_95.png', 'EJ_BIC_95.jpg', '1', '126.00', '0'),
('96', '1', '1', 'VPB-TROQFLORBICI', 'FLORES', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_96.png', 'EJ_BIC_96.jpg', '1', '126.00', '0'),
('97', '1', '1', 'VPB-TROQMOSABICI', 'MOSAICO', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_97.png', 'EJ_BIC_97.jpg', '1', '126.00', '0'),
('98', '1', '1', 'VPB-TROQPARTBICI', 'PARTES', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_98.png', 'EJ_BIC_98.jpg', '1', '126.00', '0'),
('99', '1', '1', 'VPB-TROQPRINBICI', 'PRINCESA', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_99.png', 'EJ_BIC_99.jpg', '1', '126.00', '0'),
('100', '1', '1', 'VPB-TROQSINCE88', 'SINCE 88', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_100.png', 'EJ_BIC_100.jpg', '0', '126.00', '0'),
('101', '1', '1', 'VPB-TROQWATCBICI', 'WATCH OUT', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_101.png', 'EJ_BIC_101.jpg', '1', '126.00', '0'),
('102', '1', '1', 'VPB-TROQXTREMEBI', 'XTREME BIKE', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_102.png', 'EJ_BIC_102.jpg', '1', '151.00', '0'),
('103', '1', '2', 'VPB-TROQCOLBCA', 'COLOR BLANCA', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '2', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_103.png', 'EJ_BIC_103.jpg', '1', '126.00', '0'),
('104', '1', '2', 'VPB-TROQCOLNGA', 'COLOR NEGRA', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS', '1', '1', '1', '3', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_104.png', 'EJ_BIC_104.jpg', '1', '126.00', '0'),
('105', '3', '6', 'VPR-TROQEUALBABL', 'BANDERA ALEMANIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_105.png', 'EJ_EUM_105.jpg', '1', '214.50', '0'),
('106', '3', '6', 'VPR-TROQEUALCOBL', 'ALEMANIA COMUNIDAD BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_106.png', 'EJ_EUM_106.jpg', '1', '214.50', '0'),
('107', '3', '6', 'VPR-TROQEUESPBBL', 'BANDERA ESPA?A BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_107.png', 'EJ_EUM_107.jpg', '1', '214.50', '0'),
('108', '3', '6', 'VPR-TROQEUFRABBL', 'BANDERA FRANCIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_108.png', 'EJ_EUM_108.jpg', '1', '214.50', '0'),
('109', '3', '6', 'VPR-TROQEUINBBL', 'BANDERA INGLATERRA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_109.png', 'EJ_EUM_109.jpg', '1', '214.50', '0'),
('110', '3', '6', 'VPR-TROQEUITABBL', 'BANDERA ITALIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_110.png', 'EJ_EUM_110.jpg', '1', '214.50', '0'),
('111', '3', '6', 'VPR-TROQEUMEXBBL', 'BANDERA MEXICO BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_111.png', 'EJ_EUM_111.jpg', '1', '214.50', '0'),
('112', '3', '6', 'VPR-TROQEURUSBBL', 'BANDERA RUSIA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_112.png', 'EJ_EUM_112.jpg', '1', '214.50', '0'),
('113', '3', '6', 'VPR-TROQEUSUIBBL', 'BANDERA SUIZA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON BANDERA EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '25', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_113.png', 'EJ_EUM_113.jpg', '1', '214.50', '0'),
('114', '3', '7', 'VPR-TROQEUESAGBL', 'ESCUDO AGUILA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '26', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_114.png', 'EJ_EUM_114.jpg', '1', '214.50', '0'),
('115', '3', '7', 'VPR-TROQEUESBABL', 'ESC. Y BAN. ALEMANA BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '26', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_115.png', 'EJ_EUM_115.jpg', '1', '214.50', '0'),
('116', '3', '7', 'VPR-TROQEUESCDBL', 'ESCUDO ALEMAN D BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '26', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_116.png', 'EJ_EUM_116.jpg', '1', '214.50', '0'),
('117', '3', '7', 'VPR-TROQEUGBBABL', 'ESCUDO GRAN BRETA?A BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '26', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_117.png', 'EJ_EUM_117.jpg', '1', '214.50', '0'),
('118', '3', '7', 'VPR-TROQEUGBELBL', 'ESCUDO LEONES BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI, CON ESCUDO EN VINIL Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '26', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_118.png', 'EJ_EUM_118.jpg', '1', '214.50', '0'),
('119', '3', '8', 'VPR-TROQEUROCOBL', 'BLANCA', 'PLACA EN ALUMINIO, TAMA?O EUROMINI Y LETRAS TROQUELADAS (EN ALTO RELIEVE), SIN OJALES DE SUJECI?N Y ESQUINAS REDONDEADAS', '6', '1', '1', '27', '1', '1,2,3,4,5,6,7,8', NULL, 'EUM_119.png', 'EJ_EUM_119.jpg', '1', '214.50', '0'),
('120', '6', '14', 'ACC-1', 'PORTA PLACA AMERICANO NEGRO', 'NUESTROS PORTA PLACAS TE OFRECEN MAYOR CALIDAD Y DURABILIDAD POR SUS MATERIALES Y DISE?O DE ALTA RESISTENCIA. ADEM?S POR SU SISTEMA DE FIJACI?N TE OFRECEN SEGURIDAD PARA TU PLACA DECORATIVA U OFICIAL. TIEMPO DE ENTREGA A M?S TARDAR 8 D?AS H?BILES UNA VEZ QUE HACES TU PEDIDO Y RECIBIMOS TU PAGO.', '0', '0', '0', '0', '0', '0', NULL, 'ACC_120.png', 'EJ_ACC_120.png', '1', '76.00', '0'),
('121', '5', '13', 'ACC-2', 'BASE PARA PLACA', 'SI NO CUENTAS CON UN AUTO, NO TE PREOCUPES, ESTE SENCILLO ACCESORIO SIRVE PARA COLOCAR TU PLACA FAVORITA EN EL ESPACIO  QUE TU QUIERAS (CASA U OFICINA). TIEMPO DE ENTREGA A M?S TARDAR 8 D?AS H?BILES UNA VEZ QUE HACES TU PEDIDO Y RECIBIMOS TU PAGO.', '0', '0', '0', '0', '0', '0', NULL, 'ACC_121.png', 'EJ_ACC_121.png', '1', '71.50', '0'),
('122', '7', '15', 'ACC-3', 'PORTA PLACA EUROPEO', NULL, '0', '0', '0', '0', '0', '0', NULL, 'ACC_122.png', 'EJ_ACC_122.png', '1', '143.00', '0'),
('123', '6', '14', 'ACC-3', 'PORTA PLACA AMERICANO ROJO', 'NUESTROS PORTA PLACAS TE OFRECEN MAYOR CALIDAD Y DURABILIDAD POR SUS MATERIALES Y DISE?O DE ALTA RESISTENCIA. ADEM?S POR SU SISTEMA DE FIJACI?N TE OFRECEN SEGURIDAD PARA TU PLACA DECORATIVA U OFICIAL. TIEMPO DE ENTREGA A M?S TARDAR 8 D?AS H?BILES UNA VEZ QUE HACES TU PEDIDO Y RECIBIMOS TU PAGO.\n', '0', '0', '0', '0', '0', '0', NULL, 'ACC_123.png', 'EJ_ACC_123.png', '1', '76.00', '0'),
('124', '2', '16', 'VPA-TROQAMPIZAMX', 'PIZARR?N M?XICO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '5', '1,2', '0', '0', '1,2,3,4', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_124.png', 'EJ_AME_124.png', '1', '286.00', '0'),
('125', '2', '16', 'VPA-TROQAMMARAMX', 'MARACAS M?XICO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '5', '1,2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_125.png', 'EJ_AME_125.png', '1', '286.00', '0'),
('126', '2', '16', 'VPA-TROQAMTEQUIL', 'M?S TEQUILA', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '5', '1,2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_126.png', 'EJ_AME_126.png', '1', '286.00', '0'),
('127', '2', '16', 'VPA-TROQAMROSAMX', 'ROSA M?XICO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '5', '1,2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_127.png', 'EJ_AME_127.png', '1', '286.00', '0'),
('129', '2', '16', 'VPA-TROQAMMAPAMX', 'MAPA M?XICO', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '5', '2', '1', '21,22', '1,2,3,4', '1,2,3,4,5,6,7,8', NULL, 'AME_129.png', 'EJ_AME_129.png', '1', '286.00', '0'),
('130', '2', '5', 'VPA-TROQAMHUELLA', 'HUELLITAS', 'PLACA EN ALUMINIO, TAMA?O AMERICANO, LETRAS Y/O N?MEROS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR, 2 OJALES EN LA PARTE INFERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '5', '1,2', '0', '0', '1,2', '1,2,3,4,5,6,7,8', '1,2,3,4,5', 'AME_130.png', 'EJ_AME_130.png', '1', '286.00', '0'),
('131', '1', '1', 'VPB-TROQSPIDER', 'SPIDER', 'PLACA EN ALUMINIO, TAMA?O BICICLETA, N?MEROS Y LETRAS TROQUELADOS (EN ALTO RELIEVE), CON 2 OJALES EN LA PARTE SUPERIOR PARA SUJECI?N Y ESQUINAS REDONDEADAS.', '1', '1', '1', '1', '1,2', '1,2,3,4,5,6,7,8', NULL, 'BIC_131.png', 'EJ_BIC_131.png', '1', '126.00', '0');

INSERT IGNORE INTO `plap_cat_renglones` (`id_renglon`, `numero_renglones`, `activo`)
VALUES ('1', '1', '1'),
('2', '2', '1'),
('3', '3', '1');

INSERT IGNORE INTO `plap_cat_roles` (`id_rol`, `nom_rol`, `activo`)
VALUES ('1', 'Administrador', '1'),
('2', 'Usuario', '1'),
('3', 'Vendedor', '1'),
('4', 'Dise?ador', '1'),
('5', 'Producci?n', '1');

INSERT IGNORE INTO `plap_cat_signos` (`id_signo`, `nom_signo`, `signo`, `activo`)
VALUES ('1', 'guion', '-', '1'),
('2', 'punto', '.', '1'),
('3', 'coma', ',', '1'),
('4', 'apostrofe', '\'', '1'),
('5', 'dieresis', '?', '1');

INSERT IGNORE INTO `plap_cat_subcategorias` (`id_subcategoria`, `id_categoria`, `nom_subcategoria`, `activo`)
VALUES ('1', '1', 'fondos alternativos', '1'),
('2', '1', 'fondos de colores', '1'),
('3', '2', 'fondos de colores', '1'),
('4', '2', 'fondos de estados unidos', '1'),
('5', '2', 'fondos alternativos', '1'),
('6', '3', 'con bandera', '1'),
('7', '3', 'con escudo', '1'),
('8', '3', 'fondos de colores', '1'),
('9', '4', 'con bandera', '1'),
('10', '4', 'con escudo', '1'),
('11', '4', 'fondos de colores', '1'),
('12', '4', 'medida especial y marca de agua', '1'),
('13', '5', 'base', '1'),
('14', '6', 'porta placa americano', '1'),
('15', '7', 'porta placa europeo', '1'),
('16', '2', 'fondos patrios', '1');

INSERT IGNORE INTO `plap_cat_terminado` (`id_terminado`, `nom_terminado`, `activo`)
VALUES ('1', 'cord?n', '1'),
('2', 'charola', '1'),
('3', 'plano', '1');

INSERT IGNORE INTO `plap_cat_tipo_envio` (`id_tipo_envio`, `tipo_envio`, `activo`)
VALUES ('1', 'Envio', '1'),
('2', 'Sin envio', '1');

INSERT IGNORE INTO `plap_cat_tipo_pago` (`id_tipo_pago`, `tipo_pago`, `activo`)
VALUES ('1', 'PayPal', '1'),
('2', 'Dep?sito', '1');

INSERT IGNORE INTO `plap_cat_tipo_usuario` (`id_tipo_usuario`, `tipo_usuario`)
VALUES ('1', 'normal'),
('2', 'descuento');

INSERT IGNORE INTO `plap_cat_uso_cfdi` (`id_uso`, `nombre_uso`)
VALUES ('1', 'G01 Adquisici?n de mercanc?as'),
('2', 'G03 Gastos en general'),
('3', 'P01 Por definir');

INSERT IGNORE INTO `plap_t_galeria` (`id_galeria`, `id_categoria`, `id_subcategoria`, `id_producto`, `foto`)
VALUES ('1', '2', '3', '1', 'placa1.png'),
('2', '2', '3', '2', 'placa2.png'),
('3', '2', '3', '3', 'placa3.png'),
('4', '2', '3', '5', 'placa5.png'),
('5', '2', '3', '8', 'placa8.png'),
('6', '2', '3', '8', 'placa8_1.png'),
('7', '2', '3', '8', 'placa8_2.png'),
('8', '2', '3', '9', 'placa9.png'),
('9', '2', '4', '15', 'placa15.png'),
('10', '2', '4', '15', 'placa15_1.png'),
('11', '2', '4', '16', 'placa16.png'),
('12', '2', '4', '17', 'placa17.png'),
('13', '2', '4', '17', 'placa17_1.png'),
('14', '2', '4', '18', 'placa18.png'),
('15', '2', '4', '21', 'placa21.png'),
('16', '2', '4', '22', 'placa22.png'),
('17', '2', '4', '22', 'placa22_1.png'),
('18', '2', '4', '25', 'placa25.png'),
('19', '2', '4', '28', 'placa28.png'),
('20', '2', '4', '28', 'placa28_1.png'),
('21', '2', '5', '36', 'placa36.png'),
('22', '4', '11', '77', 'placa77.png'),
('23', '4', '11', '77', 'placa77_1.png'),
('24', '4', '11', '77', 'placa77_2.png'),
('25', '4', '11', '78', 'placa78.png'),
('26', '4', '11', '79', 'placa79.png'),
('27', '4', '11', '79', 'placa79_1.png'),
('28', '4', '11', '81', 'placa81.png'),
('29', '4', '11', '82', 'placa82.png'),
('30', '4', '12', '83', 'placa83.png'),
('31', '4', '12', '84', 'placa84.png'),
('32', '4', '12', '85', 'placa85.png'),
('33', '4', '10', '63', 'placa63.png'),
('34', '4', '10', '64', 'placa64.png'),
('35', '4', '10', '75', 'placa75.png'),
('36', '4', '9', '40', 'placa40.png'),
('37', '4', '9', '40', 'placa40_1.png'),
('38', '4', '9', '41', 'placa41.png'),
('39', '4', '9', '51', 'placa51.png'),
('40', '4', '9', '56', 'placa56.png'),
('41', '3', '6', '111', 'placa111.png'),
('42', '3', '7', '115', 'placa115.png'),
('43', '3', '8', '119', 'placa119.png'),
('44', '3', '8', '119', 'placa119_1.png'),
('45', '1', '1', '90', 'placa90.png'),
('46', '1', '1', '92', 'placa92.png'),
('47', '1', '1', '96', 'placa96.png'),
('48', '1', '1', '99', 'placa99.png');

-- Usuario administrador inicial solo para base vacía.
-- Cambiar la contraseña después del primer acceso y guardar la nueva de forma segura.
INSERT INTO `plap_t_usuarios` (`id_user`, `username`, `id_rol`, `password`, `remember_token`, `active`, `correo_electronico`, `id_tipo_usuario`)
VALUES (1, 'admin', 1, '$2y$10$Z9bxp2KEaJIzxhfCsGBYeOvt5IA1GPGbHooCknkZlmOnCz13MQdIC', NULL, 1, 'admin@localhost.invalid', 1);
INSERT INTO `plap_t_info_usuarios` (`id_info`, `id_user`, `nombres`, `paterno`, `materno`)
VALUES (1, 1, 'Administrador inicial', '', '');

-- En caso de reutilizar el archivo, normaliza referencias .jpg conocidas a .png.
UPDATE `plap_t_galeria`
SET `foto` = CONCAT(LEFT(`foto`, CHAR_LENGTH(`foto`) - 4), '.png')
WHERE `id_galeria` BETWEEN 1 AND 48
  AND LOWER(RIGHT(`foto`, 4)) = '.jpg';
