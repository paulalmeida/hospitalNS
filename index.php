<?php


require_once "Controladores/plantillaC.php";
require_once "Controladores/usuarioC.php";
require_once "Modelos/usuarioM.php";
require_once "Controladores/especialidadC.php";
require_once "Modelos/especialidadM.php";
require_once "Controladores/personaC.php";
require_once "Modelos/personaM.php";
require_once "Controladores/citaC.php";
require_once "Modelos/citaM.php";

$plantilla = new Plantilla();
$plantilla->LlamarPlantilla();
