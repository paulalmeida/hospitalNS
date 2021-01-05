<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\CitaInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Modelos\CitaM.php';

class citaC{



	public function GuardarCitaC(){

		$idUsuario = $_SESSION["usuario_id"];
		if(isset($_POST["txt-cita-inicio"]) && isset($_POST["txt-cita-motivo"])){

			$o = new CitaInfo();

			$o->Id = 0;
			$o->Fecha = $_POST["txt-cita-fecha"];
			$o->InicioCita = $_POST["txt-cita-inicio"];
			$o->FinCita = $_POST["txt-cita-fin"];
			$o->Motivo = $_POST["txt-cita-motivo"];
			$o->IdPaciente = (int)$_POST["cbx-cita-persona"];
			$o->IdDoctor = (int)$_POST["txt-cita-idDoctor"];
			$o->IdUsuario =(int)$idUsuario;
			$o->IdEstadoCita = (int)1; // Estado 1: Confirmada ; Estado 2 : Realizada.


			$o = CitaM::GuardarCitaM($o);

			echo '<script>
						window.location = "http://localhost:8080/hospitalns/Doctor/"'.$o->IdDoctor.';
					</script>';

			
		}
	}


	public function ObtenerCitasPorMedicoC($idMedico){

		$lista = CitaM::ObtenerCitasPorMedicoM($idMedico);

		return $lista;
	}


	public function ObtenerCitasPorUsuarioC($idUsuario){

		$lista = CitaM::ObtenerCitasPorUsuarioM($idUsuario);

		return $lista;
	}

	public function EliminarCitaC($idCita){

		CitaM::EliminarCitaM($idCita);
		
	}

}