<?php 
	include_once('../include/conexion.php'); 

	if(isset($_REQUEST['id_noticia']) && $_REQUEST['accion'] == 'eliminar'){

		$id_noticia = $_REQUEST['id_noticia'];

		//OBTENEMOS LA IMAGEN ANTERIOR
	    $sql_imagen = "SELECT imagen_hoja, imagen_articulo FROM noticias WHERE id_noticia = '$id_noticia'";
	    $consulta_imagen=mysql_query($sql_imagen)or die("Error de consulta de conf");
	    $imagen_ant_articulo=mysql_result($consulta_imagen,0,'imagen_articulo');

		$sql_productos = "DELETE FROM noticias WHERE id_noticia = $id_noticia";
	  	$consulta_productos=mysql_query($sql_productos);

	  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
		unlink('../../'.$imagen_ant_articulo);

	}


	if($_REQUEST['vguardar'] == 'SI'){

		$titulo = $_REQUEST['titulo'];

		$url = $_REQUEST['url'];
		$band = 0;

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_nombre="SELECT * FROM noticias WHERE titulo = '$titulo'";
            $consulta_nombre=mysql_query($sql_nombre);
            $filas_nombre=mysql_num_rows($consulta_nombre);

            if ($filas_nombre != 0) {
            	echo "<script>alert('EL TITULO YA SE ENCUNTRA REGISTRADO')</script>";
				$band = 1;
            }
		}

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_url="SELECT * FROM noticias WHERE url = '$url'";
            $consulta_url=mysql_query($sql_url);
            $filas_url=mysql_num_rows($consulta_url);

            if ($filas_url != 0) {
            	echo "<script>alert('LA URL YA SE ENCUENTRA REGISTRADA')</script>";
				$band = 1;
            }
		}
		
	}

	
	if($_REQUEST['accion'] == 'guardar' & $_REQUEST['vguardar'] != "SI"){

		$titulo = $_REQUEST['titulo'];

		$introduccion = $_REQUEST['introduccion'];
		$contenido = $_REQUEST['contenido'];
		$categoria = $_REQUEST['categoria'];
		$url = $_REQUEST['url'];
		$id_categoria = $_REQUEST['id_categoria'];
		$band = 0;


		//IMAGEN
		$dir_insert_producto = "../../images/noticias";				
		$dir_producto = "images/noticias";			
		$nombre_producto = "noticias-".time()."-".rand(0,20).".jpg";			
		$destino1_producto = $dir_insert_producto."/".$nombre_producto;			
		$destino2_producto = $dir_producto."/".$nombre_producto;
	    move_uploaded_file($_FILES['imagen_hoja']['tmp_name'],$destino1_producto);
	    $imagen_hoja = $destino2_producto;

	    //IMAGEN SLIDE
		$dir_insert_producto_slide = "../../images/noticias";				
		$dir_producto_slide = "images/noticias";			
		$nombre_producto_slide = "noticias-".time()."-".rand(0,20).".jpg";			
		$destino1_producto_slide = $dir_insert_producto_slide."/".$nombre_producto_slide;			
		$destino2_producto_slide = $dir_producto_slide."/".$nombre_producto_slide;
	    move_uploaded_file($_FILES['imagen_articulo']['tmp_name'],$destino1_producto_slide);
	    $imagen_articulo = $destino2_producto_slide;

		// AGREGA EL ARTICULO
		if ($band == 0) {
			$sql = "INSERT INTO noticias (titulo, introduccion, contenido, imagen_hoja, imagen_articulo, id_categoria, url, home, fecha)
	      				VALUES ('$titulo', '$introduccion', '$contenido', '$imagen_hoja', '$imagen_articulo', '$id_categoria', '$url', '', NOW())";
		  	$consulta=mysql_query($sql)or die("Error de consulta de insercion");
		}	

		echo "<script>alert('EL NOTICIA SE AGREGÓ CORRECTAMENTE')</script>";
		echo "<script>location.href='../noticias.php'</script>";
		
	}

	if($_REQUEST['veditar'] == 'SI'){

		$id_noticia = $_REQUEST['id_noticia'];
		$titulo = $_REQUEST['titulo'];

		$url = $_REQUEST['url'];
		$band = 0;

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_nombre="SELECT * FROM noticias WHERE titulo = '$titulo' AND id_noticia != '$id_noticia'";
            $consulta_nombre=mysql_query($sql_nombre);
            $filas_nombre=mysql_num_rows($consulta_nombre);

            if ($filas_nombre != 0) {
            	echo "<script>alert('EL TITULO YA SE ENCUENTRA REGISTRADO')</script>";
				$band = 1;
            }
		}

		// DEVUELVE SI YA EXISTE UN PRODUCTO CON LA MISMA URL
		if ($band == 0) {
			$sql_url="SELECT * FROM noticias WHERE url = '$url' AND id_noticia != '$id_noticia'";
            $consulta_url=mysql_query($sql_url);
            $filas_url=mysql_num_rows($consulta_url);

            if ($filas_url != 0) {
            	echo "<script>alert('LA URL YA SE ENCUENTRA REGISTRADA')</script>";
				$band = 1;
            }
		}
		
	}

	if($_REQUEST['accion'] == 'editar' & $_REQUEST['veditar'] != "SI"){


		$id_noticia = $_REQUEST['id_noticia'];
		
		$titulo = $_REQUEST['titulo'];

		$introduccion = $_REQUEST['introduccion'];
		$contenido = $_REQUEST['contenido'];
		$categoria = $_REQUEST['categoria'];
		$url = $_REQUEST['url'];
		$id_categoria = $_REQUEST['id_categoria'];
		$imagen_articulo = $_REQUEST['imagen_articulo'];
		$band = 0;
		
		if ($_FILES["imagen_articulo"]["name"] != "") {
		    //IMAGEN SLIDE
			$dir_insert_producto_slide = "../../images/noticias";				
			$dir_producto_slide = "images/noticias";			
			$nombre_producto_slide = "noticias-".time()."-".rand(0,20).".jpg";			
			$destino1_producto_slide = $dir_insert_producto_slide."/".$nombre_producto_slide;			
			$destino2_producto_slide = $dir_producto_slide."/".$nombre_producto_slide;
		    move_uploaded_file($_FILES['imagen_articulo']['tmp_name'],$destino1_producto_slide);
		    $imagen_articulo = $destino2_producto_slide;

		    //OBTENEMOS LA IMAGEN ANTERIOR
		    $sql_imagen = "SELECT imagen_hoja, imagen_articulo FROM noticias WHERE id_noticia = '$id_noticia'";
		    $consulta_imagen=mysql_query($sql_imagen)or die("Error de consulta de conf");
		    $imagen_ant_articulo=mysql_result($consulta_imagen,0,'imagen_articulo');

		    // EDITA EL ARTICULO CON IMAGEN
			if ($band == 0) {
				$sql = "UPDATE noticias 
		    			SET titulo = '$titulo', introduccion = '$introduccion', contenido = '$contenido', id_categoria = '$id_categoria', url = '$url', imagen_articulo = '$imagen_articulo'
		    			WHERE id_noticia = '$id_noticia'";
		    	$consulta=mysql_query($sql)or die("Error de consulta de actualizacion");

			  	//ELIMINAMOS DEL SERVIDOR LA IMAGEN ANTERIOR
				unlink('../../'.$imagen_ant_articulo);
			}
		}
		else{
			// EDITA EL ARTICULO SIN IMAGEN
			if ($band == 0) {
			  	$sql = "UPDATE noticias 
		    			SET titulo = '$titulo', introduccion = '$introduccion', contenido = '$contenido', id_categoria = '$id_categoria', url = '$url'
		    			WHERE id_noticia = '$id_noticia'";
		  		$consulta=mysql_query($sql)or die("Error de consulta de actualizacion");
			}
		}

		echo "<script>alert('LA ENTRADA SE MODIFICO CORRECTAMENTE')</script>";
		echo "<script>location.href='../noticias_editar.php?id_noticia=$id_noticia'</script>";
		
	}

	

?>
