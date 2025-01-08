DROP PROCEDURE IF EXISTS proc_mostrar_conexiones;
DELIMITER //

CREATE PROCEDURE proc_mostrar_conexiones()
BEGIN
    SELECT
        Conexion.clv_conexion,
        Dispositivo.Direccion_Mac,
        CASE Conexion.Estatus
            WHEN 1 THEN 'Habilitado'
            ELSE 'Inhabilitado'
        END AS Estatus,
        Producto.Nombre,
        Conexion.Fecha_Inicio,
        Conexion.Fecha_Final
    FROM 
        Conexion
    INNER JOIN 
        Dispositivo ON Conexion.Clv_Dispositivo = Dispositivo.Clv_Dispositivo
    INNER JOIN 
        Producto ON Conexion.Codigo_Barras = Producto.Codigo_Barras
    WHERE 
        Conexion.Estatus = 1; 
END //
DELIMITER ;
