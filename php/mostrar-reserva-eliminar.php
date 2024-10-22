<?php
    include("conexion.php");

    $NombreYApellido = $_POST ["NombreYApellido"];
    $sql = "select * from reservas-futbol-nou-camp where NombreYApellido = '$NombreYApellido'";
    $resultado = mysqli_query($conexion, $sql);

    if( $row = mysqli_fetch_row($resultado)){
        echo "<h1> Reserva a eliminar </h1>";
        echo "<br><br>";
        echo "<form method='POST' action='eliminar-reservas.php'>";
        echo "<input type='hidden' name='NombreYApellido' value='".$row[0]."' /> ";
        
    }

?>