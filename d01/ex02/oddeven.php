#!/usr/bin/php
<?PHP
	print "Entrez un nombre: ";
	while ($input = fgets(STDIN))
	{
		$trim = trim($input);
		$nb = filter_var($input, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
		if (!(is_int($nb)))
			print "'$trim' n'est pas un chiffre\n";
		else if (!($nb % 2))
			print "Le chiffre $nb est Pair\n";
		else if ($nb % 2)
			print "Le chiffre $nb est Impair\n";
		print "Entrez un nombre: ";
	}
?>
