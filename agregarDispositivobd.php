<?php
	include("conexion/conectar_base.php");
	$direcccion = $_POST['txtDireccionMac'];
   	$dispositivo = $_POST['cmbDispositivo'];

   echo " $dispositivo | $direcccion";

 	$sql = "CALL proc_insertar_dispositivo($dispositivo,'$direcccion');";
   	if(mysqli_query($conexion,$sql)){
     	#redireccionar a inventario
  			header("location:wifi.php");
         exit();
      }
		else{
      	echo "Problemas al registrar el dispositivo verifique de nuevo: " . mysqli_error($conexion);
		}
?>
