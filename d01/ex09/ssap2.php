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
	function ssap($argv)
	{
		$result = array();
		for($i = 1; $i < count($argv); $i++)
		{
			$split = ft_split($argv[$i]);
			foreach($split as $s)
				array_push($result, $s);
		}
		return ($result);
	}
	if ($argc >= 2)
	{
		$alpha = array();
		$num = array();
		$oth = array();
		$ssap = ssap($argv);
		foreach ($ssap as $d)
		{
			if (ctype_alpha($d[0]))
				array_push($alpha, $d);
			else if (ctype_digit($d[0]))
				array_push($num, $d);
			else
				array_push($oth, $d);
		}
		natcasesort($alpha);
		sort($num, SORT_STRING);
		sort($oth);
		foreach ($alpha as $a)
			print "$a\n";
		foreach ($num as $n)
			print "$n\n";
		foreach ($oth as $o)
			print "$o\n";
	}
?>
