<?php
session_start();

if (isset($_SESSION['logueado-admin'])) {
    echo "<div style='display: flex; align-items: center; justify-content: center; gap: 10px;'>
            <p style='margin: 0;'>Administrador: <b  style='color:#7f7f7f'>" . $_SESSION['logueado-admin'] . "</b></p>
            <a class='borrar' href='./session/cerrar-sesion.php'>Cerrar Sesión</a>
          </div>";
} else {
    header("Location: ../usuarios/ingresar.php");
}
?>