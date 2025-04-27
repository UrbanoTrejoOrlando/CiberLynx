-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_insertar_marca;

DELIMITER //
CREATE PROCEDURE proc_insertar_marca(
        IN p_nombre VARCHAR(20)
)
BEGIN
        INSERT INTO Marca (Nombre_Marca) VALUES (p_nombre);
END //
DELIMITER ;
