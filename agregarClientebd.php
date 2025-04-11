<?php
	include("conexion/conectar_base.php");
	$nombre = $_POST['txtNombre'];	
	$apellidoP = $_POST['txtApellidoP'];	
	$apellidoM = $_POST['txtApellidoM'];	
		
	echo "$nombre | $apellidoP | $apellidoM ";
 
   $sql = "CALL proc_insertar_cliente('$nombre','$apellidoP','$apellidoM');";
  	if(mysqli_query($conexion,$sql)){
   #redireccionar a usuarios
   	header("location:cliente.php");
    	exit();
	}
	else{
   	echo "Problemas al registrar un nuevo usuario, verifique de nuevo: " . mysqli_error($conexion);
	}


?>
