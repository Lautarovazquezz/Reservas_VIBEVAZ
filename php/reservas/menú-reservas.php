<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Menú de reservas</title>
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
        <h1>Menú de reservas</h1>
    </header>
    <main>
        <section>                 
            <input id='boton' type='button' value='Buscar reservas' onClick="location='./buscar-reservas.php'" class="boton" />
            <input id='boton' type='button' value='Tabla de reservas' onClick='location="./tabla-reservas.php"' class="boton" />
            <input id="boton" type="button" value="Salir" onClick='location="../session/cerrar-sesion.php"' class="boton" />
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>