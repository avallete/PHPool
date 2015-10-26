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
?>
