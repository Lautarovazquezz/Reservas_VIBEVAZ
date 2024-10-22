<?php
	session_start(); 
	if (isset($_SESSION["logueado"])) {  
		echo "<p id='sesion'> Usuario: <b>" . $_SESSION["logueado"] . "</b> &nbsp&nbsp";
		echo "<a href='cerrar-sesion.php'>Cerrar Sesion</a> </p>";
	} else {
		header("location:../ingresar.php");
	}
?>