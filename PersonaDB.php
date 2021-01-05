<?php
require_once 'C:\xampp\htdocs\HospitalNS\Info\PersonaInfo.php';

class PersonaDB extends ConexionDB{


	static public function Guardar($o){
			
			$sp = "CALL uspSetPersona(:pID_PERSONA,
									  :pCEDULA,
									  :pAPELLIDO,
									  :pNOMBRE,
									  :pEMAIL,
									  :pTELEFONO,
									  :pDIRECCION,
									  :pCIUDAD,
									  :pFECHA_NACIMIENTO,
									  :pGENERO,
									  :pFK_ID_TIPO_PERSONA,
									  :pFK_ID_USUARIO)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_PERSONA", $o->Id, PDO::PARAM_INT);
		    $pdo ->bindParam(":pCEDULA", $o->Cedula, PDO::PARAM_STR,45);
		    $pdo ->bindParam(":pAPELLIDO", $o->Apellido, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pNOMBRE", $o->Nombre, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pEMAIL", $o->Email, PDO::PARAM_STR,45);
		    $pdo ->bindParam(":pTELEFONO", $o->Telefono, PDO::PARAM_STR,45);
		    $pdo ->bindParam(":pDIRECCION", $o->Direccion,PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pCIUDAD", $o->Ciudad, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pFECHA_NACIMIENTO", $o->FechaNacimiento,PDO::PARAM_STR);
		    $pdo ->bindParam(":pGENERO", $o->Genero, PDO::PARAM_STR,1);
		    $pdo ->bindParam(":pFK_ID_TIPO_PERSONA", $o->IdTipoPersona, PDO::PARAM_INT);
		    $pdo ->bindParam(":pFK_ID_USUARIO", $o->IdUsuario, PDO::PARAM_INT);

			$pdo -> execute();

			$reader = $pdo -> fetch();
            $o->Id =  $reader["pID_PERSONA"];
            
            //echo "<script type='text/javascript'>alert('".$o->Id."');</script>";
            //$pdo -> close();
			$pdo = null;

			self::guardarEspecialidades($o);

			return $o;
	}


	static private function guardarEspecialidades($o){
			
			self::eliminarEspecialidadesPorPersona($o);

			foreach ($o->Especialidades as $item) {
				self::guardarEspecialidadPorPersona($item->Id,$o->Id);
			}

	}		

	static private function eliminarEspecialidadesPorPersona($o){
			
			$sp = "CALL uspDeleteEspecialidadPorPersona(:pID_PERSONA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_PERSONA", $o->Id, PDO::PARAM_INT);

			$pdo -> execute();
		
            //$pdo -> close();
			$pdo = null;
	}

	static private function guardarEspecialidadPorPersona($especialidadId,$personaId){
			
			$sp = "CALL uspSetEspecialidadPorPersona(:pID_ESPECIALIDAD_PERSONA,
												 :pFK_ID_ESPECIALIDAD,
										 		 :pFK_ID_PERSONA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
		    $aux = 0;
		    $pdo ->bindParam(":pID_ESPECIALIDAD_PERSONA", $aux, PDO::PARAM_INT);
		  	$pdo ->bindParam(":pFK_ID_ESPECIALIDAD", $especialidadId, PDO::PARAM_INT);
		  	$pdo ->bindParam(":pFK_ID_PERSONA", $personaId, PDO::PARAM_INT);

			$pdo -> execute();
			//echo "<script type='text/javascript'>alert('".$o->Id."');</script>";
            //$pdo -> close();
			$pdo = null;
	}


	static public function ConsultarPorTipoDePersona($tipoDePersona){
			
			$lista = array();

			$sp = "CALL uspGetPersonasByTipo(:pFK_ID_TIPO_PERSONA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
  			
  			$pdo ->bindParam(":pFK_ID_TIPO_PERSONA", $tipoDePersona, PDO::PARAM_INT);
			
			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new PersonaInfo();

            	$o->Id =  $reader["ID_PERSONA"];
				$o->Cedula =  $reader["CEDULA"];
				$o->Apellido =  $reader["APELLIDO"];
				$o->Nombre =  $reader["NOMBRE"];
				$o->Email =  $reader["EMAIL"];
				$o->Telefono =  $reader["TELEFONO"];
				$o->Direccion =  $reader["DIRECCION"];
				$o->Ciudad =  $reader["CIUDAD"];
				$o->FechaNacimiento =  $reader["FECHA_NACIMIENTO"];
				$o->Genero =  $reader["GENERO"];
				$o->IdTipoPersona =  $reader["FK_ID_TIPO_PERSONA"];
				$o->IdUsuario =  $reader["FK_ID_USUARIO"];
				$o->NombreTipoPersona =  $reader["NOMBRE_TIPO_PERSONA"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}

	static public function ConsultaEspecifica($o){
			
			$lista = array();

			$sp = "CALL uspGetPersonaById(:pID_PERSONA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
  			
  			$pdo ->bindParam(":pID_PERSONA", $o->Id, PDO::PARAM_INT);
			
			$pdo -> execute();
            
            $reader = $pdo -> fetch();

			$o->Id =  $reader["ID_PERSONA"];
			$o->Cedula =  $reader["CEDULA"];
			$o->Apellido =  $reader["APELLIDO"];
			$o->Nombre =  $reader["NOMBRE"];
			$o->Email =  $reader["EMAIL"];
			$o->Telefono =  $reader["TELEFONO"];
			$o->Direccion =  $reader["DIRECCION"];
			$o->Ciudad =  $reader["CIUDAD"];
			$o->FechaNacimiento =  $reader["FECHA_NACIMIENTO"];
			$o->Genero =  $reader["GENERO"];
			$o->IdTipoPersona =  $reader["FK_ID_TIPO_PERSONA"];
			$o->IdUsuario =  $reader["FK_ID_USUARIO"];
			$o->NombreTipoPersona =  $reader["NOMBRE_TIPO_PERSONA"];

            //$pdo -> close();
			$pdo = null;

			return $o;
	}

	static public function Eliminar($o){
			
			$sp = "CALL uspDeletePersona(:pID_PERSONA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_PERSONA", $o->Id, PDO::PARAM_INT);

			$pdo -> execute();
		
            //$pdo -> close();
			$pdo = null;
	}

	static public function ConsultarPorEspecialidad($idEspecialidad){
			
			$lista = array();

			$sp = "CALL uspGetDoctoresPorEspecialidad(:pID_ESPECIALIDAD)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
  			
  			$pdo ->bindParam(":pID_ESPECIALIDAD", $idEspecialidad, PDO::PARAM_INT);
			
			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new PersonaInfo();

            	$o->Id =  $reader["ID_PERSONA"];
				$o->Cedula =  $reader["CEDULA"];
				$o->Apellido =  $reader["APELLIDO"];
				$o->Nombre =  $reader["NOMBRE"];
				$o->Email =  $reader["EMAIL"];
				$o->Telefono =  $reader["TELEFONO"];
				$o->Direccion =  $reader["DIRECCION"];
				$o->Ciudad =  $reader["CIUDAD"];
				$o->FechaNacimiento =  $reader["FECHA_NACIMIENTO"];
				$o->Genero =  $reader["GENERO"];
				$o->IdTipoPersona =  $reader["FK_ID_TIPO_PERSONA"];
				$o->IdUsuario =  $reader["FK_ID_USUARIO"];
				$o->NombreTipoPersona =  $reader["NOMBRE_TIPO_PERSONA"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}


	static public function ConsultarPacientesPorUsuario($idUsuario){
			
			$lista = array();

			$sp = "CALL uspGetPacientesByUsuario(:pFK_ID_USUARIO)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
  			
  			$pdo ->bindParam(":pFK_ID_USUARIO", $idUsuario, PDO::PARAM_INT);
			
			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new PersonaInfo();

            	$o->Id =  $reader["ID_PERSONA"];
				$o->Cedula =  $reader["CEDULA"];
				$o->Apellido =  $reader["APELLIDO"];
				$o->Nombre =  $reader["NOMBRE"];
				$o->Email =  $reader["EMAIL"];
				$o->Telefono =  $reader["TELEFONO"];
				$o->Direccion =  $reader["DIRECCION"];
				$o->Ciudad =  $reader["CIUDAD"];
				$o->FechaNacimiento =  $reader["FECHA_NACIMIENTO"];
				$o->Genero =  $reader["GENERO"];
				$o->IdTipoPersona =  $reader["FK_ID_TIPO_PERSONA"];
				$o->IdUsuario =  $reader["FK_ID_USUARIO"];
				$o->NombreTipoPersona =  $reader["NOMBRE_TIPO_PERSONA"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}

}