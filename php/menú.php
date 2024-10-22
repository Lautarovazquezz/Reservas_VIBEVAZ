<?php
    include("verifica-sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/v.png">
    <link rel="stylesheet" href="../css/styles.css">
    <title>VBV</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="menú.php"></a></li>
                <!-- Botón "Mis Reservas" agregado al lado del menú -->
                <li class="reservas"><a href="mis-reservas.php">Mis Reservas</a></li>
            </ul>
        </nav>
        <h1>V I B E V A Z</h1>
    </header>
    <main>
        <section class="image-gallery">
            <div class="image-container">
                <a href="../pages/bares.html">
                    <img src="../assets/images/restaurante.jpg" alt="">
                    <p class="image-title">Bares & restaurantes</p>
                </a>
            </div>
            <div class="image-container">
                <a href="../pages/hospedajes.html">
                    <img src="../assets/images/hospedaje.jpg" alt="">
                    <p class="image-title">Hospedajes</p>
                </a>
            </div>
            <div class="image-container">
                <a href="./deportes.php">
                    <img src="../assets/images/deporte.jpg" alt="">
                    <p class="image-title">Deportes</p>
                </a>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
