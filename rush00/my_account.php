<?php
	include 'header.php';
	function delete_account($login)
	{
		$prv_str = file_get_contents('../private/passwd');
		$prv_array = unserialize($prv_str);
		foreach ($prv_array as $key => $value) {
			if ($value['mail'] === $login)
				unset($prv_array[$key]);
		}
		$prv_new = serialize($prv_array);
		file_put_contents('../private/passwd', $prv_new);
	}
	function show_cart()
	{
		if (isset($_SESSION['cart']))
		{
			foreach ($_SESSION['cart'] as $value) {
				echo "<div class='cart_compte'><ul class='inner_cart_ul'>";
				echo "<li class='inner_cart'><img style='width:90px;height:90px;' src='".$value['location']."'>".
					"<div>".$value['name']."</div>".
					"<div>".$value['categories']."</div>".
					"<div>".$value['price']."</div>".
					"<div>".number_format ($value['nb'] , 0 , "," , " " )." items</div>".
					"<div><form action='cart.php' method='POST'>
						<input type='hidden' name='name' value='".$value['name']."'>
						<button type='submit' name='submit' value='del_o'>
						<i class='fa fa-cart-arrow-down'></i></button>
						</form>
					</div></li>";
				echo "</ul></div>";
			}
		}
	}
	if (isset($_POST['submit']) && $_POST['submit'] == 'delete_my_account')
	{
		delete_account($_SESSION['log_on_user']);
		$_SESSION['log_on_user'] = NULL;
		$_SESSION['cart'] = NULL;	
		header('Location: index.php');
	}
?>
<html>
	<body>
	<?php
		show_cart();
		if (isset($_SESSION['cart']) && ($_SESSION['cart']) && ($_SESSION['log_on_user']))
		{
			print '
	<div style="text-align: center;">
		Total : '.number_format ($_SESSION['total'] , 2 , "," , " " ).' $
		<form action="cart.php" method="post">
			<button type="submit" name="submit" value="validate" id="delete_account">Validate</button>
		</form>
	</div>';
		}
		if (isset($_SESSION['log_on_user']))
		{
	?>
	<div class="session_log">
		<div style="text-align: center;">
			<form action="modif.php" method="post">
				<button type="submit" name="submit" value="Modif" id="delete_account">Modify my account</button>
			</form>
		</div>
		<div style="text-align: center;">
			<form action="my_account.php" method="post">
				<button type="submit" name="submit" value="delete_my_account" id="delete_account">Delete my account</button>
			</form>
		</div>
			</div>
		<?php
			if ($_SESSION['admin'] == 1)
				echo "<div style='text-align: center'><a href='admin.php'>Admin session</a>";
		?>

	<?php
		}
		else
		{
	?>
	<div class="session_log">
		<div style="text-align: center;">
		<form action="create.php" method="post">
 		E-mail: <br /><input type="text" name="mail" placeholder="valid-mail@gmail.com" class='text_field' value=<?=$_POST['mail'];?>><br/>
 		Mot de passe: <br /><input type="password" name="passwd" placeholder="password"class='text_field'><br/>
 		Verification: <br /><input type="password" name="vpasswd" placeholder="verification"class='text_field' ><br/>
		<input type="submit" name="submit" value="CREATE"/>
		</form>
		</div>
	</div>
<?php
}
?>
	</body>
</html>
