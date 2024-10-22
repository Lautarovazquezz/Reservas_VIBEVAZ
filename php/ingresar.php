<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/v.png">
    <link rel="stylesheet" href="../css/styles.css">
    <title>VBV-Iniciar sesión</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="../index.html"></a></li>
            </ul>
        </nav>
        <h1>Iniciar sesión</h1>
    </header>
    <main>
        <section class="sectionForm">
            <form name="iniciarSesion" method="POST" action="./ingresar.php">
                <label for="correo">Email:</label><br><br>
                <input type="text" name="correo" max="100" placeholder="Ingrese correo electronico" required><br><br>
                <label for="contraseña">Contraseña:</label><br><br>
                <input type="password" name="contraseña" max="10" placeholder="Ingrese contraseña" required><br><br>
                <button  type="reset" value="borrar">Borrar</button>
                <button  type="submit" value="enviar" name="enviar">Iniciar sesión</button>
                <br><br><a class="registrarse" href="../pages/registrarse.html">Registrarse</a>
                <a class="admin" href="./ingresar-administrador.php">Administrador</a>
                <?php
		            if (isset($_POST["enviar"])) {  
			        include ("conexion.php");
			        $usu = $_POST['correo'];
                    $cla = $_POST['contraseña'];
			        $consulta = "SELECT * FROM usuario WHERE correo='$usu' AND contraseña='$cla'";
                    $resultado = mysqli_query($conexion, $consulta);
                    $cantfilas = mysqli_num_rows($resultado);
			        if ($cantfilas == 1) {
				        session_start();   
				        $_SESSION["logueado"] = $usu; 
				        header("location:./menú.php");
			        } else {
				        echo "<H4 id='errorLoguin'> Usuario y Clave no existen o no coinciden </H4>" ;
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