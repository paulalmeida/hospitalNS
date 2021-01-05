<?php
require_once 'C:\xampp\htdocs\HospitalNS\Info\EspecialidadInfo.php';

class EspecialidadDB extends ConexionDB{


	static public function Guardar($o){
			
			$sp = "CALL uspSetEspecialidad(:pID_ESPECIALIDAD,
									:pNOMBRE, 
									:pDESCRIPCION)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_ESPECIALIDAD", $o->Id, PDO::PARAM_INT);
		    $pdo ->bindParam(":pNOMBRE", $o->Nombre, PDO::PARAM_STR,100);
		    $pdo ->bindParam(":pDESCRIPCION", $o->Descripcion, PDO::PARAM_STR,100);

			$pdo -> execute();
		
            //$pdo -> close();
			$pdo = null;

			return $o;
	}

	static public function Consultar(){
			
			$lista = array();

			$sp = "CALL uspGetAllEspecialidad()";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new EspecialidadInfo();

            	$o->Id =  $reader["ID_ESPECIALIDAD"];
				$o->Nombre =  $reader["NOMBRE"];
				$o->Descripcion =  $reader["DESCRIPCION"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}

	static public function Eliminar($o){
			
			$sp = "CALL uspDeleteEspecialidadById(:pID_ESPECIALIDAD)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_ESPECIALIDAD", $o->Id, PDO::PARAM_INT);

			$pdo -> execute();
		
            //$pdo -> close();
			$pdo = null;
	}

	static public function ConsultaEspecifica($o){
			

			$sp = "CALL uspGetEspecialidadById(:pID_ESPECIALIDAD)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_ESPECIALIDAD", $o->Id, PDO::PARAM_INT);

			$pdo -> execute();
		
			$reader = $pdo -> fetch();
			//$pdo -> close();
			$pdo = null;

			$o->Id = $reader["ID_ESPECIALIDAD"];
			$o->Nombre = $reader["NOMBRE"];
			$o->Descripcion = $reader["DESCRIPCION"];

			return $o;
	}

	static public function ConsultarPorPersonaId($personaId){
			
			$lista = array();

			$sp = "CALL uspGetAllEspecialidadByPersona(:pFK_ID_PERSONA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pFK_ID_PERSONA", $personaId, PDO::PARAM_INT);

			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new EspecialidadInfo();

            	$o->Id =  $reader["ID_ESPECIALIDAD"];
				$o->Nombre =  $reader["NOMBRE"];
				$o->Descripcion =  $reader["DESCRIPCION"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}
}