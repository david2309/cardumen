<?php 
	include_once('../include/conexion.php'); 

	if(isset($_REQUEST['id_correo']) && $_REQUEST['accion'] == 'eliminar'){

		$id_correo = $_REQUEST['id_correo'];

		$sql_contacto = "DELETE FROM correo WHERE id_correo = $id_correo";
	  	$consulta_contacto=mysql_query($sql_contacto);

	}
?>