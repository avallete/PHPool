#!/usr/bin/php
<?PHP

if ($argc == 2)
{
	$tab = array();
	$i = 0;
	while ($get = fgets(STDIN))
	{
		if ($i == 1)
		{
			$split = explode(';', trim($get));
			$add = ['user' => $split[0], 'note' => $split[1], 'noteur' => $split[2], 'feedback' => $split[3]];
			if ($add['note'] != "")
				array_push($tab, $add);
		}
		else
			$i = 1;
	}

	if (!(strcmp($argv[1], "moyenne")))
	{
		$moy = 0;
		$nb = 0;
		foreach($tab as $n)
		{
			if ($n['noteur'] != 'moulinette')
			{
				$moy += $n['note'];
				$nb++;
			}
		}
		print $moy / $nb;
	}
	else if (!(strcmp($argv[1], "moyenne_user")))
	{
		$note = array();
		foreach ($tab as $k)
		{
			if ($k['noteur'] != 'moulinette')
			{
				if (is_array($note[$k['user']]))
				{
					$note[$k['user']]['note'] += $k['note'];
					$note[$k['user']]['count']++;
				}
				else
					$note[$k['user']] = ['note' => $k['note'], 'count' => 1];
			}
		}
		ksort($note);
		foreach ($note as $k => $f)
			print $k.":".($f['note'] / $f['count'])."\n";
	}
	else if (!(strcmp($argv[1], "ecart_moulinette")))
	{
		$note = array();
		$mouli = array();
		foreach ($tab as $k)
		{
			if ($k['noteur'] != 'moulinette')
			{
				if (is_array($note[$k['user']]))
				{
					$note[$k['user']]['note'] += $k['note'];
					$note[$k['user']]['count']++;
				}
				else
					$note[$k['user']] = ['note' => $k['note'], 'count' => 1];
			}
		}
		ksort($note);
		foreach ($tab as $k)
		{
			if ($k['noteur'] == 'moulinette')
			{
				if (is_array($mouli[$k['user']]))
				{
					$mouli[$k['user']]['note'] += $k['note'];
					$mouli[$k['user']]['count']++;
				}
				else
					$mouli[$k['user']] = ['note' => $k['note'], 'count' => 1];
			}
		}
		foreach ($note as $k => $f)
			print $k.":".(($f['note'] / $f['count']) - ($mouli[$k]['note'] / $mouli[$k]['count']))."\n";
	}
}
?>
