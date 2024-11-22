<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/icons/v.png">
    <link rel="stylesheet" href="../../css/styles.css">
    <title>VBV-Menú de reservas</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li class="icon"><a href="menú-reservas.php"></a></li>
            </ul>
            <?php
	            include("../administrador/verifica-administrador.php");
            ?>
        </nav>
        <h1>Menú de reservas</h1>
    </header>
    <main>
        
        <section>                 
            <input id='boton' type='button' value='Buscar reservas' onClick="location='./buscar-reservas.php'" class="boton" />
            <input id='boton' type='button' value='Tabla de reservas' onClick='location="./tabla-reservas.php"' class="boton" />
            <input id="boton" type="button" value="Salir" onClick='location="../session/cerrar-sesion.php"' class="boton" />
        </section>
    
    	<!-- Google Charts -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Script para crear el grafico -->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Reparaciones', 'Cantidad'],
          <?php 
			$sql = "SELECT concat('[\"' , a.tipo, '\",' , cast(count(r.idreparacion) as char), '],' ) as fila
					FROM reparaciones as r, autos as a
					WHERE r.idauto = a.idauto 
					GROUP BY a.tipo
					ORDER BY count(r.idreparacion) DESC";
			$resultado = mysqli_query($conexion, $sql);
			while ($r = mysqli_fetch_assoc($resultado)) echo $r['fila'];
			/*
			  ['Comida', 11],
			  ['Bebida', 2],
			  ['Limpieza', 2],
			  ['Panadería', 2],
			  ['Otros', 7],
			*/
		  ?>
		]);

        var options = {
          title: 'Cantidad de reparaciones por tipo de vehículo', 
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('grafico'));
        chart.draw(data, options);
		
		//genero imagen en formato texto base 64
        document.getElementById('imagen').value = chart.getImageURI();
      }
    </script>

	<section>
		<form method="post" id="hacer_pdf" action="graficoPdf.php">
        	<!-- esta variable contendrá la imagen del gráfico -->
			<input type="hidden" size="100" name="imagen" id="imagen" >
        	<!-- div donde se mostrará el gráfico -->
			<div id="grafico" style="width:80%; height: 400px; float:left;"></div>
			<!-- Boton para enviar la imagen del gráfico al pdf-->
			<br></br><br></br><br></br>
			<input type="submit" value="Generar PDF"/>
		</form>
	</section>
</main>

    <footer>
        <p>© 2024 VIBEVAZ. Todos los derechos reservados.</p>
    </footer>
</body>
</html>