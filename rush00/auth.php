<?PHP
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	function 	user_exist($mail, $db)
	{
		foreach ($db as $l => $m)
		{
			if ($m['mail'] == $mail) 
			 	return $l;
		}
		return (FALSE);
	}
	function auth($mail, $passwd)
	{
		if ($mail && $passwd)
		{
			$filecontent = file_get_contents('../private/passwd');
			$db = unserialize($filecontent);
			if (($n = user_exist($mail, $db)) !== FALSE)
			{
				if ($db[$n]['passwd'] == hash('whirlpool', $passwd))
				{
					$_SESSION['admin'] = $db[$n]['admin'];
					return (TRUE);
				}
				else
					return (FALSE);
			}
			else
				return (FALSE);
		}
		else
			return (FALSE);
	}
?>