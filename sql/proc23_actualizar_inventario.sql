-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_actualizar_inventario;
DELIMITER //
CREATE PROCEDURE proc_actualizar_inventario(
    IN p_nombre VARCHAR(30),
    IN p_descripcion VARCHAR(40),
    IN p_precio DOUBLE,
    IN p_existencia INT,
    IN p_marca INT,
    IN p_categoria INT,
    IN p_unidad INT
)
BEGIN
    UPDATE Producto SET
        Nombre = p_nombre,
        Descripcion = p_descripcion,
        Precio = p_precio,
        Existencia = p_existencia,
        Id_Marca = p_marca,
        Id_Categoria = p_categoria,
        Id_Unidad = p_unidad
    WHERE Nombre = p_nombre;
END //
DELIMITER ;
