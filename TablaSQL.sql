DROP DATABASE if exists SARP;
CREATE DATABASE SARP;
USE SARP;

-- Tabla de Datos Personales
create table datosPersonales(
	 id_usuario int auto_increment NOT NULL,
     nombre varchar(20) NOT NULL,
     apellido varchar(20) NOT NULL,
     correo varchar(20) NOT NULL,
     RIF varchar(12) NOT NULL,
     direccion varchar(40),
     telefono varchar(12),
     sector_trabajo varchar(20),
     primary key(id_usuario)
);

-- Tabla de Datos Bancarios
create table datosBancarios(); 
