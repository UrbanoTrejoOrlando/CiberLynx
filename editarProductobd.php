<?php
   include("conexion/conectar_base.php");
   $nombre = $_POST['txtNombre'];
   $descripcion = $_POST['txtDescripcion'];
   $precio = $_POST['txtPrecio'];
   $existencia = $_POST['txtExistencia'];
   $marca = $_POST['cmbMarca'];
   $categoria = $_POST['cmbCategoria'];
   $unidad = $_POST['cmbUnidad'];

   echo "$nombre | $descripcion | $precio | $existencia | $marca | $categoria | $unidad";

   $sql = "CALL proc_actualizar_inventario('$nombre','$descripcion', $precio, $existencia, $marca, $categoria, $unidad);";
      if(mysqli_query($conexion,$sql)){
      #redireccionar a inventario
         header("location:inventario.php");
         exit();
       }else{
         echo "Problemas al actualizar el precio del producto, verifique de nuevo: " . mysqli_error($conexion);
  }  

?>

