<?php

// clase base con propiedades y métodos miembro
class EspecialidadInfo {

   public $Id;
   public $Nombre;
   public $Descripcion;
   
   public function __construct(){
        $this->Id = 0;
        $this->Nombre = '';
        $this->Descripcion = 'Ninguna';
    }

} 