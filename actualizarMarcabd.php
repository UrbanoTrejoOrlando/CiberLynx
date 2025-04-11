<?php
	include("conexion/conectar_base.php");
	$idMarca = $_POST['txtIdMarca'];
	$marca = $_POST['txtNombreMarca'];

	echo "$marca";

	$sql = "CALL proc_actualizar_marca($idMarca,'$marca');";
  	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar personas
   	 header("location:tablas.php");
    	exit();
 	}else{
    	echo "Problemas al ingresar los datos, verifique de nuevo: " . mysqli_error($conexion);
  }
?>

