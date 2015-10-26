<?php
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	function get_database()
	{
		$ret = array();
		if (file_exists('save.csv'))
		{
			if ($fd = fopen('save.csv', 'r'))
			{
				if (flock($fd, LOCK_SH | LOCK_NB))
				{
					while ($db = fgetcsv($fd, 0, ';'))
						$ret[$db[0]] = unserialize($db[1]);
					flock($fd, LOCK_UN);
				}
				fclose($fd);
			}
			return ($ret);
		}
	}
	function get_jsondb()
	{
		echo (json_encode(get_database()));
	}
	function delete_session($db, $id)
	{ 
		unset($db[$id]);
		if ($fd = fopen('save.csv', 'w'))
		{
			if (flock($fd, LOCK_EX | LOCK_NB))
			{
				foreach($db as $k => $o)
					fputcsv($fd, array('player' => $k, 'session' => serialize($o)), ';');				
				flock($fd, LOCK_UN);
			}
			fclose($fd);
		}
	}
	function save_session($session, $player){
		if ($fd = fopen('save.csv', 'a+'))
		{
			if ((flock($fd, LOCK_EX | LOCK_NB)))
			{
				$db = get_database();
				if (isset($db[$player]))
					delete_session($db, $player);
				fputcsv($fd, array('player' => $player, 'session' => serialize($session)), ';');
				flock($fd, LOCK_UN);
			}
			fclose($fd);
		}
	}
	function select_session($player)
	{
		$session = get_database();
		if (isset($session[$player]))
			return ($session[$player]);
	}
	if (isset($_POST['player']) && isset($_SESSION['game']) && isset($_POST['submit']))
	{
		if (!(file_exists('save.csv')))
			touch('save.csv');
		switch ($_POST['submit'])
		{
			case 'save': save_session($_SESSION['game'], $_POST['player']); break;
			case 'getall': get_jsondb(); break;
			case 'delete': delete_session(get_database(), $_POST['player']);
			case 'select': return (select_session($_POST['player']));
		}
	}
?>