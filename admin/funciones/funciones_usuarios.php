<?php 

	include_once('../include/conexion.php'); 

	if(isset($_REQUEST['id_usuario']) && $_REQUEST['accion'] == 'eliminar'){

		$id_usuario = $_REQUEST['id_usuario'];

		$sql_usuarios = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";
	  	$consulta_usuarios=mysql_query($sql_usuarios);

	}

	if($_REQUEST['accion'] == 'guardar'){

		$nombre = $_REQUEST['nombre'];
		$usuario = $_REQUEST['usuario'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$password2 = $_REQUEST['password2'];
		$tipo_usuario = "Administrador";

		$band = 0;

		// VALIDA EL USUARIO
		if ($band == 0) {
			$sql_usu = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
	        $consulta_usu=mysql_query($sql_usu)or die("Error de consulta de usuarios");
	        $filas_usu=mysql_num_rows($consulta_usu);

	        if ($filas_usu != 0) {
	        	echo "<script>alert('El USUARIO YA SE ENCUENTRA REGISTRADO')</script>";
				$band = 1;
	        }
		}


		if ($band == 0) {
			if($password == $password2) 
			{
				if(strlen($password) >= 6) 
				{
					$psw = md5($password);
				}
				else
				{
					echo "<script>alert('LA CONTRASEÑA DEBE DE TENER UN MINIMO DE 6 CARACTERES')</script>";
					$band = 1;
				}
			}
			else
			{
				echo "<script>alert('LAS CONTRASEÑAS NO COINCIDEN')</script>";
				$band = 1;
			}
		}

		// AGREGA EL USUARIO
		if ($band == 0) {
			$sql = "INSERT INTO usuarios (nombre, usuario, password, email, tipo_usuario, fecha_creacion)
	      				VALUES ('$nombre', '$usuario', '$psw', '$email', '$tipo_usuario', NOW())";
		  	$consulta=mysql_query($sql)or die("Error de consulta de insercion");

			echo "<script>alert('El USUARIO SE AGREGÓ CORRECTAMENTE')</script>";
		  	echo "<script>location.href='usuarios.php'</script>";
		}
		
	}

	if($_REQUEST['accion'] == 'editar'){


		$id_usuario = $_REQUEST['id_usuario'];
		$nombre = $_REQUEST['nombre'];
		$usuario = $_REQUEST['usuario'];
		$email = $_REQUEST['email'];
		$password = $_REQUEST['password'];
		$password2 = $_REQUEST['password2'];

		$tipo_usuario = $_REQUEST['tipo_usuario'];
		$band = 0;

		// VALIDA SI SE MODIFICO LA CONTRASEÑA
		if ($band == 0) {
			if($password != "") {

				if ($band == 0) {
					if($password == $password2) 
					{
						if(strlen($password) >= 6) 
						{
							$psw = md5($password);
						}
						else
						{
							echo "<script>alert('LA CONTRASEÑA DEBE CONTENER UN MINIMO DE 6 CARACTERES')</script>";
							$band = 1;
						}
					}
					else
					{
						echo "<script>alert('LAS CONTASEÑAS NO COINCIDEN')</script>";
						$band = 1;
					}
				}

				// EDITA EL USUARIO
				if ($band == 0) {
					$sql_usuarios = "UPDATE usuarios 
		    			SET nombre = '$nombre', usuario = '$usuario', password = '$psw', email = '$email', tipo_usuario = '$tipo_usuario'
		    			WHERE id_usuario = '$id_usuario'";
		  			$consulta_usuarios=mysql_query($sql_usuarios)or die("Error de consulta de actualizacion1");

					echo "<script>alert('El USUARIO SE MODIFICÓ CORRECTAMENTE')</script>";
		  			echo "<script>location.href='usuarios.php'</script>";
				}
			}
			else {
				// EDITA EL USUARIO
				if ($band == 0) {
					$sql_usuarios = "UPDATE usuarios 
		    			SET nombre = '$nombre', usuario = '$usuario', email = '$email', tipo_usuario = '$tipo_usuario'
		    			WHERE id_usuario = '$id_usuario'";
		  			$consulta_usuarios=mysql_query($sql_usuarios)or die("Error de consulta de actualizacion1");

					echo "<script>alert('El USUARIO SE MODIFICÓ CORRECTAMENTE')</script>";
		  			echo "<script>location.href='usuarios.php'</script>";
				}
			}

		}

	}

?>
