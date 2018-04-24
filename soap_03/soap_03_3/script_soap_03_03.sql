/*--------------  AHORA SI VIENE EL CODIGO QUE SE APLICARA SOBRE LA BD   --------------------*/

CREATE DATABASE soap_03_03;


USE `soap_03_03`;
CREATE TABLE `tabla_pais` (
    `Id_Pais` TINYINT NOT NULL AUTO_INCREMENT,
    `Nombre_Pais` VARCHAR(50) NULL,
    PRIMARY KEY (`Id_Pais`)
)
ENGINE=INNODB;

ALTER TABLE `tabla_pais`
ADD CONSTRAINT PK_NOMBRE_PAIS 
UNIQUE KEY (`Nombre_Pais`);

INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Peru');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Ecuador');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Brazil');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Alemania');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('USA');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Rusia');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Francia');
INSERT INTO `tabla_pais` (`Nombre_Pais`) VALUES ('Australia');

/*-----------------------------------------------------------------------------------------*/

USE `soap_03_03`;
CREATE TABLE `tabla_ahorro` (
	`Id` INT(11) NOT NULL AUTO_INCREMENT,
	`Nombre` VARCHAR(255) NULL DEFAULT '0',
	`Ahorro` SMALLINT(6) NULL DEFAULT '0',
	`Sexo` VARCHAR(50) DEFAULT 'Hombre',
	`Id_Pais` TINYINT NOT NULL, 
	PRIMARY KEY (`Id`),
	UNIQUE (`Nombre`),
	CONSTRAINT FK_Id_Pais FOREIGN KEY (`Id_Pais`) REFERENCES `tabla_pais`(`Id_Pais`)
)
COMMENT='Esta es nuestra primera tabla para practicar.'
ENGINE=INNODB;


/*
USE `demo_ci`;
DELIMITER $$
CREATE PROCEDURE insertar_tabla_codeigniter(IN Nombre VARCHAR(255), IN Ahorro SMALLINT, IN Sexo VARCHAR(50),
                                            IN Id_Pais TINYINT, OUT Resultado BOOL)
 BEGIN                                         
    DECLARE `_rollback` BOOL DEFAULT 0;
  
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
      BEGIN
	      SET `_rollback` = 1;
      END;
    
      IF(Sexo <> 'Hombre' AND Sexo <> 'Mujer') THEN 
	      SET Resultado = FALSE;
      ELSE 
         START TRANSACTION;
	         INSERT INTO `tabla_practica_codelobster_1`(Nombre, Ahorro, Sexo, Id_Pais) VALUES( Nombre, Ahorro, Sexo, Id_Pais);
	         IF `_rollback`= 0  THEN
	             SET Resultado = TRUE;
				    COMMIT;
				ELSE
				    SET Resultado = FALSE;
				    ROLLBACK;
            END IF;
      END IF;
      
    SELECT Resultado;
 
 END$$
DELIMITER $$

CALL insertar_tabla_codeigniter('Jodrse', 123, 'Mujer', 2, @resultado);
SELECT @resultado;

*/

USE `soap_03_03`;
DELIMITER $$
CREATE PROCEDURE `insertar_tabla_ahorro`(IN Nombre VARCHAR(255), IN Ahorro SMALLINT, 
                                         IN Sexo VARCHAR(50), IN Id_Pais TINYINT) 
  BEGIN
   DECLARE error_check CONDITION FOR SQLSTATE '90001';
      IF (Sexo<>'Hombre' AND Sexo<> 'Mujer') THEN
	      SIGNAL error_check
	          SET MESSAGE_TEXT = 'El sexo ingrasado no es hombre ni mujer, estan tratando de VULNERAR el sistema',
			    MYSQL_ERRNO = 12345;
	   ELSE
			   INSERT INTO `tabla_ahorro`(Nombre, Ahorro, Sexo, Id_Pais) VALUES( Nombre, Ahorro, Sexo, Id_Pais);
      END IF;
      
      SELECT ta.Id,ta.Nombre, ta.Ahorro, ta.Sexo,tp.Id_Pais,tp.Nombre_Pais
		FROM tabla_ahorro ta INNER JOIN tabla_pais tp
		ON ta.Id_Pais = tp.Id_Pais
		ORDER BY ta.Id;
  END$$
DELIMITER $$

/*CALL `insertar_tabla_ahorro`('cam1iFDDDGFdfgdfl24',234,'Mujer',4);
  CALL `insertar_tabla_ahorro`('Atahualpa8',234,'Mujer',4);
*/



USE `soap_03_03`;
DELIMITER $$
CREATE PROCEDURE `datos_persona`(IN Id INT)
 BEGIN
     SELECT  ta.Id,ta.Nombre,ta.Ahorro,ta.Sexo,ta.Id_Pais,tp.Nombre_Pais
	  FROM   `tabla_ahorro` ta INNER JOIN `tabla_pais` tp 
	  ON ta.Id_Pais = tp.Id_Pais
	  WHERE ta.Id = Id;
 END $$
DELIMITER $$

/*CALL `datos_persona`(20);*/


USE soap_03_03;
DELIMITER $$
CREATE PROCEDURE `select_todos_los_datos`()
 BEGIN
   SELECT ta.Id,ta.Nombre,ta.Ahorro,ta.Sexo,ta.Id_Pais,tp.Nombre_Pais
   FROM  tabla_ahorro ta INNER JOIN tabla_pais tp
   ON ta.Id_Pais = tp.Id_Pais
   ORDER BY ta.Id;
 END $$
DELIMITER $$

/*CALL `select_todos_los_datos`();*/



USE soap_03_03;
DELIMITER $$
CREATE PROCEDURE `select_pais`()
 BEGIN
   SELECT *
   FROM tabla_pais;
 END $$
DELIMITER $$

/*CALL `select_pais`();*/


USE soap_03_03;
DELIMITER $$
CREATE PROCEDURE `eliminar_persona`(IN _Id INT)
 BEGIN
   DELETE FROM tabla_ahorro
   WHERE Id= _Id;
   CALL `select_todos_los_datos`();
 END $$

DELIMITER $$

/*call  `eliminar_persona`(76);*/


USE soap_03_03;
DELIMITER $$
CREATE PROCEDURE `actualizar_persona`(
     IN Id INT, 
     IN Nombre VARCHAR(255),
     IN Ahorro SMALLINT,
     IN Sexo VARCHAR(50),
     IN Id_Pais TINYINT
  )
 BEGIN
   DECLARE error_check CONDITION FOR SQLSTATE '90002';
   IF(Sexo<>'Hombre' AND Sexo<>'Mujer') THEN
        SIGNAL error_check
          SET MESSAGE_TEXT = 'El sexo ingresado no es ni hombre ni mujer',
          MYSQL_ERRNO = 12346;
   ELSE 
       UPDATE tabla_ahorro ta
		 SET ta.Nombre = Nombre, ta.Ahorro = Ahorro, ta.Sexo = Sexo, ta.Id_Pais = Id_Pais
		 WHERE ta.Id = Id;
   END IF;
   
   SELECT ta.Id,ta.Nombre, ta.Ahorro, ta.Sexo,tp.Id_Pais,tp.Nombre_Pais
	FROM tabla_ahorro ta INNER JOIN tabla_pais tp
   ON ta.Id_Pais = tp.Id_Pais
   ORDER BY ta.Id;
 END $$
 
DELIMITER $$

/*CALL `actualizar_persona`(3,'camilo',999,'Hombre',8);
CALL `actualizar_persona`(999,'camilo',999,'Hombre',8);*/


USE soap_03_03;
DELIMITER $$
CREATE PROCEDURE `obtener_lista_paises`()
BEGIN
  SELECT *
  FROM tabla_pais;
END $$

DELIMITER $$

/*CALL obtener_lista_paises();*/



INSERT INTO `tabla_ahorro` (`Id`, `Nombre`, `Ahorro`, `Sexo`, `Id_Pais`) VALUES
	(2, 'arreglado', 10, 'Mujer', 4),
	(3, 'camilo', 999, 'Hombre', 8),
	(16, 'stacy', 321, 'Mujer', 4),
	(17, 'rosa', 49, 'Mujer', 5),
	(22, 'rosa1', 49, 'Mujer', 1),
	(24, 'rosaa1', 49, 'Mujer', 1),
	(25, 'feo', 321, 'Hombre', 4),
	(26, 'Jhonatan', 321, 'Hombre', 1),
	(27, 'stacy3w3', 321, 'Mujer', 4),
	(28, 'stacy3ws3', 321, 'Mujer', 4),
	(40, 'carla', 321, 'Mujer', 2),
	(42, 'carsadla', 321, 'Mujer', 6),
	(43, 'Kiara Gutierrez', 222, 'Mujer', 5),
	(44, 'Yanette Huilla Rosillo', 333, 'Mujer', 8),
	(45, 'Freddy Rodas', 444, 'Hombre', 3),
	(46, 'stalin', 999, 'Hombre', 6);
























