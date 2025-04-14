<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/wifi/estilo_wifi.css">

  <title>Nueva Conexion</title>
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
          <h1 class="text-center">Nueva Conexión</h1>
        </div>
      </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <form action="agregarConexionbd.php" method="POST">
            
            <div class="form-group">
            <label for="dispositivo">Direccion Mac</label>
      	    <select class="form-control" name="cmbDireccion" required>
         	    <option selected>Seleccionar Direccion</option>
                <?php
            	  include("conexion/conectar_base.php");
            	  $sql = "CALL proc_direccion_mac()";
            	  $dispositivo = mysqli_query($conexion, $sql);
            	  while ($regDispositivo = mysqli_fetch_assoc($dispositivo)) {
            		  echo "<option value='" . $regDispositivo['Clv_Dispositivo'] . "'>" . $regDispositivo['Direccion_Mac'] . "</option>";
         		    }
            	  mysqli_close($conexion);
                ?>
              </select>   
            </div>
    
            <div class="form-group">
            <label for="dispositivo">Conexion:</label>
      	    <select class="form-control" name="cmbDispositivo" required>
         	    <option selected>Seleccionar Conexion</option>
                <?php
            	  include("conexion/conectar_base.php");
            	  $sql = "CALL proc_codigo_barras()";
            	  $dispositivo = mysqli_query($conexion, $sql);
            	  while ($regDispositivo = mysqli_fetch_assoc($dispositivo)) {
            		  echo "<option value='" . $regDispositivo['Codigo_Barras'] . "'>" . $regDispositivo['Nombre'] . "</option>";
         		    }
            	  mysqli_close($conexion);
                ?>
              </select>   
            </div>

            <div class="form-group">
            <label for="dispositivo">Cliente:</label>
      	    <select class="form-control" name="cmbCliente" required>
         	    <option selected>Seleccionar Cliente</option>
                <?php
            	  include("conexion/conectar_base.php");
            	  $sql = "CALL proc_mostrar_clientes()";
            	  $dispositivo = mysqli_query($conexion, $sql);
            	  while ($regDispositivo = mysqli_fetch_assoc($dispositivo)) {
            		  echo "<option value='" . $regDispositivo['Clv_Cliente'] . "'>" . $regDispositivo['Nombre'] . "</option>";
         		    }
            	  mysqli_close($conexion);
                ?>
              </select>   
            </div>

            <div class="form-group">
              <label for="mac">Fecha Final:</label>
              <input type="date" class="form-control" name="txtFechaFinal" required>
            </div>
          
            <div class="d-grid gap-4 col-4 mx-auto">
              <button class="btn btn-primary" type="submit">Confirmar</button>
              <button id="btn_cancelar" class="btn btn-primary" type="submit">Cancelar</button>
            </div>
            
            <script>
                document.getElementById('btn_cancelar').addEventListener('click', function() {
                    window.location.href = 'wifi.php';
                });
            </script>
          </form>
        </div>
      </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

</body>
</html>
