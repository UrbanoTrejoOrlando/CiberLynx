<?php
	include("conexion/conectar_base.php");
	$rol = $_POST['cmbRol'];	
	$nombre = $_POST['txtNombre'];
	$apellidoP = $_POST['txtP'];	
	$apellidoM = $_POST['txtM'];
	$clv_usuario = $_POST['txtUsuario'];	
	$contrasenia = $_POST['txtContrasenia'];	
	 
   	$sql = "CALL proc_inserta_usuario($rol,'$nombre', '$apellidoP','$apellidoM','$clv_usuario','$contrasenia');";
  	if(mysqli_query($conexion,$sql)){
   #redireccionar a usuarios
   	header("location:usuario.php");
    	exit();
	}
	else{
   	echo "Problemas al registrar el usuario, verifique de nuevo: " . mysqli_error($conexion);
	}


?>
