-- Procedure numero 3
-- Eliminar el procedure si es que existe
DROP PROCEDURE IF EXISTS proc_insertar_cliente;

DELIMITER ;;
CREATE DEFINER=`Orlando`@`%` PROCEDURE `proc_insertar_cliente`(
    IN p_nombre VARCHAR(20),
    IN p_apellidop VARCHAR(20),
    IN p_apellidom VARCHAR(20)
)
BEGIN
    DECLARE p_clv_cliente VARCHAR(5);
    SET p_clv_cliente = GenerarClaveAleatoria12();

        INSERT INTO Cliente (Clv_Cliente, Nombre, Apellido_Paterno, Apellido_Materno)
        VALUES (p_clv_cliente, p_nombre, p_apellidop, p_apellidom);
END ;;
DELIMITER ;
