<?php
// Incluir archivo de conexión a la base de datos
include("conexion/conectar_base.php");

// Verificar que los datos del formulario hayan sido enviados por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $nombre = mysqli_real_escape_string($conexion, $_POST['txtNombre']);
    $apellidoP = mysqli_real_escape_string($conexion, $_POST['txtApellidoP']);
    $apellidoM = mysqli_real_escape_string($conexion, $_POST['txtApellidoM']);

    // Verificar que los campos no estén vacíos
    $errores = [];
    if (empty($nombre)) {
        $errores[] = "El nombre no puede estar vacío.";
    }
    if (empty($apellidoP)) {
        $errores[] = "El apellido paterno no puede estar vacío.";
    }
    if (empty($apellidoM)) {
        $errores[] = "El apellido materno no puede estar vacío.";
    }

    // Mostrar errores si existen
    if (!empty($errores)) {
        echo '<div class="alert alert-danger">';
        foreach ($errores as $error) {
            echo '<p>' . $error . '</p>';
        }
        echo '</div>';
    } else {
        // Intentar ejecutar la consulta para actualizar el cliente
        $sql = "CALL proc_actualizar_cliente('$nombre','$apellidoP','$apellidoM')";
        
        // Ejecutar la consulta
        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            // Verificar si el procedimiento almacenado generó algún mensaje de error
            $mensaje = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT @MESSAGE_TEXT AS mensaje"))['mensaje'];

            if (!empty($mensaje)) {
                echo '<div class="alert alert-danger">' . $mensaje . '</div>';
            } else {
                // Redireccionar a la página de clientes después de la actualización exitosa
                header("location: cliente.php");
                exit();
            }
        } else {
            // Manejar errores SQL
            echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
        }
    }
}
?>

