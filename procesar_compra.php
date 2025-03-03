<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
include("conexion/conectar_base.php");

function generarFolioCompra($length = 5) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $folioCompra = '';
    for ($i = 0; $i < $length; $i++) {
        $folioCompra .= $characters[rand(0, $charactersLength - 1)];
    }
    return $folioCompra;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folioSesion = $_SESSION['Folio_Sesion']; // Obtener el folio de sesión de la variable de sesión
    $folioProveedor = $_POST['cmbProveedor'];
    $codigoBarras = $_POST['cmbProducto'];
    $cantidad = $_POST['txtCantidad'];
    $precioCompra = $_POST['txtPrecioCompra'];
    $precioVenta = $_POST['txtPrecioVenta'];
    $tipoPago = $_POST['tipoPago'];
    $total = $cantidad * $precioCompra; // Calcular el total de la compra

    // Generar folio de compra único de 5 caracteres
    $folioCompra = generarFolioCompra(5);

    // Insertar en la tabla Compra
    $sqlCompra = "INSERT INTO Compra (Folio_Compra, Folio_Sesion, Folio_Proveedor, Total) VALUES ('$folioCompra', '$folioSesion', '$folioProveedor', '$total')";
    if (mysqli_query($conexion, $sqlCompra)) {
        // Insertar en la tabla Detalle_Compra
        $sqlDetalleCompra = "INSERT INTO Detalle_Compra (Codigo_Barras, Folio_Compra, Cantidad, Precio, Precio_Venta) VALUES ('$codigoBarras', '$folioCompra', '$cantidad', '$precioCompra', '$precioVenta')";
        if (mysqli_query($conexion, $sqlDetalleCompra)) {
            // Actualizar el precio de venta del producto y el stock
            $sqlActualizarProducto = "UPDATE Producto SET Precio = '$precioVenta', Existencia = Existencia + $cantidad WHERE Codigo_Barras = '$codigoBarras'";
            if (mysqli_query($conexion, $sqlActualizarProducto)) {
                // Insertar en la tabla Pago_Compra
                $sqlPagoCompra = "INSERT INTO Pago_Compra (Folio_Compra, Cantidad, Tipo_Pago) VALUES ('$folioCompra', '$total', '$tipoPago')";
                if (mysqli_query($conexion, $sqlPagoCompra)) {
                    // Redirigir o mostrar mensaje de éxito
                    header("location:inventario.php");
                } else {
                    echo "Error al insertar en Pago_Compra: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al actualizar el precio del producto y el stock: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al insertar en Detalle_Compra: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al insertar en Compra: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    echo "Método de solicitud no permitido.";
}
?>
