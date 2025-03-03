<?php
require_once('TCPDF/tcpdf.php');

// Crear una nueva instancia de TCPDF con orientación horizontal
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

// Crear una instancia para el PDF Vertical
//$pdf = new TCPDF;

// Establecer el título del reporte
$pdf->SetFont('times', 'B', 12);
$pdf->AddPage();

$pdf->Cell(0, 10, 'Reporte de Inventario', 0, 1, 'C');

// Contenido del reporte obtenido de la base de datos
$pdf->SetFont('times', '', 12);

// Incluir archivo de conexión a la base de datos
include("conexion/conectar_base.php");

// Llamar al procedimiento almacenado
$sql = "CALL proc_generar_pdf();";
$resultado = mysqli_query($conexion, $sql);

// Verificar si hay resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    // Cabecera de la tabla
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(40, 10, 'Codigo de Barras', 1);
    $pdf->Cell(40, 10, 'Nombre', 1);
    $pdf->Cell(40, 10, 'Precio', 1);
    $pdf->Cell(40, 10, 'Marca', 1);
    $pdf->Cell(40, 10, 'Categoria', 1);
    $pdf->Cell(40, 10, 'Unidad', 1);
    $pdf->Cell(40, 10, 'Existencia', 1);
    $pdf->Ln(); // Nueva línea

    // Mostrar los datos de la tabla
    while ($mosInventario = mysqli_fetch_array($resultado)) {
        $pdf->Cell(40, 10, $mosInventario["Codigo_Barras"], 1);
        $pdf->Cell(40, 10, $mosInventario["Nombre"], 1);
        $pdf->Cell(40, 10, $mosInventario["Precio"], 1);
        $pdf->Cell(40, 10, $mosInventario["Nombre_Marca"], 1);
        $pdf->Cell(40, 10, $mosInventario["Nombre_Categoria"], 1);
        $pdf->Cell(40, 10, $mosInventario["Nombre_Unidad"], 1);
        $pdf->Cell(40, 10, $mosInventario["Existencia"], 1);
        $pdf->Ln(); // Nueva línea
    }
} else {
    // Mostrar mensaje si no hay resultados
    $pdf->Cell(0, 10, 'No se encontraron resultados.', 0, 1, 'C');
}

// Cerrar conexión a la base de datos
mysqli_close($conexion);

// Output del PDF
$pdf->Output();
?>
