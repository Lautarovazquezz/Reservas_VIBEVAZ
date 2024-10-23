<?php
session_start(); // Iniciar sesión

// Conexión a la base de datos
include("conexion.php");

if (isset($_POST['enviar'])) {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consulta para verificar si el correo y contraseña coinciden
    $consulta = "SELECT usuario_id, correo FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        // Credenciales correctas, obtener datos del usuario
        $fila = mysqli_fetch_assoc($resultado);

        // Guardar correo y usuario_id en la sesión
        $_SESSION['correo'] = $fila['correo'];
        $_SESSION['usuario_id'] = $fila['usuario_id'];

        // Redirigir al menú o página de reservas
        header("Location: menu.php");
        exit;
    } else {
        // Mostrar error si las credenciales no coinciden
        echo "<h3>Correo o contraseña incorrectos.</h3>";
    }
}
?>
