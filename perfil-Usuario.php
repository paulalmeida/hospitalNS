<?php

// if($_SESSION["rol"] != "Cliente"
// && $_SESSION["rol"] != "Administrador"){

// 	echo '<script>

// 	window.location = "inicio";
// 	</script>';

// 	return;

// }

?>




<div class="content-wrapper">
	
	<section class="content-header">
		
		<h1>Gestor de Usuario  </h1>

	</section>


	<section class="content">
		
		<div class="box">
			
			<div class="box-body">
				
				<table class="table table-bordered table-hover table-striped">
					
					<thead>
						
						<tr>
							
							<th>Usuario</th>
							<th>Cedula</th>
							<th>Nombre</th>
							<th>Apellido</th>
							<th>Email</th>
							<!-- <th>Foto</th> -->
							<th>Editar</th>

						</tr>

					</thead>

					<tbody>

						<?php

						$perfil = new UsuarioC();
						$perfil -> VerPerfilUsuarioC();

						?>
						
						

					</tbody>

				</table>

			</div>

		</div>

	</section>

</div>


