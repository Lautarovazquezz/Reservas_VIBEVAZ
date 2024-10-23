<?php
include("verifica-sesion.php"); // Asegúrate de que verifica la sesión del usuario

// Conexión a la base de datos
include("conexion.php");

// Obtiene el ID del usuario de la sesión (ajustar según tu sistema de sesiones)
$usuario_id = $_SESSION['usuario_id']; // Asegúrate de que este ID esté configurado en la sesión

// Consulta las reservas del usuario logueado
$consulta = "SELECT * FROM `reservas_futbol_nou_camp` WHERE usuario_id='$usuario_id' ORDER BY fecha ASC, hora ASC";
$resultado = mysqli_query($conexion, $consulta);

// Manejo de la modificación de reservas
if (isset($_POST['modificar'])) {
    $reserva_id = $_POST['reserva_id'];
    $nueva_fecha = $_POST['nueva_fecha'];
    $nueva_hora = $_POST['nueva_hora'];
    $nueva_cancha = $_POST['nueva_cancha'];

    // Actualiza la reserva en la base de datos
    $actualizar_sql = "UPDATE `reservas_futbol_nou_camp` SET fecha='$nueva_fecha', hora='$nueva_hora', cancha='$nueva_cancha' WHERE reserva_id='$reserva_id' AND usuario_id='$usuario_id'";
    if (!mysqli_query($conexion, $actualizar_sql)) {
        echo "<p>Error al modificar la reserva: " . mysqli_error($conexion) . "</p>";
    }
}

// Manejo de la cancelación de reservas
if (isset($_POST['cancelar'])) {
    $reserva_id = $_POST['reserva_id'];

    // Elimina la reserva de la base de datos
    $eliminar_sql = "DELETE FROM `reservas_futbol_nou_camp` WHERE reserva_id='$reserva_id' AND usuario_id='$usuario_id'";
    if (!mysqli_query($conexion, $eliminar_sql)) {
        echo "<p>Error al cancelar la reserva: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script>
        function toggleModificar(reserva_id) {
            const form = document.getElementById(`form-modificar-${reserva_id}`);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="menú.php"></a></li>
                <li class="reservas"><a href="mis-reservas.php">Mis Reservas</a></li>
            </ul>
        </nav>
        <h1>Mis Reservas</h1>
    </header>
    <main>
        <section>
            <?php if (mysqli_num_rows($resultado) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Cancha</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Modificar</th>
                            <th>Cancelar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($fila['cancha']); ?></td>
                                <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
                                <td><?php echo htmlspecialchars($fila['hora']); ?></td>
                                <td>
                                    <button onclick="toggleModificar(<?php echo $fila['reserva_id']; ?>)">Modificar</button>
                                    <form method="POST" action="" style="display:inline;">
                                        <input type="hidden" name="reserva_id" value="<?php echo $fila['reserva_id']; ?>">
                                        <button type="submit" name="cancelar" onclick="return confirm('¿Estás seguro de que deseas cancelar esta reserva?');">Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                            <tr id="form-modificar-<?php echo $fila['reserva_id']; ?>" style="display:none;">
                                <td colspan="5">
                                    <form method="POST" action="">
                                        <input type="hidden" name="reserva_id" value="<?php echo $fila['reserva_id']; ?>">
                                        <label for="nueva_fecha">Nueva Fecha:</label>
                                        <input type="date" name="nueva_fecha" min="<?php echo date('Y-m-d'); ?>" required>
                                        <label for="nueva_hora">Nueva Hora:</label>
                                        <select name="nueva_hora" required>
                                            <option value="">Seleccione una hora</option>
                                            <?php
                                            for ($h = 8; $h <= 22; $h++) {
                                                $horaFormateada = sprintf("%02d:00", $h); // Formato HH:MM
                                                echo "<option value='$horaFormateada'>$horaFormateada</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="nueva_cancha">Nueva Cancha:</label>
                                        <select name="nueva_cancha" required>
                                            <option value="Fútbol 5">Fútbol 5</option>
                                            <option value="Fútbol 7">Fútbol 7</option>
                                            <option value="Fútbol 8">Fútbol 8</option>
                                        </select>
                                        <button type="submit" name="modificar">Modificar Reserva</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No tienes reservas registradas.</p>
            <?php endif; ?>

            <?php
                // Cierra la conexión a la base de datos
                mysqli_close($conexion);
            ?>
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
