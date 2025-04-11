<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/clientes/estilos_clientes.css">
  <title>Agregar Dispositivo</title>
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

  <!-- Titulo Agregar Conexion-->
  <br>
  <class="content-wrapper">
    <div>
      <div class="mt-5">
        <div class="col-12">
          <h1 class="text-center">Agregar Dispositivo</h1>
        </div>
      </div>
    </div>   
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="agregar_conexionbd.php" method="POST">
        <div class="form-group">
            <label for="dispositivo">Direccion Mac:</label>
            <select class="form-control" name="cmbDireccion" required>
            <option selected>Seleccionar Direccion</option>
            <?php
               include("conexion/conectar_base.php");
               $sql = "CALL proc_mostrar_direccion()";
               $dispositivo = mysqli_query($conexion, $sql);
               while ($regDispositivo = mysqli_fetch_assoc($dispositivo)) {
                  echo "<option value='" . $regDispositivo['Clv_Dispositivo'] . "'>" . $regDispositivo['Direccion_Mac'] . "</option>";
               }
               mysqli_close($conexion);
             ?>
          </select>
        </div>
        <div class="form-group">
          <label for="fecha">Fecha Final:</label>
          <input type="date" class="form-control" placeholder="Fecha" name="txtFechaF" required>
        </div>
        <div class="form-group">
              <label for="venta">Venta</label>
                <select class="form-control" name="cmbVenta" required>
                    <option selected>Seleccionar Venta</option>
                      <?php
                        include("conexion/conectar_base.php");
                        $sql = "CALL proc_clientes()";
                        $cliente = mysqli_query($conexion, $sql);
                        while ($regCliente = mysqli_fetch_assoc($cliente)) {
                        echo "<option value='" . $regCliente['Folio_Venta'] . "'>" . $regCliente['Folio_Venta'] . "</option>";
                        }
                        mysqli_close($conexion);
                      ?>
              </select>
        </div>
        <div class="form-group">
        <label for="conexion">Conexion</label>
        <select class="form-control" name="cmbConexion" required>
            <option selected>Seleccionar Conexion</option>
            <?php
               include("conexion/conectar_base.php");
               $sql = "CALL proc_conexiones()";
               $tipoconexion = mysqli_query($conexion, $sql);
               while ($regCon = mysqli_fetch_assoc($tipoconexion)) {
                  echo "<option value='" . $regCon['Codigo_Barras'] . "'>" . $regCon['Nombre'] . "</option>";
               }
               mysqli_close($conexion);
             ?>
         </select>
        </div>
        <div class="d-grid gap-4 col-4 mx-auto mt-3">
              <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </form>
      </di>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="plugins/sparklines/sparkline.js"></script>
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
