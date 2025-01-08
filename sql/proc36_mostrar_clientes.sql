DROP PROCEDURE IF EXISTS proc_mostrar_cliente;

DELIMITER //
CREATE PROCEDURE proc_mostrar_clientes()
BEGIN
SELECT Clv_Cliente, Nombre FROM Cliente;
END //
DELIMITER ;
