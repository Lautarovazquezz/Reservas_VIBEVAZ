<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/icons/v.png">
    <link rel="stylesheet" href="../css/styles.css">
    <title>VBV-Buscar reservas</title>
</head>
<body class="sectionForm">
    <form action="buscar-reservas.php" method="GET"></form>
    <h2>Reservas disponibles</h2>
    <label for="cancha">Selecciona la cancha:</label>
    <select class="input" name="cancha" id="cancha" required>
        <option value="5">Cancha Futbol 5</option>
        <option value="7">Cancha futbol 7</option>
        <option value="8">Cancha futbol 8</option>
    </select>
    
    <label for="horario">Selecciona el horario:</label>
    <select class="input" name="horario" id="horario" required>
        <option value="" selected disabled></option>
        <?php
        if(isset($GET['mod'])){
            echo "<option value='".$cambiar['tipo']."' seleccionar opcion";
        }
        ?>
        <option value="08:00">08:00</option>
        <option value="10:00">10:00</option>
        <option value="12:00">12:00</option>
        <option value="14:00">14:00</option>
        <option value="16:00">16:00</option>
        <option value="18:00">18:00</option>
        <option value="20:00">20:00</option>
    </select>
    
    <br><br>
    <input type="submit" value="Buscar" class="boton" name="enviar">
    <input type="button" value="Volver" class="boton" onClick='location="../pages/menú-reservas.html"'>
</form>
</body>
</html>


