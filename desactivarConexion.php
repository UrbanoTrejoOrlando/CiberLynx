<?php
include("conexion/conectar_base.php");
$clave = $_GET['clv_conexion'];
echo $clave;

# Llamada al procedure
$sql = "CALL proc_cerrar_conexion('$clave')";

if (mysqli_query($conexion,$sql)){
        header("location:wifi.php");
} else {
   echo "Error al eliminar la base de datos";
}

mysqli_close($conexion);

?>