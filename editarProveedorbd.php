<?php
   include("conexion/conectar_base.php");
   $clave = $_POST['txtClave'];
   $proveedor = $_POST['txtProv'];
   $telefono = $_POST['txtTelefono'];
   $correo = $_POST['txtCorreo'];
   $direccion = $_POST['txtDireccion'];
  
   echo "$clave | $proveedor | $telefono | $correo | $direccion";

   $sql = "CALL actualizar_proveedor('$clave','$proveedor','$telefono','$correo','$direccion');";
      if(mysqli_query($conexion,$sql)){
      #redireccionar a inventario
         header("location:proveedores.php");
         exit();
       }else{
         echo "Problemas al actualizar el precio del producto, verifique de nuevo: " . mysqli_error($conexion);
  }  

?>

