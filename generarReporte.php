<?php
session_start();
include("conexion/conectar_base.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    // Almacenar fechas en variables de sesión
    $_SESSION['fecha_inicio'] = $fecha_inicio;
    $_SESSION['fecha_fin'] = $fecha_fin;

    // Obtener el monto inicial de la base de datos
    $_SESSION['monto_inicial'] = 100; // Esto debe ser recuperado de la base de datos

    // Llamar al procedimiento almacenado para obtener las ventas por categoría
    $query = "CALL proc_total_vendido_por_categoria('$fecha_inicio', '$fecha_fin')";
    $result = mysqli_query($conexion, $query);

    // Inicializar variables para almacenar las ventas por categoría
    $ventas_ciber = 0;
    $ventas_dulces = 0;
    $ventas_accesorios = 0;
    $ventas_servicios = 0;

    // Iterar sobre los resultados del procedimiento almacenado y asignar las ventas por categoría
    while ($row = mysqli_fetch_assoc($result)) {
        switch ($row['Categoria']) {
            case 'Ciber':
                $ventas_ciber = $row['TotalVendido'];
                break;
            case 'Dulces':
                $ventas_dulces = $row['TotalVendido'];
                break;
            case 'Accesorios':
                $ventas_accesorios = $row['TotalVendido'];
                break;
            case 'Servicios':
                $ventas_servicios = $row['TotalVendido'];
                break;
            case 'Caja':
                $ventas_ciber = $row['TotalVendido'];
                break;
        }
    }

    // Calcular el monto final
    $monto_final = $_SESSION['monto_inicial'] + $ventas_ciber + $ventas_dulces + $ventas_accesorios + $ventas_servicios;

    // Almacenar los resultados en variables de sesión para ser usados en el reporte
    $_SESSION['ventas_ciber'] = $ventas_ciber;
    $_SESSION['ventas_dulces'] = $ventas_dulces;
    $_SESSION['ventas_accesorios'] = $ventas_accesorios;
    $_SESSION['ventas_servicios'] = $ventas_servicios;
    $_SESSION['monto_final'] = $monto_final;

    header("Location: reporte.php");
    exit();
} else {
    header("Location: reporte.php");
    exit();
}
?>
