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
		
		<h1>Historial de Citas</h1>

	</section>

	<section class="content">
		
		<div class="box">
		
			<div class="box-body">
				
				<div>
					<?php
					$idUsuario = $_SESSION["usuario_id"];

					echo ' <input type="hidden" class="form-control" name="txt-historial-idUsuario" id ="txt-historial-idUsuario" value="'. $idUsuario.'" readonly>';
					?>
				</div>
				<table class="table table-bordered table-hover table-striped DT">
					
					<thead>
						
						<tr>
			
							<th>Fecha y Hora</th>
							<th>Doctor</th>
							<th>Paciente</th>
							<th>Estado de Cita</th>
							<th>Motivo</th>
							<th>Borrar</th>
						</tr>

					</thead>

					<tbody>

						<?php

						
						$controladorCita = new CitaC();
						$citas = $controladorCita->ObtenerCitasPorUsuarioC($idUsuario);

						foreach ($citas as $o) {

							echo '<tr>

									<td>'.$o->InicioCita.'</td>

									<td>'.$o->ApellidoDoctor.' '.$o->NombreDoctor.' </td>
									
									<td>'.$o->ApellidoPaciente.' '.$o->NombrePaciente.' </td>
									
									<td>'.$o->NombreEstadoCita.'</td>

									<td>'.$o->Motivo.'</td>

									<td>
										<div class="bnt-group">									

											<button class="btn btn-danger EliminarCita" citaId="'.$o->Id.'"><i class="fa fa-times"></i> Borrar Cita</button>
										
										</div>
									</td>

								 </tr>';
						
						}


						?> 
						
						

					</tbody>

				</table>

			</div>

		</div>

	</section>

</div>



<?php


if(isset($_GET["deleteId"])){
	
	$idCita = $_GET["deleteId"];;

	$controladorCita -> EliminarCitaC($idCita);

	echo '<script>
			window.location = "http://localhost:8080/hospitalns/historial/'.$_SESSION["usuario_id"].'";
	</script>';

}

?>
