SELECT UPPER(fiche_personne.nom), prenom, prix FROM db_avallete.fiche_personne INNER JOIN db_avallete.membre ON fiche_personne.id_perso = membre.id_fiche_perso INNER JOIN db_avallete.abonnement ON abonnement.id_abo = membre.id_abo WHERE prix > 42 ORDER BY fiche_personne.nom, fiche_personne.prenom ASC;