<?php
include("../administrador/verifica-administrador.php"); 

if (!isset($_SESSION['logueado-admin'])) {
    header("Location: ../usuarios/ingresar.php");
    exit;
}

$logueado_admin = $_SESSION['logueado-admin'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css"> 
    <title>VBV-Reserva de Cancha</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="menú-reservas.php"></a></li>
            </ul>
        </nav>
        <h1>Realizar Reserva de Cancha</h1>
    </header>
    <main>
        <section class="sectionForm">
            <form name="nuevaReserva" method="POST" action="./nueva-reservas.php">
                <p>Reservando con la cuenta: <strong style="color: blue;"><?php echo $logueado_admin; ?></strong></p><br>
                <label for="nombreR">Nombre y apellido:</label>
                <input type="text" name="nombreR" autofocus required><br><br>

                <label for="cancha">Cancha:</label>
                <select class='input' name="cancha" required>
                    <option value="Fútbol 5">Fútbol 5</option>
                    <option value="Fútbol 7">Fútbol 7</option>
                    <option value="Fútbol 8">Fútbol 8</option>
                </select><br><br>

                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" required><br><br>

                <label for="hora">Hora:</label>
                <select class='input' name="hora" required>
                    <option value="">Seleccione una hora</option>
                    <?php
                    for ($h = 8; $h <= 22; $h++) {
                        $horaFormateada = sprintf("%02d:00", $h); 
                        echo "<option value='$horaFormateada'>$horaFormateada</option>";
                    }
                    ?>
                </select><br><br>

                <button value="Volver" onClick='location="./menú-reservas.php"'>Volver</button>
                <button type="submit" name="enviar">Reservar</button>
                <?php
                    if (isset($_POST['enviar'])) {
                        include("../session/conexion.php");
                        
                        $nombreR = $_POST["nombreR"];
                        $cancha = $_POST["cancha"];
                        $fecha = $_POST["fecha"];
                        $hora = $_POST["hora"];

                        $consulta = "SELECT * FROM reservas_futbol_nou_camp WHERE cancha='$cancha' AND fecha='$fecha' AND hora='$hora'";
                        $resultado = mysqli_query($conexion, $consulta);
                        $cantFilas = mysqli_num_rows($resultado);

                        if ($cantFilas >= 1) {
                            echo "<h3 style='color:red'>Ya hay una reserva para esa cancha en la fecha y hora seleccionadas.</h3>";
                        } else {
                            $sql = "INSERT INTO reservas_futbol_nou_camp (correoE, cancha, fecha, hora, nombreR) 
                                    VALUES ('$logueado_admin', '$cancha', '$fecha', '$hora','$nombreR')";
                            
                            if (mysqli_query($conexion, $sql)) {
                                echo "<h2 style='color:green'>Reserva realizada exitosamente a nombre de $nombreR.</h2>";
                            } else {
                                echo "<h3 style='color:red'>Error al registrar la reserva: " . mysqli_error($conexion) . "</h3>";
                            }
                        }

                        mysqli_close($conexion);
                    }
                ?>
            </form>

        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>

</html>