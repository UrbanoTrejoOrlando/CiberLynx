DROP PROCEDURE IF EXISTS proc_codigo_barras;

DELIMITER //
CREATE PROCEDURE proc_codigo_barras()
BEGIN
        SELECT Codigo_Barras, Nombre
        FROM Producto WHERE Existencia = 1;
END //
DELIMITER ;
