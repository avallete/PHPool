<?PHP
	function ft_is_sort($tab)
	{
		$tmp = $tab;
		sort($tmp);
		if ($tmp == $tab)
			return (1);
		else
			return (0);
	}
?>
