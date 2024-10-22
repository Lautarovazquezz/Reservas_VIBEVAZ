<?php
	include("verifica-sesion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Cancha</title>
    <link rel="stylesheet" href="../css/styles.css"> <!-- Estilos opcionales -->
</head>

<body>
    <header>
    <nav>
            <ul>
                <li class="icon"><a href="menú.php"></a></li>
            </ul>
        </nav>
        <h1>Realizar Reserva de Cancha</h1>
    </header>
    <main>
        <section class="sectionForm">
            <!-- Formulario para ingresar los datos de la reserva -->
            <form name="nuevaReserva" method="POST" action="">
                <label for="nombreYApellido">Nombre de Reserva:</label><br>
                <input type="text" name="nombreYApellido" required><br><br>

                <label for="cancha">Cancha:</label><br>
                <select name="cancha" required>
                    <option value="Fútbol 5">Fútbol 5</option>
                    <option value="Fútbol 7">Fútbol 7</option>
                    <option value="Fútbol 8">Fútbol 8</option>
                </select><br><br>

                <label for="fecha">Fecha (YYYY-MM-DD):</label><br>
                <input type="date" name="fecha" required><br><br>

                <label for="hora">Hora (HH:MM):</label><br>
                <input type="time" name="hora" required><br><br>

                <button type="submit" name="enviar">Reservar</button>
            </form>

            <?php
                if (isset($_POST['enviar'])) {
                    // Conexión a la base de datos
                    include("conexion.php"); // Asegúrate de que el archivo "conexion.php" esté configurado correctamente

                    // Obtiene los datos enviados por el formulario
                    $nombreYApellido = $_POST["nombreYApellido"];
                    $cancha = $_POST["cancha"];
                    $fecha = $_POST["fecha"];
                    $hora = $_POST["hora"]; 

                    // Verifica si ya existe una reserva con el mismo número
                    $consulta = "SELECT * FROM `reservas-futbol-nou-camp` WHERE nombreYApellido='$nombreYApellido'";
                    $resultado = mysqli_query($conexion, $consulta);
                    $cantFilas = mysqli_num_rows($resultado);  

                    if ($cantFilas == 1) {  
                        // Si ya existe una reserva con ese número
                        echo "<h3>La reserva $nombreYApellido ya ha sido registrada.</h3>";
                    } else {
                        // Inserta la nueva reserva en la base de datos
                        $sql = "INSERT INTO `reservas-futbol-nou-camp` (nombreYApellido, cancha, fecha, hora, disponible) 
                                VALUES ('$nombreYApellido','$cancha', '$fecha', '$hora', 0)";
                        
                        if (mysqli_query($conexion, $sql)) {
                            echo "<h3>La reserva $nombreYApellido se ha registrado exitosamente.</h3>";
                        } else {
                            echo "<h3>Error al registrar la reserva: " . mysqli_error($conexion) . "</h3>";
                        }

                        // Cierra la conexión a la base de datos
                        mysqli_close($conexion);
                    }

                    // Botón para volver al formulario de nueva reserva
                    echo "<br><input type='button' class='boton' id='boton' value='Volver' onClick='location=\"../pages/nueva-reservas.html\"'> ";
                }
            ?>
        </section>
    </main>
    <footer>
        <p>© 2024 Reserva de Canchas. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
