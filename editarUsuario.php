<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/clientes/cliente.css">
    
    <title>Actualizar Usuario</title>
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

  <class="content-wrapper">
    <div>
      <div class="mt-5">
        <div class="col-12">
          <br>
          <h1 class="text-center">Actualizar Usuario</h1>
        </div>
      </div>
    </div>   
    <?php
          #conexion con la base de datos
          include("conexion/conectar_base.php");
          # recibimos comom paramatro el nombre de la persona
          $clave_usuario = $_GET['claveUsuario'];

          #Consulta 
          $sql = "CALL proc_consultar_usuario('$clave_usuario');";
          $ejecConsulta = mysqli_query($conexion, $sql);
          if(mysqli_num_rows($ejecConsulta) > 0) {
            $conUsuario = mysqli_fetch_array($ejecConsulta);
            ?> 
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="actualizarUsuariobd.php" method="POST">

        <script>
          function validarNoNumeros(input) {
            var regex = /^[a-zA-Z\s]*$/; // Expresión regular para permitir solo letras y espacios
            if (!regex.test(input.value)) {
              alert("No se pueden ingresar números ni caracteres especiales en la descripción.");
              input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); 
            }
          }
        </script>

        <input type="hidden"  class="form-control" name="txtClave" value="<?php echo $conUsuario['Clv_Usuario']; ?>" required>
        <input type="hidden"  class="form-control" name="txtRol" value="<?php echo $conUsuario['Nombre_Rol']; ?>" required>
        
            <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text"  class="form-control" name="txtNombre" value="<?php echo $conUsuario['Nombre']; ?>" required
            oninput="validarNoNumeros(this)">
            </div>
            
            <div class="form-group">
            <label for="nombre">Apellido Paterno:</label>
            <input type="text"  class="form-control" name="txtApellidoPaterno" value="<?php echo $conUsuario['Apellido_Paterno']; ?>" required
            oninput="validarNoNumeros(this)">
            </div>
            
            <div class="form-group">
            <label for="nombre">Apellido Materno:</label>
            <input type="text"  class="form-control" name="txtApellidoMaterno" value="<?php echo $conUsuario['Apellido_Materno']; ?>" required
            oninput="validarNoNumeros(this)">
            </div>
            
            <div class="form-group">
            <label for="apellidop">Usuario Nombre:</label>
            <input type="text" class="form-control"name="txtUsuarioNombre" value="<?php echo $conUsuario['Usuario_Nombre']; ?>" required>
            </div>

            <div class="form-group">
            <label for="apellidom">Contraseña:</label>
            <input type="text" class="form-control" name="txtContrasenia" value="<?php echo $conUsuario['Contrasenia']; ?>" required>
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

</body>
</html>
