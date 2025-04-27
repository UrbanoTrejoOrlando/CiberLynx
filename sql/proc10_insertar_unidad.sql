-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_insertar_unidad;

DELIMITER //
CREATE PROCEDURE proc_insertar_unidad(
        IN p_nombre VARCHAR(20)
)
BEGIN
        INSERT INTO Unidad (Nombre_Unidad) VALUES (p_nombre);
END //
DELIMITER ;
