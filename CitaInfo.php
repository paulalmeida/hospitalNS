<?php

// clase base con propiedades y métodos miembro
class CitaInfo {

   public $Id;
   public $Fecha;
   public $InicioCita;
   public $FinCita;
   public $Motivo;
   
   public $IdPaciente;
   public $ApellidoPaciente;
   public $NombrePaciente;
   
   public $IdDoctor;
   public $ApellidoDoctor;
   public $NombreDoctor;

   public $IdUsuario;
   public $ApellidoUsuario;
   public $NombreUsuario;

   public $IdEstadoCita;
   public $NombreEstadoCita;
   
   public function __construct(){
        $this->Id = 0;
        $this->Motivo = "";
    }
} // fin de la clase Verdura