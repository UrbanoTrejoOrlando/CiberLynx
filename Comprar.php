<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/clientes/estilos_clientes.css">
  <title>Compras</title>
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
          <h1 class="text-center">Compras</h1>
        </div>
      </div>
    </div>   
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="procesar_compra.php" method="POST">

        <script>
          function validarNoNegativos(input) {
            // Obtener el valor actual del input
            var valor = input.value.trim();
        
            // Verificar si el valor contiene el símbolo "-"
            if (valor.includes('-')) {
              // Mostrar alerta
              alert("No se pueden ingresar números negativos en el precio.");
              // Limpiar el input (eliminar el símbolo '-')
              input.value = valor.replace('-', '');
            }
          }
        </script>

          <div class="form-group">
            <label for="proveedor">Proveedor:</label>
            <select class="form-control" name="cmbProveedor" required>
              <option selected>Proveedor</option>
              <?php
                 include("conexion/conectar_base.php");
                 $sql = "CALL mos_proveedor()";
                 $resultado = mysqli_query($conexion, $sql);
                 while ($regprov = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $regprov['Folio_Proveedor'] . "'>" . $regprov['Nombre_Proveedor'] . "</option>";
                 }
                 mysqli_close($conexion);
               ?>
            </select>
          </div>
          <div class="form-group">
            <label for="producto">Producto:</label>
            <select class="form-control" name="cmbProducto" required>
              <option selected>Seleccionar Producto</option>
              <?php
                 include("conexion/conectar_base.php");
                 $sql = "CALL mos_producto()";
                 $resultado = mysqli_query($conexion, $sql);
                 while ($regprod = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $regprod['Codigo_Barras'] . "'>" . $regprod['Nombre'] . "</option>";
                 }
                 mysqli_close($conexion);
               ?>
            </select>
          </div>
          <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" placeholder="Cantidad" name="txtCantidad" required
            oninput="validarNoNegativos(this)">

          </div>
          <div class="form-group">
            <label for="precioCompra">Precio Compra:</label>
            <input type="number" class="form-control" placeholder="Precio de Compra" name="txtPrecioCompra" required
            oninput="validarNoNegativos(this)">

          </div>
          <div class="form-group">
            <label for="precioVenta">Precio Venta:</label>
            <input type="number" class="form-control" placeholder="Precio de Venta" name="txtPrecioVenta" required
            oninput="validarNoNegativos(this)">

          </div>
          <div class="form-group">
            <label for="tipoPago">Tipo de Pago:</label>
            <select class="form-control" name="tipoPago" required>
              <option value="Efectivo">Efectivo</option>
              <option value="Tarjeta">Tarjeta</option>
            </select>
          </div>
          <div class="d-grid gap-4 col-4 mx-auto mt-3">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </class>
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
</body>
</html>
