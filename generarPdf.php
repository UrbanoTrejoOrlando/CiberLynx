<?php
session_start();
require_once('TCPDF/tcpdf.php');

// Inicializar variables de sesión si no están definidas
$monto_inicial = isset($_SESSION['monto_inicial']) ? $_SESSION['monto_inicial'] : 0;
$ventas_ciber = isset($_SESSION['ventas_ciber']) ? $_SESSION['ventas_ciber'] : 0;
$ventas_dulces = isset($_SESSION['ventas_dulces']) ? $_SESSION['ventas_dulces'] : 0;
$ventas_accesorios = isset($_SESSION['ventas_accesorios']) ? $_SESSION['ventas_accesorios'] : 0;
$ventas_servicios = isset($_SESSION['ventas_servicios']) ? $_SESSION['ventas_servicios'] : 0;

$monto_final = $ventas_ciber + $ventas_dulces + $ventas_accesorios + $ventas_servicios;

// Crear una nueva instancia de TCPDF
$pdf = new TCPDF();

// Configurar el documento PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Reporte de Ventas');
$pdf->SetSubject('Reporte de Ventas');
$pdf->SetKeywords('TCPDF, PDF, reporte, ventas');

// Establecer las cabeceras y pies de página
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer las márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// Establecer auto-página salto
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Establecer la fuente
$pdf->SetFont('helvetica', '', 12);

// Añadir una página
$pdf->AddPage();

// Contenido HTML del PDF
$html = '
<h1>Reporte de Ventas</h1>
<p>Fecha de Inicio: ' . $_SESSION['fecha_inicio'] . '</p>
<p>Fecha de Fin: ' . $_SESSION['fecha_fin'] . '</p>
<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>Módulo</th>
            <th>Monto Inicial</th>
            <th>Ventas</th>
            <th>Monto Final</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Ciber</td>
            <td>' . number_format($monto_inicial, 2) . '</td>
            <td>' . number_format($ventas_ciber, 2) . '</td>
            <td>' . number_format($monto_inicial + $ventas_ciber, 2) . '</td>
        </tr>
        <tr>
            <td>Dulces</td>
            <td>' . number_format($monto_inicial, 2) . '</td>
            <td>' . number_format($ventas_dulces, 2) . '</td>
            <td>' . number_format($monto_inicial + $ventas_dulces, 2) . '</td>
        </tr>
        <tr>
            <td>Accesorios</td>
            <td>' . number_format($monto_inicial, 2) . '</td>
            <td>' . number_format($ventas_accesorios, 2) . '</td>
            <td>' . number_format($monto_inicial + $ventas_accesorios, 2) . '</td>
        </tr>
        <tr>
            <td>Servicios</td>
            <td>' . number_format($monto_inicial, 2) . '</td>
            <td>' . number_format($ventas_servicios, 2) . '</td>
            <td>' . number_format($monto_inicial + $ventas_servicios, 2) . '</td>
        </tr>
        <tr>
            <td>Total</td>
            <td></td>
            <td>' . number_format($monto_final, 2) . '</td>
            <td>' . number_format($monto_final, 2) . '</td>
        </tr>
    </tbody>
</table>';

// Escribir el contenido HTML
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF como descarga
$pdf->Output('reporte_ventas.pdf', 'D');
?>
