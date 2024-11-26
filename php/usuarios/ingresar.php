<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Iniciar sesión</title>
    <script src="../../JS/Funciones.js"></script>
    <script>
        function validaIngreso() {
            var usuario = document.login.usuario.value;
            var clave = document.login.clave.value;
            if (validaCadena(usuario, 6, 10) && validaCadena(clave, 8, 8)) {
                return true;
            } else {
                alert("Largo de usuario y/o Clave incorrectos");
                return false;
            }
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
        <h1>Iniciar sesión</h1>
    </header>

    <main>
        <section class="sectionForm">
            <form name="iniciarSesion" method="POST" action="./ingresar.php" onsubmit="return validaIngreso()">
                <label for="correo">Email:</label><br><br>
                <input type="email" name="correo" max="100" placeholder="Ingrese correo electrónico" autofocus required><br><br>
                <label for="contraseña">Contraseña:</label><br><br>
                <input type="password" name="contraseña" max="10" placeholder="Ingrese contraseña" required><br><br>
                <button type="reset" value="borrar">Borrar</button>
                <button type="submit" value="enviar" name="enviar">Iniciar sesión</button>
                <br><br>
                <a class="registrarse" href="./registrarse.php">Registrarse</a>
                <a class="admin" href="../administrador/ingresar-administrador.php">Administrador</a>
                <?php
                    if (isset($_POST["enviar"])) {
                    include("../session/conexion.php");
                    $usu = mysqli_real_escape_string($conexion, $_POST['correo']);
                    $cla = mysqli_real_escape_string($conexion, $_POST['contraseña']);
                    
                    // Consulta para verificar el usuario
                    $consulta = "SELECT * FROM usuario WHERE correo='$usu'";
                    $resultado = mysqli_query($conexion, $consulta);
                    $cantfilas = mysqli_num_rows($resultado);
                    
                    if ($cantfilas == 1) {
                        $usuario = mysqli_fetch_assoc($resultado);
                        
                        // Comparación exacta de la contraseña (respetando mayúsculas y minúsculas)
                        if ($cla == $usuario['contraseña']) {
                            session_start();
                            $_SESSION["logueado"] = $usu;
                            $_SESSION["usuario_id"] = $usuario['usuario_id'];
                            header("Location: ../session/menú.php");
                            exit;
                        } else {
                            echo "<br><br><h2 id='errorLoguin'> Contraseña incorrecta </h2>";
                        }
                    } else {
                        echo "<br><br><h2 id='errorLoguin'> Usuario no existe </h2>";
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
