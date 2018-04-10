/*****************************************************************************************************/
CREATE DATABASE soap_03_03;
/* Esta BD sera usada por la UNI*/
USE soap_03_03;
CREATE TABLE lista_alumnos_uni(
    nombre_alumno   varchar(50) PRIMARY KEY NOT NULL,
    email           varchar(50),
    fecha_egresado  datetime,    
    ponderado       float
);

USE soap_03_3;
ALTER TABLE lista_alumnos_uni
ADD nombre_profesor varchar(50);

USE soap_03_03;
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('frank','frank@gmail.com','2017-10-23 19:23:34',12.9,"arevalo");

USE soap_03_03;
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('adolfo','adolfo@gmail.com','2011-10-23 19:23:34',12.9,"almeida");
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('julio','julio@gmail.com','2012-10-23 19:23:34',12.9,"almeida");
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('erlinda','erlinda@gmail.com','2011-10-23 19:23:34',12.9,"velazco");
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('cesar','cesar@gmail.com','2010-10-23 19:23:34',12.9,"velazco");
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('lucy','lucy@gmail.com','2009-10-23 19:23:34',12.9,"arevalo");
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('omar','omar@gmail.com','2007-10-23 19:23:34',12.9,"arevalo");
INSERT INTO lista_alumnos_uni (nombre_alumno,email,fecha_egresado,ponderado,nombre_profesor) 
VALUES ('alejandra','alejandra@gmail.com','2006-10-23 19:23:34',12.9,"velazco");

use soap_03_03;
CREATE PROCEDURE obtener_datos (IN profesor varchar(50))
  BEGIN
     SELECT * 
     FROM lista_alumnos_uni
     WHERE nombre_profesor= profesor;
lista_alumnos_unisoap_03_03
call obtener_datos("arevalo")

