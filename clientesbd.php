<?php
	include("conexion/conectar_base.php");
  	$nombre = $_POST['cmb_Nombre'];

  	echo "$nombre";

	$sql = "CALL proc_insertar_clientes($nombre);";
  	if(mysqli_query($conexion,$sql)){
   # redireccionar a consultar personas
   	header("location:cliente.php");
    	exit();
 	 }else{
    echo "Problemas al registrar al cliente, verifique de nuevo: " . mysqli_error($conexion);
  		}
?>

