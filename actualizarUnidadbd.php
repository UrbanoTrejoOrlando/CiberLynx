<?php
	include("conexion/conectar_base.php");
	$idUnidad = $_POST['txtIdUnidad'];
	$unidad = $_POST['txtNombreUnidad'];

	$sql = "CALL proc_actualizar_unidad($idUnidad,'$unidad');";
  	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar personas
   	 header("location:tablas.php");
    	exit();
 	}else{
    	echo "Problemas al ingresar los datos, verifique de nuevo: " . mysqli_error($conexion);
  }
?>

