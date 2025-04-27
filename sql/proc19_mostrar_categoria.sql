-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_mostrar_categoria;

DELIMITER //
CREATE PROCEDURE proc_mostrar_categoria()
BEGIN
	SELECT Id_Categoria, Nombre_Categoria FROM Categoria;
END //
DELIMITER ;
