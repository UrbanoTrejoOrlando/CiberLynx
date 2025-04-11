<?php
	include("conexion/conectar_base.php");
	$nombre = $_POST['txtNombre'];	
	$apellidoP = $_POST['txtApellidoP'];	
	$apellidoM = $_POST['txtApellidoM'];	
		
	echo "$nombre | $apellidoP | $apellidoM ";
 
   $sql = "CALL proc_insertar_persona('$nombre','$apellidoP','$apellidoM');";
  	if(mysqli_query($conexion,$sql)){
   #redireccionar a usuarios
   	header("location:persona.php");
    	exit();
	}
	else{
   	echo "Problemas al registrar un nuevo usuario, verifique de nuevo: " . mysqli_error($conexion);
	}


?>
