<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'path/to/your/error.log');

require('TCPDF/tcpdf.php');
include("conexion/conectar_base.php");

if (isset($_SESSION['venta_exitosa']) && !empty($_SESSION['venta_exitosa'])) {
    $venta_info = $_SESSION['venta_exitosa'];
    
    // Obtener valores seguros para evitar errores de htmlspecialchars con valores null
    $clv_cliente = isset($venta_info['clv_cliente']) ? $venta_info['clv_cliente'] : '';
    $forma_pago = isset($venta_info['forma_pago']) ? $venta_info['forma_pago'] : '';
    $total_venta = $venta_info['total_venta'];
    $productos = $venta_info['productos'];
    // Esto es para insertar la fecha 
    $fecha_venta = date('Y-m-d');

    // Leer monto recibido y cambio
    $monto_recibido = isset($venta_info['monto_recibido']) ? $venta_info['monto_recibido'] : 0.00;
    $cambio = isset($venta_info['cambio']) ? $venta_info['cambio'] : 0.00;

    // Consultar el nombre completo del cliente utilizando el procedimiento almacenado
    $nombre_cliente = 'Cliente desconocido';
    if (!empty($clv_cliente)) {
        $stmt = $conexion->prepare("CALL mostrar_cliente(?)");
        $stmt->bind_param("s", $clv_cliente);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $nombre_cliente = $row['Nombre_Completo'];
        }
        $stmt->close();
    }

    // Crear una nueva clase que extienda TCPDF para añadir un pie de página
    class MYPDF extends TCPDF {
        // Pie de página
        public function Footer() {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    // Crear un nuevo PDF usando la clase extendida
    $pdf = new MYPDF();
    $pdf->AddPage();
    
    // Agregar el logotipo
    $pdf->Image('imagenes/lo.png', 10, 10, 20); 
    
    // Establecer la fuente
    $pdf->SetFont('helvetica', 'B', 14);
    
    // Título
    $pdf->Cell(0, 10, 'Detalle de Venta', 0, 1, 'C');
    
    // Información del cliente y la venta
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(0, 10, 'Cliente: ' . htmlspecialchars($nombre_cliente, ENT_QUOTES, 'UTF-8'), 0, 1);
    $pdf->Cell(0, 10, 'Fecha de Venta: ' . $fecha_venta, 0, 1);
    $pdf->Cell(0, 10, 'Forma de Pago: Efectivo');
    
    //salto de linea
    $pdf->Ln();

    // Detalle de productos
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(70, 10, 'Producto', 1);
    $pdf->Cell(30, 10, 'Cantidad', 1);
    $pdf->Cell(30, 10, 'Precio Unitario', 1);
    $pdf->Cell(30, 10, 'Subtotal', 1);
    $pdf->Ln();
    
    $pdf->SetFont('helvetica', '', 12);
    foreach ($productos as $producto_id => $detalle) {
        $cantidad = isset($detalle['cantidad']) ? $detalle['cantidad'] : 1;
        $nombre = isset($detalle['nombre']) ? htmlspecialchars($detalle['nombre'], ENT_QUOTES, 'UTF-8') : 'Producto sin nombre';
        $precio = isset($detalle['precio']) ? $detalle['precio'] : 0.00;

        $pdf->Cell(70, 10, $nombre, 1);
        $pdf->Cell(30, 10, $cantidad, 1);
        $pdf->Cell(30, 10, number_format($precio, 2), 1);
        $pdf->Cell(30, 10, number_format($precio * $cantidad, 2), 1);
        $pdf->Ln();
    }
    
    // Añadir el total de la venta como última fila
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->Cell(130, 10, 'Total de la Venta', 1);
    $pdf->Cell(30, 10, '$' . number_format($total_venta, 2), 1, 0, 'R');
    $pdf->Ln();
    
    // Mostrar el monto recibido y el cambio
    $pdf->Cell(130, 10, 'Monto Recibido', 1);
    $pdf->Cell(30, 10, '$' . number_format($monto_recibido, 2), 1, 0, 'R');
    $pdf->Ln();
    $pdf->Cell(130, 10, 'Cambio', 1);
    $pdf->Cell(30, 10, '$' . number_format($cambio, 2), 1, 0, 'R');
    $pdf->Ln();

    // Salida del PDF
    $pdf->Output('detalle_venta.pdf', 'I');

    // Limpiar la sesión después de generar el PDF
    unset($_SESSION['venta_exitosa']);
} else {
    echo 'No hay detalles de venta disponibles para generar el PDF.';
}

// Cerrar conexión
$conexion->close();
?>
