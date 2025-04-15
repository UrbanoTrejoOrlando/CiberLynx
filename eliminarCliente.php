<?php
include("conexion/conectar_base.php");
$clv_cliente = $_GET['clv_cliente'];
echo $clv_cliente;

# Llamada al procedure
$sql = "CALL proc_eliminar_cliente('$clv_cliente')";

if (mysqli_query($conexion,$sql)){
        header("location:cliente.php");
} else {
   echo "Error al eliminar la base de datos";
}

mysqli_close($conexion);
?>
