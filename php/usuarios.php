<?php
include("conexion.php");


$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

$consulta = "SELECT * FROM usuario WHERE correo='$correo' AND contraseña='$contraseña'";
$resultado = mysqli_query($conexion, $consulta);
$cantfilas = mysqli_num_rows($resultado);

if ($cantfilas == 1){
    header("Location: ../pages/menú.php");
} else {
    echo "<h1>Datos incorrectos</h1>";
    echo "<a href='../pages/ingresar.html'><h2 class='enviarVolver'>Volver a intentar</h2></a>";
}
?>
