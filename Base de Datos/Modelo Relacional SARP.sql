/*
Navicat MySQL Data Transfer

Source Server         : sarp
Source Server Version : 50505
Source Host           : localhost:3308
Source Database       : sarp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-07-15 16:31:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for camiones
-- ----------------------------
DROP TABLE IF EXISTS `camiones`;
CREATE TABLE `camiones` (
  `Placa` varchar(10) NOT NULL,
  `Modelo` varchar(15) DEFAULT '',
  `Capacidad` float DEFAULT NULL,
  `ID_Fleteros` int(11) NOT NULL,
  PRIMARY KEY (`Placa`),
  KEY `fk_camiones_fleteros_1` (`ID_Fleteros`),
  CONSTRAINT `fk_camiones_fleteros_1` FOREIGN KEY (`ID_Fleteros`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of camiones
-- ----------------------------
INSERT INTO `camiones` VALUES ('5e4h4', 'chevrolet', '800', '8');
INSERT INTO `camiones` VALUES ('7h895v', 'PEYOT', '200', '8');

-- ----------------------------
-- Table structure for camion_chofer
-- ----------------------------
DROP TABLE IF EXISTS `camion_chofer`;
CREATE TABLE `camion_chofer` (
  `ID_Camion` varchar(10) DEFAULT '',
  `ID_Chofer` varchar(10) DEFAULT '',
  KEY `ID_Camion` (`ID_Camion`),
  KEY `ID_Chofer` (`ID_Chofer`),
  CONSTRAINT `camion_chofer_ibfk_1` FOREIGN KEY (`ID_Camion`) REFERENCES `camiones` (`Placa`),
  CONSTRAINT `camion_chofer_ibfk_2` FOREIGN KEY (`ID_Chofer`) REFERENCES `choferes` (`Cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of camion_chofer
-- ----------------------------
INSERT INTO `camion_chofer` VALUES ('5e4h4', '27465814');
INSERT INTO `camion_chofer` VALUES ('7h895v', '45621305');
INSERT INTO `camion_chofer` VALUES ('7h895v', '195462354');

-- ----------------------------
-- Table structure for choferes
-- ----------------------------
DROP TABLE IF EXISTS `choferes`;
CREATE TABLE `choferes` (
  `Cedula` varchar(10) NOT NULL,
  `Nombre` varchar(20) DEFAULT '',
  `Apellido` varchar(20) DEFAULT '',
  PRIMARY KEY (`Cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of choferes
-- ----------------------------
INSERT INTO `choferes` VALUES ('15487695', 'manuel', 'blanco');
INSERT INTO `choferes` VALUES ('195462354', 'eden', 'hazard');
INSERT INTO `choferes` VALUES ('27465814', 'josue', 'paredes');
INSERT INTO `choferes` VALUES ('45621305', 'luka', 'modric');

-- ----------------------------
-- Table structure for fleteros
-- ----------------------------
DROP TABLE IF EXISTS `fleteros`;
CREATE TABLE `fleteros` (
  `ID_Fletero` int(11) NOT NULL,
  `Sector` varchar(20) DEFAULT '',
  PRIMARY KEY (`ID_Fletero`),
  KEY `ID_Fletero` (`ID_Fletero`),
  CONSTRAINT `fleteros_ibfk_1` FOREIGN KEY (`ID_Fletero`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of fleteros
-- ----------------------------

-- ----------------------------
-- Table structure for odp_fletero
-- ----------------------------
DROP TABLE IF EXISTS `odp_fletero`;
CREATE TABLE `odp_fletero` (
  `ID_ODP_Fletero` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Tarifa` int(11) DEFAULT NULL,
  `ID_Contralor` int(11) DEFAULT NULL,
  `ID_Solicitud` int(11) DEFAULT NULL,
  `Estado_Pago` int(11) NOT NULL,
  PRIMARY KEY (`ID_ODP_Fletero`),
  KEY `Tarifa_ID` (`ID_Tarifa`),
  KEY `Usuario_ID` (`ID_Contralor`),
  KEY `Solicitud_ID` (`ID_Solicitud`),
  CONSTRAINT `fk_odp_fletero_solicitud_fletero_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitud_fletero` (`ID_Solicitud_Fletero`),
  CONSTRAINT `fk_odp_fletero_usuario_1` FOREIGN KEY (`ID_Contralor`) REFERENCES `usuario` (`ID_Usuario`),
  CONSTRAINT `odp_ibfk_1` FOREIGN KEY (`ID_Tarifa`) REFERENCES `tarifas` (`ID_Tarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of odp_fletero
-- ----------------------------

-- ----------------------------
-- Table structure for odp_proveedor
-- ----------------------------
DROP TABLE IF EXISTS `odp_proveedor`;
CREATE TABLE `odp_proveedor` (
  `ID_ODP_Proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Contralor` int(11) NOT NULL,
  `ID_Tarifa` int(11) NOT NULL,
  `ID_Solicitud` int(11) NOT NULL,
  `Estado_Pago` int(11) NOT NULL,
  PRIMARY KEY (`ID_ODP_Proveedor`),
  KEY `fk_odp_proveedor_tarifas_1` (`ID_Tarifa`),
  KEY `fk_odp_proveedor_solicitud_proveedor_1` (`ID_Solicitud`),
  KEY `fk_odp_proveedor_usuario_1` (`ID_Contralor`),
  CONSTRAINT `fk_odp_proveedor_solicitud_proveedor_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitud_proveedor` (`ID_Solicitud_Proveedor`),
  CONSTRAINT `fk_odp_proveedor_tarifas_1` FOREIGN KEY (`ID_Tarifa`) REFERENCES `tarifas` (`ID_Tarifa`),
  CONSTRAINT `fk_odp_proveedor_usuario_1` FOREIGN KEY (`ID_Contralor`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of odp_proveedor
-- ----------------------------

-- ----------------------------
-- Table structure for planificaciones
-- ----------------------------
DROP TABLE IF EXISTS `planificaciones`;
CREATE TABLE `planificaciones` (
  `ID_Planificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Semana` varchar(10) NOT NULL,
  `Rango` int(11) NOT NULL,
  PRIMARY KEY (`ID_Planificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of planificaciones
-- ----------------------------
INSERT INTO `planificaciones` VALUES ('143', '2022-W28', '400');
INSERT INTO `planificaciones` VALUES ('144', '2022-W29', '700');
INSERT INTO `planificaciones` VALUES ('145', '2022-W30', '400');
INSERT INTO `planificaciones` VALUES ('146', '2022-W31', '200');

-- ----------------------------
-- Table structure for siembras
-- ----------------------------
DROP TABLE IF EXISTS `siembras`;
CREATE TABLE `siembras` (
  `ID_Siembra` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Terreno` int(11) NOT NULL,
  `ID_Proveedor` int(11) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Variedad` varchar(10) NOT NULL DEFAULT '',
  `Fecha_Cosecha` date NOT NULL,
  `Hectareas` float NOT NULL,
  `Rendimiento` float NOT NULL,
  `Kilos_Totales` float NOT NULL,
  PRIMARY KEY (`ID_Siembra`),
  KEY `ID_T` (`ID_Terreno`),
  KEY `ID_Proveedor` (`ID_Proveedor`),
  CONSTRAINT `fk_siembras_proveedor_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `usuario` (`ID_Usuario`),
  CONSTRAINT `fk_siembras_terrenos_1` FOREIGN KEY (`ID_Terreno`) REFERENCES `terrenos` (`ID_Terreno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of siembras
-- ----------------------------
INSERT INTO `siembras` VALUES ('2', '1', '9', '2022-07-13', '80', '2022-08-28', '14', '100', '500');
INSERT INTO `siembras` VALUES ('6', '4', '3', '2022-07-21', 'cosas', '2022-09-30', '1222', '45', '55555');
INSERT INTO `siembras` VALUES ('9', '1', '9', '2022-07-21', '58', '2022-07-30', '22222', '45', '1234');
INSERT INTO `siembras` VALUES ('10', '4', '3', '2022-07-15', '80', '2022-11-28', '44', '45', '300');

-- ----------------------------
-- Table structure for solicitud_fletero
-- ----------------------------
DROP TABLE IF EXISTS `solicitud_fletero`;
CREATE TABLE `solicitud_fletero` (
  `ID_Solicitud_Fletero` int(11) NOT NULL AUTO_INCREMENT,
  `Placa` varchar(10) NOT NULL DEFAULT '',
  `Observaciones` varchar(40) NOT NULL,
  `Estado_Aprobacion` int(11) NOT NULL,
  `Sector` varchar(20) NOT NULL DEFAULT '',
  `Martes` int(11) DEFAULT NULL,
  `Miercoles` int(11) DEFAULT NULL,
  `Jueves` int(11) DEFAULT NULL,
  `Viernes` int(11) DEFAULT NULL,
  `Sabado` int(11) DEFAULT NULL,
  `ID_Planificacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_Solicitud_Fletero`),
  KEY `ID_U` (`Placa`),
  CONSTRAINT `fk_solicitud_fletero_camiones_1` FOREIGN KEY (`Placa`) REFERENCES `camiones` (`Placa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of solicitud_fletero
-- ----------------------------

-- ----------------------------
-- Table structure for solicitud_proveedor
-- ----------------------------
DROP TABLE IF EXISTS `solicitud_proveedor`;
CREATE TABLE `solicitud_proveedor` (
  `ID_Solicitud_Proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Siembra` int(11) DEFAULT NULL,
  `Observaciones` varchar(40) DEFAULT NULL,
  `Estado_Aprobacion` int(11) NOT NULL,
  `Cantidad_MP` float NOT NULL,
  `ID_Planificacion` int(11) NOT NULL,
  `ID_Solicitud_Fletero` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Solicitud_Proveedor`),
  KEY `ID_U` (`ID_Siembra`),
  KEY `fk_solicitud_proveedor_planificaciones_1` (`ID_Planificacion`),
  KEY `fk_solicitud_proveedor_solicitud_fletero_1` (`ID_Solicitud_Fletero`),
  CONSTRAINT `fk_solicitud_proveedor_planificaciones_1` FOREIGN KEY (`ID_Planificacion`) REFERENCES `planificaciones` (`ID_Planificacion`),
  CONSTRAINT `fk_solicitud_proveedor_siembras_1` FOREIGN KEY (`ID_Siembra`) REFERENCES `siembras` (`ID_Siembra`),
  CONSTRAINT `fk_solicitud_proveedor_solicitud_fletero_1` FOREIGN KEY (`ID_Solicitud_Fletero`) REFERENCES `solicitud_fletero` (`ID_Solicitud_Fletero`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of solicitud_proveedor
-- ----------------------------
INSERT INTO `solicitud_proveedor` VALUES ('34', '6', null, '0', '300', '143', null);
INSERT INTO `solicitud_proveedor` VALUES ('35', '10', null, '0', '100', '144', null);
INSERT INTO `solicitud_proveedor` VALUES ('36', '10', null, '0', '200', '145', null);
INSERT INTO `solicitud_proveedor` VALUES ('37', '6', null, '0', '200', '145', null);
INSERT INTO `solicitud_proveedor` VALUES ('38', '10', null, '0', '100', '146', null);
INSERT INTO `solicitud_proveedor` VALUES ('39', '6', null, '0', '300', '146', null);

-- ----------------------------
-- Table structure for tarifas
-- ----------------------------
DROP TABLE IF EXISTS `tarifas`;
CREATE TABLE `tarifas` (
  `ID_Tarifa` int(11) NOT NULL AUTO_INCREMENT,
  `Pago_Flete` float NOT NULL,
  `Pago_MP` float NOT NULL,
  PRIMARY KEY (`ID_Tarifa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tarifas
-- ----------------------------

-- ----------------------------
-- Table structure for terrenos
-- ----------------------------
DROP TABLE IF EXISTS `terrenos`;
CREATE TABLE `terrenos` (
  `ID_Terreno` int(11) NOT NULL AUTO_INCREMENT,
  `Tamanio` float DEFAULT NULL,
  `Ubicacion` varchar(40) DEFAULT NULL,
  `ID_Usuario` int(11) NOT NULL,
  PRIMARY KEY (`ID_Terreno`),
  KEY `fk_terrenos_usuario_1` (`ID_Usuario`),
  CONSTRAINT `fk_terrenos_usuario_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of terrenos
-- ----------------------------
INSERT INTO `terrenos` VALUES ('1', '54621', 'raul leoni', '9');
INSERT INTO `terrenos` VALUES ('2', '78245', 'trinitarias', '5');
INSERT INTO `terrenos` VALUES ('3', '888888', 'molinos', '4');
INSERT INTO `terrenos` VALUES ('4', '4791360', 'molinos', '3');

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_Usuario` int(11) DEFAULT NULL,
  `Password` varchar(200) NOT NULL,
  `Nombre` varchar(20) DEFAULT '',
  `Apellido` varchar(20) DEFAULT '',
  `Cedula` varchar(10) DEFAULT '',
  `Telefono` varchar(20) DEFAULT '',
  `Email` varchar(30) DEFAULT '',
  `Direccion` varchar(50) DEFAULT '',
  `RIF` varchar(12) DEFAULT '',
  `Banco_P` varchar(30) DEFAULT '',
  `Cuenta_P` varchar(20) DEFAULT '',
  `TipoCuenta_P` varchar(10) DEFAULT '',
  `Banco_A` varchar(30) DEFAULT '',
  `Cuenta_A` varchar(20) DEFAULT '',
  `TipoCuenta_A` varchar(10) DEFAULT '',
  `Nombre_A` varchar(20) DEFAULT '',
  `Apellido_A` varchar(20) DEFAULT NULL,
  `Pregunta` varchar(50) NOT NULL,
  `Respuesta` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', '1', '7334ec5a5364990f83b50d2ef8403912', 'Gabriel', 'Antuarez', '28216052', '+584166284044', 'antuarez18@gmail.com', 'Calle 10 casa#535', '54646464646', '', '', '', '', '', '', null, null, '', '');
INSERT INTO `usuario` VALUES ('3', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'diegos', 'gimenez', '12546789', '04129876411', 'diegogo@gmail.com', 'las flores', '125467892', 'BANCO PROVINCIAL', '5731956458825', 'AHORRO', 'BANCAMIGA BANCO UNIVERSAL', '0105465798132', 'AHORRO', 'javiera', 'marcano', '', '');
INSERT INTO `usuario` VALUES ('4', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'juan', 'cortez', '89786545', '04164587979', 'juancho@hotmail.com', 'las carolinasa', '897865453', 'BANCO MERCANTIL', '264859713', 'AHORRO', 'BANCAMIGA BANCO UNIVERSAL', '564823179', 'CORRIENTE', 'kun', 'aguero', '', '');
INSERT INTO `usuario` VALUES ('5', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'argenis', 'carrion', '47888654', '04167824561', 'argve@gmail.com', 'penelope', '478886542', 'BANCO MERCANTIL', '5412541232565', 'AHORRO', 'BANCO MERCANTIL', '279183513975', 'CORRIENTE', 'ANA', 'PALOMA', '', '');
INSERT INTO `usuario` VALUES ('6', '4', '827ccb0eea8a706c4c34a16891f84e7b', 'jose alberto', 'Nuñes', '10485623', '0416555553', 'acosta@gmail.com', 'boquerona', '12345', 'BANCO MERCANTIL', '78932154675', 'CORRIENTE', 'BANCAMIGA BANCO UNIVERSAL', '58237641987', 'CORRIENTE', 'alberta', 'martinelli', '', '');
INSERT INTO `usuario` VALUES ('7', '4', '827ccb0eea8a706c4c34a16891f84e7b', 'luis', 'hernandez', '134567', '04124865977', 'luis@gmail.com', 'calle', '1345672', 'BANCO PROVINCIAL', '45678941234', 'CORRIENTE', 'BANCO PROVINCIAL', '1247892154', 'AHORRO', 'Geronimo', 'Benavidez', '', '');
INSERT INTO `usuario` VALUES ('8', '4', '827ccb0eea8a706c4c34a16891f84e7b', 'liomar', 'masacre', '6523458', '584269315426', 'lio@gmail.com', 'la callejona', '65234582', 'BANCO NACIONAL DE CRÉDITO', '54611297831', 'CORRIENTE', 'BANCO MERCANTIL', '397164825', 'CORRIENTE', 'Gabriel', 'Antuarez', '', '');
INSERT INTO `usuario` VALUES ('9', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'jennifer', 'sucre', '123456789', '04128915616', 'jennifersu@gmail.com', 'en su casa', '1234567891', 'BANCO DEL TESORO', '936852174', 'AHORRO', 'BANCO MERCANTIL', '825647139', 'CORRIENTE', 'jose', 'luis', '', '');
INSERT INTO `usuario` VALUES ('10', '2', '81dc9bdb52d04dc20036dbd8313ed055', 'juana', 'Perez', '15465789', '04166284043', 'chupamipalo@gmail.com', 'esquina', '1546578925', '', '', '', '', '', '', null, null, '', '');
INSERT INTO `usuario` VALUES ('11', '2', '83b4ef5ae4bb360c96628aecda974200', 'Josue', 'henriquez', '45369781', '0412654897', 'jj@gmail.com', 'calle 1', '45652213', '', '', '', '', '', '', '', null, '', '');
INSERT INTO `usuario` VALUES ('12', '2', '81dc9bdb52d04dc20036dbd8313ed055', 'illo', 'juan', '12456839', '0412587469', 'illo@gmail.com', 'depto 101', '12456839', '', '', '', '', '', '', '', null, '', '');