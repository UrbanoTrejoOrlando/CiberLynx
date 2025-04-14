<?php
	include("conexion/conectar_base.php");
	$unidad = $_POST['txtUnidad'];

	echo "$unidad";

	$sql = "CALL proc_insertar_unidad('$unidad');";
  	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar personas
   	 header("location:tablas.php");
    	exit();
 	}else{
    	echo "Problemas al ingresar los datos, verifique de nuevo: " . mysqli_error($conexion);
  }
?>

