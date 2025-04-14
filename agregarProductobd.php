<?php
	include("conexion/conectar_base.php");
	$nombre = $_POST['txtNombre'];
	$descripcion = $_POST['txtDescripcion'];
	$precio = $_POST['txtPrecio'];
	$marca = $_POST['cmbMarca'];
	$categoria = $_POST['cmbCategoria'];
	$unidad = $_POST['cmbUnidad'];
	$existencia = $_POST['txtExistencia'];

	echo " $marca | $categoria| $unidad | $nombre | $precio | $existencia | $descripcion ";

	$sql = "CALL proc_insertar_producto($marca, $categoria, $unidad, '$nombre', $precio, $existencia, '$descripcion');";
	if(mysqli_query($conexion,$sql)){
   	# redireccionar a consultar personas
   	 header("location:inventario.php");
    	exit();
  	}else{
    echo "Problemas al registrar el producto, verifique de nuevo: " . mysqli_error($conexion);
  }

?>
