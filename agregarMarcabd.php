<?php
	include("conexion/conectar_base.php");
	$marca = $_POST['txtMarca'];

	echo "$marca";

	$sql = "CALL proc_insertar_marca('$marca');";
  	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar personas
   	 header("location:tablas.php");
    	exit();
 	}else{
    	echo "Problemas al ingresar los datos, verifique de nuevo: " . mysqli_error($conexion);
  }
?>

