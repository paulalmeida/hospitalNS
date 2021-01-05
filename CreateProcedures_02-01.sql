
/*View Sections*/
DELIMITER ;

DROP VIEW IF EXISTS `view_GetCitas`;
CREATE VIEW `view_GetCitas`
AS
	SELECT c.ID_CITA,
			c.FECHA_CITA,
			c.INICIO_CITA,
            c.FIN_CITA,
			c.MOTIVO,
			c.FK_ID_PACIENTE,
			pac.Apellido 'A_PACIENTE',
			pac.Nombre 'N_PACIENTE',
			c.FK_ID_MEDICO,
			doc.Apellido 'A_MEDICO',
			doc.Nombre 'N_MEDICO',
			c.FK_ID_USUARIO,
			u.Apellido 'A_USUARIO',
			u.Nombre 'N_USUARIO',
			c.FK_ID_ESTADO_CITA,
			ec.NOMBRE 'ESTADO_CITA'
	FROM tblcita c
		INNER JOIN tblPersona pac
			ON c.FK_ID_PACIENTE = pac.ID_PERSONA
				INNER JOIN tblPersona doc
					ON c.FK_ID_MEDICO = doc.ID_PERSONA
						INNER JOIN tblUsuario u
							ON c.FK_ID_USUARIO = u.ID_USUARIO
								INNER JOIN tblEstadoCita ec
									ON c.FK_ID_ESTADO_CITA = ec.ID_ESTADO_CITA;

DELIMITER ;                                    

DROP procedure IF EXISTS `uspGetUserByNickName`;

DELIMITER $$

CREATE PROCEDURE uspGetUserByNickName(	pNickName VARCHAR(45), pRolId int)
BEGIN
	SELECT  u.ID_USUARIO,
            u.CEDULA,
            u.NOMBRE,
            u.APELLIDO,
            u.EMAIL,
            u.TELEFONO,
            u.CIUDAD,
            u.FECHA_NACIMIENTO,
            u.GENERO,
            u.NICKNAME,
            u.PASSWORD,
            u.FK_ID_ROL,
            r.NOMBRE as NOMBRE_ROL
		FROM tblusuario u
			INNER JOIN tblrolusuario r
				on u.FK_ID_ROL = r.ID_ROL		
	WHERE NICKNAME = pNickName and FK_ID_ROL = pRolId;
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetAllUsers`;

DELIMITER $$

CREATE PROCEDURE uspGetAllUsers()
BEGIN
	SELECT  u.u.ID_USUARIO,
            u.CEDULA,
            u.NOMBRE,
            u.APELLIDO,
            u.EMAIL,
            u.TELEFONO,
            u.CIUDAD,
            u.FECHA_NACIMIENTO,
            u.GENERO,
            u.NICKNAME,
            u.PASSWORD,
            u.FK_ID_ROL,
            r.NOMBRE as NOMBRE_ROL
		FROM tblusuario u
			INNER JOIN tblrolusuario r
				on u.FK_ID_ROL = r.ID_ROL		;
	
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetUserById`;

DELIMITER $$

CREATE PROCEDURE uspGetUserById(pUsuarioID INT)
BEGIN
	SELECT u.ID_USUARIO,
            u.CEDULA,
            u.NOMBRE,
            u.APELLIDO,
            u.EMAIL,
            u.TELEFONO,
            u.CIUDAD,
            u.FECHA_NACIMIENTO,
            u.GENERO,
            u.NICKNAME,
            u.PASSWORD,
            u.FK_ID_ROL,
            r.NOMBRE as NOMBRE_ROL
		FROM tblusuario u
			INNER JOIN tblrolusuario r
				on u.FK_ID_ROL = r.ID_ROL
					where ID_USUARIO = pUsuarioID;
END$$


DELIMITER ;



DROP procedure IF EXISTS `uspSetUser`;

DELIMITER $$

CREATE PROCEDURE uspSetUser
(
pID_USUARIO int(11) ,
pCEDULA_USUARIO varchar(100) ,
pNOMBRE_USUARIO varchar(100) ,
pAPELLIDO_USUARIO varchar(200) ,
pEMAIL_USUARIO varchar(100) ,
pTELEFONO_USUARIO varchar(45) ,
pCIUDAD_USUARIO varchar(45) ,
pFECHA_NACIMIENTO_USUARIO date ,
pGENERO char(1) ,
pNICKNAME varchar(45) ,
pPASSWORD_USUARIO varchar(45) ,
pFK_ID_ROL int(11) ,
pRETURN_VALUE bit
)


BEGIN

	IF pRETURN_VALUE = NULL THEN SET pRETURN_VALUE = 1; END IF;
	
	IF pID_USUARIO IS NULL THEN
       SET pID_USUARIO = 0;
    END IF;
        
	IF (pID_USUARIO = 0) THEN
       
		INSERT INTO tblusuario
				(`CEDULA`,
				`NOMBRE`,
				`APELLIDO`,
				`EMAIL`,
				`TELEFONO`,
				`CIUDAD`,
				`FECHA_NACIMIENTO`,
				`GENERO`,
				`NICKNAME`,
				`PASSWORD`,
				`FK_ID_ROL`)
		VALUES
				(pCEDULA_USUARIO  ,
				pNOMBRE_USUARIO ,
				pAPELLIDO_USUARIO ,
				pEMAIL_USUARIO ,
				pTELEFONO_USUARIO ,
				pCIUDAD_USUARIO ,
				pFECHA_NACIMIENTO_USUARIO ,
				pGENERO ,
				pNICKNAME ,
				pPASSWORD_USUARIO ,
				pFK_ID_ROL );
                
                SET pID_USUARIO = LAST_INSERT_ID();
                
	ELSE
		
			UPDATE tblusuario
				SET
				`CEDULA` = pCEDULA_USUARIO,
				`NOMBRE`= pNOMBRE_USUARIO,
				`APELLIDO`= pAPELLIDO_USUARIO,
				`EMAIL`= pEMAIL_USUARIO,
				`TELEFONO`= pTELEFONO_USUARIO,
				`CIUDAD`= pCIUDAD_USUARIO,
				`FECHA_NACIMIENTO`= pFECHA_NACIMIENTO_USUARIO,
				`GENERO`= pGENERO,
				`NICKNAME`= pNICKNAME,
				`PASSWORD`= pPASSWORD_USUARIO,
				`FK_ID_ROL`=  pFK_ID_ROL
			WHERE `ID_USUARIO` = pID_USUARIO;

            
	END IF ;
    
    IF pRETURN_VALUE = 1 THEN 
		SELECT pID_USUARIO;
	END IF;
                

    
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetAllDiagnostico`;

DELIMITER $$

CREATE PROCEDURE uspGetAllDiagnostico()
BEGIN
	SELECT ID_DIAGNOSTICO,
		   NOMBRE,
		   DESCRIPCION
	FROM  tbl diagnostico;
		
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetDiagnosticoById`;

DELIMITER $$

CREATE PROCEDURE uspGetDiagnosticoById(pID_DIAGNOSTICO INT)
BEGIN
	SELECT ID_DIAGNOSTICO,
		   NOMBRE,
		   DESCRIPCION
	FROM  tbl diagnostico
	WHERE ID_DIAGNOSTICO = pID_DIAGNOSTICO;
END$$;


DELIMITER ;

DROP procedure IF EXISTS `uspSetDiagnostico`;

DELIMITER $$

CREATE PROCEDURE uspSetDiagnostico
(
	pID_DIAGNOSTICO int(11),
	pNOMBRE varchar(100),
	pDESCRIPCION varchar(200)
)
BEGIN

	
	IF pID_DIAGNOSTICO IS NULL THEN
       SET pID_DIAGNOSTICO = 0;
    END IF;
        
	IF (pID_DIAGNOSTICO = 0) THEN
			
            INSERT INTO tbldiagnostico
					(ID_DIAGNOSTICO,
					NOMBRE,
					DESCRIPCION)
			VALUES
					(pID_DIAGNOSTICO>
					pNOMBRE,
					pDESCRIPCION);
                
			SET pID_DIAGNOSTICO = LAST_INSERT_ID();
	ELSE
			UPDATE tbldiagnostico
			SET
				ID_DIAGNOSTICO = ID_DIAGNOSTICO,
				NOMBRE = NOMBRE,
				DESCRIPCION = DESCRIPCION
			WHERE ID_DIAGNOSTICO = pID_DIAGNOSTICO;

            
	END IF ;
    
    SELECT pID_USUARIO;
    
END$$


DELIMITER ;

DROP procedure IF EXISTS `uspDeleteDiagnosticoById`;

DELIMITER $$

CREATE PROCEDURE uspDeleteDiagnosticoById
(
	pID_DIAGNOSTICO int(11)
)
BEGIN
	
    DELETE FROM tbldiagnostico
	WHERE ID_DIAGNOSTICO = pID_DIAGNOSTICO;
    
END$$;


DELIMITER ;

DROP procedure IF EXISTS `uspGetAllEspecialidad`;

DELIMITER $$

CREATE PROCEDURE uspGetAllEspecialidad()
BEGIN
	SELECT ID_ESPECIALIDAD,
		NOMBRE,
		DESCRIPCION
FROM 	tblespecialidad;

		
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetEspecialidadById`;

DELIMITER $$

CREATE PROCEDURE uspGetEspecialidadById(pID_ESPECIALIDAD INT)
BEGIN
	SELECT ID_ESPECIALIDAD,
		NOMBRE,
		DESCRIPCION
	FROM 	tblespecialidad
	WHERE ID_ESPECIALIDAD = pID_ESPECIALIDAD;
END$$;


DELIMITER ;

DROP procedure IF EXISTS `uspSetEspecialidad`;

DELIMITER $$

CREATE PROCEDURE uspSetEspecialidad
(
	pID_ESPECIALIDAD int(11),
	pNOMBRE varchar(100),
	pDESCRIPCION varchar(200)
)
BEGIN

	
	IF pID_ESPECIALIDAD IS NULL THEN
       SET pID_ESPECIALIDAD = 0;
    END IF;
        
	IF (pID_ESPECIALIDAD = 0) THEN
			
			INSERT INTO tblespecialidad
			(ID_ESPECIALIDAD,
		     NOMBRE,
			 DESCRIPCION)
			VALUES
			(pID_ESPECIALIDAD,
			 pNOMBRE,
			 pDESCRIPCION);
                
			SET pID_ESPECIALIDAD = LAST_INSERT_ID();
	ELSE
			UPDATE tblespecialidad
			SET
				ID_ESPECIALIDAD = pID_ESPECIALIDAD,
				NOMBRE = pNOMBRE,
				DESCRIPCION = pDESCRIPCION
			WHERE ID_ESPECIALIDAD = pID_ESPECIALIDAD;

            
	END IF ;
    
    SELECT pID_ESPECIALIDAD;
    
END$$


DELIMITER ;

DROP procedure IF EXISTS `uspDeleteEspecialidadById`;

DELIMITER $$

CREATE PROCEDURE uspDeleteEspecialidadById
(
	pID_ESPECIALIDAD int(11)
)
BEGIN
	
    DELETE FROM tblespecialidad
	WHERE ID_ESPECIALIDAD = pID_ESPECIALIDAD;
    
END$$;


DELIMITER ;

DROP procedure IF EXISTS `uspGetPersonasByTipo`;

DELIMITER $$

CREATE PROCEDURE uspGetPersonasByTipo(pFK_ID_TIPO_PERSONA int)
BEGIN
	
    SELECT p.ID_PERSONA,
			p.CEDULA,
			p.APELLIDO,
			p.NOMBRE,
			p.EMAIL,
			p.TELEFONO,
			p.DIRECCION,
			p.CIUDAD,
			p.FECHA_NACIMIENTO,
			p.GENERO,
			p.FK_ID_TIPO_PERSONA,
			p.FK_ID_USUARIO,
            tp.NOMBRE 'NOMBRE_TIPO_PERSONA'
	FROM tblpersona p
		INNER JOIN tbltipopersona tp
			ON p.FK_ID_TIPO_PERSONA = tp.ID_TIPO_PERSONA
				WHERE p.FK_ID_TIPO_PERSONA  = pFK_ID_TIPO_PERSONA ;

END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetPersonaById`;

DELIMITER $$

CREATE PROCEDURE uspGetPersonaById(pID_PERSONA int)
BEGIN
	
    SELECT p.ID_PERSONA,
			p.CEDULA,
			p.APELLIDO,
			p.NOMBRE,
			p.EMAIL,
			p.TELEFONO,
			p.DIRECCION,
			p.CIUDAD,
			p.FECHA_NACIMIENTO,
			p.GENERO,
			p.FK_ID_TIPO_PERSONA,
			p.FK_ID_USUARIO,
            tp.NOMBRE 'NOMBRE_TIPO_PERSONA'
	FROM tblpersona p
		INNER JOIN tbltipopersona tp
			ON p.FK_ID_TIPO_PERSONA = tp.ID_TIPO_PERSONA
				WHERE p.ID_PERSONA = pID_PERSONA ;

END$$


DELIMITER ;

DROP procedure IF EXISTS `uspSetPersona`;

DELIMITER $$

CREATE PROCEDURE uspSetPersona
(
	  pID_PERSONA int(11),
	  pCEDULA varchar(45) ,
	  pAPELLIDO varchar(100) ,
	  pNOMBRE varchar(100) ,
	  pEMAIL varchar(45) ,
	  pTELEFONO varchar(45) ,
	  pDIRECCION varchar(100) ,
	  pCIUDAD varchar(100) ,
	  pFECHA_NACIMIENTO date ,
	  pGENERO varchar(45) ,
	  pFK_ID_TIPO_PERSONA int(11),
	  pFK_ID_USUARIO int(11)
)
BEGIN
	
	DECLARE VAR_NICKNAME varchar(100);
    
	IF pID_PERSONA IS NULL THEN
       SET pID_PERSONA = 0;
    END IF;
        
	IF (pID_PERSONA = 0) THEN
			      
			INSERT INTO tblpersona
						(ID_PERSONA,
						CEDULA,
						APELLIDO,
						NOMBRE,
						EMAIL,
						TELEFONO,
						DIRECCION,
						CIUDAD,
						FECHA_NACIMIENTO,
						GENERO,
						FK_ID_TIPO_PERSONA,
						FK_ID_USUARIO)
			VALUES
						(pID_PERSONA,
						 pCEDULA,
						 pAPELLIDO,
						 pNOMBRE,
						 pEMAIL,
						 pTELEFONO,
						 pDIRECCION,
						 pCIUDAD,
						 pFECHA_NACIMIENTO,
						 pGENERO,
						 pFK_ID_TIPO_PERSONA,
						 pFK_ID_USUARIO);

			SET pID_PERSONA = LAST_INSERT_ID();
            
            IF (pFK_ID_TIPO_PERSONA = 1) THEN -- this case is when is doctor. Will create a new user.
				
               -- Here is creating a new user from doctors
				SET VAR_NICKNAME = CONCAT(LOWER(LPAD(pNOMBRE,1,'??')),  LOWER(SUBSTRING_INDEX(pAPELLIDO, ' ', 1)));
                
                call uspSetUser (0 ,pCEDULA, pNOMBRE, pAPELLIDO, pEMAIL,
								pTELEFONO, pCIUDAD, pFECHA_NACIMIENTO, pGENERO,
                                VAR_NICKNAME,VAR_NICKNAME,2,0) ; -- Creating a new rol like doctor
            END IF;
            
            
	ELSE

			UPDATE tblpersona
			SET CEDULA = pCEDULA,
				APELLIDO = pAPELLIDO,
				NOMBRE = pNOMBRE,
				EMAIL = pEMAIL,
				TELEFONO = pTELEFONO,
				DIRECCION = pDIRECCION,
				CIUDAD = pCIUDAD,
				FECHA_NACIMIENTO = pFECHA_NACIMIENTO,
				GENERO = pGENERO,
				FK_ID_TIPO_PERSONA = pFK_ID_TIPO_PERSONA,
				FK_ID_USUARIO = pFK_ID_USUARIO
			WHERE ID_PERSONA = pID_PERSONA;

            
	END IF ;
    
    SELECT pID_PERSONA;
    
END$$
DELIMITER ;

DROP procedure IF EXISTS `uspDeletePersona`;

DELIMITER $$

CREATE PROCEDURE uspDeletePersona
(
	  pID_PERSONA int(11)
)
BEGIN
    DELETE FROM tblespecialidadpersona WHERE FK_ID_PERSONA = pID_PERSONA;
    	
    DELETE FROM tblpersona
	WHERE ID_PERSONA = pID_PERSONA;
    
END$$;


DELIMITER ;

DROP procedure IF EXISTS `uspGetAllEspecialidadByPersona`;

DELIMITER $$

CREATE PROCEDURE uspGetAllEspecialidadByPersona(pFK_ID_PERSONA INT)
BEGIN
	SELECT e.ID_ESPECIALIDAD,
		e.NOMBRE,
		e.DESCRIPCION
	FROM 	tblespecialidad e
		INNER JOIN tblespecialidadpersona ep
			ON e.ID_ESPECIALIDAD = ep.FK_ID_ESPECIALIDAD
	WHERE FK_ID_PERSONA = pFK_ID_PERSONA;
		
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspDeleteEspecialidadPorPersona`;
DELIMITER $$

CREATE PROCEDURE uspDeleteEspecialidadPorPersona
(
	  pID_PERSONA int(11)
)
BEGIN
	
    DELETE FROM tblespecialidadpersona
	WHERE FK_ID_PERSONA = pID_PERSONA;
    
END$$;

DELIMITER ;

DROP procedure IF EXISTS `uspSetEspecialidadPorPersona`;

DELIMITER $$

CREATE PROCEDURE uspSetEspecialidadPorPersona
(
	pID_ESPECIALIDAD_PERSONA INT(11),
	pFK_ID_ESPECIALIDAD INT(11),
	pFK_ID_PERSONA INT(11)
)
BEGIN

	INSERT INTO tblespecialidadpersona
			(ID_ESPECIALIDAD_PERSONA,
		     FK_ID_ESPECIALIDAD,
			 FK_ID_PERSONA)
	VALUES
			(pID_ESPECIALIDAD_PERSONA,
			 pFK_ID_ESPECIALIDAD,
			 pFK_ID_PERSONA);
                
	SET pID_ESPECIALIDAD_PERSONA = LAST_INSERT_ID();

    SELECT pID_ESPECIALIDAD_PERSONA;
    
END$$


DELIMITER ;
DROP procedure IF EXISTS `uspGetDoctoresPorEspecialidad`;

DELIMITER $$

CREATE PROCEDURE uspGetDoctoresPorEspecialidad(pID_ESPECIALIDAD INT)
BEGIN
	 SELECT p.ID_PERSONA,
			p.CEDULA,
			p.APELLIDO,
			p.NOMBRE,
			p.EMAIL,
			p.TELEFONO,
			p.DIRECCION,
			p.CIUDAD,
			p.FECHA_NACIMIENTO,
			p.GENERO,
			p.FK_ID_TIPO_PERSONA,
			p.FK_ID_USUARIO,
            tp.NOMBRE 'NOMBRE_TIPO_PERSONA'
	FROM tblpersona p
		INNER JOIN tbltipopersona tp
			ON p.FK_ID_TIPO_PERSONA = tp.ID_TIPO_PERSONA
				INNER JOIN tblespecialidadpersona ep
						ON p.ID_PERSONA = ep.FK_ID_PERSONA
				WHERE p.FK_ID_TIPO_PERSONA  = 1 AND ep.FK_ID_ESPECIALIDAD = pID_ESPECIALIDAD;
END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetPacientesByUsuario`;

DELIMITER $$

CREATE PROCEDURE uspGetPacientesByUsuario(pFK_ID_USUARIO int)
BEGIN
	DECLARE VAR_ROL_USUARIO INT;
    
	SELECT FK_ID_ROL
		INTO VAR_ROL_USUARIO
			FROM tblUsuario
				WHERE ID_USUARIO = pFK_ID_USUARIO;

    IF (VAR_ROL_USUARIO = 1) THEN /* Si el Rol es Administrador trae todos los pacientes */
		SELECT p.ID_PERSONA,
				p.CEDULA,
				p.APELLIDO,
				p.NOMBRE,
				p.EMAIL,
				p.TELEFONO,
				p.DIRECCION,
				p.CIUDAD,
				p.FECHA_NACIMIENTO,
				p.GENERO,
				p.FK_ID_TIPO_PERSONA,
				p.FK_ID_USUARIO,
				tp.NOMBRE 'NOMBRE_TIPO_PERSONA'
		FROM tblpersona p
			INNER JOIN tbltipopersona tp
				ON p.FK_ID_TIPO_PERSONA = tp.ID_TIPO_PERSONA
					WHERE FK_ID_TIPO_PERSONA = 2 ;
	ELSE
		SELECT p.ID_PERSONA,
				p.CEDULA,
				p.APELLIDO,
				p.NOMBRE,
				p.EMAIL,
				p.TELEFONO,
				p.DIRECCION,
				p.CIUDAD,
				p.FECHA_NACIMIENTO,
				p.GENERO,
				p.FK_ID_TIPO_PERSONA,
				p.FK_ID_USUARIO,
				tp.NOMBRE 'NOMBRE_TIPO_PERSONA'
		FROM tblpersona p
			INNER JOIN tbltipopersona tp
				ON p.FK_ID_TIPO_PERSONA = tp.ID_TIPO_PERSONA
					WHERE FK_ID_TIPO_PERSONA = 2 AND  p.FK_ID_USUARIO  = pFK_ID_USUARIO ;
    
	END IF;

END$$


DELIMITER ;

DROP procedure IF EXISTS `uspSetCita`;

DELIMITER $$

CREATE PROCEDURE uspSetCita(pID_CITA int(11),
							pFECHA_CITA varchar(100), 
							pINICIO_CITA varchar(100),
							pFIN_CITA varchar(100),
							pMOTIVO varchar(200) ,
							pFK_ID_PACIENTE int(11),
							pFK_ID_MEDICO int(11),
							pFK_ID_USUARIO int(11),
							pFK_ID_ESTADO_CITA int(11)) 
BEGIN
	
IF pID_CITA IS NULL THEN
       SET pID_CITA = 0;
END IF;
    
INSERT INTO tblcita
	(`ID_CITA`,
	`FECHA_CITA`,
	`INICIO_CITA`,
    `FIN_CITA`,
	`MOTIVO`,
	`FK_ID_PACIENTE`,
	`FK_ID_MEDICO`,
	`FK_ID_USUARIO`,
	`FK_ID_ESTADO_CITA`)
VALUES
	(pID_CITA,
	pFECHA_CITA,
	pINICIO_CITA,
	pFIN_CITA,
    pMOTIVO,
	pFK_ID_PACIENTE,
	pFK_ID_MEDICO,
	pFK_ID_USUARIO,
	pFK_ID_ESTADO_CITA);

	SET pID_CITA = LAST_INSERT_ID();
    
	SELECT pID_CITA;
END$$


DELIMITER ;

DROP procedure IF EXISTS `uspDeleteCita`;

DELIMITER $$

CREATE PROCEDURE uspDeleteCita(pID_CITA int(11)) 
BEGIN
	
	DELETE FROM tblcita
			WHERE ID_CITA = pID_CITA;


END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetCitaPorId`;

DELIMITER $$

CREATE PROCEDURE uspGetCitaPorId(pID_CITA int(11)) 
BEGIN
	SELECT *
		FROM view_GetCitas
			WHERE ID_CITA = pID_CITA;

END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetCitaPorFecha`;

DELIMITER $$

CREATE PROCEDURE uspGetCitaPorFecha(pFECHA_CITA date) 
BEGIN
	SELECT *
		FROM view_GetCitas
			WHERE FECHA_CITA = pFECHA_CITA;

END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetCitasPorMedico`;

DELIMITER $$

CREATE PROCEDURE uspGetCitasPorMedico(pFK_ID_MEDICO int(11)) 
BEGIN
	SELECT *
		FROM view_GetCitas
			WHERE FK_ID_MEDICO = pFK_ID_MEDICO;

END$$

DELIMITER ;

DROP procedure IF EXISTS `uspGetCitasPorUsuario`;

DELIMITER $$

CREATE PROCEDURE uspGetCitasPorUsuario(pFK_ID_USUARIO int(11)) 
BEGIN

	DECLARE VAR_ROL_USUARIO INT;
    
	SELECT FK_ID_ROL
		INTO VAR_ROL_USUARIO
			FROM tblUsuario
				WHERE ID_USUARIO = pFK_ID_USUARIO;
                
	IF (VAR_ROL_USUARIO = 1) THEN /* Si el Rol es Administrador trae todas las consultas */  
		SELECT *
			FROM view_GetCitas;
				
	ELSE
		SELECT *
				FROM view_GetCitas
					WHERE FK_ID_USUARIO = pFK_ID_USUARIO;
    END IF;

END$$

DELIMITER ;








                            







