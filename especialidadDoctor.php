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
		<h1>Eliga una especialidad : </h1>
	</section>

	<section class="content">
			<div class="box">
				
				<div class="box-body">

				<?php
				
				
				$contoladorEspecialidad = new EspecialidadC();
				$especialidades = $contoladorEspecialidad -> ObtenerEspecialidadesC();
				$contoladorDoctor = new PersonaC();

				foreach ($especialidades as $e) {

					echo '<div class="col-lg-3 col-xs-6">
			         		 <div class="small-box bg-aqua">
		            			<div class="inner">
		             				 <h3>'.$e->Nombre.'</h3>';

		             				
									$doctores = $contoladorDoctor->ObtenerDoctoresPorEspecialidadC($e->Id);

									foreach ($doctores as $d) {
										echo '<a href="doctor/'.$d->Id.'" style="color: black;"><p>'.$d->Apellido.' '.$d->Nombre.'</p></a>';
									}

   					  			
		           				 echo '</div>
				        	  </div>
		       			 </div>';

				}

				?>


				</div>
			</div>
	</section>

</div>
