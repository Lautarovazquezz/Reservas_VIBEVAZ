<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV - Tabla de reservas</title>
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
            <?php include("../administrador/verifica-administrador.php"); ?>
        </nav>
        <h1>Tabla de reservas</h1>
    </header>
    <main>
        <section>
            <table>
                <tr>
                    <th>Correo electrónico</th>
                    <th>Nombre de reserva</th>
                    <th>Cancha</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                include("../session/conexion.php");

                
                $rango_pag = 5;
                $pagina = isset($_GET['pagina']) && $_GET['pagina'] > 1 ? $_GET['pagina'] : 1;
                $desde = ($pagina - 1) * $rango_pag;

                $sql_count = "SELECT COUNT(*) AS total FROM reservas_futbol_nou_camp";
                $resultado_count = mysqli_query($conexion, $sql_count);
                $cant_registros = mysqli_fetch_assoc($resultado_count)['total'];
                $cant_pag = ceil($cant_registros / $rango_pag);

                $sql = "SELECT * FROM reservas_futbol_nou_camp ORDER BY fecha ASC LIMIT $desde, $rango_pag";
                $resultado = mysqli_query($conexion, $sql);

                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>{$fila['correoE']}</td>
                            <td>{$fila['nombreR']}</td>
                            <td>{$fila['cancha']}</td>
                            <td>{$fila['fecha']}</td>
                            <td>{$fila['hora']}</td>
                            <td>
                                <a href='?eliminar={$fila['nombreR']}' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta reserva?');\">
                                    <img src='../../assets/images/Papelera.png' alt='Eliminar' />
                                </a>
                            </td>
                          </tr>";
                }

                if (isset($_GET['eliminar'])) {
                    $nombreR = $_GET['eliminar'];
                    $sql_delete = "DELETE FROM reservas_futbol_nou_camp WHERE nombreR = '$nombreR'";
                    if (!mysqli_query($conexion, $sql_delete)) {
                        echo "<p>Error al eliminar la reserva: " . mysqli_error($conexion) . "</p>";
                    } else {
                        header("Location: tabla-reservas.php");
                    }
                }

                mysqli_close($conexion);
                ?>
            </table>

            <div class="pagination">
                <?php
                for ($i = 1; $i <= $cant_pag; $i++) {
                    echo "<a href='?pagina=$i'>Pag.$i</a> ";
                }
                ?>
            </div>
            <br><br>
            <button onclick="location='./menú-reservas.php'">Volver</button>
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
