<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/clientes/estilos_clientes.css">
  <title>Wifi</title>
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
            <h1 class="col -6 text-center">Wifi</h1>
            <br>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <table id="tablaInventario">
            <thead>
                <tr>
                    <th>Clave Conexion</th>
                    <th>Direccion MAC</th>
                    <th>Estatus</th>
                    <th>Tiempo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Finalizar</th>

                </tr>
            </thead>
				<tbody>
				<?php
          #conectar con el servidor de BD
          include("conexion/conectar_base.php");
          #preparar la consulta
          $sql = "CALL proc_mostrar_conexiones()";
          #ejecutar consulta
          $ejecConsulta = mysqli_query($conexion, $sql);
          #obtener los datos de la consulta
          while ($regWifi = mysqli_fetch_array($ejecConsulta)) {
            echo "<tr>";
            echo "<th scope='row'>" . $regWifi[0] . "</th>";
            echo "<td>" . $regWifi[1] . "</td>";
            echo "<td>" . $regWifi[2] . "</td>";
            echo "<td>" . $regWifi[3] . "</td>";
            echo "<td>" . $regWifi[4] . "</td>";
            echo "<td>" . $regWifi[5] . "</td>";
            echo "<td> <a href='desactivarConexion.php?clv_conexion=" . $regWifi[0] . "'><i class='fas fa-edit'></i></a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
		</table>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-auto">
            <a href="Conexion.php" class="btn btn-primary btn-lg" role="button">Nueva Conexion</a>
          </div>
          <div class="col-auto">
            <a href="agregar.php" class="btn btn-primary btn-lg" role="button">Agregar Dispositivo</a>
          </div>
        </div>
      </div>
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