#!/usr/bin/php
<?PHP
if ($argc == 4)
{
	unset($argv[0]);
	$op = implode(' ', $argv);
	$argv[1] = trim($argv[1]);
	$argv[2] = trim($argv[2]);
	$argv[3] = trim($argv[3]);
	switch ($argv[2])
	{
	case '+':
		$result = $argv[1] + $argv[3];
		break;
	case '-':
		$result = $argv[1] - $argv[3];
		break;
	case '/':
		$result = $argv[1] / $argv[3];
		break;
	case '%':
		$result = $argv[1] % $argv[3];
		break;
	case '*':
		$result = $argv[1] * $argv[3];
		break;
	default:
		$result = "";
		break;
	}
	print "$result\n";
}
else
	print "Incorrect Parameters\n";
?>
