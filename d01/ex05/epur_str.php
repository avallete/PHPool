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

	if ($argc == 2)
	{
		$result = implode(" ", ft_split($argv[1]));
		print "$result\n";
	}
?>
