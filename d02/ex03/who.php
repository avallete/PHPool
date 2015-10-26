#!/usr/bin/php
<?PHP
date_default_timezone_set('CET');
if ($fd = fopen("/var/run/utmpx", 'r'))
{
	while ($content = fread($fd, 628))
	{
		$un = unpack("a256user/a4id/a32line/ipid/itype/I2time/a256host/@", $content);
		if ($un['type'] == 7)
			$tab[trim($un['line'])] = array('user'=>trim($un['user']), 'time'=>$un['time1']);
	}
	ksort($tab);
	foreach ($tab as $line => $d)
	{
		$time = strftime("%b %e %H:%M", $d['time']);

		$p = $d['user'].' '.$line.'  '.$time;
		print "$p \n";
	}
}
?>
