DROP PROCEDURE IF EXISTS proc_actualizar_marca;

DELIMITER //

CREATE PROCEDURE proc_actualizar_marca(
   IN p_id_Marca INT,
   IN p_nombre_marca VARCHAR(20)
)
BEGIN 
   UPDATE Marca SET 
   Nombre_Marca = p_nombre_marca
   WHERE Id_Marca = p_id_Marca;
END //

DELIMITER ;
