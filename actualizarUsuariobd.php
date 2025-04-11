<?php
	include("conexion/conectar_base.php");
	$clave = $_POST['txtClave'];
	$rol = $_POST['txtRol'];
	$nombre = $_POST['txtNombre'];
	$apellidoPaterno = $_POST['txtApellidoPaterno'];
	$apellidoMaterno = $_POST['txtApellidoMaterno'];
    $usuario = $_POST['txtUsuarioNombre'];
    $contrasenia = $_POST['txtContrasenia'];

	echo "$clave | $usuario | $contrasenia | $rol";

	$sql = "CALL actualizar_usuario('$clave','$nombre','$apellidoPaterno','$apellidoMaterno','$usuario','$contrasenia');";
  	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar usuarios
   	 header("location:usuario.php");
    	exit();
 	}else{
    	echo "Problemas al actualizar los datos, verifique de nuevo: " . mysqli_error($conexion);
  }
?>
