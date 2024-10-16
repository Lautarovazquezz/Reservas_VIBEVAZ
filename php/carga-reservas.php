<?php  
    include("conexion.php");
    
    $nroReserva = $_POST["nroReserva"];
    $cancha = $_POST["cancha"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"]; 
    
    $consulta = "SELECT * FROM `reservas-futbol` WHERE nroReserva='$nroReserva'";
    $resultado = mysqli_query($conexion, $consulta);
    $cantFilas = mysqli_num_rows($resultado);  
    
    if ($cantFilas == 1) {  
        echo "<H3>La reserva $nroReserva ya ha sido registrada</H3>";
    } else {
        $sql = "INSERT INTO `reservas-futbol` (nroReserva, cancha, fecha, hora) VALUES ('$nroReserva','$cancha', '$fecha', '$hora')";
        mysqli_query($conexion, $sql);
        echo "<H3>La reserva $nroReserva se ha registrado</H3>";
        echo "<br><br>";
        mysqli_close($conexion);
    }
    
    echo "<input type='button' class='boton' id='boton' value='Volver' onClick='location=\"../pages/nueva-reservas.html\"'> ";
?>  

