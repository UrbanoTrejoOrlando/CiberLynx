-- Procedure numero 20
-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_mostrar_unidad;

DELIMITER //
CREATE PROCEDURE proc_mostrar_unidad()
BEGIN
   SELECT Id_Unidad, Nombre_Unidad FROM Unidad;
END //
DELIMITER ; 
