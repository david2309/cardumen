<?php 

	// // CONEXION LOCAL
	$conexion = mysql_connect('localhost', 'root', 'root', 'db_cardumen')or die ('erro hosting');
	$base=mysql_select_db("db_cardumen", $conexion) or die ("error de base");
	mysql_set_charset('utf8');


	// CONEXION ONLINE
	// $conexion = mysql_connect('internal-db.s128162.gridserver.com', 'db128162_rt2014', 'h95eS7ULZvXpxKc', 'db128162_marqco')or die ('erro hosting');
	// $base=mysql_select_db("db128162_marqco", $conexion) or die ("error de base");
	// mysql_set_charset('utf8');

	
?>