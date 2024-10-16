<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/v.png">
    <link rel="stylesheet" href="../css/styles.css">
    <title>VBV-Buscar reservas</title>
</head>
<body class="sectionForm">
  <form action="buscar-reservas.php" method="GET">
	<h2> Buscar reserva por su número</h2>
	Criterio: &nbsp;
	<input type="number" name="nroReserva" minlength="" maxlength="3" autofocus required class="caja"/>
    <br></br>
    <input type="reset" value="Borrar" class="boton" /> &nbsp;&nbsp;&nbsp; 
    <input type="submit" value="Buscar" class="boton" name="enviar" /> &nbsp;&nbsp;&nbsp;
	<input type="button" value="Volver" class="boton" onClick='location="../pages/menú-reservas.html"' />
  </form>

  <?php  
	if (isset($_GET['enviar'])) {
		$nroReserva = $_GET['nroReserva'];
		include("conexion.php");
		echo "<br></br>";
		echo "<h3>La reserva con el numero <em>'$nroReserva'</em>.</h3>";	
		$consulta = "SELECT * FROM `reservas-futbol` WHERE nroReserva like '%$nroReserva%' ORDER BY hora ASC" ;
		$resultado = mysqli_query($conexion, $consulta);
		$cantFilas = mysqli_num_rows($resultado);
		if ($cantFilas==0) {echo '<H4> Sin resultados </H4>';}
		else { 
				echo "<table border='2'>";  
				echo "<tr>";  
				echo "<th>Nro. de reserva</th>";  
				echo "<th>Cancha</th>";  
				echo "<th>Fecha</th>";  
				echo "<th>Horario</th>";    
				echo "</tr>";
				while ( $fila = mysqli_fetch_assoc($resultado) ) {   
					echo "<tr>";  
					echo "<td>".$fila['nroReserva']."</td>";  
					echo "<td align='right'>".$fila['cancha']."</td>";
					echo "<td align='right'>".$fila['fecha']."</td>";
					echo "<td align='right'>".$fila['hora']."</td>";
					echo "</tr>";  
				}  
				echo "</table>"; 
			 }
		mysqli_close($conexion);
	}
   ?>
</body>
</html>