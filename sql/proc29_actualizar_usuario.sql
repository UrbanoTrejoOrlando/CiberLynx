DROP PROCEDURE IF EXISTS actualizar_usuario;
DELIMITER //
CREATE PROCEDURE actualizar_usuario(
    IN p_clv_usuario VARCHAR(5),
    IN p_nombre VARCHAR(20),
    IN p_apellidop VARCHAR(20),
    IN p_apellidom VARCHAR(20),
    IN p_usuario_nombre VARCHAR(10),
    IN p_contrasenia VARCHAR(10)
)
BEGIN 
    UPDATE Usuario SET
        Nombre = p_nombre,
        Apellido_Paterno = p_apellidop,
        Apellido_Materno = p_apellidom,
        Usuario_Nombre = p_usuario_nombre,
        Contrasenia = p_contrasenia
    WHERE Clv_Usuario = p_clv_usuario;
END //
DELIMITER ;
