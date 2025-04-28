-- Procedure numero 21
-- Verificar si el procedure existe
DROP PROCEDURE IF EXISTS proc_insertar_producto;

DELIMITER //
CREATE PROCEDURE proc_insertar_producto(
IN p_marca INT,
IN p_categoria INT,
IN p_unidad INT,
IN p_nombre VARCHAR(30),
IN p_precio DOUBLE,
IN p_existencia INT,
IN p_descripcion VARCHAR(40)
)
BEGIN 
DECLARE p_codigo_barras VARCHAR(13);
    SET p_codigo_barras = GenerarClaveCodigoBarras();

INSERT INTO Producto (Codigo_Barras, Id_Marca, Id_Categoria, Id_Unidad, Nombre, Precio, Existencia, Descripcion) 
VALUES (p_codigo_barras, p_marca, p_categoria, p_unidad, p_nombre, p_precio, p_existencia, p_descripcion);
END //
DELIMITER ;
