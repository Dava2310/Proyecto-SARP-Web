DROP DATABASE if exists sarp;
CREATE DATABASE sarp;
use sarp;


CREATE TABLE `camion_chofer` (

`ID_Camion` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`ID_Chofer` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

INDEX `ID_Camion` (`ID_Camion`),

INDEX `ID_Chofer` (`ID_Chofer`)

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci
;



CREATE TABLE `camiones` (

`Placa` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,

`Modelo` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Capacidad` float NULL,

`ID_Fleteros` int NOT NULL,

PRIMARY KEY (`Placa`) 

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci
;



CREATE TABLE `choferes` (

`Cedula` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,

`Nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Apellido` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

PRIMARY KEY (`Cedula`) 

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci
;



CREATE TABLE `fleteros` (

`ID_Fletero` int(11) NOT NULL,

`Sector` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

PRIMARY KEY (`ID_Fletero`) ,

INDEX `ID_Fletero` (`ID_Fletero`) -- ,

-- INDEX `Placa_camion` ()

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci
;



CREATE TABLE `odp_fletero` (

`ID_ODP_Fletero` int NOT NULL AUTO_INCREMENT,

`ID_Tarifa` int(11) NULL,

`ID_Contralor` int(11) NULL,

`ID_Solicitud` int(11) NULL,

`Estado_Pago` int NOT NULL,

PRIMARY KEY (`ID_ODP_Fletero`) ,

INDEX `Tarifa_ID` (`ID_Tarifa`),

-- INDEX `Planificacion_ID` (),

-- INDEX `Lote_ID` (),

INDEX `Usuario_ID` (`ID_Contralor`),

INDEX `Solicitud_ID` (`ID_Solicitud`)

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci
;



CREATE TABLE `planificaciones` (

`ID_Planificacion` int(11) NOT NULL AUTO_INCREMENT,

`Semana` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,

`Rango` int(11) NOT NULL,

PRIMARY KEY (`ID_Planificacion`) 

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `siembras` (

`ID_Siembra` int(11) NOT NULL AUTO_INCREMENT,

`ID_Terreno` int(11) NOT NULL,

`ID_Proveedor` int(11) NOT NULL,

`Fecha_Inicio` datetime NOT NULL,

`Variedad` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',

`Fecha_Cosecha` datetime NOT NULL,

`Hectareas` float NOT NULL,

`Rendimiento` float NOT NULL,

`Kilos_Totales` float NOT NULL,

PRIMARY KEY (`ID_Siembra`) ,

INDEX `ID_T` (`ID_Terreno`),

INDEX `ID_Proveedor` (`ID_Proveedor`)

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `solicitud_fletero` (

`ID_Solicitud_Fletero` int(11) NOT NULL AUTO_INCREMENT,

`Placa` varchar(10) NOT NULL DEFAULT '',

`Observaciones` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,

`Estado_Aprobacion` int(11) NOT NULL,

`Sector` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',

`Martes` int(11) NULL,

`Miercoles` int(11) NULL,

`Jueves` int(11) NULL,

`Viernes` int(11) NULL,

`Sabado` int(11) NULL,

`ID_Planificacion` varchar(255) NULL,

PRIMARY KEY (`ID_Solicitud_Fletero`) ,

INDEX `ID_U` (`Placa`)

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `solicitud_proveedor` (

`ID_Solicitud_Proveedor` int(11) NOT NULL AUTO_INCREMENT,

`ID_Siembra` int(11) NULL DEFAULT NULL,

`Observaciones` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,

`Estado_Aprobacion` int(11) NOT NULL,

`Cantidad_MP` float NOT NULL,

`ID_Planificacion` int NOT NULL,

`ID_Solicitud_Fletero` int NOT NULL,

PRIMARY KEY (`ID_Solicitud_Proveedor`) ,

INDEX `ID_U` (`ID_Siembra`)

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `tarifas` (

`ID_Tarifa` int(11) NOT NULL AUTO_INCREMENT,

`Pago_Flete` float NOT NULL,

`Pago_MP` float NOT NULL,

PRIMARY KEY (`ID_Tarifa`) 

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `terrenos` (

`ID_Terreno` int(11) NOT NULL AUTO_INCREMENT,

`Tamanio` float NOT NULL,

`Ubicacion` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,

`ID_Usuario` int NOT NULL,

PRIMARY KEY (`ID_Terreno`) 

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `usuario` (

`ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,

`tipo_Usuario` int(11) NULL,

`Password` varchar(35) NOT NULL,

`Nombre` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Apellido` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Cedula` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Telefono` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Direccion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`RIF` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Banco_P` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Cuenta_P` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`TipoCuenta_P` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Banco_A` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Cuenta_A` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`TipoCuenta_A` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Nombre_A` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

`Apellido_A` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',

PRIMARY KEY (`ID_Usuario`) 

)

ENGINE=InnoDB

DEFAULT CHARACTER SET=utf8mb4 COLLATE=utf8mb4_general_ci

AUTO_INCREMENT=1
;



CREATE TABLE `odp_proveedor` (

`ID_ODP_Proveedor` int NOT NULL AUTO_INCREMENT,

`ID_Contralor` int NOT NULL,

`ID_Tarifa` int NOT NULL,

`ID_Solicitud` int NOT NULL,

`Estado_Pago` int NOT NULL,

PRIMARY KEY (`ID_ODP_Proveedor`) 

);





ALTER TABLE `camion_chofer` ADD CONSTRAINT `camion_chofer_ibfk_1` FOREIGN KEY (`ID_Camion`) REFERENCES `camiones` (`Placa`);

ALTER TABLE `camion_chofer` ADD CONSTRAINT `camion_chofer_ibfk_2` FOREIGN KEY (`ID_Chofer`) REFERENCES `choferes` (`Cedula`);

ALTER TABLE `fleteros` ADD CONSTRAINT `fleteros_ibfk_1` FOREIGN KEY (`ID_Fletero`) REFERENCES `usuario` (`ID_Usuario`);

ALTER TABLE `odp_fletero` ADD CONSTRAINT `odp_ibfk_1` FOREIGN KEY (`ID_Tarifa`) REFERENCES `tarifas` (`ID_Tarifa`);

ALTER TABLE `camiones` ADD CONSTRAINT `fk_camiones_fleteros_1` FOREIGN KEY (`ID_Fleteros`) REFERENCES `fleteros` (`ID_Fletero`);

ALTER TABLE `terrenos` ADD CONSTRAINT `fk_terrenos_usuario_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuario` (`ID_Usuario`);

ALTER TABLE `siembras` ADD CONSTRAINT `fk_siembras_terrenos_1` FOREIGN KEY (`ID_Terreno`) REFERENCES `terrenos` (`ID_Terreno`);

ALTER TABLE `solicitud_proveedor` ADD CONSTRAINT `fk_solicitud_proveedor_siembras_1` FOREIGN KEY (`ID_Siembra`) REFERENCES `siembras` (`ID_Siembra`);

ALTER TABLE `solicitud_fletero` ADD CONSTRAINT `fk_solicitud_fletero_camiones_1` FOREIGN KEY (`Placa`) REFERENCES `camiones` (`Placa`);

-- ALTER TABLE `solicitud_fletero` ADD CONSTRAINT `fk_solicitud_fletero_planificaciones_1` FOREIGN KEY (`ID_Planificacion`) REFERENCES `planificaciones` (`ID_Planificacion`);

ALTER TABLE `solicitud_proveedor` ADD CONSTRAINT `fk_solicitud_proveedor_planificaciones_1` FOREIGN KEY (`ID_Planificacion`) REFERENCES `planificaciones` (`ID_Planificacion`);

ALTER TABLE `odp_proveedor` ADD CONSTRAINT `fk_odp_proveedor_tarifas_1` FOREIGN KEY (`ID_Tarifa`) REFERENCES `tarifas` (`ID_Tarifa`);

ALTER TABLE `odp_proveedor` ADD CONSTRAINT `fk_odp_proveedor_solicitud_proveedor_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitud_proveedor` (`ID_Solicitud_Proveedor`);

ALTER TABLE `odp_fletero` ADD CONSTRAINT `fk_odp_fletero_solicitud_fletero_1` FOREIGN KEY (`ID_Solicitud`) REFERENCES `solicitud_fletero` (`ID_Solicitud_Fletero`);

ALTER TABLE `odp_fletero` ADD CONSTRAINT `fk_odp_fletero_usuario_1` FOREIGN KEY (`ID_Contralor`) REFERENCES `usuario` (`ID_Usuario`);

ALTER TABLE `odp_proveedor` ADD CONSTRAINT `fk_odp_proveedor_usuario_1` FOREIGN KEY (`ID_Contralor`) REFERENCES `usuario` (`ID_Usuario`);

ALTER TABLE `solicitud_proveedor` ADD CONSTRAINT `fk_solicitud_proveedor_solicitud_fletero_1` FOREIGN KEY (`ID_Solicitud_Fletero`) REFERENCES `solicitud_fletero` (`ID_Solicitud_Fletero`);



