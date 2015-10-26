<?php
	function create_obj($name, $price, $description, $nb, $id)
	{
		$obj = [];
		$obj['name'] = $name;
		$obj['price'] = $price;
		$obj['nb'] = 0 + $nb;
		$obj['description'] = $description;
		$obj['id'] = $id;
	}
	function get_database()
	{
		$ret = array();
		if (file_exists('../private/bde.csv'))
		{
			if ($fd = fopen('../private/bde.csv', 'r'))
			{
				if (flock($fd, LOCK_SH | LOCK_NB))
				{
					while ($db = fgetcsv($fd, 0, ';'))
						$ret[$db[5]] = ['location' => $db[0], 'categories' => $db[1], 'name' => $db[2], 'price' => $db[3], 'description' => $db[4], 'id' => $db[5]];
					flock($fd, LOCK_UN);
				}
				fclose($fd);
			}
			return ($ret);
		}
		else
		{
			$ret[0] = ['location' => NULL, 'categories' => NULL, 'name' => NULL, 'price' => NULL, 'description' => NULL];;
			return ($ret);
		}
	}
	function create_dbo($location, $name, $categories, $price, $description, $id)
	{
		$categories = implode(' ', array_filter(explode(',', $categories)));
		$dbo = ['location' => $location, 'categories' => $categories, 'name' => $name, 'price' => $price, 'description' => $description, 'id' => $id];
		return $dbo;
	}
	function del_id($db, $id)
	{
		if (isset($db[$id]))
		{
			unset($db[$id]);
			if ($fd = fopen('../private/bde.csv', 'w'))
			{
				if (flock($fd, LOCK_EX | LOCK_NB))
				{
					foreach($db as $o)
						fputcsv($fd, $o, ';');				
					flock($fd, LOCK_UN);
				}
				fclose($fd);
			}
		}
		header('Location: admin.php');
	}
	function modify_item($db, $new, $oldid)
	{
		if (isset($db[$oldid]))
		{
			if (array_diff($db[$oldid], $new))
			{
				$db[$oldid] = $new;
				if ($fd = fopen('../private/bde.csv', 'w'))
				{
					if (flock($fd, LOCK_EX | LOCK_NB))
					{
							foreach($db as $ob)
								fputcsv($fd, $ob, ';');
						flock($fd, LOCK_UN);
					}
					fclose($fd);
				}
			}
		}
		header('Location: admin.php');
	}
	function add_database($db)
	{
		if ($fd = fopen('../private/bde.csv', 'a+'))
		{
			foreach ($_POST as &$value) {
				$value = htmlspecialchars($value);
			}
			if ((!(isset($db[$_POST['id']]))) && (flock($fd, LOCK_EX | LOCK_NB)))
			{
					fputcsv($fd, create_dbo($_POST['location'], $_POST['name'], $_POST['categories'], $_POST['price'], $_POST['description'], $_POST['id']), ';');
					flock($fd, LOCK_UN);
			}
			else
			{
				$new = create_dbo($_POST['location'], $_POST['name'], $_POST['categories'], $_POST['price'], $_POST['description'], $_POST['id']);
				modify_item($db, $new, $_POST['id']);
			}
			fclose($fd);
		}
		header('Location: admin.php');
	}
	if (isset($_POST['submit']))
	{
		if ($_POST['submit'] == 'add_db')
			add_database(get_database());
		else if ($_POST['submit'] == 'del_db')
			del_id(get_database(), $_POST['id']);
	}
?>