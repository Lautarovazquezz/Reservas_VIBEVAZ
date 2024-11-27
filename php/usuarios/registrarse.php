<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV - Registrarse</title>
    <script>
        function validarRegistro(event) {
            let contraseña = document.forms["registrarse"]["contraseña"].value;
            let esValido = true;

            do {
                const contraseñaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z0-9]{8}$/;
                if (!contraseñaRegex.test(contraseña)) {
                    alert("La contraseña debe tener exactamente 8 caracteres, incluyendo al menos una letra mayúscula, una letra minúscula y un dígito.");
                    esValido = false;
                    break;
                }
            } while (false);

            if (!esValido) {
                event.preventDefault();
            }
            return esValido;
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="../../index.html"></a></li>
            </ul>
        </nav>
        <h1>Registrarse</h1>
    </header>
    <main>
        <section>
            <form name="registrarse" method="POST" action="./registrarse.php" onsubmit="return validarRegistro(event)">
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" maxlength="20" placeholder="Ingrese nombre" autofocus required><br><br>

                <label for="apellido">Apellido: </label>
                <input type="text" name="apellido" maxlength="20" placeholder="Ingrese apellido" required><br><br>

                <label for="correo">Email: </label>
                <input type="email" name="correo" maxlength="100" placeholder="Ingrese correo electrónico" required><br><br>

                <label for="contraseña">Contraseña: </label>
                <input type="password" name="contraseña" maxlength="8" placeholder="Ingrese contraseña" required><br><br>

                <button type="button" onClick='location.href="./ingresar.php"'>Volver</button>
                <button type="reset" value="Borrar">Borrar</button>
                <button type="submit" value="Enviar">Enviar</button>

                <?php  
                    include("../session/conexion.php");

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $nombre = $_POST["nombre"];
                        $apellido = $_POST["apellido"];
                        $correo = $_POST["correo"]; 
                        $contraseña = $_POST["contraseña"]; 

                        $consulta = "SELECT * FROM usuario WHERE correo='$correo'";
                        $resultado = mysqli_query($conexion, $consulta);
                        $cantFilas = mysqli_num_rows($resultado);

                        if ($cantFilas == 1) {  
                            echo "<h3>El correo ya está registrado</h3>";
                        } else {
                            $sql = "INSERT INTO usuario (nombre, apellido, correo, contraseña) VALUES('$nombre','$apellido','$correo','$contraseña')";
                            if (mysqli_query($conexion, $sql)) {
                                echo '<h2 >Te has registrado con éxito.</h2>';
                            } else {
                                echo '<h3>Error al registrarse.</h3>';
                            }
                            mysqli_close($conexion);
                        }
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
