<?php
	include_once('select.php');
	function get_database()
	{
		$ret = array();
		if (file_exists('list.csv'))
		{
			if ($fd = fopen('list.csv', 'r'))
			{
				if (flock($fd, LOCK_SH | LOCK_NB))
				{
					while ($db = fgetcsv($fd, 0, ';'))
						$ret[$db[0]] = $db[1];
					flock($fd, LOCK_UN);
				}
				fclose($fd);
			}
			return ($ret);
		}
	}
	function del_id($db, $id)
	{ 
		unset($db[$id]);
		if ($fd = fopen('list.csv', 'w'))
		{
			if (flock($fd, LOCK_EX | LOCK_NB))
			{
				foreach($db as $k => $o)
					fputcsv($fd, array('id' => $k, 'value' => $o), ';');				
				flock($fd, LOCK_UN);
			}
			fclose($fd);
		}
	}
	if (isset($_POST['id']))
		del_id(get_database(), $_POST['id']);
?>