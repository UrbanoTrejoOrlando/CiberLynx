<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/wifi/estilo_wifi.css">

  <title>Nueva Conexión</title>
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
          <h1 class="text-center">Insertar Dispositivo</h1>
        </div>
      </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <form action="agregarDispositivobd.php" method="POST">
          <script>
            function validarNoNumeros(input) {
              var regex = /[\/\.¨"{}()]-/; // Expresión regular para buscar caracteres específicos

              // Verificar si el valor contiene alguno de los caracteres específicos
              if (regex.test(input.value)) {
                  alert("No se pueden ingresar los siguientes caracteres en la descripción: / . ¨ \" { } ( )");
                  input.value = input.value.replace(/[\/\.¨"{}()]/g, ''); // Eliminar caracteres no permitidos
              }
            }
          </script>  
            
            
          <div class="form-group">
            <label for="mac">Dirección MAC:</label>
            <input type="text" class="form-control" name="txtDireccionMac" placeholder="Dirección MAC" required
            oninput="validarNoNumeros(this)">
          </div>
          
            <div class="form-group">
            <label for="dispositivo">Dispositivo</label>
      	    <select class="form-control" name="cmbDispositivo" required>
         	    <option selected>Seleccionar Dispositivo</option>
                <?php
            	  include("conexion/conectar_base.php");
            	  $sql = "CALL proc_mostrar_tipo_dispositivo()";
            	  $dispositivo = mysqli_query($conexion, $sql);
            	  while ($regDispositivo = mysqli_fetch_assoc($dispositivo)) {
            		  echo "<option value='" . $regDispositivo['Id_Tipo_Dispositivo'] . "'>" . $regDispositivo['Nombre_Dispositivo'] . "</option>";
         		    }
            	  mysqli_close($conexion);
                ?>
              </select>   
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

