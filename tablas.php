<?php
session_start();
include("conexion/conectar_base.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/tablas/tablas.css">
  <title>Tablas Principales</title>
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
  <!-- Navbar -->
  <nav class="navbar navbar-custom fixed-top">
    <div class="container-fluid p-0 d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <a class="navbar-brand m-0 p-0 d-flex justify-content-center" href="index.html">
          <img src="dist/img/lo.png" class="navbar-logo" alt="Logo">
        </a>
      </div>
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
        echo '</div>';
      }
      ?>
    </div>
  </nav>

  <div class="content">
    <div class="mt-5">
      <div class="col-12">
        <br>
        <h1 class="col-6 text-center">Tablas Principales</h1>
      </div>
    </div>
    </div>
  <a href="inventario.php" class="btn btn-secondary" role="button">Regresar</a>


  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col">
          <h2>Marca</h2>
          <table class="table">
            <thead>
                <th class="hidden">Id_Marca</th>
                <th>Nombre Marca</th>
                <?php
                    if(isset($_SESSION['Rol'])){
                        // Obtenemos valor del rol
                        $rol = $_SESSION['Rol'];

                        if ($rol == 1){
                          echo "<th>Editar</th>";
                          echo "<th>Eliminar</th>";
                        }
                      }
                      ?>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql_marca = "SELECT * FROM Marca WHERE Estatus = '1'";
              $ejecConsultaMarca = mysqli_query($conexion, $sql_marca);
              while($regMarca = mysqli_fetch_array($ejecConsultaMarca)){
                echo "<tr>";
                echo "<td class='hidden'>" . $regMarca[0] . "</td>";
                echo "<td>" . $regMarca[1] . "</td>";
                if($rol == 1){
                    echo "<td> <a href='actualizarMarca.php?id_marca=". $regMarca[0] . "'><i class='fas fa-edit'></i></a>" . "</td>";
                    echo "<td> <a href='eliminarMarca.php?id_marca=". $regMarca[0] . "'><i class='fas fa-trash-alt'></i></a>" . "</td>";
                  }
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <a href="agregarMarca.php" class="btn btn-secondary" role="button">Agregar</a>

        </div>
        <div class="col">
          <h2>Unidad</h2>
          <table class="table">
          <thead>
            <th class="hidden">Id_Unidad</th>
                <th>Nombre Unidad</th>
                <?php
                    if(isset($_SESSION['Rol'])){
                        // Obtenemos valor del rol
                        $rol = $_SESSION['Rol'];    
                        if ($rol == 1){
                          echo "<th>Editar</th>";
                          echo "<th>Eliminar</th>";
                        }
                    }
                ?>
                </tr>
            </thead>
            <tbody>
              <?php
              $sql_unidad = "SELECT * FROM Unidad WHERE Estatus = '1'";
              $ejecConsultaUnidad = mysqli_query($conexion, $sql_unidad);
              while($regUnidad = mysqli_fetch_array($ejecConsultaUnidad)){
                echo "<tr>";
                echo "<td class='hidden'>" . $regUnidad[0] . "</td>";
                echo "<td>" . $regUnidad[1] . "</td>";
                if($rol == 1){
                    echo "<td> <a href='actualizarUnidad.php?id_unidad=". $regUnidad[0] . "'><i class='fas fa-edit'></i></a>" . "</td>";
                    echo "<td> <a href='eliminarUnidad.php?id_unidad=". $regUnidad[0] . "'><i class='fas fa-trash-alt'></i></a>" . "</td>";
                  }
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
          <a href="agregarUnidad.php" class="btn btn-secondary" role="button">Agregar</a>
        </div>
        <div class="col">
            <h2>Categoria</h2>
            <table class="table">
            <thead>
            <th class="hidden">Id_Categoria</th>
                <th>Nombre Categoria</th>
                </tr>
            </thead>  
            <tbody>
            <?php
            $sql_categoria = "SELECT * FROM Categoria";
            $ejecConsultaCategoria = mysqli_query($conexion, $sql_categoria);
            while($regCategoria = mysqli_fetch_array($ejecConsultaCategoria)){
                echo "<tr>";
                echo "<td class='hidden'>" . $regCategoria[0] . "</td>";
                echo "<td>" . $regCategoria[1] . "</td>";
                echo "</tr>";
              }    
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
</body>
</html>
