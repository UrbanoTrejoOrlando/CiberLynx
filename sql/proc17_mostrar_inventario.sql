-- Procedure numero 17
-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_mostrar_inventario;

DELIMITER //
CREATE PROCEDURE proc_mostrar_inventario()
BEGIN
SELECT 
Codigo_Barras, Nombre, Descripcion, Precio,
Nombre_Marca, Nombre_Categoria, Nombre_Unidad,
CASE Producto.Estatus
WHEN 1 THEN 'Activo'
ELSE 'Inactivo'
END AS 'Estatus' ,
Existencia
FROM Producto
INNER JOIN Marca ON Producto.Id_Marca = Marca.Id_Marca
INNER JOIN Categoria ON Categoria.Id_Categoria = Producto.Id_Categoria
INNER JOIN Unidad ON Unidad.Id_Unidad = Producto.Id_Unidad
WHERE Producto.Estatus = '1';
END //
DELIMITER ;
