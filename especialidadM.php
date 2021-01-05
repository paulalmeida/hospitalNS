<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\EspecialidadInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\ConexionDB.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\EspecialidadDB.php';


class EspecialidadM {

	//Actualizar Perfil 
	static public function GuardarEspecialidadM($o){

		return EspecialidadDB::Guardar($o);

	}

	//Actualizar Perfil 
	static public function ObtenerEspecialidadesM(){

		return EspecialidadDB::Consultar();

	}

	//Eliminar Especialidad 
	static public function EliminarEspecialidadM($o){

		return EspecialidadDB::Eliminar($o);

	}


	//Editar consultorios
	static public function ObtenerEspecialidadM($o){

		return EspecialidadDB::ConsultaEspecifica($o);

	}

	static public function ObtenerEspecialidadesPorPersona($idPersona){

		return EspecialidadDB::ConsultarPorPersonaId($idPersona);

	}
}