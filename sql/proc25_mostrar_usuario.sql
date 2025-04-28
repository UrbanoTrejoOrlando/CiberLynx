-- Procedure numero 25
-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_usuario_2;
DELIMITER //

CREATE PROCEDURE proc_usuario_2()
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
    WHERE Usuario.Estatus = '1';
END //
DELIMITER ;
