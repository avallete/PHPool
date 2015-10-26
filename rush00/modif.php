<?PHP
	include 'header.php';
	function 	user_exist($mail, $db)
	{
		foreach ($db as $l => $m)
		{
			if ($m['mail'] == $mail) 
			 	return $l;
		}
		return (FALSE);
	}
	if ($_POST['submit'] == 'OK')
	{
		if ($_POST['mail'] && $_POST['newpw'] && $_POST['oldpw'])
		{
			$filecontent = file_get_contents('../private/passwd');
			$db = unserialize($filecontent);
			if (($n = user_exist($_POST['mail'], $db)) !== FALSE)
			{
				if ($db[$n]['passwd'] == hash('whirlpool', $_POST['oldpw']))
				{
					$db[$n]['passwd'] = hash('whirlpool', $_POST['newpw']);
					file_put_contents('../private/passwd', serialize($db));
					header("Location: index.php");
					print "OK\n";
				}
				else
				?>
					<div class="error_psw_usr">Wrong username or password, Please try again!</div>
				<?php
			}
			?>
				<div class="error_psw_usr">Wrong username or password, Please try again!</div>
			<?php
		}
	}
?>
<!DOCTYPE html>
<html>
	<body>
	<div class="session_log">
	<div style="text-align: center">
		<form action="modif.php" method="post">
 			Mail: <br /><input type="text" name="mail" class='text_field'> <br/>
 			Ancien mot de passe:<br /><input type="password" name="oldpw" class='text_field'><br/>
 			Nouveau mot de passe:<br /><input type="password" name="newpw" class='text_field'><br/>
			<input type="submit" name="submit" value="OK"/>
		</form>
		</div>
	</div>
	</body>
</html>