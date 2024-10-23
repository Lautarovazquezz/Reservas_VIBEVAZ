<?php
	include("verifica-administrador.php");
?>
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
			<th>correo de reserva</th><th>Nombre de reserva</th><th>Cancha</th><th>Fecha</th><th>Horario</th><th>Eliminar</th>
		</tr>	
		<?php
	include ("conexion.php");

	$consulta = "SELECT * FROM `reservas_futbol_nou_camp` ORDER BY fecha ASC";
	$resultado = mysqli_query($conexion, $consulta);

	while ($fila = mysqli_fetch_assoc($resultado)) {  
		echo "<tr>
			    <td align='center'>".$fila['correoE']."</td>
				<td align='center'>".$fila['nombreR']."</td>
			    <td align='center'>".$fila['cancha']."</td>
			    <td align='center'>".$fila['fecha']."</td>
			    <td align='center'>".$fila['hora']."</td>
			    <td align='center'>
			        <a href='?eliminar=".$fila['nombreR']."' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta reserva?');\">
			            <img src='../assets/images/Papelera.png' alt='Eliminar' style='width:20px;height:20px;' />
			        </a>
			    </td>
			  </tr>";
	}

	// Código para eliminar
	if (isset($_GET['eliminar'])) {
		$nombreR = $_GET['eliminar'];
		$sql = "DELETE FROM `reservas_futbol_nou_camp` WHERE nombreR='$nombreR'"; // Comillas simples para evitar errores con nombres
		try {
			mysqli_query($conexion, $sql);
		}
		catch (Exception $e) {
			$error = 2;
		}
	}
	
	mysqli_close($conexion);
?>

	</table>
	<br></br>
	<input type='button' value='Volver' onClick='location="./menú-reservas.php"'> 
</body>
</html>