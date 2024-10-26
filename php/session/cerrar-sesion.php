<?php 
	session_start();  
	session_destroy(); 
	$conexion = null;
	header("location:../usuarios/ingresar.php");
	exit();
?>
