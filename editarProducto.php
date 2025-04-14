<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/productos/productos.css">
  
  <title>Actualizar Inventario</title>
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
          <h1 class="text-center">Actualizar Inventario</h1>
        </div>
      </div>
    </div>   
    <?php
          #conexion con la base de datos
          include("conexion/conectar_base.php");
          # recibimos comom paramatro el nombre de la persona
          $producto = $_GET['codigoBarras'];

          #Consulta 
          $sql = "CALL proc_obtener_inventario('$producto')";
          $ejecConsulta = mysqli_query($conexion, $sql);
          if(mysqli_num_rows($ejecConsulta) > 0) {
            $conProducto = mysqli_fetch_array($ejecConsulta);
            ?> 
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 mt-3">
        <form id="formRegistro" class="formulario" action="editarProductobd.php" method="POST">
            
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
              function validarNegativos(input) {
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
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control"name="txtNombre" value="<?php echo $conProducto['Nombre']; ?>" required
            oninput="validarNoNumeros(this)">
            </div>            

            <div class="form-group">
            <label for="descripcion">Descripcion:</label>
            <input type="text" class="form-control"name="txtDescripcion" value="<?php echo $conProducto['Descripcion']; ?>" required
            oninput="validarNoNumeros(this)">
            </div>            

            <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" class="form-control" name="txtPrecio" value="<?php echo $conProducto['Precio']; ?>" required
            oninput="validarNegativos(this)">
            </div>  

            <div class="form-group">
            <label for="existencia">Existencia:</label>
            <input type="number" class="form-control"name="txtExistencia" value="<?php echo $conProducto['Existencia']; ?>" required
            oninput="validarNegativos(this)">
            </div>  

            <div class="form-group">
    <label for="marca">Marca:</label>
    <select class="form-control" name="cmbMarca" required>
        <?php
        include("conexion/conectar_base.php");
        $sql = "CALL proc_mostrar_marca()";
        $marca = mysqli_query($conexion, $sql);
        $idMarcaSeleccionada = $conProducto['Id_Marca']; // Asumiendo que el ID de la marca está en $conProducto['Id_Marca']

        while ($mostrarMarca = mysqli_fetch_assoc($marca)) {
            $idMarca = $mostrarMarca['Id_Marca'];
            $nombreMarca = $mostrarMarca['Nombre_Marca'];
            $selected = ($idMarcaSeleccionada == $idMarca) ? "selected" : "";
            echo "<option value='$idMarca' $selected>$nombreMarca</option>";
        }
        mysqli_close($conexion);
        ?>
    </select>
</div>
 
            
<div class="form-group">
    <label for="categoria">Categoria:</label>
    <select class="form-control" name="cmbCategoria" required>
        <?php
        include("conexion/conectar_base.php");
        $sql = "CALL proc_mostrar_categoria()";
        $categoria = mysqli_query($conexion, $sql);
        $idCategoriaSeleccionada = $conProducto['Id_Categoria']; // Asumiendo que el ID de la categoría está en $conProducto['Id_Categoria']

        while ($mostrarCategoria = mysqli_fetch_assoc($categoria)) {
            $idCategoria = $mostrarCategoria['Id_Categoria'];
            $nombreCategoria = $mostrarCategoria['Nombre_Categoria'];
            $selected = ($idCategoriaSeleccionada == $idCategoria) ? "selected" : "";
            echo "<option value='$idCategoria' $selected>$nombreCategoria</option>";
        }
        mysqli_close($conexion);
        ?>
    </select>
</div>


           
            <div class="form-group">
    <label for="unidad">Unidad:</label>
    <select class="form-control" name="cmbUnidad" required>
        <?php
        include("conexion/conectar_base.php");
        $sql = "CALL proc_mostrar_unidad()";
        $unidad = mysqli_query($conexion, $sql);
        $idUnidadSeleccionada = $conProducto['Id_Unidad']; // Asumiendo que el ID de la unidad está en $conProducto['Id_Unidad']

        while ($mostrarUnidad = mysqli_fetch_assoc($unidad)) {
            $idUnidad = $mostrarUnidad['Id_Unidad'];
            $nombreUnidad = $mostrarUnidad['Nombre_Unidad'];
            $selected = ($idUnidadSeleccionada == $idUnidad) ? "selected" : "";
            echo "<option value='$idUnidad' $selected>$nombreUnidad</option>";
        }
        mysqli_close($conexion);
        ?>
    </select>
</div>
            <br><br>
            <div class="form-group">
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
