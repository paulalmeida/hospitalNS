<?php

if($_SESSION["rol"] != "Administrador"){

	echo '<script>
		window.location = "inicio";
	</script>';

	return;
	

	}
?>
	
<div class="content-wrapper">
	
	<section class="content-header">

		<?php


		$idDoctor = substr($_GET["url"], 7);
		
		$controladorPersona = new PersonaC();
		$oDoctor = $controladorPersona->ObtenerPersonaC($idDoctor);

		if($oDoctor->Genero == "Femenino"){
			echo '<h1>Doctora: '.$oDoctor->Apellido.' '.$oDoctor->Nombre.'</h1>';
		}else{
			echo '<h1>Doctor: '.$oDoctor->Apellido.' '.$oDoctor->Nombre.'</h1>';
		}

		echo '<br>';

		$sEpecialidades = "";
		$sComa = "";
		foreach ($oDoctor->Especialidades as $e) {
			$sEpecialidades =  $sEpecialidades.$sComa.$e->Nombre;
			$sComa = ",";
		}
		
		echo '<h1>Especialista en : '.$sEpecialidades.'</h1>';

		?>
		
		
		

	</section>

	<section class="content">
		
		<div class="box">
			

			<div class="box-body">

				<div id="calendar"></div>

			</div>

		</div>

	</section>
</div>



<div class="modal fade" rol="dialog" id="CitaModal">
	
	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<form method="post">
	
			
				<div class="modal-body">
					
					<div class="box-body">
							
						<?php

						$idUsuario = $_SESSION["usuario_id"];

						$controladorPersona = new PersonaC();
						$pacientes = $controladorPersona->ObtenerPacientesPorUsuarioC($idUsuario);

						$sPacientes = "";
						
						foreach ($pacientes as $p) {

							$sPacientes = $sPacientes.'<option selected = "selected" value="'.$p->Id.'">'.$p->Apellido.' '.$p->Nombre.'</option>' ;
					    }

						
						echo '<div class="form-group">
							<div>
								<label style="font-size:20px;font-weight:600;" for="txt-cita-persona" >Paciente :</label>
							</div>
							<div>
								<select class="form-control" name="cbx-cita-persona" id="cbx-cita-persona" >'.$sPacientes.'
						     	</select>
							  	<input type="hidden" class="form-control" name="txt-cita-idDoctor" id ="txt-cita-idDoctor" value="'. $idDoctor.'" readonly>
						  	</div>
						</div>';

						?>
							
												
						
						<div class="form-group">
							<!-- <div>
								<label type="hidden"  style="font-size:20px;font-weight:600;" for="txt-cita-fecha" >Fecha :</label>
							</div> -->
							<input type="hidden" class="form-control" id="txt-cita-fecha"  name="txt-cita-fecha" value="" >
						</div>

						<div class="form-group">
							<div>
								<label style="font-size:20px;font-weight:600;" for="txt-cita-inicio" >Hora Inicio:</label>
							</div>
							<input type="text" class="form-control" id="txt-cita-inicio" name="txt-cita-inicio" value="" >
						</div>
						<div class="form-group">
							<div>
								<label style="font-size:20px;font-weight:600;" for="txt-cita-fin" >Hora Fin:</label>
							</div>
							<input type="text" class="form-control" id="txt-cita-fin" name="txt-cita-fin" value="" >
						</div>

						<div class="form-group">

							<div>
								<label style="font-size:20px;font-weight:600;" for="txt-cita-motivo" >Motivo :</label>
							</div>
							<textarea class="form-control" name="txt-cita-motivo" id="txt-cita-motivo" value=""></textarea>
						</div>

						<div class="form-group">
							<input type="hidden" class="form-control" name="fyhIC" id="fyhIC" value="" readonly>
							<input type="hidden" class="form-control" name="fyhFC" id="fyhFC" value="" readonly>
						</div>

					</div>

				</div>

				<div class="modal-footer">
					
					<button type="submit" class="btn btn-primary">Pedir Cita</button>

					<button type="button" class="btn btn-danger">Cancelar</button>

				</div>


				<?php

					$controladorCita = new citaC();
					$controladorCita->GuardarCitaC();

				?>

			</form>

		</div>

	</div>

</div>






