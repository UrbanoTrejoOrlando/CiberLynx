DROP PROCEDURE IF EXISTS proc_rol;
DELIMITER //
CREATE PROCEDURE proc_rol()
BEGIN
    SELECT Id_Rol, Nombre_Rol
    FROM Rol;
END //
DELIMITER ;
