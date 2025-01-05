
DELIMITER //

CREATE PROCEDURE proc_inserta_sesion(
    IN p_clv_usuario VARCHAR(5)
)
BEGIN
    DECLARE p_folio_sesion VARCHAR(12); -- Ajustado para 12 caracteres
    SET p_folio_sesion = GenerarClaveAleatoria12();

    -- Inserción en la tabla Sesion
    INSERT INTO Sesion (Folio_Sesion, Clv_Usuario) 
    VALUES (p_folio_sesion, p_clv_usuario);
END //

DELIMITER ;
