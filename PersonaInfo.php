<?php

// clase base con propiedades y métodos miembro
class PersonaInfo {

   public $Id;
   public $Cedula;
   public $Nombre;
   public $Apellido;
   public $Email;
   public $Telefono;
   public $Direccion;
   public $Ciudad;
   public $FechaNacimiento;
   public $Genero;
   public $IdTipoPersona;
   public $IdUsuario;
   public $NombreTipoPersona;
   
   public $Especialidades;

   public function __construct(){
        $this->Id = 0;
        $this->IdTipoPersona = 0;
        $this->Genero = 'M';
        $this->Especialidades = [];
    }

    public function ExisteEspecialidad($idEspecialidad){
        
         foreach ($this->Especialidades as $item) {
             if ($item->Id == $idEspecialidad){
                return true;
             }
         }

         return false;
    }
} // 