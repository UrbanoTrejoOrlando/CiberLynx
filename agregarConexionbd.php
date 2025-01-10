<?php
	include("conexion/conectar_base.php");
	$direccion = $_POST['cmbDireccion'];	
	$dispositivo = $_POST['cmbDispositivo'];	
	$cliente = $_POST['cmbCliente'];	
	$fechaFinal = $_POST['txtFechaFinal'];	
		
	echo "$direccion | $dispositivo | $cliente | $fechaFinal ";
 
   $sql = "CALL proc_conexion('$direccion','$dispositivo','$cliente', '$fechaFinal');";
  	if(mysqli_query($conexion,$sql)){
   #redireccionar a usuarios
   	header("location:wifi.php");
    	exit();
	}
	else{
   	echo "Problemas al registrar un nuevo usuario, verifique de nuevo: " . mysqli_error($conexion);
	}


?>
