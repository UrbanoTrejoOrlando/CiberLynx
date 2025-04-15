<?php
require('TCPDF/tcpdf.php');
include("conexion/conectar_base.php");

session_start();

if (isset($_SESSION['fecha_inicio']) && isset($_SESSION['fecha_fin'])) {
    $fecha_inicio = $_SESSION['fecha_inicio'];
    $fecha_fin = $_SESSION['fecha_fin'];

    // Llamar al procedimiento almacenado para obtener los detalles de los productos vendidos
    $query = "CALL proc_detalles_productos('$fecha_inicio', '$fecha_fin')";
    $result = mysqli_query($conexion, $query);
    
    // Verificar si la consulta fue exitosa
    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    // Crear el PDF
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(0, 10, 'Detalles de Productos Vendidos', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Fecha: ' . $fecha_inicio . ' a ' . $fecha_fin, 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(40, 10, 'Nombre', 1);
    $pdf->Cell(40, 10, 'Codigo de Barras', 1);
    $pdf->Cell(40, 10, 'Cantidad Vendida', 1);
    $pdf->Cell(30, 10, 'Precio', 1);
    $pdf->Cell(40, 10, 'Categoria', 1);
    $pdf->Ln();

    $pdf->SetFont('helvetica', '', 10);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(40, 10, $row['Nombre'], 1);
        $pdf->Cell(40, 10, $row['Codigo_Barras'], 1);
        $pdf->Cell(40, 10, $row['Cantidad'], 1);
        $pdf->Cell(30, 10, $row['Precio'], 1);
        $pdf->Cell(40, 10, $row['Nombre_Categoria'], 1);
        $pdf->Ln();
    }

    mysqli_free_result($result);
    mysqli_close($conexion);

    $pdf->Output('detalles_productos_vendidos.pdf', 'D'); // Cambiado el orden de los parámetros
} else {
    die('Fechas no establecidas en la sesión.');
}
?>
