<?php
	include("conexion.php");
	
	if (!$conexion) {
    	die("Error al conectar: " . mysqli_connect_error());
	}
	
	$consulta_usuarios = "SELECT * FROM `usuarios`;";
	$resultado_usuarios = mysqli_query($conexion, $consulta_usuarios);
	
	echo '<H1 class=h2> Tabla de usuarios </H1>';
	
	while ($fila = mysqli_fetch_assoc($resultado_usuarios)) { 
    	echo $fila['usuario'] .  '  -  ' . $fila['clave'] . '<br>';
	}
	
	mysqli_close($conexion);
	?>