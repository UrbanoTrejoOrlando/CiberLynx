<?php
session_start();
include("conexion/conectar_base.php");

// Verificar si el usuario está autenticado
if (isset($_SESSION['Clv_Usuario'])) {
    // Actualizar el estado de la sesión en la base de datos
    $clv_usuario = $_SESSION['Clv_Usuario'];
    $query_actualizar_sesion = "CALL proc_cerrar_sesion('$clv_usuario');";
    if (mysqli_query($conexion, $query_actualizar_sesion)) {
        echo "Sesión actualizada correctamente.";
    } else {
        echo "Error al actualizar la sesión: " . mysqli_error($conexion);
    }
    
    // Eliminar todas las variables de sesión
    $_SESSION = array();
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al usuario a la página de inicio de sesión u otra página
    header("location:index.html");
} else {
    // Si el usuario no está autenticado, simplemente redirigirlo a la página de inicio de sesión
    header("location:index.html");
}
?>
