#!/usr/bin/php
<?PHP
	if ($argc >= 3)
	{
		$key = $argv[1];
		$tab = array();
		for ($i = 2; $i < $argc; $i++)
		{
			$split = explode(':', $argv[$i]);
			$tab[$split[0]] = $split[1];
		}
		if ($tab[$key])
			print "$tab[$key]\n";
	}
?>
