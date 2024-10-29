<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Buscar reservas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a img {
            width: 24px;
            height: 24px;
            transition: transform 0.2s;
        }
        a img:hover {
            transform: scale(1.2);
        }
    </style>
</head>
<body>
	<header>
        <nav>
            <ul>
                <li class="icon"><a href="menú-reservas.php"></a></li>
            </ul>
			<?php
				include("../administrador/verifica-administrador.php");
			?>
        </nav>
		<h1>Tabla de reservas</h1>
    </header>
	<main>
		<section style="display: flex; gap: 20px; align-items: flex-start;">
			<form action="buscar-reservas.php" method="GET" style="flex: 1; max-width: 500px;">
				<h2>Buscar reserva a nombre de:</h2><br>
				Criterio: &nbsp;
				<input type="text" name="nombreR" autofocus required class="caja"/>
				<br><br>
				<div style="display: flex; gap: 10px;">
        			<input type="button" value="Volver" class="boton" onClick='location="./menú-reservas.php"' />
					<input type="reset" value="Borrar" class="boton" />
        			<input type="submit" value="Buscar" class="boton" name="enviar" />
    			</div>
			</form>

			<?php  
				if (isset($_GET['enviar'])) {
					$nombreR = $_GET['nombreR'];
					include("../session/conexion.php");
					echo "<div style='flex: 2;'>";
					echo "<h3>Resultados para <em>'$nombreR'</em></h3>";
					$consulta = "SELECT * FROM `reservas_futbol_nou_camp` WHERE nombreR LIKE '%$nombreR%' ORDER BY hora ASC";
					$resultado = mysqli_query($conexion, $consulta);
					$cantFilas = mysqli_num_rows($resultado);

					if ($cantFilas == 0) {
						echo '<h4>Sin resultados</h4>';
					} else {
						echo "<table>";
						echo "<tr><th>Correo electrónico</th><th>Nombre de reserva</th><th>Cancha</th><th>Fecha</th><th>Horario</th><th>Eliminar</th></tr>";
						while ($fila = mysqli_fetch_assoc($resultado)) {   
							echo "<tr><td>".$fila['correoE']."</td><td>".$fila['nombreR']."</td>";
							echo "<td>".$fila['cancha']."</td><td>".$fila['fecha']."</td><td>".$fila['hora']."</td>";
							echo "<td><a href='buscar-reservas.php?eliminar=".$fila['nombreR']."' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta reserva?');\">";
							echo "<img src='../../assets/images/Papelera.png' alt='Eliminar' /></a></td></tr>";
						}  
						echo "</table><br><br><br>";
					}
					echo "</div>";
					mysqli_close($conexion);
				}

				if (isset($_GET['eliminar'])) {
					$nombreR = $_GET['eliminar'];
					include("../session/conexion.php");
					$sql = "DELETE FROM `reservas_futbol_nou_camp` WHERE nombreR='$nombreR'"; 
					
					if (mysqli_query($conexion, $sql)) {
						echo "<h2 style='color: green;'>Reserva eliminada correctamente.</h2>";
					} else {
						echo "<h3 style='color: red;'>Error al eliminar la reserva: " . mysqli_error($conexion) . "</h3>";
					}
					mysqli_close($conexion);
				}
			?>
		</section>
	</main>
	<footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

