<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Tabla de reservas</title>
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
        <section>
            <table>
                <tr>
                    <th>Correo electrónico</th><th>Nombre de reserva</th><th>Cancha</th><th>Fecha</th><th>Horario</th><th>Eliminar</th>
                </tr>	
                <?php
                include ("../session/conexion.php");

                $consulta = "SELECT * FROM `reservas_futbol_nou_camp` ORDER BY fecha ASC";
                $resultado = mysqli_query($conexion, $consulta);

                while ($fila = mysqli_fetch_assoc($resultado)) {  
                    echo "<tr>
                            <td>".$fila['correoE']."</td>
                            <td>".$fila['nombreR']."</td>
                            <td>".$fila['cancha']."</td>
                            <td>".$fila['fecha']."</td>
                            <td>".$fila['hora']."</td>
                            <td>
                                <a href='?eliminar=".$fila['nombreR']."' onclick=\"return confirm('¿Estás seguro de que deseas eliminar esta reserva?');\">
                                    <img src='../../assets/images/Papelera.png' alt='Eliminar' />
                                </a>
                            </td>
                        </tr>";
                }

                if (isset($_GET['eliminar'])) {
                    $nombreR = $_GET['eliminar'];
                    $sql = "DELETE FROM `reservas_futbol_nou_camp` WHERE nombreR='$nombreR'"; 
                    try {
                        mysqli_query($conexion, $sql);
                    } catch (Exception $e) {
                        echo "<p>Error al eliminar la reserva: " . mysqli_error($conexion) . "</p>";
                    }
                }
                
                mysqli_close($conexion);
                ?>
            </table>
            <br><br>
            <input class='boton' type="button" value="Volver" onClick="location='./menú-reservas.php'">
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
