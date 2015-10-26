INSERT INTO db_avallete.ft_table(`login`, `groupe`, `date_de_creation`)
	SELECT `nom`, 'other', `date_naissance` FROM db_avallete.fiche_personne
	WHERE `nom` LIKE '%a%' && LENGTH(`nom`) < 9 ORDER BY `nom` ASC LIMIT 10;