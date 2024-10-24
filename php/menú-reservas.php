<?php
	include("verifica-administrador.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/v.png">
    <link rel="stylesheet" href="../css/styles.css">
    <title>VBV-Menú de reservas</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="../index.html"></a></li>
            </ul>
        </nav>
        <h1>Menú de reservas</h1>
    </header>
    <main>
        <section>
            <input id="boton" type="button" value="Cargar reservas" onClick="location='./nueva-reservas.html'" class="boton" />                     
            <input id='boton' type='button' value='Buscar reservas' onClick="location='../php/buscar-reservas.php'" class="boton" />
            <input id='boton' type='button' value='Eliminar reservas' onClick='location="./eliminar-reservas.php"' class="boton" />
            <input id='boton' type='button' value='Tabla de reservas' onClick='location="../php/tabla-reservas.php"' class="boton" />
            <input id="boton" type="button" value="Salir" onClick='location="../php/ingresar.php"' class="boton" />
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>