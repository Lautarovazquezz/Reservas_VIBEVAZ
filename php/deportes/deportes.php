
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Deportes</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="../session/menú.php"></a></li>
            </ul>
            <?php
                include("../session/verifica-sesion.php");
            ?>
        </nav>
        <h1>Canchas de futbol</h1>
    </header>
    <main>
        <section class="image-gallery">
            <div class="image-container">
                <a href="tercer-tiempo.php">
                    <img src="https://img.freepik.com/vector-gratis/proximamente-fondo-diseno-efecto-luz-enfoque_1017-27277.jpg" alt="Proximamente">
                    <p class="image-title">Tercer tiempo</p>
                </a>
            </div>
            <div class="image-container">
                <a href="./nou-camp.php">
                    <img src="../../assets/images/nou-camp.jpeg" alt="Nou camp">
                    <p class="image-title">Nou camp</p>
                </a>
            </div>
            <div class="image-container">
                <a href="blanca-y-negra.php">
                    <img src="https://img.freepik.com/vector-gratis/proximamente-fondo-diseno-efecto-luz-enfoque_1017-27277.jpg" alt="Proximamente">
                    <p class="image-title">Blanca y negra</p>
                </a>
            </div>
        </section>
    </main>
    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
