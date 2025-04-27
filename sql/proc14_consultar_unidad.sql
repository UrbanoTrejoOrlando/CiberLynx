-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_unidad;

DELIMITER //
CREATE PROCEDURE proc_unidad(
    IN p_id_unidad INT
)
BEGIN 
SELECT Id_Unidad, Nombre_Unidad FROM Unidad WHERE Id_Unidad = p_id_unidad;
END //
DELIMITER ;
