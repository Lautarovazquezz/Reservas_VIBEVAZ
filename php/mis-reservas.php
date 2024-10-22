<?php
    include("verifica-sesion.php"); // Asegúrate de que verifica la sesión del usuario

    // Conexión a la base de datos
    include("conexion.php");

    // Obtiene el ID del usuario de la sesión (ajustar según tu sistema de sesiones)
    $usuario = $_SESSION['usuario'];

    // Consulta las reservas del usuario logueado
    $consulta = "SELECT * FROM `reservas-futbol-nou-camp` WHERE nombreYApellido='$nombreYApellido' ORDER BY fecha ASC, hora ASC";
    $resultado = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="../css/styles.css">
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
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?php echo $fila['cancha']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['hora']; ?></td>
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
