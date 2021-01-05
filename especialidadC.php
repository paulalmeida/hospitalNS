<?php

require_once ' \..\Info\EspecialidadInfo.php';

class especialidadC{

	//Ingreso de Especialidad
	public function GuardarEspecialidadC(){

		if(isset($_POST["txt-esp-nombre"])){

			$o = new EspecialidadInfo();

			$o->Id = 0;
			$o->Nombre = $_POST["txt-esp-nombre"];

			$resultado = EspecialidadM::GuardarEspecialidadM($o);
			
			echo '<script>
				window.location = "http://localhost:8080/hospitalns/especialidades";
				</script>';

		}

	}

	public function ObtenerEspecialidadesC(){

			$lista = EspecialidadM::ObtenerEspecialidadesM();

			return $lista;
	}

	public function EliminarEspecialidadC($o){

			EspecialidadM::EliminarEspecialidadM($o);

			echo '<script>
				window.location = "http://localhost:8080/hospitalns/especialidades";
				</script>';

		
	}


	//Editar consultorios
	public function ObtenerEspecialidadC(){

		$especialidadId = substr($_GET["url"], 20);
		
		$o = new EspecialidadInfo();
		$o->Id = $especialidadId;

		$o = EspecialidadM::ObtenerEspecialidadM($o);

		echo '<form method="post" enctype="multipart/form-data">
					
				<div class="row">		
					<div class="col-md-4 col-xs-12">
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-esp-nombre" >Nombre :</label>
						</div>
						<div>
							<input type="hidden" class="form-control" name="txt-esp-id" value="'.$o->Id.'">
							<input type="text" class="form-control" name="txt-esp-nombre" value="'.$o->Nombre.'">			
						</div>
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-esp-descripcion" >Descripcion :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-esp-descripcion" value="'.$o->Descripcion.'">	
						</div>

						<br>
						<br>
						<div>
								<button type="submit" class="btn btn-success">Guardar Cambios</button>
						</div>
					</div>

					 
				</div>
			</form>';

	}

	public function EditarEspecialidadC(){

			if(isset($_POST["txt-esp-nombre"])){

				$o = new EspecialidadInfo();

				$o->Id = $_POST["txt-esp-id"];;
				$o->Nombre = $_POST["txt-esp-nombre"];
				$o->Descripcion = $_POST["txt-esp-descripcion"];

				$resultado = EspecialidadM::GuardarEspecialidadM($o);
				
				echo '<script>
					window.location = "http://localhost:8080/hospitalns/especialidades";
					</script>';

			}

		}


}