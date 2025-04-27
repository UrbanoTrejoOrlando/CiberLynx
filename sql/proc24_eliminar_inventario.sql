-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_eliminar_inventario;
DELIMITER //
CREATE PROCEDURE proc_eliminar_inventario(
   IN p_codigo_barras VARCHAR(13)
)
BEGIN
   UPDATE Producto SET Estatus = '0'
      WHERE Codigo_Barras = p_codigo_barras;
END //
DELIMITER ;
