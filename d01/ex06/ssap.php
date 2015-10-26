#!/usr/bin/php
<?PHP
	function ft_split($str)
	{
		$result = array();
		$array = explode(' ', $str);
		foreach ($array as $a)
		{
			if (!empty($a))
				array_push($result, $a);
		}
		sort($result);
		return ($result);
	}
	$result = array();
	for($i = 1; $i < $argc; $i++)
	{
		$split = ft_split($argv[$i]);
		foreach($split as $s)
			array_push($result, $s);
	}
	sort($result);
	foreach($result as $line)
		print "$line\n";
?>
