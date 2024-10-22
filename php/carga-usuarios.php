<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<style>
		body{
			background: #7f7f7f;
		}


	</style>
</head>
<body>
<?php  	
	include("conexion.php");
	
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
	$correo = $_POST["correo"]; 
	$contraseña = $_POST["contraseña"]; 
	
	$consulta = "SELECT * FROM usuario WHERE correo='$correo'";
	$resultado= mysqli_query($conexion, $consulta);
	$cantFilas = mysqli_num_rows($resultado);  
	if ($cantFilas == 1) {  
		echo "<H3>Te has registrado con exito</H3>" ;
	} else {
		$sql="INSERT INTO usuario (nombre,apellido,correo,contraseña) VALUES ('$nombre','$apellido','$correo', '$contraseña')";
		mysqli_query($conexion, $sql);
		echo '<h2 class="h2">Te has registrado con exito.</h2>';
		echo "<br></br>";
		mysqli_close($conexion);
	}
	
	echo "<input type='button' class='boton' id='boton' value='Volver' onClick='location=\"../php/ingresar.php\"'> ";
?>  
	
</body>
</html>
