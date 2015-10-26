<!DOCTYPE html>
<html>
		<meta charset="utf-8"/>
	<body>
	<div class="session_log">
		<div style="text-align: center;">
		<form action="create.php" method="post">
 		E-mail: <br /><input type="text" name="mail" placeholder="valid-mail@gmail.com" value=<?=$_POST['mail'];?>><br/>
 		Mot de passe: <br /><input type="password" name="passwd" placeholder="password"><br/>
 		Verification: <br /><input type="password" name="vpasswd" placeholder="verification"><br/>
		<input type="submit" name="submit" value="CREATE"/>
		</form>
		</div>
	</div>
	</body>
</html>