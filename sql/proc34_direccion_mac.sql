DROP PROCEDURE IF EXISTS proc_direccion_mac;
DELIMITER //

CREATE PROCEDURE proc_direccion_mac()
BEGIN
        SELECT Clv_Dispositivo, Direccion_Mac
        FROM Dispositivo;
END //
DELIMITER ;
