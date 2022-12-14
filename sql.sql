-- PROCEDURE
DELIMITER //
CREATE PROCEDURE insert_serie(IN p_nom VARCHAR(50), IN p_plateforme INT)
BEGIN
	INSERT INTO serie (nom, platefrome_id) VALUES (p_nom, p_plateforme);
END //

-- TRIGGERS
DELIMITER //
CREATE TRIGGER suppression_auto_saison
BEFORE DELETE ON serie FOR EACH ROW
    DELETE FROM saison WHERE saison.serie_id = OLD.id;
//
CREATE TRIGGER suppression_auto_episode
BEFORE DELETE ON saison FOR EACH ROW
    DELETE FROM episode WHERE episode.saison_id = OLD.id;
//