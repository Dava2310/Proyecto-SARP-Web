/*
Navicat MySQL Data Transfer

Source Server         : sarp
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : sarp

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-05-30 11:57:23
*/
DROP DATABASE if exists SARP;
CREATE DATABASE SARP;
USE SARP;

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
INSERT INTO `camiones` VALUES ('A12BC3D', 'Toyota', '200', '7');
INSERT INTO `camiones` VALUES ('R12DG5J', 'chevrolet', '900', '7');

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
INSERT INTO `camion_chofer` VALUES ('A12BC3D', '15487695');
INSERT INTO `camion_chofer` VALUES ('R12DG5J', '5467894');

-- ----------------------------
-- Table structure for choferes
-- ----------------------------
DROP TABLE IF EXISTS `choferes`;
CREATE TABLE `choferes` (
  `Cedula` varchar(10) NOT NULL,
  `Nombre` varchar(20) DEFAULT '',
  `Apellido` varchar(20) DEFAULT '',
  `ID_Fleteros` int(11) NOT NULL,
  PRIMARY KEY (`Cedula`),
  KEY `fk_choferes_fleteros_1` (`ID_Fleteros`),
  CONSTRAINT `fk_choferes_fleteros_1` FOREIGN KEY (`ID_Fleteros`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of choferes
-- ----------------------------
INSERT INTO `choferes` VALUES ('15487695', 'manuel', 'blanco', '7');
INSERT INTO `choferes` VALUES ('195462354', 'eden', 'hazard', '3');
INSERT INTO `choferes` VALUES ('20541369', 'pedro', 'benito', '5');
INSERT INTO `choferes` VALUES ('27465814', 'josue', 'paredes', '3');
INSERT INTO `choferes` VALUES ('45621305', 'luka', 'modric', '12');
INSERT INTO `choferes` VALUES ('5467894', 'roberto', 'gomez', '7');
INSERT INTO `choferes` VALUES ('5467895', 'jose alberto', 'Nuñes', '7');
INSERT INTO `choferes` VALUES ('54678955', 'diegos', 'gimenez', '7');

-- ----------------------------
-- Table structure for codigo
-- ----------------------------
DROP TABLE IF EXISTS `codigo`;
CREATE TABLE `codigo` (
  `idCodigos` int(11) NOT NULL AUTO_INCREMENT,
  `codigoProveedor` varchar(15) NOT NULL,
  `codigoFletero` varchar(15) NOT NULL,
  `codigoAgropecuaria` varchar(15) NOT NULL,
  `codigoContraloria` varchar(15) NOT NULL,
  `ultima_actualizacion` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idCodigos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of codigo
-- ----------------------------
INSERT INTO `codigo` VALUES ('1', '4213', '8218', '7844', '6561', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for fleteros
-- ----------------------------
DROP TABLE IF EXISTS `fleteros`;
CREATE TABLE `fleteros` (
  `ID_Fletero` int(11) NOT NULL,
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
  `ID_Contralor` int(11) DEFAULT NULL,
  `ID_Solicitud` int(11) DEFAULT NULL,
  `Estado_Pago` int(11) NOT NULL,
  PRIMARY KEY (`ID_ODP_Fletero`),
  KEY `Usuario_ID` (`ID_Contralor`),
  KEY `Solicitud_ID` (`ID_Solicitud`),
  CONSTRAINT `fk_odp_fletero_solicitud_fletero_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitud_fletero` (`ID_Solicitud_Fletero`),
  CONSTRAINT `fk_odp_fletero_usuario_1` FOREIGN KEY (`ID_Contralor`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of odp_fletero
-- ----------------------------
INSERT INTO `odp_fletero` VALUES ('4', '1', '17', '1');

-- ----------------------------
-- Table structure for odp_proveedor
-- ----------------------------
DROP TABLE IF EXISTS `odp_proveedor`;
CREATE TABLE `odp_proveedor` (
  `ID_ODP_Proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Contralor` int(11) NOT NULL,
  `ID_Solicitud` int(11) NOT NULL,
  `Estado_Pago` int(11) NOT NULL,
  PRIMARY KEY (`ID_ODP_Proveedor`),
  KEY `fk_odp_proveedor_solicitud_proveedor_1` (`ID_Solicitud`),
  KEY `fk_odp_proveedor_usuario_1` (`ID_Contralor`),
  CONSTRAINT `fk_odp_proveedor_solicitud_proveedor_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitud_proveedor` (`ID_Solicitud_Proveedor`),
  CONSTRAINT `fk_odp_proveedor_usuario_1` FOREIGN KEY (`ID_Contralor`) REFERENCES `usuario` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of odp_proveedor
-- ----------------------------
INSERT INTO `odp_proveedor` VALUES ('6', '1', '40', '0');

-- ----------------------------
-- Table structure for planificaciones
-- ----------------------------
DROP TABLE IF EXISTS `planificaciones`;
CREATE TABLE `planificaciones` (
  `ID_Planificacion` int(11) NOT NULL AUTO_INCREMENT,
  `Semana` varchar(10) NOT NULL,
  `Rango` int(11) NOT NULL,
  PRIMARY KEY (`ID_Planificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of planificaciones
-- ----------------------------
INSERT INTO `planificaciones` VALUES ('143', '2022-W28', '310');
INSERT INTO `planificaciones` VALUES ('144', '2022-W29', '700');
INSERT INTO `planificaciones` VALUES ('145', '2022-W30', '400');
INSERT INTO `planificaciones` VALUES ('146', '2022-W31', '200');
INSERT INTO `planificaciones` VALUES ('147', '2023-W21', '20');
INSERT INTO `planificaciones` VALUES ('152', '2023-W20', '500');
INSERT INTO `planificaciones` VALUES ('153', '2023-W22', '460');
INSERT INTO `planificaciones` VALUES ('154', '2023-W23', '85');
INSERT INTO `planificaciones` VALUES ('155', '2023-W24', '310');
INSERT INTO `planificaciones` VALUES ('156', '2023-W27', '90');
INSERT INTO `planificaciones` VALUES ('157', '2023-W29', '0');
INSERT INTO `planificaciones` VALUES ('158', '2023-W18', '270');

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
  `Kilos_Arrimados` float DEFAULT NULL,
  `Saldo_Restante` float DEFAULT NULL,
  `Analisis` varchar(20) DEFAULT NULL,
  `MateriaSeca` float DEFAULT NULL,
  `Impureza` float DEFAULT NULL,
  `KilosMuestra` float DEFAULT NULL,
  PRIMARY KEY (`ID_Siembra`),
  KEY `ID_T` (`ID_Terreno`),
  KEY `ID_Proveedor` (`ID_Proveedor`),
  CONSTRAINT `fk_siembras_proveedor_1` FOREIGN KEY (`ID_Proveedor`) REFERENCES `usuario` (`ID_Usuario`),
  CONSTRAINT `fk_siembras_terrenos_1` FOREIGN KEY (`ID_Terreno`) REFERENCES `terrenos` (`ID_Terreno`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of siembras
-- ----------------------------
INSERT INTO `siembras` VALUES ('2', '1', '9', '2022-07-13', '80', '2022-08-28', '14', '0', '470', '20', '500', 'RECHAZADO', '20', '30', '200');
INSERT INTO `siembras` VALUES ('6', '4', '3', '2022-07-21', 'cosas', '2022-09-30', '1222', '0', '55195', '30', '55495', 'APROBADO', '10', '40', '80');
INSERT INTO `siembras` VALUES ('9', '1', '9', '2022-07-21', '58', '2022-07-30', '22222', '0', '1234', '0', '1234', 'APROBADO', '50', '20', '500');
INSERT INTO `siembras` VALUES ('10', '4', '3', '2022-07-15', '80', '2022-11-28', '44', '0', '300', '0', '300', 'RECHAZADO', '20', '50', '100');

-- ----------------------------
-- Table structure for solicitud_fletero
-- ----------------------------
DROP TABLE IF EXISTS `solicitud_fletero`;
CREATE TABLE `solicitud_fletero` (
  `ID_Solicitud_Fletero` int(11) NOT NULL AUTO_INCREMENT,
  `Placa` varchar(10) DEFAULT '',
  `Observaciones` varchar(40) DEFAULT NULL,
  `Estado_Aprobacion` int(11) NOT NULL,
  `Dia` date DEFAULT NULL,
  `ID_Planificacion` varchar(255) DEFAULT NULL,
  `ID_chofer` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Solicitud_Fletero`),
  KEY `ID_U` (`Placa`),
  KEY `fk_solicitud_fletero_chofer_1` (`ID_chofer`),
  CONSTRAINT `fk_solicitud_fletero_camiones_1` FOREIGN KEY (`Placa`) REFERENCES `camiones` (`Placa`),
  CONSTRAINT `fk_solicitud_fletero_chofer_1` FOREIGN KEY (`ID_chofer`) REFERENCES `camion_chofer` (`ID_Chofer`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of solicitud_fletero
-- ----------------------------
INSERT INTO `solicitud_fletero` VALUES ('17', 'R12DG5J', '', '1', '2023-05-30', '147', '5467894');
INSERT INTO `solicitud_fletero` VALUES ('18', 'A12BC3D', null, '0', null, '147', null);
INSERT INTO `solicitud_fletero` VALUES ('19', 'R12DG5J', '', '1', '2023-05-31', '154', '5467894');
INSERT INTO `solicitud_fletero` VALUES ('20', 'A12BC3D', null, '0', null, '154', null);
INSERT INTO `solicitud_fletero` VALUES ('21', 'R12DG5J', null, '0', null, '147', null);
INSERT INTO `solicitud_fletero` VALUES ('22', 'R12DG5J', null, '0', null, '154', null);
INSERT INTO `solicitud_fletero` VALUES ('23', 'A12BC3D', '', '1', '2023-05-31', '143', '15487695');

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of solicitud_proveedor
-- ----------------------------
INSERT INTO `solicitud_proveedor` VALUES ('34', '6', '', '1', '300', '143', '23');
INSERT INTO `solicitud_proveedor` VALUES ('35', '10', null, '0', '100', '144', null);
INSERT INTO `solicitud_proveedor` VALUES ('36', '10', '', '1', '200', '145', null);
INSERT INTO `solicitud_proveedor` VALUES ('39', '6', null, '0', '300', '146', null);
INSERT INTO `solicitud_proveedor` VALUES ('40', '2', 'hola', '1', '10', '147', '17');
INSERT INTO `solicitud_proveedor` VALUES ('41', '2', '', '1', '20', '147', null);
INSERT INTO `solicitud_proveedor` VALUES ('43', '6', '', '1', '100', '154', '19');
INSERT INTO `solicitud_proveedor` VALUES ('46', '10', '', '1', '20', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('47', '10', null, '0', '15', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('48', '10', null, '0', '16', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('49', '10', null, '0', '100', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('50', '10', null, '0', '30', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('51', '10', null, '0', '17', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('52', '10', null, '0', '17', '154', '23');
INSERT INTO `solicitud_proveedor` VALUES ('53', '10', null, '0', '100', '154', null);
INSERT INTO `solicitud_proveedor` VALUES ('54', '10', null, '0', '100', '155', null);
INSERT INTO `solicitud_proveedor` VALUES ('55', '10', null, '0', '50', '155', null);
INSERT INTO `solicitud_proveedor` VALUES ('56', '10', null, '0', '20', '155', null);
INSERT INTO `solicitud_proveedor` VALUES ('57', '10', null, '0', '20', '155', null);
INSERT INTO `solicitud_proveedor` VALUES ('58', '9', '', '1', '10', '156', null);
INSERT INTO `solicitud_proveedor` VALUES ('59', '9', '', '1', '10', '153', null);
INSERT INTO `solicitud_proveedor` VALUES ('60', '2', null, '0', '10', '153', null);
INSERT INTO `solicitud_proveedor` VALUES ('61', '2', null, '0', '20', '153', null);
INSERT INTO `solicitud_proveedor` VALUES ('62', '6', null, '0', '10', '143', null);
INSERT INTO `solicitud_proveedor` VALUES ('63', '6', null, '0', '20', '143', null);
INSERT INTO `solicitud_proveedor` VALUES ('64', '6', null, '0', '30', '143', null);
INSERT INTO `solicitud_proveedor` VALUES ('65', '6', null, '0', '300', '157', null);
INSERT INTO `solicitud_proveedor` VALUES ('66', '6', null, '0', '30', '143', null);
INSERT INTO `solicitud_proveedor` VALUES ('67', '6', null, '0', '10', '158', null);
INSERT INTO `solicitud_proveedor` VALUES ('68', '6', null, '0', '20', '158', null);

-- ----------------------------
-- Table structure for tarifas
-- ----------------------------
DROP TABLE IF EXISTS `tarifas`;
CREATE TABLE `tarifas` (
  `ID_Tarifa` int(11) NOT NULL AUTO_INCREMENT,
  `Pago_Flete` float NOT NULL,
  `Pago_MP` float NOT NULL,
  `Pago_Cuadrilla` float NOT NULL,
  `ID_Solicitud_Proveedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Tarifa`),
  KEY `fr_key_SP` (`ID_Solicitud_Proveedor`),
  CONSTRAINT `fr_key_SP` FOREIGN KEY (`ID_Solicitud_Proveedor`) REFERENCES `solicitud_proveedor` (`ID_Solicitud_Proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tarifas
-- ----------------------------
INSERT INTO `tarifas` VALUES ('8', '200', '200', '1000', '40');

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
INSERT INTO `terrenos` VALUES ('1', '500', 'las flores', '9');
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES ('1', '1', '81dc9bdb52d04dc20036dbd8313ed055', 'Gabriel', 'Antuarez', '28216052', '+584166284044', 'antuarez18@gmail.com', 'Calle 10 casa#535', '546464646', '', '', '', '', '', '', null, null, '', '');
INSERT INTO `usuario` VALUES ('3', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'diegos', 'gimenez', '12546789', '4129876411', 'diegogo@gmail.com', 'las flores', '125467892', 'BANCO DE VENEZUELA', '57319564588251234567', 'AHORRO', 'BANCAMIGA BANCO UNIVERSAL', '01054657981321234567', 'AHORRO', 'javiera', 'marcano', '', '');
INSERT INTO `usuario` VALUES ('4', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'juan', 'cortez', '89786545', '4164587979', 'juancho@hotmail.com', 'las carolinasa', '89786545', 'BANCO MERCANTIL', '26485971312345687985', 'CORRIENTE', 'BANCAMIGA BANCO UNIVERSAL', '56482317911234567897', 'CORRIENTE', 'kun', 'aguero', '', '');
INSERT INTO `usuario` VALUES ('5', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'argenis', 'carrion', '47888654', '4167824561', 'argve@gmail.com', 'penelope', '47888654', 'BANCO MERCANTIL', '54125412325651234567', 'AHORRO', 'BANCO MERCANTIL', '27918351397512345678', 'CORRIENTE', 'ANA', 'PALOMA', '', '');
INSERT INTO `usuario` VALUES ('6', '4', '827ccb0eea8a706c4c34a16891f84e7b', 'jose alberto', 'Nuñes', '10485623', '4165555535', 'acosta@gmail.com', 'boquerona', '123456789', 'BANCO MERCANTIL', '78932154675123456789', 'CORRIENTE', 'BANCAMIGA BANCO UNIVERSAL', '58237641987123456789', 'CORRIENTE', 'alberta', 'martinelli', '', '');
INSERT INTO `usuario` VALUES ('7', '4', '827ccb0eea8a706c4c34a16891f84e7b', 'luis', 'hernandez', '134567', '4124865977', 'luis@gmail.com', 'calle', '1345672', 'BANCO PROVINCIAL', '45678941234', 'CORRIENTE', 'BANCO PROVINCIAL', '1247892154', 'AHORRO', 'Geronimo', 'Benavidez', '', '');
INSERT INTO `usuario` VALUES ('8', '4', '827ccb0eea8a706c4c34a16891f84e7b', 'liomar', 'masacre', '6523458', '+584269315426', 'lio@gmail.com', 'la callejona', '65234582', 'BANCO NACIONAL DE CRÉDITO', '54611297831123456789', 'CORRIENTE', 'BANCO MERCANTIL', '39716482512345678945', 'CORRIENTE', 'Gabriel', 'Antuarez', '', '');
INSERT INTO `usuario` VALUES ('9', '3', '81dc9bdb52d04dc20036dbd8313ed055', 'jennifer', 'sucre', '123456789', '4128915616', 'jennifersu@gmail.com', 'en su casa', '123456789', 'BANCO DEL TESORO', '93685217412345678945', 'AHORRO', 'BANCO DEL CARIBE', '01054657981321234567', 'CORRIENTE', 'javiera', 'PALOMA', '', '');
INSERT INTO `usuario` VALUES ('11', '2', '81dc9bdb52d04dc20036dbd8313ed055', 'Josues', 'henriquezes', '45369781', '4126548970', 'jj@gmail.com', 'calle 12', '456522132', '', '', '', '', '', '', '', null, 'si?', 'si');
INSERT INTO `usuario` VALUES ('12', '2', '81dc9bdb52d04dc20036dbd8313ed055', 'illo', 'juan', '12456839', '0412587469', 'illo@gmail.com', 'depto 101', '12456839', '', '', '', '', '', '', '', null, '', '');
INSERT INTO `usuario` VALUES ('36', '2', '81dc9bdb52d04dc20036dbd8313ed055', 'pedro', 'Nuñes', '123456', '', 'pn@gmail.com', '', '', '', '', '', '', '', '', '', null, 'si?', 'si');
DROP TRIGGER IF EXISTS `nombre_del_disparador`;
DELIMITER ;;
CREATE TRIGGER `nombre_del_disparador` AFTER INSERT ON `solicitud_fletero` FOR EACH ROW BEGIN
  -- Actualizar el campo en la otra tabla con el nuevo valor
  UPDATE solicitud_proveedor SET  ID_Solicitud_Fletero= NEW.ID_Solicitud_Fletero WHERE ID_Solicitud_Proveedor = 52; -- Coloca las condiciones adecuadas para identificar el registro en la tabla_destino
END
;;
DELIMITER ;
