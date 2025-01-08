DROP PROCEDURE IF EXISTS proc_conexion;

DELIMITER //
CREATE PROCEDURE proc_conexion(
    IN p_clv_dispositivo VARCHAR(5),
    IN p_codigo_barras VARCHAR(13),
     p_clv_cliente VARCHAR(5),
    IN p_fecha_final DATETIME
)
BEGIN 
    DECLARE p_clv_conexion VARCHAR(5);
    SET p_clv_conexion = GenerarClaveAleatoria12();
    
    INSERT INTO Conexion (Clv_Conexion, Clv_Dispositivo, Codigo_Barras, Clv_Cliente, Fecha_Final)
    VALUES(p_clv_conexion, p_clv_dispositivo, p_codigo_barras, p_clv_cliente, p_fecha_final);
END //
DELIMITER ;
