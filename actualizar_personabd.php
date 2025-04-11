<?php
	include("conexion/conectar_base.php");
	$nombre = $_POST['txtNombre'];
	$apellidoP = $_POST['txtApellidoP'];
	$apellidoM = $_POST['txtApellidoM'];

	echo "$nombre | $apellidoP | $apellidoM";

	$sql = "CALL proc_actualizar_cliente('$nombre','$apellidoP','$apellidoM');";
  	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar personas
   	 header("location:persona.php");
    	exit();
 	}else{
    	echo "Problemas al actualizar los datos, verifique de nuevo: " . mysqli_error($conexion);
  }
?>

