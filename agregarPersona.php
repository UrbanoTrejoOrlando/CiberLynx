<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/personas/agregarPersonas.css">

  <title>Agregar Persona</title>
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
          <h1 class="text-center">Agregar Persona</h1>
        </div>
      </div>
    </div>
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
        <form id="formRegistro" class="formulario" action="agregar_personabd.php" method="POST">
            <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text"  class="form-control" placeholder="Nombre:" name="txtNombre" required>
            </div>
            <div class="form-group">
            <label for="apellidop">Apellido Paterno:</label>
            <input type="text" class="form-control" placeholder="Apellido Paterno:" name="txtApellidoP" required>
            </div>
            <div class="form-group">
            <label for="apellidom">Apellido Materno:</label>
            <input type="text" class="form-control" placeholder="Apellido Materno:" name="txtApellidoM" required>
            </div>
            <div class="d-grid gap-4 col-4 mx-auto mt-3">
              <button class="btn btn-primary" type="submit">Confirmar</button>
              <button id="btn_cancelar" type="button" class="btn btn-primary">Cancelar</button>
              <script>
                document.getElementById('btn_cancelar').addEventListener('click', function() {
                    window.location.href = 'persona.php';
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
