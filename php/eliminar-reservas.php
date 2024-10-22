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
    <title>VBV-Eliminar reservas</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="./menú-reservas.html"></a></li>
            </ul>
        </nav>
        <h1>Eliminar reservas</h1>
    </header>
    <main>
        <form method="post" action="./mostrar-reserva-eliminar.php">
            <label for="cancha">Numero de reserva</label>
            <input type="text" id="cancha" name="cancha" required>
            <br><br>
            <input class="enviar" type="submit" value="Buscar">
            <input class="borrar" type="button" value="Cancelar" onclick="location='menú-reservas.html'">
        </form>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
<?php
    include("conexion.php");
    $nombreYApellido = $_POST ["nombreYApellido"];
    $sql = "DELETE FROM reservas-futbol-nou-camp WHERE nombreYApellido=$nombreYApellido";
    if (mysqli_query($conexion, $sql)){
        if(mysqli_affected_rows($conexion) > 0) {
            echo "<br></br><br></br> <h3>Se elimino la reserva</h3>";
        } else{ echo "<br></br><br></br> <h3>No se elimino la reserva</h3>"; } 
    } else {echo "<br></br><br></br> <h3>error</h3>"; }
    mysqli_close($conexion)
?>

</html>
