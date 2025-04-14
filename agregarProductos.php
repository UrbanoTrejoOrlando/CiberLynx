<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/wifi/estilo_wifi.css">

  <title>Agregar Productos</title>
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
          <h1 class="text-center">Agregar Productos</h1>
        </div>
      </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
          <form action="agregarDispositivobd.php" method="POST">
            <div>
                <a href="ventas.php" class="btn btn-primary">Ventas</a>
            </div>
            <br>
            <table id="tablaVentas">
                <thead>
                    <tr>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Agregar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Conectar con el servidor de BD
                    include("conexion/conectar_base.php");

                    // Llamar al procedimiento almacenado para obtener los productos
                    $sql = "CALL proc_mos_productos_version_2()";
                    $ejecProductos = mysqli_query($conexion, $sql);

                    // Verificar si se obtuvieron resultados
                    if ($ejecProductos && mysqli_num_rows($ejecProductos) > 0) {
                        // Generar dinámicamente cada fila de la tabla de productos
                        while ($conProducto = mysqli_fetch_array($ejecProductos)) {
                            $producto_id = $conProducto['Codigo_Barras'];
                            echo "<tr id='producto_$producto_id'>";
                            echo "<td>" . $conProducto['Nombre'] . "</td>";
                            echo "<td>" . $conProducto['Descripcion'] . "</td>";
                            echo "<td>" . $conProducto['Precio'] . "</td>";
                            echo "<td><button type='button' class='btn btn-secondary' onclick='agregarProducto($producto_id, \"" . $conProducto['Nombre'] . "\", \"" . $conProducto['Descripcion'] . "\", \"" . $conProducto['Precio'] . "\")'>Agregar</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No se encontraron productos.</td></tr>";
                    }

                    // Cerrar la conexión a la base de datos
                    mysqli_close($conexion);
                    ?>
            </tbody>
            </table>
          </form>
          <script src="js/ventas/agregar.js"></script>

        </div>
      </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

</body>
</html>
