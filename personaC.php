<?php

require_once 'C:\xampp\htdocs\HospitalNS\Info\PersonaInfo.php';
require_once 'C:\xampp\htdocs\HospitalNS\Modelos\EspecialidadM.php';

class personaC{

	

	public function ObtenerDoctoresC(){

			$lista = PersonaM::ObtenerDoctoresM();

			return $lista;
	}

	public function ObtenerDoctoresPorEspecialidadC($idEspecialidad){

			$lista = PersonaM::ObtenerDoctoresPorEspecialidadM($idEspecialidad);

			return $lista;
	}


	public function ObtenerPacientesC(){

			$lista = PersonaM::ObtenerPacientesM();

			return $lista;
	}

	public function RenderDoctorC(){
		$id = 0;
		$o = new PersonaInfo();
		$o->Id = $id;	

		$especialidadesList = EspecialidadM::ObtenerEspecialidadesM();


		$optionValueM = '<option value="M">Masculino</option>';
		$optionValueF = '<option value="F">Femenino</option>';
						
		if ($o->Genero == 'M'){
			$optionValueM = '<option selected = "selected" value="M">Masculino</option>';
		}else{
			$optionValueF = '<option selected = "selected" value="F">Femenino</option>';
		}

		echo '<div class="row">
					
					<div class="col-md-12 col-xs-12">
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-cedula" >Cédula :</label>
						</div>
						<div>
							<input type="hidden" class="form-control" name="txt-per-id" id="txt-per-id" value="'.$o->Id.'">
							<input type="text" class="form-control" name="txt-per-cedula" id="txt-per-cedula" value="'.$o->Cedula.'">			
						</div>
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-nombre" >Nombre :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-nombre" id="txt-per-nombre" value="'.$o->Nombre.'">	
						</div>
							
						<div>						
							<label style="font-size:20px;font-weight:600;" for="txt-per-apellido" >Apellido :</label>					
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-apellido" id="txt-per-apellido" value="'.$o->Apellido.'">
						</div>


						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-email" >Email :</label>
						</div>
						<div>
							<input type="email" class="form-control" name="txt-per-email" id="txt-per-email" value="'.$o->Email.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-telefono" >Teléfono :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-telefono" id="txt-per-telefono" value="'.$o->Telefono.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-ciudad" >Ciudad :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-ciudad" id="txt-per-ciudad" value="'.$o->Ciudad.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-direccion" >Direccion :</label>
						</div>
						<div>
							<textarea class="form-control" name="txt-per-direccion" id="txt-per-direccion" value="'.$o->Direccion.'">'.$o->Direccion.'</textarea>
						</div>
				
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-fechaNacimiento" ">Fecha de Nacimiento :</label>
						</div>
						<div>
							<input type="date" class="form-control" name="txt-per-fechaNacimiento" id="txt-per-fechaNacimiento" value="'.$o->FechaNacimiento.'">
						</div>

						<div>					
							<label style="font-size:20px;font-weight:600;" for="cbx-per-genero" >Género :</label>
						</div>
						<div>
							<select name="cbx-per-genero" id="cbx-per-genero" class="form-control">
					     	'.$optionValueM.'
						    '.$optionValueF.'
						  	</select>
						</div>

						<div>					
							<label style="font-size:20px;font-weight:600;" for="especialidad" >Seleccione especialidades :</label>
						</div>

						<div>';

						
					    foreach ($especialidadesList as $item) {
					    	$sChecked = '';
					    	
							echo '<input '.$sChecked.' type="checkbox" name="especialidades[]" id='.$item->Id.' value='.$item->Id.'>'.$item->Nombre.'
							<br>';
						}
						
						
							
						echo '</div>
					</div>

				
				</div>';
	}

	public function RenderPacienteC(){
		$id = 0;
		$o = new PersonaInfo();
		$o->Id = $id;	

	
		$optionValueM = '<option value="M">Masculino</option>';
		$optionValueF = '<option value="F">Femenino</option>';
						
		if ($o->Genero == 'M'){
			$optionValueM = '<option selected = "selected" value="M">Masculino</option>';
		}else{
			$optionValueF = '<option selected = "selected" value="F">Femenino</option>';
		}

		echo '<div class="row">
					
					<div class="col-md-12 col-xs-12">
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-cedula" >Cédula :</label>
						</div>
						<div>
							<input type="hidden" class="form-control" name="txt-per-id" id="txt-per-id" value="'.$o->Id.'">
							<input type="text" class="form-control" name="txt-per-cedula" id="txt-per-cedula" value="'.$o->Cedula.'">			
						</div>
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-nombre" >Nombre :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-nombre" id="txt-per-nombre" value="'.$o->Nombre.'">	
						</div>
							
						<div>						
							<label style="font-size:20px;font-weight:600;" for="txt-per-apellido" >Apellido :</label>					
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-apellido" id="txt-per-apellido" value="'.$o->Apellido.'">
						</div>


						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-email" >Email :</label>
						</div>
						<div>
							<input type="email" class="form-control" name="txt-per-email" id="txt-per-email" value="'.$o->Email.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-telefono" >Teléfono :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-telefono" id="txt-per-telefono" value="'.$o->Telefono.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-ciudad" >Ciudad :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-per-ciudad" id="txt-per-ciudad" value="'.$o->Ciudad.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-direccion" >Direccion :</label>
						</div>
						<div>
							<textarea class="form-control" name="txt-per-direccion" id="txt-per-direccion" value="'.$o->Direccion.'">'.$o->Direccion.'</textarea>
						</div>
				
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-per-fechaNacimiento" ">Fecha de Nacimiento :</label>
						</div>
						<div>
							<input type="date" class="form-control" name="txt-per-fechaNacimiento" id="txt-per-fechaNacimiento" value="'.$o->FechaNacimiento.'">
						</div>

						<div>					
							<label style="font-size:20px;font-weight:600;" for="cbx-per-genero" >Género :</label>
						</div>
						<div>
							<select name="cbx-per-genero" id="cbx-per-genero" class="form-control">
					     	'.$optionValueM.'
						    '.$optionValueF.'
						  	</select>
						</div>
						
					</div>

				
				</div>';
	}

	public function ObtenerPersonaC($id){
		
		$o = new PersonaInfo();
		$o->Id = $id;	

		if ($id != 0) 
		{
			$o = PersonaM::ObtenerPersonaM($o); //Consulta para Editar
		}

		return $o;
		//$especialidadesList = EspecialidadM::ObtenerEspecialidadesM();


	}

	public function GuardarPersonaC($tipoPersona){

			
		if(isset($_POST["txt-per-id"])){

			$o = new PersonaInfo();

			$o->Id = $_POST["txt-per-id"];
			$o->Cedula = $_POST["txt-per-cedula"];
			$o->Nombre = $_POST["txt-per-nombre"];
			$o->Apellido = $_POST["txt-per-apellido"];
			$o->Email = $_POST["txt-per-email"];
			$o->Telefono = $_POST["txt-per-telefono"];
			$o->Ciudad = $_POST["txt-per-ciudad"];
			$o->Direccion = $_POST["txt-per-direccion"];
			$o->FechaNacimiento = $_POST["txt-per-fechaNacimiento"];
			$o->Genero = $_POST["cbx-per-genero"];
			$o->IdTipoPersona = $tipoPersona; 					 // Tipo 1: Doctor
			$o->IdUsuario = $_SESSION["usuario_id"]; // obteniendo el usuario de la variable de sesion.

			$o->Especialidades = [];

			if (!empty($_POST["especialidades"]))
			{
				foreach ($_POST["especialidades"] as $value) {
						
					$oEspecialidad = new EspecialidadInfo();
			        $oEspecialidad->Id =  $value;

					array_push($o->Especialidades,$oEspecialidad);
				}
			}

			$o = PersonaM::GuardarPersonaM($o);


			if ($tipoPersona == 1){
				echo '<script>
						window.location = "http://localhost:8080/hospitalns/doctores";
					</script>';
			}
			else if ($tipoPersona == 2)
			{
				echo '<script>
						window.location = "http://localhost:8080/hospitalns/pacientes";
					</script>';

			}
		}
	}


	public function EliminarPersonaC($o){

			PersonaM::EliminarPersonaM($o);
		
	}



	public function ObtenerPacientesPorUsuarioC($IdUsuario){

			$lista = PersonaM::ObtenerPacientesPorUsuarioM($IdUsuario);

			return $lista;
	}

}