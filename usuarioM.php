<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\UsuarioInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\ConexionDB.php';
require_once 'C:\xampp\htdocs\HospitalNS\Datos\UsuarioDB.php';


class UsuarioM {


	//Ingreso Cliente
	static public function LoginUsuarioM($oUsuario){

	  	return UsuarioDB::LoginUsuario($oUsuario);
		
	}

	//Ingreso 
	static public function ObtenerUsuarioM($oUsuario){

	  	return UsuarioDB::Obtener($oUsuario);
		
	}

	//Actualizar Perfil 
	static public function ActualizarUsuarioM($oUsuario){

		return UsuarioDB::Actualizar($oUsuario);

	}



}