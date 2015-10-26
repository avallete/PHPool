<?php
	include 'header.php';
	include 'auth.php';
	include 'cart.php';
	function 	ft_chmod($mail)
	{
		if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
		{
			if ($mail)
			{
				$filecontent = file_get_contents('../private/passwd');
				$db = unserialize($filecontent);
				if (($n = user_exist($mail, $db)) !== FALSE)
				{
					$db[$n]['admin'] = 1;
					file_put_contents('../private/passwd', serialize($db));
				}
			}
		}
	}
	function user_list()
	{
		$ret = array();
		$filecontent = file_get_contents('../private/passwd');
		$db = unserialize($filecontent);
		foreach($db as $u)
			$ret[] = $u['mail'];
		return ($ret);
	}
	function set_new_item($db)
	{
		$db = $db[$_POST['id']];
		$categories = implode(',', explode(' ', $db['categories']))
		?>
		<div class="session_log">
		<div style="margin-top:100px;" class="session_log_in">
			<form action="items.php" method="POST">
				Name<br /><input class='text_field' type="text" name="name" value=<?php echo '"'.$db['name'].'"'?>><br />
				Categories <br /><input  class='text_field' type='text' placeholder='categorie1,categorie2,categorie3' name='categories' value=<?php echo '"'.$categories.'"'?>><br />
				Price <br /><input class='text_field' type="text" name="price" value=<?php echo '"'.$db['price'].'"'?>><br />
				Description <br /><textarea style="text-align: left;" name="description" rows="10" cols="47"><?php echo $db['description']?></textarea><br />
       			Img_link <br /><input class='text_field' type="text" name="location" value=<?php echo '"'.$db['location'].'"'?>><br />
       			Id <br /><input class='text_field' type="text" name="id" value=<?=$db['id']?>><br />
       			<button style="margin-top:10px;" type="submit" name="submit" value="add_db" id="delete_account">Validate</button>
			</form>
			</div>
		</div>
		<?php
	}
	function delete_user($username)
	{
		if ($_SESSION['admin'] == 1)
		{
			$filecontent = file_get_contents('../private/passwd');
			$db = unserialize($filecontent);
			if (($n = user_exist($username, $db)) !== FALSE)
			{
				unset($db[$n]);
				file_put_contents('../private/passwd', serialize($db));
			}
			if ($username == $_SESSION['log_on_user'])
				header('Location: logout.php');
		}
	}
	function 	cart_items($cmd)
	{
		$str = '<ul>';
		foreach($cmd['cart'] as $obj)
			$str = $str.'<li>'.$obj['name'].' : '.$obj['nb'].' items</li>';
		$str = $str.'</ul>';
		return ($str);
	}
	function 	display_users()
	{
		$list = user_list();
		foreach ($list as $user)
		{
			print '<option value="'.$user.'">'.$user.'</option>';
		}
	}
	function 	display_id()
	{
		$list = get_database();
		foreach ($list as $ob)
		{
			print '<option value="'.$ob['id'].'">'.$ob['name'].'</option>';
		}
	}
	function 	list_buy()
	{
		if ($_SESSION['admin'] == 1)
		{
			if (file_exists('../private/cmd'))
			{
				$filecontent = file_get_contents('../private/cmd');
				$tabcmd = unserialize($filecontent);
				echo "<div style='margin-left:10px'>Command list</div>";
				foreach($tabcmd as $cmd)
				{
					echo "<div style='margin-left:20px'>";
					print '<div><p>Username: '.$cmd['mail'].'</p></div>';
					print cart_items($cmd);
					print '<div><p>Total: '.number_format ( $cmd['total'] , 2 , "," , " " ).' $</p></div>';
					echo "</div>";
				}
			}
		}
	}
	if (isset($_POST['submit']))
	{
		if ($_POST['submit'] == 'new_item')
			set_new_item(NULL);
		else if ($_POST['submit'] == 'mod_item')
		{
			$db = get_database();
			set_new_item($db);
		}
		else if ($_POST['submit'] == 'delete_user')
			delete_user($_POST['mail']);
		else if ($_POST['submit'] == 'make_admin')
			ft_chmod($_POST['mail']);
	}
	if (!isset($_POST['submit']) || $_POST['submit'] != 'new_item' && $_POST['submit'] != 'mod_item' && isset($_SESSION['admin']) && $_SESSION['admin'])
	{
?>
<!DOCTYPE html>
<html>
	<body>
	<div style="margin-top:120px;" class='toto'><?=list_buy();?></div>
	<div class="session_log" style="margin-top:150px;">
		<div style="text-align: center;">
		<form action="admin.php" method="POST">
	       <select style='width:150px;' name="mail" id="mail">
	       		<?=display_users();?>
	       </select>
	       <input type='submit' name='submit' value='delete_user'>
	       </form>
		</div>
	</div>
	<div class="session_log" style="margin-top:20px;">
		<form action="admin.php" method="POST">
			<div style="text-align: center;">
	     	  <select style='width:150px;' name="mail" id="mail">
	       			<?=display_users();?>
	       		</select>
	      	 <input type='submit' name='submit' value='make_admin'>
		</form>
		</div>
	</div>
	<div class="session_log" style="margin-top:20px;">
		<div style="text-align:center;">
			<form action="admin.php" method="POST">
	     	  <select style='width:150px;' name="id" id="ID">
	       			<?=display_id();?>
	       		</select>
	      	 <input type='submit' name='submit' value="mod_item">
			</form>
		</div>
	</div>
	<div class="session_log" style="margin-top:20px;">
		<div style="text-align:center;">
			<form action="items.php" method="POST">
	     	  <select style='width:150px;' name="id" id="ID">
	       			<?=display_id();?>
	       		</select>
	      	 <input type='submit' name='submit' value="del_db">
			</form>
		</div>
	</div>
		<div class="session_log" style="margin-top:20px;">
		<div style="text-align:center;">
			<form action="admin.php" method="POST">
				<button type="submit" name="submit" value="new_item" id="delete_account">New item</button>
			</form>
		</div>
	</div>
	</body>
</html>
<?php
	}
?>