<?php
    include("conexion.php");

    $nroReserva = $_POST ["nroReserva"];
    $sql = "select * from reservas-futbol where nroReserva = '$nroReserva'";
    $resultado = mysqli_query($conexion, $sql);

    if( $row = mysqli_fetch_row($resultado)){
        echo "<h1> Reserva a eliminar </h1>";
        echo "<br><br>";
        echo "<form method='POST' action='eliminar-reservas.php'>";
        echo "<input type='hidden' name='nroReserva' value='".$row[0]."' /> ";
        
    }

?>