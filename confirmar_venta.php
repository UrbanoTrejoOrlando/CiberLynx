<?php
session_start();

// Verificar si hay productos en la sesión de venta
if (isset($_SESSION['productos_venta']) && !empty($_SESSION['productos_venta'])) {
    // Calcular el total de la venta y generar el detalle de venta
    $total_venta = 0;
    $detalle_venta = array(); // Inicializamos el detalle de venta
    foreach ($_SESSION['productos_venta'] as $producto) {
        $total_venta += $producto['precio'];
        // Verificar si el producto ya está en el detalle de venta
        if (isset($detalle_venta[$producto['producto_id']])) {
            // Si ya está, incrementar la cantidad comprada
            $detalle_venta[$producto['producto_id']]['cantidad']++;
        } else {
            // Si no está, agregarlo al detalle con cantidad 1
            $detalle_venta[$producto['producto_id']] = array(
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1
            );
        }
    }
    // Guardar los detalles de la venta en la sesión
    $_SESSION['detalle_venta'] = $detalle_venta;
} else {
    // Si no hay productos en la venta, redirigir a la página de ventas
    header("Location: ventas.php");
    exit; // Asegura que el script se detenga después de la redirección
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/wifi/estilo_wifi.css">

  <title>Agregar Productos</title>
   <!-- Pequeños logos -->
   <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Iconos -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Plantilla Admin-->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="navbar navbar-custom fixed-top">
    <div class="container-fluid p-0 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <a class="navbar-brand m-0 p-0 d-flex justify-content-center" href="index.html">
          <img src="dist/img/lo.png" class="navbar-logo" alt="Logo">
        </a>
      </div>
      
    <!---- Mostrar Encabezados--->
    <?php
    if (isset($_SESSION['Rol'])) {
      $rol = $_SESSION['Rol'];
      echo '<div class="user-panel d-flex">';
      echo '<div class="info">';
      echo '<a href="cerrar_sesion.php" class="d-block">Cerrar Sesión</a>';
      echo '</div>';
      if ($rol == 1) {
        echo '<div class="image">';
        echo '<img src="dist/img/Orlando.png" class="img-circle elevation-2" alt="User Image">';
        echo '</div>';
        echo '<div class="info">';
        echo '<a href="#" class="d-block">Orlando Urbano Trejo</a>';
        echo '</div>';
      } elseif ($rol == 2) {
        echo '<div class="image">';
        echo '<img src="dist/img/Ernesto.png" class="img-circle elevation-2" alt="User Image">';
        echo '</div>';
        echo '<div class="info">';
        echo '<a href="#" class="d-block">Ernesto Archundia Montiel</a>';
        echo '</div>';
      }
      echo '</div>'; // Cierre de user-panel
    }
    ?>
  </div>
</nav>

  <!-- Titulo Para la nueva conexion -->
  <br>
  <class="content-wrapper">
    <div>
      <div class="mt-5">
        <div class="col-12">
          <h1 class="text-center">Detalle Venta</h1>
        </div>
      </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <form action="realizarVenta.php" method="POST">
          <div class="justify-content-end">
            <a href="agregarCliente.php" class="btn btn-primary">Cliente</a>
          </div><br>

          <select class="form-control custom-select" name="cmb_Cliente" required>
            <option selected>Seleccionar Cliente</option>
            <?php
                include("conexion/conectar_base.php");
                $sql = "CALL proc_mostrar_clientes()";
                $persona = mysqli_query($conexion, $sql);
                while ($regPersonas = mysqli_fetch_assoc($persona)) {
                    echo "<option value='" . $regPersonas['Clv_Cliente'] . "'>" . $regPersonas['Nombre'] . "</option>";
                }
                mysqli_close($conexion);
              ?>
          </select>
            <br>
            <!-- Totla de la venta
            <label for="total" class="custom-label">Total de la venta: <?php echo number_format($total_venta, 2); ?></label>
              -->
           
            <br><br>
            <h2>Detalle de Venta</h2>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalle_venta as $producto_id => $detalle): ?>
                        <tr>
                            <td><?php echo $detalle['nombre']; ?></td>
                            <td><?php echo $detalle['cantidad']; ?></td>
                            <td><?php echo number_format($detalle['precio'], 2); ?></td>
                            <td><?php echo number_format($detalle['precio'] * $detalle['cantidad'], 2); ?></td>
                            <td><a href="eliminar_producto_venta.php?producto_id=<?php echo $producto_id; ?>">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            
            <script>
    function validarNoNegativos(input) {
        var valor = parseFloat(input.value); // Obtener el valor como número flotante
        var total = parseFloat('<?php echo $total_venta; ?>'); // Obtener el total de la venta desde PHP

        if (valor < total) {
            alert("El monto recibido no puede ser menor que el total de la venta.");
            input.value = total.toFixed(2); // Establecer el valor del input como el total de la venta
        }
    }
</script>

<label for="monto_recibido">Monto Recibido:</label>
<input type="number" step="0.01" min="0" name="monto_recibido" id="monto_recibido" required
       oninput="validarNoNegativos(this)">


            <button type="submit">Realizar Venta</button>


          </form>
          <script src="js/ventas/agregar.js"></script>

          <div class="justify-content-end">
            <a href="ventas.php" class="btn btn-primary">Regresar</a>
          </div>
        </div>
      </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

</body>
</html>

