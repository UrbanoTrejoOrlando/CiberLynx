<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/clientes/cliente.css">
    
    <title>Actualizar Cliente</title>
    <!-- Pequeños logos -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Plantilla Admin-->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">

    <script>
        // Función para validar que no se ingresen números ni caracteres especiales en los campos de texto
        function validarNoNumerosNiEspeciales(input) {
            var valor = input.value;
            // Verificar si contiene números
            if (/[\d]/.test(valor)) {
                alert('Error: No se pueden ingresar números en este campo.');
                input.value = '';
                return;
            }
            // Verificar si contiene caracteres especiales
            if (/[^\w\s]/.test(valor)) {
                alert('Error: No se pueden ingresar caracteres especiales en este campo.');
                input.value = '';
                return;
            }
        }
    </script>
  
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
          <h1 class="text-center">Actualizar Cliente</h1>
        </div>
      </div>
    </div>   
    <?php
          #conexion con la base de datos
          include("conexion/conectar_base.php");
          # recibimos comom paramatro el nombre de la persona
          $clave_cliente = $_GET['clv_cliente'];

          #Consulta 
          $sql = "CALL proc_consultar_cliente('$clave_cliente');";
          $ejecConsulta = mysqli_query($conexion, $sql);
          if(mysqli_num_rows($ejecConsulta) > 0) {
            $conPersona = mysqli_fetch_array($ejecConsulta);
            ?> 
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="actualizarClientebd.php" method="POST">
            <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text"  class="form-control" placeholder="Nombre:" name="txtNombre" value="<?php echo $conPersona['Nombre']; ?>" required oninput="validarNoNumerosNiEspeciales(this)">
            </div>
            <div class="form-group">
            <label for="apellidop">Apellido Paterno:</label>
            <input type="text" class="form-control" placeholder="Apellido Paterno:" name="txtApellidoP" value="<?php echo $conPersona['Apellido_Paterno']; ?>" required oninput="validarNoNumerosNiEspeciales(this)">
            </div>
            <div class="form-group">
            <label for="apellidom">Apellido Materno:</label>
            <input type="text" class="form-control" placeholder="Apellido Materno:" name="txtApellidoM" value="<?php echo $conPersona['Apellido_Materno']; ?>" required oninput="validarNoNumerosNiEspeciales(this)">
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
