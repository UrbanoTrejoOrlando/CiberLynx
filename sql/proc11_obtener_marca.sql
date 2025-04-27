-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_marca;

DELIMITER //

CREATE PROCEDURE proc_marca(
    IN p_id_marca INT
)
BEGIN 
SELECT Id_Marca, Nombre_Marca FROM Marca WHERE Id_Marca = p_id_marca;
END //

DELIMITER ;
