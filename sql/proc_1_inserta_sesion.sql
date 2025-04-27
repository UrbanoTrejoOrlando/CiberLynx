
DELIMITER //

CREATE PROCEDURE proc_inserta_sesion(
    IN p_clv_usuario VARCHAR(5)
)
BEGIN
    -- Ajustado para 12 caracteres
    DECLARE p_folio_sesion VARCHAR(12); 
    SET p_folio_sesion = GenerarClaveAleatoria12();

    -- Inserción en la tabla Sesion
    INSERT INTO Sesion (Folio_Sesion, Clv_Usuario) 
    VALUES (p_folio_sesion, p_clv_usuario);
END //

DELIMITER ;
