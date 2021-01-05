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
		<h1>Editar Doctor</h1>
	</section>

	<section class="content">
		
		<div class="box">
			
			<div class="box-body">
				
				<form method="post">

					<?php

					$controlador = new PersonaC();
					$controlador -> ObtenerPersonaC(1);
					$controlador -> GuardarPersonaC();

					?>
					
					

				</form>

			</div>

		</div>

	</section>

</div>