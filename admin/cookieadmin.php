<?php
	$user =$_GET['cidu'];
	$nom_usu =$_GET['nom_usu'];
	if ($user =='')
	{
		header('location:index.php');
		exit;
	}
	setcookie(usuariologin,$user);
	setCookie(acceso,1);
	setCookie(nom_usu,$nom_usu);
	session_start();
	$_SESSION['usuariologin']=$user;
	$_SESSION['acceso']=1;
	header('location:home.php');
	exit;
?>