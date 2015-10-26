<?PHP
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	$_SESSION['log_on_user'] = NULL;
	$_SESSION['cart'] = NULL;
	$_SESSION['admin'] = 0;
	header('Location: index.php');
?>