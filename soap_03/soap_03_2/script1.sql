CREATE DATABASE soap_03_02;
/* Esta BD sera usada por la PUCP*/
USE soap_03_02;

CREATE TABLE lista_alumnos_pucp (
  nombre_alumno   varchar(50) primary key not null,
  telefono        varchar(50),
  edad            int(2),
  fecha_nac       datetime,
  nombre_profesor varchar(50),
  promedio        float
  );

USE soap_03_02;
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor,promedio)
VALUES ('camilo', '5404194', 32, '1985-12-22 23:22:22', 'arevalo', 12.5);

USE soap_03_02;
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('sebastian', '994965430', 14, '2002-12-10 10:22:12', 'velazco', 18.2);
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('martin', '994962123', 54, '2002-11-10 10:22:12', 'velazco', 13.4);
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('luis', '654942980', 65, '2002-12-10 10:22:12', 'velazco', 8.2);
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('juan', '994962980', 12, '2002-11-10 10:22:12', 'arevalo', 5.12);
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('yanet', '992962980', 27, '2002-12-10 10:22:12', 'arevalo', 15.4);
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('estheycy', '994923980', 9, '2002-12-10 20:22:12', 'almeida', 20.0);
INSERT INTO lista_alumnos_pucp (nombre_alumno, telefono, edad, fecha_nac, nombre_profesor, promedio)
VALUES ('chino', '454962980', 19, '1902-12-10 13:22:12', 'almeida', 19.2);

