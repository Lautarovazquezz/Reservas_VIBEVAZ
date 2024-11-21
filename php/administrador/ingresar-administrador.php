
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Iniciar sesión-Administrador</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="../../index.html"></a></li>
            </ul>
        </nav>
        <h1>Iniciar sesión-Administrador</h1>
    </header>
    <main>
        <section class="sectionForm">
            <form name="iniciarSesion" method="POST" action="./ingresar-administrador.php">
                <label for="correo">Email:</label><br><br>
                <input type="email" name="correo" max="100" placeholder="Ingrese correo electronico" autofocus required><br><br>
                <label for="contraseña">Contraseña:</label><br><br>
                <input type="password" name="contraseña" max="10" placeholder="Ingrese contraseña" required><br><br>
                <button value="Volver" onClick='location="../usuarios/ingresar.php"'>Volver</button>
                <button type="reset" value="borrar">Borrar</button>
                <button  type="submit" value="enviar" name="enviar">Iniciar sesión</button>
                <?php
		            if (isset($_POST["enviar"])) {  
			        include ("../session/conexion.php");
			        $usu = $_POST['correo'];
                    $cla = $_POST['contraseña'];
			        $consulta = "SELECT * FROM administradores WHERE correo='$usu' AND contraseña='$cla'";
                    $resultado = mysqli_query($conexion, $consulta);
                    $cantfilas = mysqli_num_rows($resultado);
			        if ($cantfilas == 1) {
				        session_start();   
				        $_SESSION["logueado-admin"] = $usu; 
                        $_SESSION["usuario_id"] = $usuario['usuario_id'];
				        header("location:../reservas/menú-reservas.php");
			        } else {
				        echo "<br><br><H2 id='errorLoguin'> Usuario y Clave no existen o no coinciden </H2>" ;
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