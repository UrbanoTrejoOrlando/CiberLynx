<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ACTUALIZAR USUARIO</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .navbar-custom {
      background-color: #343a40;
      width: 100%;
    }
    .navbar-logo {
      max-width: 150px;
      height: auto;
      object-fit: contain;
    }
    .nav-item {
      text-align: center;
    }
    .nav-link {
      white-space: nowrap;
    }
    .content-wrapper {
      margin-top: 100px;
    }
    @media (max-width: 768px) {
      .navbar-logo {
        max-width: 100px;
      }
      .content-wrapper {
        margin-top: 70px;
      }
    }
  </style>
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

  < class="content-wrapper">
    <div>
      <div class="mt-5">
        <div class="col-12">
          <h1 class="text-center">ACTUALIZAR USUARIO</h1>
        </div>
      </div>
    </div>   
    <?php
#conexion con la base de datos
include("conexion/conectar_base.php");
# recibimos comom paramatro el nombre de la persona
$clave_usuario = $_GET['clv_usuario'];

#Consulta 
$sql = "CALL proc_obt_usuario('$clave_usuario')";
$ejecConsulta = mysqli_query($conexion, $sql);

if(mysqli_num_rows($ejecConsulta) > 0) {
    $conPersona = mysqli_fetch_array($ejecConsulta);
?>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="actualizarUsuariobd.php" method="POST">
            <div class="form-group">
            <label for="clave">Clave:</label>
            <input type="text" class="form-control" placeholder="Clave:" name="txtClave" value="<?php echo $conPersona['Clv_Usuario']; ?>" required>
            </div>
            <div class="form-group">
            <label for="usuario">Usuario Nombre:</label>
            <input type="text"  class="form-control" placeholder="Usuario Nombre:" name="txtUsuario" value="<?php echo $conPersona['Usuario_Nombre']; ?>" required>
            </div>
            <div class="form-group">
            <label for="contrasenia">Contraseña:</label>
            <input type="text" class="form-control" placeholder="Contraseña:" name="txtContrasenia" value="<?php echo $conPersona['Contrasenia']; ?>" required>  
            </div>
            <div class="form-group">
              <label for="nombre">Rol:</label>
              <select class="form-control" name="cmbRol" required>
              <option selected>Seleccionar Rol</option>
            <?php
               include("conexion/conectar_base.php");
               $sql = "CALL proc_rol()";
               $rol = mysqli_query($conexion, $sql);
               while ($regRol = mysqli_fetch_assoc($rol)) {
                  echo "<option value='" . $regRol['Id_Rol'] . "'>" . $regRol['Nombre_Rol'] . "</option>";
               }
               mysqli_close($conexion);
             ?>
              </select>
            </div>

            <div class="d-grid gap-4 col-4 mx-auto mt-3">
              <button class="btn btn-primary" type="submit">Actualizar</button>
            </div>
          </form>
          <?php
} else {
   echo "<p>No se encontraron datos para el nombre proporcionado.</p>";
}
?>
        </div>
      </div>
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
