DROP PROCEDURE IF EXISTS proc_eliminar_usuario;
DELIMITER //
CREATE PROCEDURE proc_eliminar_usuario(
    IN p_clv_usuario VARCHAR(5)
)
BEGIN
    UPDATE Usuario SET Estatus = '0'
        WHERE Clv_Usuario = p_clv_usuario;
END //
DELIMITER ;
