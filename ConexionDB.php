<?php

class ConexionDB{

	public function Conectar(){

		$bd = new PDO("mysql:host=localhost;dbname=ns_hospital", "root", "");

		$bd -> exec("set names utf8");

		return $bd;

	}

}