<?php

// if($_SESSION["rol"] != "Cliente"){

// 	echo '<script>

// 	window.location = "inicio";
// 	</script>';

// 	return;

// }

?>


<div class="content-wrapper">
	<section class="content-header">
		<h2>Gestor de Usuario</h2>
	</section>

	<section class="content">
		
		<div class="box">
			
			<div class="box-body">

		   	<?php

			$editar = new UsuarioC();
			$editar -> EditarPerfilUsuarioC();
			$editar -> GuardarUsuarioC();

			?>


			</div>

		</div>

	</section>

</div>