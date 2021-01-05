<?php

// clase base con propiedades y métodos miembro
class UsuarioInfo {

   public $Id;
   public $Cedula;
   public $Nombre;
   public $Apellido;
   public $Email;
   public $Telefono;
   public $Ciudad;
   public $FechaNacimiento;
   public $Genero;
   public $NickName;
   public $Password;
   public $RolId;
   public $RolNombre;

   public function __construct(){
        $this->Id = 0;
        $this->NickName = '';
        $this->RolId = 0;
    }
} // fin de la clase Verdura