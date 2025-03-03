<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conexion/conectar_base.php");

// Verificar la longitud del valor de Clv_Cliente
$clv_cliente = $_POST['cmb_Cliente'];
echo "Valor de Clv_Cliente: '$clv_cliente' (Longitud: " . strlen($clv_cliente) . ")<br>";

if (!isset($_SESSION['Folio_Sesion'])) {
    echo "Error: Sesión no iniciada correctamente.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['productos_venta']) && !empty($_SESSION['productos_venta'])) {
        $cliente_id = $_POST['cmb_Cliente'];
        $monto_recibido = floatval($_POST['monto_recibido']);
        $total_venta = 0;

        foreach ($_SESSION['productos_venta'] as $producto) {
            $total_venta += $producto['precio'];
        }

        $cambio = $monto_recibido - $total_venta;
        $folio_sesion = $_SESSION['Folio_Sesion'];
        $folio_venta = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

        // Iniciar la transacción
        mysqli_begin_transaction($conexion);

        try {
            // Insertar en la tabla Venta
            $query_venta = "INSERT INTO Venta (Folio_Venta, Folio_Sesion, Clv_Cliente, Total) VALUES (?, ?, ?, ?)";
            $stmt_venta = mysqli_prepare($conexion, $query_venta);
            mysqli_stmt_bind_param($stmt_venta, 'sssd', $folio_venta, $folio_sesion, $clv_cliente, $total_venta);
            if (!mysqli_stmt_execute($stmt_venta)) {
                throw new Exception('Error al insertar en Venta: ' . mysqli_stmt_error($stmt_venta));
            }

            // Insertar en la tabla Detalle_Venta y actualizar el inventario
            foreach ($_SESSION['productos_venta'] as $producto) {
                $query_detalle = "INSERT INTO Detalle_Venta (Codigo_Barras, Folio_Venta, Cantidad) VALUES (?, ?, ?)";
                $stmt_detalle = mysqli_prepare($conexion, $query_detalle);
                $cantidad = 1; // Ajusta esto según tu lógica
                mysqli_stmt_bind_param($stmt_detalle, 'ssi', $producto['producto_id'], $folio_venta, $cantidad);
                if (!mysqli_stmt_execute($stmt_detalle)) {
                    throw new Exception('Error al insertar en Detalle_Venta: ' . mysqli_stmt_error($stmt_detalle));
                }

                // Actualizar el inventario
                $query_actualizar_inventario = "UPDATE Producto SET Existencia = Existencia - ? WHERE Codigo_Barras = ?";
                $stmt_actualizar_inventario = mysqli_prepare($conexion, $query_actualizar_inventario);
                mysqli_stmt_bind_param($stmt_actualizar_inventario, 'is', $cantidad, $producto['producto_id']);
                if (!mysqli_stmt_execute($stmt_actualizar_inventario)) {
                    throw new Exception('Error al actualizar el inventario: ' . mysqli_stmt_error($stmt_actualizar_inventario));
                }
            }

            // Confirmar la transacción
            mysqli_commit($conexion);

            $venta_info = array(
                'clv_cliente' => $clv_cliente,
                'monto_recibido' => $monto_recibido,
                'cambio' => $cambio,
                'total_venta' => $total_venta,
                'productos' => $_SESSION['productos_venta']
            );
            $_SESSION['venta_exitosa'] = $venta_info;

            unset($_SESSION['productos_venta']); // Limpiar la sesión de productos

            // Redirigir a una página de éxito
            header("Location: ventas_exito.php");
            exit;

        } catch (Exception $e) {
            // Revertir la transacción
            mysqli_rollback($conexion);

            // Registrar el error
            error_log($e->getMessage());

            // Mostrar un mensaje de error
            echo "Error al realizar la venta: " . $e->getMessage();
        }
    } else {
        header("Location: ventas.php");
        exit;
    }
} else {
    header("Location: ventas.php");
    exit;
}

mysqli_close($conexion);
?>
