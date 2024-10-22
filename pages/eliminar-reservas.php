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
        <form method="post" action="../php/mostrar-reserva-eliminar.php">
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

</html>