-- Procedure numero 5
-- Verficar si el procedure existe
DROP PROCEDURE IF EXISTS proc_consultar_cliente;

DELIMITER //

CREATE PROCEDURE proc_consultar_cliente(
IN p_clv_cliente VARCHAR(5)
)
BEGIN 
SELECT Nombre, Apellido_Paterno, Apellido_Materno
FROM Cliente WHERE Clv_Cliente = p_clv_cliente;
END //

DELIMITER ;
