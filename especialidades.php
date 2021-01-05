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
		<h1>Gestor de Especialidades</h1>
	</section>

	<section class="content">
			<div class="box">
				<div class="box-header">
					<form method="post">
						<div class="col-md-6 col-xs-12">
							<input type="text" class="form-control" name="txt-esp-nombre" placeholder="Ingrese Nueva Especialidad" required>
						</div>
						<button type="submit" class="btn btn-primary"> Crear Especialidad</button>
					</form>

					<?php

					$controlador = new EspecialidadC();
				    $controlador -> GuardarEspecialidadC();

					?>
				</div>

				<div class="box-body">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>N°</th>
								<th>Nombre</th>
								<th>Editar / Borrar</th>
							</tr>						
						</thead>
						<tbody>
							<?php

							$controlador = new EspecialidadC();
						    $especialidadesList = $controlador -> ObtenerEspecialidadesC();

						    foreach ($especialidadesList as $item) {

							echo '<tr>
								<td>'.$item->Id.'</td>
								<td>'.$item->Nombre.'</td>
								<td>
									<div class="bnt-group">
										<a href="http://localhost:8080/hospitalns/editar-Especialidad/'.$item->Id.'">
											<button class="btn btn-success"><i class="fa fa-pencil"></i>Editar</button>
										</a>
										<a href="http://localhost:8080/hospitalns/especialidades/'.$item->Id.'">
											<button class="btn btn-danger"><i class="fa fa-pencil"></i>Borrar</button>
										</a>
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

		if(substr($_GET["url"], 15)){

			$id = substr($_GET["url"], 15);

			$o = new EspecialidadInfo();
			$o->Id = $id;

			$controlador = new EspecialidadC();
			$controlador -> EliminarEspecialidadC($o);
		}


		

?>