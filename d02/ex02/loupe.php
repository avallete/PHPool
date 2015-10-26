#!/usr/bin/php
<?PHP

function ft_toupper($s)
{
	$tmp = strtoupper($s[1]);
	return ($tmp.$s[2]);
}

function replacetitle($m)
{
	if (preg_match("#(<.+?>)#", $m[2]))
	{
		$recurs = preg_replace_callback("#(.+?)(<.+?>)#ms", ft_toupper, $m[2]);
		$recurs = preg_replace_callback("#(<.+?>)(.+)#ms", replacetitle, $recurs);
	}
	else
		$recurs = strtoupper($m[2]);
	return ($m[1].$recurs.$m[3]);
}

if ($argc == 2)
{
	if ($content = @file_get_contents($argv[1]))
	{
		$retit = preg_replace_callback("#(<a.*?>)(.*?)(</a>)#ms", replacetitle, $content);
		$retit = preg_replace_callback("#(title=)(\".+?\")#ms", replacetitle, $retit);
		print $retit;
	}
	else
		print "\n";
}
?>
