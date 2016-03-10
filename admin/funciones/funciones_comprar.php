<?php 
	include_once('../include/conexion.php'); 

	if(isset($_REQUEST['id_establecimiento']) && $_REQUEST['accion'] == 'eliminar'){

		$id_establecimiento = $_REQUEST['id_establecimiento'];

		//OBTENEMOS LA IMAGEN ANTERIOR
	    $sql_imagen = "SELECT logo FROM establecimientos WHERE id_establecimiento = '$id_establecimiento'";
	    $consulta_imagen=mysql_query($sql_imagen)or die("Error de consulta de conf");
	    $logo_ant=mysql_result($consulta_imagen,0,'logo');

		$sql_establecimientos = "DELETE FROM establecimientos WHERE id_establecimiento = $id_establecimiento";
	  	$consulta_establecimientos=mysql_query($sql_establecimientos);

	  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
		unlink('../../'.$logo_ant);

	}

	
	if($_REQUEST['accion'] == 'guardar'){


		$nombre = $_REQUEST['nombre'];
		$nombre = mb_strtoupper($nombre);

		$url = $_REQUEST['url'];

		$dir_insert_producto = "../../images/donde_comprar";				
		$dir_producto = "images/donde_comprar";			
		$nombre_producto = "establecimiento-".time()."-".rand(0,20).".jpg";			
		$destino1_producto = $dir_insert_producto."/".$nombre_producto;			
		$destino2_producto = $dir_producto."/".$nombre_producto;
	    move_uploaded_file($_FILES['logo']['tmp_name'],$destino1_producto);
	    $logo = $destino2_producto;

		// AGREGA EL ARTICULO
		if ($band == 0) {
			$sql = "INSERT INTO establecimientos (nombre, url, logo)
	      				VALUES ('$nombre', '$url', '$logo')";
		  	$consulta=mysql_query($sql)or die("Error de consulta de insercion");
		}	

		echo "<script>alert('EL PRODUCTO SE AGREGÓ CORRECTAMENTE')</script>";
		echo "<script>location.href='../donde_comprar.php'</script>";
		
	}


	if($_REQUEST['accion'] == 'editar'){


		$id_establecimiento = $_REQUEST['id_establecimiento'];
		
		$nombre = $_REQUEST['nombre'];
		$nombre = mb_strtoupper($nombre);

		$url = $_REQUEST['url'];

		$band = 0;

		//IMAGEN
		if ($_FILES["logo"]["name"] != "") {
			//IMAGEN
			$dir_insert_producto = "../../images/donde_comprar";				
			$dir_producto = "images/donde_comprar";			
			$nombre_producto = "establecimiento-".time()."-".rand(0,20).".jpg";			
			$destino1_producto = $dir_insert_producto."/".$nombre_producto;			
			$destino2_producto = $dir_producto."/".$nombre_producto;
		    move_uploaded_file($_FILES['logo']['tmp_name'],$destino1_producto);
		    $logo = $destino2_producto;

		    //OBTENEMOS LA IMAGEN ANTERIOR
		    $sql_imagen = "SELECT logo FROM establecimientos WHERE id_establecimiento = '$id_establecimiento'";
		    $consulta_imagen=mysql_query($sql_imagen)or die("Error de consulta de conf");
		    $logo_ant=mysql_result($consulta_imagen,0,'logo');

		    // EDITA EL ARTICULO CON IMAGEN
			if ($band == 0) {
				$sql = "UPDATE establecimientos 
		    			SET nombre = '$nombre', url = '$url', logo = '$logo'
		    			WHERE id_establecimiento = '$id_establecimiento'";
			  	$consulta=mysql_query($sql)or die("Error de consulta de insercion");

			  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
				unlink('../../'.$logo_ant);
			}
		}
		else{
			// EDITA EL ARTICULO SIN IMAGEN
			if ($band == 0) {
			  	$sql = "UPDATE establecimientos 
		    			SET nombre = '$nombre', url = '$url'
		    			WHERE id_establecimiento = '$id_establecimiento'";
		  		$consulta=mysql_query($sql)or die("Error de consulta de actualizacion");
			}
		}


		echo "<script>alert('EL REGISTRO SE MODIFICÓ CORRECTAMENTE')</script>";
		echo "<script>location.href='../donde_editar.php?id_establecimiento=$id_establecimiento'</script>";
		
	}

	

?>
