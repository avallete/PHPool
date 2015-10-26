<?PHP
	if ($_GET['action'] && $_GET['name'])
	{
		switch ($_GET['action'])
		{
			case 'set':
				setcookie($_GET['name'], $_GET['value'], time()+3600); 
				break;	
			case 'get':
				if ($_COOKIE[$_GET['name']])
					print $_COOKIE[$_GET['name']]."\n";
				break;
			case 'del':
				setcookie($_GET['name'], $_GET['value'], time() - 1);  
				break;
			default:
				break;
		}
	}
?>
