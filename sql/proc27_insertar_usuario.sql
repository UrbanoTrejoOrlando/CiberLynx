DROP PROCEDURE IF EXISTS proc_inserta_usuario;
DELIMITER //
CREATE PROCEDURE proc_inserta_usuario(
    IN p_id_rol INT,
    IN p_nombre VARCHAR(20),
    IN p_apellidop VARCHAR(20),
    IN p_apellidom VARCHAR(20),
    IN p_usuario VARCHAR(10),
    IN p_contrasenia VARCHAR(10)
)
BEGIN
    DECLARE p_clv_usuario VARCHAR(5);
    SET p_clv_usuario = GenerarClaveAleatoria12();

    INSERT INTO Usuario (Clv_Usuario, Id_Rol, Nombre, Apellido_Paterno, Apellido_Materno, Usuario_Nombre, Contrasenia)
    VALUES (p_clv_usuario, p_id_rol, p_nombre, p_apellidop, p_apellidom, p_usuario, p_contrasenia);
END //
DELIMITER ;
