<?php
require_once 'C:\xampp\htdocs\HospitalNS\Info\UsuarioInfo.php';

class UsuarioDB extends ConexionDB{

	static public function LoginUsuario($o){
		
		$sp = "CALL uspGetUserByNickName(:pNickName,:pRolId)";

	    $pdo = ConexionDB::Conectar()->prepare($sp);

	    $pdo ->bindParam(":pNickName", $o->NickName, PDO::PARAM_STR, 100);
		$pdo ->bindParam(":pRolId", $o->RolId, PDO::PARAM_INT);
		
		$pdo -> execute();

		$reader = $pdo -> fetch();
		//$pdo -> close();
		$pdo = null;

	
		if($reader["NICKNAME"] == $o->NickName && $reader["PASSWORD"] == $o->Password){

				$o->Id = $reader["ID_USUARIO"];
				$o->NickName = $reader["NICKNAME"];
				$o->Password  = $reader["PASSWORD"];
				$o->Nombre = $reader["NOMBRE"];
				$o->Apellido = $reader["APELLIDO"];
				$o->RolId  = $reader["FK_ID_ROL"];
				$o->RolNombre = $reader["NOMBRE_ROL"];
		}
		else
		{
			    $o->NickName = '';
			    $o->Password  = '';
		}

		

		return $o;
	}


	static public function Obtener($o){

			$sp = "CALL uspGetUserById(:pUsuarioID)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pUsuarioID", $o->Id, PDO::PARAM_INT);
			
			$pdo -> execute();

			$reader = $pdo -> fetch();
			//$pdo -> close();
			$pdo = null;

			$o->Id = $reader["ID_USUARIO"];
			$o->Cedula = $reader["CEDULA"];
			$o->Nombre = $reader["NOMBRE"];
			$o->Apellido = $reader["APELLIDO"];
			$o->Email = $reader["EMAIL"];
			$o->Telefono = $reader["TELEFONO"];
			$o->Ciudad = $reader["CIUDAD"];
			$o->FechaNacimiento = $reader["FECHA_NACIMIENTO"];
			$o->Genero = $reader["GENERO"];
			$o->NickName = $reader["NICKNAME"];
		    $o->Password = $reader["PASSWORD"];
			$o->RolId  = $reader["FK_ID_ROL"];
		    $o->RolNombre = $reader["NOMBRE_ROL"];
			

			return $o;
	}

	static public function Actualizar($o){
			
			$sp = "CALL uspSetUser(:pID_USUARIO,
									:pCEDULA_USUARIO, 
									:pNOMBRE_USUARIO,
									:pAPELLIDO_USUARIO,
									:pEMAIL_USUARIO,
									:pTELEFONO_USUARIO,
									:pCIUDAD_USUARIO,
									:pFECHA_NACIMIENTO_USUARIO,
									:pGENERO,
									:pNICKNAME,
									:pPASSWORD_USUARIO,
									:pFK_ID_ROL)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_USUARIO", $o->Id, PDO::PARAM_INT);
		    $pdo ->bindParam(":pCEDULA_USUARIO", $o->Cedula, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pNOMBRE_USUARIO", $o->Nombre, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pAPELLIDO_USUARIO", $o->Apellido, PDO::PARAM_STR,200);
		    $pdo ->bindParam(":pEMAIL_USUARIO", $o->Email, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pTELEFONO_USUARIO", $o->Telefono, PDO::PARAM_STR,45);
		    $pdo ->bindParam(":pCIUDAD_USUARIO", $o->Ciudad, PDO::PARAM_STR,45);
		    $pdo ->bindParam(":pFECHA_NACIMIENTO_USUARIO", $o->FechaNacimiento, PDO::PARAM_STR);
		    $pdo ->bindParam(":pGENERO", $o->Genero, PDO::PARAM_STR,1);
		    $pdo ->bindParam(":pNICKNAME", $o->NickName, PDO::PARAM_STR,45);
			$pdo ->bindParam(":pPASSWORD_USUARIO", $o->Password, PDO::PARAM_STR,45);
			$pdo ->bindParam(":pFK_ID_ROL", $o->RolId, PDO::PARAM_INT);
		

			$pdo -> execute();
		
            //$pdo -> close();
			$pdo = null;

			return $o;
	}
}