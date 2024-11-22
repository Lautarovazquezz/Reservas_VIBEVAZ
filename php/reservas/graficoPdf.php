<?php
require('../../fpdf/fpdf.php');

// Asegúrate de manejar errores en caso de que no se envíe la imagen
if (!isset($_POST['imagen'])) {
    die('No se recibió la imagen del gráfico.');
}

// Configurar la zona horaria
date_default_timezone_set("America/Argentina/Buenos_Aires");

// Crear el PDF
$pdf = new FPDF();
$pdf->AddPage('L'); // Página en formato horizontal

// Título del reporte
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(0, 30, utf8_decode('Reporte Gráfico del Sistema de Reservas'), 0, 1, 'C', 0);

// Recuperar el URI de la imagen del campo hidden
$grafico = $_POST['imagen'];

// Procesar la imagen base64
if (strpos($grafico, 'base64,') !== false) {
    $img = explode(',', $grafico, 2)[1]; // Obtener solo la parte del base64
    $pic = 'data://image/png;base64,' . $img; // Crear un flujo de datos
    $pdf->Image($pic, 15, 40, 225, 0, 'PNG'); // Agregar la imagen al PDF
} else {
    die('El formato de la imagen no es válido.');
}

// Salida del PDF
$pdf->Output();
?>
