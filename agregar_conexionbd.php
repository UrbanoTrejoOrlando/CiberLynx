<?php
	include("conexion/conectar_base.php");
	$direccion = $_POST['cmbDireccion'];	
	$fecha = $_POST['txtFechaF'];	
	$venta = $_POST['cmbVenta'];	
	$conexiones = $_POST['cmbConexion'];	

	echo "$direccion | $fecha | $venta | $conexiones ";
 
   $sql = "CALL proc_agregar_conexion('$direccion','$conexiones','$venta','$fecha');";
  	if(mysqli_query($conexion,$sql)){
   #redireccionar a wifi
   	header("location:wifi.php");
    	exit();
	}
	else{
   	echo "Problemas al registrar la nueva conexion, verifique de nuevo: " . mysqli_error($conexion);
	}


?>
