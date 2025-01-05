DROP PROCEDURE IF EXISTS proc_actualizar_cliente;

DELIMITER //

CREATE PROCEDURE proc_actualizar_cliente(
IN p_nombre VARCHAR(20),
IN p_apellidop VARCHAR(20),
IN p_apellidom VARCHAR(20)
)
BEGIN 
UPDATE Cliente SET
Nombre = p_nombre,
Apellido_Paterno = p_apellidop,
Apellido_Materno = p_apellidom
WHERE Nombre = p_nombre;
END //

DELIMITER ;
