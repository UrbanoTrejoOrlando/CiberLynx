<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CAJA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .navbar-custom {
      background-color: #343a40;
      width: 100%;
    }
    .navbar-logo {
      max-width: 150px; /* Ajusta este valor según tus necesidades */
      height: auto;
      object-fit: contain;
    }
    .nav-item {
      text-align: center;
    }
    .nav-link {
      white-space: nowrap;
    }
    table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

table, th, td {
  border: 1px solid #ddd;
}

th, td {
  padding: 10px;
  text-align: left;
}

  </style>
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
    
    <!-- Sidebar User Panel -->
    <div class="user-panel d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Administrador</a>
      </div>
    </div>
  </div>
</nav>
  <!-- Navigation Items -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="top: 50px; width: 100%;">
    <div class="col-12 ">
      <ul class="navbar-nav  ">
        <li class="nav-item col-2">
          <a class="nav-link" href="persona.php"><i class="fas fa-user"></i> Personas</a>
        </li>
        <li class="nav-item col-1">
          <a class="nav-link" href="#"><i class="fas fa-users"></i> Clientes</a>
        </li>
        <li class="nav-item col-2">
          <a class="nav-link" href="inventario.php"><i class="fas fa-clipboard-list"></i> Inventario</a>
        </li>
        <li class="nav-item col-1">
          <a class="nav-link" href="nuevaConexion.php"><i class="fas fa-dollar-sign text-align:center"></i> Ventas</a>
        </li>
        <li class="nav-item col-2">
          <a class="nav-link active" href="caja.php"><i class="fas fa-coins text-align:center"></i> Caja</a>
        </li>
        <li class="nav-item col-1">
          <a class="nav-link" href="wifi.php"><i class="fas fa-wifi"></i> Wifi</a>
        </li>
        <li class="nav-item col-2">
          <a class="nav-link" href="usuario.php"><i class="fa fa-user-check"></i> Usuarios</a>
        </li>
        <li class="nav-item col-1">
          <a class="nav-link" href="reporte.php"><i class="fas fa-chart-pie"></i> Reporte</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
        <div class="mt-5">
          <div class="col-12">
            <h1 class="col -6 text-center">CAJA</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <table id="tablaInventario">
            <thead>
               <tr>
                  <th></th>
                  <th>Cajas</th>
                  <th>Dulces</th>
                  <th>Accesorios</th>
                  <th>Servicios</th>
               </tr>
               </thead>
            <tbody id="miTabla">
               <tr>
                  <td>Monto Inicial</td>
                  <td>100.00</td>
                  <td>100.00</td>
                  <td>100.00</td>
                  <td>100.00</td>
               </tr>
               <tr>
                  <td>Ventas</td>
                  <td>200.00</td>
                  <td>200.00</td>
                  <td>200.00</td>
                  <td>200.00</td>
               </tr>
               <tr>
                  <td>Entradas</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
               </tr>
               <tr>
                  <td>Salidas</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
                  <td>0.00</td>
               </tr>
               <tr>
                  <td>Totales del dia</td>
                  <td>100.00</td>
                  <td>100.00</td>
                  <td>100.00</td>
                  <td>100.00</td>
               </tr>
            </tbody>
            </table>
			
            <div class="container">
    <div class="row justify-content-center">
      <div class="col-auto">
        <a href="agregarConexion.php" class="btn btn-primary btn-lg" role="button">Registrar</a>
        <a href="insertaDispositivo.php" class="btn btn-secondary btn-lg" role="button">Detalles</a>
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
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>