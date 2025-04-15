<?php
include("conexion/conectar_base.php");
$clave = $_GET['clave'];
echo $clave;

# Llamada al procedure
$sql = "CALL proc_eliminar_usuario('$clave')";

if (mysqli_query($conexion,$sql)){
        header("location:usuario.php");
} else {
   echo "Error al eliminar la base de datos";
}

mysqli_close($conexion);

?>
