<?php

include 'auth.php';

if (session_status() == PHP_SESSION_NONE)
	session_start();
if (!($_SESSION['log_on_user']))
{	
	if ($_POST['submit'] == 'LOGIN')
	{
		if (!(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)))
			$_POST['mail'] = "'Invalid Mail'";
		if (isset($_POST['mail']) && isset($_POST['passwd']))
		{
			if ((auth($_POST['mail'], $_POST['passwd'])) === TRUE)
			{
				$_SESSION['log_on_user'] = $_POST['mail'];
				header("Location: index.php");
			}
			else
			{
				?>
				<div class="error_psw_usr">Wrong username or password, Please try again!</div>
				<?php
			}
		}
		else
			$_SESSION['log_on_user'] = NULL;
	}
}
?>
<!DOCTYPE html>
<html>
	<body>
	<div class="session_log">
		<div style="text-align: center;">
		<form action="login.php" method="post">
 		E-mail: <br /><input type="text" class='text_field' name="mail" placeholder="valid-mail@gmail.com" value=<?=$_POST['mail'];?>><br/>
 		Mot de passe: <br /><input type="password" name="passwd" placeholder="password" class='text_field'><br/>
		<input type="submit" name="submit" value="LOGIN"/>
		</form>
		</div>
		<a href="create.php">Create an account</a>
	</div>
	</body>
</html>
