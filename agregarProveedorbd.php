<?php
	include("conexion/conectar_base.php");
	$proveedor = $_POST['txtProv'];	
	$telefono = $_POST['txtTelefono'];
	$correo = $_POST['txtCorreo'];	
	$direccion = $_POST['txtDireccion'];
		 
   	$sql = "CALL insertar_proveedor('$proveedor', '$telefono','$correo','$direccion');";
  	if(mysqli_query($conexion,$sql)){
   #redireccionar a proveedores
   	header("location:proveedores.php");
    	exit();
	}
	else{
   	echo "Problemas al registrar el usuario, verifique de nuevo: " . mysqli_error($conexion);
	}


?>

