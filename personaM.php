<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\PersonaInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\ConexionDB.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\PersonaDB.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\EspecialidadDB.php';

class PersonaM {

	//Actualizar Perfil 
	static public function ObtenerDoctoresM(){

		return PersonaDB::ConsultarPorTipoDePersona(1); // Tipo 1 es igual a Doctores

	}


	static public function ObtenerPacientesM(){

		return PersonaDB::ConsultarPorTipoDePersona(2); // Tipo 2 es igual a Pacientes

	}


	static public function ObtenerDoctoresPorEspecialidadM($idEspecialidad){

		return PersonaDB::ConsultarPorEspecialidad($idEspecialidad); // Tipo 1 es igual a Doctores

	}

	static public function ObtenerPersonaM($o){

		$o = PersonaDB::ConsultaEspecifica($o);
		$o->Especialidades = EspecialidadDB::ConsultarPorPersonaId($o->Id);
		return $o;
	}

	static public function GuardarPersonaM($o){

		$o = PersonaDB::Guardar($o);
	    return $o;
	}

	static public function EliminarPersonaM($o){

		return PersonaDB::Eliminar($o);

	}
	
	static public function ObtenerPacientesPorUsuarioM($idUsuario){

		return PersonaDB::ConsultarPacientesPorUsuario($idUsuario); // Tipo 1 es igual a Doctores

	}
}