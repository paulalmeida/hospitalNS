<?php

require_once ' \..\Info\UsuarioInfo.php';

class usuarioC{

	//Ingreso de Usuario
	public function LoginUsuarioC($rolId){

		if(isset($_POST["usuario-Ing"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario-Ing"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["clave-Ing"])){
				
				$o = new UsuarioInfo();
		
			    $o->NickName = $_POST["usuario-Ing"];
			    $o->Password = $_POST["clave-Ing"];
				$o->RolId = $rolId;  

				$o = UsuarioM::LoginUsuarioM($o);

				if($o->NickName == $_POST["usuario-Ing"] && $o->Password == $_POST["clave-Ing"]){

					$_SESSION["Ingresar"] = true;

					$_SESSION["usuario_id"] = $o->Id;
					$_SESSION["usuario"] = $o->NickName;
					$_SESSION["clave"] = $o->Password;
					$_SESSION["nombre"] = $o->Nombre;
					$_SESSION["apellido"] = $o->Apellido;
		            $_SESSION["rol_id"] = $o->RolId;
					$_SESSION["rol"] 	= $o->RolNombre;
					echo '<script>

					window.location = "inicio";
					</script>';

				}else{

					echo '<div class="alert alert-danger">Error al Ingresar</div>';

				}

			}

		}
	}

	//Ver Perfil Cliente
	public function VerPerfilUsuarioC(){

		$o = new UsuarioInfo();
		
		$o->Id = $_SESSION["usuario_id"];
		    
		$o = UsuarioM::ObtenerUsuarioM($o);

		echo '<tr>
							
		<td>'.$o->NickName.'</td>

		<td>'.$o->Cedula.'</td>

		<td>'.$o->Nombre.'</td>

		<td>'.$o->Apellido.'</td>

		<td>'.$o->Email.'</td>	

		<td>						
			<a href="http://localhost:8080/hospitalns/perfil-U/'.$o->Id.'">
				<button class="btn btn-success"><i class="fa fa-pencil"></i></button>
			</a>
		</td>

		</tr>';
	}


//Editar Cliente
	public function EditarPerfilUsuarioC(){

		$o = new UsuarioInfo();
		
		$o->Id = $_SESSION["usuario_id"];

		$o  = UsuarioM::ObtenerUsuarioM($o);

		$optionValueM = '<option value="M">Masculino</option>';
		$optionValueF = '<option value="F">Femenino</option>';
						
		if ($o->Genero == 'M'){
			$optionValueM = '<option selected = "selected" value="M">Masculino</option>';
		}else{
			$optionValueF = '<option selected = "selected" value="F">Femenino</option>';
		}

		echo '<form method="post" enctype="multipart/form-data">
					
				<div class="row">
					
					<div class="col-md-4 col-xs-12">
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-cedula" >Cédula :</label>
						</div>
						<div>
							<input type="hidden" class="form-control" name="txt-cli-id" value="'.$o->Id.'">
							<input type="text" class="form-control" name="txt-cli-cedula" value="'.$o->Cedula.'">			
						</div>
						
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-nombre" >Nombre :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-cli-nombre" value="'.$o->Nombre.'">	
						</div>
							
						<div>						
							<label style="font-size:20px;font-weight:600;" for="txt-cli-apellido" >Apellido :</label>					
						</div>
						<div>
							<input type="text" class="form-control" name="txt-cli-apellido" value="'.$o->Apellido.'">
						</div>


						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-email" >Email :</label>
						</div>
						<div>
							<input type="email" class="form-control" name="txt-cli-email" value="'.$o->Email.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-telefono" >Teléfono :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-cli-telefono" value="'.$o->Telefono.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-ciudad" >Ciudad :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-cli-ciudad" value="'.$o->Ciudad.'">
						</div>
					</div>

					<div class="col-md-4 col-xs-12">
						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-fechaNacimiento" >Fecha de Nacimiento :</label>
						</div>
						<div>
							<input type="date" class="form-control" name="txt-cli-fechaNacimiento" value="'.$o->FechaNacimiento.'">
						</div>

						<div>					
							<label style="font-size:20px;font-weight:600;" for="cbx-cli-genero" >Género :</label>
						</div>
						<div>
							<select name="cbx-cli-genero" id="cbx-cli-genero" class="form-control">
						    '.$optionValueM.'
						    '.$optionValueF.'						    
						  	</select>
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-nickName" >NickName :</label>
						</div>
						<div>
							<input type="text" class="form-control" name="txt-cli-nickName" value="'.$o->NickName.'">
						</div>

						<div>
							<label style="font-size:20px;font-weight:600;" for="txt-cli-password" >Password :</label>
						</div>
						<div>
							<input type="password" class="form-control" name="txt-cli-password" value="'.$o->Password.'">
						</div>
						<br>
						<br>
						<div>
							<button type="submit" class="btn btn-success">Guardar Cambios</button>
						</div>
					</div>

					<div class="col-md-4 col-xs-12">
						
					</div>
				</div>

			</form>';
	}


	//Actualizar Cliente
	public function GuardarUsuarioC(){

		if(isset($_POST["txt-cli-id"])){

			$o = new UsuarioInfo();

			$o->Id = $_POST["txt-cli-id"];
			$o->Cedula = $_POST["txt-cli-cedula"];
			$o->Nombre = $_POST["txt-cli-nombre"];
			$o->Apellido = $_POST["txt-cli-apellido"];
			$o->Email = $_POST["txt-cli-email"];
			$o->Telefono = $_POST["txt-cli-telefono"];
			$o->Ciudad = $_POST["txt-cli-ciudad"];
			$o->FechaNacimiento = $_POST["txt-cli-fechaNacimiento"];
			$o->Genero = $_POST["cbx-cli-genero"];
			$o->NickName = $_POST["txt-cli-nickName"];
			$o->Password = $_POST["txt-cli-password"];
			$o->RolId = 3; // ROl ID QUEMADO A 3 POR QUE ES EL PERFIL DE CLIENTES ...............

			$resultado = UsuarioM::ActualizarUsuarioM($o);
			
			echo '<script>
				window.location = "http://localhost:8080/hospitalns/perfil-U/'.$o->Id.'";
				</script>';

		}

	} 


}