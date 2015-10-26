#!/usr/bin/php
<?PHP
	if ($argc == 2)
	{
		$day = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
		$month = [1 => 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre'];
		$format = '/^[a-zA-Z][a-z]+ ([0-2]?[0-9]|3[01]) [a-zA-Z][a-z]+ [0-9]{4} (([01][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9])$/';
		if ((preg_match($format, $argv[1])))
		{
			$tmp = strtolower($argv[1]);
			$split = explode(' ', $tmp);
			$ok = -1;
			foreach ($day as $d)
			{
				if (!(strcmp($d, $split[0])))
				{
					foreach($month as $k => $m)
					{
						if (!(strcmp($m, $split[2])))
						{
							$ok = $k;
						}
					}
				}
			}
			if ($ok > -1)
			{
				date_default_timezone_set('Europe/Paris');
				$str = $split[3].'-'.$ok.'-'.$split[1].' '.$split[4];
				$tmps = strtotime($str);
				print "$tmps\n";
			}
			else
				print "Wrong Format\n";
		}
		else
			print "Wrong Format\n";
	}
?>
