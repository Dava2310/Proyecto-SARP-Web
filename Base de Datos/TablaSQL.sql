DROP DATABASE if exists SARP;
CREATE DATABASE SARP;
USE SARP;

-- Tabla de Usuario Principal
create table Usuario(
	ID_Usuario int auto_increment NOT NULL,
    Nombre varchar(20), 
    Apellido varchar(20),
    Cedula varchar(10),
    Telefono varchar(12), 
    Email varchar(30), 
    Direccion varchar(50),
    RIF varchar(12),
	PRIMARY KEY (ID_Usuario)
); 

create table Proveedores(
	-- Datos Unicos
    -- Cuenta Personal
    ID_U int,
    Banco_P varchar(30),
    Cuenta_P varchar(20),
    TipoCuenta_P varchar(10),
    -- Cuenta Autorizado
    Banco_A varchar(30),
    Cuenta_A varchar(20),
    TipoCuenta_A varchar(10),
	FOREIGN KEY(ID_U) REFERENCES Usuario(ID_Usuario)
);

create table Terrenos(
	ID_Terreno int auto_increment NOT NULL,
    Tamanio float NOT NULL,
    Ubicacion varchar(40) NOT NULL,
    PRIMARY KEY(ID_Terreno)
);

create table Siembras(
	ID_Lote int auto_increment NOT NULL,
    ID_T int,
    ID_Proveedor int,
	Fecha_Inicio datetime,
    Variedad varchar(10),
    Fecha_Cosecha datetime,
    Hectareas float,
    Rendimiento float,
    Kilos_Totales float,
    PRIMARY KEY(ID_Lote),
    FOREIGN KEY(ID_T) REFERENCES Terrenos(ID_Terreno),
	FOREIGN KEY(ID_Proveedor) REFERENCES Proveedores(ID_U)
);

create table Fleteros(
	-- Datos Unicos
    Sector varchar(20),
    ID_U int,
	-- Cuenta Personal
    Banco_P varchar(30),
    Cuenta_P varchar(20),
    TipoCuenta_P varchar(10),
    -- Cuenta Autorizado
    Banco_A varchar(30),
    Cuenta_A varchar(20),
    TipoCuenta_A varchar(10),
	FOREIGN KEY(ID_U) REFERENCES Usuario(ID_Usuario)
);


create table Choferes(
	Cedula varchar(10),
    Nombre varchar(20),
    Apellido varchar(20),
    PRIMARY KEY(Cedula)
);

create table Camiones(
	Placa varchar(10),
    Modelo varchar(15),
    Capacidad float,
    PRIMARY KEY(Placa)
);

create table Camion_Chofer(
	ID_Camion varchar(10),
    ID_Chofer varchar(10),
	FOREIGN KEY(ID_Camion) REFERENCES Camiones(Placa),
    FOREIGN KEY(ID_Chofer) REFERENCES Choferes(Cedula)
);


create table Contraloria(
	-- Datos Unicos
    -- Este no tiene cuenta bancaria de ningun tipo
    ID_U int,
	FOREIGN KEY(ID_U) REFERENCES Usuario(ID_Usuario)
);

create table Tarifas(
	ID_Tarifa int auto_increment NOT NULL,
    Pago_Flete float NOT NULL,
    Pago_MP float NOT NULL,
	PRIMARY KEY(ID_Tarifa)
);

create table Agropecuario(
	-- Datos Unicos
    -- Este no tiene cuenta bancaria de ningun tipo
    ID_U int,
	FOREIGN KEY(ID_U) REFERENCES Usuario(ID_Usuario)
);

create table Planificaciones(
	ID_Pro int auto_increment NOT NULL,
    Semana varchar(10) NOT NULL,
    Rango int NOT NULL,
    PRIMARY KEY(ID_Pro)
);

create table Solicitudes(
	ID_Solicitud int auto_increment NOT NULL,
    Martes int NOT NULL,
    Miercoles int NOT NULL,
    Jueves int NOT NULL,
    Viernes int NOT NULL,
    Sabado int NOT NULL,
    PRIMARY KEY(ID_Solicitud)
);

create table Solicitud_Fletero(
	ID_SolicitudF int auto_increment NOT NULL,
    ID_U int,
    Solicitud_F int,
    PRIMARY KEY(ID_SolicitudF),
    Observaciones varchar(40) NOT NULL,
    Estado_Aprobacion int NOT NULL,
    Cantidad_MP float NOT NULL,
    Sector varchar(20),
	FOREIGN KEY(ID_U) REFERENCES Usuario(ID_Usuario),
	FOREIGN KEY(Solicitud_F) REFERENCES Solicitudes(ID_Solicitud)
);

create table Solicitud_Proveedor(
	ID_SolicitudP int auto_increment NOT NULL,
    ID_U int,
    Solicitud_F int,
    PRIMARY KEY(ID_SolicitudP),
	Observaciones varchar(40) NOT NULL,
    Estado_Aprobacion int NOT NULL,
    Cantidad_MP float NOT NULL,
	FOREIGN KEY(ID_U) REFERENCES Usuario(ID_Usuario),
	FOREIGN KEY(Solicitud_F) REFERENCES Solicitudes(ID_Solicitud)
);

create table ODP(
	Tarifa_ID int,
    Planificacion_ID int,
    Lote_ID int,
    Usuario_ID int,
    Solicitud_ID int,
	-- ID TARIFA
    FOREIGN KEY(Tarifa_ID) REFERENCES Tarifas(ID_Tarifa),
    -- ID PLANIFICACION
    FOREIGN KEY(Planificacion_ID) REFERENCES Planificaciones(ID_Pro),
    -- ID LOTE
    FOREIGN KEY(Lote_ID) REFERENCES Siembras(ID_Lote),
    -- ID USUARIO
    FOREIGN KEY(Usuario_ID) REFERENCES Usuario(ID_Usuario),
    -- ID SOLICITUDPROVEEODR
    FOREIGN KEY(Solicitud_ID) REFERENCES Solicitud_Proveedor(ID_SolicitudP)
);
