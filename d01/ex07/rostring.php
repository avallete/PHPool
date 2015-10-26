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
		return ($result);
	}
	if ($argc >= 2)
	{
		$split = ft_split($argv[1]);
		for ($i = 1; $i < count($split); $i++)
			print "$split[$i] ";
		print "$split[0]\n";
	}
?>
