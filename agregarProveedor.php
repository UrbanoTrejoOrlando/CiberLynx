<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/clientes/agregar.css">

  <title>Agregar Proveedor</title>
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
          <h1 class="text-center">Agregar Proveedor</h1>
        </div>
      </div>
    </div>
    
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
        <form id="formRegistro" class="formulario" action="agregarProveedorbd.php" method="POST">

        <script>
          function validarNoNumeros(input) {
            var regex = /^[a-zA-Z\s]*$/; // Expresión regular para permitir solo letras y espacios
            if (!regex.test(input.value)) {
              alert("No se pueden ingresar números ni caracteres especiales en la descripción.");
              input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); 
            }
          }
        </script>
    	      
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

        <div class="form-group">
            <label for="nombre">Proveedor:</label>
            <input type="text" class="form-control" placeholder="Proveedor" name="txtProv" required>
        </div>

        <div class="form-group">
          <label for="telefono">Telefono:</label>
          <input type="text" class="form-control" placeholder="telefono:" name="txtTelefono" required
          oninput="validarSoloNumeros(this)">
        </div>

        <div class="form-group">
          <label for="corre">Corre Electronico:</label>
          <input type="text" class="form-control" placeholder="Correo:" name="txtCorreo" required>
        </div>

        <div class="form-group">
          <label for="direccion">Direccion:</label>
          <input type="text" class="form-control" placeholder="Direccion:" name="txtDireccion" required>
        </div>

            <div class="d-grid gap-4 col-4 mx-auto mt-3">
              <button class="btn btn-primary" type="submit">Confirmar</button>
              <button id="btn_cancelar" type="button" class="btn btn-primary">Cancelar</button>
              <script>
                document.getElementById('btn_cancelar').addEventListener('click', function() {
                    window.location.href = 'proveedores.php';
                });
            </script>
            </div>
        </form>
        </div>
      </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

</body>
</html>
