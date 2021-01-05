<?php
require_once 'C:\xampp\htdocs\HospitalNS\Info\CitaInfo.php';

class CitaDB extends ConexionDB{

	static public function Guardar($o){
			
			$sp = "CALL uspSetCita(:pID_CITA,
									:pFECHA_CITA , 
									:pINICIO_CITA, 
									:pFIN_CITA,
									:pMOTIVO,
									:pFK_ID_PACIENTE,
									:pFK_ID_MEDICO,
									:pFK_ID_USUARIO,
									:pFK_ID_ESTADO_CITA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_CITA", $o->Id, PDO::PARAM_INT);
		    $pdo ->bindParam(":pFECHA_CITA", $o->Fecha, PDO::PARAM_STR,100);
			$pdo ->bindParam(":pINICIO_CITA", $o->InicioCita, PDO::PARAM_STR,100);
			$pdo ->bindParam(":pFIN_CITA", $o->FinCita, PDO::PARAM_STR,100);			    
 		    $pdo ->bindParam(":pMOTIVO", $o->Motivo,PDO::PARAM_STR,200);
			$pdo ->bindParam(":pFK_ID_PACIENTE", $o->IdPaciente, PDO::PARAM_INT);   
		    $pdo ->bindParam(":pFK_ID_MEDICO", $o->IdDoctor, PDO::PARAM_INT);
		    $pdo ->bindParam(":pFK_ID_USUARIO", $o->IdUsuario, PDO::PARAM_INT);
			$pdo ->bindParam(":pFK_ID_ESTADO_CITA", $o->IdEstadoCita, PDO::PARAM_INT);

			$pdo -> execute();

			$reader = $pdo -> fetch();
            $o->Id =  $reader["pID_CITA"];

			$pdo = null;

			return $o;
	}

	static public function ConsultarCitasPorMedico($idMedico){
			
			$lista = array();

			$sp = "CALL uspGetCitasPorMedico(:pFK_ID_MEDICO)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
  			
  			$pdo ->bindParam(":pFK_ID_MEDICO", $idMedico, PDO::PARAM_INT);
			
			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new CitaInfo();

            	$o->Id =  $reader["ID_CITA"];
				$o->Fecha =  $reader["FECHA_CITA"];
				$o->InicioCita =  $reader["INICIO_CITA"];
				$o->FinCita =  $reader["FIN_CITA"];
				$o->Motivo =  $reader["MOTIVO"];

				$o->IdPaciente =  $reader["FK_ID_PACIENTE"];
				$o->ApellidoPaciente =  $reader["A_PACIENTE"];
				$o->NombrePaciente =  $reader["N_PACIENTE"];

				$o->IdDoctor =  $reader["FK_ID_MEDICO"];
				$o->ApellidoDoctor =  $reader["A_MEDICO"];
				$o->NombreDoctor =  $reader["N_MEDICO"];

				$o->IdUsuario =  $reader["FK_ID_USUARIO"];
				$o->ApellidoUsuario =  $reader["A_USUARIO"];
				$o->NombreUsuario =  $reader["N_USUARIO"];

				$o->IdEstadoCita =  $reader["FK_ID_ESTADO_CITA"];
				$o->NombreEstadoCita =  $reader["ESTADO_CITA"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}

	static public function ConsultarCitasPorUsuario($idUsuario){
			
			$lista = array();

			$sp = "CALL uspGetCitasPorUsuario(:pFK_ID_USUARIO)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);
  			
  			$pdo ->bindParam(":pFK_ID_USUARIO", $idUsuario, PDO::PARAM_INT);
			
			$pdo -> execute();
            
            $allRecords = $pdo ->fetchAll();
			foreach ($allRecords as $reader) {
            
				$o = new CitaInfo();

            	$o->Id =  $reader["ID_CITA"];
				$o->Fecha =  $reader["FECHA_CITA"];
				$o->InicioCita =  $reader["INICIO_CITA"];
				$o->FinCita =  $reader["FIN_CITA"];
				$o->Motivo =  $reader["MOTIVO"];

				$o->IdPaciente =  $reader["FK_ID_PACIENTE"];
				$o->ApellidoPaciente =  $reader["A_PACIENTE"];
				$o->NombrePaciente =  $reader["N_PACIENTE"];

				$o->IdDoctor =  $reader["FK_ID_MEDICO"];
				$o->ApellidoDoctor =  $reader["A_MEDICO"];
				$o->NombreDoctor =  $reader["N_MEDICO"];

				$o->IdUsuario =  $reader["FK_ID_USUARIO"];
				$o->ApellidoUsuario =  $reader["A_USUARIO"];
				$o->NombreUsuario =  $reader["N_USUARIO"];

				$o->IdEstadoCita =  $reader["FK_ID_ESTADO_CITA"];
				$o->NombreEstadoCita =  $reader["ESTADO_CITA"];

				array_push($lista, $o);
            }
            //$pdo -> close();
			$pdo = null;

			return $lista;
	}


	static public function EliminarCita($idCita){
			
			$sp = "CALL uspDeleteCita(:pID_CITA)";

		    $pdo = ConexionDB::Conectar()->prepare($sp);

		    $pdo ->bindParam(":pID_CITA", $idCita, PDO::PARAM_INT);

			$pdo -> execute();
		
            //$pdo -> close();
			$pdo = null;
	}
}