DROP PROCEDURE IF EXISTS proc_mostrar_tipo_dispositivo;

DELIMITER //
CREATE PROCEDURE proc_mostrar_tipo_dispositivo()
BEGIN
	SELECT Id_Tipo_Dispositivo, Nombre_Dispositivo FROM Tipo_Dispositivo;
END //
DELIMITER ;
