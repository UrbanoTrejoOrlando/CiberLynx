DROP PROCEDURE IF EXISTS proc_mos_productos_version_2;

DELIMITER //
CREATE PROCEDURE proc_mos_productos_version_2()
BEGIN
	SELECT Codigo_Barras, Nombre, Descripcion, Precio FROM Producto;
END //
DELIMITER ;
