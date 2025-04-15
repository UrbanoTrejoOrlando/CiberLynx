<?php
include("conexion/conectar_base.php");
$id_marca = $_GET['id_marca'];

# Llamada al procedure
$sql = "CALL proc_eliminar_marca($id_marca)";

if (mysqli_query($conexion,$sql)){
        header("location:tablas.php");
} else {
   echo "Error al eliminar la base de datos";
}

mysqli_close($conexion);
?>
