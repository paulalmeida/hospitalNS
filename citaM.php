<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\CitaInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\ConexionDB.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\CitaDB.php';

class CitaM {

	
	static public function GuardarCitaM($o){

		$o = CitaDB::Guardar($o);
	    return $o;
	}

	static public function ObtenerCitasPorMedicoM($idMedico){
		
		$lista = CitaDB::ConsultarCitasPorMedico($idMedico);
	    return $lista;
	}

	static public function ObtenerCitasPorUsuarioM($idUsuario){
		
		$lista = CitaDB::ConsultarCitasPorUsuario($idUsuario);
	    return $lista;
	}

	static public function EliminarCitaM($idCita){

		CitaDB::EliminarCita($idCita);

	}
	
}