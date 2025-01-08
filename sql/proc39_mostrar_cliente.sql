DROP PROCEDURE IF EXISTS mostrar_cliente;

DELIMITER //
CREATE PROCEDURE mostrar_cliente(
    IN p_clv_cliente VARCHAR(5)
)
BEGIN
    SELECT CONCAT(Nombre, ' ', Apellido_Paterno, ' ', Apellido_Materno) AS Nombre_Completo 
    FROM Cliente 
    WHERE Clv_Cliente = p_clv_cliente;
END //
DELIMITER ;
