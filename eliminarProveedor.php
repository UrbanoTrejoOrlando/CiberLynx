<?php
include("conexion/conectar_base.php");
$clave = $_GET['claveProv'];

# Llamada al procedure
$sql = "CALL proc_eliminar_prov('$clave')";

if (mysqli_query($conexion,$sql)){
        header("location:proveedores.php");
} else {
   echo "Error al eliminar la base de datos";
}

mysqli_close($conexion);
?>
