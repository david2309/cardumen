<?php
	require_once 'include/conexion.php';

	$usuario=$_REQUEST['usuario'];
	$password=$_REQUEST['password'];
	$band=0;

	if ($band==0)
	{
		if($usuario == '' & $password == '')
		{
			$band=1;
			echo '<div class="alert alert-danger alert-dismissible fade in" id="alertDanger">
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	                </button>
	                <strong>Error:</strong> Llenar todos los campos
	            </div>';
		}
	}


	if ($band==0)
	{
		$sql="SELECT * FROM usuarios WHERE usuario='$usuario'";
		$consulta=mysql_query($sql);
		$filas=mysql_num_rows($consulta);
		if($filas==0)
		{
			$band=1;
			echo '<div class="alert alert-danger alert-dismissible fade in" id="alertDanger">
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	                </button>
	                <strong>Error:</strong> Nombre de usuario inválido
	            </div>';
		}
	}

	if($band==0)
	{
		//Obtenemos el password
		$pass=mysql_result($consulta,0,'password');

		if($pass!=md5($password))
		{
			$band=1;
			echo '<div class="alert alert-danger alert-dismissible fade in" id="alertDanger">
	                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                  <span aria-hidden="true">&times;</span>
	                </button>
	                <strong>Error:</strong> Contraseña incorrecta
	            </div>';
		}
	}

	if ($band==0)
	{
		$cidu=mysql_result($consulta,0,'id');
		$nom_usu=mysql_result($consulta,0,'usuario');
		echo "<script>window.location.replace('cookieadmin.php?cidu=$cidu&nom_usu=$nom_usu')</script>";
		exit;
	}

?>