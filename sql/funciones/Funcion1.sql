DELIMITER //

CREATE FUNCTION GenerarClaveAleatoria12() 
RETURNS VARCHAR(5) 
CHARSET latin1 
COLLATE latin1_swedish_ci
DETERMINISTIC -- Indicamos que siempre devuelve el mismo resultado para los mismos inputs
BEGIN
    DECLARE clave VARCHAR(5) DEFAULT '';
    DECLARE caracteres VARCHAR(62) DEFAULT 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    DECLARE i INT DEFAULT 1;

    -- Generar clave aleatoria de 5 caracteres
    WHILE i <= 5 DO
        SET clave = CONCAT(clave, SUBSTRING(caracteres, FLOOR(1 + RAND() * LENGTH(caracteres)), 1));
        SET i = i + 1;
    END WHILE;

    RETURN clave;
END;
//

DELIMITER ;

