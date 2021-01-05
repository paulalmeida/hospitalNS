<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\PersonaInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Modelos\personaM.php';
require_once 'C:\xampp\htdocs\HospitalNS\Controladores\personaC.php';

class PersonasAjax{

	public $personaId;

	public function GetPersonaAjax(){

		$idPersona = $this->personaId;	

		
      	$controlador = new PersonaC();
		$o = $controlador->ObtenerPersonaC($idPersona);
		echo json_encode($o);

	}

}

if(isset($_POST["txt-per-id"])){

	$personaAjax = new PersonasAjax();
	$personaAjax -> personaId = $_POST["txt-per-id"];
	$personaAjax -> GetPersonaAjax();

}