<?php
session_start();
include("conexion/conectar_base.php");

if (isset($_SESSION['fecha_inicio']) && isset($_SESSION['fecha_fin'])) {
    $fecha_inicio = $_SESSION['fecha_inicio'];
    $fecha_fin = $_SESSION['fecha_fin'];

    // Llamar al procedimiento almacenado para obtener los detalles de los productos vendidos
    $query = "CALL proc_detalles_productos('$fecha_inicio', '$fecha_fin')";
    $result = mysqli_query($conexion, $query);
    
    // Verificar si la consulta fue exitosa
    if (!$result) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }
} else {
    die('Fechas no establecidas en la sesión.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Productos Vendidos</title>
    <link rel="stylesheet" href="css/personas/estilos_personas.css">
    <!-- Pequeños logos -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Iconos -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Plantilla Admin -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Navbar -->
<nav class="navbar navbar-custom fixed-top">
    <div class="container-fluid p-0 d-flex align-items-center justify-content-between">
        <!-- Logo and Search -->
        <div class="d-flex align-items-center">
            <a class="navbar-brand m-0 p-0 d-flex justify-content-center" href="index.html">
                <img src="dist/img/lo.png" class="navbar-logo" alt="Logo">
            </a> 
        </div>
        <!-- Mostrar Usuarios-->
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

<!-- Permisos de usuarios -->
<?php
if (isset($_SESSION['Rol'])) {
    // obtenemos valor del rol
    $rol = $_SESSION['Rol'];
    echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="top: 50px; width: 100%;">';
    echo '<div class="container">';
    echo '<div class="collapse navbar-collapse justify-content-center">';
    echo '<ul class="navbar-nav">';
   
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="cliente.php"><i class="fas fa-users"></i>Clientes</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="inventario.php"><i class="fas fa-clipboard-list"></i>Inventario</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="ventas.php"><i class="fas fa-dollar-sign text-align:center"></i> Ventas</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="wifi.php"><i class="fas fa-wifi"></i> Wifi</a>';
    echo '</li>';
    if ($rol == 1){
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="usuario.php"><i class="fa fa-user-check"></i> Usuarios</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="reporte.php"><i class="fas fa-chart-pie"></i> Reporte</a>';
    echo '</li>';
    }
    echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</nav>';
}
?>

<!-- Título de Detalles de Productos Vendidos -->
<div class="content">
    <div class="mt-5">
        <div class="col-12">
            <br>
            <h1 class="col -6 text-center">Detalles de Productos Vendidos</h1>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<!-- Tabla de detalles de productos vendidos -->
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código de Barras</th>
                    <th>Cantidad Vendida</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['Nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Codigo_Barras']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Cantidad']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Precio']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Nombre_Categoria']) . "</td>";
                    echo "</tr>";
                }
                mysqli_free_result($result);
                mysqli_close($conexion);
                ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="generar_pdf_detalles.php" class="btn btn-primary">Generar PDF</a>
        </div>
    </div>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
</body>
</html>
