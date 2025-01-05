CREATE PROCEDURE proc_eliminar_cliente;

DELIMITER //
CREATE PROCEDURE proc_eliminar_cliente(
        IN p_clv_cliente VARCHAR(5)
)
BEGIN
        UPDATE Cliente SET Estatus = '0'
                WHERE Clv_Cliente = p_clv_cliente;
END //
DELIMITER ;
