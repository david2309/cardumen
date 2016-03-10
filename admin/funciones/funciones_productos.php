<?php 
	include_once('../include/conexion.php'); 

	if(isset($_REQUEST['id_producto']) && $_REQUEST['accion'] == 'eliminar'){

		$id_producto = $_REQUEST['id_producto'];

		//OBTENEMOS LA IMAGEN ANTERIOR
	    $sql_imagen = "SELECT imagen FROM productos WHERE id_producto = '$id_producto'";
	    $consulta_imagen=mysql_query($sql_imagen)or die("Error de consulta de conf");
	    $imagen_ant=mysql_result($consulta_imagen,0,'imagen');

		$sql_productos = "DELETE FROM productos WHERE id_producto = $id_producto";
	  	$consulta_productos=mysql_query($sql_productos);

	  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
		unlink('../../'.$imagen_ant);

	}


	if($_REQUEST['vguardar'] == 'SI'){

		$nombre = $_REQUEST['nombre'];
		$nombre = mb_strtoupper($nombre, 'UTF-8');

		$url = $_REQUEST['url'];
		$band = 0;

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_nombre="SELECT * FROM productos WHERE nombre = '$nombre'";
            $consulta_nombre=mysql_query($sql_nombre);
            $filas_nombre=mysql_num_rows($consulta_nombre);

            if ($filas_nombre != 0) {
            	echo "<script>alert('EL NOMBRE YA SE ENCUNTRA REGISTRADO')</script>";
				$band = 1;
            }
		}

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_url="SELECT * FROM productos WHERE url = '$url'";
            $consulta_url=mysql_query($sql_url);
            $filas_url=mysql_num_rows($consulta_url);

            if ($filas_url != 0) {
            	echo "<script>alert('LA URL YA SE ENCUENTRA REGISTRADA')</script>";
				$band = 1;
            }
		}
		
	}

	
	if($_REQUEST['accion'] == 'guardar' & $_REQUEST['vguardar'] != "SI"){


		$nombre = $_REQUEST['nombre'];
		$nombre = mb_strtoupper($nombre, 'UTF-8');

		$tipo = $_REQUEST['tipo'];
		$tamano = $_REQUEST['tamano'];
		$url = $_REQUEST['url'];
		$descripcion = $_REQUEST['descripcion'];
		$band = 0;


		//IMAGEN
		$dir_insert_producto = "../../images/productos";				
		$dir_producto = "images/productos";			
		$nombre_producto = "producto-".time()."-".rand(0,20).".jpg";			
		$destino1_producto = $dir_insert_producto."/".$nombre_producto;			
		$destino2_producto = $dir_producto."/".$nombre_producto;
	    move_uploaded_file($_FILES['imagen']['tmp_name'],$destino1_producto);
	    $imagen = $destino2_producto;

	    //IMAGEN SLIDE
		$dir_insert_producto_slide = "../../images/productos_slide";				
		$dir_producto_slide = "images/productos_slide";			
		$nombre_producto_slide = "producto_slide-".time()."-".rand(0,20).".jpg";			
		$destino1_producto_slide = $dir_insert_producto_slide."/".$nombre_producto_slide;			
		$destino2_producto_slide = $dir_producto_slide."/".$nombre_producto_slide;
	    move_uploaded_file($_FILES['imagen_slide']['tmp_name'],$destino1_producto_slide);
	    $imagen_slide = $destino2_producto_slide;

		// AGREGA EL ARTICULO
		if ($band == 0) {
			$sql = "INSERT INTO productos (nombre, tipo, descripcion, tamano, imagen, imagen_slide, color, url)
	      				VALUES ('$nombre', '$tipo', '$descripcion', '$tamano', '$imagen', '$imagen_slide', '$color', '$url')";
		  	$consulta=mysql_query($sql)or die("Error de consulta de insercion");
		}	

		echo "<script>alert('EL PRODUCTO SE AGREGÓ CORRECTAMENTE')</script>";
		echo "<script>location.href='../productos.php'</script>";
		
	}


	if($_GET['veditar'] == 'SI'){

		$id_producto = $_REQUEST['id_producto'];
		$nombre = $_REQUEST['nombre'];
		$nombre = mb_strtoupper($nombre, 'UTF-8');

		$url = $_REQUEST['url'];
		$band = 0;

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_nombre="SELECT * FROM productos WHERE nombre = '$nombre' AND id_producto != '$id_producto'";
            $consulta_nombre=mysql_query($sql_nombre);
            $filas_nombre=mysql_num_rows($consulta_nombre);

            if ($filas_nombre != 0) {
            	echo "<script>alert('EL NOMBRE YA SE ENCUENTRA REGISTRADO')</script>";
				$band = 1;
            }
		}

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_url="SELECT * FROM productos WHERE url = '$url' AND id_producto != '$id_producto'";
            $consulta_url=mysql_query($sql_url);
            $filas_url=mysql_num_rows($consulta_url);

            if ($filas_url != 0) {
            	echo "<script>alert('LA URL YA SE ENCUENTRA REGISTRADA')</script>";
				$band = 1;
            }
		}
		
	}


	if($_REQUEST['accion'] == 'editar' & $_REQUEST['veditar'] != "SI"){
		$id_producto = $_REQUEST['id_producto'];
		
		$nombre = $_REQUEST['nombre'];
		$nombre = mb_strtoupper($nombre, 'UTF-8');

		$tipo = $_REQUEST['tipo'];
		$tamano = $_REQUEST['tamano'];
		$color = $_REQUEST['color'];
		$url = $_REQUEST['url'];
		$descripcion = $_REQUEST['descripcion'];
		$imagen = $_REQUEST['imagen'];
		$imagen_slide = $_REQUEST['imagen_slide'];
		$band = 0;

		//IMAGEN
		if ($_FILES["imagen"]["name"] != "") {
			//IMAGEN
			$dir_insert_producto = "../../images/productos";				
			$dir_producto = "images/productos";			
			$nombre_producto = "producto-".time()."-".rand(0,20).".jpg";			
			$destino1_producto = $dir_insert_producto."/".$nombre_producto;			
			$destino2_producto = $dir_producto."/".$nombre_producto;
		    move_uploaded_file($_FILES['imagen']['tmp_name'],$destino1_producto);
		    $imagen = $destino2_producto;

		    //OBTENEMOS LA IMAGEN ANTERIOR
		    $sql_imagen = "SELECT imagen FROM productos WHERE id_producto = '$id_producto'";
		    $consulta_imagen=mysql_query($sql_imagen)or die("Error de consulta de conf");
		    $img_anterior=mysql_result($consulta_imagen,0,'imagen');

		    // EDITA EL ARTICULO CON IMAGEN
			if ($band == 0) {
				$sql = "UPDATE productos 
	    			SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion', tamano = '$tamano', color = '$color', url = '$url',
	    				imagen = '$imagen'
	    			WHERE id_producto = '$id_producto'";

			  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
				unlink('../../'.$img_anterior);
				$consulta=mysql_query($sql)or die("Error de consulta de actualizacion");
			}
			
		}

		//IMAGEN SLIDE
		if ($_FILES["imagen_slide"]["name"] != "") {
			//IMAGEN
			$dir_insert_producto_slide = "../../images/productos_slide";				
			$dir_producto_slide = "images/productos_slide";			
			$nombre_producto_slide = "producto_slide-".time()."-".rand(0,20).".jpg";			
			$destino1_producto_slide = $dir_insert_producto_slide."/".$nombre_producto_slide;			
			$destino2_producto_slide = $dir_producto_slide."/".$nombre_producto_slide;
		    move_uploaded_file($_FILES['imagen_slide']['tmp_name'],$destino1_producto_slide);
		    $imagen_slide = $destino2_producto_slide;

		    //OBTENEMOS LA IMAGEN ANTERIOR
		    $sql_imagen_slide = "SELECT imagen_slide FROM productos WHERE id_producto = '$id_producto'";
		    $consulta_imagen_slide=mysql_query($sql_imagen_slide)or die("Error de consulta de conf");
		    $img_slide_anterior=mysql_result($consulta_imagen_slide,0,'imagen_slide');

		  	// EDITA EL ARTICULO CON IMAGEN
			if ($band == 0) {
				$sql = "UPDATE productos 
	    			SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion', tamano = '$tamano', color = '$color', url = '$url',
	    				imagen_slide = '$imagen_slide'
	    			WHERE id_producto = '$id_producto'";

			  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
				unlink('../../'.$img_slide_anterior);
				$consulta=mysql_query($sql)or die("Error de consulta de actualizacion");
			}
		}
		else{
			// EDITA EL ARTICULO SIN IMAGEN
			if ($band == 0) {
			  	$sql = "UPDATE productos 
		    			SET nombre = '$nombre', tipo = '$tipo', descripcion = '$descripcion', tamano = '$tamano', color = '$color', url = '$url'
		    			WHERE id_producto = '$id_producto'";
		  		$consulta=mysql_query($sql)or die("Error de consulta de actualizacion");
			}
		}


		echo "<script>alert('LA ENTRADA SE MODIFICO CORRECTAMENTE')</script>";
		echo "<script>location.href='../productos_editar.php?id_producto=$id_producto'</script>";
		
	}

	

?>
