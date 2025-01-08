DROP PROCEDURE IF EXISTS proc_detalles_productos;
DELIMITER //
CREATE PROCEDURE proc_detalles_productos(
    IN fecha_inicio DATE,
    IN fecha_fin DATE
)
BEGIN
    SELECT 
        Producto.Nombre,
        Producto.Codigo_Barras,
        SUM(Detalle_Venta.Cantidad) AS 'Cantidad',
        Producto.Precio,
        Categoria.Nombre_Categoria
    FROM 
        Detalle_Venta
    INNER JOIN 
        Venta ON Detalle_Venta.Folio_Venta = Venta.Folio_Venta
    INNER JOIN 
        Producto ON Detalle_Venta.Codigo_Barras = Producto.Codigo_Barras
    INNER JOIN 
        Categoria ON Producto.Id_Categoria = Categoria.Id_Categoria
    WHERE 
        DATE(Venta.Fecha) BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        Producto.Nombre, Producto.Codigo_Barras, Producto.Precio, Categoria.Nombre_Categoria;
END //
DELIMITER ;
