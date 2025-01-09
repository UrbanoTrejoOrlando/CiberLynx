DELIMITER //

CREATE FUNCTION GenerarClaveCodigoBarras() 
RETURNS VARCHAR(13) 
BEGIN
    DECLARE clave VARCHAR(13) DEFAULT ''; -- Almacena la clave generada
    DECLARE caracteres VARCHAR(10) DEFAULT '0123456789'; -- Conjunto de caracteres permitidos (dígitos)
    DECLARE i INT DEFAULT 1; -- Contador para el ciclo

    -- Generar clave aleatoria de 13 caracteres
    WHILE i <= 13 DO
        SET clave = CONCAT(clave, SUBSTRING(caracteres, FLOOR(1 + RAND() * LENGTH(caracteres)), 1));
        SET i = i + 1;
    END WHILE;

    RETURN clave; -- Retorna la clave generada
END //
//

DELIMITER ;

