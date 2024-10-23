<?php
include("verifica-sesion.php"); // Verifica si el usuario está logueado

// Asegúrate de que el usuario está logueado
if (!isset($_SESSION['logueado'])) {
    header("Location: login.php");
    exit;
}

// Obtener el correo y el ID del usuario logueado desde la sesión
$logueado = $_SESSION['logueado'];
$usuario_id = $_SESSION['usuario_id'];
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
                <p>Reservando como: <strong><?php echo $logueado; ?></strong></p><br>
                <label for="nombreR">Nombre y apellido:</label><br>
                <input type="text" name="nombreR" required><br>
                <label for="cancha">Cancha:</label><br>
                <select name="cancha" required>
                    <option value="Fútbol 5">Fútbol 5</option>
                    <option value="Fútbol 7">Fútbol 7</option>
                    <option value="Fútbol 8">Fútbol 8</option>
                </select><br><br>

                <label for="fecha">Fecha (YYYY-MM-DD):</label><br>
                <input type="date" name="fecha" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" required><br><br>

                <label for="hora">Hora:</label><br>
                <select name="hora" required>
                    <option value="">Seleccione una hora</option>
                    <?php
                    // Generar opciones de hora en punto
                    for ($h = 8; $h <= 22; $h++) {
                        $horaFormateada = sprintf("%02d:00", $h); // Formato HH:MM
                        echo "<option value='$horaFormateada'>$horaFormateada</option>";
                    }
                    ?>
                </select>
                <br><br>

                <button type="submit" name="enviar">Reservar</button>
            </form>

            <?php
                if (isset($_POST['enviar'])) {
                    include("conexion.php");

                    // Obtener los datos del formulario
                    $cancha = $_POST["cancha"];
                    $fecha = $_POST["fecha"];
                    $hora = $_POST["hora"];
                    $nombreR = $_POST["nombreR"];

                    // Verificar si ya existe una reserva en la misma fecha, hora y cancha
                    $consulta = "SELECT * FROM reservas_futbol_nou_camp WHERE cancha='$cancha' AND fecha='$fecha' AND hora='$hora'";
                    $resultado = mysqli_query($conexion, $consulta);
                    $cantFilas = mysqli_num_rows($resultado);

                    if ($cantFilas >= 1) {
                        // Si ya existe una reserva en esa fecha y hora
                        echo "<h3>Ya hay una reserva para esa cancha en la fecha y hora seleccionadas.</h3>";
                    } else {
                        // Inserta la nueva reserva con el correo y el ID del usuario logueado
                        $sql = "INSERT INTO reservas_futbol_nou_camp (usuario_id, correoE, cancha, fecha, hora, nombreR) 
                                VALUES ('$usuario_id', '$logueado', '$cancha', '$fecha', '$hora','$nombreR')";
                        
                        if (mysqli_query($conexion, $sql)) {
                            echo "<h3>Reserva realizada exitosamente a nombre de $logueado.</h3>";
                        } else {
                            echo "<h3>Error al registrar la reserva: " . mysqli_error($conexion) . "</h3>";
                        }
                    }

                    // Cierra la conexión a la base de datos
                    mysqli_close($conexion);
                }
            ?>
        </section>
    </main>
    <footer>
        <p>© 2024 Reserva de Canchas. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
