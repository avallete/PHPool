#!/usr/bin/php
<?PHP
	$countline = 0;
	$countX = 1000;
	for ($countX > 0; $countX--; $countline++)
	{
		if ($countline == 80)
		{
			print "\n";
			$countline = 0;
		}
		print "X";
	}
	print"\n";
?>
