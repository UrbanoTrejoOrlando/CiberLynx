-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_eliminar_marca;

DELIMITER //
CREATE PROCEDURE proc_eliminar_marca(
        IN p_id_marca INT
)
BEGIN
        UPDATE Marca SET Estatus = '0'
                WHERE Id_Marca = p_id_Marca;
END //
DELIMITER ;
