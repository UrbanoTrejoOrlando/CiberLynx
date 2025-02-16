<?php
include("conexion/conectar_base.php");
$codigo = $_GET['codigoBarras'];
echo $codigo;

# Llamada al procedure
$sql = "CALL proc_eliminar_inventario('$codigo')";

if (mysqli_query($conexion,$sql)){
        header("location:inventario.php");
} else {
   echo "Error al eliminar la base de datos";
}
mysqli_close($conexion);
?>

