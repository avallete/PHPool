CREATE TABLE IF NOT EXISTS db_avallete.ft_table(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	login varchar(8) NOT NULL  DEFAULT 'toto',
	groupe ENUM("staff", "student", "other") NOT NULL,
	date_de_creation DATE  NOT NULL
);