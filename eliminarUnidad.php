<?php
include("conexion/conectar_base.php");
$id_unidad = $_GET['id_unidad'];

# Llamada al procedure
$sql = "CALL proc_eliminar_unidad($id_unidad)";

if (mysqli_query($conexion,$sql)){
        header("location:tablas.php");
} else {
   echo "Error al eliminar la base de datos";
}

mysqli_close($conexion);
?>
