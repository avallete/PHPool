SELECT film.id_genre AS 'id_genre', genre.nom AS 'nom genre', film.id_distrib AS 'id_distrib', distrib.nom AS 'nom distrib', film.titre AS 'titre film' FROM db_avallete.film 
LEFT JOIN db_avallete.genre ON film.id_genre = genre.id_genre
LEFT JOIN db_avallete.distrib ON film.id_distrib = distrib.id_distrib
WHERE film.id_genre > 3 && film.id_genre < 9;