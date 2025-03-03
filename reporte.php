<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte de Ventas</title>
  <link rel="stylesheet" href="css/personas/estilos_personas.css">
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

<!-- Navbar -->
<nav class="navbar navbar-custom fixed-top">
  <div class="container-fluid p-0 d-flex align-items-center justify-content-between">
    <!-- Logo and Search -->
    <div class="d-flex align-items-center">
      <a class="navbar-brand m-0 p-0 d-flex justify-content-center" href="index.html">
        <img src="dist/img/lo.png" class="navbar-logo" alt="Logo">
      </a> 
    </div>
    <!-- Mostrar Usuarios-->
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
    }
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="proveedores.php"><i class="fas fa-chart-pie"></i>Proveedores</a>';
    echo '</li>';
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
}
?>

<!-- Titulo de Reporte -->
<div class="content">
    <div class="mt-5">
        <div class="col-12">
            <br>
            <h1 class="col -6 text-center">Reporte de Ventas</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
        <form id="formRegistro" class="formulario" action="generarReporte.php" method="POST">
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
            </div>
            <div class="d-grid gap-4 col-4 mx-auto mt-3">
                <button class="btn btn-primary" type="submit">Generar Reporte</button>
            </div>
        </form>
    </div>
</div>

<?php if (isset($_SESSION['ventas_ciber'])) : ?>
<div class="content mt-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <table class="table table-bordered">
                <thead class="thead-dark">
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
                        <td><?php echo number_format($_SESSION['monto_inicial'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['ventas_ciber'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['monto_inicial'] + $_SESSION['ventas_ciber'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Dulces</td>
                        <td><?php echo number_format($_SESSION['monto_inicial'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['ventas_dulces'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['monto_inicial'] + $_SESSION['ventas_dulces'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Accesorios</td>
                        <td><?php echo number_format($_SESSION['monto_inicial'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['ventas_accesorios'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['monto_inicial'] + $_SESSION['ventas_accesorios'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Servicios</td>
                        <td><?php echo number_format($_SESSION['monto_inicial'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['ventas_servicios'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['monto_inicial'] + $_SESSION['ventas_servicios'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td><?php echo number_format($_SESSION['ventas_ciber'] + $_SESSION['ventas_dulces'] + $_SESSION['ventas_accesorios'] + $_SESSION['ventas_servicios'], 2); ?></td>
                        <td><?php echo number_format($_SESSION['monto_final'], 2); ?></td>
                    </tr>
                </tbody>
            </table>
            <a href="generarPdf.php" class="btn btn-primary">Generar PDF</a>
            <a href="detalles_productos.php" class="btn btn-secondary">Productos Detalles</a>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
</body>
</html>
