-- Procedure numero 15
-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_actualizar_unidad;

DELIMITER //
CREATE PROCEDURE proc_actualizar_unidad(
   IN p_id_unidad INT,
   IN p_nombre_unidad VARCHAR(20)
)
BEGIN 
   UPDATE Unidad SET 
   Nombre_Unidad = p_nombre_unidad
   WHERE Id_Unidad = p_id_unidad;
END //
DELIMITER ;
