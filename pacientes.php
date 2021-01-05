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
		<h1>Gestor de Pacientes</h1>
	</section>

	<section class="content">
				<div class="box">
					<div class="box-header">

							<div class="box-header">
				

								<button id="btn-per-nuevo" class="btn btn-primary btn-lg EditarPaciente" personaId="0" data-toggle="modal" data-target="#EditarPaciente"><i class="fa fa-pencil"></i> Crear Paciente</button>

							</div>
					</div>

					<div class="box-body">
						<table class="table table-bordered table-hover table-striped DT">
							<thead>
								<tr>
									<th>N°</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Email</th>
									<th>Editar / Borrar</th>
								</tr>						
							</thead>
							<tbody>
								<?php

								$controlador = new PersonaC();
							    $list = $controlador -> ObtenerPacientesC();

								//$especialidadesList = EspecialidadC::ObtenerEspecialidadesC();

							    foreach ($list as $item) {

								echo '<tr>
									<td>'.$item->Id.'</td>
									<td>'.$item->Nombre.'</td>
									<td>'.$item->Apellido.'</td>
									<td>'.$item->Email.'</td>
									<td>
										<div class="bnt-group">

											<button class="btn btn-success EditarPaciente" personaId="'.$item->Id.'" data-toggle="modal" data-target="#EditarPaciente"><i class="fa fa-pencil"></i> Editar</button>

											

											<button class="btn btn-danger EliminarPaciente" personaId="'.$item->Id.'"><i class="fa fa-times"></i> Borrar</button>
										
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

<div class="modal fade" rol="dialog" id="EditarPaciente">
	
	<div class="modal-dialog">
		
		<div class="modal-content">
			
			<form method="post" role="form">
				
				<div class="modal-body">
					
					<div class="box-body">
					<?php

					$controlador = new PersonaC();
					$controlador -> RenderPacienteC();
					
					?>
			

					</div>

				</div>


				<div class="modal-footer">
					
					<button type="submit" class="btn btn-primary">Guardar</button>

					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

				</div>

					<?php

					$controlador = new PersonaC();
					$controlador -> GuardarPersonaC(2);


					?>

			</form>

		</div>

	</div>

</div>

<?php


if(isset($_GET["deleteId"])){
	
	$o = new PersonaInfo();
	$o->Id = $_GET["deleteId"];;



	$controlador = new PersonaC();
	$controlador -> EliminarPersonaC($o);

	echo '<script>
			window.location = "http://localhost:8080/hospitalns/pacientes";
	</script>';

}

?>