<?php
	if ($fd = fopen('list.csv', 'a+'))
	{
		$_POST['value'] = htmlspecialchars($_POST['value']);
		if ((flock($fd, LOCK_EX | LOCK_NB)) && $_POST['value'] && $_POST['value'] != "")
		{
				fputcsv($fd, array($_POST['id'], $_POST['value']), ';');
				flock($fd, LOCK_UN);
		}
		fclose($fd);
	}
?>