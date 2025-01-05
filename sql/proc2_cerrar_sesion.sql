
DROP PROCEDURE IF EXISTS proc_cerrar_sesion;

DELIMITER //

CREATE PROCEDURE proc_cerrar_sesion(
    IN p_clv_usuario VARCHAR(5)
)
BEGIN
    UPDATE Sesion SET Estatus = '0' WHERE Clv_Usuario = p_clv_usuario;
END //

DELIMITER ;
