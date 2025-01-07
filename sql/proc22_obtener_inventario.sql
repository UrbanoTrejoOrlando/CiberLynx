DROP PROCEDURE IF EXISTS proc_obtener_inventario;

DELIMITER //
CREATE PROCEDURE proc_obtener_inventario(
    IN p_codigo_barras VARCHAR(13)
)
BEGIN
    SELECT
        Nombre,
        Descripcion,
        Precio,
        Existencia,
        Nombre_Marca,
        Nombre_Categoria,
        Nombre_Unidad,
        CASE Producto.Estatus
                WHEN 1 THEN 'Activo'
                        ELSE 'Inactivo'
        END AS 'Estatus'
        FROM Producto
        INNER JOIN Marca ON Producto.Id_Marca = Marca.Id_Marca
        INNER JOIN Categoria ON Categoria.Id_Categoria = Producto.Id_Categoria
        INNER JOIN Unidad ON Unidad.Id_Unidad = Producto.Id_Unidad
        WHERE p_codigo_barras = Codigo_Barras;
END //
DELIMITER ;
