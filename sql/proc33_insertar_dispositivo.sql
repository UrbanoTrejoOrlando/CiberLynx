DROP PROCEDURE IF EXISTS proc_insertar_dispositivo;
DELIMITER //
CREATE PROCEDURE proc_insertar_dispositivo(
    IN p_id_tipo INT,
    IN p_direccion_mac VARCHAR(17)
)
BEGIN 
    DECLARE p_clv_dispositivo VARCHAR(5);
    SET p_clv_dispositivo = GenerarClaveAleatoria12();
    
    INSERT INTO Dispositivo (Clv_Dispositivo, Id_Tipo_Dispositivo, Direccion_Mac)
    VALUES(p_clv_dispositivo, p_id_tipo, p_direccion_mac);
END //
DELIMITER ;
