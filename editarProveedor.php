<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/clientes/cliente.css">
    
    <title>Actualizar Proveedor</title>
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
          <h1 class="text-center">Actualizar Proveedor</h1>
        </div>
      </div>
    </div>   
    <?php
          #conexion con la base de datos
          include("conexion/conectar_base.php");
          # recibimos comom paramatro el nombre de la persona
          $clave= $_GET['claveProv'];

          #Consulta 
          $sql = "CALL consultar_proveedor('$clave');";
          $ejecConsulta = mysqli_query($conexion, $sql);
          if(mysqli_num_rows($ejecConsulta) > 0) {
            $conProv = mysqli_fetch_array($ejecConsulta);
            ?> 
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="editarProveedorbd.php" method="POST">

        <script>
          function validarSoloNumeros(input) {
            var regex = /^[0-9]*$/; // Expresión regular para permitir solo números

            // Verificar si el valor no coincide con la expresión regular
            if (!regex.test(input.value)) {
              alert("Por favor, ingrese solo números en este campo.");
              input.value = input.value.replace(/\D/g, ''); // Eliminar todo lo que no sea número
            }
          }
        </script>

        <input type="hidden"  class="form-control" name="txtClave" value="<?php echo $conProv['Folio_Proveedor']; ?>" required>
        
            <div class="form-group">
            <label for="nombre">Proveedor:</label>
            <input type="text" class="form-control" name="txtProv" value="<?php echo $conProv['Nombre_Proveedor']; ?>" required>
            </div>
            
            <div class="form-group">
            <label for="nombre">Telefono:</label>
            <input type="text" class="form-control" name="txtTelefono" value="<?php echo $conProv['Telefono']; ?>" required
          oninput="validarSoloNumeros(this)">

            </div>
            
            <div class="form-group">
            <label for="nombre">Correo:</label>
            <input type="text" class="form-control" name="txtCorreo" value="<?php echo $conProv['Correo_Electronico']; ?>" required>
            </div>
            
            <div class="form-group">
            <label for="direccion">Direccion:</label>
            <input type="text" class="form-control"name="txtDireccion" value="<?php echo $conProv['Direccion']; ?>" required>
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
