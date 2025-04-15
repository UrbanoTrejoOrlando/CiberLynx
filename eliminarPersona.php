<?php
include("conexion/conectar_base.php");
$nombre = $_GET['nombre_persona'];
echo $nombre;

# Llamada al procedure
$sql = "CALL proc_eliminar_personas_2('$nombre')";

if (mysqli_query($conexion,$sql)){
        header("location:persona.php");
} else {
   echo "Error al eliminar la base de datos";
}
mysqli_close($conexion);
?>
