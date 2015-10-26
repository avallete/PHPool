<?PHP
	if ($_SERVER["PHP_AUTH_USER"] == 'zaz' && $_SERVER["PHP_AUTH_PW"] == 'jaimelespetitsponeys')
	{
?>
<html><body>Bonjour Zaz<br />
	<img src= 'data:image/png;base64,<?PHP echo base64_encode(file_get_contents('../img/42.png')); ?>'>
</body></html>
<?PHP
	}
	else
	{
		header("HTTP/1.0 401 Unauthorized");
		header("WWW-Authenticate: Basic realm=''Espace members''");
?>
<html><body>Cette zone est accessible uniquement aux membres du site</body></html>
<?PHP
	}
?>