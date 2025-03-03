<?php
session_start();

// Verificar si se ha presionado el botón de limpiar
if (isset($_POST['limpiar_venta'])) {
    // Eliminar la sesión que contiene los productos de la venta
    unset($_SESSION['productos_venta']);
}

// Variable para almacenar el total de la venta
$total_venta = 0;

// Verificar si se han recibido los parámetros del producto
if (isset($_GET["producto_id"]) && isset($_GET["nombre"]) && isset($_GET["descripcion"]) && isset($_GET["precio"])) {
    // Crear un arreglo asociativo con los detalles del producto
    $producto = array(
        'producto_id' => $_GET["producto_id"],
        'nombre' => $_GET["nombre"],
        'descripcion' => $_GET["descripcion"],
        'precio' => $_GET["precio"]
    );

    // Verificar si la sesión de productos existe
    if (!isset($_SESSION['productos_venta'])) {
        // Si no existe, inicializarla como un arreglo vacío
        $_SESSION['productos_venta'] = array();
    }

    // Agregar el producto al arreglo de productos en la sesión
    $_SESSION['productos_venta'][] = $producto;
}

// Calcular el total de la venta sumando los precios de los productos
if (isset($_SESSION['productos_venta'])) {
    foreach ($_SESSION['productos_venta'] as $producto) {
        $total_venta += $producto['precio'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/clientes/estilos_clientes.css">
  <title>Ventas</title>
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
<!-- Navegacion de permisos-->
<nav class="navbar navbar-custom fixed-top">
  <div class="container-fluid p-0 d-flex align-items-center justify-content-between">
    <!-- Logotipo CiberLynx-->
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

<!---- Permisos de usuarios ---->
<?php
if (isset($_SESSION['Rol'])) {
    // obtenemos valor del rol
    $rol = $_SESSION['Rol'];
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="top: 50px; width: 100%;">';
    echo '<div class="container">';
    echo '<div class="collapse navbar-collapse justify-content-center">';
    echo '<ul class="navbar-nav">';
    
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="cliente.php"><i class="fas fa-users"></i>Clientes</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="inventario.php"><i class="fas fa-clipboard-list"></i>Inventario</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="ventas.php"><i class="fas fa-dollar-sign text-align:center"></i> Ventas</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="wifi.php"><i class="fas fa-wifi"></i> Wifi</a>';
    echo '</li>';
    if ($rol == 1){
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="usuario.php"><i class="fa fa-user-check"></i> Usuarios</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="reporte.php"><i class="fas fa-chart-pie"></i> Reporte</a>';
      echo '</li>';
      echo '<li class="nav-item">';
      echo '<a class="nav-link" href="proveedores.php"><i class="fas fa-chart-pie"></i>Proveedores</a>';
      echo '</li>';
    }
    
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
}
?>

  <!--Titulo Wifi-->
  <div class="content">
    <!-- Content Header (Page header) -->
        <div class="mt-5">
          <div class="col-12">
            <br>
            <h1 class="col -6 text-center">Ventas</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-auto">
                <a href="agregarProductos.php" class="btn btn-primary " role="button">Agregar</a>
            </div>
            <div class="col-auto">
                <a href="confirmar_venta.php" class="btn btn-primary " role="button">Confirmar</a>
            </div>
            <div class="col-auto">
                <form method="POST" action="ventas.php">
                    <button type="submit" name="limpiar_venta" class="btn btn-primary">Limpiar</button>
                </form>
            </div>
        </div>
      </div>
      <br>
    <section class="content">
    
        <!-- Tabla de ventas -->
        <table id="tablaRegistroVenta">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar los productos en la tabla si la sesión existe y no está vacía
                if (isset($_SESSION['productos_venta']) && !empty($_SESSION['productos_venta'])) {
                    foreach ($_SESSION['productos_venta'] as $producto) {
                        echo "<tr>";
                        echo "<td>" . $producto['nombre'] . "</td>";
                        echo "<td>" . $producto['descripcion'] . "</td>";
                        echo "<td>" . $producto['precio'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Si no hay productos en la venta, mostrar un mensaje indicando que está vacía
                    echo "<tr><td colspan='3'>No hay productos en la venta.</td></tr>";
                }
                ?>
            </tbody>
        </table>
         <!-- Mostrar el total de la venta -->
         <div>Total de la venta: <?php echo $total_venta; ?></div>

    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
</body>
</html>
