#!/usr/bin/php
<?PHP
function ft_split($str, $c)
{
	$result = array();
	$array = explode($c, $str);
	foreach ($array as $a)
	{
		if (!empty($a))
			array_push($result, $a);
	}
	return ($result);
}
if ($argc == 2)
{
	$allow = array('+', '*', '-', '%', '/');
	foreach($allow as $op)
	{
		if (($pos = strpos($argv[1], $op)))
			break;
	}
	if ($pos > 0)
	{
		$split = ft_split($argv[1], $argv[1][$pos]);
		$split[0] = trim($split[0]);
		$split[1] = trim($split[1]);
		if ((is_numeric($split[0])) && (is_numeric($split[1])))
		{
			switch ($argv[1][$pos])
			{
			case '+':
				$res = $split[0] + $split[1];
				break;
			case '-':
				$res = $split[0] - $split[1];
				break;
			case '/':
				$res = $split[0] / $split[1];
				break;
			case '%':
				$res = $split[0] % $split[1];
				break;
			case '*':
				$res = $split[0] * $split[1];
				break;
			default:
				$res = "";
				break;
			}
			print "$res\n";
		}
		else
			print "Syntax Error\n";
	}
	else
		print "Syntax Error\n";
}
else
	print "Incorrect Parameters\n";
?>
