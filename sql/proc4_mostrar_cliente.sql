DROP PROCEDURE IF EXISTS proc_mostrar_clientes_nuevo;

DELIMITER //

CREATE PROCEDURE proc_mostrar_clientes_nuevo()
BEGIN
SELECT 
Clv_Cliente, Nombre, Apellido_Paterno, Apellido_Materno FROM Cliente WHERE Estatus = '1';
END //

DELIMITER ;
