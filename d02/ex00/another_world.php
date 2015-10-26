#!/usr/bin/php
<?PHP
	if ($argc >= 2)
	{
		$argv[1] = trim($argv[1]);
		$array = preg_replace("/[\t ]+/", ' ', $argv[1]);
		print "$array\n";
	}
?>
