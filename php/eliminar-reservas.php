<?php
    include("conexion.php");
    $nroReserva = $_POST ["nroReserva"];
    $sql = "DELETE FROM reservas-futbol WHERE nroReserva=$nroReserva";
    if (mysqli_query($conexion, $sql)){
        if(mysqli_affected_rows($conexion) > 0) {
            echo "<br></br><br></br> <h3>Se elimino la reserva</h3>";
        } else{ echo "<br></br><br></br> <h3>No se elimino la reserva</h3>"; } 
    } else {echo "<br></br><br></br> <h3>error</h3>"; }
    mysqli_close($conexion)
?>