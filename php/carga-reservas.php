<?php  	
	include("conexion.php");
	
    $mesa = $_POST["mesa"];
    $fecha = $_POST["fecha"];
	$hora = $_POST["hora"]; 
	
	$consulta = "SELECT * FROM reservas-bar WHERE mesa='$mesa'";
	$resultado= mysqli_query($conexion, $consulta);
	$cantFilas = mysqli_num_rows($resultado);  
	if ($cantFilas == 1) {  
		echo "<H3>La reserva de la mesa ", $mesa, " se a registrado </H3>" ;
	} else {
		$sql="INSERT INTO reservas-bar (mesa,fecha,hora) VALUES ('$mesa','$fecha','$hora')";
		mysqli_query($conexion, $sql);
		echo "<H3>La reserva de la mesa ", $mesa, " se a registrado </H3>";
		echo "<br></br>";
		mysqli_close($conexion);
	}
	
	echo "<input type='button' class='boton' id='boton' value='Volver' onClick='location=\"../pages/nueva-reservas.html\"'> ";
?>  
