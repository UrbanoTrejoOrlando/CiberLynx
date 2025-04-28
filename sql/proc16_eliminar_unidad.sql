-- Procedure numero 16
-- Verificar si el procedure existe
CREATE PROCEDURE IF EXISTS proc_eliminar_unidad;

DELIMITER //
CREATE PROCEDURE proc_eliminar_unidad(
        IN p_id_unidad INT
)
BEGIN 
    UPDATE Unidad SET Estatus = '0'
        WHERE Id_Unidad = p_id_unidad;
END //
DELIMITER ;
