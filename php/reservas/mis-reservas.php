<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV - Mis Reservas</title>
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
        button {
            background-color: #7f7f7f;
            color: white;
            justify-content: center;
            align-items: center;
            margin: 10px;
            padding: 10px 20px;
            border: solid 2px;
            border-radius: 5px;
        }

        button:hover {
            cursor: pointer;
            background: #f2f2f2;
            color: black;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="../session/menú.php"></a></li>
            </ul>
            <?php
                include("../session/verifica-sesion.php");
                include("../session/conexion.php");

                $usuario_id = $_SESSION['usuario_id'];

                if (isset($_GET['cancelar']) && isset($_GET['reserva_id'])) {
                    $reserva_id = $_GET['reserva_id'];
                    $eliminar_sql = "DELETE FROM `reservas_futbol_nou_camp` WHERE reserva_id='$reserva_id' AND usuario_id='$usuario_id'";
                    mysqli_query($conexion, $eliminar_sql);
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }

                if (isset($_POST['modificar'])) {
                    $reserva_id = $_POST['reserva_id'];
                    $nueva_fecha = $_POST['nueva_fecha'];
                    $nueva_hora = $_POST['nueva_hora'];
                    $nueva_cancha = $_POST['nueva_cancha'];

                    $update_sql = "UPDATE `reservas_futbol_nou_camp` 
                                   SET fecha = '$nueva_fecha', hora = '$nueva_hora', cancha = '$nueva_cancha'
                                   WHERE reserva_id = '$reserva_id' AND usuario_id = '$usuario_id'";
                    mysqli_query($conexion, $update_sql);
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                }

                $rango_pag = 5;
                $pagina = isset($_GET['pagina']) && $_GET['pagina'] > 1 ? $_GET['pagina'] : 1;
                $desde = ($pagina - 1) * $rango_pag;

                $sql_count = "SELECT COUNT(*) AS total FROM reservas_futbol_nou_camp WHERE usuario_id='$usuario_id'";
                $resultado_count = mysqli_query($conexion, $sql_count);
                $cant_registros = mysqli_fetch_assoc($resultado_count)['total'];
                $cant_pag = ceil($cant_registros / $rango_pag);

                $consulta = "SELECT nombreR, cancha, fecha, hora, reserva_id FROM `reservas_futbol_nou_camp` WHERE usuario_id='$usuario_id' ORDER BY fecha ASC, hora ASC LIMIT $desde, $rango_pag";
                $resultado = mysqli_query($conexion, $consulta);
            ?>
        </nav>
        <h1>Mis Reservas</h1>
    </header>
    <main>
        <section>
            <?php if (mysqli_num_rows($resultado) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cancha</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>
                            <tr>
                                <td><?php echo $fila['nombreR']; ?></td>
                                <td><?php echo $fila['cancha']; ?></td>
                                <td><?php echo $fila['fecha']; ?></td>
                                <td><?php echo $fila['hora']; ?></td>
                                <td>
                                    <button onclick="document.getElementById('form-<?php echo $fila['reserva_id']; ?>').style.display='block'">Modificar</button>
                                    <a href="?cancelar=true&reserva_id=<?php echo $fila['reserva_id']; ?>">
                                        <button>Cancelar</button>
                                    </a>
                                </td>
                            </tr>
                            <tr id="form-<?php echo $fila['reserva_id']; ?>" style="display:none;">
                                <td colspan="5">
                                    <form method="POST" action="">
                                        <input type="hidden" name="reserva_id" value="<?php echo $fila['reserva_id']; ?>">
                                        <label>Nueva Fecha:</label>
                                        <input type="date" name="nueva_fecha" min="<?php echo date('Y-m-d'); ?>" required><br><br>
                                        <label>Nueva Hora:</label>
                                        <select name="nueva_hora" required>
                                            <option value="">Seleccione una hora</option>
                                            <?php for ($h = 8; $h <= 22; $h++): ?>
                                                <option value="<?php echo sprintf("%02d:00", $h); ?>"><?php echo sprintf("%02d:00", $h); ?></option>
                                            <?php endfor; ?>
                                        </select><br><br>
                                        <label>Nueva Cancha:</label>
                                        <select name="nueva_cancha" required>
                                            <option value="">Seleccione una cancha</option>
                                            <option value="Fútbol 5">Fútbol 5</option>
                                            <option value="Fútbol 7">Fútbol 7</option>
                                            <option value="Fútbol 8">Fútbol 8</option>
                                        </select><br><br>
                                        <button type="submit" name="modificar">Guardar Cambios</button>
                                        <button type="button" onclick="document.getElementById('form-<?php echo $fila['reserva_id']; ?>').style.display='none'">Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                    for ($i = 1; $i <= $cant_pag; $i++) {
                        echo "<a style='font-size:20px' href='?pagina=$i'>Pag.$i</a> ";
                    }
                    ?>
                </div><br>
            <?php else: ?>
                <p>No tienes reservas registradas.</p>
            <?php endif; ?>
            <?php
                mysqli_close($conexion);
            ?>
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
