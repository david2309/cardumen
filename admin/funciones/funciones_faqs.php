<?php 

	include_once('../include/conexion.php'); 

	if(isset($_REQUEST['id_faq']) && $_REQUEST['accion'] == 'eliminar'){

		$id_faq = $_REQUEST['id_faq'];

		$sql_faqs = "DELETE FROM faqs WHERE id_faq = $id_faq";
	  	$consulta_faqs=mysql_query($sql_faqs);

	}


	if($_REQUEST['accion'] == 'guardar'){

		$pregunta = $_REQUEST['pregunta'];
		$respuesta = $_REQUEST['respuesta'];
		$band = 0;

		if ($band == 0 & $pregunta == "") 
		{
			echo "<div class='alerta_roja'>EL CAMPO PREGUNTA SE ENCUENTRA VACÍO</div>";
			$band = 1;
		}

		if ($band == 0 & $respuesta == "") 
		{
			echo "<div class='alerta_roja'>EL CAMPO RESPUESTA SE ENCUENTRA VACÍO</div>";
			$band = 1;
		}

		if ($band == 0) 
		{
			$sql = "INSERT INTO faqs (pregunta, respuesta)
	      				VALUES ('$pregunta', '$respuesta')";
		  	$consulta=mysql_query($sql)or die("Error de consulta de insercion");

			echo "<script>alert('LA PREGUNTA SE AGREGÓ CORRECTAMENTE')</script>";
		  	echo "<script>location.href='faqs.php'</script>";
		}
		
	}

	if($_REQUEST['accion'] == 'actualizar'){

		$id_faq = $_REQUEST['u_id_faq'];
		$pregunta = $_REQUEST['u_pregunta'];
		$respuesta = $_REQUEST['u_respuesta'];

		$sql = "UPDATE faqs 
    			SET pregunta = '$pregunta', respuesta = '$respuesta'
    			WHERE id_faq = '$id_faq'";
  		$consulta=mysql_query($sql)or die("Error de consulta de actualizacion1");

		
	}

?>

