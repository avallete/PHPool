<?php
	include 'items.php';
	if (session_status() == PHP_SESSION_NONE)
		session_start();
	function 	record_cart()
	{
		if (!(file_exists('../private/cmd')))
			touch('../private/cmd');
		if (isset($_SESSION['log_on_user']))
		{
			$cmd = array();
			$cmd['cart'] = $_SESSION['cart'];
			$cmd['mail'] = $_SESSION['log_on_user'];
			$cmd['total'] = $_SESSION['total'];
			$content = file_get_contents('../private/cmd');
			$content = unserialize($content);
			$content[] = $cmd;
			file_put_contents('../private/cmd', serialize($content));
		}
		else
			header("Location: index.php");
	}
	function 	validate_cart()
	{
		if (isset($_SESSION['log_on_user']))
		{
			if ((isset($_POST['submit'])) && $_POST['submit'] == 'validate')
			{
				if (isset($_SESSION['cart']) && $_SESSION['cart'])
				{
					sleep(1);
					record_cart();
					echo "<h1>Commande Validee</h1>";
					$_SESSION['cart'] = NULL;
				}
			}
		}
		header('Location: index.php');
	}
	function 	del_cart_obj($name)
	{
		if (isset($_SESSION['cart']))
			unset($_SESSION['cart'][$name]);
		header('Location: my_account.php');
	}
	function 	add_cart_obj($id, $nb)
	{
		$obj = get_database();
		if (!isset($_SESSION['cart']))
			$_SESSION['cart'] = array();
		if (isset($obj[$id]))
		{
			$obj = $obj[$id];
			if (isset($_SESSION['cart'][$obj['name']]))
			{
				echo "adasdasdas\n";
				$_SESSION['cart'][$obj['name']]['nb'] += $nb;
			}
			else
			{
				$_SESSION['cart'][$obj['name']] = $obj;
				$_SESSION['cart'][$obj['name']]['nb'] = $nb;
			}
		}
		header("Location: shop.php");
	}
	function 	modify_obj_value($obj, $mod)
	{
		if (isset($_SESSION['cart'][$obj['name']]))
			$_SESSION['cart'][$obj['name']]['nb'] += $mod;
	}
	function 	cart_total()
	{
		$total = 0;
		$nb = 0;
		if (isset($_SESSION['cart']))
		{
			foreach($_SESSION['cart'] as $k => $obj)
			{
				$total += $obj['price'] * $obj['nb'];
				$nb += $obj['nb'];
			}
		}
		$_SESSION['total'] = $total;
		$_SESSION['nbelem'] = $nb;
	}
	function 	print_cart_total()
	{
		echo 	'<br />'.number_format ($_SESSION['total'] , 2 , "," , " " ).'$';
	}
	function 	print_cart_nb()
	{
		echo number_format ($_SESSION['nbelem'] , 0 , "," , " " ).' items';	
	}
	if (isset($_POST['submit']))
	{
	if ($_POST['submit'] == 'add_o')
		add_cart_obj($_POST['id'], $_POST['nb']);
	else if ($_POST['submit'] == 'del_o')
		del_cart_obj($_POST['name']);
	else if ($_POST['submit'] == 'validate')
		validate_cart();
	}
	cart_total();
?>