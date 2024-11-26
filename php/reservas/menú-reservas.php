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
        <section class="image-gallery">
            <div class="image-container">
                <a href="./buscar-reservas.php">
                    <img src="https://cdn.pixabay.com/photo/2024/02/04/20/22/search-8553066_640.png" alt="Buscador">
                    <p class="image-title">Buscar reservas</p>
                </a>
            </div>
            <div class="image-container">
                <a href="./tabla-reservas.php">
                    <img src="https://impulso06.com/wp-content/uploads/2023/10/La-gestion-de-reservas-en-hosteleria.-Herramientas-y-metodos.png" alt="Tabla">
                    <p class="image-title">Tabla de reservas</p>
                </a>
            </div>
            <div class="image-container">
                <a href="../session/cerrar-sesion.php">
                    <img src="https://img.freepik.com/vector-gratis/ilustracion-concepto-escape_114360-5666.jpg" alt="Salir">
                    <p class="image-title">Salir</p>
                </a>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>