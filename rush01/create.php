<?PHP
	function 	check_passwd_path()
	{
		if (!(file_exists("../private")))
			mkdir("../private");
	}
	function 	account_create($mail, $passwd)
	{
		if (!(file_exists('../private/passwd')))
			touch('../private/passwd');
		if ($filecontent = file_get_contents('../private/passwd'))
		{
			$db = unserialize($filecontent);
			foreach ($db as $k)
			{
				if ($k['mail'] == $mail)
				{
					$_POST['mail'] = "'Username already used'"; 
				 	return false;
				 }
			}
		}
		$account = [];
		$account['mail'] = $mail;
		$account['passwd'] = hash('whirlpool', $passwd);
		$account['admin'] = 0;
		$db[] = $account;
		file_put_contents('../private/passwd', serialize($db));
		return true;
	}
	if (!($_SESSION['log_on_user']))
	{	
			if ($_POST['submit'] == 'CREATE')
			{
				if (!(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)))
					$_POST['mail'] = "'Invalid Mail'";
				if ($_POST['mail'] && $_POST['passwd'] && $_POST['vpasswd'])
				{
					if ($_POST['passwd'] == $_POST['vpasswd'])
					{	
						check_passwd_path();
						if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
						{
							if (account_create($_POST['mail'], $_POST['passwd']) === true)
							{
								var_dump($_POST);
								$_SESSION['log_on_user'] = $_POST['mail'];
								header("Location: index.php");
							}
						}
						else
							$_POST['mail'] = "'Invalid Mail'";
					}
				}
				else
				{
					$_POST['mail'] = $_POST['mail'];
					$_POST['passwd'] = $_POST['passwd'];
				}
			}
				else
				$_POST['vpasswd'] = "'Password not same'";
	}
	else
		header('Location: index.php');
?>
<!DOCTYPE html>
<html>
	<body>
	<div class="session_log">
		<div style="text-align: center;">
		<form action="create.php" method="post">
 		E-mail: <br /><input type="text" name="mail" class='text_field' placeholder="valid-mail@gmail.com" value=<?=$_POST['mail'];?>><br/>
 		Mot de passe: <br /><input type="password" name="passwd" placeholder="password" class='text_field'><br/>
 		Verification: <br /><input type="password" name="vpasswd" placeholder="verification" class='text_field'><br/>
		<input type="submit" name="submit" value="CREATE"/>
		</form>
		</div>
	</div>
	</body>
</html>