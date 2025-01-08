DROP PROCEDURE IF EXISTS proc_total_vendido_por_categoria;

DELIMITER //
CREATE PROCEDURE proc_total_vendido_por_categoria(
    IN fecha_inicio DATE,
    IN fecha_fin DATE
)
BEGIN
    SELECT 
        Categoria.Nombre_Categoria AS Categoria,
        SUM(Producto.Precio * Detalle_Venta.Cantidad) AS TotalVendido
    FROM 
        Detalle_Venta
    INNER JOIN 
        Producto ON Detalle_Venta.Codigo_Barras = Producto.Codigo_Barras
    INNER JOIN 
        Categoria ON Producto.Id_Categoria = Categoria.Id_Categoria
    INNER JOIN 
        Venta ON Detalle_Venta.Folio_Venta = Venta.Folio_Venta
    WHERE 
        DATE(Venta.Fecha) BETWEEN fecha_inicio AND fecha_fin
    GROUP BY 
        Categoria.Nombre_Categoria;
END //
DELIMITER ;
