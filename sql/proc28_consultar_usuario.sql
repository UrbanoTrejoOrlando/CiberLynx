DROP PROCEDURE IF EXISTS proc_consultar_usuario;

DELIMITER //
CREATE PROCEDURE proc_consultar_usuario(
    IN p_clv_usuario VARCHAR(5)
)
BEGIN
    SELECT
    Clv_Usuario, 
    Rol.Nombre_Rol,
    Nombre,
    Apellido_Paterno,
    Apellido_Materno,
    Usuario_Nombre,
    Contrasenia FROM Usuario
    INNER JOIN Rol ON Usuario.Id_Rol = Rol.Id_Rol
    WHERE Clv_Usuario = p_clv_usuario;
END //
DELIMITER ;
