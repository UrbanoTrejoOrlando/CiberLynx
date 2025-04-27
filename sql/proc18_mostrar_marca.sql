-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_mostrar_marca;

DELIMITER //
CREATE PROCEDURE proc_mostrar_marca()
BEGIN 
	SELECT Id_Marca, Nombre_Marca FROM Marca;
END //
DELIMITER ;
