-- CREATE SCHEMA IF NOT EXISTS `ns_hospital` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci ;

-- ---------------------------------------
-- Start Create Tables
-- -----------------------------------------------------

-- ---------------------------------------
-- Table `mydb`.`tblRolUsuario`
-- ----------------------------------------
CREATE TABLE IF NOT EXISTS `tblRolUsuario` (
  `ID_ROL` INT NOT NULL,
  `NOMBRE` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_ROL`));
-- -----------------------------------------------------
-- Table `mydb`.`tblUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS tblUsuario (
  `ID_USUARIO` INT NOT NULL AUTO_INCREMENT,
  `CEDULA` VARCHAR(45) NULL,
  `NOMBRE` VARCHAR(100) NULL,
  `APELLIDO` VARCHAR(100) NULL,
  `EMAIL` VARCHAR(100) NULL,
  `TELEFONO` VARCHAR(45) NULL,
  `CIUDAD` VARCHAR(100) NULL,
  `FECHA_NACIMIENTO` DATE NULL,
  `GENERO` VARCHAR(45) NULL,
  `NICKNAME` VARCHAR(50) NULL,
  `PASSWORD` VARCHAR(50) NULL,
  `FK_ID_ROL` INT NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),

  CONSTRAINT `fk_tblUsuario_tblRolUsuario`
    FOREIGN KEY (`FK_ID_ROL`)
    REFERENCES `tblRolUsuario` (`ID_ROL`));


-- -----------------------------------------------------
-- Table `mydb`.`tblTipoPersona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblTipoPersona` (
  `ID_TIPO_PERSONA` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_TIPO_PERSONA`))
;

-- -----------------------------------------------------
-- Table `tblPersona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblPersona` (
  `ID_PERSONA` INT NOT NULL AUTO_INCREMENT,
  `CEDULA` VARCHAR(45) NULL,
  `APELLIDO` VARCHAR(100) NULL,
  `NOMBRE` VARCHAR(100) NULL,
  `EMAIL` VARCHAR(45) NULL,
  `TELEFONO` VARCHAR(45) NULL,
  `DIRECCION` VARCHAR(100) NULL,
  `CIUDAD` VARCHAR(100) NULL,
  `FECHA_NACIMIENTO` DATE NULL,
  `GENERO` VARCHAR(45) NULL,
  `FK_ID_TIPO_PERSONA` INT NOT NULL,
  `FK_ID_USUARIO` INT NOT NULL,
  PRIMARY KEY (`ID_PERSONA`),
  CONSTRAINT `fk_tblPersona_tblTipoPersona1`
    FOREIGN KEY (`FK_ID_TIPO_PERSONA`)
    REFERENCES `tblTipoPersona` (`ID_TIPO_PERSONA`),
    CONSTRAINT `fk_tblpersona_tblUsuario1`
    FOREIGN KEY (`FK_ID_USUARIO`)
    REFERENCES `tblUsuario` (`ID_USUARIO`)
    
    )
;

-- -----------------------------------------------------
-- Table `mydb`.`tblEspecialidad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblEspecialidad` (
  `ID_ESPECIALIDAD` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE` VARCHAR(200) NULL,
  `DESCRIPCION` VARCHAR(200) NULL,
  PRIMARY KEY (`ID_ESPECIALIDAD`))
;


-- -----------------------------------------------------
-- Table `tblEspecialidadPersona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblEspecialidadPersona` (
  `ID_ESPECIALIDAD_PERSONA` INT NOT NULL AUTO_INCREMENT,
  `FK_ID_ESPECIALIDAD` INT NOT NULL,
  `FK_ID_PERSONA` INT NOT NULL,
  PRIMARY KEY (`ID_ESPECIALIDAD_PERSONA`),
  CONSTRAINT `fk_tblEspecialidadPersona_tblEspecialidad1`
    FOREIGN KEY (`FK_ID_ESPECIALIDAD`)
    REFERENCES `tblEspecialidad` (`ID_ESPECIALIDAD`),
     CONSTRAINT `fk_tblEspecialidadPersona_tblPersona1`
    FOREIGN KEY (`FK_ID_PERSONA`)
    REFERENCES `tblPersona` (`ID_PERSONA`))
;

-- -----------------------------------------------------
-- Table `tblEstadoCita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblEstadoCita` (
  `ID_ESTADO_CITA` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_ESTADO_CITA`))
;


-- -----------------------------------------------------
-- Table `tblCita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblCita` (
  `ID_CITA` INT NOT NULL AUTO_INCREMENT,
  `FECHA_CITA` DATE NULL,
  `INICIO_CITA` DATETIME NULL,
  `FIN_CITA` DATETIME NULL,
  `MOTIVO` VARCHAR(200) NULL,
  `FK_ID_PACIENTE` INT NOT NULL,
  `FK_ID_MEDICO` INT NOT NULL,
  `FK_ID_USUARIO` INT NOT NULL,
  `FK_ID_ESTADO_CITA` INT NOT NULL,
  PRIMARY KEY (`ID_CITA`),
  CONSTRAINT `fk_tblCita_tblPersona1`
    FOREIGN KEY (`FK_ID_PACIENTE`)
    REFERENCES `tblPersona` (`ID_PERSONA`)
    
    ,
  CONSTRAINT `fk_tblCita_tblPersona2`
    FOREIGN KEY (`FK_ID_MEDICO`)
    REFERENCES `tblPersona` (`ID_PERSONA`)
    
    ,
  CONSTRAINT `fk_tblCita_tblUsuario1`
    FOREIGN KEY (`FK_ID_USUARIO`)
    REFERENCES `tblUsuario` (`ID_USUARIO`)
    
    ,
  CONSTRAINT `fk_tblCita_tblEstadoCita1`
    FOREIGN KEY (`FK_ID_ESTADO_CITA`)
    REFERENCES `tblEstadoCita` (`ID_ESTADO_CITA`)
    
    )
;

/*
-- -----------------------------------------------------
-- Table `tblEstadoExamen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblEstadoExamen` (
  `ID_ESTADO_EXAMEN` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE` VARCHAR(45) NULL,
  PRIMARY KEY (`ID_ESTADO_EXAMEN`))
;
*/

-- -----------------------------------------------------
-- Table `tblExamen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblExamen` (
  `ID_EXAMEN` INT NOT NULL AUTO_INCREMENT,
  `FECHA_EXAMEN` VARCHAR(45) NULL,
  `DETALLE` NVARCHAR(100) NULL,
  `IMAGEN` VARCHAR(45) NULL,
  `FK_ID_CITA` INT NOT NULL,
  PRIMARY KEY (`ID_EXAMEN`),
  CONSTRAINT `fk_tblExamen_Cita1`
    FOREIGN KEY (`FK_ID_CITA`)
    REFERENCES `tblCita` (`ID_CITA`) 
    )
;


-- -----------------------------------------------------
-- Table `tblReceta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblReceta` (
  `ID_RECETA` INT NOT NULL AUTO_INCREMENT,
  `FECHA_RECETA` DATE NULL,
  `DESCRIPCION` VARCHAR(400) NULL,
  `FK_ID_CITA` INT NOT NULL,
  PRIMARY KEY (`ID_RECETA`),
  CONSTRAINT `fk_tblReceta_tblCita1`
    FOREIGN KEY (`FK_ID_CITA`)
    REFERENCES `tblCita` (`ID_CITA`)
    
    )
;


-- -----------------------------------------------------
-- Table `tblDiagnostico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblDiagnostico` (
  `ID_DIAGNOSTICO` INT NOT NULL AUTO_INCREMENT,
  `NOMBRE` VARCHAR(100) NULL,
  `DESCRIPCION` VARCHAR(200) NULL,
  PRIMARY KEY (`ID_DIAGNOSTICO`))
;


-- -----------------------------------------------------
-- Table `tblDiagnosticoCita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tblDiagnosticoCita` (
  `ID_DIAGNOSTICO_CITA` INT NOT NULL,
  `FK_ID_DIAGNOSTICO` INT NOT NULL,
  `FK_ID_CITA` INT NOT NULL,
  `DESCRIPCION` VARCHAR(400) NULL,
  PRIMARY KEY (`ID_DIAGNOSTICO_CITA`),
  CONSTRAINT `fk_tblDiagnosticoCita_tblDiagnostico1`
    FOREIGN KEY (`FK_ID_DIAGNOSTICO`)
    REFERENCES `tblDiagnostico` (`ID_DIAGNOSTICO`)
    
    ,
  CONSTRAINT `fk_tblDiagnostico_tblCita1`
    FOREIGN KEY (`FK_ID_CITA`)
    REFERENCES `tblCita` (`ID_CITA`)
    
    )
;

-----------------------------------------
-- End Create Tables
-- --------------------------------------

-----------------------------------------
-- Start insert default values
-- --------------------------------------

INSERT IGNORE INTO tblrolusuario(ID_ROL,NOMBRE)
VALUES (1, 'Administrador');
INSERT IGNORE INTO tblrolusuario(ID_ROL,NOMBRE)
VALUES (2, 'Medico');
INSERT IGNORE INTO tblrolusuario(ID_ROL,NOMBRE)
VALUES (3, 'Cliente');


/*Default Users*/
INSERT INTO tblusuario (`CEDULA`, `NOMBRE`, `APELLIDO`, `EMAIL`, `TELEFONO`, `CIUDAD`, `FECHA_NACIMIENTO`, `GENERO`, `NICKNAME`, `PASSWORD`, `FK_ID_ROL`)
VALUES ('0919705863', 'Super', 'User', 'administrador@gmail.com', '0995696856', 'GYE', '1984-03-21', 'M', 'admin', '123', '1');
INSERT INTO tblusuario (`CEDULA`, `NOMBRE`, `APELLIDO`, `EMAIL`, `TELEFONO`, `CIUDAD`, `FECHA_NACIMIENTO`, `GENERO`, `NICKNAME`, `PASSWORD`, `FK_ID_ROL`)
VALUES ('0919705863', 'Maria', 'Salvador', 'm@gmail.com', '0995696856', 'GYE', '1984-03-21', 'F', 'mary', '123', '3');


/*Default Especialidades*/
INSERT INTO tblespecialidad	(ID_ESPECIALIDAD,NOMBRE,DESCRIPCION)
			VALUES ('1','Pediatria', 'Cmampo dedicado a los menores de edad y neonatos.');        
INSERT INTO tblespecialidad	(ID_ESPECIALIDAD,NOMBRE,DESCRIPCION)
			VALUES ('2','Ginecología', 'Es el campo de la medicina que se ocupa de la salud integral de la mujer');
 INSERT INTO tblespecialidad(ID_ESPECIALIDAD,NOMBRE,DESCRIPCION)
			VALUES ('3','Traumatología', ' Rama de la medicina encargada del estudio, tratamiento y prevención de las lesiones');     

 /*Default Tipo de Persona*/
INSERT INTO tbltipopersona(ID_TIPO_PERSONA,NOMBRE)
VALUES(1,'Medico');
INSERT INTO tbltipopersona(ID_TIPO_PERSONA,NOMBRE)
VALUES(2,'Paciente');

-----------------------------------------
-- End insert default values
-- --------------------------------------
 /*Default Citas*/
INSERT INTO tblestadocita (`ID_ESTADO_CITA`, `NOMBRE`) VALUES ('1', 'Confirmada');
INSERT INTO tblestadocita (`ID_ESTADO_CITA`, `NOMBRE`) VALUES ('2', 'Realizada');


