<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/producto.css">

  <title>Agregar Producto</title>
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
      <div class="user-panel d-flex">
        <div class="info">
          <a href="cerrar_sesion.php" class="d-block">Cerrar Sesion</a>
        </div>
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Administrador</a>
        </div>
      </div>
    </div>
  </nav>

  <class="content-wrapper">
    <div>
      <div class="mt-5">
        <div class="col-12">
          <br>
          <h1 class="text-center">Agregar Producto</h1>
        </div>
      </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
        <form id="formRegistro" class="formulario" action="agregarProductobd.php" method="POST">
        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" class="form-control" placeholder="Nombre:" name="txtNombre" required
          oninput="validarNoNumerosNiEspeciales(this)">
          
        </div>

        <script>
          function validarNoNumerosNiEspeciales(input) {
            var regex = /^[a-zA-Z\s]*$/; // Expresión regular para permitir solo letras y espacios
            if (!regex.test(input.value)) {
              alert("No se pueden ingresar números ni caracteres especiales en la descripción.");
              input.value = input.value.replace(/[^a-zA-Z\s]/g, ''); 
            }
          }
        </script>

        <div class="form-group">
          <label for="descripcion">Descripcion:</label>
          <input type="text" class="form-control" placeholder="Descripcion:" name="txtDescripcion" required 
            oninput="validarNoNumerosNiEspeciales(this)">
        </div>

        <div class="form-group">
          <label for="precio">Precio:</label>
          <input type="number" class="form-control" placeholder="Precio:" name="txtPrecio" required
            oninput="validarNoNegativos(this)">
        </div>

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
        <label for="marca">Marca:</label>
						<select class="form-control" name="cmbMarca" required>
              <option selected>Seleccionar Marca</option>
                <?php
                  include("conexion/conectar_base.php");
                  $sql = "CALL proc_mostrar_marca()";
                  $marca = mysqli_query($conexion, $sql);
                  while ($regMarca = mysqli_fetch_assoc($marca)) {
                    echo "<option value='" . $regMarca['Id_Marca'] . "'>" . $regMarca['Nombre_Marca'] . "</option>";
                  }
                  mysqli_close($conexion);
                ?>
            </select>
        </div>
        <div class="form-group">
        <label for="categoria">Categoria:</label>
					<select class="form-control" name="cmbCategoria" required>
            <option selected>Seleccionar Categoria</option>
            <?php
            include("conexion/conectar_base.php");
            $sql = "CALL proc_mostrar_categoria()";
            $categoria = mysqli_query($conexion, $sql);
            while ($regCategoria = mysqli_fetch_assoc($categoria)) {
               echo "<option value='" . $regCategoria['Id_Categoria'] . "'>" . $regCategoria['Nombre_Categoria'] . "</option>";
            }
            mysqli_close($conexion);
            ?>
          </select>
        </div>

        <div class="form-group">
        <label for="unidad">Unidad:</label>
				<select class="form-control" name="cmbUnidad" required>
        <option selected>Seleccionar Unidad</option>
           <?php
              include("conexion/conectar_base.php");
              $sql = "CALL proc_mostrar_unidad()";
              $marca = mysqli_query($conexion, $sql);
              while ($regMarca = mysqli_fetch_assoc($marca)) {
                 echo "<option value='" . $regMarca['Id_Unidad'] . "'>" . $regMarca['Nombre_Unidad'] . "</option>";
               }
              mysqli_close($conexion);
           ?>
        </select>
        </div>
        
        <div class="form-group">
          <label for="existencia">Existencia:</label>
          <input type="number" class="form-control" placeholder="Existencia:" name="txtExistencia" required
            oninput="validarNoNegativos(this)">
        </div>
    		<br>
    		<button id="btn_confirmar" type="submit" class="btn btn-primary">Confirmar</button>
    		<button id="btn_cancelar" type="button" class="btn btn-primary">Cancelar</button>

            <script>
                document.getElementById('btn_cancelar').addEventListener('click', function() {
                    window.location.href = 'cliente.php';
                });
            </script>

          </form>
        </div>
      </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>
</body>
</html>

