<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/v.png">
    <link rel="stylesheet" href="../css/styles.css">
    <title>VBV-Tabla de reservas</title>
</head>

<body>
	<H2>Tabla de reservas</H2>
	<table border="2">
		<tr>
			<th>Nro. de reserva</th><th>Cancha</th><th>Fecha</th><th>Horario</th>
		</tr>	
<?php
	include ("conexion.php");

	$consulta = "select * from `reservas-futbol` ORDER BY fecha ASC" ;
	
	$resultado = mysqli_query($conexion, $consulta);
		
	while ( $fila = mysqli_fetch_assoc($resultado) ) {  
		  echo "<tr>
			      <td>".$fila['nroReserva']."</td><td>".$fila['cancha']."</td><td>".$fila['fecha']."</td><td>".$fila['hora']."</td>
				</tr>";
	}
	
	mysqli_close($conexion);
?>
	</table>
	<br></br>
	<input type='button' value='Volver' onClick='location="../pages/menú-reservas.html"'> 
</body>
</html>